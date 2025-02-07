<script setup>
    import { ref, watch, onMounted } from 'vue'
    import Editor from '@tinymce/tinymce-vue'

    import apiClient from '@/services/api'
    import { useSessionStore } from '@/stores/session';

    const emit = defineEmits(['status'])
    const props = defineProps({
        form: {
            default: 0,
        },
        delete: false
    })

    const sessionStore = useSessionStore()

    const judul = ref('')
    const tag = ref('')
    const kategori = ref('')
    const isiRTF = ref('')
    const addKategori = ref(false)
    const newKategori = ref('')
    const gambar = ref('')

    const isNewPost = ref(true)
    
    const categoryData = ref([])
    const fileStore = ref(null)

    const isFinished = ref(false)
    const modalText = ref('')

    async function getCategoryData(){
        await apiClient.get('/api/cat')
        .then(resp => {
            categoryData.value = resp.data
        })
    }

    async function updateFile(f){
        fileStore.value = f[0]
        gambar.value = URL.createObjectURL(f[0])
    }

    async function getNews(url){ 
        apiClient.get("/api/post/getpage?url=" + url.split('.')[0])
        .then(x => {
            isiRTF.value = x.data
        })
    } 

    async function submitPost(mode){
        var encodedFileName = encodeURIComponent('tempfile' + '.html')

        var content = "<html><body>" + isiRTF.value + "</body></html>"

        var blob = new Blob([content], {type: "text/html"})
        
        var formData = new FormData()
        
        formData.append('id', mode == 'add' ? sessionStore.session.id : props.form.id)
        formData.append('judul', judul.value)
        formData.append('add_kategori', addKategori.value)
        formData.append('new_kategori', newKategori.value)
        formData.append('kategori', kategori.value)
        formData.append('tag', tag.value)
        formData.append('html', blob, encodedFileName)
        formData.append('thumbnail', fileStore.value)

        let config = {
            headers : {
                'Content-Type' : 'multipart/form-data'
            }
        }

        let url = ""
        if(mode == 'add'){
            url = '/api/post/add'
        }
        else{
            url = '/api/post/update'
        }

        await apiClient.get('/sanctum/csrf-cookie')
        await apiClient.post(url, formData, config)
        .then(resp => {
            if(resp.data == 'Success!'){
                isFinished.value = true

                modalText.value = "Postingan telah berhasil " + (mode == 'add' ? "ditambahkan!" : "diperbarui!")
            }
            else{
                isFinished.value = true

                modalText.value = "Postingan gagal " + (mode == 'add' ? "ditambahkan!" : "diperbarui!") + " Silahkan hubungi administrator jika masalah ini terus berlanjut."
            }

            emit('status', {
                isFinished: isFinished.value,
                mode: mode
            })
        })
    }

    async function hapusPost(){
        await apiClient.get('/sanctum/csrf-cookie')
        await apiClient.post('/api/post/delete', {
            id: props.form.id
        })
        .then(resp => {
            if(resp.data == 'Success!'){
                isFinished.value = true
                modalText.value = "Postingan telah berhasil dihapus!"
            }
            else{
                isFinished.value = true
                modalText.value = "Postingan gagal dihapus! Silahkan hubungi administrator jika masalah ini terus berlanjut."
            }

            emit('status', {
                isFinished: isFinished.value,
                mode: 'delete'
            })
        })
    }

    watch(kategori, async(x, y) => {
        if(x == "NEW"){
            addKategori.value = true
        }
        else{
            addKategori.value = false
        }
    })

    onMounted(() => {
        getCategoryData()

        if(!props.delete){
            if(props.form == 0){
                isNewPost.value = true
            }
            else{
                isNewPost.value = false

                judul.value = props.form.judul
                kategori.value = props.form.id_kategori
                tag.value = props.form.tag
                gambar.value = props.form.foto_post

                getNews(props.form.url_isi)
            }
        }
    })
</script>

<template>
    <div v-if="!props.delete" class="flex flex-col h-full gap-3">
        <div class="flex gap-3 w-full">
            <div class="w-1/2">
                <div class="flex relative">
                    <p class="bg-white absolute top-[-8px] left-5 px-1 text-sm text-indigo">Judul</p>
                    <div class="bg-white p-4 border-[2px] border-indigo rounded-xl flex items-center w-full gap-3">
                        <!-- <fa icon="fas fa-user" class="text-indigo" fixed-width /> -->
                        <input v-model="judul" type="text" class="border-0 p-0 outline-none w-full" placeholder="Masukkan judul post">
                    </div>
                </div>
            </div>

            <div class="flex flex-col w-1/2 gap-3">
                <div class="w-full">
                    <div class="flex relative">
                        <p class="bg-white absolute top-[-8px] left-5 px-1 text-sm text-indigo">Kategori</p>
                        <div class="bg-white p-4 border-[2px] border-indigo rounded-xl flex items-center w-full gap-3">
                            <!-- <fa icon="fas fa-user" class="text-indigo" fixed-width /> -->
                            <select id="kategori" class="bg-transparent p-0 text-indigo outline-none border-none *:bg-white *:text-black w-full" v-model="kategori">
                                <option value='' default hidden>Pilih kategori...</option>

                                <option v-for="x in categoryData" :value="x.id">{{ x.nama }}</option>
                                
                                <option value="NEW">+ Tambah kategori baru</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="w-full" v-if="addKategori">
                    <div class="flex relative">
                        <p class="bg-white absolute top-[-8px] left-5 px-1 text-sm text-indigo">Kategori baru</p>
                        <div class="bg-white p-4 border-[2px] border-indigo rounded-xl flex items-center w-full gap-3">
                            <!-- <fa icon="fas fa-user" class="text-indigo" fixed-width /> -->
                            <input v-model="newKategori" type="text" class="border-0 p-0 outline-none w-full" placeholder="Masukkan kategori baru">
                        </div>
                    </div>
                </div>
            </div>
        </div>     

        <div class="flex w-full gap-3">
            <div class="w-1/2 flex relative">
                <p class="bg-white absolute top-[-8px] left-5 px-1 text-sm text-indigo">Tag</p>
                <div class="bg-white p-4 border-[2px] border-indigo rounded-xl flex items-center w-full gap-3">
                    <!-- <fa icon="fas fa-user" class="text-indigo" fixed-width /> -->
                    <input v-model="tag" type="text" class="border-0 p-0 outline-none w-full" placeholder="Masukkan tag">
                </div>
            </div>
            <div class="w-1/2 flex relative">
                <p class="bg-white absolute top-[-8px] left-5 px-1 text-sm text-indigo">Thumbnail post (upload jika ingin mengubah thumbnail)</p>
                <div class="bg-white p-4 border-[2px] border-indigo rounded-xl flex items-center justify-between w-full gap-3">
                    <!-- <fa icon="fas fa-user" class="text-indigo" fixed-width /> -->
                    <input type="file" @change="updateFile($event.target.files)" class="border-0 p-0 outline-none w-full" placeholder="Tambahkan thumbnail gambar">
                    <img :src="gambar" class="w-1/6">
                </div>
            </div>
        </div>

        <Editor 
            v-model="isiRTF"
            :init="{
                height: '100%',
                branding: false, 
                promotion: false,
                resize: false,
                license_key: 'gpl',
                plugins: ['wordcount', 'media', 'emoticons', 'image', 'searchreplace', 'lists', 'link'],
                toolbar: 'undo redo | styles | formatting align | indent outdent | numlist bullist | insertmedia | cut copy paste',
                toolbar_groups: {
                    formatting: {
                        icon: 'bold',
                        tooltip: 'Formatting',
                        items: 'bold italic underline strikethrough | superscript subscript'
                    },
                    insertmedia: {
                        icon: 'image',
                        tooltip: 'Insert media',
                        items: 'media image emoticons link'
                    }
                },
            }"
        />

        <div class="flex w-full justify-end gap-3">
            <button class="bg-blue-500 px-6 py-3 rounded-xl text-lg text-white" @click="submitPost('add')" v-if="isNewPost">
                Upload postingan
            </button>

            <button class="bg-green-600 px-6 py-3 rounded-xl text-lg text-white" @click="submitPost('update')" v-else>
                Update postingan
            </button>
        </div>
    </div>

    <div class="flex flex-col gap-8" v-else>
        <p class="text-lg">Apakah anda yakin ingin <span class="font-semibold text-red-500">menghapus</span> postingan ini?</p>

        <div class="flex gap-3 items-center justify-end">
            <button class="bg-red-500 px-6 py-3 rounded-xl text-lg text-white" @click="hapusPost()">
                Hapus
            </button>
        </div>
    </div>
</template>
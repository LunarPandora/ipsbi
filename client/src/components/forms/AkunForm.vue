<script setup>
    import { ref, watch, onMounted } from 'vue'

    import apiClient from '@/services/api'
    import { useSessionStore } from '@/stores/session';

    const emit = defineEmits(['status'])
    const props = defineProps({
        form: 0,
        delete: false
    })

    const sessionStore = useSessionStore()

    const uid = ref(0)
    const username = ref('')
    const password = ref('')
    const email = ref('')
    const gambar = ref('')

    const isNewAcc = ref(true)
    
    const fileStore = ref(null)

    const isFinished = ref(false)
    const modalText = ref('')

    async function updateFile(f){
        fileStore.value = f[0]
        gambar.value = URL.createObjectURL(f[0])
    }

    async function submitAcc(mode){
        var formData = new FormData()
        
        if(mode != 'add'){
            formData.append('id', uid.value)
        }

        formData.append('username', username.value)
        formData.append('password', password.value)
        formData.append('email', email.value)
        formData.append('profile', fileStore.value)

        let config = {
            headers : {
                'Content-Type' : 'multipart/form-data'
            }
        }

        let url = ""
        if(mode == 'add'){
            url = '/api/acc/add'
        }
        else{
            url = '/api/acc/update'
        }

        await apiClient.get('/sanctum/csrf-cookie')
        await apiClient.post(url, formData, config)
        .then(resp => {
            if(resp.data == 'Success!'){
                isFinished.value = true

                modalText.value = "Akun telah berhasil " + (mode == 'add' ? "ditambahkan!" : "diperbarui!")
            }
            else{
                isFinished.value = true

                modalText.value = "Akun gagal " + (mode == 'add' ? "ditambahkan!" : "diperbarui!") + " Silahkan hubungi administrator jika masalah ini terus berlanjut."
            }

            emit('status', {
                isFinished: isFinished.value,
                mode: mode
            })
        })
    }

    async function hapusPost(){
        await apiClient.get('/sanctum/csrf-cookie')
        await apiClient.post('/api/acc/delete', {
            id: uid.value
        })
        .then(resp => {
            if(resp.data == 'Success!'){
                isFinished.value = true
                modalText.value = "Akun telah berhasil dihapus!"
            }
            else{
                isFinished.value = true
                modalText.value = "Akun gagal dihapus! Silahkan hubungi administrator jika masalah ini terus berlanjut."
            }

            emit('status', {
                isFinished: isFinished.value,
                mode: 'delete'
            })
        })
    }

    onMounted(() => {
        if(props.form == 0){
            isNewAcc.value = true
        }
        else{
            isNewAcc.value = false

            uid.value = props.form.id_user
            username.value = props.form.username
            email.value = props.form.email
            gambar.value = props.form.foto_profil
        }
    })
</script>

<template>
    <div v-if="!props.delete" class="flex flex-col h-full gap-3">
        <div class="flex gap-3 w-full">
            <div class="w-1/2">
                <div class="flex relative">
                    <p class="bg-white absolute top-[-8px] left-5 px-1 text-sm text-indigo">Username</p>
                    <div class="bg-white p-4 border-[2px] border-indigo rounded-xl flex items-center w-full gap-3">
                        <!-- <fa icon="fas fa-user" class="text-indigo" fixed-width /> -->
                        <input v-model="username" type="text" class="border-0 p-0 outline-none w-full" placeholder="Masukkan username">
                    </div>
                </div>
            </div>
            <div class="w-1/2">
                <div class="flex relative">
                    <p class="bg-white absolute top-[-8px] left-5 px-1 text-sm text-indigo">
                        Password
                    </p>
                    <div class="bg-white p-4 border-[2px] border-indigo rounded-xl flex items-center w-full gap-3">
                        <!-- <fa icon="fas fa-user" class="text-indigo" fixed-width /> -->
                        <input v-model="password" type="text" class="border-0 p-0 outline-none w-full" :placeholder="isNewAcc ? 'Masukkan password baru' : 'Kosongkan jika tidak ingin mengubah password'">
                    </div>
                </div>
            </div>
        </div>     

        <div class="flex w-full gap-3">
            <div class="w-1/2 flex relative">
                <p class="bg-white absolute top-[-8px] left-5 px-1 text-sm text-indigo">Email</p>
                <div class="bg-white p-4 border-[2px] border-indigo rounded-xl flex items-center w-full gap-3">
                    <!-- <fa icon="fas fa-user" class="text-indigo" fixed-width /> -->
                    <input v-model="email" type="text" class="border-0 p-0 outline-none w-full" placeholder="Masukkan email">
                </div>
            </div>
            <div class="w-1/2 flex relative">
                <p class="bg-white absolute top-[-8px] left-5 px-1 text-sm text-indigo">Foto profil (upload jika ingin mengubah foto profil)</p>
                <div class="bg-white p-4 border-[2px] border-indigo rounded-xl flex items-center justify-between w-full gap-3">
                    <input type="file" @change="updateFile($event.target.files)" class="border-0 p-0 outline-none w-full" placeholder="Tambahkan foto profil">

                    <img :src="gambar" class="w-1/6">
                </div>
            </div>
        </div>

        <div class="flex w-full justify-end gap-3">
            <button class="bg-blue-500 px-6 py-3 rounded-xl text-lg text-white" @click="submitAcc('add')" v-if="isNewAcc">
                Tambahkan akun
            </button>

            <button class="bg-green-600 px-6 py-3 rounded-xl text-lg text-white" @click="submitAcc('update')" v-else>
                Update akun
            </button>
        </div>
    </div>

    <div class="flex flex-col gap-8" v-else>
        <p class="text-lg">Apakah anda yakin ingin <span class="font-semibold text-red-500">menghapus</span> akun ini?</p>

        <div class="flex gap-3 items-center justify-end">
            <button class="bg-red-500 px-6 py-3 rounded-xl text-lg text-white" @click="hapusPost()">
                Hapus
            </button>
        </div>
    </div>
</template>
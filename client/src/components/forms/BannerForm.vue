<script setup>
    import { ref, watch, onMounted } from 'vue'

    import apiClient from '@/services/api'
    import { useSessionStore } from '@/stores/session';

    const emit = defineEmits(['status'])
    const props = defineProps({
        id: 0,
        delete: false
    })

    const judul = ref('')
    const gambar = ref('')

    const isFinished = ref(false)
    const modalText = ref('')

    const fileStore = ref(null)

    function updateFile(f){
        fileStore.value = f[0]
        gambar.value = URL.createObjectURL(f[0])
    }

    async function submitPost(){
        var formData = new FormData()
        
        formData.append('title', judul.value)
        formData.append('banner', fileStore.value)

        let config = {
            headers : {
                'Content-Type' : 'multipart/form-data'
            }
        }

        await apiClient.get('/sanctum/csrf-cookie')
        await apiClient.post('/api/banner/add', formData, config)
        .then(resp => {
            if(resp.data == 'Success!'){
                isFinished.value = true

                modalText.value = "Banner telah berhasil ditambahkan!"
            }
            else{
                isFinished.value = true

                modalText.value = "Banner gagal ditambahkan! Silahkan hubungi administrator jika masalah ini terus berlanjut."
            }

            emit('status', {
                isFinished: isFinished.value,
                mode: 'add'
            })
        })
    }

    async function hapusPost(){
        console.log(props.id)

        await apiClient.get('/sanctum/csrf-cookie')
        await apiClient.post('/api/banner/delete', {
            id: props.id
        })
        .then(resp => {
            if(resp.data == 'Success!'){
                isFinished.value = true
                modalText.value = "Banner telah berhasil dihapus!"
            }
            else{
                isFinished.value = true
                modalText.value = "Banner gagal dihapus! Silahkan hubungi administrator jika masalah ini terus berlanjut."
            }

            emit('status', {
                isFinished: isFinished.value,
                mode: 'delete'
            })
        })
    }
</script>

<template>
    <div v-if="!props.delete" class="flex flex-col h-full gap-6">
        <div class="w-full flex relative">
            <p class="bg-white absolute top-[-8px] left-5 px-1 text-sm text-indigo">Judul banner</p>
            <div class="bg-white p-4 border-[2px] border-indigo rounded-xl flex items-center w-full gap-3">
                <!-- <fa icon="fas fa-user" class="text-indigo" fixed-width /> -->
                <input v-model="judul" type="text" class="border-0 p-0 outline-none w-full" placeholder="Masukkan judul banner">
            </div>
        </div>

        <div class="w-full flex relative">
            <p class="bg-white absolute top-[-8px] left-5 px-1 text-sm text-indigo">Gambar banner</p>
            <div class="bg-white p-4 border-[2px] border-indigo rounded-xl flex flex-col items-center justify-between w-full gap-3">
                <!-- <fa icon="fas fa-user" class="text-indigo" fixed-width /> -->
                <img :src="gambar" class="w-1/3 max-w-1/3" v-if="gambar != ''">
                <input type="file" @change="updateFile($event.target.files)" class="border-0 p-0 outline-none w-full" placeholder="Tambahkan thumbnail gambar">
            </div>
        </div>

        <div class="flex w-full justify-end gap-3">
            <button class="bg-blue-500 px-6 py-3 rounded-xl text-lg text-white" @click="submitPost('add')">
                Upload banner
            </button>
        </div>
    </div>

    <div class="flex flex-col gap-8" v-else>
        <p class="text-lg">Apakah anda yakin ingin <span class="font-semibold text-red-500">menghapus</span> banner ini?</p>

        <div class="flex gap-3 items-center justify-end">
            <button class="bg-red-500 px-6 py-3 rounded-xl text-lg text-white" @click="hapusPost()">
                Hapus
            </button>
        </div>
    </div>
</template>
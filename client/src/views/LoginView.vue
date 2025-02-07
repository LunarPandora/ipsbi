<script setup>
    import apiClient from '@/services/api'
    import { useSessionStore } from '@/stores/session';
    import { useRouter } from 'vue-router'
    import { ref } from 'vue'

    const uname = ref("")
    const upass = ref("")

    const router = useRouter()
    const sessionStore = useSessionStore()

    async function login(){
        await apiClient.get('/sanctum/csrf-cookie')
        await apiClient.post('/login', {
            username: uname.value,
            password: upass.value
        })
        .then(resp => {
            if(resp.data[0] == 'LOGIN_SUCCESS'){
                sessionStore.registerSession(resp.data[1])

                sessionStore.authenticate()
                router.push('/dashboard')
            }
            else{
                alert('Login gagal! Silahkan cek kembali username / password anda.')
            }
        })
    }
</script>

<template>
    <div class="flex items-center justify-center w-screen h-screen bg-keppel">
        <div class="flex flex-col items-center justify-center px-8 py-16 rounded-lg bg-white gap-5 w-1/3">
            <h1 class="text-5xl font-semibold">Login</h1>
            <p class="text-gray-400 mb-7">Masukkan akun anda untuk melanjutkan</p>

            <div class="flex items-center justify-center bg-white p-4 border-2 border-keppel rounded-lg w-full gap-3">
                <fa icon="fas fa-user" fixed-width class="text-lg text-keppel" />
                <input type="text" class="w-full outline-none border-none" placeholder="Masukkan username anda..." v-model="uname" />
            </div>

            <div class="flex items-center justify-center bg-white p-4 border-2 border-keppel rounded-lg w-full gap-3">
                <fa icon="fas fa-lock" fixed-width class="text-lg text-keppel" />
                <input type="password" class="w-full outline-none border-none" placeholder="Masukkan password anda..." v-model="upass" />
            </div>

            <button class="bg-keppel rounded-lg p-4 w-full font-semibold text-xl text-white tracking-wide" @click="login()">Masuk</button>
        </div>
    </div>
</template>
<script setup>
    import apiClient from '@/services/api'
    import { ref } from 'vue'

    const uname = ref("")
    const upass = ref("")

    async function login(){
        console.log(csrfToken)

        // await apiClient.get('/api/auth')
        // .then(res => {

            // console.log(res.headers['_token'])

            // const params = {
            //     username: uname.value,
            //     password: upass.value,
            // }
            
            // apiClient.post('/login', params, {
            //     headers: {
            //         token: res.headers['_token']
            //     }
            // }).then(resp => {
            //     console.log(resp)
            // })
        // })

        // console.log(res.data)
    }
</script>

<template>
    <div class="flex items-center justify-center w-screen h-screen bg-keppel">
        <div class="flex flex-col items-center justify-center px-8 py-16 rounded-lg bg-white gap-5 w-1/3">
            <h1 class="text-5xl font-semibold">Login</h1>
            <p class="text-gray-400 mb-7">Masukkan akun anda untuk melanjutkan</p>

            <div class="flex items-center justify-center bg-white p-4 border-2 border-keppel rounded-lg w-full gap-3">
                <fa icon="fas fa-user" fixed-width class="text-lg text-keppel" />
                <input class="w-full outline-none" placeholder="Masukkan username anda..." v-model="uname" />
            </div>

            <div class="flex items-center justify-center bg-white p-4 border-2 border-keppel rounded-lg w-full gap-3">
                <fa icon="fas fa-lock" fixed-width class="text-lg text-keppel" />
                <input class="w-full outline-none" placeholder="Masukkan password anda..." v-model="upass" />
            </div>

            <button class="bg-keppel rounded-lg p-4 w-full font-semibold text-xl text-white tracking-wide" @click="login()">Masuk</button>
        </div>
    </div>
</template>
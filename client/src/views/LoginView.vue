<script setup>
    // import apiClient from '@/services/api'
    import axios from 'axios'
    import { ref } from 'vue'
    axios.defaults.withCredentials = true;
    axios.defaults.withXSRFToken = true;

    const apiClient = axios.create({
        baseURL: "https://api.ipsbi.org",
        headers: {
            "Content-Type": "application/json",
        }, 
    });

    const uname = ref("")
    const upass = ref("")

    // function getCookie(name) {
    //     const value = document.cookie
    //     const parts = value.split(name)
    //     if (parts.length === 2) {
    //         return parts.pop().split(';').shift()
    //     }
    // }

    async function login(){
        const res = await apiClient.get('/sanctum/csrf-cookie')
        // const csrfToken = getCookie('XSRF-TOKEN=')

        console.log(res)
        console.log('test')
        // const t = await apiClient.get('/auth')
        // console.log(t.data.token)

        // // const res = await apiClient.get('/login', {
        // //     params: {
        // //         username: uname,
        // //         password: upass,
        // //         // token: localStorage.getItem('token')
        // //     }
        // // })

        // const res = await apiClient.post('/login', {
        //     data: {
        //         username: uname,
        //         password: upass,
        //         // token: localStorage.getItem('token')
        //     }
        // }, {
        //     headers: {
        //         'X-CSRF-TOKEN': t.data.token
        //     }
        // });

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

            <button class="bg-keppel rounded-lg p-4 w-full font-semibold text-xl text-white tracking-wide" @click="login">Masuk</button>
        </div>
    </div>
</template>
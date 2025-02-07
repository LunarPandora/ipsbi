<script setup>
    import { onMounted } from 'vue';
    import apiClient from '@/services/api'
    import { useSessionStore } from '@/stores/session';
    import { useRoute, useRouter } from 'vue-router'

    const route = useRoute()
    const router = useRouter()
    const sessionStore = useSessionStore()

    async function logout(){
        await apiClient.get('/sanctum/csrf-cookie')
        await apiClient.post('/logout')
        .then(resp => {
            if(resp.data == 'LOGOUT_SUCCESS'){
                sessionStore.inauthenticate()
                router.push('/')
            }
            else{
                alert('Logout gagal!')
            }
        })
    }
</script>

<template>
    <div class="flex">
        <div class="flex w-1/6 sticky top-0 left-0 py-7 px-6 h-screen bg-darkTeal">
            <div class="flex flex-col w-full items-center justify-start gap-3">
                <!-- <img src="@/assets/img/IPSBI-LOGO-FINAL-WHITE.png" class="mb-4"> -->
                <p class="display font-medium text-4xl tracking-wider text-white w-full mb-10">IPSBI</p>

                <RouterLink to="/dashboard/post" :active-class="'bg-gray-700 rounded-xl p-4 flex items-center gap-3 group'" class="w-full rounded-xl p-4 flex items-center gap-3 group hover:bg-white text-white">
                    <fa icon="fas fa-newspaper" class="text-xl group-hover:text-darkTeal" />
                    <p class="group-hover:text-darkTeal">Postingan</p>
                </RouterLink>

                <RouterLink to="/dashboard/banner" :active-class="'bg-gray-700 rounded-xl p-4 flex items-center gap-3'" class="w-full rounded-xl p-4 flex items-center gap-3 group hover:bg-white text-white">
                    <fa icon="fas fa-image" class="text-xl group-hover:text-darkTeal" />
                    <p class="group-hover:text-darkTeal">Banner</p>
                </RouterLink>
                
                <RouterLink to="/dashboard/comment" :active-class="'bg-gray-700 rounded-xl p-4 flex items-center gap-3'" class="w-full rounded-xl p-4 flex items-center gap-3 group hover:bg-white text-white">
                    <fa icon="fas fa-comment" class="text-xl group-hover:text-darkTeal" />
                    <p class="group-hover:text-darkTeal">Komentar</p>
                </RouterLink>

                <RouterLink to="/dashboard/account" :active-class="'bg-gray-700 rounded-xl p-4 flex items-center gap-3'" class="w-full rounded-xl p-4 flex items-center gap-3 group hover:bg-white text-white">
                    <fa icon="fas fa-user" class="text-xl group-hover:text-darkTeal" />
                    <p class="group-hover:text-darkTeal">Akun</p>
                </RouterLink>

                <RouterLink to="/dashboard/form" :active-class="'bg-gray-700 rounded-xl p-4 flex items-center gap-3'" class="w-full rounded-xl p-4 flex items-center gap-3 group hover:bg-white text-white">
                    <fa icon="fas fa-clipboard" class="text-xl group-hover:text-darkTeal" />
                    <p class="group-hover:text-darkTeal">Form</p>
                </RouterLink>

                <div class="rounded-xl w-full p-4 flex items-center gap-3 group hover:bg-white text-white" @click="logout()">
                    <fa icon="fas fa-right-from-bracket" class="text-xl group-hover:text-darkTeal" />
                    <p class="group-hover:text-darkTeal">Logout</p>
                </div>
            </div>
        </div>

        <div class="flex w-5/6 flex-col">
            <div class="flex bg-keppel sticky top-0 right-0 h-fit p-8">
                <h1 class="text-white font-medium text-xl">Dashboard</h1>
            </div>  
            <div class="flex flex-col bg-ivory h-full p-8 gap-10">  
                <RouterView :key="route.path" />
            </div>
        </div>
    </div>
</template>
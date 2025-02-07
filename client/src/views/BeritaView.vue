<script setup>
    import { FwbPagination } from 'flowbite-vue'
    import { onMounted, ref, watch } from 'vue'

    import NewsCard from '@/components/NewsCard.vue'
    import apiClient from '@/services/api'

    const news = ref([])
    const currentPage = ref(1)
    const pageAmount = ref(1)

    async function loadNews(){
        await apiClient.get('/api/post?page=' + currentPage.value)
        .then(resp => {
            pageAmount.value = resp.data.last_page
            news.value = resp.data.data
        })
    }

    watch(currentPage, async(x, y) => {
        if(x != y){
            loadNews()
        }
    })

    onMounted(() => {
        loadNews();
    })
</script>
<template>
    <div class="px-16 py-32 bg-ivory flex flex-col items-center justify-center">
        <p class="display text-semibold text-6xl text-darkSlate">Berita Terbaru</p>
        <p class="w-3/4 text-center pt-5 text-md">Dapatkan berita terbaru mengenai IPSBI disini.</p>

        <div class="w-1/3 bg-white border-2 border-darkSlate p-3 rounded-lg mt-8 flex items-center">
            <fa icon="fas fa-search" /> 
            <input class="outline-none pl-3 w-full" placeholder="Cari berdasarkan keyword...">
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 pt-10">
            <RouterLink v-for="data in news" :to="'berita/' + data.id">
                <NewsCard :pesan="data" />
            </RouterLink>
        </div>

        <fwb-pagination class="pt-10" v-model="currentPage" :total-pages="pageAmount" :total-items="6"></fwb-pagination>
    </div>
</template>
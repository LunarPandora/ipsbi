<script setup>
    import NewsCard from '@/components/NewsCard.vue'
    import axios from 'axios'
    import { onMounted, ref } from 'vue'

    const news = ref([])

    async function loadNews(){
        await axios.get('http://localhost:8000/post')
        .then((resp) => {
            news.value = resp.data
        })
    }

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

        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 pt-10" v-for="data in news">
            <NewsCard :pesan="data" />
        </div>
    </div>
</template>
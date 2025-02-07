<script setup>
  import { ref, onMounted } from 'vue'
  import { FwbCarousel } from 'flowbite-vue'

  import NewsCard from '@/components/NewsCard.vue'
  import apiClient from '@/services/api'

  const bannerData = ref([])
  const newsData = ref([])

  async function getBannerData(){
    await apiClient.get('/api/banner?mode=all')
    .then(resp => {
      resp.data.forEach((x, i) => {
        bannerData.value.push({
          src: x.link,
          alt: x.title
        })
      })
    })
  }

  async function getNewsData(){
    await apiClient.get('/api/post?page=1')
    .then(resp => {
      newsData.value = resp.data.data
    })
  }

  onMounted(() => {
    getBannerData()
    getNewsData()
  })
</script>

<template>
  
  <div>
    <div class="px-16 py-32 bg-ivory flex flex-col items-center justify-center h-screen">
      <p class="text-6xl font-medium display text-darkSlate w-2/3 text-center leading-relaxed">
        Selamat datang di Ikatan Program Studi Bioteknologi Indonesia.
      </p>
      <p class="w-3/4 text-center pt-5 text-xl">Ikatan Program Studi Bioteknologi Indonesia merupakan himpunan atau asosiasi beberapa program studi Bioteknologi / Biologi yang memiliki kekhususan Bioteknologi dari seluruh Indonesia.</p>
      
      <div class="flex mt-5 gap-3">
        <RouterLink to="/about" class="px-7 py-4 bg-zomp text-white rounded-lg font-medium text-lg">
          Tentang Kami
        </RouterLink>
        <!-- <button class="px-7 py-4 border-2 border-zomp text-zomp rounded-lg font-medium text-lg">
          Ingin bergabung?
        </button> -->
      </div>
    </div>

    <!-- Carousel -->
    <div class="flex justify-center items-center p-16 flex-col">
      <p class="my-16 display text-medium text-5xl border-b-2 border-b-darkSlate p-5 pt-0">Berita Terkini</p>

      <FwbCarousel :pictures="bannerData" slide="true" animation="true" class="w-full" v-if="bannerData.length != 0" />

      <div class="grid grid-cols-2 md:grid-cols-3 gap-4 pt-10 bg-white">
        <NewsCard v-for="data in newsData" :pesan="data" />
      </div>

      <RouterLink class="px-7 py-4 mt-6 bg-zomp text-white rounded-lg font-medium text-lg" to="/berita">
        Baca lebih banyak
      </RouterLink>
    </div>

    <!-- QnA -->
    <div class="flex justify-center items-center p-16 flex-col bg-keppel h-[60vh]">
      <p class="display text-medium text-6xl text-white">Punya pertanyaan?</p>
      <p class="mt-10 text-white text-lg">Jika ada informasi yang kurang jelas, silahkan hubungi kami melalui cara dibawah ini</p>

      <div class="flex mt-5 gap-3">
        <button class="px-7 py-4 text-zomp bg-white rounded-lg font-medium text-lg">
          Kontak Kami
        </button>
        <!-- <button class="px-7 py-4 border-2 border-white text-white rounded-lg font-medium text-lg">
          Kirimkan pertanyaan
        </button> -->
      </div>
    </div>
  </div>
</template>

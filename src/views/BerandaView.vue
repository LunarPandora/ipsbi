<script setup>
  import { onMounted } from 'vue'
  import { initFlowbite } from 'flowbite'

  import NewsCard from '@/components/NewsCard.vue'

  onMounted(() => {
      initFlowbite();
  })
</script>

<template>
  <!-- Header -->
  <div class="px-16 py-32 bg-ivory flex flex-col items-center justify-center h-screen">
    <p class="text-6xl font-medium display text-darkSlate w-2/3 text-center leading-relaxed">
      Selamat datang di Ikatan Program Studi Bioteknologi Indonesia.
    </p>
    <p class="w-3/4 text-center pt-5 text-xl">Ikatan Program Studi Bioteknologi Indonesia merupakan himpunan atau asosiasi beberapa program studi Bioteknologi / Biologi yang memiliki kekhususan Bioteknologi dari seluruh Indonesia.</p>
    
    <div class="flex mt-5 gap-3">
      <button class="px-7 py-4 bg-zomp text-white rounded-lg font-medium text-lg">
        Tentang Kami
      </button>
      <button class="px-7 py-4 border-2 border-zomp text-zomp rounded-lg font-medium text-lg">
        Ingin bergabung?
      </button>
    </div>
  </div>

  <!-- Carousel -->
  <div class="flex justify-center items-center p-16 flex-col">
    <p class="my-16 display text-medium text-5xl border-b-2 border-b-darkSlate p-5 pt-0">Berita Terkini</p>

    <div id="default-carousel" class="relative w-full h-[80vh]" data-carousel="slide">
        <!-- Carousel wrapper -->
        <div class="relative h-56 overflow-hidden md:h-full">
            <!-- Item 1 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                <img src="@/assets/img/test.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 2 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="@/assets/img/test.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 3 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="@/assets/img/test.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 4 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="@/assets/img/test.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
            <!-- Item 5 -->
            <div class="hidden duration-700 ease-in-out" data-carousel-item>
                <img src="@/assets/img/test.png" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            </div>
        </div>
        <!-- Slider indicators -->
        <div class="absolute z-30 flex -translate-x-1/2 bottom-5 left-1/2 space-x-3 rtl:space-x-reverse">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
        </div>
        <!-- Slider controls -->
        <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 pt-10 bg-white">
      <NewsCard />
      <NewsCard />
      <NewsCard />
      <NewsCard />
      <NewsCard />
      <NewsCard />
    </div>

    <button class="px-7 py-4 mt-6 bg-zomp text-white rounded-lg font-medium text-lg">
      Baca lebih banyak
    </button>
  </div>

  <!-- QnA -->
  <div class="flex justify-center items-center p-16 flex-col bg-keppel h-[60vh]">
    <p class="display text-medium text-6xl text-white">Punya pertanyaan?</p>
    <p class="mt-10 text-white text-lg">Jika ada informasi yang kurang jelas, silahkan hubungi kami melalui cara dibawah ini</p>

    <div class="flex mt-5 gap-3">
      <button class="px-7 py-4 text-zomp bg-white rounded-lg font-medium text-lg">
        Kontak Kami
      </button>
      <button class="px-7 py-4 border-2 border-white text-white rounded-lg font-medium text-lg">
        Kirimkan pertanyaan
      </button>
    </div>
  </div>
</template>

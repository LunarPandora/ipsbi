<script setup>
    import { FwbPagination } from 'flowbite-vue'
    import { ref } from 'vue'

    import ImageCard from '@/components/ImageCard.vue'

    const currentPage = ref(1)
</script>

<template>
    <div class="flex flex-col gap-10">
        <div class="flex justify-between items-center w-full h-fit">
            <div class="flex gap-3 w-1/3">
                <input class="bg-white w-full rounded-xl px-3 py-2 border-2 border-keppel outline-none" placeholder="Cari komentar...">
                <button class="bg-zomp text-white px-4 py-2 rounded-xl">Cari</button>
            </div>
            <button class="bg-blue-500 px-4 py-2 rounded-xl text-white flex items-center h-full gap-2">
                <fa icon="fas fa-plus" fixed-width></fa>
                Tambah
            </button>
        </div>
        <div class="flex flex-col w-full">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <ImageCard />
                <ImageCard />
                <ImageCard />
                <ImageCard />
            </div>
        </div>
    </div>
</template>
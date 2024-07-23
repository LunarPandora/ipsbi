<script setup>
    const props = defineProps({
        pesan: {
            type: Object,
            default: {
                img: "https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg",
                judul: "Gambar 1",
                waktu: new Date().toLocaleDateString("id-ID"),
            }
        }
    })
</script>
<template>
    <div class="flex flex-col border-[1px] border-slate-100 bg-white">
        <!-- Gambar -->
        <img class="h-auto max-w-full" :src="pesan.img" alt="">

        <!-- Isi berita -->
        <div class="flex w-full p-5 items-center justify-between">
            <div class="flex flex-col">
                <p class="text-2xl font-semibold mb-2">{{ pesan.judul }}</p>
                <p class="text-slate-500 text-sm truncate">Ditambahkan pada {{ pesan.waktu }}</p>
            </div>

            <div class="flex gap-1">
                <button class="bg-yellow-300 p-3 rounded-lg flex gap-2 items-center justify-center">
                    <fa icon="fas fa-edit" class="text-white" fixed-width></fa>
                    <!-- <p class="text-white">Edit</p> -->
                </button>

                <button class="bg-red-500 p-3 rounded-lg flex gap-2 items-center justify-center">
                    <fa icon="fas fa-trash" class="text-white" fixed-width></fa>
                    <!-- <p class="text-white">Hapus</p> -->
                </button>
            </div>
        </div>
    </div>
</template>
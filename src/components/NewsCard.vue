<script setup>
    const props = defineProps({
        pesan: {
            type: Object,
            default: {
                img: "https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg",
                judul: "Judul Berita",
                isi: "Lorem ipsum dolor sit amet consectetur adipisicing elit. At fuga doloremque est impedit mollitia aut a. Sapiente, consequatur voluptatem. Inventore fuga voluptates sapiente cupiditate culpa eos earum veniam optio tenetur!",
                waktu: new Date().toLocaleDateString("id-ID"),
                comments: 0,
                owner: "Admin"
            }
        }
    })
</script>
<template>
    <div class="flex flex-col border-[1px] border-slate-100 bg-white">
        <!-- Gambar -->
        <img class="h-auto max-w-full" :src="pesan.img" alt="">

        <!-- Isi berita -->
        <div class="flex w-full p-5 flex-col">
            <p class="text-2xl font-semibold mb-2">{{ pesan.judul }}</p>
            <p class="text-slate-500 text-sm truncate">{{ pesan.isi }}</p>

            <!-- Detail post -->
            <div class="flex w-full justify-between items-center text-sm text-slate-400 mt-6">
                <p>{{ pesan.waktu }} | {{ pesan.comments }} Comments</p>
                <p>{{ pesan.owner }}</p>
            </div>
        </div>
    </div>
</template>
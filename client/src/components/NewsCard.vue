<script setup>
    const props = defineProps({
        pesan: {
            type: Object,
            default: {
                foto_post: "https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg",
                judul: "Judul Berita",
                url_isi: "Lorem ipsum dolor sit amet consectetur adipisicing elit. At fuga doloremque est impedit mollitia aut a. Sapiente, consequatur voluptatem. Inventore fuga voluptates sapiente cupiditate culpa eos earum veniam optio tenetur!",
                comments_count: 0,
                id_penulis: "Admin"
            }
        }
    })

    console.log(new Date(Date.parse(props.pesan.created_at)))
</script>
<template>
    <div class="flex flex-col border-[1px] border-slate-100 bg-white">
        <!-- Gambar -->
        <img class="h-auto max-w-full" :src="pesan.foto_post" alt="">

        <!-- Isi berita -->
        <div class="flex w-full p-5 flex-col">
            <p class="text-2xl font-semibold mb-2">{{ pesan.judul }}</p>
            <p class="text-slate-500 text-sm truncate">{{ pesan.url_isi }}</p>

            <!-- Detail post -->
            <div class="flex w-full justify-between items-center text-sm text-slate-400 mt-6">
                <p>{{ new Date(pesan.created_at).toLocaleDateString("id-ID") }} | {{ pesan.comments_count }} Comments</p>
                <p>{{ pesan.username }}</p>
            </div>
        </div>
    </div>
</template>
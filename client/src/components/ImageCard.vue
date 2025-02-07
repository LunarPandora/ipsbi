<script setup>
    import DateFormatter from '@/services/date.js'

    const emit = defineEmits(['ondelete'])

    const props = defineProps({
        data: {
            type: Object
        }
    })
</script>
<template>
    <div class="flex flex-col border-[1px] border-slate-100 bg-white">
        <!-- Gambar -->
        <img class="h-56 object-cover max-w-full" :src="'https://api.ipsbi.org/public/banners/' + data.link" :alt="data.title">

        <!-- Isi berita -->
        <div class="flex w-full p-5 items-center justify-between">
            <div class="flex flex-col w-2/3 overflow-hidden text-ellipsis">
                <p class="text-2xl font-semibold mb-2 overflow-hidden text-ellipsis">{{ data.title }}</p>
                <p class="text-slate-500 text-sm truncate">{{ new DateFormatter(data.created_at).format() }}</p>
            </div>

            <div class="flex gap-1">
                <button class="bg-red-500 p-3 rounded-lg flex gap-2 items-center justify-center" @click="emit('ondelete', data.id_banner)">
                    <fa icon="fas fa-trash" class="text-white" fixed-width></fa>
                </button>
            </div>
        </div>
    </div>
</template>
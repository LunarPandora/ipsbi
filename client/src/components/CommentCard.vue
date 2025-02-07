<script setup>
    import DateFormatter from '@/services/date.js'

    const props = defineProps({
        data: {
            type: Object,
            default: {
                nama: 'Test',
                email: 'test@gmail.com',
                foto: "@/assets/img/user.png",
                isi_komentar: "Ini adalah komentar!",
                created_at: 0,
            }
        }
    })
</script>
<template>
    <div class="flex gap-3 items-start">
        <img src="@/assets/img/user.png" class="w-[50px] rounded-full border-2" />
        <div class="flex flex-col w-full gap-[2px]">
            <div class="flex gap-2 items-center">
                <p class="text-lg font-semibold">{{ data.nama }}</p>
                <p class="text-sm text-gray-400">- {{ new DateFormatter(data.created_at).format() }}</p>
            </div>
            <p class="text-sm">{{ data.isi_komentar }}</p>
        </div>
    </div>
</template>
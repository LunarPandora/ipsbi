<script setup>
    import { FwbPagination } from 'flowbite-vue'
    import { ref, onMounted, watch } from 'vue'

    import apiClient from '@/services/api'
    import DateFormatter from '@/services/date.js'

    import ImageCard from '@/components/ImageCard.vue'

    const commentData = ref([])
    const currentPage = ref(1)
    const pageAmount = ref(1)
    const startNumber = ref(1)

    const searchQuery = ref('')

    const selectedID = ref(0)
    const modal = ref(false)

    async function searchComment(){
        await apiClient.get('/api/com/search?page=' + currentPage.value + '&search_query=' + searchQuery.value)
        .then(resp => {
            startNumber.value = resp.data.from
            pageAmount.value = resp.data.last_page
            commentData.value = resp.data.data
        })
    }

    async function getCommentData(){
        await apiClient.get('/api/com?page=' + currentPage.value)
        .then(resp => {
            startNumber.value = resp.data.from
            pageAmount.value = resp.data.last_page
            commentData.value = resp.data.data
        })
    }
    async function hapusPost(){
        await apiClient.get('/api/com/delete?id=' + selectedID.value)
        .then(resp => {
            console.log(resp)
        })
    }

    function toggleModal(id){
        modal.value = !modal.value

        selectedID.value = id
    }

    watch(currentPage, async(x, y) => {
        if(x != y){
            getCommentData()
        }
    })

    onMounted(() => {
        getCommentData()
    })
</script>

<template>
    <div class="flex flex-col gap-10">
        <div class="flex justify-between items-center w-full h-fit">
            <div class="flex gap-3 w-1/3">
                <input v-model="searchQuery" class="bg-white w-full rounded-xl px-3 py-2 border-2 border-keppel outline-none" placeholder="Cari nama komentator atau komentar...">
                <button class="bg-zomp text-white px-4 py-2 rounded-xl" @click="searchComment()">Cari</button>
            </div>
        </div>
        <div class="flex flex-col w-full">
            <table class="table-auto">
                <thead class="bg-keppel text-white">
                    <tr>
                        <th class="p-3 font-semibold tracking-wide rounded-ss-xl">No.</th>
                        <th class="p-3 font-semibold tracking-wide text-left">Komentator</th>
                        <th class="p-3 font-semibold tracking-wide text-left">Komentar</th>
                        <th class="p-3 font-semibold tracking-wide text-left">Post terkait</th>
                        <th class="p-3 font-semibold tracking-wide text-left">Dikirim tanggal</th>
                        <th class="p-3 font-semibold tracking-wide rounded-se-xl text-left"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b-2 border-gray-100" v-for="(data, index) in commentData" v-if="commentData.length != 0">
                        <td class="p-3 bg-white tracking-wide text-center">
                            <p class="text-sm">{{ startNumber + index }}</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">{{ data.nama }}</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm text-pretty overflow-hidden text-ellipsis w-[20em] line-clamp-3">{{ data.isi_komentar }}</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm text-pretty overflow-hidden text-ellipsis w-[20em] line-clamp-3">{{ data.judul }}</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">{{ new DateFormatter(data.created_at).format() }}</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide flex gap-1">
                            <button @click="toggleModal(data.id)" class="bg-red-500 p-3 rounded-lg flex gap-2 items-center justify-center">
                                <fa icon="fas fa-trash" class="text-white" fixed-width></fa>
                            </button>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-gray-100" v-else>
                        <td colspan="6" class="p-16 bg-white tracking-wide text-center text-gray-400">
                            <fa icon="fas fa-circle-xmark" class="text-5xl"></fa>
                            <p class="text-lg pt-3">Tidak ada komentar!</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <fwb-pagination v-model="currentPage" :total-pages="pageAmount" :total-items="6" v-if="commentData.length != 0"></fwb-pagination>
    </div>

    <div class="items-center justify-center w-screen h-screen bg-[#000000AA] z-50 absolute top-0 left-0" :class="modal ? 'flex' : 'hidden'">
        <div class="flex flex-col bg-white px-5 py-7 rounded-xl gap-4 w-1/3 justify-center">
            <div class="flex w-full items-center justify-between pb-6">
                <p class="text-2xl font-semibold">Hapus postingan</p>

                <fa @click="toggleModal(0)" icon="fas fa-times" class="text-black text-2xl" fixed-width></fa>
            </div>

            <div class="flex flex-col gap-8">
                <p class="text-lg">Apakah anda yakin ingin <span class="font-bold text-red-500">menghapus</span> komentar ini?</p>

                <div class="flex gap-3 items-center justify-end">
                    <button class="bg-gray-400 px-6 py-3 rounded-xl text-lg text-white" @click="toggleModal(0)">
                        Kembali
                    </button>
                    <button class="bg-red-500 px-6 py-3 rounded-xl text-lg text-white" @click="hapusPost()">
                        Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
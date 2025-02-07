<script setup>
    import { FwbPagination } from 'flowbite-vue'
    import { ref, onMounted, watch } from 'vue'

    import PostinganForm from '@/components/forms/PostinganForm.vue';

    import DateFormatter from '@/services/date.js'
    import apiClient from '@/services/api'

    const userData = ref([])
    const currentPage = ref(1)
    const pageAmount = ref(1)
    const startNumber = ref(1)

    const dataForm = ref(null)
    const modal = ref({
        form: {
            // Modal untuk isi dan konfirmasi
            isShowing: false,
            type: 'Tambah',
        },
        confirmation: {
            // Modal untuk konfirmasi eksekusi perintah
            isShowing: false,
            type: 'Tambah'
        }
    })

    async function getData(){
        await apiClient.get('/api/post?page=' + currentPage.value)
        .then(resp => {
            startNumber.value = resp.data.from
            pageAmount.value = resp.data.last_page
            userData.value = resp.data.data
        })
    }

    function toggleModal(data, type, format, isOpen){
        modal.value.form.isShowing = false
        modal.value.confirmation.isShowing = false

        if(format == 'form'){
            modal.value.form.isShowing = isOpen
            modal.value.form.type = type
        }
        else if(format == 'confirmation'){
            modal.value.confirmation.isShowing = isOpen
            modal.value.confirmation.type = type
        }

        dataForm.value = data
    }

    function updateModalStatus(respon){
        if(respon.isFinished){
            if(respon.mode == 'add'){
                toggleModal(0, 'Tambah', 'form', false)
                toggleModal(0, 'Tambah', 'confirmation', true)
            }
            else if(respon.mode == 'update'){
                toggleModal(0, 'Edit', 'form', false)
                toggleModal(0, 'Edit', 'confirmation', true)
            }
            else if(respon.mode == 'delete'){
                toggleModal(0, 'Hapus', 'form', false)
                toggleModal(0, 'Hapus', 'confirmation', true)
            }

            getData()
        }
    }

    watch(currentPage, async(x, y) => {
        if(x != y){
            getData()
        }
    })

    onMounted(() => {
        getData()
    })
</script>

<template>
    <div class="flex flex-col gap-10">
        <div class="flex justify-between items-center w-full h-fit">
            <div class="flex gap-3 w-1/3">
                <input class="bg-white w-full rounded-xl px-3 py-2 border-2 border-keppel outline-none" placeholder="Cari postingan...">
                <button class="bg-zomp text-white px-4 py-2 rounded-xl">Cari</button>
            </div>
            <button class="bg-blue-500 px-4 py-2 rounded-xl text-white flex items-center h-full gap-2" @click="toggleModal(0, 'Tambah', 'form', true)">
                <fa icon="fas fa-plus" fixed-width></fa>
                Tambah
            </button>
        </div>
        <div class="flex flex-col w-full">
            <table class="table-auto">
                <thead class="bg-keppel text-white">
                    <tr>
                        <th class="p-3 font-semibold tracking-wide rounded-ss-xl">No.</th>
                        <th class="p-3 font-semibold tracking-wide text-left">Judul</th>
                        <th class="p-3 font-semibold tracking-wide text-left">Penulis</th>
                        <th class="p-3 font-semibold tracking-wide text-left">Kategori</th>
                        <th class="p-3 font-semibold tracking-wide text-left">Tag</th>
                        <th class="p-3 font-semibold tracking-wide text-left">Komentar</th>
                        <th class="p-3 font-semibold tracking-wide text-left">Tanggal post</th>
                        <th class="p-3 font-semibold tracking-wide rounded-se-xl text-left"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b-2 border-gray-100" v-for="(data, index) in userData" v-if="userData.length != 0">
                        <td class="p-3 bg-white tracking-wide text-center">
                            <p class="text-sm">{{ startNumber + index }}</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm text-pretty overflow-hidden text-ellipsis w-[20em] line-clamp-3">{{ data.judul }}</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">{{ data.username }}</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">{{ data.nama }}</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">{{ data.tag }}</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">Komentar ({{ data.comments_count }})</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">{{ new DateFormatter(data.created_at).format() }}</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide flex gap-1">
                            <button class="bg-yellow-300 p-3 rounded-lg flex gap-2 items-center justify-center" @click="toggleModal(data, 'Edit', 'form', true)">
                                <fa icon="fas fa-edit" class="text-white" fixed-width></fa>
                            </button>

                            <button class="bg-red-500 p-3 rounded-lg flex gap-2 items-center justify-center" @click="toggleModal(data, 'Hapus', 'form', true)">
                                <fa icon="fas fa-trash" class="text-white" fixed-width></fa>
                            </button>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-gray-100" v-else>
                        <td colspan="8" class="p-16 bg-white tracking-wide text-center text-gray-400">
                            <fa icon="fas fa-circle-xmark" class="text-5xl"></fa>
                            <p class="text-lg pt-3">Tidak ada postingan!</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <fwb-pagination v-model="currentPage" :total-pages="pageAmount" :total-items="6" v-if="userData.length != 0"></fwb-pagination>
    </div>

    <div class="flex items-center justify-center w-screen h-screen bg-[#000000AA] z-50 absolute top-0 left-0" v-if="modal.form.isShowing">
        <div class="flex flex-col bg-white px-5 py-7 rounded-xl gap-4 w-[90%] h-[90%] justify-center" v-if="modal.form.type != 'Hapus'">
            <div class="flex w-full items-center justify-between pb-6">
                <p class="text-2xl font-semibold">{{ modal.form.type }} postingan</p>

                <fa @click="toggleModal(0, modal.form.type, 'form', false)" icon="fas fa-times" class="text-black text-2xl" fixed-width></fa>
            </div>

            <PostinganForm :form="dataForm" v-if="modal.form.type != 'Hapus'" @status="(respon) => updateModalStatus(respon)" :delete='false' />
        </div>

        <div class="flex flex-col bg-white px-5 py-7 rounded-xl gap-4 w-1/3 justify-center" v-else>
            <div class="flex w-full items-center justify-between pb-6">
                <p class="text-2xl font-semibold">Hapus postingan</p>

                <fa @click="toggleModal(0, modal.form.type, 'form', false)" icon="fas fa-times" class="text-black text-2xl" fixed-width></fa>
            </div>

            <PostinganForm :form="dataForm" v-if="modal.form.type == 'Hapus'" @status="(respon) => updateModalStatus(respon)" :delete='true' />
        </div>
    </div>

    <div class="flex items-center justify-center w-screen h-screen bg-[#000000AA] z-50 absolute top-0 left-0" v-if="modal.confirmation.isShowing">
        <div class="flex flex-col bg-white px-5 py-7 rounded-xl gap-4 w-1/3 justify-center">
            <div class="flex w-full items-center justify-between pb-6">
                <p class="text-2xl font-semibold">{{ modal.confirmation.type }} postingan</p>

                <fa @click="toggleModal(0, modal.form.type, 'form', false)" icon="fas fa-times" class="text-black text-2xl" fixed-width></fa>
            </div>

            <div class="flex flex-col gap-8">
                <p class="text-lg">Postingan telah berhasil 
                    {{ modal.confirmation.type == 'Tambah' ? 'ditambahkan!' : 
                        modal.confirmation.type == 'Edit' ? 'diperbarui!' :
                        'dihapus!'
                    }}
                </p>

                <div class="flex gap-3 items-center justify-end">
                    <button class="bg-gray-400 px-6 py-3 rounded-xl text-lg text-white" @click="toggleModal(0, modal.confirmation.type, 'confirmation', false)">
                        Kembali
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { FwbPagination } from 'flowbite-vue'

    import { ref, onMounted, watch } from 'vue'
    import apiClient from '@/services/api'

    import ImageCard from '@/components/ImageCard.vue'

    import BannerForm from '@/components/forms/BannerForm.vue';

    const bannerData = ref([])
    const currentPage = ref(1)
    const pageAmount = ref(1)

    const currentID = ref(0)

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

    async function getBannerData(){
        await apiClient.get('/api/banner?page=' + currentPage.value)
        .then(resp => {
            pageAmount.value = resp.data.last_page
            bannerData.value = resp.data.data
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

        currentID.value = data
    }

    function updateModalStatus(respon){
        console.log(respon)

        if(respon.isFinished){
            if(respon.mode == 'add'){
                toggleModal(0, 'Tambah', 'form', false)
                toggleModal(0, 'Tambah', 'confirmation', true)
            }
            else if(respon.mode == 'delete'){
                toggleModal(0, 'Hapus', 'form', false)
                toggleModal(0, 'Hapus', 'confirmation', true)
            }

            getBannerData()
        }
    }

    watch(currentPage, async(x, y) => {
        if(x != y){
            getBannerData()
        }
    })

    onMounted(() => {
        getBannerData()
    })
</script>

<template>
    <div class="flex flex-col gap-10">
        <div class="flex justify-between items-center w-full h-fit">
            <div class="flex gap-3 w-1/3">
                <input class="bg-white w-full rounded-xl px-3 py-2 border-2 border-keppel outline-none" placeholder="Cari judul banner...">
                <button class="bg-zomp text-white px-4 py-2 rounded-xl">Cari</button>
            </div>
            <button class="bg-blue-500 px-4 py-2 rounded-xl text-white flex items-center h-full gap-2" @click="toggleModal(0, 'Tambah', 'form', true)">
                <fa icon="fas fa-plus" fixed-width></fa>
                Tambah
            </button>
        </div>
        <div class="flex flex-col w-full" v-if="bannerData.length != 0">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                <ImageCard v-for="data in bannerData" :data="data" @ondelete="(id) => toggleModal(id, 'Hapus', 'form', true)"  />
            </div>

            <fwb-pagination class="pt-10" v-model="currentPage" :total-pages="pageAmount" :total-items="6"></fwb-pagination>
        </div>

        <div class="flex flex-col items-center justify-center gap-6 w-full p-32 text-gray-400" v-else>
            <fa icon="fas fa-circle-xmark" class="text-5xl"></fa>
            <p class="text-lg">Tidak ada banner!</p>
        </div>
    </div>

    <div class="flex items-center justify-center w-screen h-screen bg-[#000000AA] z-50 absolute top-0 left-0" v-if="modal.form.isShowing">
        <div class="flex flex-col bg-white px-5 py-7 rounded-xl gap-4 w-[70%] justify-center" v-if="modal.form.type != 'Hapus'">
            <div class="flex w-full items-center justify-between pb-6">
                <p class="text-2xl font-semibold">Tambah banner</p>

                <fa @click="toggleModal(0, 'Tambah', 'form', false)" icon="fas fa-times" class="text-black text-2xl" fixed-width></fa>
            </div>

            <BannerForm :id="currentID" v-if="modal.form.type != 'Hapus'" @status="(respon) => updateModalStatus(respon)" :delete='false' />
        </div>

        <div class="flex flex-col bg-white px-5 py-7 rounded-xl gap-4 w-1/3 justify-center" v-else>
            <div class="flex w-full items-center justify-between pb-6">
                <p class="text-2xl font-semibold">Hapus banner</p>

                <fa @click="toggleModal(0, 'Hapus', 'form', false)" icon="fas fa-times" class="text-black text-2xl" fixed-width></fa>
            </div>

            <BannerForm :id="currentID" v-if="modal.form.type == 'Hapus'" @status="(respon) => updateModalStatus(respon)" :delete='true' />
        </div>
    </div>

    <div class="flex items-center justify-center w-screen h-screen bg-[#000000AA] z-50 absolute top-0 left-0" v-if="modal.confirmation.isShowing">
        <div class="flex flex-col bg-white px-5 py-7 rounded-xl gap-4 w-1/3 justify-center">
            <div class="flex w-full items-center justify-between pb-6">
                <p class="text-2xl font-semibold">{{ modal.confirmation.type }} banner</p>

                <fa @click="toggleModal(0, modal.form.type, 'form', false)" icon="fas fa-times" class="text-black text-2xl" fixed-width></fa>
            </div>

            <div class="flex flex-col gap-8">
                <p class="text-lg">Banner telah berhasil 
                    {{ modal.confirmation.type == 'Tambah' ? 'ditambahkan!' : 'dihapus!'
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
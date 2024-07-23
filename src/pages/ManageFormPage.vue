<script setup>
    import { FwbPagination } from 'flowbite-vue'
    import { ref } from 'vue'

    const currentPage = ref(1)
</script>

<template>
    <div class="flex flex-col gap-10">
        <div class="flex justify-between items-center w-full h-fit">
            <div class="flex gap-3 w-1/3">
                <input class="bg-white w-full rounded-xl px-3 py-2 border-2 border-keppel outline-none" placeholder="Cari form...">
                <button class="bg-zomp text-white px-4 py-2 rounded-xl">Cari</button>
            </div>
            <button class="bg-blue-500 px-4 py-2 rounded-xl text-white flex items-center h-full gap-2">
                <fa icon="fas fa-plus" fixed-width></fa>
                Tambah
            </button>
        </div>
        <div class="flex flex-col w-full">
            <table class="table-auto">
                <thead class="bg-keppel text-white">
                    <tr>
                        <th class="p-3 font-semibold tracking-wide rounded-ss-xl">No.</th>
                        <th class="p-3 font-semibold tracking-wide text-left">Judul Form</th>
                        <th class="p-3 font-semibold tracking-wide text-left">Responden</th>
                        <th class="p-3 font-semibold tracking-wide text-left">Dibuat oleh</th>
                        <th class="p-3 font-semibold tracking-wide text-left">Dibuat pada</th>
                        <th class="p-3 font-semibold tracking-wide rounded-se-xl text-left"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b-2 border-gray-100">
                        <td class="p-3 bg-white tracking-wide text-center">
                            <p class="text-sm">1</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">Pendaftaran Keanggotaan IPSBI untuk Institusi</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">0 responden</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">Admin 1</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">Senin, 12 Oktober 2024</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide flex gap-1">
                            <button class="bg-green-500 p-3 rounded-lg flex gap-2 items-center justify-center">
                                <fa icon="fas fa-envelope" class="text-white" fixed-width></fa>
                                <!-- <p class="text-white">Edit</p> -->
                            </button>

                            <button class="bg-yellow-300 p-3 rounded-lg flex gap-2 items-center justify-center">
                                <fa icon="fas fa-edit" class="text-white" fixed-width></fa>
                                <!-- <p class="text-white">Edit</p> -->
                            </button>

                            <button class="bg-red-500 p-3 rounded-lg flex gap-2 items-center justify-center">
                                <fa icon="fas fa-trash" class="text-white" fixed-width></fa>
                                <!-- <p class="text-white">Hapus</p> -->
                            </button>
                        </td>
                    </tr>
                    <tr class="border-b-2 border-gray-100">
                        <td class="p-3 bg-white tracking-wide text-center">
                            <p class="text-sm">2</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">Pendaftaran Keanggotaan IPSBI untuk Individu</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">0 responden</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">Admin 2</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide">
                            <p class="text-sm">Senin, 12 Oktober 2024</p>
                        </td>
                        <td class="p-3 bg-white tracking-wide flex gap-1">
                            <RouterLink to="/dashboard/form/idform/responses">
                                <button class="bg-green-500 p-3 rounded-lg flex gap-2 items-center justify-center">
                                    <fa icon="fas fa-envelope" class="text-white" fixed-width></fa>
                                    <!-- <p class="text-white">Edit</p> -->
                                </button>
                            </RouterLink>

                            <button class="bg-yellow-300 p-3 rounded-lg flex gap-2 items-center justify-center">
                                <fa icon="fas fa-edit" class="text-white" fixed-width></fa>
                                <!-- <p class="text-white">Edit</p> -->
                            </button>

                            <button class="bg-red-500 p-3 rounded-lg flex gap-2 items-center justify-center">
                                <fa icon="fas fa-trash" class="text-white" fixed-width></fa>
                                <!-- <p class="text-white">Hapus</p> -->
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <fwb-pagination v-model="currentPage" :total-items="100"></fwb-pagination>
    </div>
</template>
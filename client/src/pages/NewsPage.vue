<script setup>
  import { ref, onMounted, watch } from 'vue'
  import { useRoute } from 'vue-router'
  import { FwbPagination } from 'flowbite-vue'

  import apiClient from '@/services/api'

  import CommentCard from '@/components/CommentCard.vue'

  const route = useRoute()
  const html = ref()

  const post = ref('')
  const kategori = ref('')
  const author = ref('')

  const nama = ref('')
  const email = ref('')
  const komentar = ref('')

  const jumlahKomentar = ref(0)
  const commentList = ref([])

  const commentData = ref([])
  const currentPage = ref(1)
  const pageAmount = ref(1)
  const startNumber = ref(1)

  const modal = ref(false)
  const pesanNotifikasi = ref('')

  onMounted(() => {
    getNews()
    getComments()
  })

  function toggleModal(){
    modal.value = !modal.value

    getComments()
  }

  async function getComments(){
    await apiClient.get("/api/com/get?idp=" + route.params.id + "&page=" + currentPage.value)
    .then(resp => {
      startNumber.value = resp.data.from
      pageAmount.value = resp.data.last_page
      commentList.value = resp.data.data
      jumlahKomentar.value = resp.data.total
    })
  }

  async function getNews(){
    await apiClient.get("/api/post/get?id=" + route.params.id)
    .then(resp => {
      post.value = resp.data[0]
      author.value = resp.data[1]
      kategori.value = resp.data[2]

      apiClient.get("/api/post/getpage?url=" + resp.data[0].url_isi.split('.')[0])
      .then(x => {
        html.value = x.data
      })
    })
  }             

  async function addComments(){
    await apiClient.get('/sanctum/csrf-cookie')
    await apiClient.post('/api/com/add', {
      idp: route.params.id,
      komentar: komentar.value,
      nama: nama.value,
      email: email.value  
    })
    .then(resp => {
      if(resp.data == 'Success!'){
        pesanNotifikasi.value = 'Komentar anda berhasil ditambahkan!'
      }
      else{
        pesanNotifikasi.value = 'Komentar anda gagal ditambahkan! Silahkan hubungi kami jika masalah terus berlanjut.'
      }

      toggleModal()
    })
  }

  watch(currentPage, async(x, y) => {
      if(x != y){
          getComments()
      }
  })
</script>
<template>
  <div class="flex flex-col items-center justify-center w-full py-36 px-40 gap-10">
    <div class="flex items-center justify-center">
      <img :src="post.foto_post" class="w-3/5" />
    </div>

    <div class="flex flex-col w-full items-center justify-center gap-4">
      <p class="text-5xl font-semibold">{{ post.judul }}</p>
      <p class="italic text-gray-400">Ditulis oleh {{ author }} -  {{ new Date(post.created_at).toLocaleDateString("id-ID") }}</p>
      <span class="bg-green-200 px-3 py-1 rounded-lg text-green-600 font-semibold">{{ kategori }}</span>
    </div>

    <div class="w-full pt-20" v-html="html"></div>

    <div class="w-full pt-16 pb-5">
      <div class="flex items-center gap-4">
        <p class="text-2xl font-semibold w-2/12">Komentar ({{ jumlahKomentar }})</p>
        <hr class="w-full border-[1px]">
      </div>

      <div class="w-full">
        <div class="flex flex-col gap-6 pt-5">
          <CommentCard v-for="x in commentList" :data="x" />
        </div>
        <fwb-pagination class="pt-10" v-model="currentPage" :total-pages="pageAmount" :total-items="5"></fwb-pagination>
      </div>

      <div class="w-full flex flex-col pt-10 gap-4">
        <p class="text-xl font-medium">Tambahkan komentar anda</p>
        <textarea v-model="komentar" class="rounded-lg resize-none h-[150px]" placeholder="Masukkan komentar anda disini..."></textarea>
        <div class="w-full flex justify-between">
          <div class="w-1/2 flex gap-3">
            <div class="w-full flex relative">
                <p class="bg-white absolute top-[-8px] left-5 px-1 text-sm text-indigo">Nama</p>
                <div class="bg-white p-4 border-[2px] border-indigo rounded-xl flex items-center w-full gap-3">
                    <input v-model="nama" type="text" class="border-0 p-0 outline-none w-full" placeholder="Masukkan nama anda (Wajib)">
                </div>
            </div>
            
            <div class="w-full flex relative">
                <p class="bg-white absolute top-[-8px] left-5 px-1 text-sm text-indigo">Email</p>
                <div class="bg-white p-4 border-[2px] border-indigo rounded-xl flex items-center w-full gap-3">
                    <input v-model="email" type="text" class="border-0 p-0 outline-none w-full" placeholder="Masukkan email anda (Wajib)">
                </div>
            </div>
          </div>
          <button @click="addComments()" class="bg-keppel rounded-lg py-3 px-5 font-medium text-lg text-white tracking-wide">Publikasikan</button>
        </div>
      </div>
    </div>
  </div>

  <div class="items-center justify-center w-screen h-screen bg-[#000000AA] z-50 fixed top-0 left-0" :class="modal ? 'flex' : 'hidden'">
    <div class="flex flex-col bg-white px-5 py-7 rounded-xl gap-4 w-1/3 justify-center">
      <div class="flex w-full items-center justify-between pb-6">
        <p class="text-2xl font-semibold">Notifikasi</p>

        <fa @click="toggleModal()" icon="fas fa-times" class="text-black text-2xl" fixed-width></fa>
      </div>

      <div class="flex flex-col gap-8">
        <p class="text-lg">{{ pesanNotifikasi }}</p>

        <div class="flex gap-3 items-center justify-end">
          <button class="bg-gray-400 px-6 py-3 rounded-xl text-lg text-white" @click="toggleModal()">
            Kembali
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
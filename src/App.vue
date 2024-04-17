<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Footer from '@/components/Footer.vue'

import { ref, onMounted } from 'vue'
const y = ref(0)
const dropdown = ref(false)

function updateScroll(){
  y.value = window.scrollY
  // console.log(y.value)
}

function hideDropdownContent(){
  document.getElementById("dropdown").childNodes.forEach((elm, i) => {
    elm.classList.remove("flex", "h-full");
    elm.classList.add("hidden");
  })
  
  document.getElementById("dropdown").classList.add("hidden")
  
  setTimeout(() =>{
    dropdown.value = false
  }, 200)
}

function showDropdownContent(el){
  document.getElementById("dropdown").classList.add("h-full")
  document.getElementById("dropdown").classList.remove("hidden")

  dropdown.value = true

  document.getElementById("dropdown").childNodes.forEach((elm, i) => {
    elm.classList.add("hidden");
  })

  document.getElementById(el).classList.remove("hidden")
  document.getElementById(el).classList.add("flex")
}

onMounted(() => {   
  window.addEventListener('scroll', updateScroll)
})
</script>

<template>
  <div class="flex flex-col w-full px-16 py-7 fixed top-0 left-0 z-50 transition-all" :class="{'bg-white shadow-md rounded-b-3xl' : y > 50 || dropdown}" id="navbar" @mouseleave="hideDropdownContent()">
    <div class="flex w-full justify-between items-center">
      <div>
        <p class="display font-medium text-4xl tracking-wider text-darkSlate">IPSBI</p>
      </div>
      <div class="flex gap-7">
        <RouterLink to="/">Beranda</RouterLink>
        <RouterLink to="/about">Tentang Kami</RouterLink>
        <RouterLink to="/berita">Berita</RouterLink>
        <p @mouseover="showDropdownContent('mbkm')">MBKM</p>
        <p @mouseover="showDropdownContent('registrasi')">Registrasi</p>
      </div>
    </div>

    <!-- MBKM -->
    <div class="w-full transition-all" id="dropdown">
      <div class="w-full pt-10 mb-2 hidden" id="mbkm">
        <div class="flex flex-col w-1/3">
          <img src="@/assets/img/logo_mbkm.png" class="w-1/3 mb-5">

          <div class="flex flex-col gap-3">
            <p class="text-xl font-semibold">Merdeka Belajar Kampus Merdeka</p>
            <p class="text-sm leading-relaxed">Sebuah inovasi yang dibuat oleh Kemendikbudristek dan diluncurkan sebuah kebijakan untuk mentransformasi sistem Pendidikan tinggi di Indonesia untuk menghasilkan lulusan yang lebih relevan.</p>
          </div>
        </div>

        <div class="flex flex-col w-1/3 *:p-3 *:font-medium">
          <p class="align-middle">
            <fa icon="fas fa-chevron-right" class="text-xs mr-2" />
            Pertukaran Pelajar
          </p>
          <p class="align-middle">
            <fa icon="fas fa-chevron-right" class="text-xs mr-2" />
            Magang / Praktik Kerja
          </p>
          <p class="align-middle">
            <fa icon="fas fa-chevron-right" class="text-xs mr-2" />
            Penelitian
          </p>
          <p class="align-middle">
            <fa icon="fas fa-chevron-right" class="text-xs mr-2" />
            Proyek Kemanusiaan
          </p>
        </div>

        <div class="flex flex-col w-1/3 *:p-3 *:font-medium">
          <p class="align-middle">
            <fa icon="fas fa-chevron-right" class="text-xs mr-2" />
            Kegiatan Wirausaha
          </p>
          <p class="align-middle">
            <fa icon="fas fa-chevron-right" class="text-xs mr-2" />
            Studi / Proyek Independen
          </p>
          <p class="align-middle">
            <fa icon="fas fa-chevron-right" class="text-xs mr-2" />
            Asistensi Mengajar di Satuan Pendidikan
          </p>
          <p class="align-middle">
            <fa icon="fas fa-chevron-right" class="text-xs mr-2" />
            Membangun Desa / Kuliah Kerja Nyata Tematik
          </p>
        </div>
      </div>
      
      <div class="w-full pt-10 mb-2 hidden" id="registrasi">
        <div class="flex flex-col w-1/3">
          <img src="@/assets/img/IPSBI-LOGO-FINAL.png" class="w-1/3 mb-5">

          <div class="flex flex-col gap-3">
            <p class="text-xl font-semibold">Ikatan Program Studi Bioteknologi Indonesia</p>
            <p class="text-sm leading-relaxed">IPSBI atau Ikatan Program Studi Bioteknologi Indonesia merupakan himpunan atau asosiasi beberapa program studi Bioteknologi/ Biologi yang memiliki kekhususan Bioteknologi dari seluruh Indonesia.</p>
          </div>
        </div>

        <div class="flex flex-col w-1/3 *:p-3 *:font-medium">
          <p class="align-middle">
            <div class="flex items-center justify-center w-12 h-12 bg-green-200 rounded-md text-green-700 text-2xl">
              <fa icon="fas fa-school" />
            </div>
            <p class="font-semibold text-lg mt-3">Pendaftaran Keanggotaan IPSBI untuk Institusi</p>
            <p class="mb-5">Daftarkan institusi anda dalam keanggotaan IPSBI dan ikut bergabung bersama kami.</p>

            <RouterLink to="/registrasi/1" class="px-5 py-3 bg-zomp text-white rounded-md font-medium text-md align-middle">
              Daftar disini 
              <fa icon="fas fa-chevron-right fa-fw" class="text-xs ml-2" />
            </RouterLink>
          </p>
        </div>

        <div class="flex flex-col w-1/3 *:p-3 *:font-medium">
          <p class="align-middle">
            <div class="flex items-center justify-center w-12 h-12 bg-green-200 rounded-md text-green-700 text-2xl">
              <fa icon="fas fa-user" />
            </div>
            <p class="font-semibold text-lg mt-3">Pendaftaran Keanggotaan IPSBI untuk Individu</p>
            <p class="mb-5">Daftarkan diri anda dalam keanggotaan IPSBI dan ikut bergabung bersama kami.</p>

            <RouterLink to="/registrasi/2" class="px-5 py-3 bg-zomp text-white rounded-md font-medium text-md align-middle">
              Daftar disini 
              <fa icon="fas fa-chevron-right fa-fw" class="text-xs ml-2" />
            </RouterLink>
          </p>
        </div>
      </div>
    </div>

    
  </div>

  <RouterView />

  <Footer />
</template>
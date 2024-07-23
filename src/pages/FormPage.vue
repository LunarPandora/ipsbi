<script setup>
  const props = defineProps({
    formType: String
  })

</script>
<template>
  <div class="px-16 py-32 bg-ivory flex flex-col items-center justify-center">
    <div v-if="formType == '1'" class="flex flex-col text-center items-center">
      <p class="text-4xl font-medium display text-darkSlate mb-5">Formulir Pendaftaran IPSBI - Institusi</p>
      <p>Silahkan isi formulir dibawah ini untuk mendaftarkan institusi anda dalam keanggotaan IPSBI.</p>

      <form class="w-1/2 flex flex-col gap-5 mt-7">
        <div class="w-full bg-white border-2 border-darkSlate p-3 rounded-lg flex items-center">
          <fa icon="fas fa-school" fixed-width />
          <input class="outline-none pl-3 w-full" placeholder="Masukkan nama institusi anda">  
        </div>

        <div class="w-full bg-white border-2 border-darkSlate p-3 rounded-lg flex items-center">
          <fa icon="fas fa-landmark-dome" fixed-width />
          <input class="outline-none pl-3 w-full" placeholder="Masukkan perguruan tinggi anda">
        </div>

        <div class="w-full bg-white border-2 border-darkSlate p-3 rounded-lg flex items-center">
          <fa icon="fas fa-user" fixed-width />
          <input class="outline-none pl-3 w-full" placeholder="Masukkan nama pimpinan / Contact Person Institusi anda">
        </div>

        <div class="w-full bg-white border-2 border-darkSlate p-3 rounded-lg flex items-center">
          <fa icon="fas fa-phone" fixed-width />
          <input class="outline-none pl-3 w-full" placeholder="Masukkan nomor telepon anda">
        </div>

        <div class="w-full bg-white border-2 border-darkSlate p-3 rounded-lg flex items-center">
          <fa icon="fas fa-envelope" fixed-width />
          <input class="outline-none pl-3 w-full" placeholder="Masukkan email anda">
        </div>

        <div class="w-full bg-white border-2 border-darkSlate p-3 rounded-lg flex items-center">
          <fa icon="fas fa-star" fixed-width />
          <input class="outline-none pl-3 w-full" placeholder="Masukkan akreditasi program studi anda">
        </div>

        <div class="w-full bg-white border-2 border-darkSlate p-3 rounded-lg flex items-center">
          <fa icon="fas fa-location-dot" fixed-width />
          <input class="outline-none pl-3 w-full" placeholder="Masukkan alamat institusi anda">
        </div>

        <div class="w-full bg-white border-2 border-darkSlate p-3 rounded-lg flex items-center">
          <fa icon="fas fa-clock" fixed-width />
          <input class="outline-none pl-3 w-full" placeholder="Masukkan tahun berdiri institusi anda">
        </div>

        <p class="text-sm text-justify leading-loose">
          Bersama ini kami mengajukan permohonan menjadi anggota IPSBI, dan bersedia mengikuti segala ketentuan yang berlaku sebagai anggota IPSBI, serta mendapatkan hak sebagai anggota IPSBI, dan kami bersedia dikeluarkan dari keanggotaan jika melanggar ketentuan keanggotaan melalui keputusan rapat dewan pengurus IPSBI.
        </p>
        
        <p class="text-sm text-justify leading-loose">
          <span class="italic font-semibold">Iuran keanggotaan institusi Rp. 1.000.000/tahun yang ditransfer ke Bendahara IPSBI</span><br>
          <span class="font-semibold">An. Titta Novianti rek BCA no. 8800333092</span>
        </p>

        <button class="px-7 py-4 bg-zomp text-white rounded-lg font-medium text-lg">
          Kirim
        </button>
      </form>
    </div>

    <div v-if="formType == '2'" class="flex flex-col text-center items-center">
      <p class="text-4xl font-medium display text-darkSlate mb-5">Formulir Pendaftaran IPSBI - Individu</p>
      <p>Silahkan isi formulir dibawah ini untuk mendaftarkan diri anda dalam keanggotaan IPSBI.</p>

      <form class="w-1/2 flex flex-col gap-5 mt-7">
        <div class="w-full bg-white border-2 border-darkSlate p-3 rounded-lg flex items-center">
          <fa icon="fas fa-school" fixed-width />
          <input class="outline-none pl-3 w-full" placeholder="Masukkan nama anda (lengkap dengan gelar)">  
        </div>

        <div class="w-full bg-white border-2 border-darkSlate p-3 rounded-lg flex items-center">
          <fa icon="fas fa-phone" fixed-width />
          <input class="outline-none pl-3 w-full" placeholder="Masukkan nomor telepon anda">
        </div>

        <div class="w-full bg-white border-2 border-darkSlate p-3 rounded-lg flex items-center">
          <fa icon="fas fa-envelope" fixed-width />
          <input class="outline-none pl-3 w-full" placeholder="Masukkan email anda">
        </div>

        <div class="w-full bg-white border-2 border-darkSlate p-3 rounded-lg flex items-center">
          <fa icon="fas fa-school" fixed-width />
          <input class="outline-none pl-3 w-full" placeholder="Masukkan nama institusi anda">  
        </div>

        <div class="w-full bg-white border-2 border-darkSlate p-3 rounded-lg flex items-center">
          <fa icon="fas fa-location-dot" fixed-width />
          <input class="outline-none pl-3 w-full" placeholder="Masukkan alamat institusi anda">
        </div>

        <div class="w-full bg-white border-2 border-darkSlate p-3 rounded-lg flex items-center">
          <fa icon="fas fa-dna" fixed-width />
          <input class="outline-none pl-3 w-full" placeholder="Masukkan bidang ilmu Bioteknologi yang diminati">
        </div>

        <p class="text-sm text-justify leading-loose">
          Bersama ini saya mengajukan permohonan menjadi anggota IPSBI, dan bersedia mengikuti segala ketentuan yang berlaku sebagai anggota IPSBI, serta mendapatkan hak sebagai anggota IPSBI, dan saya bersedia dikeluarkan dari keanggotaan jika melanggar ketentuan keanggotaan melalui keputusan rapat dewan pengurus IPSBI.
        </p>
        
        <p class="text-sm text-justify leading-loose">
          <span class="italic font-semibold">Iuran keanggotaan institusi Rp. 300.000/tahun yang ditransfer ke Bendahara IPSBI</span><br>
          <span class="font-semibold">An. Titta Novianti rek BCA no. 8800333092</span>
        </p>

        <button class="px-7 py-4 bg-zomp text-white rounded-lg font-medium text-lg">
          Kirim
        </button>
      </form>
    </div>
  </div>
</template>
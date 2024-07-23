<script setup>
    import { RouterLink } from 'vue-router'

    import { ref, onMounted } from 'vue'
    import TabPane from '@/components/TabPane.vue'

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
      
        setTimeout(() =>
        {
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
        // console.log("Test")
    })
</script>
<template>
    <div class="flex flex-col w-full px-16 py-7 fixed top-0 left-0 z-50 transition-all" :class="{'bg-white shadow-md rounded-b-3xl' : y > 50 || dropdown}" id="navbar" @mouseleave="hideDropdownContent()">
        <div class="flex w-full justify-between items-center">
        <div>
            <p class="display font-medium text-4xl tracking-wider text-darkSlate">IPSBI</p>
        </div>
        <div class="flex gap-7" id="tabPane">
            <RouterLink to="/">Beranda</RouterLink>
            <RouterLink to="/about">Tentang Kami</RouterLink>
            <RouterLink to="/berita">Berita</RouterLink>
            
            <!-- <p @mouseover="showDropdownContent('mbkm')">MBKM</p> -->
            <p @mouseover="showDropdownContent('registrasi')">Registrasi</p>
        </div>
    </div>

    <!-- MBKM -->
    <div class="w-full transition-all" id="dropdown">
      <TabPane />
    </div>
  </div>
</template>
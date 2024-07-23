<script setup>
    import { ref } from "vue";
    
    const props = defineProps({
        tab: {
            type: Object,
            default: {
                id: "registrasi",
                img: "https://flowbite.s3.amazonaws.com/docs/gallery/square/image.jpg",
                judul: "Merdeka Belajar Kampus Merdeka",
                desc: "Sebuah inovasi yang dibuat oleh Kemendikbudristek dan diluncurkan sebuah kebijakan untuk mentransformasi sistem Pendidikan tinggi di Indonesia untuk menghasilkan lulusan yang lebih relevan.",
                links: [
                    {
                        judul: "Pertukaran Pelajar",
                        link: "#"
                    },
                    {
                        judul: "Magang / Praktik Kerja",
                        link: "#"
                    },
                    {
                        judul: "Penelitian",
                        link: "#"
                    },
                    {
                        judul: "Proyek Kemanusiaan",
                        link: "#"
                    },
                    {
                        judul: "Kegiatan Wirausaha",
                        link: "#"
                    },
                    {
                        judul: "Studi / Proyek Independen",
                        link: "#"
                    },
                    {
                        judul: "Asistensi Mengajar di Satuan Pendidikan",
                        link: "#"
                    },
                    {
                        judul: "Membangun Desa / Kuliah Kerja Nyata Tematik",
                        link: "#"
                    },
                ]
                // waktu: new Date().toLocaleDateString("id-ID"),
            }
        }
    })

    const links = ref([]);

    function splitToNChunks(array, n) {
        let result = [];
        for (let i = n; i > 0; i--) {
            result.push(array.splice(0, Math.ceil(array.length / i)));
        }
        return result;
    }

    links.value = splitToNChunks(props.tab.links, 2)
</script>

<template>
    <div class="w-full pt-10 mb-2 hidden" :id="tab.id">
        <div class="flex flex-col w-1/3">
            <img :src="tab.img" class="w-1/3 mb-5">

            <div class="flex flex-col gap-3">
                <p class="text-xl font-semibold">{{ tab.judul }}</p>
                <p class="text-sm leading-relaxed">{{ tab.desc }}</p>
            </div>
        </div>

        <div class="flex flex-col w-1/3 *:p-3 *:font-medium" v-for="link in links">
            <div v-for="x in link">
                <p class="align-middle">
                    <fa icon="fas fa-chevron-right" class="text-xs mr-2" />
                    {{ x.judul }}
                </p>
            </div>
        </div>
    </div>
</template>
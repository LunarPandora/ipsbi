import './assets/main.css'

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import cors from 'cors'

import App from './App.vue'
import router from './router'

import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'
import '../node_modules/flowbite-vue/dist/index.css'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(fas, fab)

const corsOptions = {
    origin: ["https://www.ipsbi.netlify.app"],
    exposedHeaders: 'token', // ⬅️ exposes custom response headers
};

const app = createApp(App)

app.component('fa', FontAwesomeIcon)
app.use(createPinia())
app.use(router)
app.use(cors(corsOptions));

app.mount('#app')

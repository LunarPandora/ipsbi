import './assets/main.css'

import "tinymce/tinymce";
import "tinymce/themes/silver";
import "tinymce/icons/default";

import 'tinymce/skins/ui/oxide/skin.js'
import 'tinymce/skins/ui/oxide/content.js'

import 'tinymce/models/dom';

import 'tinymce/plugins/emoticons';
import 'tinymce/plugins/emoticons/js/emojis';
import 'tinymce/plugins/searchreplace';
import 'tinymce/plugins/media';
import 'tinymce/plugins/wordcount';
import 'tinymce/plugins/image';
import 'tinymce/plugins/link';
import 'tinymce/plugins/lists';

import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'

import { library } from '@fortawesome/fontawesome-svg-core'
import { fas } from '@fortawesome/free-solid-svg-icons'
import { fab } from '@fortawesome/free-brands-svg-icons'
import '../node_modules/flowbite-vue/dist/index.css'

import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
library.add(fas, fab)

const app = createApp(App)

app.component('fa', FontAwesomeIcon)
app.use(createPinia())
app.use(router)

app.mount('#app')

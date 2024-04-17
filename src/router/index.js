import { createRouter, createWebHistory } from 'vue-router'
import BerandaView from '../views/BerandaView.vue'
import AboutView from '../views/AboutView.vue'
import BeritaView from '../views/BeritaView.vue'

import NewsPage from '../pages/NewsPage.vue'
import FormPage from '../pages/FormPage.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'beranda',
      component: BerandaView
    },
    {
      path: '/about',
      name: 'about',
      component: AboutView
    },
    {
      path: '/berita',
      name: 'berita',
      component: BeritaView
    },
    {
      path: '/registrasi/:formType',
      name: 'registrasi',
      component: FormPage,
      props: true
    },
    {
      path: '/berita/:id',
      component: NewsPage
    }
  ]
})

export default router

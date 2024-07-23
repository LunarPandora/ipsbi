import { createRouter, createWebHashHistory } from 'vue-router'

import DashboardView from '../views/DashboardView.vue'
import MainView from '../views/MainView.vue'

import BerandaView from '../views/BerandaView.vue'
import AboutView from '../views/AboutView.vue'
import BeritaView from '../views/BeritaView.vue'
import LoginView from '../views/LoginView.vue'

import NewsPage from '../pages/NewsPage.vue'
import FormPage from '../pages/FormPage.vue'
import PostinganPage from '@/pages/PostinganPage.vue'
import AkunPage from '@/pages/AkunPage.vue'
import BannerPage from '@/pages/BannerPage.vue'
import CommentPage from '@/pages/CommentPage.vue'
import ManageFormPage from '@/pages/ManageFormPage.vue'
import RespondFormPage from '@/pages/RespondFormPage.vue'

const router = createRouter({
  history: createWebHashHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'main',
      component: MainView,
      redirect: {path: "/home"},
      children: [
        {
          path: '/home',
          name: 'beranda',
          component: BerandaView,
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
    },
    {
      path: '/dashboard',
      name: 'dashboard',
      component: DashboardView,
      redirect: {path: "/dashboard/post"},
      children: [
        {
          path: '/dashboard/post',
          component: PostinganPage,
        },
        {
          path: '/dashboard/banner',
          component: BannerPage,
        },
        {
          path: '/dashboard/comment',
          component: CommentPage,
        },
        {
          path: '/dashboard/account',
          component: AkunPage,
        },
        {
          path: '/dashboard/form',
          component: ManageFormPage,
        },
        {
          path: '/dashboard/form/idform/responses',
          component: RespondFormPage,
          props: true
        },
      ]
    },
    {
      path: '/login',
      name: 'login',
      component: LoginView
    },
  ]
})

export default router

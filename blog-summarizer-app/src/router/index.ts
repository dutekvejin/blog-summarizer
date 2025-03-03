import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'generate',
      component: () => import('../views/GenerateView.vue'),
    },
    {
      path: '/archive',
      name: 'archive',
      component: () => import('../views/ArchiveView.vue'),
    },
  ],
})

export default router

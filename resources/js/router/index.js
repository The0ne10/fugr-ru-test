import { createRouter, createWebHistory} from "vue-router";

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes: [
        {
            path: '/',
            name: 'index',
            component: () => import('../views/Index.vue')
        },
        {
            path: '/:id/',
            name: 'show',
            component: () => import('../views/Show.vue')
        },
        {
            path: '/:id/',
            name: 'edit',
            component: () => import('../views/Edit.vue')
        }
    ]
})

export default router

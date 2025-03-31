import { createRouter, createWebHistory } from "vue-router";
import adminRoutes from './admin.js';
const routes = [
    {
        path: '/',
        component: () => import('../layouts/Client.vue'),
        children: [
            {
                path: '',
                name: 'home',
                component: () => import('../pages/client/home.vue')
            }
        ]
    },
    ...adminRoutes
]


const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;

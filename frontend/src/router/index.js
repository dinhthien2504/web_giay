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
            },
            {
                path: 'dang-nhap',
                name: 'login',
                component: () => import('../pages/client/auth/login.vue')
            },
            {
                path: 'dang-ky',
                name: 'register',
                component: () => import('../pages/client/auth/register.vue')
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

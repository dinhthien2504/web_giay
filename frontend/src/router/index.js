import { createRouter, createWebHistory } from "vue-router";
import adminRoutes from './admin.js';
const routes = [
    {
        path: '/',
        component: () => import('../layouts/Client.vue'),
        children: [
            // route đăng nhập cho admin
            {
                path: 'login-admin',
                name: 'admin-login',
                component: () => import('../pages/admin/auth/login.vue'),
                meta: {
                    hideHeader: true,
                    hideFooter: true
                }
            },
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
            },
            {
                path: 'quen-mk',
                name: 'forgot-pass',
                component: () => import('../pages/client/auth/forgot-pass.vue')
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

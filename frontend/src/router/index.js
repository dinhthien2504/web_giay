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
            //user
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
                path: 'doi-mk',
                name: 'forgot-pass',
                component: () => import('../pages/client/auth/change-pass.vue')
            },
            //product
            {
                path: 'chi-tiet/:id',
                name: 'product-detail',
                component: () => import('../pages/client/products/product-detail.vue')
            },
            // cart
            {
                path: 'gio-hang',
                name: 'cart',
                component: () => import('../pages/client/carts/index.vue')
            },
        ]
    },
    ...adminRoutes
]


const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;

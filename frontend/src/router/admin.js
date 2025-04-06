const admin = [
    {
        path: '/admin',
        component: () => import('../layouts/Admin.vue'),
        children: [
            {
                path: '',
                name: 'admin-dashboard',
                component: () => import('../pages/admin/dashboard.vue')
            },
            {
                path: 'tai-khoan',
                name: 'admin-auth',
                component: () => import('../pages/admin/auth/index.vue')
            },
            {
                path: 'san-pham',
                name: 'admin-product',
                component: () => import('../pages/admin/products/index.vue')
            },
            {
                path: 'danh-muc',
                name: 'admin-category',
                component: () => import('../pages/admin/categories/index.vue')
            }
        ]
    }
]
export default admin;
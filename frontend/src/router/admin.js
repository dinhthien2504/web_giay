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
                path: 'login',
                name: 'admin-login',
                component: () => import('../pages/admin/auth/login.vue')
            }
        ]
    }
]
export default admin;
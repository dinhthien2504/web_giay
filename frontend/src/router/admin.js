const admin = [
    {
        path: '/admin',
        component: () => import('../layouts/Admin.vue'),
        children: [
            {
                path: '',
                name: 'admin-dashboard',
                component: () => import('../pages/admin/dashboard.vue')
            }
        ]
    }
]
export default admin;
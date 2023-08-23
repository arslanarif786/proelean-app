const sellerRoutes = [
    {
        path: '/dashboard',
        name: 'sellerDashboard',
        component: () => import('@/views/Seller/Dashboard.vue'),
        meta: { requiresAuth: true }
    },

    {
        path: '/dashboard/chat/:id?',
        name: 'SellerChat',
        component: () => import(/* webpackChunkName: "chat" */'@/views/Chat.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/buyer/view-offers/:id',
        name: 'SellerViewOffers',
        component: () => import(/* webpackChunkName: "job-offers" */'@/views/Buyer/ViewOffers.vue'),
    },

    {
        path: '/dashboard/order-details/:id',
        name: 'OrderDetails',
        component: () => import('@/views/Seller/OrderDetails.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/sellers-services',
        name: 'SellerServices',
        component: () => import('@/views/Seller/SellerServices.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/payments',
        name: 'Payments',
        component: () => import('@/views/Seller/Payments.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/create-gig',
        name: 'CreateGig',
        component: () => import('@/views/Seller/CreateGig.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/buyer_requests',
        name: 'BuyerRequests',
        component: () => import('@/views/Seller/BuyerRequests.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/analytics',
        name: 'Analytics',
        component: () => import('@/views/Seller/Analytics.vue'),
        meta: { requiresAuth: true }
    },

    {
        path: '/dashboard/settings',
        name: 'Settings',
        component: () => import('@/views/Seller/Settings.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/account',
        name: 'Account',
        component: () => import('@/views/Seller/Account.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/notifications',
        name: 'Notifications',
        component: () => import('@/views/Seller/Notifications.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/orders',
        name: 'Orders',
        component: () => import('@/views/Seller/Orders.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/update_service/:id',
        name: 'UpdateService',
        component: () => import('@/views/Seller/UpdateService.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/gig-detail/:id',
        name: 'GigDetail',
        component: () => import('@/views/Seller/ServiceDetail.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/edit-profile',
        name: 'EditProfile',
        component: () => import('@/views/Seller/EditProfile.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/change_password',
        name: 'ChangePassword',
        component: () => import('@/views/Seller/ChangePassword.vue'),
        meta: { requiresAuth: true }
    },
    {
        path: '/dashboard/withdraw',
        name: 'BankAttach',
        component: () => import('@/views/Seller/BankAttach.vue'),
        meta: { requiresAuth: true }
    },
];
export default sellerRoutes;
import { createRouter, createWebHistory } from 'vue-router'

import sellerRoutes from './seller.js'


const routes = [
  {
    path: '/',
    name: 'Home',
    //   lazy-loading all routes
    component: () => import('@/views/Home.vue'),
  },
  {
    path: '/order-details/:id',
    name: 'OrderDetailsBuyer',
    component: () => import('@/views/OrderDetailsBuyer.vue'),
    meta: { requiresAuth: true }
  },

  {
    path: '/buyer-account',
    name: 'BuyerAccount',
    component: () => import('@/views/Seller/Account.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/buyer/edit-profile',
    name: 'BuyerEditProfile',
    component: () => import('@/views/Seller/EditProfile.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/buyer/change_password',
    name: 'BuyerChangePassword',
    component: () => import('@/views/Seller/ChangePassword.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/buyer/favourite_services',
    name: 'FavouriteServices',
    component: () => import('@/views/Seller/FavouriteService.vue'),
  },
  {
    path: '/buyer/notifications',
    name: 'BuyerNotifications',
    component: () => import('@/views/Seller/Notifications.vue'),
  },
  {
    path: '/gig-detail/:id',
    name: 'BuyerServiceDetail',
    component: () => import('@/views/Buyer/BuyerServiceDetail.vue'),
  },
  {
    path: '/buyer/view-offers/:id',
    name: 'ViewOffers',
    component: () => import(/* webpackChunkName: "job-offers" */'@/views/Buyer/ViewOffers.vue'),
  },
  {
    path: '/login',
    name: 'Login',
    component: () => import(/* webpackChunkName: "login" */'@/views/Auth/Login.vue'),
  },
  {
    path: '/register',
    name: 'Register',
    component: () => import(/* webpackChunkName: "register" */'@/views/Auth/Register.vue'),
  },
  {
    path: '/forgot',
    name: 'Forgot',
    component: () => import(/* webpackChunkName: "forgot" */'@/views/Auth/Forgot.vue'),
  },

  {
    path: '/become_seller',
    name: 'BecomeSeller',
    component: () => import('@/views/Become-Seller.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/Profile',
    name: 'Profile',
    component: () => import('@/views/Profile.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/About',
    name: 'About',
    component: () => import('@/views/About.vue'),
  },

  {
    path: '/buyer/create_job',
    name: 'CreateJob',
    component: () => import('@/views/Buyer/CreateJob.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/buyer/manage_order',
    name: 'ManageOrder',
    component: () => import('@/views/Buyer/ManageOrder.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/buyer/jobs',
    name: 'Jobs',
    component: () => import('@/views/Buyer/Jobs.vue'),
  },
  {
    path: '/gigs/:slug?',
    name: 'Gigs',
    component: () => import(/* webpackChunkName: "services" */'@/views/Services.vue'),
  },
  {
    path: '/coming-soon',
    name: 'ComingSoon',
    component: () => import('@/views/Coming-Soon.vue'),
  },
  {
    path: '/purchase/:id',
    name: 'Purchase',
    component: () => import(/* webpackChunkName: "services" */'@/views/Purchase.vue'),
    meta: { requiresAuth: true }
  },
  {
    path: '/chat/:id?',
    name: 'Chat',
    component: () => import(/* webpackChunkName: "chat" */'@/views/Chat.vue'),
    meta: { requiresAuth: true }
  },
  ...sellerRoutes
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
});


router.beforeEach((to, from, next) => {
  window.scroll({
    top: 0,
    left: 0,
    behavior: "smooth",
  });

  if(location.pathname!='/coming-soon' && !location.host.includes('local') &&  !location.host.includes('dex')){
    location.href='/coming-soon';
    //next('/coming-soon');
  }
  const isAuthenticated = localStorage.getItem('PROELEAN_TOKEN') ? true : false;
  
  if (to.meta?.requiresAuth && !isAuthenticated) {
    next('/login');
  }

  const user =JSON.parse(localStorage.getItem('userInfo'));

  if(isAuthenticated && !user.isFreelancer && to.path.includes('dashboard')) {
    next('/become_seller');
  }

  if (to.name == 'Home' && localStorage.getItem('USER_MODE') == 'SELLER') {
    next('/dashboard');
  }

  next();
})


export default router

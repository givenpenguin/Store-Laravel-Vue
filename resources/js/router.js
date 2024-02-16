import { createRouter, createWebHistory } from 'vue-router';

const routes = [
    {
        path: '/',
        component: () => import('./components/main/Index.vue'),
        name: 'home',
    },
    {
        path: '/product:id',
        component: () => import('./components/main/ShowDetails.vue'),
        name: 'product',
    },
    {
        path: '/shipping',
        component: () => import('./components/main/information/Shipping.vue'),
        name: 'shipping',
    },
    {
        path: '/payment',
        component: () => import('./components/main/information/Payment.vue'),
        name: 'payment',
    },
    {
        path: '/privacypolicy',
        component: () => import('./components/main/information/PrivacyPolicy.vue'),
        name: 'privacy-policy',
    },
    {
        path: '/publicoffer',
        component: () => import('./components/main/information/PublicOffer.vue'),
        name: 'public-offer',
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});


export default router;

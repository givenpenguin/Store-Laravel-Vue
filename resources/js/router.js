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
];

const router = createRouter({
    history: createWebHistory(),
    routes
});


export default router;

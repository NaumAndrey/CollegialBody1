import Vue from 'vue'
import Router from 'vue-router'
import Layout from '@/views/layout/Layout'

Vue.use(Router)

export const constantRouterMap = [
    {
        path: '/redirect',
        component: Layout,
        hidden: true,
        children: [
            {
                path: '/redirect/:path*',
                component: () => import('@/views/redirect/index')
            }
        ]
    },
    {
        path: '/login',
        component: () => import('@/views/access/login'),
        hidden: true
    },
    {
        path: '/denied',
        component: () => import('@/views/access/denied'),
        hidden: true,
    },
    {
        path: '/404',
        component: () => import('@/views/errorPage/404'),
        hidden: true
    },
    {
        path: '/401',
        component: () => import('@/views/errorPage/401'),
        hidden: true
    }
]

export default new Router({
    mode: 'history',
    scrollBehavior: () => ({y: 0}),
    routes: constantRouterMap
})

export const asyncRouterMap = [
    {
        path: '',
        component: Layout,
        redirect: 'home',
        children: [
            {
                path: 'home',
                component: () => import('@/views/home/workspace'),
                name: 'home',
                meta: {
                    title: 'Рабочий стол',
                    icon: 'laptop'
                },
            },
        ]
    },

    {
        path: '/ocdi',
        component: Layout,
        redirect: 'index',
        children: [
            {
                path: 'index',
                component: () => import('@/views/ocdi/list.vue'),
                name: 'ocdiList',
                meta: {
                    title: 'Коллегиальные органы',
                    icon: 'laptop'
                }
            },
            
            {
                path: 'create',
                component: () => import('@/views/ocdi/create.vue'),
                name: 'ocdiCreate',
                hidden: true,
            },

            {
                path: 'organiz',
                component: () => import('@/views/ocdi/organiz.vue'),
                name: 'ocdiOrganiz',
                hidden: true,
            },

            {
                path: 'players',
                component: () => import('@/views/ocdi/players.vue'),
                name: 'ocdiPlayers',
                hidden: true,
            },

            {
                path: 'activity',
                component: () => import('@/views/ocdi/activity.vue'),
                name: 'ocdiActivity',
                hidden: true,
            },

            {
                path: 'activity',
                component: () => import('@/views/ocdi/activity.vue'),
                name: 'ocdiActivityView',
                hidden: true,
            },

            {
                path: 'orders',
                component: () => import('@/views/ocdi/orders.vue'),
                name: 'ocdiOrders',
                hidden: true,
            },

            {
                path: 'authority',
                component: () => import('@/views/ocdi/authority.vue'),
                name: 'ocdiAuthority',
                hidden: true,
            },
        ]
    },


    {
        path: '/analitika',
        component: Layout,
        redirect: 'index',
        children: [
            {
                path: 'index',
                component: () => import('@/views/analitika/analitika'),
                name: 'analitikaIndex',
                meta: {
                    title: 'Аналитика',
                    icon: 'laptop'
                }
            },
        ]
    },

    {
        path: '/search',
        component: Layout,
        redirect: 'index',
        children: [
            {
                path: 'index',
                component: () => import('@/views/search/search'),
                name: 'searchIndex',
                meta: {
                    title: 'Поиск',
                    icon: 'laptop'
                }
            },
        ]
    },

    {
        path: '*',
        redirect: '/404',
        hidden: true
    }
]

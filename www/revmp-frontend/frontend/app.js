require('./bootstrap');

import Vue from 'vue'

import 'normalize.css/normalize.css'

import lang from 'element-ui/lib/locale/lang/ru-RU'
import locale from 'element-ui/lib/locale'

import Element from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'

import '@/styles/index.scss'

import App from './App'
import router from './router'
import store from './store'

import './icons'
import './errorLog'
import './permission'

import * as filters from './filters'

locale.use(lang)

Vue.use(Element, {
    size: 'medium',
})

Vue.use(Element, {
    size: 'medium',
})

Object.keys(filters).forEach(key => {
    Vue.filter(key, filters[key])
})

Vue.config.productionTip = false

new Vue({
    el: '#app',
    router,
    store,
    render: h => h(App),
})

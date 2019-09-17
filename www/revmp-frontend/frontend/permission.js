import router from './router'
import store from './store'
import {Message} from 'element-ui'
import NProgress from 'nprogress'
import 'nprogress/nprogress.css'
import {getToken} from '@/utils/auth'

NProgress.configure({showSpinner: false})

function hasPermission(roles, permissionRoles) {
    if (roles.indexOf('admin') >= 0 || !permissionRoles) return true
    return roles.some(role => permissionRoles.indexOf(role) >= 0)
}

const whiteList = ['/login', '/denied']

router.beforeEach((to, from, next) => {
    NProgress.start()
    if (store.getters.roles.length === 0) {
        store.dispatch('GetUserInfo').then(() => {
            store.dispatch('GenerateRoutes', {roles: ['admin']}).then(() => {
                router.addRoutes(store.getters.addRouters)
                next({...to, replace: true})
                NProgress.done()
            })
        })
    } else {
        if (hasPermission(store.getters.roles, to.meta.roles)) {
            next()
        } else {
            next({path: '/401', replace: true, query: {noGoBack: true}})
        }
    }
})

router.afterEach(() => {
    NProgress.done()
})

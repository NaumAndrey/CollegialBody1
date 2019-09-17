import axios from 'axios'
import {Message} from 'element-ui'
import store from '@/store'
import {getToken} from '@/utils/auth'

const service = axios.create({
    headers: {
        post: {
            Accept: 'application/json',
        },
        common: {
            Accept: 'application/json',
        },
    },
    baseURL: window.location.origin,
    timeout: 10000
})

service.interceptors.request.use(
    config => {
        if (store.getters.token) {
            config.headers['Authorization'] = 'Bearer ' + getToken()
        }
        return config
    },
    error => {
        console.log(error)
        Promise.reject(error)
    }
)

service.interceptors.response.use(
    response => response,
    error => {
        console.log('err' + error)
        Message({
            message: error.message,
            type: 'error',
            duration: 10000
        })
        return Promise.reject(error)
    }
)

export default service

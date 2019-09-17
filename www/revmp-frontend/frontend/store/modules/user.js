import {getUserInfo} from '@/api/login'
import {getToken, removeToken, setToken} from '@/utils/auth'

const user = {
    state: {
        token: getToken(),
        fio: '',
        roles: [],
    },

    mutations: {
        SET_TOKEN: (state, token) => {
            state.token = token
        },
        SET_FIO: (state, fio) => {
            state.fio = fio
        },
        SET_ROLES: (state, roles) => {
            state.roles = roles
        }
    },

    actions: {
        GetUserInfo({commit}) {
            return new Promise((resolve, reject) => {
                commit('SET_ROLES', ['admin'])
                resolve()
            
            })
        },

        FedLogOut({commit}) {
            return new Promise(resolve => {
                commit('SET_TOKEN', '')
                commit('SET_FIO', '')
                commit('SET_ROLES', [])
                removeToken()
                resolve()
            })
        },
    }
}

export default user

import request from '../utils/request'

export function getUserInfo() {
    return request({
        url: '/api/auth/access/info',
        method: 'get',
    })
}

export function updateUserInfo(aistoken) {
    return request({
        url: '/api/auth/access',
        method: 'get',
        params: {aistoken}
    })
}

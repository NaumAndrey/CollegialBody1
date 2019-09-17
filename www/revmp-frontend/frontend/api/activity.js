import request from '../utils/request'

export function saveEntity(params) {
    return request ({
        url:    '/api/activity/create',
        method: 'post',
        params,
        headers: {
            'Content-Type': 'multipart/form-data'
        }

    })
}


export function getList() {
    return request({
        url: '/api/activity/hello',
        method: 'get',

    })
}



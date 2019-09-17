import Cookies from 'js-cookie'
import {updateUserInfo} from '@/api/login'

const TokenKey = 'aistoken'

export function getToken() {
    return Cookies.get(TokenKey)
}

export function setToken(token) {
    return Cookies.set(TokenKey, token)
}

export function removeToken() {
    return Cookies.remove(TokenKey)
}

export function torisInit(context) {
    TORIS.setOptions({
        sys_id: process.env.TORIS.CODE,
        is_toris: true,
        login_redirect_url: window.location.origin + '/login',
        domain: process.env.TORIS.DNS,
        domain_proto: '',
        show_auth: true,
        css_path: window.location.origin + '/build/static/toris/widget.css'
    })

    TORIS.init(function (message) {
        const element = document.getElementById('widget_iframe')
        element.style.left = 'auto';
        (new MutationObserver(mutations => {
            mutations.forEach(() => {
                if (element.style.height === '100%' && element.style.width !== '100%') {
                    element.style.width = '100%'
                }
                if (element.style.height !== '100%' && element.style.width === '100%') {
                    element.style.width = '40%'
                }
            })
        })).observe(element, {attributes: true, attributeFilter: ['style']});
        console.info('Результат первичной инициализации:', message)
    })

    window.addEventListener('TORISWidgetInitComplete', () =>
        TORIS.userProfile(userProfile => {
            console.info("Профиль пользователя:", userProfile)
            if (userProfile && userProfile.data) {
                updateUserInfo(userProfile.data.AISTOKEN)
                    .then(() => context.$router.replace({path: '/home'}))
                    .catch(err => {
                        if (err.response.data.code === 401) {
                            context.$router.replace({path: '/denied'})
                        } else {
                            context.$store.dispatch('FedLogOut').then(() => {
                                Message.error(err || 'Ошибка верификации, пожалуйста попробуйте ещё раз.')
                                context.$router.replace({path: '/home'})
                            })
                        }
                    })
            }
            if (userProfile.code === 103) {
                context.$store.dispatch('FedLogOut').then(() => {
                    Message.error('Ошибка верификации, пожалуйста попробуйте ещё раз.')
                    context.$router.replace({path: '/home'})
                })
            }
        })
    )
}

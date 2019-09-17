<script>
    import {setToken} from '@/utils/auth'
    import {updateUserInfo} from '@/api/login'

    export default {
        beforeCreate() {
            const token = this.$route.query.aistoken
            const url = this.$route.query.redirect
            if (token) {
                setToken(token);
                updateUserInfo(token).then(() => {
                    if (url) {
                        this.$router.replace({path: url})
                    } else {
                        this.$router.replace({path: '/home'})
                    }
                }).catch(err => {
                    if (err.response.data.code === 401) {
                        this.$router.replace({path: '/denied'})
                    } else {
                        this.$store.dispatch('FedLogOut').then(() => {
                            Message.error(err || 'Ошибка верификации, пожалуйста попробуйте ещё раз.')
                            this.$router.replace({path: '/home'})
                        })
                    }
                })
            }
        },
        render: function (h) {
            return h()
        }
    }
</script>
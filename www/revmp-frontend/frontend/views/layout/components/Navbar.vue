<template>
    <div class="navbar">
        <hamburger v-if="!hamburger_hidden" :toggle-click="toggleSideBar" :is-active="sidebar.opened"
                   class="hamburger-container"/>

        <breadcrumb class="breadcrumb-container"/>
    </div>
</template>

<script>
    import {mapGetters} from 'vuex'
    import Breadcrumb from '@/components/Breadcrumb'
    import Hamburger from '@/components/Hamburger'

    export default {
        components: {
            Breadcrumb,
            Hamburger,
        },
        props: {
            hamburger_hidden: {
                default: false
            },
        },
        computed: {
            ...mapGetters([
                'sidebar',
                'name',
                'device'
            ]),
            toris_domain() {
                return process.env.TORIS.DOMAIN
            },
            self_domain() {
                return window.location.origin
            }
        },
        methods: {
            toggleSideBar() {
                this.$store.dispatch('toggleSideBar')
            },
            logout() {
                this.$store.dispatch('FedLogOut').then(() => {
                    window.location = this.toris_domain + '/?logout=y&back_url=' + this.self_domain + '/home'
                })
            }
        }
    }
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
    .navbar {
        height: 50px;
        line-height: 50px;
        border-radius: 0 !important;
        .hamburger-container {
            line-height: 58px;
            height: 50px;
            float: left;
            padding: 0 10px;
        }
        .breadcrumb-container {
            float: left;
        }
        .errLog-container {
            display: inline-block;
            vertical-align: top;
        }
        .right-menu {
            float: right;
            height: 100%;
            &:focus {
                outline: none;
            }
            .right-menu-item {
                display: inline-block;
                margin: 0 8px;
            }
            .international {
                vertical-align: top;
            }
        }
    }
</style>

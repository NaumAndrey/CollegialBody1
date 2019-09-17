<template>
    <div class="app-wrapper">
        <div v-if="device==='mobile'&&sidebar.opened" class="drawer-bg" @click="handleClickOutside"/>
        <div class="main-container">
            <navbar :hamburger_hidden="true"/>
            <div class="denied">
                <h1>Вы не имеете прав доступа к системе</h1>
            </div>
        </div>
    </div>
</template>

<script>
    import Navbar from '@/views/layout/components/Navbar'
    import ResizeMixin from '@/views/layout/mixin/ResizeHandler'
    import {torisInit} from "@/utils/auth";

    export default {
        name: 'Layout',
        components: {
            Navbar,
        },
        mixins: [ResizeMixin],
        beforeCreate() {
            this.$store.dispatch('GetUserInfo')
        },
        created() {
            torisInit(this)
        },
        computed: {
            sidebar() {
                return this.$store.state.app.sidebar
            },
            device() {
                return this.$store.state.app.device
            },
        },
        methods: {
            handleClickOutside() {
                this.$store.dispatch('closeSideBar', {withoutAnimation: false})
            }
        }
    }
</script>

<style rel="stylesheet/scss" lang="scss" scoped>
    @import "frontend/styles/mixin.scss";

    .app-wrapper {
        @include clearfix;
        position: relative;
        height: 100%;
        width: 100%;
        &.mobile.openSidebar {
            position: fixed;
            top: 0;
        }
    }

    .drawer-bg {
        background: #000;
        opacity: 0.3;
        width: 100%;
        top: 0;
        height: 100%;
        position: absolute;
        z-index: 999;
    }

    .denied {
        text-align: center;
        padding-top: 6%;
        font-size: 42px;
        color: #e6e6e6;
        font-weight: 800;
        font-family: Roboto-Thin, Roboto, Helvetica Neue Light, Helvetica Neue, Helvetica, Arial, Lucida Grande, sans-serif;
    }
</style>
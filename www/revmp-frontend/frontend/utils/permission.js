import store from '@/store'

/**
 * @param {Array} value
 * @returns {Boolean}
 * @example see @/views/permission/directive.vue
 */
export default function checkPermission(value) {
    if (value && value instanceof Array && value.length > 0) {
        return (store.getters && store.getters.roles).some(role => {
            return value.includes(role)
        })
    } else {
        return false
    }
}

window._ = require('lodash');
window.Vue = require('vue');
window.axios = require('axios');
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};
window.jquery = require('jquery');
window.moment = require('moment');
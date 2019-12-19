/**
 * Bootstrap
 */
try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');
} catch (e) {}

/**
 * Add Axios library and add tokens to every single request
 */
window.axios = require('axios');

axios.defaults.headers.common = {
    'X-CSRF-TOKEN': Laravel.csrfToken,
    'X-Requested-With': 'XMLHttpRequest',
    'Authorization': 'Bearer ' + Laravel.apiToken,
};

// Vue
window.Vue = require('vue');
window.EventsBus = new Vue();
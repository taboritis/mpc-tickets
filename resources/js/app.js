require('./bootstrap');


Vue.component('users-index', require('./components/users/UsersIndex').default);

const app = new Vue({
    el: '#app',
});

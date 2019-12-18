require('./bootstrap');

Vue.component('tickets-index', require('./components/tickets/TicketsIndex').default);

const app = new Vue({
    el: '#app',
});

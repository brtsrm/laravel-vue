import './bootstrap';
window.Vue = require('vue').default;

import App from './components/App.vue'


const app = new Vue({
    el: '#app',
    template: "<App />",
    components: { App }
});
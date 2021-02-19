import './bootstrap';
window.Vue = require('vue').default;

import App from './components/App.vue'
import router from './router';


const app = new Vue({
    el: '#app',
    template: "<App />",
    components: { App }
});
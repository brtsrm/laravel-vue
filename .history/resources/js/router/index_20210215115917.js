import Vue from 'vue';
import VueRouter from 'vue-router';



Vue.use(VueRouter)

import Dashboard from '../pages/Dashboard';
import UserList from '../pages/user/UserList';


const routes = [{
    path: '/',
    component: Dashboard,
    name: 'dashboard'
}, {
    path: '/users',
    component: Dashboard,
    name: 'dashboard'
}, ]

export default new VueRouter({
    mode: 'history',
    routes
})
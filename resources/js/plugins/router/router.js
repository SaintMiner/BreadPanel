import Vue from 'vue';
import VueRouter from 'vue-router';

import Main from '../../components/Main.vue';

import Register from '../../components/Authentication/Register.vue';
import store from '../../store';

import router from './routerBuilder';

Vue.use(VueRouter);

const routes = [
    {
        path: '/', 
        component: Main,
        name: 'main',
        children: router,
    },
    {
        path: '/register', 
        component: Register,
        name: 'register',
        beforeEnter(to, from, next) {
            if (store.getters['auth/authenticated']) {
                next({name: 'main'});
            } else {
                next();
            }
        }
    },

    { 
        path: '*', //catch everything else route
        redirect: '/' 
    },
];

export default new VueRouter({
    routes,

    mode: 'history',
});
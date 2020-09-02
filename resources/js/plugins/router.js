import Vue from "vue";
import VueRouter from "vue-router";

import Main from "../components/Main.vue";

import Register from "../components/Authentication/Register.vue";
import store from "../store";

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/', 
            component: Main,
            name: "main",
        },

        {
            path: '/register', 
            component: Register,
            name: "register",
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
    ],

    mode: "history",
});
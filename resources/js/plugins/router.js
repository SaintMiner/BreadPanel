import Vue from "vue";
import VueRouter from "vue-router";

import Main from "../components/Main.vue";

import Register from "../components/Authentication/Register.vue";

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
        },
        

        { 
            path: '*', //catch everything else route
            redirect: '/' 
        },
    ],

    mode: "history",
});
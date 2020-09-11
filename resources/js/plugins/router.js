import Vue from 'vue';
import VueRouter from 'vue-router';

import Main from '../components/Main.vue';

import Register from '../components/Authentication/Register.vue';
import Profile from '../components/User/Profile.vue';
import store from '../store';

import Invitation from '../components/System/Invitation/Invitation.vue';
import Role from '../components/System/Role/Role.vue';

import PermissionTest from '../components/ParmissionTest.vue';

Vue.use(VueRouter);

export default new VueRouter({
    routes: [
        {
            path: '/', 
            component: Main,
            name: 'main',
            children: [
                {
                    path: 'profile',
                    name: 'profile',
                    component: Profile,
                },

                {
                    path: 'invitation',
                    name: 'invitation',
                    component: Invitation,
                },

                {
                    path: 'permission',
                    name: 'permission',
                    component: PermissionTest,
                },

                {
                    path: 'role',
                    name: 'role',
                    component: Role,
                }
            ]
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
    ],

    mode: 'history',
});
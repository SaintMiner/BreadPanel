import Vue from "vue";
import Vuetify from 'vuetify';

import App from './components/App.vue';

// plugins
import axios from 'axios'
import router from "./plugins/router.js";
import permissions from "./mixins/permissions.js";
//storage
import store from './store/index.js';


Vue.use(Vuetify);
Vue.mixin(permissions);
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
console.log(store.getters);
// axios.defaults.baseURL = 'http://localhost:8000/';
store.dispatch('auth/me').then(() => {
    const app = new Vue({
        el: "#app",
        router,
        store,    
        vuetify: new Vuetify(),

        components: {App},
    })
});

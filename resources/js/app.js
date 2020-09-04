import Vue from "vue";
import Vuetify from 'vuetify';

import App from './components/App.vue';

// plugins
import axios from 'axios'
import router from "./plugins/router.js";


//storage
import store from './store/index.js';

//mixins
import permissions from "./mixins/permissions.js";
import system from './mixins/system.js';

Vue.mixin(permissions);
Vue.mixin(system);

Vue.use(Vuetify);

axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
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

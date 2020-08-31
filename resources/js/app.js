import Vue from "vue";
import Vuetify from 'vuetify';

// plugins
import router from "./plugins/router.js";

//storage
import store from './store/index.js';

Vue.use(Vuetify);

const app = new Vue({
    el: "#app",
    router,
    store,    
    vuetify: new Vuetify(),
});

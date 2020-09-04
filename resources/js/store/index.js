import Vue from 'vue';
import Vuex from 'vuex';

import system from './system.js';

import auth from './auth.js';
import invitation from './invitation.js';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        invitation,
        system,
    }
});
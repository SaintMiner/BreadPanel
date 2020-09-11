import Vue from 'vue';
import Vuex from 'vuex';

import system from './system.js';

import auth from './auth.js';
import invitation from './invitation.js';
import role from './role.js';
import permission from './permission.js';

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        auth,
        invitation,
        system,
        role,
        permission,
    }
});
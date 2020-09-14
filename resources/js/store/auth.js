import axios from "axios";
import router from '../plugins/router/router';

export default {
    namespaced: true,

    state: {
        authenticated: false,
        user: null
    },

    getters: {
        authenticated (state) {
            return state.authenticated;
        },

        user (state) {
            return state.user;
        },

        can(state) {
            return (...permissions) => {
                permissions = permissions.flat();
                let permittedCount = 0;
                let userPermissions = [];
                if (state.user) userPermissions = state.user.permissions;
                permissions.forEach(permission => {
                    if (userPermissions.indexOf(permission) !== -1) permittedCount++;
                });
                return !permissions.length ? true : permittedCount === permissions.length;
            }
        },
    },

    mutations: {
        SET_AUTHENTICATED (state, value) {
            state.authenticated = value;
        },

        SET_USER (state, value) {
            state.user = value;
        }
    },

    actions: {
        

        async checkCode({}, code) {
            return await axios.post('/api/isCodeBusy', {code: code}).then(r => r.data).catch(e => e.response.data);
        },

        async signIn ({ dispatch }, creditals) {
            await axios.get('/sanctum/csrf-cookie');
            await axios.post('/login', creditals);

            return dispatch('me');
        },

        async signOut ({ dispatch }) {
            await axios.post('/logout');
            router.push({name: 'main'});
            return dispatch('me');
        },

        async register ({dispatch}, creditals) {
            let res = await axios.post('register', creditals).then(r => r.status).catch(e => e.response.data);
            dispatch('me');
            return res;
        },

        me ({ commit }) {
            return axios.get('/api/user').then((response) => {
                commit('SET_AUTHENTICATED', true)
                commit('SET_USER', response.data)
            }).catch(() => {
                commit('SET_AUTHENTICATED', false)
                commit('SET_USER', null)
            })
        }
    }
}
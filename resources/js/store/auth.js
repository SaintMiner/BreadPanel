import axios from "axios";

export default {
    namespaced: true,

    state: {
        authenticated: false,
        user: null
    },

    getters: {
        authenticated (state) {
        return state.authenticated
        },

        user (state) {
        return state.user
        },
    },

    mutations: {
        SET_AUTHENTICATED (state, value) {
        state.authenticated = value
        },

        SET_USER (state, value) {
        state.user = value
        }
    },

    actions: {
        async checkCode({}, code) {
            await axios.post('/api/isCodeBusy', {code: code}).then(response => {
                console.log(response);
            }).catch(e => {
                console.error(e);
            }); 
        },

        async signIn ({ dispatch }, creditals) {
            await axios.get('/sanctum/csrf-cookie');
            await axios.post('/login', creditals);

            return dispatch('me');
        },

        async signOut ({ dispatch }) {
            await axios.post('/logout');

            return dispatch('me');
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
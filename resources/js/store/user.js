import axios from "axios";

export default {
    namespaced: true,

    state: {
        users: [],
        viewingUser: null,
        crumbTop: [],

        loading: false,
        loadingViewingUser: false,
    },

    
    getters: {
        users(state) {
            return state.users;
        },
        
        viewingUser(state) {
            return state.viewingUser
        },

        crumbTop(state) {
            return state.crumbTop;
        },

        loading(state) {
            return state.loading;
        },

        loadingViewingUser(state) {
            return state.loadingViewingUser;
        }
    },

    mutations: {
        SET_DATA(state, data) {
            state.users = data;
            state.loading = false;
        },

        SET_CRUMB_TOP_DATA(state, data) {
            state.crumbTop = data;
        },

        SET_VIEWING_USER(state, data) {
            state.viewingUser = data;
            state.loadingViewingUser = false;
        }
    },

    actions: {
        async fetch({ commit, state }) {            
            state.loading = true;
            return await axios.get('/api/users').then(response => {
                commit('SET_DATA', response.data);
            });
        },
        
        async viewUser({ commit, state }, id) {
            state.loadingViewingUser = true;
            return await axios.get(`/api/users/${id}`).then(response => {
                commit('SET_VIEWING_USER', response.data);
            });
        },

        async block({ dispatch, rootState }, data) {
            if (rootState.auth.user.id == data.id) {
                return alert('You can\'t block/(unblock?) yourself!');
            }
            await axios.get(`/api/users/${data.id}/block`);
            return dispatch('fetch');
        },

        async crumbTop({ commit }) {
            return await axios.get(`/api/crumbtop`).then(response => {
                commit('SET_CRUMB_TOP_DATA', response.data);
            });
        },

        async setInitialAvatar({}, data) {
            return await axios.post('/api/setInitialAvatar', data);
        },

        // async store({ dispatch }, data) {
        //     await axios.post('/api/user', data);
        //     return dispatch('fetch');
        // },

        // async update({ dispatch }, data) {
        //     await axios.patch(`/api/user/${data.id}`, data);
        //     return dispatch('fetch');
        // },

        // async delete({ dispatch }, id) {
        //     await axios.delete(`/api/user/${id}`);
        //     return dispatch('fetch');
        // }
    }
}
import axios from "axios";

export default {
    namespaced: true,

    state: {
        users: [],
        crumbTop: [],
        loading: false,
    },

    
    getters: {
        users(state) {
            return state.users;
        },

        crumbTop(state) {
            return state.crumbTop;
        },

        loading(state) {
            return state.loading;
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
    },

    actions: {
        async fetch({ commit, state }) {            
            state.loading = true;
            return await axios.get('/api/users').then(response => {
                commit('SET_DATA', response.data);
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
        }
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
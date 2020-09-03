import axios from "axios";

export default {
    namespaced: true,

    state: {
        invitations: [],
    },

    
    getters: {
        invitations(state) {
            return state.invitations;
        }
    },

    mutations: {
        SET_DATA(state, data) {
            state.invitations = data;
        }
    },

    actions: {
        async generate({ dispatch }) {
            await axios.get('/api/invitation/generate');
            return dispatch('fetch');
        },

        async fetch({commit}) {
            return await axios.get('/api/invitation').then(response => {
                commit('SET_DATA', response.data);
            });
        },
    }
}
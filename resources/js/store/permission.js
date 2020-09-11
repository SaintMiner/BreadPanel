import axios from "axios";

export default {
    namespaced: true,

    state: {
        permissions: [],
    },

    
    getters: {
        permissions(state) {
            return state.permissions;
        }
    },

    mutations: {
        SET_DATA(state, data) {
            state.permissions = data;
        }
    },

    actions: {
        async fetch({ commit }) {
            return await axios.get('/api/permission').then(response => {
                commit('SET_DATA', response.data);
            });
        }
    }
}
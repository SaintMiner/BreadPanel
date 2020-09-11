import axios from "axios";

export default {
    namespaced: true,

    state: {
        roles: [],
        loading: false,
    },

    
    getters: {
        roles(state) {
            return state.roles;
        },

        loading(state) {
            return state.loading;
        }
    },

    mutations: {
        SET_DATA(state, data) {
            state.roles = data;
            state.loading = false;
        }
    },

    actions: {
        async fetch({ commit, state }) {            
            state.loading = true;
            return await axios.get('/api/role').then(response => {
                commit('SET_DATA', response.data);
            });
        },
        
        async store({ dispatch }, data) {
            await axios.post('/api/role', data);
            return dispatch('fetch');
        },

        async update({ dispatch }, data) {
            await axios.patch(`/api/role/${data.id}`, data);
            return dispatch('fetch');
        },

        async delete({ dispatch }, id) {
            await axios.delete(`/api/role/${id}`);
            return dispatch('fetch');
        }
    }
}
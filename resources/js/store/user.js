import axios from "axios";

export default {
    namespaced: true,

    state: {
        users: [],
        loading: false,
    },

    
    getters: {
        users(state) {
            return state.users;
        },

        loading(state) {
            return state.loading;
        }
    },

    mutations: {
        SET_DATA(state, data) {
            state.users = data;
            state.loading = false;
        }
    },

    actions: {
        async fetch({ commit, state }) {            
            state.loading = true;
            return await axios.get('/api/users').then(response => {
                commit('SET_DATA', response.data);
            });
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
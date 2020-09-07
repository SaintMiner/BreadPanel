import axios from "axios";
import { update } from "lodash";
import { Store } from "vuex";

export default {
    namespaced: true,

    state: {
        roles: [],
    },

    
    getters: {
        roles(state) {
            return state.invitations;
        }
    },

    mutations: {
        SET_DATA(state, data) {
            state.roles = data;
        }
    },

    actions: {
        async fetch({ commit }) {
            return await axios.get('/api/role').then(response => {
                commit('SET_DATA', response.data);
            });
        },
        
        async Store({ dispatch }, data) {

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
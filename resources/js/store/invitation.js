import axios from "axios";
import { update } from "lodash";

export default {
    namespaced: true,

    state: {
        invitations: [],
        loading: false,
    },

    
    getters: {
        invitations(state) {
            return state.invitations;
        },

        loading(state) {
            return state.loading;
        }
    },

    mutations: {
        SET_DATA(state, data) {
            state.invitations = data;
            state.loading = false;
        }
    },

    actions: {
        async generate({ dispatch }) {
            await axios.get('/api/invitation/generate');
            return dispatch('fetch');
        },

        async fetch({ commit, state }) {
            state.loading = true;
            return await axios.get('/api/invitation').then(response => {
                commit('SET_DATA', response.data);
            });
        },

        async update({ dispatch }, data) {
            await axios.patch(`/api/invitation/${data.id}`, data);
            return dispatch('fetch');
        },

        async delete({ dispatch }, id) {
            await axios.delete(`/api/invitation/${id}`);
            return dispatch('fetch');
        }
    }
}
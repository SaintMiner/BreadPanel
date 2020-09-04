export default {
    namespaced: true,

    state: {
        drawerState: true,
    },

    mutations: {
        toggleDrawerState (state, data) {
            state.drawerState = data;
        }
    },

    getters: {
        drawerState: (state) => state.drawerState,
    },


}
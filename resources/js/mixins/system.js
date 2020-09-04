export default {
    computed: {
        drawerState: {
            set(v) {
                return this.$store.commit('system/toggleDrawerState', v);
            },

            get() {
                return this.$store.getters['system/drawerState'];
            }
        }
    },
};
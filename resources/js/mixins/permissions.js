import { mapGetters } from 'vuex';

export default {
    computed: {
        ...mapGetters({
            can: 'auth/can'
        })
    }
};
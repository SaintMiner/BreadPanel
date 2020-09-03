import axios from "axios";

export default {
    namespaced: true,

    actions: {
        async generate() {
            return await axios.get('/api/invitation/generate');
        }
    }
}
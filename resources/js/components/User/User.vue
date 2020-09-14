<template>
    <v-container>
        <v-card>
            <v-card-title>
                <span> Users </span>
                <v-spacer></v-spacer>
            </v-card-title>
            <v-data-table
                v-model="selectedUsers"
                show-select
                class="elevation-1"
                :items="users"
                :headers="headers"
                :loading="loading"
            >
                <template v-slot:item.actions="{ item }">
                    <v-icon
                        small
                        class="mr-2"
                    >
                        mdi-pencil
                    </v-icon>
                </template>
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
export default {
    data() {
        return {
            selectedUsers: [],
            headers: [
                {text: 'Username', value: 'username'},
                {text: 'Invitation', value: 'invitation'},
                {text: 'Registered', value: 'created_at'},
                {text: 'Actions', value: 'actions', sortable: false},
            ],
        }
    },

    computed: {
        ...mapGetters({
            users: 'user/users',
            loading: 'user/loading',
        })
    },

    methods: {
        ...mapActions({
            fetch: 'user/fetch'
        }),
    },
    
    mounted() {
        this.fetch();
    }
}
</script>

<style>

</style>
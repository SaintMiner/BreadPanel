<template>
    <v-container>
        <v-card>
            <v-card-title>
                <span> Invitations </span>
                <v-spacer></v-spacer>
                <v-btn class="primary" @click="generate">Generate code</v-btn>
            </v-card-title>
            <v-data-table
                v-model="selectedInvitations"
                show-select
                class="elevation-1"
                :items="invitations"
                :headers="headers"
            >
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
export default {
    data() {
        return {
            selectedInvitations: [],
            headers: [
                {text: 'Code', value: 'code'},
                {text: 'Used by', value: 'used_by'},
                {text: 'Created by', value: 'created_by'},
                {text: 'Created at', value: 'created_at'},
            ],
        }
    },

    computed: {
        ...mapGetters({
            invitations: 'invitation/invitations',
        })
    },

    methods: {
        ...mapActions({
            generate: 'invitation/generate',
            fetch: 'invitation/fetch',
        })
    },

    mounted() {
        this.fetch();
    }
}
</script>

<style>
    
</style>
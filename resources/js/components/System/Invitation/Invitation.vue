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

                :headers="headers"
            >
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
import { mapActions } from 'vuex'
export default {
    data() {
        return {
            selectedInvitations: [],
            headers: [
                {text: 'Code', value: 'code'},
                {text: 'Created by', value: 'created by'},
                {text: 'Created at', value: 'created at'},
            ],
        }
    },

    methods: {
        ...mapActions({
            generate: 'invitation/generate',
        })
    }
}
</script>

<style>
    
</style>
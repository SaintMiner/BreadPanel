<template>
    <v-container>
        <ConfirmModal :dialog="confirmDeleteModal" 
            text="Are you sure you want to delete this invitation code?" 
            persistent
            @cancelAction="confirmDeleteModal = false"
            @acceptAction="acceptDelete"
        ></ConfirmModal>
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
            <template v-slot:item.actions="{ item }">
                <v-icon
                    small
                    class="mr-2"
                    @click="editItem(item)"
                >
                    mdi-pencil
                </v-icon>
                <v-icon
                    small
                    @click="deleteItem(item)"
                >
                    mdi-delete
                </v-icon>
                </template>
            </v-data-table>
        </v-card>
    </v-container>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
import ConfirmModal from '../ConfirmModal';

export default {

    components: {
        ConfirmModal,
    },

    data() {
        return {
            selectedInvitations: [],
            headers: [
                {text: 'Code', value: 'code'},
                {text: 'Used by', value: 'used_by'},
                {text: 'Expires at', value: 'expires_at'},
                {text: 'Created by', value: 'created_by'},
                {text: 'Created at', value: 'created_at'},
                {text: 'Actions', value: 'actions', sortable: false},
            ],

            confirmDeleteModal: false,
            targetItem: {},
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
            deleteInvitation: 'invitation/delete',
        }),

        deleteItem(item) {
            this.targetItem = item;
            this.confirmDeleteModal = true;
        },

        acceptDelete() {
            this.deleteInvitation(this.targetItem.id);
            this.confirmDeleteModal = false;
        },

        editItem(item) {
            console.log(item);
        }
    },

    mounted() {
        this.fetch();
    }
}
</script>

<style>
    
</style>
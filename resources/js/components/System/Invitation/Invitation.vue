<template>
    <v-container>
        <ConfirmModal :dialog="confirmDeleteModal" 
            text="Are you sure you want to delete this invitation code?" 
            persistent
            @cancelAction="confirmDeleteModal = false"
            @acceptAction="acceptDelete"
        ></ConfirmModal>
        <v-dialog v-model="invitationFormModal" max-width="500px" persistent>
            <v-card>
            <invitationForm :item="targetItem" @close="closeInvitationFormModal" @save="saveInvitationFormModal"></invitationForm>
            </v-card>
        </v-dialog>
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
                :loading="loading"
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
import invitationForm from './InvitationForm';
export default {

    components: {
        ConfirmModal,
        invitationForm,
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
            invitationFormModal: false,
            targetItem: {
                id: 0,
                expires_at: null,
                code: '',
            },
            defaultItem: {
                id: 0,
                expires_at: null,
                code: '',
            },
        }
    },

    computed: {
        ...mapGetters({
            invitations: 'invitation/invitations',
            loading: 'invitation/loading',
        })
    },

    methods: {
        ...mapActions({
            generate: 'invitation/generate',
            fetch: 'invitation/fetch',
            update: 'invitation/update',
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
            this.invitationFormModal = true;
            this.targetItem = Object.assign({}, item);
            console.log(item);
        },

        closeInvitationFormModal() {
            this.invitationFormModal = false;
            this.targetItem = Object.assign({}, this.defaultItem);;
        },

        saveInvitationFormModal() {
            this.invitationFormModal = false;
            console.log(this.targetItem);
            this.update(this.targetItem);
            this.targetItem = Object.assign({}, this.defaultItem);;
        }
    },

    mounted() {
        this.fetch();
    }
}
</script>

<style>
    
</style>
<template>
    <v-container>
        <ConfirmModal :dialog="confirmDeleteModal" 
            text="Are you sure you want to delete this role?" 
            persistent
            @cancelAction="confirmDeleteModal = false"
            @acceptAction="acceptDelete"
        ></ConfirmModal>
        <v-card class="elevation-0">
            <v-card-title>
                <!-- <v-btn class="success" @click="addRolePanel">Save all</v-btn> -->
                <v-spacer></v-spacer>
                <v-btn class="primary" @click="addRolePanel" :disabled="newRole">New role</v-btn>
            </v-card-title>
            <v-progress-linear v-show="loading"
                indeterminate
            ></v-progress-linear>
            <v-expansion-panels inset hover v-model="rolePanel">
                <v-expansion-panel v-for="role in roles" :key="role.id">
                    <v-expansion-panel-header> {{role.name}} </v-expansion-panel-header>
                    <v-expansion-panel-content> 
                        
                        <v-row no-gutters>
                            <v-col cols="6">
                                <v-form v-model="role.valid">
                                    <v-row class="label-fix">
                                        <v-col cols="12"> <v-text-field v-model="role.name" :rules="[rules.required, rules.minimal, rules.maximal]" label="Name" counter="50"> </v-text-field> </v-col>
                                        <v-col v-for="permission in permissions":key="permission.id" cols="4">
                                            <v-checkbox :label="permission.name" :value="permission.id" v-model="role.permissions"></v-checkbox>
                                        </v-col>
                                    </v-row>
                                </v-form>
                            </v-col>
                            <v-spacer></v-spacer>
                            <v-divider 
                                vertical
                                class="mx-4"
                            ></v-divider>

                            <v-col cols="3" >
                                <div class="mt-5">
                                    <v-form v-model="role.valid">
                                        <v-color-picker
                                            mode="hexa"
                                            hide-inputs
                                            flat
                                            v-model="role.color"
                                        ></v-color-picker>
                                        <v-divider></v-divider>
                                        <v-textarea v-model="role.description" :rules="[rules.counter]" counter="255"></v-textarea>
                                    </v-form>
                                </div>
                            </v-col>
                        </v-row>

                            <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                text
                                color="error"
                                @click="deleteRole(role)"
                            >
                                Delete
                            </v-btn>
                            <v-btn
                                text
                                color="secondary"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                text
                                color="primary"
                                :disabled="!role.valid"
                                @click="saveRole(role)"
                            >
                                Save
                            </v-btn>
                            </v-card-actions>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
        
        </v-card>
    </v-container>
</template>

<script>
import ConfirmModal from '../ConfirmModal';
import { mapActions, mapGetters } from 'vuex';
import rulesMixin from "../../../mixins/rules.js";

export default {
    mixins: [rulesMixin],

    components: {
        ConfirmModal,
    },

    data() {
        return {
            rolePanel: null,
            newRole: false,
            confirmDeleteModal: false,
            targetItem: null,
            rules: {
                maximal: value => !!value ? value.length <= 50 || 'Max 50 characters' : true,
            }
        }
    },

    computed: {
        ...mapGetters({
            roles: 'role/roles' ,
            loading: 'role/loading',
            permissions: 'permission/permissions',
        }),
    },

    methods: {
        ...mapActions({
            fetch: 'role/fetch' ,
            loadPermissions: 'permission/fetch',
            store: 'role/store',
            update: 'role/update',
            delete: 'role/delete',
        }),

        check(permission) {
            console.log(permission);
        },

        addRolePanel() {
            this.newRole = true;
            this.roles.unshift({name: '', description: '', isNew: true, permissions: [], color: '#808080'});
            this.$nextTick(() => {
                this.rolePanel = this.roles.length - 1;
            })
        },

        saveRole(role) {
            if (role.isNew) {
                this.store(role);
                this.newRole = false;
            } else {
                this.update(role);                
            }
        },
        
        deleteRole(role) {
            this.targetItem = role;
            this.confirmDeleteModal = true;
        },

        acceptDelete() {
            this.confirmDeleteModal = false;
            this.delete(this.targetItem.id);
            this.targetItem = null;
        }

    },

    mounted() {
        this.loadPermissions();
        this.fetch();
    }
}
</script>

<style>
    .label-fix label {
        margin: 0;
    }
</style>
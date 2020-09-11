<template>
    <v-container>
        <v-card class="elevation-0">
            <v-card-title>
                <v-btn class="success" @click="addRolePanel">Save all</v-btn>
                <v-spacer></v-spacer>
                <v-btn class="primary" @click="addRolePanel" :disabled="newRole">New role</v-btn>
            </v-card-title>
        <v-expansion-panels inset hover v-model="rolePanel">
            <v-expansion-panel v-for="role in roles" :key="role.id">
                <v-expansion-panel-header> {{role.name}} </v-expansion-panel-header>
                <v-expansion-panel-content> 
                    
                    <v-row no-gutters>
                        <v-col cols="6">
                            <v-form v-model="role.valid">
                                <v-row class="label-fix">
                                    <v-col cols="12"> <v-text-field v-model="role.name" label="Name" counter="50"> </v-text-field> </v-col>
                                    <v-col v-for="permission in permissions":key="permission.id" cols="4">
                                        <v-checkbox :label="permission.name"></v-checkbox>
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
                                <v-textarea v-model="role.description" :rules="[rules.counter]"></v-textarea>
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
import { mapActions, mapGetters } from 'vuex';
import rulesMixin from "../../../mixins/rules.js";

export default {
    mixins: [rulesMixin],

    data() {
        return {
            rolePanel: null,
            newRole: false,
        }
    },

    computed: {
        ...mapGetters({
            roles: 'role/roles' ,
            permissions: 'permission/permissions',
        }),
    },

    methods: {
        ...mapActions({
            fetch: 'role/fetch' ,
            loadPermissions: 'permission/fetch',
            store: 'role/store',
            update: 'role/update',
        }),

        addRolePanel() {
            this.newRole = true;
            this.roles.unshift({name: '', description: '', isNew: true});
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
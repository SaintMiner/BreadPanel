<template>
    <v-container>
        <v-dialog v-model="manageRolesDialog" width="600">
            <v-card>
                <v-card-title> {{managingUser.username}} user roles manage </v-card-title>
                <v-row class="label-fix mx-5" no-gutters>
                    <v-col v-for="role in roles" :key="role.id" cols="4">
                        <v-checkbox :label="role.name" :value="role.id" v-model="managingUser.roles"></v-checkbox>
                    </v-col>
                </v-row>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn @click="manageRolesDialog = false"> close </v-btn>
                    <v-btn color='primary' @click="saveUserRoles"> save </v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
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
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">                            
                            <v-icon v-bind="attrs" v-on="on"
                                small
                                class="mr-2"
                                @click=""
                            >
                                mdi-cash-plus
                            </v-icon>
                        </template>
                        <span>give crumbs</span>
                    </v-tooltip>

                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">                            
                            <v-icon v-bind="attrs" v-on="on"
                                small
                                class="mr-2"
                                @click=""
                            >
                                mdi-cash-minus
                            </v-icon>
                        </template>
                        <span>take crumbs</span>
                    </v-tooltip>

                    <v-tooltip bottom>
                        <template v-slot:activator="{ on, attrs }">                            
                            <v-icon v-bind="attrs" v-on="on"
                                small
                                class="mr-2"
                                @click="manageRoles(item)"
                            >
                                mdi-account-group
                            </v-icon>
                        </template>
                        <span>Manage roles</span>
                    </v-tooltip>

                    <v-tooltip bottom v-if="can('manage users')">
                        <template v-slot:activator="{ on, attrs }">                            
                            <v-icon v-bind="attrs" v-on="on"
                                small
                                class="mr-2"
                                @click="block(item)"
                            >
                                mdi-account-cancel{{item.blocked ? '-outline' : ''}}
                            </v-icon>
                        </template>
                        <span>{{item.blocked ? 'un' : ''}}block user</span>
                    </v-tooltip>                     
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
                {text: 'Crumbs', value: 'crumbs'},
                {text: 'Actions', value: 'actions', sortable: false},
            ],

            managingUser: {
                id: 0,
                username: '',
                roles: [],
            },
            manageRolesDialog: false,
        }
    },

    computed: {
        ...mapGetters({
            users: 'user/users',
            loading: 'user/loading',
            roles: 'role/roles',
        })
    },

    methods: {
        ...mapActions({
            fetch: 'user/fetch',
            block: 'user/block',
            assignRoles: 'user/assignRoles',
            fetchRoles: 'role/fetch' ,
        }),

        manageRoles(item) {
            this.manageRolesDialog = true;
            this.managingUser = Object.assign({}, {id: item.id, username: item.username, roles: item.roles.map(role => role.id)});
        },

        saveUserRoles() {
            this.manageRolesDialog = false;
            this.assignRoles(this.managingUser);
            this.managingUser = {id: 0, username: '', roles: []};
        }

    },
    
    mounted() {
        this.fetch();
        this.fetchRoles();
    }
}
</script>

<style>
    .label-fix label {
        margin: 0;
    }
</style>
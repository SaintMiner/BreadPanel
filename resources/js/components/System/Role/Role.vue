<template>
    <v-container>
        <v-card class="elevation-0">
            <v-card-title>
                <v-btn class="success" @click="addRolePanel">Save all</v-btn>
                <v-spacer></v-spacer>
                <v-btn class="primary" @click="addRolePanel">New role</v-btn>
            </v-card-title>
        <v-expansion-panels inset hover v-model="rolePanel">
            <v-expansion-panel v-for="role in roles" :key="role.id">
                <v-expansion-panel-header> {{role.name}} </v-expansion-panel-header>
                <v-expansion-panel-content> 
                    
                    <v-row no-gutters>
                        <v-col cols="6">
                            <v-row class="label-fix">
                            <v-col cols="12"> <v-text-field v-model="role.name" label="Name"> </v-text-field> </v-col>
                            <v-col cols="4">
                                <v-checkbox input-value="true" hide-details label="edit posts"></v-checkbox>
                            </v-col>
                            <v-col cols="4">
                                <v-checkbox label="write posts"></v-checkbox>
                            </v-col>
                            <v-col cols="4">
                                <v-checkbox indeterminate label="delete posts"></v-checkbox>
                            </v-col>
                            <v-col cols="4">
                                <v-checkbox indeterminate label="Moderate posts"></v-checkbox>
                            </v-col>
                            </v-row>
                        </v-col>
                        <v-spacer></v-spacer>
                        <v-divider 
                            vertical
                            class="mx-4"
                        ></v-divider>

                        <v-col cols="3">
                            <div class="mt-5"> {{role.description}} </div>
                        </v-col>
                    </v-row>

                        <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            text
                            color="error"
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
export default {
    data() {
        return {
            rolePanel: [],
            roles: [
                {
                    name: 'Writer',
                    description: 'That is the description of this role. Writer can write. Yes....',
                    isNew: false,
                }
            ]
        }
    },

    computed: {
        ...mapGetters({
            roles: 'role/roles' ,
        }),
    },

    methods: {
        ...mapActions({
            fetch: 'role/fetch' ,
        }),

        addRolePanel() {
            this.roles.push({name: '', description: '', isNew: true});
        },
    },

    mounted() {
        this.fetch();
    }
}
</script>

<style>
    .label-fix label {
        margin: 0;
    }
</style>
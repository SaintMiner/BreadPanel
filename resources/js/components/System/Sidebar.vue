<template>
    <v-navigation-drawer v-model="drawerState" app clipped>
            <v-list>
                <template v-for="item in items" >
                    <v-list-item link class="sidebar-link-clear" :to="item.path" :key="item.id" v-if="can(item.permissions)">
                        <v-list-item-action>
                            <v-icon>{{item.icon}}</v-icon>
                        </v-list-item-action>
                        <v-list-item-content>
                            <v-list-item-title>{{item.title}}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </template>
            </v-list>
        </v-navigation-drawer>
</template>

<script>
import { mapMutations } from 'vuex'
export default {
    name: 'Sidebar',

    data() {
        return {
            items: [
                {
                    title: 'Invitations',
                    path: 'invitation',
                    icon: 'mdi-label',
                    permissions: ['invite manager'],
                },
                {
                    title: 'Permission',
                    path: 'permission',
                    icon: 'mdi-label',
                    permissions: [],
                },
                {
                    title: 'Role',
                    path: 'role',
                    icon: 'mdi-label',
                    permissions: [],
                },
            ]
        }
    },

    
}
</script>

<style>
    .sidebar-link-clear {
        text-decoration: none !important; 
        color: inherit !important;
    }
</style>
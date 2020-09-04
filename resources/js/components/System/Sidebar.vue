<template>
    <v-navigation-drawer v-model="drawerState" app clipped>
            <v-list>
                <v-list-item v-for="item in items" :key="item.id" link class="sidebar-link-clear"
                :to="item.path">
                    <v-list-item-action>
                        <v-icon>{{item.icon}}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>{{item.title}}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
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
                },
                {
                    title: 'Permission',
                    path: 'permission',
                    icon: 'mdi-label',
                },
                {
                    title: 'Role',
                    path: 'role',
                    icon: 'mdi-label',
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
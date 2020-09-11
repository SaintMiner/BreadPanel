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
import list from '../../plugins/sidebar.json';
export default {
    name: 'Sidebar',

    data() {
        return {
            items: list,
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
<template>
    <v-navigation-drawer v-model="drawerState" app clipped>
            <v-list>
                <template v-for="item in items" >
                    <v-list-item link class="sidebar-link-clear" :to="{name: item.name}" :key="item.id" 
                        v-if="can(item.permissions) && (item.authenticated ? authenticated : true) && (item.blocked ? true : !user.blocked)">
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
import { mapGetters, mapMutations } from 'vuex'
import sidebarlist from '../../plugins/router/sidebarBuilder';
export default {
    name: 'Sidebar',

    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        })
    },

    data() {
        return {
            items: sidebarlist,
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
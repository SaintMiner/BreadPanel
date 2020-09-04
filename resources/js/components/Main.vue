<template>
    <v-app id="inspire">

        <v-app-bar app color="indigo" dark clipped-left>
            <v-app-bar-nav-icon
                @click="drawerState = !drawerState"
            ></v-app-bar-nav-icon>
            <v-toolbar-title> BreadPanel </v-toolbar-title>
            <v-spacer></v-spacer>
            <div class="my-2">
                <UserDropwownMenu></UserDropwownMenu>
            </div>
        </v-app-bar>
        
        <Sidebar></Sidebar>

        <v-main>
            <v-fade-transition mode="out-in">
                <router-view></router-view>
            </v-fade-transition>
        </v-main>
        
        <v-footer color="indigo" app inset>
            <span class="white--text"
                >&copy; {{ new Date().getFullYear() }}</span
            >
        </v-footer>
    </v-app>
</template>

<script>
import UserDropwownMenu from './User/UserDropwownMenu';
import Sidebar from './System/Sidebar';
export default {
    name: "Foo",
    
    components: {
        UserDropwownMenu,
        Sidebar,
    },

    // created () {
    //   this.$vuetify.theme.dark = true
    // },
};
</script>

<style>
    .nav-route-link {
        text-decoration: none !important; 
        color: inherit !important;
    }
</style>

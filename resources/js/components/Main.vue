<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" app clipped>
            <v-list dense>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>mdi-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Home</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>mdi-email</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Contact</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item to="invitation">
                    <v-list-item-action>
                        <v-icon>mdi-label</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Invitations</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item to="permission">
                    <v-list-item-action>
                        <v-icon>mdi-label</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Permission</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app color="indigo" dark clipped-left>
            <v-app-bar-nav-icon
                @click.stop="drawer = !drawer"
            ></v-app-bar-nav-icon>
            <v-toolbar-title> BreadPanel </v-toolbar-title>
            <v-spacer></v-spacer>
            <div class="my-2">
                <UserDropwownMenu></UserDropwownMenu>
            </div>
        </v-app-bar>

        <v-main>
            <transition name="fade">
                <router-view></router-view>
            </transition>
        </v-main>
        <v-footer color="indigo" app inset>
            <span class="white--text"
                >&copy; {{ new Date().getFullYear() }}</span
            >
        </v-footer>
    </v-app>
</template>

<script>
import UserDropwownMenu from "./User/UserDropwownMenu";
export default {
    name: "Foo",
    
    components: {
        UserDropwownMenu,
    },

    data() {
        return {
            drawer: null,            
        };
    },

    // created () {
    //   this.$vuetify.theme.dark = true
    // },
};
</script>

<style></style>

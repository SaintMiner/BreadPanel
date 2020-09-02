<template>
    <v-app id="inspire">
        <v-navigation-drawer v-model="drawer" app temporary>
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
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app color="indigo" dark>
            <v-app-bar-nav-icon
                @click.stop="drawer = !drawer"
            ></v-app-bar-nav-icon>
            <v-toolbar-title> MyPanel </v-toolbar-title>
            <v-spacer></v-spacer>
            <div class="my-2">
                <UserDropwownMenu></UserDropwownMenu>
            </div>
        </v-app-bar>

        <v-main>
            <v-container class="fill-height" fluid>
                <v-row align="center" justify="center">
                    HI
                </v-row>
            </v-container>
        </v-main>
        <v-footer color="indigo" app>
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

<template>
    
        <v-menu v-model="userMenu" offset-y :close-on-content-click="false" :nudge-width="authenticated ? 0 : 400">
            <template v-slot:activator="{ on, attrs }">
                <v-btn class="ma-2" text v-bind="attrs"
                    v-on="on">
                    {{authenticated ? user.username : 'Login'}}
                    <v-icon right>{{authenticated ? 'mdi-account-circle' : 'mdi-login'}}</v-icon>
                </v-btn>
            </template>
            <v-card class="elevation-12" v-if="!authenticated"
                ref="form"
                lazy-validation
            >   
                <v-toolbar
                    dark
                    flat
                >
                    <v-toolbar-title>Login form</v-toolbar-title>
                    <v-spacer></v-spacer>
                </v-toolbar>
                <v-card-text>
                    <v-form>
                        <v-text-field
                        flat
                        v-model="username"
                        label="Username"
                        :error="invalid"
                        @input="clearLoginError"
                        ></v-text-field>

                        <v-text-field
                        v-model="password"
                        label="Password"
                        type="password"
                        :error-messages="invalidMessage"
                        :error="invalid"
                        @input="clearLoginError"
                        ></v-text-field>
                        
                    </v-form>
                </v-card-text>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text to="register">Register</v-btn>
                    <v-btn color="primary" text @click="sendLoginRequest">Login</v-btn>
                </v-card-actions>
                <v-progress-linear v-show="loginFormLoading"
                    indeterminate
                ></v-progress-linear>
            </v-card>
            <v-card v-else
                class="mx-auto"
                width="256"
                tile
            >
                    <v-subheader>ACTIONS</v-subheader>
                    <v-divider></v-divider>
                    <v-list
                        nav
                        dense
                    >
                        <v-list-item @click="sendLogoutRequest">
                            <v-list-item-icon>
                                <v-icon>mdi-logout</v-icon>
                            </v-list-item-icon>
                            <v-list-item-content>
                                <v-list-item-title>Log Out</v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
            </v-card>
        </v-menu>
    
</template>

<script>
import { mapActions } from 'vuex';
import { mapGetters } from 'vuex'

export default {
    name: "UserDropwownMenu",

    data() {
        return {
            loginFormLoading: false,
            userMenu: false,
            username: null,
            password: null,
            invalid: false,
            invalidMessage: '',
        }
    },

    computed: {
        ...mapGetters({
            authenticated: 'auth/authenticated',
            user: 'auth/user',
        })
    },

    methods: {
        ...mapActions({
            signIn: 'auth/signIn',
            signOut: 'auth/signOut'
        }),

        async sendLoginRequest() {
            this.loginFormLoading = true;
            this.clearLoginError();
            await this.signIn({username: this.username, password: this.password}).then(repsonse => {
                this.loginFormLoading = this.userMenu = false;
                this.username = this.password = null;
            }).catch(e => {
                this.loginFormLoading = false;
                this.invalidMessage = e.response.data.message;
                this.invalid = true;
            })
        },

        async sendLogoutRequest() {
            this.userMenu = false;
            await this.signOut();
        },

        clearLoginError() {
            this.invalid = false;
            this.invalidMessage = '';
        }
    }
}
</script>

<style>

</style>
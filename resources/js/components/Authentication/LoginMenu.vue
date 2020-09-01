<template>
    <v-menu v-model="loginMenu" offset-y :close-on-content-click="false" :nudge-width="400">
        <template v-slot:activator="{ on, attrs }">
            <v-btn 
                text
                fab
                v-bind="attrs"
                v-on="on"
            >
                <div v-if="authenticated">{{user.name}}</div>
                <v-icon>mdi-account-circle</v-icon>
            </v-btn>
        </template>
        <v-card class="elevation-12" 
            ref="form"
            lazy-validation
        >   
            <v-toolbar
                color="primary"
                dark
                flat
            >
                <v-toolbar-title>Login form</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-tooltip bottom>                  
                </v-tooltip>
            </v-toolbar>
            <v-card-text>
                <v-form>
                    <v-text-field
                    flat
                    v-model="username"
                    label="Username"
                    ></v-text-field>

                    <v-text-field
                    v-model="password"
                    label="Password"
                    type="password"
                    ></v-text-field>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" text>Register</v-btn>
                <v-btn color="primary" text @click="sendLoginRequest">Login</v-btn>
            </v-card-actions>
        </v-card>
    </v-menu>
</template>

<script>
import { mapActions } from 'vuex';
import { mapGetters } from 'vuex'

export default {
    name: "LoginMenu",

    data() {
        return {
            loginMenu: false,
            username: null,
            password: null,
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
            signIn: 'auth/signIn'
        }),

        async sendLoginRequest() {
            await this.signIn({email: this.username, password: this.password}).then(repsonse => {
                console.log(repsonse);
            }).catch(e => {
                console.error(e);
            })
        }
    }
}
</script>

<style>

</style>
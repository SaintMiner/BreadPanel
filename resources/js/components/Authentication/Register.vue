<template>
    <div id="inspire">
        <v-main>
            <v-container class="fill-height" fluid>
                <v-row align="center" justify="center">
                    <v-col cols="12" sm="8" md="6" class="mt-5">
                        <v-card class="elevation-12">
                            <v-toolbar color="primary" dark flat>
                                <v-toolbar-title>Register form</v-toolbar-title>
                            </v-toolbar>
                            <v-card-text>
                                <v-form>
                                    <v-text-field
                                        label="Username"
                                        name="username"
                                        prepend-icon="mdi-account"
                                        type="text"
                                        v-model="registerForm.username"
                                        :rules="[rules.required, rules.counter]"
                                    ></v-text-field>

                                    <v-text-field
                                        label="Password"
                                        name="password"
                                        prepend-icon="mdi-lock"
                                        type="password"
                                        v-model="registerForm.password"
                                        :rules="[rules.required, rules.counter]"
                                    ></v-text-field>

                                    <v-text-field
                                        label="Confirm password"
                                        name="confirmPassword"
                                        prepend-icon="mdi-lock"
                                        type="password"
                                        v-model="registerForm.confirmPassword"
                                        :rules="[rules.required, rules.confirmPassword]"
                                    ></v-text-field>

                                    <v-text-field
                                        label="Invitation code"
                                        name="code"
                                        prepend-icon="mdi-label"
                                        type="text"
                                        v-model="registerForm.code"
                                        :rules="[rules.required]"
                                    ></v-text-field>
                                </v-form>
                            </v-card-text>
                            <v-card-actions class="mt-5">
                                <v-spacer></v-spacer>
                                <v-btn color="primary">Register</v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-col>
                </v-row>
            </v-container>
        </v-main>
    </div>
</template>

<script>
import rulesMixin from "../../mixins/rules.js";
import { mapActions } from 'vuex';

export default {
    mixins: [rulesMixin],

    data() {
        return {
            registerForm: {
                username: "",
                password: "",
                confirmPassword: "",
                invitation_code: "",
            },

            rules: {
                confirmPassword: value => value === this.registerForm.password || "Password must match",
            }
        }
    },

    methods: {
        ...mapActions({
            checkCodes: 'auth/checkCode',
        }),
    },

    mounted() {
        this.checkCodes('AA');
    }
};
</script>

<style></style>

<template>
<v-app id="inspire">
    <v-main>
        <v-container class="fill-height" fluid>
            <v-row align="center" justify="center">
                <v-col cols="12" sm="8" md="6" class="mt-5">
                    <v-card class="elevation-12">
                        <v-toolbar color="primary" dark flat>
                            <v-toolbar-title>Register form</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-form v-model="validForm" ref="registerForm">
                                <v-text-field
                                    label="Username"
                                    name="username"
                                    prepend-icon="mdi-account"
                                    type="text"
                                    v-model="username"
                                    :rules="[rules.required, rules.counter, rules.minimal, rules.excludeSpecialChars]"
                                    :loading="loadingCheckUsername"
                                    :success="success.username"
                                    :error-messages="errors.username"
                                ></v-text-field>

                                <v-text-field
                                    label="Password"
                                    name="password"
                                    prepend-icon="mdi-lock"
                                    type="password"
                                    v-model="registerForm.password"
                                    :rules="[rules.required, rules.password, rules.counter]"
                                    :loading="!!registerForm.password && focused.password"
                                    @focus="focused.password = true"
                                    @blur="focused.password = false"
                                >
                                    <template v-slot:progress>
                                        <v-progress-linear                                            
                                        :value="passwordProgress"
                                        :color="passwordBarColor"
                                        absolute
                                        height="3"
                                        ></v-progress-linear>
                                    </template>
                                </v-text-field>

                                <v-text-field
                                    label="Confirm password"
                                    name="password_confirmation"
                                    prepend-icon="mdi-lock"
                                    type="password"
                                    v-model="registerForm.password_confirmation"
                                    :rules="[rules.required, rules.password_confirmation]"
                                ></v-text-field>
                                
                                <v-text-field
                                    label="Invitation code"
                                    name="code"
                                    prepend-icon="mdi-label"
                                    type="text"
                                    :rules="[rules.required]"
                                    v-model="invitation_code"
                                    :loading="loadingCheckCode"
                                    :success="success.invitation_code"
                                    :error-messages="errors.invitation_code"
                                ></v-text-field>
                            </v-form>
                        </v-card-text>
                        <v-card-actions class="mt-5">
                            <v-spacer></v-spacer>
                            <v-btn color="primary" :disabled="!validForm || !success.invitation_code || !success.username" @click="register">Register</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>
            </v-row>
        </v-container>
    </v-main>
</v-app>
</template>

<script>
import rulesMixin from "../../mixins/rules.js";
import { mapActions } from 'vuex';

export default {
    mixins: [rulesMixin],

    data() {
        return {
            validForm: true,

            registerForm: {
                username: "",
                password: "",
                password_confirmation: "",
                invitation_code: "",
            },

            success: {
                invitation_code: false,
            },

            errors: {
                invitation_code: [],
            },

            focused: {
                password: false,
            },

            requestCodeTimeout: null,
            loadingCheckCode: false,

            requestUsernameTimeout: null,
            loadingCheckUsername: false,

            rules: {
                password_confirmation: value => value === this.registerForm.password || "Password must match",
            }
        }
    },

    computed: {
        
        username: {
            set(value) {
                this.registerForm.username = value;
                this.errors.username = [];
                this.success.username = false;
                this.checkUserUsername();
            },

            get() {
                return this.registerForm.username;
            }
        },

        invitation_code: {
            set(value) {
                this.registerForm.invitation_code = value;
                this.errors.invitation_code = [];
                this.success.invitation_code = false;
                this.checkUserCode();
            },

            get() {
                return this.registerForm.invitation_code;
            }
        },

        passwordBarColor () {
            return ['error', 'warning', 'success'][Math.floor(this.passwordProgress / 40)]
        },

        passwordProgress () {
            let power = 0;
            const digits = /^(?=.*\d).{0,}$/;
            const lowerCase = /^(?=.*[a-z]).{0,}$/;
            const upperCase = /^(?=.*[A-Z]).{0,}$/;
            const special = /[^A-Za-z0-9]+/;
            if (this.registerForm.password.length >= 8) power++;
            if (this.registerForm.password.length >= 15) power++;
            if (this.registerForm.password.length >= 20) power+=2;
            if (digits.test(this.registerForm.password)) power++;
            if (lowerCase.test(this.registerForm.password)) power++;
            if (upperCase.test(this.registerForm.password)) power++;
            if (special.test(this.registerForm.password)) power+=3;
            return Math.min(100, power * 10);
        },
    },

    methods: {
        ...mapActions({
            checkCode: 'auth/checkCode',
            checkUsername: 'auth/checkUsername',
            registerUser: 'auth/register',
        }),

        async checkUserUsername() {
            if (this.requestUsernameTimeout) {
                clearTimeout(this.requestUsernameTimeout);
            }

            this.requestUsernameTimeout = await setTimeout(async () => {
                if (!!this.registerForm.username) {
                    this.loadingCheckUsername = true;
                    let errorMessage = await this.checkUsername(this.registerForm.username);
                    this.loadingCheckUsername = false;
                    if (errorMessage == "Free") {
                        this.errors.username = [];
                        this.success.username = true;
                    } else {
                        this.errors.username = errorMessage;
                    }
                }
            }, 350);
        },

        async checkUserCode() {
            if (this.requestCodeTimeout) {
                clearTimeout(this.requestCodeTimeout);                
            }
            
            this.requestCodeTimeout = await setTimeout(async () => {
                if (!!this.registerForm.invitation_code) {
                    this.loadingCheckCode = true;
                    let errorMessage = await this.checkCode(this.registerForm.invitation_code);
                    this.loadingCheckCode = false;
                    if (errorMessage == "Free") {
                        this.errors.invitation_code = [];
                        this.success.invitation_code = true;
                    } else {
                        this.errors.invitation_code = errorMessage;
                    }
                }
            }, 350);
            
        },

        async register() {
            if(this.$refs.registerForm.validate()) {
                let res = await this.registerUser(this.registerForm);
                if (res === 201) {
                    this.$router.push('main');
                }
            }
        }
    },

    mounted() {
    }
};
</script>

<style></style>

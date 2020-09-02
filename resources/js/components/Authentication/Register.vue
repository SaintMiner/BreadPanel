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
                                        :rules="[rules.required, rules.password]"
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

            success: {
                invitation_code: false,
            },

            errors: {
                invitation_code: [],
            },

            focused: {
                password: false,
            },

            requestTimeout: null,
            loadingCheckCode: false,

            rules: {
                confirmPassword: value => value === this.registerForm.password || "Password must match",
            }
        }
    },

    computed: {
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
            const specialChars = /^(?=.*[$&+,:;=?@#|'<>.^*()%!-]).{0,}$/;
            if (this.registerForm.password.length >= 8) power++;
            if (this.registerForm.password.length >= 15) power++;
            if (this.registerForm.password.length >= 20) power+=2;
            if (digits.test(this.registerForm.password)) power++;
            if (lowerCase.test(this.registerForm.password)) power++;
            if (upperCase.test(this.registerForm.password)) power++;
            if (specialChars.test(this.registerForm.password)) power+=3;
            return Math.min(100, power * 10);
        },
    },

    methods: {
        ...mapActions({
            checkCode: 'auth/checkCode',
        }),

        async checkUserCode() {
            if (this.requestTimeout) {
                clearTimeout(this.requestTimeout);
            }
            
            this.requestTimeout = await setTimeout(async () => {
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
            
        }
    },

    mounted() {
    }
};
</script>

<style></style>

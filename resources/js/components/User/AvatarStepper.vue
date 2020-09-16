<template>
    <v-stepper v-model="stepper">
        <v-stepper-header>
            <v-stepper-step :complete="stepper > 1" step="1">Choose avatar type</v-stepper-step>

            <v-divider></v-divider>

            <v-stepper-step :complete="stepper > 2" step="2">Configure avatar</v-stepper-step>

            <v-divider></v-divider>

            <v-stepper-step step="3">Preview and upload</v-stepper-step>

        </v-stepper-header>

        <v-stepper-items>
            <v-stepper-content step="1">
                <v-card
                    class="mb-12 d-flex align-center justify-center"
                    height="200px"
                >
                    <div class="text-center">
                        <v-btn color="primary" dark @click="chooseType(1)">Initials</v-btn>
                        <v-btn color="primary" dark @click="chooseType(2)">Image</v-btn>
                    </div>
                </v-card>

                <v-btn text>Cancel</v-btn>
            </v-stepper-content>

            <v-stepper-content step="2">
                <v-card v-if="type == 1"
                class="mb-12"
                height="350px"
                >
                    <v-row justify="space-around" class="mx-3">
                        <v-switch v-model="initialAvatar.withInitials" label="With initials" class="label-fix"></v-switch>
                        <v-spacer></v-spacer>
                        <v-text-field counter="3" v-model="initialsModel"></v-text-field>
                        <v-spacer></v-spacer>
                    </v-row>
                    <v-row justify="space-around" class="mt-5">
                        <v-color-picker
                            hide-inputs
                            v-model="initialAvatar.color"
                            flat
                        ></v-color-picker>
                        <v-avatar :color="initialAvatar.color ? initialAvatar.color.hex : 'primary'" size="160">
                            <span class="white--text headline" v-if="initialAvatar.withInitials">{{initialsModel}}</span>
                        </v-avatar>
                    </v-row>
                </v-card>

                <v-card v-else
                class="mb-12"
                height="200px"
                >

                </v-card>

                <v-btn
                color="primary"
                @click="stepper = 3"
                >
                Continue
                </v-btn>

                <v-btn 
                    text
                    @click="stepper = 1"
                >
                    Back
                </v-btn>
            </v-stepper-content>

            <v-stepper-content step="3">
                <v-card v-if="type == 1"
                    class="mb-12"
                    height="200px"
                >
                    <v-row justify="space-around">
                        <v-avatar :color="initialAvatar.color ? initialAvatar.color.hex : 'primary'" size="160">
                            <span class="white--text headline" v-if="initialAvatar.withInitials">{{initialsModel}}</span>
                        </v-avatar>
                    </v-row>
                </v-card>

                <v-card v-else
                    class="mb-12"
                    color="grey lighten-1"
                    height="200px"
                ></v-card>

                <v-btn
                color="primary"
                @click="upload"
                >
                Upload
                </v-btn>

                <v-btn text @click="stepper = 2">Back</v-btn>
            </v-stepper-content>
        </v-stepper-items>
    </v-stepper>
</template>

<script>
import { mapActions } from 'vuex';
export default {
    data() {
        return {
            initialAvatar: {
                color: null,
                initials: '',
                withInitials: true,
            },
            stepper: 1,
            type: 1,
        }
    },

    computed: {
        initialsModel: {
            set(value) {
                if (value.length <= 3) {
                    this.initialAvatar.initials = value.toUpperCase();
                }
            },

            get() {
                return this.initialAvatar.initials;
            }
        }
    },

    methods: {
        ...mapActions({
            setInitialAvatar: 'user/setInitialAvatar'
        }),

        chooseType(type) {
            this.type = type;
            this.stepper = 2;
        },

        upload() {
            if (this.type == 1) {
                this.setInitialAvatar(this.initialAvatar);
            }
        }
    },
}
</script>

<style>
    .label-fix label {
        margin: 0;
    }
</style>
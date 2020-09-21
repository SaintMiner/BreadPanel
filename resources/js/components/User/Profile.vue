<template>
    <v-container>
        <v-dialog v-model="avatarStepper" width="666">
            <AvatarStepper @cancelStepper="closeStepper" @uploadStepper="closeStepper"></AvatarStepper>
        </v-dialog>
        <v-row align="center" justify="center" v-if="loadingViewingUser">
            <profile-skeleton></profile-skeleton>
        </v-row>
        <v-row v-else align="center" justify="center">
            <v-col>
                <v-card>

                    <v-img class="white--text align-end"
                        height="200px"
                        src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                    >
                        
                        <v-card-title> 
                            <h1 class="mx-2"> {{user.username}} </h1>
                        </v-card-title>
                    </v-img>

                    <v-row class="mx-5">
                        <v-col>
                            <v-row>
                                <v-col lg="2" sm="3" v-if="$route.params.user_id">
                                    <v-avatar :color="user.initial_background" size="160"> 
                                        <span v-if="user.initial_avatar" class="white--text headline"> <h1 v-if="user.with_initials"> {{user.initials}} </h1> </span>
                                        <img v-else :src="user.avatar" :alt="user.username" >
                                    </v-avatar>
                                </v-col>
                                <v-col lg="2" sm="3" v-else>
                                    <v-hover v-slot:default="{ hover }">
                                        <v-avatar :color="user.initial_background" size="160" @click="avatarStepper = true"> 
                                            <span v-if="user.initial_avatar" class="white--text headline"> <h1 v-if="user.with_initials"> {{user.initials}} </h1> </span>
                                            <img v-else :src="user.avatar" :alt="user.username" >
                                            <v-fade-transition>
                                                <div
                                                    v-if="hover"
                                                    class="d-flex transition-fast-in-fast-out grey darken-4 v-card--reveal white--text"
                                                    style="height: 100%;"
                                                >
                                                    <h4> Change avatar </h4>
                                                </div>
                                            </v-fade-transition>
                                            </v-img>
                                        </v-avatar>
                                    </v-hover>
                                </v-col>
                                <v-col lg="10" class="pt-0">
                                    <v-row justify="space-between">
                                        <v-col>
                                            <v-tooltip bottom v-for="role in user.roles" :key="role.id">
                                                <template v-slot:activator="{ on, attrs }">
                                                    <v-chip v-bind="attrs" v-on="on"
                                                        class="ma-2"
                                                        :color="role.color"
                                                        outlined
                                                        small
                                                    >
                                                        <v-icon left small>mdi-circle</v-icon>
                                                        {{role.name}}
                                                    </v-chip>
                                                </template>
                                            <span>{{role.description}}</span>
                                            </v-tooltip>
                                        </v-col>
                                        <v-col lg="2" class="text-right">
                                            <span class=""> #1267 </span>
                                        </v-col>
                                    </v-row>
                                    <v-col class="p-0">
                                        <v-tooltip top v-if="user.created_at">
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-chip  v-bind="attrs" v-on="on"
                                                    
                                                    class="ma-2"
                                                    label
                                                >
                                                <v-icon left>mdi-calendar</v-icon>
                                                <span> {{user.created_at}} </span>
                                                </v-chip>
                                            </template>
                                            <span> Registration date </span>
                                        </v-tooltip>
                                       
                                        <v-tooltip top v-if="user.invitation">
                                            <template v-slot:activator="{ on, attrs }">
                                                <v-chip  v-bind="attrs" v-on="on"
                                                    
                                                    class="ma-2"
                                                    label
                                                >
                                                <v-icon left>mdi-label</v-icon>
                                                <span> {{user.invitation}} </span>
                                                </v-chip>
                                            </template>
                                            <span> Invitation code </span>
                                        </v-tooltip>
                                    </v-col>
                                    <v-col class="pl-0">
                                        <v-chip v-if="user.blocked"
                                            class="ma-2"
                                            color="red"
                                            outlined
                                            small
                                        >
                                            <v-icon left small>mdi-cancel</v-icon>
                                            Blocked indefinitely :)
                                        </v-chip>
                                        <v-chip
                                            class="ma-2"
                                            color="blue"
                                            outlined
                                            small
                                        >
                                            <v-icon left small>mdi-circle</v-icon>
                                            Very happy
                                        </v-chip>
                                    </v-col>
                                </v-col>
                                
                            </v-row>
                            
                            {{user}}
                            </v-col>
                    </v-row>
                
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

import ProfileSkeleton from './ProfileSkeleton';
import AvatarStepper from './AvatarStepper';

export default {

    components: {
        'profile-skeleton': ProfileSkeleton,
        AvatarStepper,
    },

    data() {
        return {
            avatarStepper: false,
        }
    },

    computed: {
        ...mapGetters({
            me: 'auth/user',
            viewingUser: 'user/viewingUser',
            loadingViewingUser: 'user/loadingViewingUser',
        }),

        user() {
            if (this.$route.params.user_id) {
                return this.viewingUser;
            }
            return this.me;
        },

        initials() {
            if (this.user) {
                let initials = this.user.username.match(/[A-Z]/g) || [];
                initials = ((initials.shift() || '') + (initials.pop() || '')).toUpperCase();    
                return initials;
            }
        }
    },

    methods: {
        ...mapActions({
            viewUser: 'user/viewUser',
        }),

        closeStepper() {
            this.avatarStepper = false;
        },

    },

    beforeMount() {
        if (this.$route.params.user_id) {
            if (this.$route.params.user_id == this.$store.getters['auth/user'].id) {
                this.$router.push({name: 'profile'});
            } else {
                this.viewUser(this.$route.params.user_id);
            }
        }
    }
}
</script>

<style>
    .v-card--reveal {
        align-items: center;
        bottom: 0;
        justify-content: center;
        opacity: .5;
        position: absolute;
        width: 100%;
        cursor: pointer;
    }
</style>
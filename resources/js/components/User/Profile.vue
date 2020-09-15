<template>
    <v-container>
        <v-row align="center" justify="center">
            <v-col>
                <v-card>
                    <v-img class="white--text align-end"
                        height="200px"
                        src="https://cdn.vuetifyjs.com/images/cards/docks.jpg"
                    >
                        <v-card-title> 
                            <div>User {{ $route.params.id }}</div>
                            <h1 class="mx-2"> {{user.username}} </h1>
                        </v-card-title>
                    </v-img>
                    <v-row class="mx-5">
                        <v-col>
                            <v-row>
                                <v-col lg="2" sm="3">
                                    <v-avatar color="purple darken-4" size="160"> 
                                        <!-- <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John" > -->
                                        <span class="white--text headline"> <h1> {{initials}} </h1> </span>
                                    </v-avatar>
                                </v-col>
                                <v-col lg="10" class="pt-0">
                                    <v-row justify="space-between">
                                        <v-col>
                                            <!-- <v-chip-group
                                                column
                                                active-class="primary--text"
                                            > -->
                                                <v-tooltip bottom v-for="role in user.roles" :key="role.id">
                                                    <template v-slot:activator="{ on, attrs }">
                                                        <v-chip v-bind="attrs" v-on="on"
                                                            class="ma-2"
                                                            color="success"
                                                            outlined
                                                            small
                                                        >
                                                            <v-icon left small>mdi-circle</v-icon>
                                                            {{role.name}}
                                                        </v-chip>
                                                    </template>
                                                <span>{{role.description}}</span>
                                                </v-tooltip>
                                            <!-- </v-chip-group> -->
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
                                    <v-col class="p-0">
                                        <v-chip v-bind="attrs" v-on="on" v-if="user.blocked"
                                            class="ma-2"
                                            color="red"
                                            outlined
                                            small
                                        >
                                            <v-icon left small>mdi-cancel</v-icon>
                                            Blocked indefinitely :)
                                        </v-chip>
                                        <v-chip v-bind="attrs" v-on="on"
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
import { mapGetters } from 'vuex'
export default {
    computed: {
        ...mapGetters({
            user: 'auth/user',
        }),

        initials() {
            if (this.user) {
                let initials = this.user.username.match(/[A-Z]/g) || [];
                initials = ((initials.shift() || '') + (initials.pop() || '')).toUpperCase();    
                return initials;
            }
        }
    }
}
</script>

<style>

</style>
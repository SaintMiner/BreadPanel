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
                            
                            <h1 class="mx-2"> {{user.username}} </h1>
                        </v-card-title>
                    </v-img>
                    <v-row class="mx-5">
                        <v-col>
                            <v-row>
                                <v-col cols="2">
                                    <v-avatar color="purple darken-4" size="160"> 
                                        <!-- <img src="https://cdn.vuetifyjs.com/images/john.jpg" alt="John" > -->
                                        <span class="white--text headline"> <h1> SM </h1> </span>
                                    </v-avatar>
                                </v-col>
                                <v-col cols="10" class="pt-0">
                                    <v-row justify="space-between">
                                        <v-col>
                                            <!-- <v-chip-group
                                                column
                                                active-class="primary--text"
                                            > -->
                                                <v-chip v-for="role in user.roles" :key="role.id"
                                                    class="ma-2"
                                                    color="success"
                                                    outlined
                                                    small
                                                    >
                                                    <v-icon left small>mdi-circle</v-icon>
                                                    {{role.name}}
                                                </v-chip>
                                            <!-- </v-chip-group> -->
                                        </v-col>
                                        <v-col cols="2" class="text-right">
                                            <span class=""> #1267 </span>
                                        </v-col>
                                    </v-row>
                                    <v-chip
                                    class="ma-2"
                                    label
                                    >
                                        <v-icon left>mdi-label</v-icon>
                                        <span> {{user.invitation}} </span>
                                    </v-chip>
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
        })
    }
}
</script>

<style>

</style>
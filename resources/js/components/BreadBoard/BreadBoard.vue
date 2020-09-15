<template>
    <v-container fluid tag="section" :style="{'max-width': '100%'}">
        <v-row>
            <v-col cols="12" lg="12">
                <v-row justify="center">
                    <v-col cols="12" lg="8">
                        <v-tabs dark centered v-model="board">
                                <v-tab> kek </v-tab>
                                <v-tab> lol </v-tab>
                                <v-tab >cheburek</v-tab>
                        </v-tabs>
                        <v-card>
                            
                            <v-simple-table fixed-header height="500px">
                                <template v-slot:default>
                                <thead>
                                    <tr>
                                        <th class="text-left">Place</th>
                                        <th class="text-left">Username</th>
                                        <th class="text-left">Crumbs</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(item, index) in users" :key="item.id">
                                        <td>{{ index+1 }}</td>
                                        <td>{{ item.username }}</td>
                                        <td>{{ item.crumbs }}</td>
                                    </tr>
                                </tbody>
                                </template>
                            </v-simple-table>
                        </v-card>
                    </v-col>
                </v-row>
            </v-col>
            <v-col cols="12" lg="4">
                <v-card>
                    There will be bread board. You are welcome!
                </v-card>
            </v-col>
<v-col cols="12" lg="4">
                <v-card>
                    There will be bread board. You are welcome!
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'
export default {
    data() {
        return {
            board: null,
        }
    },

    computed: {
        ...mapGetters({
            users: 'user/crumbTop',
        }),
    },

    methods: {
        ...mapActions({
            fetchCrumbTop: 'user/crumbTop',
        }),
    },

    mounted() {
        this.fetchCrumbTop();
    }
}
</script>

<style>

</style>
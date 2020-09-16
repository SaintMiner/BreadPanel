<template>
  <v-col>
        <v-card>
            <v-skeleton-loader
                    :loading="true"
                    height="200"
                    type="card"
            >                
            </v-skeleton-loader>
            <v-row class="mx-5">
                <v-col>
                    <v-row>
                        <v-col lg="2" sm="3">
                            <v-skeleton-loader
                                :style="{'border-radius': '100%'}"
                                :loading="true"
                                height="160"
                                type="image"
                            >
                            </v-skeleton-loader>
                        </v-col>
                        <v-col lg="10" class="pt-0">
                            <v-row justify="space-between">
                                <v-col>
                                    <v-skeleton-loader
                                        :loading="true"
                                        type="text"
                                    >
                                    </v-skeleton-loader>
                                </v-col>
                                <v-col lg="2" class="text-right">
                                    <v-skeleton-loader
                                        :loading="true"
                                        type="text"
                                    >
                                        <span class=""> #1267 </span>
                                    </v-skeleton-loader>
                                </v-col>
                            </v-row>
                            <v-col class="p-0">
                                <v-skeleton-loader
                                    :loading="true"
                                    type="chip"
                                >
                                </v-skeleton-loader>
                            </v-col>
                            <v-col class="pl-0">
                                <v-skeleton-loader 
                                    :loading="true"
                                    type="chip"
                                >                        
                                </v-skeleton-loader>
                            </v-col>
                        </v-col>
                        
                    </v-row>
                    
                    </v-col>
            </v-row>
        
        </v-card>
    </v-col>
</template>

<script>
export default {

}
</script>

<style>

</style>
<template>
    <v-container>
        <v-expansion-panels inset hover>
            <v-expansion-panel>
                <v-expansion-panel-header>Writer</v-expansion-panel-header>
                <v-expansion-panel-content> 
                    <v-row no-gutters>
                        <v-col cols="6">
                            <v-row class="label-fix">
                            <v-col cols="4">
                                <v-checkbox input-value="true" hide-details label="edit posts"></v-checkbox>
                            </v-col>
                            <v-col cols="4">
                                <v-checkbox label="write posts"></v-checkbox>
                            </v-col>
                            <v-col cols="4">
                                <v-checkbox indeterminate label="delete posts"></v-checkbox>
                            </v-col>
                            <v-col cols="4">
                                <v-checkbox indeterminate label="Moderate posts"></v-checkbox>
                            </v-col>
                            </v-row>
                        </v-col>
                        <v-spacer></v-spacer>
                        <v-divider 
                            vertical
                            class="mx-4"
                        ></v-divider>

                        <v-col cols="3">
                            That is the description of this role. Writer can write. Yes....
                        </v-col>
                    </v-row>

                        <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                            text
                            color="error"
                        >
                            Delete
                        </v-btn>
                        <v-btn
                            text
                            color="secondary"
                        >
                            Cancel
                        </v-btn>
                        <v-btn
                            text
                            color="primary"
                        >
                            Save
                        </v-btn>
                        </v-card-actions>
                </v-expansion-panel-content>
            </v-expansion-panel>
        </v-expansion-panels>
    </v-container>
</template>

<script>
export default {

}
</script>

<style>
    .label-fix label {
        margin: 0;
    }
</style>
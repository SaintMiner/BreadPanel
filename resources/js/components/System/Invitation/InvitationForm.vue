<template>
    <v-card>
        <v-card-title>
            <span class="headline" v-if="!item.id"> Create invitation </span>
            <span class="headline" v-else> Edit invitation </span>
        </v-card-title>
        <v-card-text>
            <v-container>
            <v-row>
                <v-col cols="12" sm="6" md="6">
                <v-text-field v-model="item.code" label="Code"></v-text-field>
                </v-col>
                <v-col cols="12" sm="6" md="6">
                <v-menu
                    ref="menu"
                    v-model="menu"
                    :close-on-content-click="false"
                    :return-value.sync="item.expires_at"
                    transition="scale-transition"
                    offset-y
                    min-width="290px"
                >
                    <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                        v-model="item.expires_at"
                        label="Expires at"
                        prepend-icon="mdi-calendar"
                        readonly
                        v-bind="attrs"
                        v-on="on"
                    ></v-text-field>
                    </template>
                    <v-date-picker v-model="item.expires_at" no-title scrollable>
                    <v-spacer></v-spacer>
                    <v-btn text color="primary" @click="menu = false">Cancel</v-btn>
                    <v-btn text color="primary" @click="$refs.menu.save(item.expires_at)">OK</v-btn>
                    </v-date-picker>
                </v-menu>
                </v-col>
            </v-row>
            </v-container>
        </v-card-text>

        <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="$emit('close')">Cancel</v-btn>
            <v-btn color="blue darken-1" text @click="$emit('save')">Save</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
export default {

    data() {
        return {
            menu: false,
        }
    },

    props: {
        item: Object,
    }
}
</script>

<style>

</style>
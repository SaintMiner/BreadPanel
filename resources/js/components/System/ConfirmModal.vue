<template>
  <v-dialog v-model="dialog" width="500" :persistent="persistent">
    <v-card>
      <v-card-title class="lighten-2">{{title}}</v-card-title>

      <v-card-text>{{text}}</v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="primary" text @click="cancel">No</v-btn>
        <v-btn color="error" text @click="accept">Yes</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: {
    title: { default: "Confirm action", type: String },
    text: { default: "Are you sure?", type: String },
    dialog: Boolean,
    persistent: Boolean,
  },

  methods: {
    accept() {
        this.$emit("acceptAction");
    },

    cancel() {
        this.$emit("cancelAction");
    },
  },
};
</script>

<style>
</style>
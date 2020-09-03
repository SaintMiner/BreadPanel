<template>
  <v-container>
        <v-card>
            <v-card-title>
                <span> Permission test </span>
            </v-card-title>
            <v-card-text>
                POSTS
                <br>
                GUIDE STATIC
                <div v-if="$can('edit posts')">You can edit posts.</div>
                <div v-else>No u cant edit posts</div>
                VUEX
                <div v-if="can('edit posts')">You can edit posts.</div>
                <div v-else>No u cant edit posts</div>
                <br>
                ARTICLES
                <br>
                GUIDE STATIC
                <div v-if="$can('edit articles')">You can edit articles.</div>
                <div v-else>No u cant edit articles</div>
                VUEX
                <div v-if="can('edit articles')">You can edit articles.</div>
                <div v-else>No u cant edit articles</div>
            </v-card-text>
        </v-card>
    </v-container>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    computed: {
        ...mapGetters({
            can: 'auth/can'
        })
    },

}
</script>

<style>

</style>
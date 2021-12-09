<template>
  <v-container grid-list-md>
    <v-layout row wrap class="mb-10">
      <v-flex xs12 md6>
        <v-card>
          <v-card-title>titulo</v-card-title>
          <v-img src="../../assets/img/catalogo/heroes.jpg" height="200"></v-img>
          <v-card-actions>
            <v-btn block color="success" to="">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
import axios from "axios";
export default {
  data() {},
  created() {
    this.getComic();
  },
  methods: {
    getComic() {},
  },
};
</script>

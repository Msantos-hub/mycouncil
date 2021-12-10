<template>
  <v-container grid-list-md>
    <v-layout row wrap class="mb-10">
      <v-flex xs6>
        <v-card v-for="(comic, index) of comics" :key="index">
          <v-card-title>{{comic.nombre}}</v-card-title>
          <v-img src="../../assets/img/portadas/dlh.jpg" height="200"></v-img>
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
  data() {
    name: "heroes"
    return{
      userData:{
        idCategoria:'12'
      },
      comics:[],
    };
   
  },
  created() {
    this.getComic();
  },
  methods: {
    async getComic() {
      const _this = this;
      var data = new FormData();
      data.append("idCategoria", _this.userData.idCategoria)
      await axios
      .post("http://localhost/proyecto/mycouncil/src/bbdd/categorias.php?accion=leer",
      data
      )
        .then(function(response) {
          _this.comics = response.data.comics;
        });
    },
  },
};
</script>

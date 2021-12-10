<template>
  <!--
  Manuel Jesús Santos García
  TFG CFGS 2º DAW 2021
  Vista del panel de control del administrador solo el puede ver el contenido de la pagina
 -->
  <v-container grid-list-md v-if="token != null">
    <v-layout row wrap v-if="token != null"> 
      <v-flex xs12 md3>
        <v-card height="500">
          <v-img src="../assets/img/crud/usuarios.jpg" height="250"></v-img>
          <v-card-title>
            <h4>Gestión de Usuarios</h4>
          </v-card-title>
          <v-card-text>
            <p>
              Aqui podras gestionar los usuarios, consultarlos, listarlos,
              modificarlos, eliminarlos y dar de altas nuevos usuarios.
            </p>
          </v-card-text>
          <v-divider class="mx-4"></v-divider>
          <v-card-actions>
            <v-btn color="success" to="/UsersList">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
      <v-flex xs12 md3>
        <v-card height="500">
          <v-img src="../assets/img/crud/Categoria.jpg" height="250"></v-img>
          <v-card-title>
            <h4>Gestión de Categorias</h4>
          </v-card-title>
          <v-card-text>
            <p>
              Aqui podras gestionar las categorias, consultarlas, listarlos,
              modificarlos, eliminarlas y dar de altas nuevas categorias.
            </p>
          </v-card-text>
          <v-divider class="mx-4"></v-divider>
          <v-card-actions>
            <v-btn color="success" to="/listCat">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
      <v-flex xs12 md3>
        <v-card height="500">
          <v-img src="../assets/img/crud/comics.jpg" height="250"></v-img>
          <v-card-title>
            <h4>Gestión de Comics</h4>
          </v-card-title>
          <v-card-text>
            <p>
              Aqui podras gestionar los comics, consultarlos, listarlos,
              modificarlos, eliminarlos y dar de altas nuevos comics.
            </p>
          </v-card-text>
          <v-divider class="mx-4"></v-divider>
          <v-card-actions class="mt-50">
            <v-btn color="success" to="/listComic">Acceder</v-btn>
          </v-card-actions>
        </v-card> </v-flex
      ><v-flex xs12 md3>
        <v-card height="500">
          <v-img src="../assets/img/crud/sugerencias.png" height="250"></v-img>
          <v-card-title>
            <h4>Gestión de Sugerencias</h4>
          </v-card-title>
          <v-card-text>
            <p>
              Aqui podras gestionar las Sugerencias de los usuarios,
              consultarlas, listarlos, Validarlas, rechazarlas y eliminarlas
            </p>
          </v-card-text>
          <v-divider class="mx-4"></v-divider>
          <v-card-actions class="mt-50">
            <v-btn color="success" to="/listSu">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
export default {
  data() {
    return {
        token:null
    };
  },
  updated() {
    this.tokenexist();
  },
  methods: {
    tokenexist() {
      var _this = this;
      _this.token = localStorage.getItem("id");
    },
  },
};
</script>

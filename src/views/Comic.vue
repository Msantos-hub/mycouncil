<template>
  <!--
  Manuel Jesús Santos García
  TFG CFGS 2º DAW 2021
  Vista donde se muestran los datos de los comics
 -->
  <v-container grid-list-md>
    <v-layout row wrap>
      <v-flex xs3 class="blue"
        ><v-img src="../assets/img/portadas/dlh.jpg"></v-img
      ></v-flex>
      <v-flex xs9>
        <div class="align-center pt-100">
          <div class="text-center">
            <h1>
              titulo
            </h1>
          </div>
        </div>
      </v-flex>
    </v-layout>
    <br />
    <div class="black text-center white--text">
      INFORMACIÓN
    </div>
    <v-layout class="mt-1 alto" row wrap>
      <v-flex xs12 md6 class="text-center">
        <div class="alto mt-5">
          <h4>Caja de comentarios</h4>
          <div>
            <v-simple-table>
              <template>
                <tbody>
                  <tr>
                    <td class="text-right"></td>
                    <td class="text-left"></td>
                  </tr>
                </tbody>
              </template>
            </v-simple-table>
          </div>
        </div>
      </v-flex>
      <v-flex xs12 md6 class="text-center ">
        <div class="alto mt-5">
          <div>
            Puntuación <span class="text-caption mr-2"> ({{ rating }}) </span>
            <v-rating
              v-model="rating"
              background-color="black"
              color="yellow accent-4"
              half-increments
              hover
              size="25"
            ></v-rating>
          </div>
          <ul>
            <li>ISBN: {isbn}</li>
            <li>idioma: {idioma}</li>
            <li>Numero de Paginas: {numeroPaginas}</li>
            <li>Fecha de Publicacion: {fechaPublicacion}</li>
            <li>Editorial: {editorial}</li>
          </ul>
        </div>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
export default {
  /**
   * contiene todas las variables usadas en la vista
   */
  data: () => ({
    rating: 0,
    comics: [],
  }),
  /**
   * ciclo de vida de vue al crear la pagina ejecuta la funcion
   */
  created: function() {
    this.getComics();
  },
  methods: {
    /**
     * recoge los datos a mostrar en la vista mediante una peticion axios
     */
    async getComics() {
      const _this = this;
      await axios
        .get(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudCo.php?accion=leer"
        )
        .then(function(response) {
          _this.comics = response.data.comic;
        });
    },
  },
};
</script>
<style>
.borde {
  border: 0.5px solid #000;
}
.alto {
  min-height: 200px;
}
</style>

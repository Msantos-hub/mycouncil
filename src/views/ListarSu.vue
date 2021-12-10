<template>   
<!--
  Manuel Jesús Santos García
  TFG CFGS 2º DAW 2021
  Vista del panel de control donde se controlan las sugerencias
 -->
  <v-container class="mt-5" grid-list-md>
    <v-layout row wrap>
      <v-flex xs12>
        <v-btn color="blue-grey lighten-3" to="/Controlpanel" rounded>
          <v-icon class="mr-2">mdi-arrow-left-circle</v-icon>
          Volver a gestión
        </v-btn>
        <v-alert type="error" dense block v-if="errorMsg" class="mt-5">
          {{ errorMsg }}
        </v-alert>
        <v-alert type="success" dense block v-if="successMsg" class="mt-5">
          {{ successMsg }}
        </v-alert>
      </v-flex>
    </v-layout>
    <v-layout row wrap class="mt-5">
      <v-flex xs5>
        <template>
          <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr class="primary">
                  <th class="text-left white--text">
                    idSugerencia
                  </th>
                  <th class="text-left white--text">
                    idUsuario
                  </th>
                  <th class="text-left white--text">
                    Nombre Comic
                  </th>
                  <th class="text-left white--text">
                    Descipcion
                  </th>
                  <th class="text-left white--text">
                    Estado
                  </th>
                  <th class="text-left white--text">
                    Acciones
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(sugerencia, index) of sugerencia" :key="index">
                  <td>{{ sugerencia.idSugerencia }}</td>
                  <td>{{ sugerencia.idUsuario }}</td>
                  <td>{{ sugerencia.nombreComic }}</td>
                  <td>{{ sugerencia.descripcion }}</td>
                  <td>{{ sugerencia.estado }}</td>
                  <td>
                    <v-btn
                      color="success"
                      dark
                      rounded
                      @click="
                        (aceptDialog = true), selectSugerencia(sugerencia)
                      "
                    >
                      <v-icon>mdi-check</v-icon>
                    </v-btn>
                    <v-btn
                      color="error"
                      rounded
                      class="ml-5"
                      @click="
                        (deleteDialog = true), selectSugerencia(sugerencia)
                      "
                    >
                      <v-icon>mdi-cancel</v-icon>
                    </v-btn>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </template>
      </v-flex>
      <v-flex> </v-flex>
      <v-flex xs5>
        <template>
          <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr class="primary">
                  <th class="text-left white--text">
                    idSugerencia
                  </th>
                  <th class="text-left white--text">
                    idUsuario
                  </th>
                  <th class="text-left white--text">
                    Nombre Comic
                  </th>
                  <th class="text-left white--text">
                    Descipcion
                  </th>
                  <th class="text-left white--text">
                    Estado
                  </th>
                  <th class="text-left white--text">
                    Acciones
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(sugerencia, index) of sugerencia2" :key="index">
                  <td>{{ sugerencia.idSugerencia }}</td>
                  <td>{{ sugerencia.idUsuario }}</td>
                  <td>{{ sugerencia.nombreComic }}</td>
                  <td>{{ sugerencia.descripcion }}</td>
                  <td>{{ sugerencia.estado }}</td>
                  <td>
                    <v-btn
                      color="success"
                      dark
                      rounded
                      @click="
                        (aceptDialog = true), selectSugerencia(sugerencia)
                      "
                    >
                      <v-icon>mdi-check</v-icon>
                    </v-btn>
                    <v-btn
                      color="error"
                      rounded
                      class="ml-5"
                      @click="
                        (deleteDialog = true), selectSugerencia(sugerencia)
                      "
                    >
                      <v-icon>mdi-cancel</v-icon>
                    </v-btn>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </template>
      </v-flex>
    </v-layout>
    <!-- aceptar Sugerencia-->
    <v-dialog persistent max-width="350" v-model="aceptDialog">
      <v-card>
        <v-card-title>
          Aceptar Sugerencia
        </v-card-title>
        <v-card-text>
          <h3>¿Seguro que quiere Aceptar esta Sugerencia?</h3>
          <h3>
            Esta Aceptando la Sugerencia "Nº
            {{ currentSugerencia.idSugerencia }}"
          </h3>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="green darken-1"
            text
            @click="(aceptDialog = false), updateSugerencia(), clearMsg()"
          >
            Si
          </v-btn>
          <v-btn color="green darken-1" text @click="aceptDialog = false">
            No
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!-- ELiminar -->
    <v-dialog persistent max-width="350" v-model="deleteDialog">
      <v-card>
        <v-card-title>
          Eliminar Sugerencia
        </v-card-title>
        <v-card-text>
          <h3>¿Seguro que quiere eliminar esta Sugerencia?</h3>
          <h3>
            Esta borrando la Sugerencia "Nº
            {{ currentSugerencia.idSugerencia }}"
          </h3>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="green darken-1"
            text
            @click="(deleteDialog = false), deleteSugerencia(), clearMsg()"
          >
            Si
          </v-btn>
          <v-btn color="green darken-1" text @click="deleteDialog = false">
            No
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script>
import axios from "axios";
export default {
  /**
   * contiene todas las variables usadas en la vista
   */
  data() {
    return {
      errorMsg: "",
      successMsg: "",
      add: false,
      aceptDialog: false,
      deleteDialog: false,
      valid: true,
      name: "",
      nameRules: [(v) => !!v || "El nombre del Sugerencia no se a rellenado"],
      sugerencia: [],
      sugerencia2: [],
      currentSugerencia: {},
    };
  },

  
  /**
   * Ciclos de vida vu
   */
  mounted() {
    this.getSugerencias();
    this.getSugerencias2();
  },

  
  /**
   * Contenedor de metodos
   */
  methods: {
    
    /**
     * Recoge y lee los datos traidos por la query
     */
    async getSugerencias() {
      const _this = this;
      await axios
        .get(
          "http://localhost/proyecto/mycouncil/src/bbdd/sugerencias.php?accion=leer"
        )
        .then(function(response) {
          _this.sugerencia = response.data.sugerencia;
        });
    },
    /**
     * Recoge y lee los datos traidos por la query
     */
    async getSugerencias2() {
      const _this = this;
      await axios
        .get(
          "http://localhost/proyecto/mycouncil/src/bbdd/sugerencias.php?accion=leer2"
        )
        .then(function(response) {
          _this.sugerencia2 = response.data.sugerencias;
        });
    },

    
    /**
     * Recoge y manda los datos a actualizar en la base de datos
     */
    updateSugerencia() {
      const _this = this;
      var formData = _this.toFormData(_this.currentSugerencia);
      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/sugerencias.php?accion=aprobar",
          formData
        )
        .then(function(response) {
          _this.currentSugerencia = {};
          if (response.data.error) {
            _this.errorMsg = response.data.message;
          } else {
            _this.successMsg = response.data.message;
            _this.getSugerencias();
          }
        });
    },

    
    /**
     * Recoge y manda los datos a la query de borrado
     */
    deleteSugerencia() {
      const _this = this;
      var formData = _this.toFormData(_this.currentSugerencia);
      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/sugerencias.php?accion=borrar",
          formData
        )
        .then(function(response) {
          _this.currentSugerencia = {};
          if (response.data.error) {
            _this.errorMsg = response.data.message;
          } else {
            _this.successMsg = response.data.message;
            _this.getSugerencias();
          }
        });
    },

    toFormData(obj) {
      var fd = new FormData();
      for (var i in obj) {
        fd.append(i, obj[i]);
      }
      return fd;
    },

    
    /**
     * selecciona el item actual del array
     */
    selectSugerencia(Sugerencia) {
      const _this = this;
      _this.currentSugerencia = Sugerencia;
    },

    clearMsg() {
      _this.errorMsg = "";
      _this.successMsg = "";
    },

    
    /**
     * Valida y resetea el formulario
     */
    validate() {
      this.$refs.form.validate();
    },
    reset() {
      this.$refs.form.reset();
    },
    resetValidation() {
      this.$refs.form.resetValidation();
    },
  },
};
</script>

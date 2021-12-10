<template>
  <!--
  Manuel Jesús Santos García
  TFG CFGS 2º DAW 2021
  Vista del panel de control donde se controlan las categorias
 -->
  <v-container class="mt-5">
    <v-layout row wrap>
      <v-flex xs12>
        <v-btn color="blue-grey lighten-3" to="/Controlpanel" rounded>
          <v-icon class="mr-2">mdi-arrow-left-circle</v-icon>
          Volver a gestión
        </v-btn>
        <v-btn
          color="green darken-1"
          @click="addCategoria, (add = true)"
          rounded
          class="ml-2"
          dark
        >
          <v-icon class="mr-2">mdi-account-plus</v-icon>
          Agregar categoria
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
      <v-flex xs12>
        <template>
          <v-simple-table>
            <template v-slot:default>
              <thead>
                <tr class="primary">
                  <th class="text-left white--text">
                    id
                  </th>
                  <th class="text-left white--text">
                    Nombre
                  </th>
                  <th class="text-left white--text">
                    Acciones
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(categoria, index) of categoria" :key="index">
                  <td>{{ categoria.idCategoria }}</td>
                  <td>{{ categoria.nombre }}</td>
                  <td>
                    <v-btn
                      color="light-blue"
                      dark
                      rounded
                      @click="(editar = true), selectCategoria(categoria)"
                    >
                      <v-icon>mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn
                      color="error"
                      rounded
                      class="ml-5"
                      @click="(deleteDialog = true), selectCategoria(categoria)"
                    >
                      <v-icon>mdi-trash-can</v-icon>
                    </v-btn>
                  </td>
                </tr>
              </tbody>
            </template>
          </v-simple-table>
        </template>
      </v-flex>
    </v-layout>
    <!-- Agregar categoria-->
    <v-dialog v-model="add" width="700" persistent>
      <v-card>
        <v-toolbar-title class="info text-center">
          Añadir categoria</v-toolbar-title
        >
        <v-form ref="form" v-model="valid" class="ma-5">
          <v-text-field
            v-model="newCategoria.nombre"
            prepend-icon="mdi-format-title"
            :rules="nameRules"
            label="Nombre de categoria"
            required
          ></v-text-field>
          <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="
              validate;
              addCategoria();
              add = false;
            "
          >
            Aceptar</v-btn
          >
          <v-btn color="error" class="mr-4" @click="add = false">
            Cerrar
          </v-btn>
          <v-btn color="warning" @click="resetValidation"
            >Reiniciar formulario
          </v-btn>
        </v-form>
      </v-card>
    </v-dialog>

    <!--editar -->
    <v-dialog v-model="editar" width="700" persistent>
      <v-card>
        <v-toolbar-title class="info text-center">
          Editar categoria</v-toolbar-title
        >
        <v-form ref="form" v-model="valid" class="ma-5">
          <v-text-field
            v-model="currentCategoria.nombre"
            prepend-icon="mdi-format-title"
            :rules="nameRules"
            label="Nombre de categoria"
            required
          ></v-text-field>
          <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="validate, updateCategoria(), (editar = !editar)"
          >
            Aceptar</v-btn
          >
          <v-btn color="error" class="mr-4" @click="editar = !editar">
            Cerrar
          </v-btn>
          <v-btn color="warning" @click="resetValidation"
            >Reiniciar formulario
          </v-btn>
        </v-form>
      </v-card>
    </v-dialog>
    <!-- ELiminar -->
    <v-dialog persistent max-width="350" v-model="deleteDialog">
      <v-card>
        <v-card-title>
          Eliminar categoria
        </v-card-title>
        <v-card-text>
          <h3>¿Seguro que quiere eliminar este categoria?</h3>
          <h3>Esta borrando el categoria "{{ currentCategoria.nombre }}"</h3>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="green darken-1"
            text
            @click="(deleteDialog = false), deleteCategoria(), clearMsg()"
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
      editar: false,
      deleteDialog: false,
      valid: true,
      name: "",
      nameRules: [(v) => !!v || "El nombre del categoria no se a rellenado"],
      categoria: [],
      newCategoria: { nombre: "" },
      currentCategoria: { idCategoria: "", nombre: "" },
    };
  },

  /**
   * Ciclos de vida vue
   */
  mounted() {
    this.getCategorias();
  },

  /**
   * Contenedor de metodos
   */
  methods: {
    /**
     * Recoge y lee los datos traidos por la query
     */
    async getCategorias() {
      const _this = this;
      const datos = await axios
        .get(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudCat.php?accion=leer"
        )
        .then(function(response) {
          _this.categoria = response.data.categoria;
        });
    },

    /**
     * recoge y manda a la query de adicion los datos que hay que añadir a la base de datos
     */
    addCategoria() {
      const _this = this;
      var formData = _this.toFormData(_this.newCategoria);
      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudCat.php?accion=crear",
          formData
        )
        .then(function(response) {
          _this.newCategoria = { nombre: "" };
          if (response.data.error) {
            _this.errorMsg = response.data.message;
          } else {
            _this.successMsg = response.data.message;
            _this.getCategorias();
          }
        });
    },

    /**
     * Recoge y manda los datos a actualizar en la base de datos
     */
    updateCategoria() {
      const _this = this;
      var formData = _this.toFormData(_this.currentCategoria);
      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudCat.php?accion=editar",
          formData
        )
        .then(function(response) {
          _this.currentCategoria = {};
          if (response.data.error) {
            _this.errorMsg = response.data.message;
          } else {
            _this.successMsg = response.data.message;
            _this.getCategorias();
          }
        });
    },

    /**
     * Recoge y manda los datos a la query de borrado
     */
    deleteCategoria() {
      const _this = this;
      var formData = _this.toFormData(_this.currentCategoria);
      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudCat.php?accion=borrar",
          formData
        )
        .then(function(response) {
          _this.currentCategoria = {};
          if (response.data.error) {
            _this.errorMsg = response.data.message;
          } else {
            _this.successMsg = response.data.message;
            _this.getCategorias();
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
     *selecciona el item actual del array
     */
    selectCategoria(categoria) {
      const _this = this;
      _this.currentCategoria.idCategoria = categoria.idCategoria;
      _this.currentCategoria.nombre = categoria.nombre;
    },

    /**
     * limpia los mensajes de error
     */
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

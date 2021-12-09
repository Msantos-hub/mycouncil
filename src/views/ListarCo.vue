<template>
  <v-container class="mt-5" id="crudCo">
    <v-layout row wrap>
      <v-flex xs12>
        <v-btn color="blue-grey lighten-3" to="/Controlpanel" rounded>
          <v-icon class="mr-2">mdi-arrow-left-circle</v-icon>
          Volver a gestión
        </v-btn>
        <v-btn
          color="green darken-1"
          rounded
          dark
          class="ml-2"
          @click="addComics, (add = true)"
        >
          <v-icon class="mr-2">mdi-account-plus</v-icon>
          Agregar comic
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
                    ISBN
                  </th>
                  <th class="text-left white--text">
                    Editorial
                  </th>
                  <th class="text-left white--text">
                    idioma
                  </th>
                  <th class="text-left white--text">
                    Numero de paginas
                  </th>
                  <th class="text-left white--text">
                    Publicado
                  </th>
                  <th class="text-left white--text">
                    Portada
                  </th>
                  <th class="text-left white--text">
                    Acciones
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(comic, index) of comics" :key="index">
                  <td>{{ comic.idComic }}</td>
                  <td>{{ comic.nombre }}</td>
                  <td>{{ comic.isbn }}</td>
                  <td>{{ comic.editorial }}</td>
                  <td>{{ comic.idioma }}</td>
                  <td>{{ comic.numeroPaginas }}</td>
                  <td>{{ comic.fechaPublicacion }}</td>
                  <td>{{ comic.portada }}</td>
                  <td>
                    <v-btn
                      color="light-blue"
                      dark
                      rounded
                      @click="(editar = true), selectComic(comic)"
                    >
                      <v-icon>mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn
                      color="error"
                      rounded
                      class="ml-5"
                      @click="(deleteDialog = true), selectComic(comic)"
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
    <!-- Agregar usuario-->
    <v-dialog v-model="add" width="700" persistent>
      <v-card>
        <v-toolbar-title class="info text-center">
          Añadir Comic</v-toolbar-title
        >
        <v-form ref="form" v-model="valid" class="ma-5">
          <v-text-field
            prepend-icon="mdi-format-title"
            v-model="newComic.nombre"
            :rules="nameRules"
            label="Nombre de comic"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-numeric"
            v-model="newComic.isbn"
            :counter="13"
            :rules="isbnRules"
            label="isbn"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-home-city"
            v-model="newComic.editorial"
            :rules="editorialRules"
            label="editorial"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-translate"
            v-model="newComic.idioma"
            :rules="idiomaRules"
            label="idioma"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-book-open-page-variant"
            v-model="newComic.numeroPaginas"
            :rules="numPRules"
            label="numero Paginas"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-calendar-range"
            v-model="newComic.fechaPublicacion"
            :rules="fechPubliRules"
            label="fecha Publicacion"
            required
          ></v-text-field>
          <v-file-input
            prepend-icon="mdi-camera"
            v-model="newComic.portada"
            label="Archivo de portada"
            required
          ></v-file-input>
          <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="
              validate;
              addComics();
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
          Editar Comic</v-toolbar-title
        >
        <v-form ref="form" v-model="valid" class="ma-5">
          <v-text-field
            prepend-icon="mdi-format-title"
            v-model="currentComic.nombre"
            :rules="nameRules"
            label="Nombre de comic"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-numeric"
            v-model="currentComic.isbn"
            :rules="isbnRules"
            label="isbn"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-home-city"
            v-model="currentComic.editorial"
            :rules="editorialRules"
            label="editorial"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-translate"
            v-model="currentComic.idioma"
            :rules="idiomaRules"
            label="idioma"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-book-open-page-variant"
            v-model="currentComic.numeroPaginas"
            :rules="numPRules"
            label="numero Paginas"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-calendar-range"
            v-model="currentComic.fechaPublicacion"
            :rules="fechPubliRules"
            label="fecha Publicacion"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-camera"
            v-model="currentComic.portada"
            label="Archivo de portada"
            required
          ></v-text-field>
          <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="
              validate;
              updateComics(), (editar = !editar);
            "
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
          Eliminar comic
        </v-card-title>
        <v-card-text>
          <h3>¿Seguro que quiere eliminar este comic?</h3>
          <h3>Esta borrando el titulo "{{ currentComic.nombre }}"</h3>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="green darken-1"
            text
            @click="(deleteDialog = false), deleteComics(), clearMsg()"
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
  //Contenedor de datos, variable, arrays, etc...
  data() {
    return {
      errorMsg: "",
      successMsg: "",
      add: false,
      editar: false,
      deleteDialog: false,
      valid: true,
      name: "",
      nameRules: [(v) => !!v || "El nombre del usuario no se a rellenado"],
      isbn: "",
      isbnRules: [(v) => !!v || "El isbn no se a rellenado"],
      editorial: "",
      editorialRules: [(v) => !!v || "La editorial no se a rellenado"],
      idioma: "",
      idiomaRules: [(v) => !!v || "El idioma no se a rellenado"],
      numP: "",
      numPRules: [(v) => !!v || "El Numero de paginas no se a rellenado"],
      fechPubli: "",
      fechPubliRules: [
        (v) => !!v || "La fecha de publicacion no se a rellenado",
      ],
      portada: "",
      comics: [],
      newComic: {
        nombre: "",
        isbn: "",
        numeroPaginas: "",
        fechaPublicacion: "",
        idioma: "",
        editorial: "",
        portada: "",
      },
      currentComic: {
        idComic: "",
        nombre: "",
        isbn: "",
        numeroPaginas: "",
        fechaPublicacion: "",
        idioma: "",
        editorial: "",
        portada: "",
      },
    };
  },

  //Ciclos de vida vue
  created: function() {
    this.getComics();
  },

  //Contenedor de metodos
  methods: {
    //Recoge y lee los datos traidos por la query
    async getComics() {
      const _this = this;
      const datos = await axios
        .get(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudCo.php?accion=leer"
        )
        .then(function(response) {
          _this.comics = response.data.comic;
        });
    },

    //recoge y manda a la query de adicion los datos que hay que añadir a la base de datos
    addComics() {
      const _this = this;
      var formData = _this.toFormData(_this.newComic);
      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudCo.php?accion=crear",
          formData
        )
        .then(function(response) {
          _this.newComic = {};
          if (response.data.error) {
            _this.errorMsg = response.data.message;
          } else {
            _this.successMsg = response.data.message;
            _this.getComics();
          }
        });
    },

    //Recoge y manda los datos a actualizar en la base de datos
    updateComics() {
      const _this = this;
      var formData = _this.toFormData(_this.currentComic);
      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudCo.php?accion=editar",
          formData
        )
        .then(function(response) {
          _this.currentComic = {};
          if (response.data.error) {
            _this.errorMsg = response.data.message;
          } else {
            _this.successMsg = response.data.message;
            _this.getComics();
          }
        });
    },

    //Recoge y manda los datos a la query de borrado
    deleteComics() {
      const _this = this;
      var formData = _this.toFormData(_this.currentComic);
      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudCo.php?accion=borrar",
          formData
        )
        .then(function(response) {
          _this.currentComic = {};
          if (response.data.error) {
            _this.errorMsg = response.data.message;
          } else {
            _this.successMsg = response.data.message;
            _this.getComics();
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

    //selecciona el item actual del array
    selectComic(comic) {
      const _this = this;
      _this.currentComic.idComic = comic.idComic;
      _this.currentComic.nombre = comic.nombre;
      _this.currentComic.isbn = comic.isbn;
      _this.currentComic.numeroPaginas = comic.numeroPaginas;
      _this.currentComic.fechaPublicacion = comic.fechaPublicacion;
      _this.currentComic.idioma = comic.idioma;
      _this.currentComic.editorial = comic.editorial;
      _this.currentComic.portada = comic.portada;
    },

    //limpia los mensajes de error y  success
    clearMsg() {
      _this.errorMsg = "";
      _this.successMsg = "";
    },
    //Valida y resetea el formulario
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

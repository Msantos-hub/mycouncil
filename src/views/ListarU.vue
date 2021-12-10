<template>
  <!--
  Manuel Jesús Santos García
  TFG CFGS 2º DAW 2021
  Vista del panel de control donde se controlan los usuarios
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
          @click="addUsuario, (add = true)"
          rounded
          class="ml-2"
          dark
        >
          <v-icon class="mr-2">mdi-account-plus</v-icon>
          Agregar usuario
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
                    ID
                  </th>
                  <th class="text-left  white--text">
                    NOMBRE
                  </th>
                  <th class="text-left white--text">
                    EMAIL
                  </th>
                  <th class="text-left white--text">
                    CONTRASEÑA
                  </th>
                  <th class="text-left white--text">
                    TIPO
                  </th>
                  <th class="text-left white--text">
                    PREGUNTA SECRETA
                  </th>
                  <th class="text-left white--text">
                    ACCIONES
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(usuario, index) of listaUsuarios" :key="index">
                  <td>{{ usuario.idUsuario }}</td>
                  <td>{{ usuario.nombre }}</td>
                  <td>{{ usuario.correo }}</td>
                  <td>{{ usuario.password }}</td>
                  <td>{{ usuario.tipo }}</td>
                  <td>{{ usuario.pregunta }}</td>
                  <td>
                    <v-btn
                      color="light-blue"
                      dark
                      rounded
                      @click="(editar = true), selectUsuario(usuario)"
                    >
                      <v-icon>mdi-pencil</v-icon>
                    </v-btn>
                    <v-btn
                      color="error"
                      rounded
                      class="ml-5"
                      @click="(deleteDialog = true), selectUsuario(usuario)"
                      ><v-icon>mdi-trash-can</v-icon>
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
          Añadir Usuario</v-toolbar-title
        >
        <v-form ref="form" v-model="valid" class="ma-5">
          <v-text-field
            prepend-icon="mdi-format-title"
            v-model="newUsuario.nombre"
            :counter="20"
            :rules="nameRules"
            label="Nombre de usuario"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-at"
            v-model="newUsuario.correo"
            :rules="emailRules"
            label="Correo"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-lock"
            v-model="newUsuario.password"
            :rules="passwRules"
            label="Contraseña"
            required
          ></v-text-field>
          <v-select
            prepend-icon="mdi-account"
            v-model="newUsuario.tipo"
            :items="items"
            :rules="[(v) => !!v || 'Item is required']"
            label="Tipo de usuario"
            required
          ></v-select>
          <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="
              validate;
              addUsuario();
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
          Editar Usuario
        </v-toolbar-title>
        <v-form ref="form" v-model="valid" class="ma-5">
          <v-text-field
            prepend-icon="mdi-format-title"
            v-model="actualUsuario.nombre"
            :counter="20"
            :rules="nameRules"
            label="Nombre de usuario"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-at"
            v-model="actualUsuario.correo"
            :rules="emailRules"
            label="Correo"
            required
          ></v-text-field>
          <v-text-field
            prepend-icon="mdi-lock"
            v-model="actualUsuario.password"
            :rules="passwRules"
            label="Contraseña"
            required
          ></v-text-field>
          <v-select
            prepend-icon="mdi-account"
            v-model="actualUsuario.tipo"
            :items="items"
            :rules="[(v) => !!v || 'Item is required']"
            label="Tipo de usuario"
            required
          ></v-select>
          <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="
              validate;
              updateUsuario(), (editar = !editar);
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
          Eliminar usuario
        </v-card-title>
        <v-card-text>
          <h3>¿Seguro que quiere eliminar este usuario?</h3>
          <h3>Esta borrando el usuario "{{ actualUsuario.nombre }}"</h3>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="green darken-1"
            text
            @click="(deleteDialog = false), deleteUsuario(), clearMsg()"
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.22.0/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.2/dist/sweetalert2.all.min.js"></script>
<script src="/js/vue-resource.js"></script>

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
      nameRules: [(v) => !!v || "El nombre del usuario no se a rellenado"],
      email: "",
      emailRules: [
        (v) => !!v || "No se a rellenado el correo",
        (v) => /.+@.+\..+/.test(v) || "El correo debe ser valido",
      ],
      passw: "",
      passwRules: [(v) => !!v || "La Contrseña no se a rellenado"],
      select: null,
      items: ["a", "u"],
      listaUsuarios: [],
      newUsuario: { nombre: "", correo: "", password: "", tipo: "" },
      actualUsuario: {
        idUsuario: "",
        nombre: "",
        correo: "",
        password: "",
        tipo: "",
      },
    };
  },

  /**
   * ciclo de vida de cue
   */
  created: function() {
    this.getUsuarios();
  },

  /**
   * Contenedor de metodos
   */
  methods: {
    /**
     * Recoge y lee los datos traidos por la query
     */
    async getUsuarios() {
      const _this = this;
      await axios
        .get(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudU.php?accion=leer"
        )
        .then(function(response) {
          _this.listaUsuarios = response.data.usuario;
        });
    },

    /**
     *  recoge y manda a la query de adicion los datos que hay que añadir a la base de datos
     */
    addUsuario() {
      const _this = this;
      var formData = _this.toFormData(_this.newUsuario);
      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudU.php?accion=crear",
          formData
        )
        .then(function(response) {
          _this.newUsuario = {
            nombre: "",
            correo: "",
            password: "",
            tipo: "",
          };
          if (response.data.error) {
            _this.errorMsg = response.data.message;
          } else {
            _this.successMsg = response.data.message;
            _this.getUsuarios();
          }
        });
    },

    /**
     * Recoge y manda los datos a actualizar en la base de datos
     */
    updateUsuario() {
      const _this = this;
      var formData = _this.toFormData(_this.actualUsuario);
      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudU.php?accion=editar",
          formData
        )
        .then(function(response) {
          _this.actualUsuario = {};
          if (response.data.error) {
            _this.errorMsg = response.data.message;
            location.reload();
          } else {
            _this.successMsg = response.data.message;
            _this.getUsuarios();
          }
        });
    },

    /**
     * Recoge y manda los datos a la query de borrado
     */
    deleteUsuario() {
      const _this = this;
      var formData = _this.toFormData(_this.actualUsuario);
      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudU.php?accion=borrar",
          formData
        )
        .then(function(response) {
          _this.actualUsuario = {};
          if (response.data.error) {
            _this.errorMsg = response.data.message;
          } else {
            _this.successMsg = response.data.message;
            _this.getUsuarios();
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
     *  selecciona el item actual del array
     */
    selectUsuario(usuario) {
      const _this = this;
      _this.actualUsuario.idUsuario = usuario.idUsuario;
      _this.actualUsuario.nombre = usuario.nombre;
      _this.actualUsuario.correo = usuario.correo;
      _this.actualUsuario.password = usuario.password;
      _this.actualUsuario.tipo = usuario.tipo;
    },

    /**
     * limpia los mensajes de error y  success
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

<template>
  <v-container>
    <v-layout row wrap class="mt-10">
      <v-flex xs12 md3>
        <v-card max-width="500" tile>
          <v-img
            height="100%"
            src="https://cdn.vuetifyjs.com/images/cards/server-room.jpg"
          >
            <v-row align="end" class="fill-height">
              <v-col align-self="auto" class="pa-10 " cols="12">
                <v-avatar class="profile" color="grey" size="150">
                  <v-img src="../assets/img/logos/user.png"></v-img>
                </v-avatar>
              </v-col>
              <v-col class="py-0">
                <v-list-item color="rgba(0, 0, 0, .4)" dark>
                  <v-list-item-content>
                    <v-list-item-title class="text-h6 mb-5">
                      <h1>Bienvenido</h1>
                    </v-list-item-title>
                    <v-list-item-title class="text-h6 mb-5">
                      {{ nombre }}
                    </v-list-item-title>
                  </v-list-item-content>
                </v-list-item>
              </v-col>
            </v-row>
          </v-img>
        </v-card>
      </v-flex>
      <v-flex xs12 md9>
        <v-card class="grey lighten-1">
          <v-toolbar-title class="text-center blue">
            <h2>Datos del Usuario</h2>
          </v-toolbar-title>
          <v-card-text>
            <v-form class="white">
              <v-container>
                <div v-for="(usuario, index) of listaUsuarios" :key="index">
                  <v-row>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        label="Nombre de usuario"
                        prepend-icon="mdi-format-title"
                        v-model="usuario.nombre"
                        :counter="20"
                        :rules="nameRules"
                        outlined
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        label="Correo electronico"
                        prepend-icon="mdi-at"
                        v-model="usuario.correo"
                        :rules="emailRules"
                        outlined
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        label="Contraseña"
                        outlined
                        prepend-icon="mdi-lock"
                        v-model="usuario.password"
                        :rules="passwRules"
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12" sm="6" md="6">
                      <v-text-field
                        label="Pregunta secreta"
                        prepend-icon="mdi-help-circle"
                        v-model="usuario.pregunta"
                        :rules="passwRules"
                        outlined
                      ></v-text-field>
                    </v-col>
                  </v-row>
                  <v-card-actions>
                    <v-btn
                      block
                      bottom
                      color="success"
                      @click="(editar = true), selectUsuario(usuario)"
                    >
                      Modificar
                    </v-btn>
                  </v-card-actions>
                </div>
              </v-container>
            </v-form>
          </v-card-text>
          <v-alert type="error" dense block v-if="errorMsg" class="mt-5">
            {{ errorMsg }}
          </v-alert>
          <v-alert type="success" dense block v-if="successMsg" class="mt-5">
            {{ successMsg }}
          </v-alert>
        </v-card>
      </v-flex>
    </v-layout>
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
          <v-text-field
            label="Pregunta secreta"
            prepend-icon="mdi-help-circle"
            v-model="actualUsuario.pregunta"
            :rules="passwRules"
            required
          ></v-text-field>
          <v-btn
            :disabled="!valid"
            color="success"
            class="mr-4"
            @click="updateUsuario(), (editar = !editar)"
          >
            Aceptar</v-btn
          >
          <v-btn color="error" class="mr-4" @click="editar = !editar">
            Cerrar
          </v-btn>
        </v-form>
      </v-card>
    </v-dialog>
  </v-container>
</template>
<script>
import axios from "axios";
export default {
  name: "perfil",
  /**
   * contiene todas las variables usadas en la vista
   */
  data() {
    return {
      valid: true,
      editar: false,
      errorMsg: "",
      successMsg: "",
      nameRules: [(v) => !!v || "El nombre del usuario no se a rellenado"],
      emailRules: [
        (v) => !!v || "No se a rellenado el correo",
        (v) => /.+@.+\..+/.test(v) || "El correo debe ser valido",
      ],
      passwRules: [(v) => !!v || "La Contraseña no se a rellenado"],
      listaUsuarios: [],
      actualUsuario: {
        idUsuario: localStorage.getItem("id"),
        nombre: "",
        correo: "",
        password: "",
        pregunta: "",
      },
      token: localStorage.getItem("id"),
      nombre: localStorage.getItem("userName"),
    };
  },
  /**
   * ciclo de vida de vue al crear la pagina ejecuta la funcion
   */
  created: function() {
    this.getUsuarios();
  },
  /**
   * contiene todas las funciones utilizadas en la vista
   */
  methods: {
    /**
     * funcion que recoge los datos de los ususarios mediante una peticion axios
     */
    getUsuarios() {
      var data = new FormData();
      const _this = this;
      data.append("id", _this.token);
      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudU.php?accion=leer2",
          data
        )
        .then(function(response) {
          _this.listaUsuarios = response.data.usuario;
        });
    },
    /**
     *funcion que actualiza los datos del usuario mediante una peticion axios a la que se le pasan los datos a enviar a la pagina php
     */
    updateUsuario() {
      const _this = this;
      var formData = _this.toFormData(_this.actualUsuario);
      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudU.php?accion=editar2",
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
   * funcion de seleccion de usuario, se utiliza para recopilar los datos que se van a enviar a las funciones de borrado o modificacion
   */
    selectUsuario(usuario) {
      this.actualUsuario.nombre = usuario.nombre;
      this.actualUsuario.correo = usuario.correo;
      this.actualUsuario.password = usuario.password;
      this.actualUsuario.pregunta = usuario.pregunta;
    },

    toFormData(obj) {
      var fd = new FormData();
      for (var i in obj) {
        fd.append(i, obj[i]);
      }
      return fd;
    },
  },
};
</script>

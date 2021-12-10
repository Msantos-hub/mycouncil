<template>
  <v-container>
    <v-row>
      <v-col cols="12" md="12" class="mt-10">
        <h3>
          Esta seccion de sugerencias, es unicamente para mandar sugerencias
          respecto a los comics que los usuarios registrados aconsejan añadir en
          un futuro. <br />
          Si no esta registrado puede registrarse en el boton de arriba en la
          esquina derecha. <br />
          Muchas gracias por su contribución. <br />
          Atentamente MyCouncil Staff.
        </h3>
      </v-col>
      <v-col cols="12" md="12">
        <v-form ref="form">
          <v-text-field
            v-model="newSugerencia.nombreComic"
            :rules="nameRules"
            label="Nombre del comic"
            required
          ></v-text-field>
          <v-text-field
            v-model="newSugerencia.description"
            :rules="desRules"
            :counter="300"
            label="Descripcion del comic"
            required
            class="mb-10"
          ></v-text-field>
          <v-btn color="success" class="mr-4" @click="addSugerencia(), clear()">
            Enviar sugerencia
          </v-btn>
          <v-btn color="warning" @click="clear()">
            Reiniciar formulario
          </v-btn>
        </v-form>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import axios from "axios";

export default {
  /**
   *  contiene todas las variables usadas en la vista
   */
  data() {
    return {
      valid: false,
      nombreComic: "",
      nameRules: [(v) => !!v || "No se a rellenado el nombre del comic"],
      description: "",
      desRules: [
        (v) => !!v || "No se a rellenado la descripcion",
        (v) =>
          v.length <= 300 ||
          "La descripcion debe ser de menos de 300 caracteres",
      ],
      newSugerencia: {
        nombreComic: "",
        description: "",
        idUsuario: localStorage.getItem("id"),
      },
    };
  },

  /**
   * contiene todas las funciones usadas en la vista
   */
  methods: {
    /**
     * funcion que añade una nueva sugerencia, mediante una peticion axios manda a la pagina php los datos para realizar la consulta
     */
    addSugerencia() {
      const _this = this;
      var formData = _this.toFormData(_this.newSugerencia);
      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/sugerencias.php?accion=sug",
          formData
        )
        .then(function(response) {
          _this.newSugerencia = {
            nombreComic: "",
            description: "",
            idUsuario: "",
          };
          if (response.data.error) {
            _this.errorMsg = response.data.message;
          } else {
            _this.successMsg = response.data.message;
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
     * cambia el estado de las variables a vacio
     */
    clear() {
      this.nombreComic = "";
      this.description = "";
    },
  },
};
</script>

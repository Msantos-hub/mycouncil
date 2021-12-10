<template>
<!--
  Manuel Jesús Santos García
  TFG CFGS 2º DAW 2021
  Vista en se registran los usuarios
 -->
  <div
    class="wrapper fadeInDown"
    :style="{
      'background-size': 'cover',
      'background-image':
        'url(' + require('@/assets/img/logos/fondoLogin.png') + ')',
    }"
  >
    <div id="formContent">
      <!-- Tabs Titles -->
      <!-- Icon -->
      <div class="fadeIn first">
        <img src="@/assets/img/logos/logo.jpg" id="icon" alt="User Icon" />
      </div>

      <!-- Login Form -->
      <form v-on:submit.prevent="login">
        <label>Bienvenido a MyCouncil</label><br />
        <label>Introducir los datos del registro</label>
        <input
          type="text"
          id="login"
          class="fadeIn second"
          name="correo"
          placeholder="Correo"
          v-model="newUsuario.correo"
          :rules="[(v) => !!v || 'Item is required']"
        />
        <input
          type="text"
          id="user"
          class="fadeIn second"
          name="usuario"
          placeholder="Nombre de usuario"
          v-model="newUsuario.nombre"
          :rules="[(v) => !!v || 'Item is required']"
        />
        <input
          type="password"
          id="password"
          class="fadeIn third"
          name="password"
          placeholder="Contraseña"
          v-model="newUsuario.password"
          :rules="[(v) => !!v || 'Item is required']"
        />
        <input
          type="text"
          id="question"
          class="fadeIn third"
          name="question"
          placeholder="Pregunta secreta, nombre de su mascota"
          v-model="newUsuario.pregunta"
          :rules="[(v) => !!v || 'Item is required']"
        /><br />
        <label
          >* Esta respuesta se usará para recuperar su contraseña en un
          futuro.</label
        ><br />
        <div id="formFooter">
          <v-btn class="light-blue" dark @click="addUsuario()">
            Registrarse</v-btn
          >
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "login",
  data() {
    /**
     * contiene todas las variables usadas en la vista
     */
    return {
      newUsuario: {
        nombre: "",
        correo: "",
        password: "",
        tipo: "u",
        pregunta: "",
      },
    };
  },
  components: {},

  methods: {
    /**
     * funcion que añade un nuevo usuario, mediante una peticion axios manda los datos a la pagina php para realizar la consulta
     */
    addUsuario() {
      const _this = this;
      if (
        _this.newUsuario.nombre != "" &&
        _this.newUsuario.correo != "" &&
        _this.newUsuario.password != "" &&
        _this.newUsuario.pregunta
      ) {
        var formData = _this.toFormData(_this.newUsuario);
        axios
          .post(
            "http://localhost/proyecto/mycouncil/src/bbdd/login.php?accion=registro",
            formData
          )
          .then(function(response) {
            _this.newUsuario = {
              nombre: "",
              correo: "",
              password: "",
              tipo: "u",
              pregunta: "",
            };
            if (response.data.error) {
              alert(response.data.message);
            } else {
              alert(response.data.message);
              _this.$router.push("/login");
            }
          });
      }
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

<style scoped>
html {
  background-color: #56baed;
}

body {
  font-family: "Roboto", sans-serif;
  height: 100vh;
}

a {
  color: #92badd;
  display: inline-block;
  text-decoration: none;
  font-weight: 400;
}

h2 {
  text-align: center;
  font-size: 16px;
  font-weight: 600;
  text-transform: uppercase;
  display: inline-block;
  margin: 40px 8px 10px 8px;
  color: #cccccc;
}

/* STRUCTURE */

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
}

#formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff;
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  padding: 0px;
  -webkit-box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
  box-shadow: 0 30px 60px 0 rgba(0, 0, 0, 0.3);
  text-align: center;
}

#formFooter {
  background-color: #f6f6f6;
  border-top: 1px solid #dce8f1;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}

/* TABS */

h2.inactive {
  color: #cccccc;
}

h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5fbae9;
}

/* FORM TYPOGRAPHY*/

input[type="button"],
input[type="submit"],
input[type="reset"] {
  background-color: #56baed;
  border: none;
  color: white;
  padding: 15px 80px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  font-size: 13px;
  -webkit-box-shadow: 0 10px 30px 0 rgba(95, 186, 233, 0.4);
  box-shadow: 0 10px 30px 0 rgba(95, 186, 233, 0.4);
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
  margin: 5px 20px 40px 20px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

input[type="button"]:hover,
input[type="submit"]:hover,
input[type="reset"]:hover {
  background-color: #39ace7;
}

input[type="button"]:active,
input[type="submit"]:active,
input[type="reset"]:active {
  -moz-transform: scale(0.95);
  -webkit-transform: scale(0.95);
  -o-transform: scale(0.95);
  -ms-transform: scale(0.95);
  transform: scale(0.95);
}

input[type="text"],
input[type="password"] {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 85%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
}

input[type="text"],
input[type="password"] :focus {
  background-color: #fff;
  border-bottom: 2px solid #5fbae9;
}

input[type="text"],
input[type="password"] :placeholder {
  color: #cccccc;
}

/* ANIMATIONS */

/* Simple CSS3 Fade-in-down Animation */
.fadeInDown {
  -webkit-animation-name: fadeInDown;
  animation-name: fadeInDown;
  -webkit-animation-duration: 1s;
  animation-duration: 1s;
  -webkit-animation-fill-mode: both;
  animation-fill-mode: both;
}

@-webkit-keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

@keyframes fadeInDown {
  0% {
    opacity: 0;
    -webkit-transform: translate3d(0, -100%, 0);
    transform: translate3d(0, -100%, 0);
  }
  100% {
    opacity: 1;
    -webkit-transform: none;
    transform: none;
  }
}

/* Simple CSS3 Fade-in Animation */
@-webkit-keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
@-moz-keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

.fadeIn {
  opacity: 0;
  -webkit-animation: fadeIn ease-in 1;
  -moz-animation: fadeIn ease-in 1;
  animation: fadeIn ease-in 1;

  -webkit-animation-fill-mode: forwards;
  -moz-animation-fill-mode: forwards;
  animation-fill-mode: forwards;

  -webkit-animation-duration: 1s;
  -moz-animation-duration: 1s;
  animation-duration: 1s;
}

.fadeIn.first {
  -webkit-animation-delay: 0.4s;
  -moz-animation-delay: 0.4s;
  animation-delay: 0.4s;
}

.fadeIn.second {
  -webkit-animation-delay: 0.6s;
  -moz-animation-delay: 0.6s;
  animation-delay: 0.6s;
}

.fadeIn.third {
  -webkit-animation-delay: 0.8s;
  -moz-animation-delay: 0.8s;
  animation-delay: 0.8s;
}

.fadeIn.fourth {
  -webkit-animation-delay: 1s;
  -moz-animation-delay: 1s;
  animation-delay: 1s;
}

/* Simple CSS3 Fade-in Animation */
.underlineHover:after {
  display: block;
  left: 0;
  bottom: -10px;
  width: 0;
  height: 2px;
  background-color: #56baed;
  content: "";
  transition: width 0.2s;
}

.underlineHover:hover {
  color: #0d0d0d;
}

.underlineHover:hover:after {
  width: 100%;
}

/* OTHERS */

*:focus {
  outline: none;
}

#icon {
  width: 60%;
}
</style>

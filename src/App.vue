<template>
  <v-app>
    <v-main class="mt-10">
      <v-layout row wrap class="mb-5">
        <v-flex xs12 md6>
          <router-link to="/">
            <v-img
              alt="MyCoulcil Logo"
              class="shrink mr-2"
              contain
              src="./assets/img/logos/logo2.png"
              transition="scale-transition"
              width="600"
            />
          </router-link>
        </v-flex>
        <v-flex xs12 md4 align-self-center offset-md2>
          <v-btn
            right
            color="#F26419"
            class="mr-2"
            dark
            rounded
            v-if="token == null"
          >
            <router-link to="/login" class="lista">
              <span class="login mr-2">Iniciar sesion</span>
            </router-link>
          </v-btn>
          <v-btn right color="#F26419" dark rounded v-if="token == null">
            <router-link to="/register" class="lista">
              <span class="login mr-2">Registrate</span>
            </router-link>
          </v-btn>
          <v-btn
            right
            color="#F26419"
            class="mr-2"
            dark
            rounded
            v-if="token != null"
          >
            <router-link to="/user" class="lista">
              <span class="login mr-2">Perfil del usuario</span>
            </router-link>
          </v-btn>
          <v-btn right color="#F26419" dark rounded v-if="token != null">
            <span class="login mr-2" @click="logout()">Cerrar sesion</span>
          </v-btn>
        </v-flex>
      </v-layout>
      <v-tabs>
        <v-tab exact>
          <router-link to="/" class="lista"><v-tab>Inicio</v-tab> </router-link>
        </v-tab>
        <v-tab exact>
          <router-link to="/catalogo" class="lista">Catalogo</router-link>
        </v-tab>
        <v-tab>
          <router-link to="/listas" class="lista">Listas</router-link>
        </v-tab>
        <v-tab exact>
          <router-link to="/sugerencias" class="lista">Sugerencias</router-link>
        </v-tab>
        <v-tab v-if="type != null" exact>
          <router-link to="/controlpanel" class="lista"
            >Panel de Control</router-link
          >
        </v-tab>
      </v-tabs>
      <router-view />
    </v-main>
    <v-footer padless bottom class="black">
      <v-col>
        <ul>
          <li>
            <v-btn v-for="icon in icons" :key="icon" class="mx-4" dark icon>
              <v-icon size="24px">
                {{ icon }}
              </v-icon>
            </v-btn>
          </li>
        </ul>
      </v-col>
    </v-footer>
  </v-app>
</template>

<style>
.lista {
  text-decoration: none;
}
.login {
  color: white;
}
.footer {
  background-color: black;
  display: inline-block;
  text-decoration: none;
  margin-left: 10px;
}
ul,
li {
  list-style: none;
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.22.0/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.2/dist/sweetalert2.all.min.js"></script>
<script src="/js/vue-resource.js"></script>
<script>
export default { 
  name: "App",
  /** 
   *  contiene todas las variables usadas en la vista
  */
  data: () => ({
    icons: ["mdi-facebook", "mdi-twitter", "mdi-discord", "mdi-instagram"],
    legalP: ["Que es MyCouncil", "Cookies", "LSIC", "Avisos Legales"],
    token: null,
    type: null,
  }),
  /**
   * ciclo de vida de vue cuando se modifica la vista comprueba
   */
  updated() {
    this.tokenexist();
  },
  methods: {
    /** 
     * comprueba que existe un token
    */
    tokenexist() {
      var _this = this;
      _this.token = localStorage.getItem("id");
      _this.type = localStorage.getItem("userType");
    },
    /** 
     * borra los tokens del localstorage para cerrar la sesion del usuario 
    */
    logout() {
      localStorage.removeItem("id");
      localStorage.removeItem("userName");
      localStorage.removeItem("userType");
      this.$router.push("/");
    },
  },
};
</script>

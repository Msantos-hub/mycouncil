<template>
  <v-container grid-list-md>
    <v-layout row wrap>
      <v-flex xs12 md6>
        <v-row>
          <v-col xs6>
            <p>
              Aqui podras crear tus listas personalizadas con los comics que se
              encuentran en nuestra base de datos. <br />
              Si crees que deberiamos añadir un nuevo comic a nuestra base de
              datos por favor en la seccion sugerencias puedes indicarnos que
              comic añadir en un futuro a nuestra coleccion.
            </p>
            <v-avatar size="400" rounded>
              <v-img src="../assets/img/logos/wantyou.jpg"></v-img>
            </v-avatar>
          </v-col>
          <v-col xs6>
            <h4>Datos</h4>
            <v-text-field
              type="text"
              placeholder="Nombre de la lista"
              v-model="nombreLista"
              required
            >
            </v-text-field>
            <h4>Seleccion de comics</h4>
            <v-select
              :items="Listacomics"
              label="Comics"
              item-text="nombre"
              item-key="index"
              item-value="idComic"
              v-model="ListaComics"
              multiple
              return-object
            >
            </v-select>
            <v-btn
              bottom
              color="light-blue darken-1"
              class="mr-5 mt-5"
              dark
              @click="getIds(ListaComics)"
            >
              Crear Lista
            </v-btn>
            <v-btn
              bottom
              color="light-blue darken-1"
              class="mr-5 mt-5"
              dark
              @click="crear()"
            >
              Crear Lista
            </v-btn>
          </v-col>
        </v-row>
      </v-flex>
      <v-flex xs12 md6>
        <v-card class="mx-auto" max-width="500">
          <v-toolbar color="light-blue darken-1" dark>
            <v-toolbar-title>Mis listas</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>
          <v-list>
            <v-list-group
              v-for="item in items"
              :key="item.title"
              v-model="item.active"
              :prepend-icon="item.action"
              no-action
            >
              <template v-slot:activator>
                <v-list-item-content>
                  <v-list-item-title v-text="item.title"></v-list-item-title>
                </v-list-item-content>
              </template>
              <v-list-item v-for="child in item.items" :key="child.title">
                <v-list-item-content>
                  <v-list-item-title v-text="child.title"></v-list-item-title>
                </v-list-item-content>
              </v-list-item>
            </v-list-group>
          </v-list>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
import axios from "axios";
export default {
  data: () => ({
    ListaComics: [],
    selectComics: "",
    nombreLista: "",
    items: [],
    Listacomics: [],
    comic: { idComic: "" },
  }),
  created: function() {
    this.getLista();
    this.getComics();
  },
  methods: {
    async getLista() {
      const _this = this;
      var data = new FormData();
      data.append("idUsuario", localStorage.getItem("id"));
      const datos = await axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/listas.php?accion=leer",
          data
        )
        .then(function(response) {
          _this.lista = response.data.comics;
        });
    },
    async getComics() {
      const _this = this;
      const datos = await axios
        .get(
          "http://localhost/proyecto/mycouncil/src/bbdd/crudCo.php?accion=leer"
        )
        .then(function(response) {
          _this.Listacomics = response.data.comic;
        });
    },
    getIds(ListaComics) {
      const _this = this;
      for (var i = 0; i <= ListaComics.length; i++) {
        _this.comic.idComic = ListaComics[i].idComic;
        console.log(_this.comic.idComic);
      }
    },
    crear() {
      const _this = this;
      var data = _this.toFormData(_this.comic);
      data.append("nombre", _this.nombreLista);
      data.append("idUsuario", localStorage.getItem("id"));

      axios
        .post(
          "http://localhost/proyecto/mycouncil/src/bbdd/listas.php?accion=crear",
          data
        )
        .then(function(response) {
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
  },
};
</script>

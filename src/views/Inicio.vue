<template>
  <v-container grid-list-md>
    <v-layout row wrap>
      <v-flex xs12 md8 class="mb-10">
        <v-divider></v-divider>
        <h2>Comics recomendados de Marvel de este mes</h2>
        <v-divider class="mb-5"></v-divider>
        <v-layout>
          <v-flex xs4>
            <div>
              <v-img
                src="../assets/img/portadas/spidermanKraven.jpg"
                height="300"
              ></v-img>
              <h3>
                SpiderMan: La ultima caceria de Kraven
              </h3>
            </div>
          </v-flex>
          <v-flex xs4>
            <div>
              <v-img
                src="../assets/img/portadas/dinastiam.jpg"
                height="300"
              ></v-img>
              <h3>
                Dinastia M
              </h3>
            </div>
          </v-flex>
          <v-flex xs4>
            <div>
              <v-img
                src="../assets/img/portadas/thorragnarok.jpg"
                height="300"
              ></v-img>
              <h3>
                Thor: Ragnarok
              </h3>
            </div>
          </v-flex>
        </v-layout>
        <v-divider></v-divider>
        <h2>Comics recomendados de DC de este mes</h2>
        <v-divider class="mb-5"></v-divider>
        <v-layout>
          <v-flex xs4>
            <div>
              <v-img
                src="../assets/img/portadas/batmankillingjoke.jpg"
                height="300"
              ></v-img>
              <h3>
                Batman: The Killing Joke
              </h3>
            </div>
          </v-flex>
          <v-flex xs4>
            <div>
              <v-img
                src="../assets/img/portadas/wwhiketeia.jpg"
                height="300"
              ></v-img>

              <h3>
                Wonder Woman: The Hiketeia
              </h3>
            </div>
          </v-flex>
          <v-flex xs4>
            <div>
              <v-img
                src="../assets/img/portadas/lucifer.jpg"
                height="300"
              ></v-img>

              <h3>
                LUCIFER
              </h3>
            </div>
          </v-flex>
        </v-layout>
        <v-divider></v-divider>
        <h2>Comics recomendados Independientes de este mes</h2>
        <v-divider class="mb-5"></v-divider>
        <v-layout>
          <v-flex xs4>
            <div>
              <v-img
                src="../assets/img/portadas/mortadelo.jpg"
                height="300"
              ></v-img>
              <h3>
                Mortadelo y Filemon
              </h3>
            </div>
          </v-flex>
          <v-flex xs4>
            <div>
              <v-img
                src="../assets/img/portadas/kingsman.jpg"
                height="300"
              ></v-img>

              <h3>
                Kingsman: Servicio Secreto
              </h3>
            </div>
          </v-flex>
          <v-flex xs4>
            <div>
              <v-img
                src="../assets/img/portadas/spawn.jpg"
                height="300"
              ></v-img>
              <h3>
                Spawn
              </h3>
            </div>
          </v-flex>
        </v-layout>
      </v-flex>
      <v-flex xs12 md4>
        <v-card>
          <v-card-title>
            <h2>
              Comic Recomendado del mes
            </h2>
          </v-card-title>
          <v-img src="../assets/img/portadas/dlh.jpg"></v-img>
          <v-card-text>
            Sorpréndete con los orígenes y las aventuras de dioses y diosas de
            todo el mundo.
            <br />
            ¡Con todo el humor y las ilustraciones desternillantes de Pascu y
            Rodri, de Destripando la historia!
            <br />
            ¡Descubre cuáles son los dioses más extraños y alucinantes que han
            existido!
            <br />
            La mitología universal está repleta de dioses heroicos, figuras
            míticas y grandes historias épicas... Pero en este libro te vamos a
            contar las historias de los dioses más absurdos, desquiciantes y
            fantásticos. Desde Loki, el dios del engaño y la mentira, hasta
            Kali, la destructora, pasando por Dioniso, Pele, Sun Wukong, Apofis
            y muchos más...
            <br />
            ¡Con todo el humor y las ilustraciones desternillantes de su famoso
            canal de YouTube!
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  name: "Inicio",
};
</script>

<style scoped>
h3 {
  text-align: center;
}
</style>

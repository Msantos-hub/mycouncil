<template>
  <v-container grid-list-md>
    <h2>Marvel</h2>
    <v-divider class="mb-5"></v-divider>
    <v-layout row wrap class="mb-10">
      <v-flex xs12 md4>
        <v-card>
          <v-img src="../assets/img/catalogo/heroes.jpg" height="200"></v-img>
          <v-card-title>
            <h4>Heroes</h4>
          </v-card-title>
          <v-card-text>
            <p>
              Los Héroes Marvel son todos los personajes superhumanos Marvel SIN
              poderes mutantes: se trata de los Vengadores, Thor, los 4
              Fantásticos, el Capitán América o el propio Spiderman...
            </p>
          </v-card-text>
          <v-card-actions>
            <v-btn block bottom color="success" to="/heroes">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
      <v-flex xs12 md4>
        <v-card>
          <v-img src="../assets/img/catalogo/mutantes.jpg" height="200"></v-img>
          <v-card-title>
            <h4>Mutantes</h4>
          </v-card-title>
          <v-card-text>
            <p>
              Los superhéroes Marvel con poderes adquiridos en la adolescencia,
              lanzados a la fama por Chris Claremont. En sus filas tenemos a
              miembros como Lobezno, los X-Men o los Nuevos Mutantes...
            </p>
          </v-card-text>
          <v-card-actions>
            <v-btn block bottom color="success" to="/mutantes">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
      <v-flex xs12 md4>
        <v-card>
          <v-img
            src="../assets/img/catalogo/jovenesmarvel.jpg"
            height="200"
          ></v-img>
          <v-card-title>
            <h4>Jovenes Lectores Marvel</h4>
          </v-card-title>
          <v-card-text>
            <p>
              Comics editados para los que quieren iniciarse en el universo
              Marvel, especialmente editados para los nuevos y más jóvenes
              lectores de superhéroes. Comics de la editorial marvel.
            </p>
          </v-card-text>
          <v-card-actions>
            <v-btn block bottom color="success" to="/jovenesmarvel"
              >Acceder</v-btn
            >
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
    <h2>DC Comics</h2>
    <v-divider class="mb-5"></v-divider>
    <v-layout row wrap class="mb-10">
      <v-flex xs12 md4>
        <v-card>
          <v-img src="../assets/img/catalogo/dc.jpg" height="200"></v-img>
          <v-card-title>
            <h4>Universo DC</h4>
          </v-card-title>
          <v-card-text>
            <p>
              El Universo DC por excelencia, hogar de los personajes de todos
              conocidos como Batman, Superman, la JLA, Wonder Woman e incluso
              Lobo.
            </p>
          </v-card-text>
          <v-card-actions>
            <v-btn block color="success" to="/universodc">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
      <v-flex xs12 md4>
        <v-card>
          <v-img src="../assets/img/catalogo/vertigo.jpg" height="200"></v-img>
          <v-card-title>
            <h4>Vertigo</h4>
          </v-card-title>
          <v-card-text>
            <p>
              Vertigo es la linea de comic mas adulto y serio de DC, con títulos
              como Sandman, Predicador, Hellblazer o 100 Balas.
            </p>
          </v-card-text>
          <v-card-actions>
            <v-btn block color="success" to="/vertigo">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
      <v-flex xs12 md4>
        <v-card>
          <v-img
            src="../assets/img/catalogo/jovenesdc.jpg"
            height="200"
          ></v-img>
          <v-card-title>
            <h4>Jovenes Lectores DC</h4>
          </v-card-title>
          <v-card-text>
            <p>
              Comics editados para los que quieren iniciarse en el universo DC,
              especialmente editados para los nuevos y más jóvenes lectores de
              superhéroes.
            </p>
          </v-card-text>
          <v-card-actions>
            <v-btn block color="success" to="/jovenesdc">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
    <h2>Comics Independientes</h2>
    <v-divider class="mb-5"></v-divider>
    <v-layout row wrap class="mb-10">
      <v-flex xs12 md4>
        <v-card>
          <v-img src="../assets/img/catalogo/nacional.jpg" height="200"></v-img>
          <v-card-title>
            <h4>Teveos o comics Nacionales</h4>
          </v-card-title>
          <v-card-text>
            <p>
              El cómic nacional para todas las edades con clásicos como
              "Mortadelo y Filemon" o "Superlopez".
            </p>
          </v-card-text>
          <v-card-actions>
            <v-btn block color="success" to="/nacional">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
      <v-flex xs12 md4>
        <v-card>
          <v-img src="../assets/img/catalogo/kickass.jpg" height="200"></v-img>
          <v-card-title>
            <h4>MillarVerse</h4>
          </v-card-title>
          <v-card-text>
            <p>
              Colecciones escritas por el británico Mark Millar en ese universo
              particular llamado "Millarverso".
            </p>
          </v-card-text>
          <v-card-actions>
            <v-btn block color="success" to="/millarverse">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
      <v-flex xs12 md4>
        <v-card>
          <v-img src="../assets/img/catalogo/heroe.jpg" height="200"></v-img>
          <v-card-title>
            <h4>Super Heroes</h4>
          </v-card-title>
          <v-card-text>
            <p>
              Cómics sobre héroes como Spawn, Invencible o similar, de
              editoriales americanas como Image o Dark Horse.
            </p>
          </v-card-text>
          <v-card-actions>
            <v-btn block color="success" to="/superheroes">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
    <h2>Manga-Manhwa</h2>
    <v-divider class="mb-5"></v-divider>
    <v-layout row wrap class="mb-10">
      <v-flex xs12 md4>
        <v-card>
          <v-img src="../assets/img/catalogo/shonen.jpg" height="200"></v-img>
          <v-card-title>
            <h4>Manga</h4>
          </v-card-title>
          <v-card-text>
            <p>
              El manga de acción que en general está concebido para el público
              juvenil.
            </p>
          </v-card-text>
          <v-card-actions>
            <v-btn block color="success" to="/manga">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
      <v-flex xs12 md4>
        <v-card>
          <v-img src="../assets/img/catalogo/manhwa.jpg" height="200"></v-img>
          <v-card-title>
            <h4>Manhwa</h4>
          </v-card-title>
          <v-card-text>
            <p>
              El manga propio de China y Corea, denominado "manhua" y "manhwa".
            </p>
          </v-card-text>
          <v-card-actions>
            <v-btn block color="success" to="/manhwa">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
      <v-flex xs12 md4>
        <v-card>
          <v-img src="../assets/img/catalogo/webtoons.jpg" height="200"></v-img>
          <v-card-title>
            <h4>WebToons</h4>
          </v-card-title>
          <v-card-text>
            <p>
              Mangas y manhwas que solo podran encontrarse en sitios web como
              solo leveling.
            </p>
          </v-card-text>
          <v-card-actions>
            <v-btn block color="success" to="/webtoons">Acceder</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<template>
    <v-container class="mt-5" id="crudU">
        <v-layout row wrap>
            <v-flex xs12>
                <v-btn color="success" to="/Controlpanel" rounded><v-icon class="mr-2">mdi-arrow-left-circle</v-icon> Volver a gestión </v-btn>               
                <v-btn color="primary" @click="agregarC" class="ml-2"><v-icon class="mr-2">mdi-account-plus</v-icon> Agregar comic </v-btn>
            </v-flex>
        </v-layout> 
        <v-layout row wrap class="mt-5">
            <v-flex xs12>
                <template>
                    <v-simple-table>
                        <template v-slot:default>
                            <thead>
                                <tr>
                                    <th class="text-left">
                                        id
                                    </th>
                                    <th class="text-left">
                                        Nombre
                                    </th>                               
                                    <th class="text-left">
                                        ISBN
                                    </th>
                                    <th class="text-left">
                                        Editorial
                                    </th>
                                    <th class="text-left">
                                        idioma
                                    </th>
                                    <th class="text-left">
                                        Numero de paginas
                                    </th>
                                    <th class="text-left">
                                        Publicado
                                    </th>
                                    <th class="text-left">
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(comic,index) of datosComic" :key="index">
                                    <td>#{{comic.idComic}}</td>
                                    <td>{{comic.nombre}}</td>
                                    <td>{{comic.isbn}}</td>
                                    <td>{{comic.editorial}}</td>
                                    <td>{{comic.idioma}}</td>
                                    <td>{{comic.numeroPaginas}}</td>
                                    <td>{{comic.fechaPublicacion}}</td>
                                    <td>
                                        <v-btn color="light-blue" dark rounded 
                                            @click="btnEditar(comic.idComic,comic.nombre,comic.isbn,comic.editorial,comic.idioma,comic.numeroPaginas,comic.fechaPublicacion)">
                                            <v-icon>mdi-pencil</v-icon> 
                                            editar
                                        </v-btn>
                                        <v-btn color="error" rounded class="ml-5" @click="btnEliminar(comic.idComic)"><v-icon>mdi-trash-can</v-icon> eliminar</v-btn>
                                    </td>
                                </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                </template>
            </v-flex>
        </v-layout>      
    </v-container>   
</template>

<script>
export default {

    data(){
        return{
            datosComic:[]
        }
    },

    methods: {
        agregarUser(){

        },
        btnEditar(){

        },
        btnEliminar(){

        }
    },
}
</script>
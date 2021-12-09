<template>
    <v-container class="mt-5">
        <v-layout row wrap>
            <v-flex xs12>
                <v-btn color="success" to="/Controlpanel" rounded><v-icon class="mr-2">mdi-arrow-left-circle</v-icon> Volver a gestión </v-btn>               
                <v-btn color="primary" @click="agregarCat" class="ml-2"><v-icon class="mr-2">mdi-account-plus</v-icon> Agregar categoria </v-btn>
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
                                        Acciones
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(categoria,index) of datosCategoria" :key="index">
                                    <td>{{categoria.id}}</td>
                                    <td>{{categoria.nombre}}</td>                                  
                                    <td>
                                        <v-btn color="light-blue" dark rounded @click="btnEditar(categoria.id,categoria.nombre)"><v-icon>mdi-pencil</v-icon> editar</v-btn>
                                        <v-btn color="error" rounded class="ml-5" @click="btnEliminar(categoria.id)"><v-icon>mdi-trash-can</v-icon> eliminar</v-btn>
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
            datosCategoria:[
                {id:1,nombre:'Accion'},
                {id:1,nombre:'Suspense'},
                {id:1,nombre:'Terror'},
                {id:1,nombre:'Super-Heroes'},
                {id:1,nombre:'Anti-Heroes'},
                {id:1,nombre:'Villanos'},

            ]
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
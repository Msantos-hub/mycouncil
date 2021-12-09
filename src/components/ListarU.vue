<template>
    <v-container class="mt-5" id="App">
        <v-layout row wrap>
            <v-flex xs12>
                <v-btn color="blue-grey lighten-3" to="/Controlpanel" rounded ><v-icon class="mr-2">mdi-arrow-left-circle</v-icon> Volver a gestión </v-btn>               
                <v-btn color="green darken-1" @click="agregarUser, add=true" rounded class="ml-2" dark><v-icon class="mr-2">mdi-account-plus</v-icon> Agreagar usuario </v-btn>
            </v-flex>
        </v-layout> 
        <div class="alert alert-danger" v-if="errorMsg">
            {{errorMsg}}
        </div>
        <div class="alert alert-success" v-if="successMsg">
            {{successMsg}}
        </div>
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
                                    <th class="text-left  white--text"  >
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
                                        ACCIONES
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(item,index) of listaUsuarios" :key="index">
                                    <td>{{item.id}}</td>
                                    <td>{{item.nombre}}</td>
                                    <td>{{item.correo}}</td>
                                    <td>{{item.password}}</td>
                                    <td>{{item.tipo}}</td>
                                    <td>
                                        <v-btn color="light-blue" dark rounded @click="btnEditar(usuario.id,usuario.nombre,usuario.email,usuario.pass,usuario.tipo),editar = true ">
                                            <v-icon>mdi-pencil</v-icon> 
                                            editar
                                        </v-btn>
                                        <v-btn color="error" rounded class="ml-5" @click="btnEliminar(usuario.id)"><v-icon>mdi-trash-can</v-icon> eliminar</v-btn>
                                    </td>
                                </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                </template>
            </v-flex>
        </v-layout >  
        <!-- dialog-->
        <v-dialog v-model="add" width="700" persistent>
                <v-card>
                    <v-toolbar-title class="info text-center"> Añadir Usuario</v-toolbar-title>
                    <v-form ref="form" v-model="valid" class="ma-5">                   
                        <v-text-field v-model="name" :counter="20" :rules="nameRules" label="Nombre de usuario" required></v-text-field>
                        <v-text-field v-model="email" :rules="emailRules" label="Correo" required></v-text-field>
                        <v-text-field v-model="passw"  :rules="passwRules" label="Contraseña" required></v-text-field>
                        <v-select v-model="select" :items="items" :rules="[v => !!v || 'Item is required']" label="Tipo de usuario" required></v-select>
                        <v-btn :disabled="!valid" color="success"  class="mr-4" @click="validate"> Aceptar</v-btn>
                        <v-btn  color="error" class="mr-4" @click="add =! add"> Cerrar </v-btn>
                        <v-btn  color="warning" @click="resetValidation">Reiniciar formulario </v-btn>
                    </v-form>   
                </v-card>               
            </v-dialog> 
            <v-dialog v-model="editar" width="700" persistent>
                <v-card>
                    <v-toolbar-title class="info text-center"> Editar Usuario</v-toolbar-title>
                    <v-form ref="form" v-model="valid" class="ma-5">                   
                        <v-text-field v-model="name" :counter="20" :rules="nameRules" label="Nombre de usuario" required></v-text-field>
                        <v-text-field v-model="email" :rules="emailRules" label="Correo" required></v-text-field>
                        <v-text-field v-model="passw"  :rules="passwRules" label="Contraseña" required></v-text-field>
                        <v-select v-model="select" :items="items" :rules="[v => !!v || 'Item is required']" label="Tipo de usuario" required></v-select>
                        <v-btn :disabled="!valid" color="success"  class="mr-4" @click="validate"> Aceptar</v-btn>
                        <v-btn  color="error" class="mr-4" @click="editar =! editar"> Cerrar </v-btn>
                        <v-btn  color="warning" @click="resetValidation">Reiniciar formulario </v-btn>
                    </v-form>   
                </v-card>               
            </v-dialog>    
    </v-container>   
</template>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.22.0/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.2/dist/sweetalert2.all.min.js"></script>

<script>
    import axios from "axios";
    export default {
        name: 'app',
        data(){
            return{
                errorMsg:'',
                successMsg:'',
                add:false,
                editar: false, 
                valid: true,
                name: '',
                nameRules: [v => !!v || 'El nombre del usuario no se a rellenado'],
                email: '',
                emailRules: [
                    v => !!v || 'No se a rellenado el correo',
                    v => /.+@.+\..+/.test(v) || 'El correo debe ser valido',
                ],
                passw:'',
                passwRules: [v => !!v || 'La Contrseña no se a rellenado'],
                select: null,
                items: [
                    'Administrador',
                    'Usuario'
                ],
                listaUsuarios:[],
                newUsuario:{nombre:'',correo:'',password:'',tipo:''},
                actualUsuario:{}           
            }
        },
       
        mounted:function() {
            this.getUsuarios();
        },

        methods: {
            getUsuarios(){
                axios.get("http://localhost/proyecto/mycouncil/src/bbdd/crudU.php?accion=leer").then(function(response){
                    if(response.data.error){
                         app.errorMsg=response.data.message;
                    }else{
                        app.listaUsuarios = response.data.usuario;
                        console.log(app.listaUsuarios);
                    }     
                })             
            },           
            clearMsg(){
                app.errorMsg='';
                app.successMsg='';
            },
            validate () {
                this.$refs.form.validate()
            },
             reset () {
                this.$refs.form.reset()
            },
            resetValidation () {
                this.$refs.form.resetValidation()
            },
        },
}
</script>
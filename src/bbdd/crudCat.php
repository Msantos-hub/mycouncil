<?php

    //Concede accede de control al origen
    header('Access-Control-Allow-Origin: *');

    //Conecta con la base de datos
    $conexion= new mysqli("localhost","root","","council");
    if($conexion->connect_error){
        die("Fallo en la conexion al servidor".$conexion->connect_error);
    }
    $resultado=array('error'=>false);
    $action='';

    //recoger la accion que ejecutara las diferentes querys
    if(isset($_GET['accion'])){
        $action=$_GET['accion'];
    }


    //Query de recopilacion de datos
    if($action == 'leer'){
        $sql= $conexion->query("SELECT * FROM categoria");
        $users = array();
        while($row = $sql->fetch_assoc()){
            array_push($users,$row);
        }
        $resultado['categoria'] = $users;  
    }

    //Query de adicion de datos a la base de datos
    if($action == 'crear'){
        $nombre= $_POST['nombre'];
        $sql=$conexion->query("INSERT INTO categoria(nombre) VALUES ('$nombre')");

        if($sql){
            $resultado['message']= "La categoria añadido correctamente";
        }else{
            $resultado['error']=true;
            $resultado['message']="ERROR: La categoria no se ha añadido";
        }
    }

     //Query de edicion de datos
    if($action == 'editar'){
        
        $id=$_POST['idCategoria'];
        $nombre= $_POST['nombre'];


        $sql=$conexion->query("UPDATE categoria SET nombre='$nombre' WHERE idCategoria ='$id'");

        if($sql){
            $resultado['message']= "La categoria modificado correctamente";
        }else{
            $resultado['error']=true;
            $resultado['message']="ERROR: La categoria no se ha podido modificar";
        }
    }

    //Query de eliminacion de datos
    if($action == 'borrar'){
        $id=$_POST['idCategoria'];

        $sql=$conexion->query("DELETE FROM categoria WHERE idCategoria='$id'");

        if($sql){
            $resultado['message']= "La categoria ha sido borrado correctamente";
        }else{
            $resultado['error']=true;
            $resultado['message']="ERROR: La categoria no se ha podido borrar";
        }
    }
   
    //Muestra los resultados en formato JSON
    echo json_encode($resultado);

?>
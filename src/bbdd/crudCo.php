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
        $sql= $conexion->query("SELECT * FROM comic");
        $users = array();
        while($row = $sql->fetch_assoc()){
            array_push($users,$row);
        }
        $resultado['comic'] = $users;  
    }

    //Query de adicion de datos a la base de datos
    if($action == 'crear'){
        $nombre= $_POST['nombre'];
        $isbn=$_POST['isbn'];
        $numPag=$_POST['numeroPaginas'];
        $fechaPubli=$_POST['fechaPublicacion'];
        $idioma=$_POST['idioma'];
        $editorial=$_POST['editorial'];
        $portada=$_POST['portada'];

        $sql=$conexion->query("INSERT INTO comic(nombre,isbn,numeroPaginas,fechaPublicacion,idioma,editorial,portada) 
        VALUES ('$nombre','$isbn','$numPag','$fechaPubli','$idioma','$editorial','$portada)");

        if($sql){
            $resultado['message']= "comic añadido correctamente";
        }else{
            $resultado['error']=true;
            $resultado['message']="ERROR: El comic no se ha añadido";
        }
    }

     //Query de edicion de datos
    if($action == 'editar'){
        
        $id=$_POST['idComic'];
        $nombre= $_POST['nombre'];
        $isbn=$_POST['isbn'];
        $numPag=$_POST['numeroPaginas'];
        $fechaPubli=$_POST['fechaPublicacion'];
        $idioma=$_POST['idioma'];
        $editorial=$_POST['editorial'];
        $portada=$_POST['portada'];

        $sql=$conexion->query("UPDATE comic 
        SET nombre='$nombre',isbn='$isbn', numeroPaginas='$numPag', fechaPublicacion='$fechaPubli', idioma='$idioma', editorial='$editorial', portada='$portada' 
        WHERE idComic ='$id'");

        if($sql){
            $resultado['message']= "comic modificado correctamente";
        }else{
            $resultado['error']=true;
            $resultado['message']="ERROR: El comic no se ha podido modificar";
        }
    }

    //Query de eliminacion de datos
    if($action == 'borrar'){
        $id=$_POST['idComic'];

        $sql=$conexion->query("DELETE FROM comic WHERE idComic='$id'");

        if($sql){
            $resultado['message']= "comic ha sido borrado correctamente";
        }else{
            $resultado['error']=true;
            $resultado['message']="ERROR: El comic no se ha podido borrar";
        }
    }

    //Muestra los resultados en formato JSON
    echo json_encode($resultado);

?>
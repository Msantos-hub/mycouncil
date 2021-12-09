<?php

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

    if($action == 'leer'){
        $sql= $conexion->query("SELECT * FROM sugerencia WHERE estado='Pendiente'");
        $users = array();
        while($row = $sql->fetch_assoc()){
            array_push($users,$row);
        }
        $resultado['sugerencia'] = $users;  
    }

    if($action == 'leer2'){
        $sql= $conexion->query("SELECT * FROM sugerencia WHERE estado='Aprobado'");
        $users = array();
        while($row = $sql->fetch_assoc()){
            array_push($users,$row);
        }
        $resultado['sugerencias'] = $users;  
    }

    if($action == 'sug'){
        
        $id=$_POST['idUsuario'];
        $nombre= $_POST['nombreComic'];
        $descripcion=$_POST['description'];
       
        $sql=$conexion->query("INSERT INTO sugerencia (idUsuario,nombrecomic,descripcion) VALUES ('$id','$nombre','$descripcion')");

        if($sql){
            $resultado['message']= "Usuario añadido correctamente";
        }else{
            $resultado['error']=true;
            $resultado['message']="ERROR: El usuario no se ha añadido";
        }
    }
    if($action == 'aprobar'){
        
        $id = $_POST['idSugerencia'];
        $estado = 'Aprobado';
        
        $sql=$conexion->query("UPDATE sugerencia SET estado = '$estado' WHERE idSugerencia = '$id'");

        if($sql){
            $resultado['message']= "sugerencia modificada correctamente";
        }else{
            $resultado['error']=true;
            $resultado['message']="ERROR: La sugerencia no se ha podido modificar";
        }
    }

    if($action == 'borrar'){
        $id=$_POST['idSugerencia'];

        $sql=$conexion->query("DELETE FROM sugerencia WHERE idSugerencia ='$id'");

        if($sql){
            $resultado['message']= "Sugerencia ha sido borrado correctamente";
        }else{
            $resultado['error']=true;
            $resultado['message']="ERROR: La sugerencia no se ha podido borrar";
        }
    }
    echo json_encode($resultado);
?>
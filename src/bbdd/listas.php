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

        $idUsuario= $_POST['idUsuario']; 

        $sql=$conexion->query("SELECT usuariolista.idUsuario, usuariolista.idLista, listacomic.idComic FROM usuariolista
            INNER JOIN lista ON lista.idLista = usuariolista.idLista
            INNER JOIN listacomic ON listacomic.idLista = lista.idLista
            WHERE usuariolista.idUsuario = '$idUsuario'");

            $users = array();
            while($row = $sql->fetch_assoc()){
                array_push($users,$row);
            }
            $resultado['comics'] = $users;
    }

//Query de adicion de datos a la base de datos
    if($action == 'crear'){

        $idUsuario= $_POST['idUsuario'];
        $nombre= $_POST['nombre'];
        $idComic= $_POST['idcomic'];

        $sql=$conexion->query("INSERT INTO lista(nombre) VALUES ('$nombre')");

        $idLista=mysqli_insert_id($conexion);

       if($sql){   
            $sql2=$conexion->query("INSERT INTO usuariolista(idUsuario,idLista) VALUES ('$idUsuario','$idLista')"); 
            if($sql2){               
                $resultado['message']= "Union Usuario lista correcta";
                $sql3=$conexion->query("INSERT INTO listacomic(idLista,idcomic) VALUES ('$idLista','$idComic')");              
             }    
        }else{
            $resultado['error']=true;
            $resultado['message']="ERROR: No se a podido realizar la union";
        }
    }
    //Muestra los resultados en formato JSON
    echo json_encode($resultado);

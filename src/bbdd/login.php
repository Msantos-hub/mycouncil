<?php

    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials", "true");
    header("Access-Control-Allow-Methods", "GET,HEAD,OPTIONS,POST,PUT");
    header("Access-Control-Allow-Headers", "Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
    header('Access-Control-Allow-Headers: Content-Type');


    $conexion= new mysqli("localhost","root","","council");

    if($conexion->connect_error){
        die("Fallo en la conexion al servidor".$conexion->connect_error);
    }

    $resultado=array('error'=>false);
    $action='';

   
    if(isset($_GET['accion'])){
        $action=$_GET['accion'];
    }

    if($action == 'inicioSesion')
    {            
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        $sql=$conexion->query("SELECT * FROM usuario WHERE correo ='$correo' AND password ='$password' AND tipo='u'");
        $users = array();
        while ($row = $sql->fetch_assoc()) {
            array_push($users, $row);
        };
        $result= ($sql);
        $num = mysqli_num_rows($result);      
        if($num > 0){
            $res['message']='Inicio de sesion correcto usuario'; 
            $res['usuario']= $users;       
        }else{
            $res['error']=true;
            $res['message']='El correo o la contraseña son invalidos';
        }
        
    }

    if($action == 'inicioSesionA')
    {            
        $correo = $_POST['correo'];
        $password = $_POST['password'];

        $sql=$conexion->query("SELECT * FROM usuario WHERE correo ='$correo' AND password ='$password' AND tipo='a'");
        $users = array();
        while ($row = $sql->fetch_assoc()) {
            array_push($users, $row);
        };
        $result= ($sql);
        $num = mysqli_num_rows($result);      
        if($num > 0){
            $res['message']='Inicio de sesion correcto admin'; 
            $res['usuario']= $users;       
        }else{
            $res['error']=true;
            $res['message']='El correo o la contraseña son invalidos';
        }
        
    } 

    if($action == 'registro'){
        $nombre= $_POST['nombre'];
        $correo= $_POST['correo'];
        $password= $_POST['password'];
        $tipo= $_POST['tipo'];
        $pregunta= $_POST['pregunta'];

        $sql=$conexion->query("INSERT INTO usuario(nombre,correo,password,tipo,pregunta) VALUES ('$nombre','$correo','$password','$tipo','$pregunta')");

         if($sql){
            $res['message']= "Usuario añadido correctamente";
        }else{
            $res['error']=true;
            $res['message']="ERROR: El usuario no se ha añadido";
        } 
     }

    header("Content-Type: application/json");
    echo json_encode($res);
    die();
?>
<?php

/**
 * Concede acceso desde todos los origenes
 */
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials", "true");
header("Access-Control-Allow-Methods", "GET,HEAD,OPTIONS,POST,PUT");
header("Access-Control-Allow-Headers", "Access-Control-Allow-Headers, Origin,Accept, X-Requested-With, Content-Type, Access-Control-Request-Method, Access-Control-Request-Headers");
header('Access-Control-Allow-Headers: Content-Type');
header("Content-Type: application/json");

/**
 * Conecta con la base de datos
 */
$conexion = new mysqli("localhost", "root", "", "council");
if ($conexion->connect_error) {
    die("Fallo en la conexion al servidor" . $conexion->connect_error);
}
$resultado = array('error' => false);
$action = '';


/**
 * recoger la accion que ejecutara las diferentes querys
 */
if (isset($_GET['accion'])) {
    $action = $_GET['accion'];
}


/**
 * Query de recopilacion de datos
 */
if ($action == 'leer') {
    $sql = $conexion->query("SELECT * FROM usuario");
    $users = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($users, $row);
    }
    $resultado['usuario'] = $users;
}

if ($action == 'leer2') {
    $id = $_POST['id'];

    $sql = $conexion->query("SELECT * FROM usuario WHERE idUsuario='$id'");
    $users = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($users, $row);
    }
    $resultado['usuario'] = $users;
}


/**
 * Query de adicion de datos a la base de datos
 */
if ($action == 'crear') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $tipo = $_POST['tipo'];
    $sql = $conexion->query("INSERT INTO usuario(nombre,correo,password,tipo) VALUES ('$nombre','$correo','$password','$tipo')");

    if ($sql) {
        $resultado['message'] = "Usuario añadido correctamente";
    } else {
        $resultado['error'] = true;
        $resultado['message'] = "ERROR: El usuario no se ha añadido";
    }
}


/**
 * 
 */
if ($action == 'editar') {

    $id = $_POST['idUsuario'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $tipo = $_POST['tipo'];

    $sql = $conexion->query("UPDATE usuario SET nombre='$nombre',correo='$correo',password='$password',tipo='$tipo' WHERE idUsuario ='$id'");

    if ($sql) {
        $resultado['message'] = "Usuario modificado correctamente";
    } else {
        $resultado['error'] = true;
        $resultado['message'] = "ERROR: El usuario no se ha podido modificar";
    }
}
/**
 * Query de edicion de datos
 */
if ($action == 'editar2') {

    $id = $_POST['idUsuario'];
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $question = $_POST['pregunta'];

    $sql = $conexion->query("UPDATE usuario SET nombre='$nombre',correo='$correo',password='$password',pregunta='$question' WHERE idUsuario ='$id'");

    if ($sql) {
        $resultado['message'] = "Usuario modificado correctamente";
    } else {
        $resultado['error'] = true;
        $resultado['message'] = "ERROR: El usuario no se ha podido modificar";
    }
}


/**
 * Query de eliminacion de datos
 */
if ($action == 'borrar') {
    $id = $_POST['idUsuario'];

    $sql = $conexion->query("DELETE FROM usuario WHERE idUsuario='$id'");

    if ($sql) {
        $resultado['message'] = "Usuario ha sido borrado correctamente";
    } else {
        $resultado['error'] = true;
        $resultado['message'] = "ERROR: El usuario no se ha podido borrar";
    }
}


/**
 *  Muestra los resultados en formato JSON
 */
echo json_encode($resultado);

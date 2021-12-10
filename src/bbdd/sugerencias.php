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
 *  recoger la accion que ejecutara las diferentes querys
 */
if (isset($_GET['accion'])) {
    $action = $_GET['accion'];
}

/**
 * Query de recopilacion de datos
 */
if ($action == 'leer') {
    $sql = $conexion->query("SELECT * FROM sugerencia WHERE estado='Pendiente'");
    $users = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($users, $row);
    }
    $resultado['sugerencia'] = $users;
}

/**
 * Query de recopilacion de datos
 */
if ($action == 'leer2') {
    $sql = $conexion->query("SELECT * FROM sugerencia WHERE estado='Aprobado'");
    $users = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($users, $row);
    }
    $resultado['sugerencias'] = $users;
}

/**
 * Query de insercion de datos
 */
if ($action == 'sug') {

    $id = $_POST['idUsuario'];
    $nombre = $_POST['nombreComic'];
    $descripcion = $_POST['description'];

    $sql = $conexion->query("INSERT INTO sugerencia (idUsuario,nombrecomic,descripcion) VALUES ('$id','$nombre','$descripcion')");

    if ($sql) {
        $resultado['message'] = "Usuario añadido correctamente";
    } else {
        $resultado['error'] = true;
        $resultado['message'] = "ERROR: El usuario no se ha añadido";
    }
}

/**
 * Query de modifica el campo estado de tabla sugerencias
 */
if ($action == 'aprobar') {

    $id = $_POST['idSugerencia'];
    $estado = 'Aprobado';

    $sql = $conexion->query("UPDATE sugerencia SET estado = '$estado' WHERE idSugerencia = '$id'");

    if ($sql) {
        $resultado['message'] = "sugerencia modificada correctamente";
    } else {
        $resultado['error'] = true;
        $resultado['message'] = "ERROR: La sugerencia no se ha podido modificar";
    }
}

/**
 * Query de borrado de datos
 */
if ($action == 'borrar') {
    $id = $_POST['idSugerencia'];

    $sql = $conexion->query("DELETE FROM sugerencia WHERE idSugerencia ='$id'");

    if ($sql) {
        $resultado['message'] = "Sugerencia ha sido borrado correctamente";
    } else {
        $resultado['error'] = true;
        $resultado['message'] = "ERROR: La sugerencia no se ha podido borrar";
    }
}
echo json_encode($resultado);

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
 * ejecuta una consulta para traer datos y guardarlos en una variable
 */
if ($action == 'leer') {

    $idCategoria = $_POST['idCategoria'];

    $sql = $conexion->query("SELECT comic.idComic, comic.nombre, comic.portada FROM comic
        INNER JOIN categoriacomic ON categoriacomic.idComic = comic.idComic
        INNER JOIN categoria ON categoria.idCategoria = categoriacomic.idCategoria            
        WHERE categoriacomic.idCategoria = '$idCategoria'");
    $users = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($users, $row);
    }
    $resultado['comics'] = $users;
}


/**
 * Muestra los resultados en formato JSON
 */
echo json_encode($resultado);

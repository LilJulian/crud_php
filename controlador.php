<?php

require('conexion.php');

$db = new Conexion();
$conexion = $db->getConexion();

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$fecha_nacimiento = $_POST['fecha_nacimiento'];
$id_genero = $_POST['id_genero'];
$id_ciudad = $_POST['id_ciudad'];
$lenguaje = $_POST['id_lenguaje'];


$sql = "INSERT INTO  usuarios  (nombre, apellido, correo, fecha_nacimiento, id_genero, id_ciudad) VALUES
(:nombre, :apellido, :correo, :fecha_nacimiento, :id_genero, :id_ciudad)" ;

$stm = $conexion->prepare($sql);
$stm->bindParam(':nombre', $nombre);
$stm->bindParam(':apellido', $apellido);
$stm->bindParam(':correo', $correo);
$stm->bindParam(':fecha_nacimiento', $fecha_nacimiento);
$stm->bindParam(':id_genero', $id_genero);
$stm->bindParam(':id_ciudad', $id_ciudad);
$stm->execute();

$ultimo_usuario = $conexion->lastInsertId();
echo $ultimo_usuario;

foreach ($lenguaje as $key => $value) {
    $sql = "INSERT INTO lenguaje_usuario (id_usuario, id_lenguaje) VALUES
    (:id_usuario, :id_lenguaje)";
    $stm = $conexion->prepare($sql);
    $stm->bindParam(':id_usuario', $ultimo_usuario);
    $stm->bindParam(':id_lenguaje', $value);
    echo "<br>".$value;
    
    $stm->execute();
}



echo "<pre>";
print_r($_REQUEST);
echo "<pre>";
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
$id_usuario = $_POST['id_usuario'];

$actualizacion = "UPDATE usuarios SET 
nombre = :nombre,
apellido = :apellido,
correo = :correo,
fecha_nacimiento = :fecha_nacimiento,
id_genero = :id_genero,
id_ciudad = :id_ciudad
WHERE id_usuario = :id_usuario";
$stm = $conexion->prepare($actualizacion);
$stm->bindParam(':nombre', $nombre);
$stm->bindParam(':apellido', $apellido);
$stm->bindParam(':correo', $correo);
$stm->bindParam(':fecha_nacimiento', $fecha_nacimiento);
$stm->bindParam(':id_genero', $id_genero);
$stm->bindParam(':id_ciudad', $id_ciudad);
$stm->bindParam(':id_usuario',$id_usuario);
$usuario = $stm->fetch();
$stm->execute();

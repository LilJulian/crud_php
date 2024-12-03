<?php

    require('conexion.php');

    function Eliminar(){

        $db = new Conexion();
        $conexion = $db->getConexion();
        $id_usuario = $_GET['id_usuario'];
    
        
        $sql = "DELETE FROM lenguaje_usuario WHERE id_usuario = :id_usuario";
        $stm = $conexion->prepare($sql);
        $stm -> bindParam(':id_usuario',$id_usuario);
        $stm->execute();
        
        $sql = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
        $stm = $conexion->prepare($sql);
        $stm -> bindParam(':id_usuario',$id_usuario);
        $stm->execute();
    }

    Eliminar();
?>
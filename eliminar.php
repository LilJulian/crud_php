<?php

    require('conexion.php');

    function Eliminar(){

        $db = new Conexion();
        $conexion = $db->getConexion();
    

        $sql = "DELETE FROM usuarios WHERE id_usuario = id_usuario";
        $stm = $conexion->prepare($sql);
        $stm->execute();

    }

    Eliminar();
?>
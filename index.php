<?php

require('conexion.php');

$db = new Conexion();
$conexion = $db->getConexion();

$sql = "SELECT * FROM ciudades";
$bandera = $conexion->prepare($sql);
$bandera->execute();
$ciudades = $bandera->fetchAll();

$consulta_gen = "SELECT * FROM generos";
$banadera = $conexion->prepare($consulta_gen);
$banadera->execute(); 
$generos = $banadera->fetchAll();

$consulta_len = "SELECT * FROM lenguajes";
$bnadera = $conexion->prepare($consulta_len);
$bnadera->execute(); 
$lenguajes = $bnadera->fetchAll();
?>

<form action="controlador.php" method="post">
    <div>
        <div>
            <label for="nombre">Nombres</label>
            <input type="text" name="nombre">
        </div>
        <br>
        <div>
            <label for="apellido">Apellidos</label>
            <input type="text" name="apellido">
        </div>
        <br>
        <div>
            <label for="correo">Correo</label>
            <input type="text" name="correo">
        </div>
        <br>
        <div>
            <label for="nacimiento">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento">
        </div>
        <br>
        <label for="id_ciudad">Ciudad</label >
        <select name="id_ciudad" id="id_ciudad">
            <?php
            foreach ($ciudades as $key => $value) {
                ?>
                <option name="id_ciudad" value="<?= $value['id_ciudad']?>"><?= $value['nombre_ciudad']?>
                </option>
            <?php
            }
            ?>
        </select>
    </div>
    <br>
    <div>
        <?php
        foreach($generos as $key => $value){
        ?>
            <div>
            <label for="genero<?= $value['id_genero'] ?>"><?= $value['nombre_genero']?>
                <input type="radio" name="id_genero" value="<?= $value['id_genero']?>" id="genero<?= $value['id_genero']?>">
            </label>
            </div>
            <?php
            }
            ?>
    </div>
    <br>
    <div>
        <?php
        foreach($lenguajes as $key => $value){
            ?>
            <div>
                <label for="lenguaje<?= $value['id_lenguaje'] ?>"><?= $value['nombre']?>
                <input type="checkbox" name="id_lenguaje[]" value="<?= $value['id_lenguaje']?>" id="lenguaje<?= $value['id_lenguaje']?>">
            </label>
            </div>
        <?php    
        }    
        ?>    
    </div>
    <br>
    <div>
        <button type="submit">Enviar</button>
        
    </div>
</form>

<form action="eliminar.php">
    <button type="submit">Eliminar</button>
</form>
<?php
require('conexion.php');

$db = new Conexion();
$conexion = $db->getConexion();


// $consulta_usuario = "SELECT id_usuario, nombre, apellido, correo, fecha_nacimiento, generos.nombre_genero AS genero, ciudades.nombre_ciudad AS ciudad FROM usuarios inner join generos on usuarios.id_genero = generos.id_genero inner join ciudades on usuarios.id_ciudad = ciudades.id_ciudad";
// $bdera = $conexion->prepare($consulta_usuario);
// $bdera->execute();
// $usuarios = $bdera->fetchAll(); 

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

$id_usuario = $_GET['id_usuario'];

$sql = "SELECT * FROM usuarios WHERE id_usuario = :id";
$stm = $conexion->prepare($sql);
$stm->bindParam(':id', $id_usuario);
$stm->execute();
$usuario = $stm->fetch();



$sql = "SELECT id_lenguaje FROM lenguaje_usuario WHERE id_usuario = :id_lenguaje";
$stm = $conexion->prepare($sql);
$stm->bindParam(':id_lenguaje', $id_usuario);
$stm -> execute();
$lenguaje_usu = $stm->fetchAll();
$lenguajesArray = [];
foreach ($lenguaje_usu as $key => $value) {
    $lenguajesArray[] = $value['id_lenguaje'];
}
// echo $lenguaje_usu;

// print_r($lenguajesArray);

?>
<form action="actualizado.php" method="post" class="formulario">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body{
            display: flex;
            align-items: center;
        }

        .formulario{
            margin: 0 auto;
            background-color: #d4c6a1;
            width: 300px;
            height: 500px;
            padding: 11px;
            display: flex;
            flex-direction: column;
            gap: 5px;

        }
    </style>
    <div>
        <div>
            <input type="hidden" name="id_usuario" value="<?=$id_usuario?>">
        </div>
        <div>
            <label for="nombre">Nombres</label>
            <input type="text" name="nombre" value="<?=$usuario['nombre']?>">
        </div>
        <br>
        <div>
            <label for="apellido">Apellidos</label>
            <input type="text" name="apellido" value="<?=$usuario['apellido']?>">
        </div>
        <br>
        <div>
            <label for="correo">Correo</label>
            <input type="text" name="correo" value="<?=$usuario['correo']?>">
        </div>
        <br>
        <div>
            <label for="nacimiento">Fecha de nacimiento</label>
            <input type="date" name="fecha_nacimiento" value="<?=$usuario['fecha_nacimiento']?>">
        </div>
        <br>
        <label for="id_ciudad">Ciudad</label >
        <select name="id_ciudad" id="id_ciudad">
            <?php
            foreach ($ciudades as $key => $value) {
                ?>
                <option name="id_ciudad" value="<?= $value['id_ciudad']?>"
                <?php 
                if ($value['id_ciudad'] === $usuario['id_ciudad']) {
                    ?>
                    selected
                    <?php
                }?>
                >
                    <?= $value['nombre_ciudad']?>
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
                <input type="radio" name="id_genero" value="<?= $value['id_genero']?>" id="genero<?= $value['id_genero']?>"
                <?php
                if ($value['id_genero'] === $usuario['id_genero']) {
                    ?>
                    checked
                    <?php
                }
                ?>
                >
                
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
                <input type="checkbox" name="id_lenguaje[]" value="<?= $value['id_lenguaje']?>" id="lenguaje<?= $value['id_lenguaje']?>"
                <?php
                if (in_array($value['id_lenguaje'], $lenguajesArray)) {
                    ?>
                    checked
                    <?php
                }
                ?>
                >
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
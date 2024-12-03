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

$sql = "SELECT * FROM usuarios";
$ultimo_usuario = $conexion->lastInsertId();
// echo $ultimo_usuario;

foreach ($lenguaje as $key => $value) {
    $sql = "INSERT INTO lenguaje_usuario (id_usuario, id_lenguaje) VALUES
    (:id_usuario, :id_lenguaje)";
    $stm = $conexion->prepare($sql);
    $stm->bindParam(':id_usuario', $ultimo_usuario);
    $stm->bindParam(':id_lenguaje', $value);
    // echo "<br>".$value;

$consulta_usuario = "SELECT id_usuario, nombre, apellido, correo, fecha_nacimiento, generos.nombre_genero AS genero, ciudades.nombre_ciudad AS ciudad FROM usuarios inner join generos on usuarios.id_genero = generos.id_genero inner join ciudades on usuarios.id_ciudad = ciudades.id_ciudad";
$bdera = $conexion->prepare($consulta_usuario);
$bdera->execute();
$usuarios = $bdera->fetchAll();
    
$stm->execute();
}




// echo "<pre>";
// print_r($_REQUEST);
// echo "<pre>";


?>
<table class="tabla">
    <tr>
        <th>id_usuario</th >
        <th>Nombre</th >
        <th>Apellido</th >
        <th>correo</th >
        <th>fecha_nacimiento</th >
        <th>genero</th >
        <th>ciudad</th >
        <th>Editar</th>
        <th>Eliminar</th>
    </tr>
    <?php
    foreach($usuarios as $key =>$value){
    ?>
    <tr class="celda">
        <style>
            .tabla{
                border: 1px solid ;
            }
            .celda{
                border: 1px solid;
            }            
        </style>
        <td>           
            <?= $value['id_usuario']?>        
        </td>
        <td>
            <?= $value['nombre']?>
        </td>
        <td>
            <?= $value['apellido']?>
        </td>
        <td>
            <?= $value['correo']?>
        </td>
        <td>
            <?= $value['fecha_nacimiento']?>
        </td>
        <td>
            <?= $value['genero']?>
        </td>
        <td>
            <?= $value['ciudad']?>
        </td>
        <td>
            <a href="update.php?id_usuario=<?= $value['id_usuario']?>">Editar</a>
        </td>
        <td>
            <a  href="eliminar_usu.php?id_usuario=<?= $value['id_usuario']?>">Eliminar</a>
        </td>
        <?php
    }
    ?>        
    </tr>    
</table>

<?php
$consulta_leng_usu =  "SELECT * FROM julian.lenguaje_usuario";
$era = $conexion->prepare($consulta_leng_usu);
$era -> execute();
$leng_usu = $era->fetchAll();


?>
<table>
    <style>
        table{
            border: 1px solid;
        }
        tr  td{
            border: 1px solid;
        }
    </style>
    <tr>
        <th>id_usuario</th>
        <th>id_lenguaje</th>
    </tr>
    <?php
    foreach ($leng_usu as $key => $value){
    ?>
    <td>
        <?= $value['id_usuario']?>
    </td>
    <td>
        <?= $value['id_lenguaje']?>
    </td>
    <tr>
    <?php
    }
    ?> 
    </tr>
</table>
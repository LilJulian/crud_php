<?php

require('conexion.php');

$db = new Conexion();
$conexion = $db->getConexion();

$sql = "SELECT * FROM ciudades";
$bandera = $conexion->prepare($sql);
$bandera->execute();
$ciudades = $bandera->fetchAll();
?>

<form action="" method="post">
    <div>
        <label for="ciudad_id">Ciudad</label>
        <select name="ciudad_id" id="ciudad_id">
            <?php
            foreach ($ciudades as $key => $value) {
                ?>
                <option id="<?= $value['id_ciudad']?>">
                    <?= $value['nombre_ciudad']?>
                </option>
            <?php
            }
            ?>
        </select>
    </div>
</form>
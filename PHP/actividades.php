<?php
    require('../../includes/funciones.php');
    require('../../includes/sqlcommand.inc');

    $valor = $_GET['Id'];

    conectardb($almacen);
    $t = 'SELECT codigo_actividad, actividad FROM cat_actividad WHERE activo = 1 and codigo_programa = '. $valor;
    $response = $query($t);
    echo '<select class="form-control " style="width:20%;" name="cbo_actividad">';
    $nombre=":: Seleccione ::";
    echo'<option value="0">'.$nombre.'</option>';
    while($row = $fetch_array($response)){
        echo '<option value="'.$row["codigo_actividad"].'">'.utf8_encode($row["actividad"]).'--'.$row["codigo_actividad"].'</option>';
    }
    echo '</select>';
    $free_result($response);
?>
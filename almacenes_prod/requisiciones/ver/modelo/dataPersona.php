<?php 
    session_start();
    require_once('../../comandos/funciones.php');
    require_once('../../comandos/sqlcommand.inc');
    conectardb($almacen);

$listheader = "";

    $SQL = "USE rrhh SELECT 
                    (a.apellido +' '+ a.apellido2 +' '+ a.apellidocasada +', '+ a.nombre +' '+ a.nombre2 +' '+ a.nombre3) as empleado, 
                    a.activo, 
                    a.idasesor,
                    d.nombre AS dependencia
                FROM asesores a
                INNER JOIN direccion d ON a.iddireccion = d.iddireccion and d.iddireccion = 27
                where  a.activo = 1
    ";
    $requestDespacho = $query($SQL);
    while ($row = $fetch_array($requestDespacho)) {
        $seleccion = '<i  class=\"fas fa-hand-pointer iconSeleccion\"></i>';
        $listheader .= '{
            "CONTROL":"'. $seleccion .'",
            "EMPLEADO":"'. $row["empleado"].'"
        },';
    }

    $listheader = substr($listheader, 0, strlen($listheader) - 1);

    echo '{"data":[' . utf8_encode($listheader) . ']}';
?>
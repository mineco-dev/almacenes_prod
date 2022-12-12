<?php
    require('../includes/funciones.php');
    require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($almacen));	
	$dbms->bdd=$database_cnn;

    $fecha = get_formatofecha(date("d")."-".date("m")."-".date("Y"));
    $ver = $_GET['ver'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" 
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../datatable/css/jquery.dataTables.min.css">
</head>
<body>

<div class="container-fluid mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white text-end">
            Solicitudes al 
            <?php print($fecha); ?>
        </div>
        <div class="card-body">
            <?php 
                switch($ver) {
                    case 1:
                        print("<img src=\"imagenes/led_circle_green.png\"> Ingresadas");
                        include("ingresos.php");
                        break;
                    case 2:
                        print("<img src=\"imagenes/led_circle_red.png\"> Egresadas");
                        include("egresos.php");
                        break;
                    case 3:
                        print("<img src=\"imagenes/led_circle_red.png\"> Igresos Anulados");
                        include("ingresos_anulados.php");
                        break;
                }
            ?>
        </div>
    </div>
</div>
</body>
</html>
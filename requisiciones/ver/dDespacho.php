<?php 
    session_start();
    require_once("../comandos/inc_seguridad.inc");
    require_once("../comandos/funciones.php");
    require_once("../comandos/sqlcommand.inc");
    require_once("../comandos/controldb.inc");

    //conexion
    $dbms = new DBMS(conectardb($almacen));
    $dbms->bdd = $database_cnn;
    $id_Solicitud = $_REQUEST['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

    <!-- link de funciones jquery y css bootstrap -->
    <link rel="stylesheet" href="../../css/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="../../js/comandos.js"></script>
</head>
<body style="background:#f2f2f2">
<!-- modal de los empleados -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header text-white bg-primary">
            <h5 class="modal-title" id="exampleModalLabel">Búsqueda de Empleados</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div id="modalPersona"></div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
    </div>
    <div class="container">
        <form id="dataDespacho">
            <div class="card ">
                <div class="card-header text-white bg-primary">
                    Detalle de la Requisición
                </div>
                <div class="card-body">
                    <table id="dataDespachoHeader" class="table">
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </form>
    </div>
<script>
    obtenerDespacho('#dataDespachoHeader');
    obtenerPersonas('#modalPersona','#exampleModal');
    


</script>
</body>
</html>
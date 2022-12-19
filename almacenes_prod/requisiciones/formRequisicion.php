<?php 
    session_start();
    require_once("comandos/sqlcommand.inc");
    require_once("comandos/funciones.php");
    conectardb($almacen);

    $usuario_id = $_SESSION["user_id"]; 
    $grupo_id = $_SESSION["group_id"];
    $empresa = $_POST['cbo_tipo_empresa']; 



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
    <script src="../js/comandos.js"></script>
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
</head>
<body >



    <div class="container-fluid"> 

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        Modal body..
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

        <form id="ingresoRequisicion">
            <table class="table" style="border-collapse: separate;">
                <thead class="PanelRequi">
                    <tr>
                        <th>
                            <div class="headRequi">
                                <h4>INGRESO DE REQUISICIONES</h4>
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                           <div class="bodyRequi">
                                <table  class="table table-responsive" >
                                    <tbody>
                                        <tr >
                                            <td class="titleRequi">
                                                Solicitante:
                                            </td>
                                            <td class="componentes" >
                                                <a   
                                                    onclick="buscar=window.open('busca_persona.php?tipo=nombre&posi=0','Buscar','width=650,height=525,menubar=no,scrollbars=yes,toolbar=no,location=no,directories=no,resizable=no,top=100,left=250'); return false;">
                                                </a>
                                                <input data-toggle="modal" data-target="#myModal" class="form-control" type="text" name="nombre[0][0]" id="textfield3"  value="[CLIC AQUI PARA SELECCIONAR SOLICITANTE]">
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"> Open modal</button>
                                                <input id="nombre[0][2]" type="input" name="nombre[0][2]"  style="visibility: hidden;"/>
                                                <input type="input" id="nombre[0][1]"  name="nombre[0][1]"  style="visibility: hidden;"/>  
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                No. Requisición:
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Departamento:
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Jefe Departamento:
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Estatus:
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                Observaciones:
                                            </td>
                                            <td>
                                                
                                            </td>
                                        </tr>                                        
                                    </tbody>
                                </table>
                           </div> 
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>     
    </div>
</body>
</html>
<?php

require '../includes/cnn/inc_header_1.inc';
require '../includes/cnn/funciones.php';
$dbms = new DBMS(conectardb($almacen));
$dbms->bdd = $database_cnn;

$href = $_SERVER['HTTP_REFERER'];

$idsolicitud = $_REQUEST["id"];

$Fields = "select distinct d.rowid, d.codigo_producto, p.producto, c.categoria,  d.codigo_categoria, d.codigo_subcategoria, e.solicitante,
e.fecha_requisicion, dep.nombre, e.observaciones, e.codigo_estatus, es.estatus, d.codigo_empresa,
d.codigo_requisicion_enc, b.bodega, em.empresa, d.codigo_bodega, e.usuario_aprobo, e.codigo_dependencia, inv.existencia,inv.cantidad_comprometida as cantidad_comprometida,
d.cantidad_autorizada, d.cantidad_solicitada
, cm.unidad_medida
from tb_requisicion_det d
inner join tb_requisicion_enc e on
e.codigo_requisicion_enc = d.codigo_requisicion_enc
inner join cat_producto p on p.codigo_producto = d.codigo_producto and p.codigo_categoria = d.codigo_categoria and p.codigo_subcategoria = d.codigo_subcategoria
inner join cat_categoria c on d.codigo_categoria = c.codigo_categoria
inner join cat_bodega b on
b.codigo_bodega = d.codigo_bodega
inner join cat_empresa em on
d.codigo_empresa = em.codigo_empresa
inner join direccion dep
on dep.iddireccion = e.codigo_dependencia
inner join cat_estatus es on
e.codigo_estatus = es.codigo_estatus
inner join tb_inventario inv on
d.codigo_producto = inv.codigo_producto and d.codigo_categoria = inv.codigo_categoria and d.codigo_subcategoria = inv.codigo_subcategoria
and d.codigo_bodega = inv.codigo_bodega and d.codigo_empresa = inv.codigo_empresa
left join cat_medida cm on cm.codigo_medida = p.codigo_medida
where d.codigo_requisicion_enc = '$idsolicitud'";

/*echo "<hr>";
echo $Fields;
echo "<hr>";*/
$res_qry_producto = $query($Fields);
while ($row = $fetch_array($res_qry_producto)) {

    $codigo = $row["codigo_requisicion_enc"];
    $rowid = $row["rowid"];
    $producto = $row["producto"];
    $solicitante = utf8_encode($row["solicitante"]);
    $categoria = $row["categoria"];
    $estatus = $row["codigo_estatus"];
    $observaciones = utf8_encode($row["observaciones"]);
    $bodega = $row["bodega"];
    $dependencia = utf8_encode($row["nombre"]);
    $fecha = $row["fecha_requisicion"];
    $codigo_producto = $row["codigo_producto"];
    $cantidad_comprometida= $row["cantidad_comprometida"];
    $cantidad_comprometida= $row["cantidad_comprometida"];
    $unidad_medida = $row["unidad_medida"];
}

?>
<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>

	<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="../../bootstrap/css/bootstrap.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

  <link rel="stylesheet" href="../../css/custom.css">
<script src="../../js/comandos.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
  <script src="../../js/autorizacionTabla.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
</head>
<body>
<!-- <form name="form" method="post" action="gautorizar_producto3.php"> -->
<form id="DataAutoriza">
	  <div class="container">
      <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <div id="TabbedPanels1" class="TabbedPanels">
                  <ul class="TabbedPanelsTabGroup">
                    <li class="TabbedPanelsTab" tabindex="0"><strong>Detalles de la Requisicion</strong></li>
                  </ul>
                  <div class="TabbedPanelsContentGroup">
                      <div class="container table-responsive">
                        <table class="table informacion">

                          <tr>
                            <td class="DataLeft">Fecha</td>
                            <td class="DataResponse"><?print $fecha;?></td>
                            <td class="Correlativo"><div class="correlativo">Requisicion No:
                                                                     <span class="numero"> <?echo $codigo; ?></span> 
                                                                    <input name="location" id="location" value="<?php echo $href; ?>" type="hidden"/></div>
                            </td>
                          </tr>
                          <tr>
                            <td class="DataLeft">Solicitante</td>
                            <td class="DataResponse" colspan="2"><?print $solicitante;?></td>
                          </tr>
                          <tr>
                            <td class="DataLeft">Dependencia</td>
                            <td class="DataResponse" colspan="2"><?print $dependencia;?></td>
                          </tr>
                          <tr>
                            <td class="DataLeft">Observaciones</td>
                            <td class="DataResponse" colspan="2"><?print $observaciones;?></td>
                          </tr>
                          <tr>
                            <td colspan="3">
                                <div class="radio">
                                  <label class="radio-inline"><input  type="radio" name="optradio" value="1" checked>Autorizar</label>
                                  <label class="radio-inline"><input  type="radio" name="optradio" value="0" >Rechazar</label>
                                </div>
                            </td>
                          </tr>
                        </table>

                        <div align="center"></div>
                              <br>
                        <div class= "container">
                          <table id ="DataReport" class="table table-bordered table-hover" data-page-length="50" data-order="[[ 1, &quot;asc&quot; ]]">
                                <thead class="thead-dark" >
                                    <tr>
                                      <th>No. Req</th>
                                      <th>Producto</th>
                                      <th>U. Medida</th>
                                      
                                      <th>Codigo</th>
                                      <th>Cantidad Solicitada</th>
                                      <th>Cantidad Autorizada</th>
                                      <th>Cantidad Comprometida</th>
                                      <th>Existencias</th>
                                      <!-- <th>Comprometidas</th> -->
                                      <!-- <th>Chequeo</th> -->
                                    </tr>
                                </thead>
                          </table>
                        </div>
                        <input  name="nRequi"  value='<?php echo $codigo ?>' type="hidden" size="3" id="nRequi"/>
                      </div>
                  </div>
                </div>
            </td>
        </tr>
        <tr>
          <td colspan="2">

              <button type="submit" id="enviar" name="bt_actualizar" class="btn boton grey  btn-primary">Enviar Requisicion</button>


          </td>
        </tr>
      </table>
    </div>
</form>
<script>
$(document).ready(function () {
    ValidarAutorizacion("#DataAutoriza",'modelo/autorizarRequisicion.php',"#location");
  })
</script>
</body>
</html>

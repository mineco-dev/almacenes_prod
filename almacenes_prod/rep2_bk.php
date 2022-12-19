<?php
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<html>
<head>

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "")
  { 
      alert("Puede buscar por nombre, apellido, extensión o dependencia"); 
    form.txt_buscar.focus(); 
    return;
  }  
function Refrescar(form)
{
    form.reset();
    form.txt_buscar.focus(); 
}
form.submit();
}
</script>
<link href="css/helpdesk.css" rel="stylesheet" type="text/css">
<link href="css/box_ie.css" rel="stylesheet" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo14 {font-size: 6px;  font-family: Arial, Helvetica, sans-serif;}
.Estilo15 {font-size: 10px;  font-family: Arial, Helvetica, sans-serif;}

-->
</style>
<style>
    
th { white-space: nowrap; }
</style>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<!-- <link rel="stylesheet" type="text/css" href="datatable/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="datatable/css/dataTables.responsive.min.js">


<script type="text/javascript" language="javascript" src="datatable/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="datatable/js/dataTables.responsive.min.js"></script>
 -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/af-2.2.0/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fc-3.2.2/fh-3.1.2/kt-2.2.1/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.7/jq-2.2.4/jszip-3.1.3/pdfmake-0.1.27/dt-1.10.15/af-2.2.0/b-1.3.1/b-colvis-1.3.1/b-flash-1.3.1/b-html5-1.3.1/b-print-1.3.1/cr-1.3.3/fc-3.2.2/fh-3.1.2/kt-2.2.1/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<style>


#dt {
    font-size: small;
    font-style: normal;
    color: -internal-quirk-inherit;
    text-align: start;
     border: 1px solid black;
}

#dt th {    
     border: 2px solid black;
    background-color:     #cde;
    text-align: center;
}#dt td {    
       text-align: ceter;
    font-size: 80%;
    font-family: Arial, Helvetica, sans-serif;
    padding: 0px 5px 0px;
     border: 1px solid gray;
}





</style>
</head>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div align="left" class="boxBgWhite45">

 <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td><div align="center">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="20%"></td>
              <!--<td width="72%"><div align="center" class="legal1">Tarjeta de Kardex de Almacen Compra General</div></td>-->
              
              <!--<td width="15%"><div align="center"><img src="mineco.JPG" width="107" height="113"></div></td>-->
            </tr>
            <tr>
              <td colspan="3">Codigo Articulo
              <?PHP
// fecha inicial
if (isset($_POST['cboDiai'])) {
    $cboDiai = $_POST['cboDiai'];
}
if (isset($_POST['cboMesi'])) {
    $cboMesi = $_POST['cboMesi'];
}
if (isset($_POST['cboAnioi'])) {
    $cboAnioi = $_POST['cboAnioi'];
}
// fechafnal
if (isset($_POST['cboDiaf'])) {
    $cboDiaf = $_POST['cboDiaf'];
}
if (isset($_POST['cboMesf'])) {
    $cboMesf = $_POST['cboMesf'];
}
if (isset($_POST['cboAniof'])) {
    $cboAniof = $_POST['cboAniof'];
}
//echo 'el dato: '. $_POST["select1"] . "<br>";

if ($cboMesi < 10) {
    $cboMesi = '0' . $cboMesi;
}

if ($cboMesf < 10) {
    $cboMesf = '0' . $cboMesf;
}

if ($cboDiai < 10) {
    $cboDiai = '0' . $cboDiai;
}

if ($cboDiaf < 10) {
    $cboDiaf = '0' . $cboDiaf;
}



$fecha1     = $cboDiai . '/' . $cboMesi . '/' . $cboAnioi;
$fecha2     = $cboDiaf . '/' . $cboMesf . '/' . $cboAniof;
$fechahora1 = $cboAnioi . '-' . $cboMesi . '-' . $cboDiai . ' 00:00:00';
$fechahora2 = $cboAniof . '-' . $cboMesf . '-' . $cboDiaf . ' 24:59:59';
$fecha1h    = $fecha1 . ' 00:00:00';
$fecha2h    = $fecha2 . ' 24:59:59';
//echo 'Reporte del '.$cboDiai.'/'.$cboMesi.'/'.$cboAnioi.' al '.$cboDiaf.'/'.$cboMesf.'/'.$cboAniof;


$categoria    = $_POST["select1"];
$subcategoria = $_POST["select2"];
$producto     = $_POST["select3"];
print($categoria);
echo ' - ';
print($subcategoria);
echo ' - ';
print($producto);

?></td>
              <td>&nbsp;</td>
            </tr>
          </table>
          </div></td>
      </tr>
  </table>
      <td width="9%"><span class="Estilo14"></span><strong></strong></td>

<!--<table width="100%" border="0" cellspacing="0" cellpadding="0">

      <td width="6%" height="22"><span class="Estilo14"></span><strong></strong></td> 
       <td width="9%"><span class="legal10">          </span><strong></strong></td>
        <td width="6%" height="2"><span class="Estilo10">Saldo Inicial:
        <input type="text" size="2"></span><strong></strong></td>
  </table>-->
  <p></p>    

<table id="dt" class="table table-striped table-hover" cellspacing="0" width="10%">
    <thead>
    <tr>
    <td style="border: 0px solid; border-color: #00FF00;" colspan="4"></td>
    <td style="border: 3px solid; border-color: #000000;" colspan="3"><center>UNIDADES</center></td>
    <td style="border: 0px solid; border-color: #00FF00;" colspan="4"> <center>    SALDO INICIAL     <input type="NUMBER" size="6"> </center></</td>
    </tr>
    <tr >
              <th>Fecha</th>
          <th>Tipo Mov.</th>
      <th>No. Desp.</th>
      <th>No. Ingre</th>
      <th>Entrada</th>
      <th>Salida</th>
       <th>Saldo</th>
          <th>Promedio</th>
          <th>Factura</th>
          <th>Mov</th>
          <th>Ext</th>
      <th>Proveedor/Dependencia</th>
 </tr>
 <!--<tr>
    <td colspan="5">VIENEN DE LA TARJETA NO. <input type="number" align="center"/></td>
    <td></td>
    <td></td>
    <td></td>
    <td ><center></center></td>
    <td></td>
    <td></td>
    <td></td>
    
    </tr>-->
      </thead>
      <tbody>
<?



/*$query = "select CONVERT(nvarchar(10), t.fechahora, 103) as fecha,
CONVERT(nvarchar(10), t.fechahora, 108) as hora, 
t.nombre as solicitante,
t.pregunta,t.idsolicitud,t.telefono,p.pais                        
from
tbl_solicitud t, tbl_pais p
where 
year(t.fechahora) >= '$cboAnioi' and month(t.fechahora) >= '$cboMesi' and day(t.fechahora) >= '$cboDiai'
and year(t.fechahora) <= '$cboAniof' and month(t.fechahora) <= '$cboMesf' and day(t.fechahora) <= '$cboDiaf'
and t.idpais = p.idpais 
order by t.fechahora desc";*/



/*
$query = "select CONVERT(nvarchar(10), t.fechahora, 103) as fecha,
CONVERT(nvarchar(10), t.fechahora, 108) as hora, 
t.nombre as solicitante,
t.pregunta,t.idsolicitud,t.telefono,p.pais

from
tbl_solicitud t, tbl_pais p
where 
fechahora >= '$fecha1h' and fechahora <= '$fecha2h' and t.idpais = p.idpais 
order by fechahora desc";*/
conectardb($almacen);
//echo 'el request: '. $_REQUEST["select1"];

if ($_REQUEST["select1"] != "0") {
    ////session_register("categoria");
    $_SESSION["categoria"] = $_REQUEST["select1"]; //para un reporte por categoria        
    
    if ($_REQUEST["select2"] != "0") {
        ////session_register("subcategoria");
        $_SESSION["subcategoria"] = $_REQUEST["select2"]; //para un reporte por subcategoria
        
        if ($_REQUEST["select3"] != "0") {
            ////session_register("producto");
            $_SESSION["producto"] = $_REQUEST["select3"]; //para un reporte por producto
        } //fin producto
    } //fin subcat
} //fin de evaluacion de categoria    

if (isset($_SESSION["categoria"])) {
    $prodcuto     = $_SESSION["producto"];
    //$prodcuto=1;
    $categoria    = $_SESSION["categoria"];
    $subcategoria = $_SESSION["subcategoria"];
    
    //print($prodcuto);
    //print($categoria);
    //print($subcategoria);
    
    conectardb($almacen);
    
    $query = "-- use almacen_nuevo_qa 
		use almacen_nuevo_qa
		select CONVERT(nvarchar(10), k.fecha, 103) as fecha,
		CONVERT(nvarchar(10), k.fecha, 108) as hora,
		m.tipo_movimiento,
		k.no_despacho, 
		k.no_ingreso, 
		k.entrada,
		k.salida, 
		k.saldo, 
		k.costo_promedio, 
		k.costo_factura, 
		costo_movimiento,
		costo_total, 
		d.nombre
		from tb_kardex k
		inner join cat_tipo_movimiento m
		on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
		inner join direccion d
		on k.id_dependencia = d.iddireccion
			where 
			CONVERT(varchar(20), k.fecha, 120) >= '" . $fechahora1 . "' and CONVERT(varchar(20), k.fecha, 120) <= '" . $fechahora2 . "' 
		and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = " . $_SESSION["empresax"] . " and codigo_bodega = " . $_SESSION["bodega15"] . "
		order by codigo_kardex asc";
    
    
    //echo $query;
    
    
    // $consulta=mssql_query("select producto, mit.unidad_medida from dbo.cat_producto as pro inner join cat_medida as mit on mit.codigo_medida=pro.codigo_medida  
    //where codigo_producto = $producto and codigo_categoria = $categoria and codigo_subcategoria = $subcategoria and  pro.activo = 1");
    
    $consulta = mssql_query("select producto, mit.unidad_medida from dbo.cat_producto as pro inner join cat_medida as mit on mit.codigo_medida=pro.codigo_medida  where codigo_producto = $producto and codigo_categoria = $categoria and codigo_subcategoria = $subcategoria and  pro.activo = 1");
    
    while ($registro = mssql_fetch_row($consulta)) {
        echo "<center>  Articulo: " .  utf8_encode($registro['0']) . " - " . utf8_encode($registro['1']) . " </center>";
    }
    
    
    
    
    //print($query);
    
}




$do  = mssql_query($query);
$gt  = 0;
$i   = 0;
$tmp = 0;
$k   = array();



while ($vector = mssql_fetch_row($do)) {
    $err      = 0;
    $cantidad = $vector[7] * $vector[8];
    
    include("css/format_table.php");
    if ($i == 0) {
        echo '<tr style="background-color:#EBEBEB"><td >VIENEN A LA TARJETA</td><td height="5"><input type="number"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"> </td><td height="5"></td><td height="5"></td><td height="5"></td></tr>';
    }
    
    echo '<tr style="height:15px;"><td >' .  utf8_encode($vector[0]) . '</td><td>' .  utf8_encode($vector[2]) . '</td><td>' .  utf8_encode($vector[3]) . '</td><td>' .  utf8_encode($vector[4]) . '</td><td>' .  utf8_encode($vector[5]) . '</td><td>' .  utf8_encode($vector[6]) . '</td><td>' .  utf8_encode($vector[7]) . '</td><td> Q' .  utf8_encode($vector[8]) . '</td><td>' .  utf8_encode($vector[9]) . '</td><td> Q' .  utf8_encode($vector[10]) . '</td><td> Q' . $cantidad . '</td><td>' .  utf8_encode($vector[12]) . '</td></tr>';
    
    echo "";
    /*
    el formato para la impresion de tarjetas kardex mustra 36 registros segun mandanto, 
    para la impresion del van y vienen hacermos un flojo de control if donde espesificamos el total de registros y le extraemos el resto cuando sea dibisible en 36
    nos dara un resto de 0 al cumplir la condicion mandamos a impresion EL VAN con un input para el ingreso del numero correlativo de la tarjeta.
    Kevin Emilio de Paz Hernandez.
    */
    if (($i + 1) % 36 == 0) {
        
        //echo $k[$i]=$vector;
        //
        
        echo '<tr style="background-color:#EBEBEB"><td >VAN A LA TARJETA</td><td height="5"><input type="number"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5">' . $vector[7] . '</td><td height="5"> Q' . $vector[8] . '</td><td height="5"></td><td height="5"> </td><td height="5"> Q' . /*$cantidad*/ $cantidad . '</td><td height="5"></td></tr>';
        //echo  '<tr style="border-bottom:0pt solid black;"><td >VIENEN A LA tarjeta</td><td height="5"><input type="number"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5">'.$vector[7].'</td><td height="5"> Q'.$vector[8].'</td><td height="5"></td><td height="5"> Q'.$vector[10].'</td><td height="5"> Q'./*$cantidad*/$vector[11].'</td><td height="5">'.$vector[12].'</td></tr>';                                                    
        echo '<tr style="background-color:#EBEBEB"><td >VIENEN A LA TARJETA</td><td height="5"><input type="number"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5">' . $vector[7] . '</td><td height="5">Q' . $vector[8] . '</td><td height="5"> </td><td height="5"></td><td height="5">Q' . /*$cantidad*/ $cantidad . '</td><td height="5"></td></tr>';
    }
    
    
    $tmp = '<tr style="background-color:#EBEBEB"><td >VAN A LA TARJETA</td><td height="5"><input type="number"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5">' . $vector[7] . '</td><td height="5"> Q' . $vector[8] . '</td><td height="5"></td><td height="5"> </td><td height="5"> Q' . /*$cantidad*/ $cantidad . '</td><td height="5"></td></tr>';
    $i++;
    
    
}
echo $tmp;
mssql_free_result($do);
?>
       </tbody>
    
  </table>


</div>

<br />
            <div align="left"></div>
            <!--Con este script espesificamos que caracteristicas necesitamos del data table-->
            <script>

  $(document).ready(function() {
        $('#dt').DataTable( {
        
        "pagingType": "simple",
        "searching": false,
         "ordering": false,
         "lengthChange": false,
        "autoWidth": false,
         "pageLength": 38,
          "responsive": true,
          "language": {
            "url": "datatable/json/Spanish.json"
            
        }
} );
    





    
    
} );

</script>

            
</body>

</html>
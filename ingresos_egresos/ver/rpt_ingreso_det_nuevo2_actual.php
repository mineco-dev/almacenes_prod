<?PHP
require ("../../../includes/funciones.php");
require ("../../../includes/sqlcommand.inc");
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
	span.det {
		font-weight: bold;
		font-size: 7px;
	}
	span.obs {
		font-weight: bold;
		font-size: 7px;
	}
	span.blue {
		font-size: 8px;
	}
	span.enc {
		font-size: 10px;
	}
	span.red {
		font-weight: bold;
		font-size: 7px;
	}
	span.green {
		color: darkolivegreen;
		font-weight: bold
	}
</style>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 50px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style2 {font-size: 8px}
-->
</style></head>

<body>
<table width="807px" height="1015" border="0" cellpadding="0" cellspacing="0">
 <?PHP
$hoja_ingreso = $_SESSION["hoja_ingreso"];
//$existe=false;
$qry_ingreso_enc = "select no_ingreso,CONVERT(nvarchar(10), e.fecha_ingreso, 103) as fecha_ingreso, 
			CONVERT(nvarchar(10), e.fecha_documento, 103) as fecha_documento,  e.numero_serie, convert(nvarchar(10), e.fecha_recepcion, 103) as fecha_recepcion,
			e.observaciones, p.programa, a.actividad,
e.codigo_ingreso_enc, e.solicitante, e.numero_documento, pro.nombre as proveedor, d.nombre as dependencia
			from tb_ingreso_enc e  
inner join cat_programa p
on e.codigo_programa = p.codigo_programa and p.activo=1
inner join cat_actividad a
on e.codigo_actividad = a.codigo_actividad and a.codigo_programa = p.codigo_programa and a.activo=1
inner join tb_proveedor pro on
e.codigo_proveedor = pro.rowid
inner join direccion d on
e.codigo_dependencia =d.iddireccion 
where codigo_ingreso_enc ='$hoja_ingreso'";
//print($qry_ingreso_enc);
conectardb($almacen);
$res_ingreso_enc = $query($qry_ingreso_enc);
while ($row_ingreso_enc = $fetch_array($res_ingreso_enc)) {
	$no_ingreso = $row_ingreso_enc["no_ingreso"];
	$fecha_factura = $row_ingreso_enc["fecha_documento"];
	$observaciones = $row_ingreso_enc["observaciones"];
	$codigo_ingreso_enc = $row_ingreso_enc["codigo_ingreso_enc"];
	$solicitante = $row_ingreso_enc["solicitante"];
	$programa = $row_ingreso_enc["programa"];
	$dependencia = $row_ingreso_enc["dependencia"];
	$actividad = $row_ingreso_enc["actividad"];
	$proveedor = $row_ingreso_enc["proveedor"];
	$noserie = $row_ingreso_enc["numero_serie"];
	$nofactura = $row_ingreso_enc["numero_documento"];
	$fecha = $row_ingreso_enc["fecha_ingreso"];
	$fecha_recepcion = $row_ingreso_enc["fecha_recepcion"];
	//$existe=true;
}
//$free_result($res_ingreso_enc);
//if ($existe==true)
//{
		?> 
        
  
  <tr>
    <td height="30" valign="top">
    <table width="807px" border="0">
      
      <tr>
        <td height="30">&nbsp;</td>
        <td width="275"><span class="red"><?PHP echo $dependencia; ?></span></td>
        <td width="147"></td>
        <td width="115"><span class="enc"> FACTURA </span></td>
        <td width="155"><span class="blue"><?PHP echo $noserie; ?>&nbsp;-&nbsp;<?PHP echo $nofactura; ?></span></td>
      </tr>
      <tr>
        <td height="22">&nbsp;</td>
        <td width="250"><span class="red"><?PHP echo $programa; ?></span></td>
		<td colspan="2" ><span class="enc">FECHA INGRESO: <?PHP echo substr($fecha_recepcion, 0, 12); ?></span></td>
		<td width="150"><span class="enc">FACTURA: <?PHP echo substr($fecha_factura, 0, 12); ?></span></td>
      </tr>
      <tr>
        <td width="103" height="30">&nbsp;</td>
        <td><span class="red"><?PHP echo $proveedor; ?></span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="750px" valign="top"><table width="807px" border="0" cellspacing="1" cellpadding="1">
         
      <tr> 
        <td width="54" align="right"></td>
        <td width="291"><span class="style2"></span></td>
        <td width="104">&nbsp;</td>
        <td width="79"><div align="left"></div></td>
        <td width="76"><div align="left"></div></td>
        <td width="132">&nbsp;</td>
        <td width="49">&nbsp;</td>
      </tr>
      
       <?PHP
		$qry_ingreso_det = "select d.codigo_ingreso_enc, (p.producto +' '+ p.marca +' '+ m.unidad_medida) as descripcion, d.cantidad_ingresada, d.codigo_producto, d.codigo_categoria, d.codigo_subcategoria, e.nomenclatura_cuentas, e.folio_libro, e.observaciones,
 d.codigo_renglon, d.costo_unidad, d.Precio_total
from tb_ingreso_enc e
inner join tb_ingreso_det d 
on e.codigo_ingreso_enc = d.codigo_ingreso_enc
inner join cat_producto p
on p.codigo_producto = d.codigo_producto and p.codigo_categoria = d.codigo_categoria and p.codigo_subcategoria = d.codigo_subcategoria
inner join cat_medida m
on p.codigo_medida = m.codigo_medida
where d.codigo_ingreso_enc = $codigo_ingreso_enc";
		conectardb($almacen);
		$res_ingreso_det = $query($qry_ingreso_det);
		while ($row_ingreso_det = $fetch_array($res_ingreso_det)) {
			//$operador=$row_ingreso_det["usuario_creo"];
			//$operado=$row_ingreso_det["fecha_creado"];
			//$cantidad=$row_ingreso_det["cantidad_ingresada"];
			//$descripcion=$row_ingreso_det["descripcion"];
			//$renglon=$row_ingreso_det["codigo_renglon"];
			//$costo=$row_ingreso_det["costo_unidad"];
			//$precio=$row_ingreso_det["Precio_total"];

			//$free_result($res_ingreso_det);
			echo '<tr><td align ="center"><span class="det">' . $row_ingreso_det["cantidad_ingresada"] . '</span></td>';
			echo '<td >&nbsp;<span class="blue">&nbsp;&nbsp;&nbsp;&nbsp;' . $row_ingreso_det["codigo_categoria"] . ' ' . $row_ingreso_det["codigo_subcategoria"] . ' ' . $row_ingreso_det["codigo_producto"] . '-' . $row_ingreso_det["descripcion"] . '</span></td>';
			echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="det">' . $row_ingreso_det["codigo_renglon"] . '</span></td>';
			echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;<span class="det">' . $row_ingreso_det[""] . '</span></td>';
			echo '<td>&nbsp;&nbsp;<span class="det">Q ' . number_format($row_ingreso_det["costo_unidad"], 2) . '</span></td>';
			echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;<span class="det">Q ' . number_format($row_ingreso_det["Precio_total"], 2) . '</span></td>';
			echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="det">' . $row_ingreso_det[""] . '</span></td>';
			echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="det">' . $row_ingreso_det[""] . '</span></td></tr>';

		}
		$free_result($res_ingreso_det);
     ?>
   <?PHP
$qry_total = "select sum(Precio_total) as total from tb_ingreso_det
where codigo_ingreso_enc = $codigo_ingreso_enc";

$res_ingreso_enc = $query($qry_total);
while ($row_ingreso_enc = $fetch_array($res_ingreso_enc)) {

	$total = number_format($row_ingreso_enc["total"], 2);
	//$existe=true;

}
   ?>
      <tr> 
        
        <td width="54" align="right">&nbsp;</td>
        <td width="291"><span class="style2"></span></td>
        <td width="104">&nbsp;</td>
        <td width="79"><div align="left"></div></td>
        <td width="76"><div align="left"></div></td>
        <td width="132">&nbsp;</td>
        <td width="49">&nbsp;</td>
      </tr>
    <tr> 
        
        <td width="54" align="right">&nbsp;</td>
        <td width="291"><span class="style2"></span></td>
        <td width="104">&nbsp;</td>
        <td width="79"><div align="left"></div></td>
        <td width="76"><span class="det">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total</span></td>
        <td width="132"><span class="det">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Q <?PHP echo $total; ?></span></td>
        <td width="49">&nbsp;</td>
      </tr>
   
   <tr> 
        
        <td width="54">&nbsp;</td>
        <td width="291" align="justify">&nbsp;<span class="obs"><?PHP echo $observaciones; ?></span></td>
        <td width="104">&nbsp;</td>
        <td width="79"><div align="left"></div></td>
        <td width="76"><div align="left"></div></td>
        <td width="132">&nbsp;</td>
        <td width="49">&nbsp;</td>
      </tr>
   
    </table>
   </td>
  </tr>
  
  
 
</table>
</body>
</html>

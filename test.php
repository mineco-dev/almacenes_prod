<?		
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo5 {font-size: 16px; font-weight: bold; font-family: "Times New Roman", Times, serif; }
-->
</style>
</head>
<body>
<h1 align="center">l&nbsp;&nbsp;&nbsp;&nbsp;Informe de Consumo por Dependencia</h1>
<p align="center">&nbsp;&nbsp;&nbsp;&nbsp;Ministerio de Econom&iacute;a, Guatemala, C.A.  </p>

<p>&nbsp;</p>
<table width="1192" border="1" bordercolor="#FFFFFF">
  <tr>
    <td width="12" bordercolor="#FFFFFF"><span class="Estilo5">id</span></td>
    <td width="228" bordercolor="#FFFFFF"><div align="center" class="Estilo5">Departamento / Dependencia </div></td>
    <td width="80" bordercolor="#FFFFFF"><div align="center" class="Estilo5">requisici&oacute;n</div></td>
   <td width="68" bordercolor="#FFFFFF"><div align="center" class="Estilo5">categor&iacute;a</div></td>
    <td width="95" bordercolor="#FFFFFF"><div align="center" class="Estilo5">subcategor&iacute;a</div></td>
    <td width="64" bordercolor="#FFFFFF"><div align="center" class="Estilo5">producto</div></td>
	<td width="284" bordercolor="#FFFFFF"><div align="center" class="Estilo5">descripci&oacute;n</div></td>
    <td width="64" bordercolor="#FFFFFF"><div align="center" class="Estilo5">cantidad</div></td>
    <td width="115" bordercolor="#FFFFFF"><div align="center" class="Estilo5">fecha</div></td>
    <td width="118" bordercolor="#FFFFFF"><div align="center" class="Estilo5">bodega</div></td>
  </tr>
  <tr>
    <td colspan="9"><div align="left">
  <?PHP 
//variables para conexión de base de datos
$serv ='server_appl';
$usr ='sa';
$pwd ='Sup3rus3r2009';
$bd ='almacen';
//ini_set('mssql.charset', 'UTF-8');			  
mssql_connect($serv,$usr,$pwd);
mssql_select_db($bd);

 if ($cboMesi < 10)
			  {
			  	$cboMesi = '0'.$cboMesi;
			  }

			  if ($cboMesf < 10)
			  {
			  	$cboMesf = '0'.$cboMesf;
			  }

			  if ($cboDiai < 10)
			  {
			  	$cboDiai = '0'.$cboDiai;
			  }

			  if ($cboDiaf < 10)
			  {
			  	$cboDiaf = '0'.$cboDiaf;
			  }
			  
			  	$fecha1 = $cboDiai.'/'.$cboMesi.'/'.$cboAnioi;
				$fecha2 = $cboDiaf.'/'.$cboMesf.'/'.$cboAniof;
				$fechahora1 = $cboAnioi.'-'.$cboMesi.'-'.$cboDiai.' 00:00:00';
				$fechahora2 = $cboAniof.'-'.$cboMesf.'-'.$cboDiaf.' 24:59:59';								
				$fecha1h = $fecha1.' 00:00:00';
				$fecha2h = $fecha2.' 24:59:59';		
				
$resultado=mssql_query("select d.iddireccion, 
d.nombre, 
k.no_requisicion,
k.codigo_categoria,
k.codigo_subcategoria,
k.codigo_producto, 
p.producto, 
k.cantidad,
convert (varchar (20),k.fecha, 120) as fecha,
b.bodega
from direccion d, tb_kardex k, cat_bodega b, cat_producto p
where
CONVERT(varchar(20), k.fecha, 120) >= '".$fechahora1."' and CONVERT(varchar(20), k.fecha, 120) <= '".$fechahora2."' 
and
k.activo = 1
and
k.codigo_tipo_movimiento = 2
and
(k.id_dependencia = d.iddireccion)
and
k.codigo_bodega =b.codigo_bodega
and
k.codigo_categoria = p.codigo_categoria
and
k.codigo_subcategoria = p.codigo_subcategoria
and
k.codigo_producto = p.codigo_producto");

while($fila=mssql_fetch_array($resultado)){
echo'<tr>';
echo '<td align="center">'.$fila['iddireccion'].'</td>';
echo '<td align="center">'.$fila['nombre'].'</td>';
echo '<td align="center">'.$fila['no_requisicion'].'</td>';
echo '<td align="center">'.$fila['codigo_categoria'].'</td>';
echo '<td align="center">'.$fila['codigo_subcategoria'].'</td>';
echo '<td align="center">'.$fila['codigo_producto'].'</td>';
echo '<td align="center">'.$fila['producto'].'</td>';
echo '<td align="center">'.$fila['cantidad'].'</td>';
echo '<td align="center">'.$fila['fecha'].'</td>';
echo'<td align="center">'.$fila['bodega'].'</td>';
echo '</tr>';
}


echo'Reporte del:'.$cboDiai.'/'.$cboMesi.'/'.$cboAnioi.' Al:'.$cboDiaf.'/'.$cboMesf.'/'.$cboAniof;

mssql_free_result($resultado);
?>
    </div></td>
  </tr>
</table>

<p>&nbsp;</p>
</body>
</html>

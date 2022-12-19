<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">  <!--iso-8859-1 para caracacteres latinoamericanos como la � | �-->
<META HTTP-EQUIV="REFRESH" CONTENT="100;URL=paginar2012.php">


<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>

<?PHP
require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
require('conexion.php'); //contiene los datos de conexion a la base de datos
if ($_REQUEST["select1"]!="0")
	{
		//session_register("categoria");
		$_SESSION["categoria"]=$_REQUEST["select1"];  //para un reporte por categoria		
		
		if ($_REQUEST["select2"]!="0")
		{
			//session_register("subcategoria");
			$_SESSION["subcategoria"]=$_REQUEST["select2"];  //para un reporte por subcategoria
			
			if ($_REQUEST["select3"]!="0")
			{
				//session_register("producto");
				$_SESSION["producto"]=$_REQUEST["select3"];  //para un reporte por producto
			}	//fin producto
		}		//fin subcat
	} //fin de evaluacion de categoria	
	
 if (isset($_SESSION["categoria"]))
				 {	//inicio de if			
					$producto=$_SESSION["producto"];	
					$categoria=$_SESSION["categoria"];	
					$subcategoria=$_SESSION["subcategoria"];

	//obtener el nombre del producto
	$Fields="use almacen_nuevo_qa 
		select producto
			 from cat_producto
				where 
 					codigo_producto ='$producto' 
					and codigo_categoria = '$categoria'
					and codigo_subcategoria = '$subcategoria'";
			$res_qry_producto=$query($Fields);
		
		while($row=$fetch_array($res_qry_producto))
		{				
			$nombre_producto=$row["producto"];
			
		}
	
	?>
  
<?PHP 	
	//obtener el saldo inicial del producto
	$Fields2="use almacen_nuevo_qa select 
saldo
from tb_kardex
where 
codigo_kardex in(select min(codigo_kardex) from tb_kardex where codigo_categoria = '$categoria' 
and codigo_subcategoria = '$subcategoria' 
and codigo_producto='$producto'
and codigo_bodega = 8 
and codigo_tipo_movimiento = 1)";
	
		$res_qry_producto=$query($Fields2);
	
		while($row=$fetch_array($res_qry_producto)) 
		{			
			$saldo=$row["saldo"];
		}
		
		//obtener las observaciones INVENTARIO INICIAL SEGUN ACTA No. 38-2010, DE FECHA 12/11/2010 DE UDAI
		$Fields3="use almacen_nuevo_qa 
		select observaciones
		from tb_kardex
				where 
 					codigo_producto ='$producto' 
					and codigo_categoria = '$categoria'
					and codigo_subcategoria = '$subcategoria'
					and codigo_bodega = 8";
		
		$res_qry_producto=$query($Fields3);
		while($row=$fetch_array($res_qry_producto)) 
		{				
			$observaciones=$row["observaciones"];
		}
		
		// validacion de formato para fecha
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
		
		
		?> 
l
<?php

if ($_REQUEST["select1"]!="0")
	{
		//session_register("categoria");
		$_SESSION["categoria"]=$_REQUEST["select1"];  //para un reporte por categoria		
		
		if ($_REQUEST["select2"]!="0")
		{
			//session_register("subcategoria");
			$_SESSION["subcategoria"]=$_REQUEST["select2"];  //para un reporte por subcategoria
			
			if ($_REQUEST["select3"]!="0")
			{
				//session_register("producto");
				$_SESSION["producto"]=$_REQUEST["select3"];  //para un reporte por producto
			}	//fin producto
		}		//fin subcat
	} //fin de evaluacion de categoria	
	
 if (isset($_SESSION["categoria"]))
				 {	//inicio de if			
					$producto=$_SESSION["producto"];	
					$categoria=$_SESSION["categoria"];	
					$subcategoria=$_SESSION["subcategoria"];

$por_pagina="1500";
$query = "use almacen_nuevo_qa 
select CONVERT(nvarchar(20), k.fecha, 103) as fecha,
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
	CONVERT(varchar(20), k.fecha, 120) >= '".$fechahora1."' and CONVERT(varchar(20), k.fecha, 120) <= '".$fechahora2."' 
 and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = ".$_SESSION["empresax"]." and codigo_bodega = 8 and k.activo=1
 order by codigo_kardex asc";
 }//fin de if
 $result = mssql_query( $query ); 
 }//fin de if
 ?>


<table width=1045 border=0 cellspacing=1 cellpadding=1 align="center">
   
   <tr>
   <td width ="195"  aling="center"><pre>&nbsp;</pre></td>
    <td width ="39"  aling="center"><pre>&nbsp;</pre></td>
    <td width ="114"  aling="center"><pre>&nbsp;</pre></td>
    <td width ="412"  aling="center"><pre>&nbsp;</pre></td>
    <td width ="66"  aling="center"><pre>&nbsp;</pre></td>
    <td width ="118"  aling="center"><pre>&nbsp;</pre></td>
   </tr>
   
      
   <tr>
    <td width="195"  align="right" style="font-weight:bold;font-size:10px; font-family: arial;">
	  <pre style="font-weight:bold;font-size:7px; font-family: arial;"><?PHP	print($categoria. ' - ');print($subcategoria. ' - ');print($producto. '');?>
	  </pre></td>
	<td width ="39"  aling="center"><pre>&nbsp;</pre></td>
	<td width ="114"  aling="center"><pre>&nbsp;</pre></td>
	<td width="412" align="left" style="font-weight:bold;font-size:7px; font-family: arial;"><pre style="font-weight:bold;font-size:7px; font-family: arial;"><?PHP echo $nombre_producto;?></pre></td> 
	<!-- imprime nombre de producto-->
	<td width ="66"  aling="center"><pre>&nbsp;</pre></td>
	<td width ="118"  aling="center"><pre>&nbsp;</pre></td>
	<td width= "79" aling="right" align="left" style="font-weight:bold;font-size:7px; font-family: arial;"><pre><?PHP print($saldo);?> </pre></td>
	<!--imprime saldo inicial del producto-->
  </tr>
    <tr>
	<td width ="195" height="21"  aling="center"><p style="font-weight:bold;font-size:8px; font-family: arial;"><?PHP print($observaciones);?></p></td>
    <td width ="39"  aling="center"><p>&nbsp;</p></td>
    <td width ="114"  aling="center"><p>&nbsp;</p></td>
    <td width ="412"  aling="center"><p>&nbsp;</p></td>
    <td width ="66"  aling="center"><p>&nbsp;</p></td>
    <td width ="118"  aling="center"><p>&nbsp;</p></td>
    <td width= "79" height="21" aling="right" style="font-weight:bold;font-size:10px; font-family: arial;"><p>
      <?PHP
	//inicio de paginación
$total = mssql_num_rows($result);
if(!$HTTP_GET_VARS['pag']){
$num_pag = 1;
$begin = 0;
$fin = $por_pagina;
}else{
if(is_numeric($_GET['pag'])){
$num_pag = $_GET['pag'];
$begin = $num_pag*$por_pagina+1;
$fin = $begin + $por_pagina-1;//se resta 1 para que no repita registros en la siguiente p�gina
}else{
$num_pag = 1;
$begin = 0;
$fin = $por_pagina;
}
}
$p = 0;
//fin de paginación 
//validaciones para opciones de navegación
$pagina=$_GET['pag'];//+ "<a href="paginar2012.php"</a>;"
$new=$pagina+1;
$menos=$pagina-1;
///pagina 1 de n
$npag=ceil($total/$por_pagina);//ceil()redondea el # de pags a un entero

if($pagina == 0) {
echo "<center><a href='$_SERVER[$query]?pag=$new>' >> </a></center>";
//echo "<center><a href='paginar2012.php?pag=".$new."'> > </a></center>";
//echo $nregistros;
$de = $pagina + 1;
echo "<p>&nbsp;&nbsp;&nbsp;&nbsp;$de &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $npag</tp>"; 
}
elseif($pagina > 0){
echo "<center><a href='$_SERVER[$query]?pag=$menos>' << </a> | <a href='$_SERVER[$query]?pag=$new>' >> </a></center>";
//echo "<center><a href='paginar2012.php?pag=".$menos."'> < </a>" "<a href='paginar2012.php?pag=".$new."'> > </a></center>";
echo $pagina+1; print('  de  ');echo $npag;
}
//fin de validaciones?>
    </p></td>  
  </tr>
   <tr>
   <td width ="195" height="21" style="font-weight:bold;font-size:8px; font-family: arial;"  aling="center"><pre>&nbsp;</pre></td>
    <td width ="39"  aling="center" ><pre>&nbsp;</pre></td>
    <td width ="114"  aling="center"><pre>&nbsp;</pre></td>
    <td width ="412"  aling="center"><pre>&nbsp;</pre></td>
    <td width ="66"  aling="center"><pre>&nbsp;</pre></td>
    <td width ="118"  aling="center"><pre>&nbsp;</pre></td>
   </tr>
   <tr>
   
   <td width ="195" height="21"  aling="center"><pre>&nbsp;</pre></td>
    <td width ="39"  aling="center"><pre>&nbsp;</pre></td>
    <td width ="114"  aling="center"><pre>&nbsp;</pre></td>
    <td width ="412"  aling="center"><pre>&nbsp;</pre></td>
    <td width ="66"  aling="center"><pre>&nbsp;</pre></td>
    <td width ="118"  aling="center"><pre>&nbsp;</pre></td>
   </tr>
</table>

<?PHP
//inicio de paginación
$total = mssql_num_rows($result);
if(!$HTTP_GET_VARS['pag']){
$num_pag = 1;
$begin = 0;
$fin = $por_pagina;
}else{
if(is_numeric($_GET['pag'])){
$num_pag = $_GET['pag'];
$begin = $num_pag*$por_pagina+1;
$fin = $begin + $por_pagina-1;//se resta 1 para que no repita registros en la siguiente p�gina
}else{
$num_pag = 1;
$begin = 0;
$fin = $por_pagina;
}
}
$p = 0;
//fin de paginación 

//ciclo de despliegue
while($row = mssql_fetch_row($result)){
$p++;

if($p >= $begin && $p <= $fin){
$cuenta = $row['12'];

if ($_REQUEST["select1"]!="0")
	{
		//session_register("categoria");
		$_SESSION["categoria"]=$_REQUEST["select1"];  //para un reporte por categoria		
		
		if ($_REQUEST["select2"]!="0")
		{
			//session_register("subcategoria");
			$_SESSION["subcategoria"]=$_REQUEST["select2"];  //para un reporte por subcategoria
			
			if ($_REQUEST["select3"]!="0")
			{
				//session_register("producto");
				$_SESSION["producto"]=$_REQUEST["select3"];  //para un reporte por producto
			}	//fin producto
		}		//fin subcat
	} //fin de evaluacion de categoria	
	
 if (isset($_SESSION["categoria"]))
				 {	//inicio de if			
					$producto=$_SESSION["producto"];	
					$categoria=$_SESSION["categoria"];	
					$subcategoria=$_SESSION["subcategoria"];
//<td style="font-size:8px; font-family:arial; solid 1px;" solid 0.5px;">'.$p.'</td>  este era para ver si la paginación era adecuada incrementando $p
echo' <table width=1047 cellpadding = 0.2 cellspacing = 0.2 border=1 align="center">
<tr>
<td width ="60" align="center" style="font-weight:bold;font-size:9px; font-family: arial;">'.$row[0].'</td><!--fecha-->
<td width ="73" align="center" style="font-weight:bold;font-size:9px; font-family: arial;">'.$row[1].'</td><!--tipo movimiento-->
<td width ="56" align="center" style="font-weight:bold;font-size:9px; font-family: arial;">'.$row[2].'</td><!--no de despacho-->
<td width ="87" aling="center" style="font-weight:bold;font-size:9px; font-family: arial;">'.$row[3].'</td><!--no de ingreso-->
<td width ="69" aling="center" style="font-weight:bold;font-size:9px; font-family: arial;">'.$row[4].'</td><!--entrada-->
<td width ="66" aling="center" style="font-weight:bold;font-size:9px; font-family: arial;">'.$row[5].'</td><!--salida-->
<td width ="74" aling="center" style="font-weight:bold;font-size:9px; font-family: arial;">'.$row[6].'</td><!--saldo-->
<td width ="64" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;;">Q.'.$row[7].'</td><!--costo promedio-->
<td width ="71" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;">Q.'.$row[8].'</td><!--costo factura-->
<td width ="76" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;">Q.'.$row[9].'</td><!--costo movimiento-->
<td width ="83" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;">Q.'.$row[10].'</td><!--costo total-->
<td width ="268" aling="left" style="font-weight:bold;font-size:6px; font-family: arial;">'.$row[11].'</td><!--nombre dependencia-->
</tr>';
}
}
}
//fin del ciclo
echo '</table>';
//fin de despliegue

//fin de validaciones
//phpinfo();
?>
</body>
</html>

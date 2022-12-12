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
require('conexion.php');
/*if ($_REQUEST["select1"]!="0")
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
					$subcategoria=$_SESSION["subcategoria"];*/

	$Fields="use almacen_nuevo 
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
			//print($nombre_producto);
		}
	
	?>
  <!--codigo_producto =1 
					and codigo_categoria = 241
					and codigo_subcategoria = 600";-->	
<?PHP 	
	//conectardb($almacen);
	$Fields2="use almacen_nuevo select 
saldo
from tb_kardex
where 
codigo_kardex in(select min(codigo_kardex) from tb_kardex where 
codigo_categoria = 211 
and codigo_subcategoria = 1200 
and codigo_producto=1
and codigo_bodega = 8 
and codigo_tipo_movimiento = 1)";
	
		$res_qry_producto=$query($Fields2);
	//$cnt = 1; // comentada
		//while ($cnt <= count($res_qry_producto)  //comentada
		while($row=$fetch_array($res_qry_producto)) 
		{				
			
			$saldo=$row["saldo"];
			
			//print($saldo);
		}
		
		
		
		$Fields3="use almacen_nuevo 
		select observaciones
		from tb_kardex
				where 
 					codigo_producto =1 
					and codigo_categoria = 211
					and codigo_subcategoria = 1200
					and codigo_bodega = 8";
		
		$res_qry_producto=$query($Fields3);
		while($row=$fetch_array($res_qry_producto)) 
		{				
			
			$observaciones=$row["observaciones"];
			//print($observaciones);
		}
		/*if ($cboMesi < 10)
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
				$fecha2h = $fecha2.' 24:59:59';*/
		
		
		?> 
<!--codigo_kardex in(select min(codigo_kardex) from tb_kardex where codigo_categoria = 241 
and codigo_subcategoria = 600
and codigo_producto=1
and codigo_bodega = 8 
and codigo_tipo_movimiento = 1)";-->

<?php

/*if ($_REQUEST["select1"]!="0")
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
					$subcategoria=$_SESSION["subcategoria"];*/

$por_pagina="40";
$query = "use almacen_nuevo 
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
CONVERT(varchar(20), k.fecha, 120) >= '2010-11-25' and CONVERT(varchar(20), k.fecha, 120) <= '2012-02-08' 
and k.codigo_producto = 1 and k.codigo_categoria = 211 and k.codigo_subcategoria = 1200 and codigo_empresa = ".$_SESSION["empresax"]." and codigo_bodega = 8
 order by codigo_kardex asc";
 }//fin de if
 $result = mssql_query( $query ); 
 }//fin de if
 ?>

<!--SIN PARAMETROS
CONVERT(varchar(20), k.fecha, 120) >= '2010-11-25' and CONVERT(varchar(20), k.fecha, 120) <= '2012-02-08' 
and k.codigo_producto = 1 and k.codigo_categoria = 241 and k.codigo_subcategoria = 600 and codigo_empresa = ".$_SESSION["empresax"]." and codigo_bodega = 8
 order by codigo_kardex asc";
 
 CON PARAMETROS
 CONVERT(varchar(20), k.fecha, 120) >= '".$fechahora1."' and CONVERT(varchar(20), k.fecha, 120) <= '".$fechahora2."' 
 and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = ".$_SESSION["empresax"]." and codigo_bodega = 8
 order by codigo_kardex asc";
 
 
 SOLO PARAMETROS DE CATEGORIA, SUBCATEGORIA, & PRODUCTO
 CONVERT(varchar(20), k.fecha, 120) >= '2010-11-25' and CONVERT(varchar(20), k.fecha, 120) <= '2012-02-08' 
and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria  and codigo_empresa = ".$_SESSION["empresax"]." and codigo_bodega = 8
 order by codigo_kardex asc";
 
 -->


<table width=1045 border=0 cellspacing=1 cellpadding=1 align="center">
   
   <tr>
   <td width ="195"  aling="center">&nbsp;</td>
    <td width ="39"  aling="center">&nbsp;</td>
    <td width ="114"  aling="center">&nbsp;</td>
    <td width ="412"  aling="center">&nbsp;</td>
    <td width ="66"  aling="center">&nbsp;</td>
    <td width ="118"  aling="center">&nbsp;</td>
   </tr>
   
   <tr>
    <td width="195"  align="right" style="font-weight:bold;font-size:10px; font-family: arial;">
	<?PHP	
	$cat=211;
	$sub=1200;
	$prod=1;
	print($cat. ' - ');print($cat. ' - ');print($prod. '');?></td>
	<td width ="39"  aling="center"></td>
	<td width ="114"  aling="center"></td>
	<td width="412" align="left" style="font-weight:bold;font-size:7px; font-family: arial;"><?PHP echo $nombre_producto;?></td> 
	<!-- imprime nombre de producto-->
	<td width ="66"  aling="center"></td>
	<td width ="118"  aling="center"></td>
	<td width= "79" aling="right" align="left" style="font-weight:bold;font-size:7px; font-family: arial;"><?PHP print($saldo);?> </td>
	<!--imprime saldo inicial del producto-->
  </tr>
    <tr>
	<td width ="195" height="21"  aling="center"><span style="font-weight:bold;font-size:8px; font-family: arial;"><?PHP print($observaciones);?></span></td>
    <td width ="39"  aling="center">&nbsp;</td>
    <td width ="114"  aling="center">&nbsp;</td>
    <td width ="412"  aling="center">&nbsp;</td>
    <td width ="66"  aling="center">&nbsp;</td>
    <td width ="118"  aling="center">&nbsp;</td>
    <td width= "79" height="21" aling="right" style="font-weight:bold;font-size:10px; font-family: arial;"><?PHP
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
//fin de validaciones?></td>  
  </tr>
   <tr>
   <td width ="195" height="21" style="font-weight:bold;font-size:8px; font-family: arial;"  aling="center">&nbsp;</td>
    <td width ="39"  aling="center" >&nbsp;</td>
    <td width ="114"  aling="center">&nbsp;</td>
    <td width ="412"  aling="center">&nbsp;</td>
    <td width ="66"  aling="center">&nbsp;</td>
    <td width ="118"  aling="center">&nbsp;</td>
   </tr>
   <tr>
   
   <td width ="195" height="21"  aling="center">&nbsp;</td>
    <td width ="39"  aling="center">&nbsp;</td>
    <td width ="114"  aling="center">&nbsp;</td>
    <td width ="412"  aling="center">&nbsp;</td>
    <td width ="66"  aling="center">&nbsp;</td>
    <td width ="118"  aling="center">&nbsp;</td>
   </tr>
</table>
<!-- print( '241 - ');print( '600 - ');print( '1 ');-->
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
echo' <table width=1047 border=1 cellspacing=0 cellpadding=0 align="center">
<tr>
<td width ="10" align="justify" style="font-weight:bold;font-size:9px; font-family: arial;">'.$row[0].'</td><!--fecha-->
<td width ="50" align="center" style="font-weight:bold;font-size:9px; font-family: arial;">'.$row[1].'</td><!--tipo movimiento-->
<td width ="37" align="justify" style="font-weight:bold;font-size:9px; font-family: arial;">'.$row[2].'</td><!--no de despacho-->
<td width ="58" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;">'.$row[3].'</td><!--no de ingreso-->
<td width ="47" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;">'.$row[4].'</td><!--entrada-->
<td width ="40" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;">'.$row[5].'</td><!--salida-->
<td width ="52" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;">'.$row[6].'</td><!--saldo-->
<td width ="45" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;;">Q.'.$row[7].'</td><!--costo promedio-->
<td width ="50" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;">Q.'.$row[8].'</td><!--costo factura-->
<td width ="53" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;">Q.'.$row[9].'</td><!--costo movimiento-->
<td width ="56" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;">Q.'.$row[10].'</td><!--costo total-->
<td width ="188" aling="justify" style="font-weight:bold;font-size:7px; font-family: arial;">'.$row[11].'</td><!--nombre dependencia-->
</tr>';
}
}
}
//fin del ciclo
echo '</table>';
//fin de despliegue

//validaciones para opciones de navegación
/*$pagina=$_GET['pag'];
$new=$pagina+1;
$menos=$pagina-1;
///pagina 1 de n
$npag=ceil($total/$por_pagina);//ceil()redondea el # de pags a un entero
if($pagina == 0) {
echo "<center><a href=?pag=$new> >> </a></center>";
//echo $nregistros;
echo $pagina+1; print('  de  ');echo $npag;
}
elseif($pagina > 0){
echo "<center><a href=?pag=$menos> << </a> | <a href=?pag=$new> >> </a></center>";
echo $pagina+1; print('  de  ');echo $npag;
}*/
//fin de validaciones
//phpinfo();
?>
</body>
</html>

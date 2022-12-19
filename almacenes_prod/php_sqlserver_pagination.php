<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">

<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>
<body>
<?PHP

require("../includes/funciones.php");
require("../includes/sqlcommand.inc");
//require('conexion.php');
//ini_set('mssql.charset', 'UTF-8');
$objConnect = mssql_connect("server_appl","sa","Sup3rus3r2009");
$objDB = mssql_select_db("almacen");

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
			print($nombre_producto);
		}
		
$Fields2="use almacen_nuevo_qa 
select 
saldo
from tb_kardex
where 
codigo_kardex in(select min(codigo_kardex) from tb_kardex where codigo_categoria = '$categoria' 
and codigo_subcategoria = '$subcategoria'
and codigo_producto='$producto'
and codigo_bodega = 8 
and codigo_tipo_movimiento = 1)";
	
		$res_qry_producto=$query($Fields2);
	//$cnt = 1; // comentada
		//while ($cnt <= count($res_qry_producto)  //comentada
		while($row=$fetch_array($res_qry_producto)) 
		{				
			$saldo=$row["saldo"];
			print($saldo);
		}		



$strSQL = "use almacen_nuevo_qa 
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
and k.codigo_producto = '$producto' and k.codigo_categoria = '$categoria' and k.codigo_subcategoria = '$subcategoria' and codigo_empresa = ".$_SESSION["empresax"]." and codigo_bodega = 8
 order by codigo_kardex asc";

//cuenta cuantos registros me devuelve el query
/*$counter = "select COUNT(1)conteo
from tb_kardex k
inner join cat_tipo_movimiento m
on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
inner join direccion d
on k.id_dependencia = d.iddireccion
	where 
	CONVERT(varchar(20), k.fecha, 120) >= '2010-11-25' and CONVERT(varchar(20), k.fecha, 120) <= '2012-02-08' 
and k.codigo_producto = '$producto' and k.codigo_categoria = '$categoria' and k.codigo_subcategoria = '$subcategoria' and codigo_empresa = ".$_SESSION["empresax"]." and codigo_bodega = 8";*/

echo 'Total records in database: ' . $counter;

$objQuery = mssql_query($strSQL) or die ("Error Query [".$strSQL."]");

$Num_Rows = mssql_num_rows($objQuery);

///inicio de paginado efectivo 
$Per_Page = 35;   // Per Page

$Page = $_GET["Page"];
}//fin de if
if(!$_GET["Page"])
{
	$Page=1;
}

$Prev_Page = $Page-1;
$Next_Page = $Page+1;

$Page_Start = (($Per_Page*$Page)-$Per_Page);
if($Num_Rows<=$Per_Page)
{
	$Num_Pages =1;
}
else if(($Num_Rows % $Per_Page)==0)
{
	$Num_Pages =($Num_Rows/$Per_Page) ;
}
else
{
	$Num_Pages =($Num_Rows/$Per_Page)+1;
	$Num_Pages = (int)$Num_Pages;
}
$Page_End = $Per_Page * $Page;
IF ($Page_End > $Num_Rows)
{
	$Page_End = $Num_Rows;
}

?>
<table width="1104" border="1">
  <tr>
     <th width ="30" align="left" style="font-weight:bold;font-size:9px; font-family: arial;"> <div align="center">fecha </div></th>
    <th width ="50" align="left" style="font-weight:bold;font-size:9px; font-family: arial;"> <div align="center">movimiento</div></th>
    <th width ="30" align="justify" style="font-weight:bold;font-size:9px; font-family: arial;"><div align="center">despacho</div></th>
    <th width ="50" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;"><div align="center">ingreso </div></th>
    <th width ="50" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;"><div align="center">entrada</div></th>
     <th width ="50" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;"><div align="center">salida</div></th>
    <th width ="55" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;"> <div align="center">saldo</div></th>
    <th width ="55" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;;"> <div align="center">costo promedio</div></th>
    <th width ="53" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;"><div align="center">costo factura</div></th>
    <th width ="53" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;"> <div align="center">costo movimiento</div></th>
    <th width ="53" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;"> <div align="center">costo total </div></th>
    <th width ="250" aling="left" style="font-weight:bold;font-size:8px; font-family: arial;">dependencia</th>
  </tr>
<?PHP 
for($i=$Page_Start;$i<$Page_End;$i++)
{
?>
  <tr>
    <td width ="30" align="left" style="font-weight:bold;font-size:9px; font-family: arial;"><div align="center"><?=mssql_result($objQuery,$i,"fecha");?></div></td>
    <td width ="50" align="left" style="font-weight:bold;font-size:9px; font-family: arial;"><?=mssql_result($objQuery,$i,"tipo_movimiento");?></td>
    <td width ="30" align="justify" style="font-weight:bold;font-size:9px; font-family: arial;"><?=mssql_result($objQuery,$i,"no_despacho");?></td>
    <td width ="30" align="justify" style="font-weight:bold;font-size:9px; font-family: arial;"><?=mssql_result($objQuery,$i,"no_ingreso");?></td>
    <td width ="50" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;"><div align="center"><?=mssql_result($objQuery,$i,"entrada");?></div></td>
    <td width ="50" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;"><?=mssql_result($objQuery,$i,"salida");?></td>
    <td width ="55" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;"><?=mssql_result($objQuery,$i,"saldo");?></td>
    <td width ="55" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;">Q.<?=mssql_result($objQuery,$i,"costo_promedio");?></td>
    <td width ="53" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;">Q.<?=mssql_result($objQuery,$i,"costo_factura");?></td>
    <td width ="53" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;">Q.<?=mssql_result($objQuery,$i,"costo_movimiento");?></td>
    <td width ="53" aling="justify" style="font-weight:bold;font-size:9px; font-family: arial;">Q.<?=mssql_result($objQuery,$i,"costo_total");?></td>
    <td width ="250" aling="left" style="font-weight:bold;font-size:9px; font-family: arial;"><?=mssql_result($objQuery,$i,"nombre");?></td>
  </tr>
<?PHP
}
?>
</table>

<br>
N&uacute;mero de l&iacute;neas:<?= $Num_Rows;?> N&uacute;mero de p�ginas: <?=$Num_Pages;?> P&aacute;gina :
<?PHP
if($Prev_Page)
{
	echo " <a href='$_SERVER[$strSQL]?Page=$Prev_Page'><< ant</a> ";
}

///inicio muestra paginas
for($i=1; $i<=$Num_Pages; $i++){
	if($i != $Page)
	{
		echo "[ <a href='$_SERVER[$strSQL]?Page=$i'>$i</a> ]";
	}
	else
	{
		echo "<b> $i </b>";
	}
}
//fin muestra p�ginas
if($Page!=$Num_Pages)
{
	echo " <a href ='$_SERVER[$strSQL]?Page=$Next_Page'>sig>></a> ";
}

mssql_close($objConnect);
?>
</body>
</html>

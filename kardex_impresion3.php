<?		
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="content-type" content="no-cache"; />
<head> 
<style type="text/css">
span.blue {font-weight:bold;font-size:10px; font-family: arial;
}
span.green {color:darkolivegreen;font-weight:bold}
</style>
<!--<meta http-equiv="content-type" content="no-cache"; />-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">  <!--iso-8859-1 para caracacteres latinoamericanos como la � | �-->



<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>
<SCRIPT language=javascript>
function cOn(td){
if(document.getElementById||(document.all && !(document.getElementById))){
td.style.backgroundColor="#FFF2F2";
}
}

function cOut(td){
if(document.getElementById||(document.all && !(document.getElementById))){
td.style.backgroundColor="#FFFFFF";
}
}
//-->
</SCRIPT>
<body>
<table width="1045"  border="0" cellpadding="1" cellspacing="1">
  <tr>
  <td width="1045" height="55"></td>
  </tr>
    <?PHP
conectardb($almacen);	
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
			//print($producto);
		}
	?>
    <?PHP 	
	conectardb($almacen);
	$Fields2="use almacen_nuevos elect 
saldo
from tb_kardex
where 
codigo_kardex in(select min(codigo_kardex) from tb_kardex where codigo_categoria = '$categoria' 
and codigo_subcategoria = '$subcategoria' 
and codigo_producto='$producto'
and codigo_bodega = 8 
and codigo_tipo_movimiento = 1)";
	
	
	
	
	
	/*"use almacen_nuevo 
			select *
 				from tb_kardex
				where 
 				CONVERT(varchar(20), k.fecha, 120) >= '".$fechahora1."' 
				and CONVERT(varchar(20), k.fecha, 120) <= '".$fechahora2."' 
 				and codigo_producto = $producto 	
				and codigo_categoria = $categoria
				and codigo_subcategoria = $subcategoria 
				and codigo_bodega = 8 and 
				codigo_tipo_movimiento = 1";*/
	$res_qry_producto=$query($Fields2);
	//$cnt = 1; // comentada
		//while ($cnt <= count($res_qry_producto)  //comentada
		while($row=$fetch_array($res_qry_producto)) // supuestamente funcionaba
		{				
			$saldo=$row["saldo"];
			//print($saldo);
		}
		?> 
	
   <td>
   <table width="1045" border="0" cellspacing="1" cellpadding="1" align="center">
   <tr>
    <td width="112">&nbsp;</td>
    <td width="257"><?PHP 
		
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
				//echo 'Reporte del '.$cboDiai.'/'.$cboMesi.'/'.$cboAnioi.' al '.$cboDiaf.'/'.$cboMesf.'/'.$cboAniof;
//		print($saldo); 
		print($categoria. ' - ');print($subcategoria. ' - ');print($producto. '');
		
		?>
		
		</td>
    		<td width="1500"><?PHP echo $nombre_producto; ?></td>  <!--imprime nombre de producto--> 
    		<!--<td width="4">&nbsp;</td> 
    		<td width="6">&nbsp;</td>-->
    		<td style="font-size:10px; font-family:arial;" ><?PHP print($saldo); //print $nombre; ?> </td> <!--imprime nombre del producto-->
  		</tr>
</table>
</td>
  <tr>
	 <td width="1045" height="55"></td></tr>
    <td><table width="1026" border="0" cellpadding="0" cellspacing="0" align="center">
     <tr> 
        <td width="63">&nbsp;</td>
        <td width="78">&nbsp;</td>
        <td width="67">&nbsp;</td>
        <td width="78">&nbsp;</td>
        <td width="72">&nbsp;</td>
        <td width="71">&nbsp;</td>
        <td width="77">&nbsp;</td>
        <td width="70">&nbsp;</td>
        <td width="64">&nbsp;</td>
        <td width="65">&nbsp;</td>
        <td width="72">&nbsp;</td>
        <td width="252">&nbsp;</td>
      </tr>
      
      <tr>
        <td><?		
	conectardb($almacen);
	$query_kardex_2 = "use almacen_nuevo 
	select 
	Count(d.nombre) as filas
	from tb_kardex k
	inner join cat_tipo_movimiento m
	on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
	inner join direccion d
	on k.id_dependencia = d.iddireccion
	where 
	CONVERT(varchar(20), k.fecha, 120) >= '".$fechahora1."' and CONVERT(varchar(20), k.fecha, 120) <= '".$fechahora2."' 
	and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = ".$_SESSION["empresax"]." and codigo_bodega = 8
	";

// Contador de Paginas	
	$do_2=mssql_query($query_kardex_2);
	$row = mssql_fetch_row($do_2);
	$paginas = round($row[0]/20);
	for($p=0;$p<=$paginas;$p++)
	{		
		echo "<a href='kardex_impresion3.php?conta=$p&categoria=$categoria&subcategoria=$subcategoria&produto=$producto&p=$p' ><td onmouseover=cOn(this); onmouseout=cOut(this);> $p </td> </a>";			
	}                 

// fin de contador de paginas	
				

	conectardb($almacen);


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
				 {				
					$prodcuto=$_SESSION["producto"];	
					$categoria=$_SESSION["categoria"];	
					$subcategoria=$_SESSION["subcategoria"];	

conectardb($almacen);
$query_kardex = "use almacen_nuevo 
select CONVERT(nvarchar(10), k.fecha, 103) as fecha,
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
 and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = ".$_SESSION["empresax"]." and codigo_bodega = 8
 order by codigo_kardex asc";

     }

		$do=mssql_query($query_kardex);  
//		$i = 0;									
		$tmp = 0;    
//		if ($do) // comprobacion de la insercion de registros
//		{			
			while($vector = mssql_fetch_array($do))
				{	
					if (($tmp>=$conta*30) && ($tmp<$conta*30+30))
					{
						//include("css/format_table.php");									
						// este bloque se repite si y solo si no pasa los 20
						print '<tr><td><span class="blue">'.$vector["fecha"].'</span></td>';
						print '<td><span class="blue">'.$vector["tipo_movimiento"].'</span></td>';
						print '<td><span class="blue">'.$vector["no_despacho"].'</span></td>';
						print '<td><span class="blue">'.$vector["no_ingreso"].'</span></td>';
						print '<td><span class="blue">'.$vector["entrada"].'</span></td>';
						print '<td><span class="blue">'.$vector["salida"].'</span></td>';
						print '<td><span class="blue">'.$vector["saldo"].'</span></td>';
						print '<td><span class="blue">'.$vector["costo_promedio"].'</span></td>';
						print '<td><span class="blue">'.$vector["costo_factura"].'</span></td>';
						print '<td><span class="blue">'.$vector["costo_movimiento"].'</span></td>';
						print '<td><span class="blue">'.$vector["costo_total"].'</span></td>';
						print '<td><span class="blue">'.$vector["nombre"].'</span></td></tr>';										
					}

					$tmp++;
					//$i++;
				}	
						
//			} else {
			/* Error en la insercion*/
//			print "<p class='Estilo1'>No se pudo insertar la inforci&oacute;n !!!ERROR!!</p>";
//		}	
		$free_result($do);
?></td>
      
    </table></td>
  </tr>
</table>
</body>
</html>

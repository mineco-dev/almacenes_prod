<!-------------------------------------------------Inicio del encabezado del reporte------------------------------------------------->
<?		
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="content-type" content="no-cache"; />
<style type="text/css">
<!--
.style2 {color: #000000}
-->
</style>
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
<meta http-equiv="content-type" content="no-cache";/> 
<body>
<table width="1159"  border="0" cellpadding="1" cellspacing="1">
  <tr>
    <td width="1155" height="51"></td>
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
	$Fields2="use almacen_nuevo select 
				saldo
				from tb_kardex
				where 
				codigo_producto = '$producto' 	
				and codigo_categoria = '$categoria'
				and codigo_subcategoria = '$subcategoria' 
				and codigo_bodega = 8 and 
				codigo_tipo_movimiento = 2";
				//and saldo is not null";
	
		$res_qry_producto=$query($Fields2);
	//$cnt = 1; 
		//while ($cnt <= count($res_qry_producto)  
		while($row=$fetch_array($res_qry_producto)) 
		{				
			$saldo=$row["saldo"];
			//print($saldo);
		}
		?>
  <tr>
    <td><table width="1152" border="0" cellspacing="1" cellpadding="1" align="center">
      <tr>
        <td width="103">&nbsp;</td>
        <td width="248"><?PHP 
		
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
        <td width="617" style="font-size:10px; font-family:arial;"><?PHP echo $nombre_producto; ?></td>
        <!--imprime nombre de producto-->
        <!--<td width="4">&nbsp;</td> 
    		<td width="6">&nbsp;</td>-->
        <td width="75" style="font-size:12px; font-family:arial;" ><?PHP echo $saldo; ?> </td>
        <!--imprime nombre del producto-->
      </tr>
    </table></td>
  </tr>
  <tr>
    <td width="1155" height="94"><p align="right">&nbsp;</p></td>
  </tr>
  <tr>
    <td height="52">&nbsp;</td>
  </tr>
</table>
<table width="1159"  border="0" cellpadding="1" cellspacing="1">
  <tr>
  <td width="1155" height="51"></td>
  </tr><td>&nbsp;</td>
  <tr>
	 <td width="1155" height="94"><p align="right">&nbsp;</p></td>
  </tr>
    <td height="52"><table width="1152" border="0" cellpadding="0" cellspacing="0" align="center">
     <tr bordercolor="#000000"> 
        <td width="86" height="23"><span class="style2"></span></td>
        <td width="73">&nbsp;</td>
        <td width="81">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="96">&nbsp;</td>
        <td width="75">&nbsp;</td>
        <td width="65">&nbsp;</td>
        <td width="82">&nbsp;</td>
        <td width="81">&nbsp;</td>
        <td width="81">&nbsp;</td>
        <td width="84">&nbsp;</td>
        <td width="252">&nbsp;</td>
      </tr>
      
      <tr>
        <td><span class="style2">
          				
<!---------------------------------------------------------fin del encabezado del reporte--------------------------------------------->

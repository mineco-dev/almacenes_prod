<?
	require("../../../includes/funciones.php");
	require("../../../includes/sqlcommand.inc");		
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">  
<head>
<!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />-->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<script>
  window.print();
</script>
<style type="text/css">
span.blue {font-weight:bold;font-size:8px;
}
span.red {font-weight:bold;font-size:8px;
}
span.green {color:darkolivegreen;font-weight:bold}
</style>
<style type="text/css">
<!--
body {
	margin-left: 0px;
	margin-top: 1.5px;
	margin-right: 0px;
	margin-bottom: 0px;
}
.style2 {font-size: 8px}
-->
</style></head>

<body>

<table width="807px" height="1100px" border="0" cellpadding="0" cellspacing="0">
 <?
			$hoja_ingreso=$_SESSION["hoja_ingreso"];
			//$existe=false;
			$qry_ingreso_enc = "select CONVERT(nvarchar(10), e.fecha_ingreso, 103) as fecha_ingreso, 
			CONVERT(nvarchar(10), e.fecha_documento, 103) as fecha_documento,  e.numero_serie, convert(nvarchar(10), e.fecha_recepcion, 103) as fecha_recepcion,
			e.observaciones, p.programa, a.actividad,
e.codigo_ingreso_enc, e.solicitante, e.numero_documento, pro.nombre as proveedor
			from tb_ingreso_enc e  
inner join cat_programa p
on e.codigo_programa = p.codigo_programa
inner join cat_actividad a
on e.codigo_actividad = a.codigo_actividad and a.codigo_programa = p.codigo_programa
inner join tb_proveedor pro on
e.codigo_proveedor = pro.rowid
where codigo_ingreso_enc ='$hoja_ingreso' and p.activo=1	";
			//print($qry_ingreso_enc);
			conectardb($almacen);
			$res_ingreso_enc=$query($qry_ingreso_enc);
			while($row_ingreso_enc=$fetch_array($res_ingreso_enc))
			{
			 	$fecha_factura=$row_ingreso_enc["fecha_documento"];
				$observaciones=($row_ingreso_enc["observaciones"]);
				$codigo_ingreso_enc=$row_ingreso_enc["codigo_ingreso_enc"];
				$solicitante=$row_ingreso_enc["solicitante"];
				$programa=utf8_encode($row_ingreso_enc["programa"]);
				$actividad=utf8_encode($row_ingreso_enc["actividad"]);
				$proveedor=utf8_encode($row_ingreso_enc["proveedor"]);
				$noserie=$row_ingreso_enc["numero_serie"];
				$nofactura=$row_ingreso_enc["numero_documento"];
				$fecha=$row_ingreso_enc["fecha_ingreso"];
				$fecha_recepcion=$row_ingreso_enc["fecha_recepcion"];				
				//$existe=true;
}
			//$free_result($res_ingreso_enc);	
			//if ($existe==true)
			//{								
		?> 
        
  
  <tr>
    <td  valign="top">
    <table width="807px" border="0" cellspacing="1" cellpadding="1">
      <tr>
      <td colspan="8" "style: height=65>      <p>&nbsp;</p>
        <p>&nbsp;</p>
        </td>
      </tr>
      <tr>
        <td width="28" height="22">&nbsp;</td>
       <td width="214" valign="bottom" style="padding-top:9px;"><span class="blue">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $programa; ?></span></td>
        <td width="55">&nbsp;</td>
        <td width="132" valign="bottom" style="padding-top:17px;"><span class="blue" style="position: relative;bottom: 0px;left: 10px;" ><? echo $actividad; ?></span></td>
        <td width="27">&nbsp;</td>
        <td width="112">&nbsp;</td>
        <td width="40">&nbsp;</td>
        <td width="161" valign="right" style="padding-top:20px;" ><span class="blue" style="position: relative;left: 12px;">&nbsp;&nbsp;<? echo substr($fecha_recepcion,0,12); ?></span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td valign="top" style="padding-top:19px;"><span class="blue" style = "padding:0;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $proveedor; ?></span></td>
        <td><span>&nbsp;</span><br><span>&nbsp;</span></td>
        <td valign="top" style="padding-top:28px;"><span class = "blue">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $noserie; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<? echo $nofactura; ?></span></td>
        <td>&nbsp;</td>
        <td valign="center" style="padding-top:10px;"><span class="blue" style="position: relative;left: 175px;"><? echo substr($fecha_factura,0,12); ?></span></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td height="599px" valign="top"><table width="807px" border="0" cellspacing="1" cellpadding="1">
         
      <tr> 
        <td width="40" align="right"></td>
        <td width="344"><span class="style2"> </span></td>
        <td width="56">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td width="70"><div align="left"></div></td>
        <td width="98"><div align="left"></div></td>
        <td width="122">&nbsp;</td>
        <td width="49">&nbsp;</td>
      </tr>
      
       <?	  	
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
		$res_ingreso_det=$query($qry_ingreso_det);		
		while($row_ingreso_det=$fetch_array($res_ingreso_det))
		{			
			//$operador=$row_ingreso_det["usuario_creo"];
			//$operado=$row_ingreso_det["fecha_creado"];
				//$cantidad=$row_ingreso_det["cantidad_ingresada"];
				//$descripcion=$row_ingreso_det["descripcion"];
				//$renglon=$row_ingreso_det["codigo_renglon"];
				//$costo=$row_ingreso_det["costo_unidad"];
				//$precio=$row_ingreso_det["Precio_total"];

	
		//$free_result($res_ingreso_det);
	  echo '<tr><td><span class="blue" style="position:relative;left:-2px;">'.$row_ingreso_det["cantidad_ingresada"].'</span></td>';
   echo '<td><span class="blue">'.$row_ingreso_det["codigo_categoria"].' '.$row_ingreso_det["codigo_subcategoria"].' '.$row_ingreso_det["codigo_producto"].'  -  '.utf8_encode($row_ingreso_det["descripcion"]).'</span></td>';
			echo '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="blue" style="position:relative;left:-9px;">'.$row_ingreso_det["codigo_renglon"].'</span></td>';
			echo '<td><span class="blue">&nbsp;Q '.number_format($row_ingreso_det["costo_unidad"],2).'</span></td>';
			echo '<td><span class="blue">&nbsp;Q '.number_format($row_ingreso_det["Precio_total"],2).'</span></td></tr>';		
		
		}
		$free_result($res_ingreso_det);
    
     ?>
   <?
   $qry_total = "select sum(Precio_total) as total from tb_ingreso_det
where codigo_ingreso_enc = $codigo_ingreso_enc";

   $res_ingreso_enc=$query($qry_total);
			while($row_ingreso_enc=$fetch_array($res_ingreso_enc))
			{
			 	
				$total=number_format($row_ingreso_enc["total"],2);
				//$existe=true;
				
			}
   ?>
      <tr> 
        
        <td width="40" align="right">&nbsp;</td>
        <td width="344"><span class="style2"> </span></td>
        <td width="56">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
        <td width="70"><div align="left"></div></td>
        <td width="98"><div align="left"></div></td>
        <td width="122">&nbsp;</td>
        <td width="49">&nbsp;</td>
      </tr>
    <tr> 
        
        <td width="40" align="right">&nbsp;		</td>
        <td width="344"><span class="style2"></span></td>
        <td width="56"><span class="blue"></span></td>
        <td width="70" align="left"><span class="blue">&nbsp;&nbsp;&nbsp;Total</span></td>
        <td width="98"><div align="left"><span class="blue">&nbsp;&nbsp;Q <? echo $total; ?></span></div></td>
        <td width="122">&nbsp;</td>
        <td width="49">&nbsp;</td>
      </tr>
   
   <tr> 
        
        <td width="40">&nbsp;</td>
        <td width="344"><span class="blue"><? echo $observaciones; ?></span></td>
        <td width="56">&nbsp;</td>
        <td width="70"><div align="left"></div></td>
        <td width="98"><div align="left"></div></td>
        <td width="122">&nbsp;</td>
        <td width="49">&nbsp;</td>
      </tr>   
    </table>     
   </td>
  </tr>  
</table>
</body>
</html>

<?PHP
	require("../../../includes/funciones.php");
	require("../../../includes/sqlcommand.inc");		
?>
<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<script language="JavaScript" type="text/javascript">
function imprimir()
{
	window.print();
}
</script>
<style type="text/css">
<!--
.Estilo1 {font-size: x-large}
-->
</style>
</head>
<br>
<br>
<br>
<br>
<br>
<table width="90%" height="55"  border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <?PHP
			$hoja_ingreso=$_SESSION["hoja_ingreso"];
			$existe=false;
			$qry_ingreso_enc = "select CONVERT(nvarchar(10), e.fecha_ingreso, 103) as fecha_ingreso, 
			CONVERT(nvarchar(10), e.fecha_documento, 103) as fecha_documento, 
			e.observaciones, p.Descripcion as programa, a.descripcion as actividad,
e.codigo_ingreso_enc, e.solicitante, e.numero_documento, pro.nombre as proveedor
			from tb_ingreso_enc e  
inner join tb_actividad a 
on e.codigo_actividad = a.codigo_actividad and e.codigo_programa = a.codigo_programa 
inner join tb_programa p
on e.codigo_programa = p.codigo_programa 
inner join tb_proveedor pro on
e.codigo_proveedor = pro.rowid
where codigo_ingreso_enc ='$hoja_ingreso' and codigo_tipo_documento=6";
			//print($qry_ingreso_enc);
			conectardb($almacen);
			$res_ingreso_enc=$query($qry_ingreso_enc);
			while($row_ingreso_enc=$fetch_array($res_ingreso_enc))
			{
			 	$fecha_factura=$row_ingreso_enc["fecha_documento"];
				$observaciones=$row_ingreso_enc["observaciones"];
				$codigo_ingreso_enc=$row_ingreso_enc["codigo_ingreso_enc"];
				$solicitante=$row_ingreso_enc["solicitante"];
				$programa=$row_ingreso_enc["programa"];
				$actividad=$row_ingreso_enc["actividad"];
				$proveedor=$row_ingreso_enc["proveedor"];
				$nofactura=$row_ingreso_enc["numero_documento"];
				$fecha=$row_ingreso_enc["fecha_ingreso"];
				$existe=true;
				
			}
			$free_result($res_ingreso_enc);	
			if ($existe==true)
			{								
		?> 
           
            <tr class="titulotabla">            </tr>
            <tr>
         
              <td><span class="titulomenu">&nbsp;<?PHP echo $programa; ?> </span></td>
              <td><span class="titulomenu">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?PHP echo $actividad; ?></span></td>
              <td><span class="titulomenu">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?PHP echo substr($fecha,0,12); ?></span></td>
            </tr>
           <br>
            <tr>
              <td><span class="titulomenu"> &nbsp;<?PHP echo $proveedor; ?></span></td>
              <td><span class="titulomenu">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?PHP echo $nofactura; ?> </span></td>
              <td><span class="titulomenu"><?PHP echo substr($fecha_factura,0,12); ?></span></td>
            </tr>
        
         <?PHP
}
else
{
echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
echo '<TR><TD COLSPAN="5"><span class="error"><center>NO SE ENCONTRO NINGUNA HOJA DE INGRESO CON EL N�MERO --> </span>'.$hoja_ingreso.' </center></TD></TR>';					
}
?>
</table>
<br><br><br><br>     
<br><br>  <br> 
  <br> 

<table width="85%"  border="0" cellpadding="0" cellspacing="0" align="left">
<tr class="titulotabla">
    <td width="-5%"><div align="left"></div></td>
        <td width="25%"><div align="center"></div></td>
        <td width="10%"><div align="center"></div></td>
        <td width="10%"><div align="center"></div></td>
        <td width="10%"><div align="center"></div></td>
      
  </tr>	  
	 <?	  	
		$qry_ingreso_det = "select d.codigo_ingreso_enc, (p.producto +' '+ m.unidad_medida) as descripcion, d.cantidad_ingresada, d.codigo_producto, d.codigo_categoria, d.codigo_subcategoria, e.nomenclatura_cuentas, e.folio_libro, e.observaciones,
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
				
			
			echo '<tr><td align="left" width="5%"><span class="descripcionproducto">'.$row_ingreso_det["cantidad_ingresada"].'</span></td>';
			
			echo '<td align="left" width="40%"><span class="descripcionproducto">'.$row_ingreso_det["codigo_categoria"].' '.$row_ingreso_det["codigo_subcategoria"].' '.$row_ingreso_det["codigo_producto"].'  -  '.$row_ingreso_det["descripcion"].'</span></td>';
			echo '<td align="center" width="10%"><span class="descripcionproducto">'.$row_ingreso_det["codigo_renglon"].'</span></td>';
			echo '<td align="center" width="10%"><span class="descripcionproducto">&nbsp;'.$row_ingreso_det["costo_unidad"].'</span></td>';
			echo '<td align="center" width="10%"><span class="descripcionproducto">'.$row_ingreso_det["Precio_total"].'</span></td>';			
		    
		
		}
		$free_result($res_ingreso_det);
	  ?>


</table>
<br><br><br><br><br><br>
<table width="45%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td align="center">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?PHP print $observaciones; ?></td>
  </tr>
</table>





<p>&nbsp;</p>
</html>

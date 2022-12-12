
<!DOCTYPE html>
<html                                     >  
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
span.det {font-weight:bold;font-size:7px;}
span.obs {font-weight:bold;font-size:6px;}
span.blue {font-size:8px;
}
span.red {font-weight:bold;font-size:7px;
}
span.green {color:darkolivegreen;font-weight:bold}
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
			$hoja_ingreso=$_SESSION["hoja_ingreso"];
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
			$res_ingreso_enc=$query($qry_ingreso_enc);
			while($row_ingreso_enc=$fetch_array($res_ingreso_enc))
			{
			 	$no_ingreso=$row_ingreso_enc["no_ingreso"];
				$fecha_factura=$row_ingreso_enc["fecha_documento"];
				$observaciones=$row_ingreso_enc["observaciones"];
				$codigo_ingreso_enc=$row_ingreso_enc["codigo_ingreso_enc"];
				$solicitante=$row_ingreso_enc["solicitante"];
				$programa=$row_ingreso_enc["programa"];
				$dependencia=$row_ingreso_enc["dependencia"];
				$actividad=$row_ingreso_enc["actividad"];
				$proveedor=$row_ingreso_enc["proveedor"];
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
    <td height="10" valign="top">
    
    
    <table width="807" border="0">
  <tr>
    <td width="500" valign="top" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="blue"></span></td>
    <td width="0">&nbsp;</td>
    <td width="179"><span class="blue">FACTURA:</span></td>
    <td width="171"><span class="blue">&nbsp;-&nbsp;</span></td>
  </tr>
  <tr>
    <td width="150" valign="top" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="blue"></span></td>
    <td colspan="2"><span class="blue">FECHA INGRESO </span></td>
    <td><span class="blue">FACTURA: </span></td>
  </tr>
  <tr>
		<td valign="top">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="red"></span></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>

    </td>
  </tr>
  <tr>
    <td height="750px" valign="top"><table width="807px" border="0" cellspacing="1" cellpadding="1">
         
      <tr> 
        <td width="47" align="right"></td>
        <td width="287"><span class="style2"></span></td>
        <td width="115">&nbsp;</td>
        <td width="79"><div align="left"></div></td>
        <td width="76"><div align="left"></div></td>
        <td width="132">&nbsp;</td>
        <td width="49">&nbsp;</td>
      </tr>
      
       
   
      <tr> 
        
        <td width="47" align="right">&nbsp;</td>
        <td width="287"><span class="style2"></span></td>
        <td width="115">&nbsp;</td>
        <td width="79"><div align="left"></div></td>
        <td width="76"><div align="left"></div></td>
        <td width="132">&nbsp;</td>
        <td width="49">&nbsp;</td>
      </tr>
    <tr> 
        
        <td width="47" align="right">&nbsp;</td>
        <td width="287"><span class="style2"></span></td>
        <td width="115">&nbsp;</td>
        <td width="79"><div align="left"></div></td>
        <td width="76"><span class="det">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total</span></td>
        <td width="132"><span class="det">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Q </span></td>
        <td width="49">&nbsp;</td>
      </tr>
   
   <tr> 
        
        <td width="47">&nbsp;</td>
        <td width="287" align="justify">&nbsp;<span class="obs"></span></td>
        <td width="115">&nbsp;</td>
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

<?		
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
?>
<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "")
  { 
  	alert("Puede buscar por nombre, apellido, extensión o dependencia"); 
	form.txt_buscar.focus(); 
	return;
  }  
function Refrescar(form)
{
	form.reset();
	form.txt_buscar.focus(); 
}
form.submit();
}
</script>
<link href="css/helpdesk.css" rel="stylesheet" type="text/css">
<link href="css/box_ie.css" rel="stylesheet" type="text/css" media="screen">
<meta http-equiv="Content-Type" content="text/html" charset="windows-1252">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

<style type="text/css">
<!--
.Estilo3 {color: #FFFFFF}
.Estilo4 {font-size: 9px}
-->
</style>
</head>

<body>

<div align="left">

    <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td><div align="center">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"></td>
              <td width="72%"><div align="center" class="legal1">Reporte Consumo Por Dependencia</div></td>
              
              <td width="15%"><div align="center"><img src="mineco.JPG" width="107" height="113"></div></td>
            </tr>
            <tr>
              <td></td>
              <td><?PHP print ($vector[4]); ?></td>
              <td>&nbsp;</td>
            </tr>
            <tr>
              <td colspan="2"><?PHP 
			  
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
				echo 'Reporte del '.$cboDiai.'/'.$cboMesi.'/'.$cboAnioi.' al '.$cboDiaf.'/'.$cboMesf.'/'.$cboAniof;
		
	
//print($categoria);
//print($subcategoria);
	//print($producto);
		
		?>
        
        </td>
              <td>&nbsp;</td>
            </tr>
          </table>
          </div></td>
      </tr>
    </table>
    
	<div class="container">
<table class="table table-striped table-hover" cellpadding="2" cellspacing="1" border="0" width="100%" id="dt">     
      <tr>
        <td colspan="2"></thead>
    <tr align="center" bgcolor="#006699" class="boxTitleBgLightBlue">
          <td colspan="2" ><strong>Fecha</strong></td>
          <td width="6%">No. Despacho</td>
          <td width="7%">Categor&iacute;a</td>
      <td width="7%"><strong>Subcategoria</strong></td>
	  <td width="6%">Producto</td>
	  <td width="35%"><strong>Detalle Producto</strong></td>
      <td width="6%">cantidad despachada</td>
          <td width="15%">Dependencia</td>
          <td width="6%">No. Requisición</td>       
         
</tr>
<?				

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
					
//print($prodcuto);
//print($categoria);
//print($subcategoria);

 conectardb($almacen);
 
 $query = "select convert (varchar(10), e.fecha_documento,103) as fecha_documento, ed.codigo_egreso_enc, p.codigo_categoria,p.codigo_subcategoria,
p.codigo_producto, p.producto,ed.cantidad_entregada, d.nombre, cb.bodega, r.codigo_requisicion_enc
 from tb_egreso_det ed
inner join tb_egreso_enc e on e.codigo_egreso_enc =ed.codigo_egreso_enc
inner join tb_requisicion_enc r on  r.codigo_egreso =ed.codigo_egreso_enc
inner join cat_producto p on p.codigo_categoria=ed.codigo_categoria and p.codigo_subcategoria=ed.codigo_subcategoria and p.codigo_producto=ed.codigo_producto
inner join direccion d on d.iddireccion =e.codigo_dependencia
inner join cat_bodega cb on ed.codigo_bodega= cb.codigo_bodega
where ed.codigo_bodega=12 and ed.codigo_empresa=5 and ed.cantidad_entregada>=0 and d.iddireccion='$select1' and
CONVERT(varchar(20), fecha_documento, 120) >= '".$fechahora1."' and CONVERT(varchar(20), fecha_documento, 120) <= '".$fechahora2."' 
";
 //print($query);
print($select1);
}
	
	
				$do=mssql_query($query);
				$i = 0;									
				$tmp = 0;
		

								
				while($vector = mssql_fetch_row($do))
				{	
					$err = 0;
		
					include("css/format_table.php");									
echo '<tr align="center" class='.$clase.'><td colspan="2">'.$vector[0].'</td><td>'.$vector[1].'</td><td>'.$vector[2].'</td><td>'.$vector[3].'</td><td>'.$vector[4].'</td><td align="left">'.$vector[5].'</td><td>'.$vector[6].'</td><td>'.$vector[7].'</td><td>'.$vector[9].'</td></tr>';										
					$tmp++;
					$i++;
					
				}				
				mssql_free_result($do);
?>

<!--<td>'.$vector[9].'</td><td>'.$vector[10].'</td><td>'.$vector[11].'</td><td>'.$vector[12].'</td>-->
		</td>
      <td width="3%"></tbody>
  </table>
</div>
  <p>&nbsp;</p>
  
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
            
</body>

</html>

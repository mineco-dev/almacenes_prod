<?		
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
	
?>





<html>
<head>
<style type="text/css">
	.tres a {
		font-family:  Arial;
		font-size: 12px;
		font-weight: 900;
		background-color: #93C6F9;		
		text-decoration: none;
		color: #000000;
		border-top-width: 3px;
		border-right-width: 3px;
		border-bottom-width: 3px;
		border-left-width: 3px;
		border-top-style: solid;
		border-right-style: solid;
		border-bottom-style: solid;
		border-left-style: solid;
		border-top-color: #E9E9E9;
		border-right-color: #666666;
		border-bottom-color: #666666;
		border-left-color: #E9E9E9;
	}
	.tres a:hover {
		font-family:  Arial;
		font-size: 12px;
		font-weight: 900;
		background-color: #449DF6;
		text-decoration: none;
		color: FFFFFF;
		border-top-width: 3px;
		border-right-width: 3px;
		border-bottom-width: 3px;
		border-left-width: 3px;
		border-top-style: solid;
		border-right-style: solid;
		border-bottom-style: solid;
		border-left-style: solid;
		border-top-color: #999999;
		border-right-color: #E9E9E9;
		border-bottom-color: #E9E9E9;
		border-left-color: #999999;
	}
	</style>
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
              <td width="72%"><div align="center" class="legal1">Tarjeta de Kardex de Almacen</div></td>
              
              <td width="15%"><div align="center"><img src="mineco.JPG" width="107" height="113"></div></td>
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
				//echo 'Reporte del '.$cboDiai.'/'.$cboMesi.'/'.$cboAnioi.' al '.$cboDiaf.'/'.$cboMesf.'/'.$cboAniof;
		
	


		
		?>
        <?PHP	print($categoria. ' - ');print($subcategoria. ' - ');print($producto. '');?>
        </td>
              <td>&nbsp;</td>
            </tr>
          </table>
          </div></td>
      </tr>
    </table>
    
  
	
	<form name="modificar_usuario" method="POST" action="modificar_assegiz.php">
<table class="tborder" cellpadding="2" cellspacing="1" border="0" width="100%" id="table17">     
      <tr>
        <td colspan="2"></thead>
    <tr align="center" bgcolor="#006699" class="boxTitleBgLightBlue">
          <td colspan="2"><strong>Fecha</strong></td>
          <td width="7%"><strong>Tipo Mov</strong></td>
      <td width="6%"><strong>No. Desp</strong></td>
	  <td width="6%"><strong>No. Ingre</strong></td>
	  <td width="6%"><strong>Entrada</strong></td>
      <td width="6%"><strong>Salida</strong></td>
          <td width="6%"><strong>Saldo</strong></td>
          <td width="5%"><strong>Promedio</strong></td>
          <td width="6%"><strong>Factura</strong></td>
          <td width="7%"><strong>Mov</strong></td>
          <td width="6%"><strong>Ext</strong></td>
		  <td width="6%"><strong>Actualizar</strong></td>
      <td width="32%"><strong>Dependencia</strong></td>
	  
    
	  
         
</tr>
<?				



/*$query = "select CONVERT(nvarchar(10), t.fechahora, 103) as fecha,
CONVERT(nvarchar(10), t.fechahora, 108) as hora, 
t.nombre as solicitante,
		t.pregunta,t.idsolicitud,t.telefono,p.pais						
from
	tbl_solicitud t, tbl_pais p
	where 
year(t.fechahora) >= '$cboAnioi' and month(t.fechahora) >= '$cboMesi' and day(t.fechahora) >= '$cboDiai'
and year(t.fechahora) <= '$cboAniof' and month(t.fechahora) <= '$cboMesf' and day(t.fechahora) <= '$cboDiaf'
and t.idpais = p.idpais 
order by t.fechahora desc";*/



/*
$query = "select CONVERT(nvarchar(10), t.fechahora, 103) as fecha,
						CONVERT(nvarchar(10), t.fechahora, 108) as hora, 
						t.nombre as solicitante,
						t.pregunta,t.idsolicitud,t.telefono,p.pais
						
 from
	tbl_solicitud t, tbl_pais p
	where 
	fechahora >= '$fecha1h' and fechahora <= '$fecha2h' and t.idpais = p.idpais 
 order by fechahora desc";*/
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
 
 $query = "use almacen_nuevo 
select CONVERT(nvarchar(10), k.fecha, 103) as fecha,
CONVERT(nvarchar(10), k.fecha, 108) as hora,
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
 d.nombre,
 codigo_kardex
 from tb_kardex k
inner join cat_tipo_movimiento m
on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
inner join direccion d
on k.id_dependencia = d.iddireccion
	where 
	CONVERT(varchar(20), k.fecha, 120) >= '".$fechahora1."' and CONVERT(varchar(20), k.fecha, 120) <= '".$fechahora2."' 
 and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = ".$_SESSION["empresax"]." and codigo_bodega = 8 
order by codigo_kardex asc";
 //print($query);

?>
<?PHP
}
	
	
				$do=mssql_query($query);
				$i = 0;									
				$tmp = 0;
		
 if( $do === false) {
    die( print_r( mysql_error(), true) );
	}
								
				while($row = mssql_fetch_array($do))
				{	
					$err = 0;
					
						
					include("css/format_table.php");
					
					echo '<tr class='.$clase.'><td colspan="2">'
													 
						?>
						<?php echo $row['fecha'];?></td>
						<td><?php echo $row['tipo_movimiento'];?></td>
                        <td><?php echo $row['no_despacho'];?></td>
                        <td><?php echo $row['no_ingreso'];?></td>
						<td><?php echo $row['entrada'];?></td>
						<td><?php echo $row['salida'];?></td>
						<td><?php echo $row['saldo'];?></td>
						<td><?php echo $row['costo_promedio'];?></td>
						<td><?php echo $row['costo_factura'];?></td>
						<td><?php echo $row['costo_movimiento'];?></td>
						<td><?php echo $row['costo_total'];?></td>
						<td><center><div class="tres"><a href="modificar_assegiz.php?id=<?php echo $row['codigo_kardex'];?>&dep=<?php echo $row['no_despacho'];?>&ing=<?php echo $row['no_ingreso'];?>">Modificar</a></div></center></td>
						<td><?php echo $row['nombre'];?></td>
							
						
							
							</tr>

<?php } ?>

		<td width="5%"></td>
      <td width="2%"></tbody><?PHP
	  	
	  ?>
	  
  </table>
  </form>
 

  <p>&nbsp;</p>
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
		
           
</body>
</html>
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>-->
<style type="text/css">

<!--
.Estilo14 {font-size: 6px;  font-family: Arial, Helvetica, sans-serif;}
.Estilo15 {font-size: 10px;  font-family: Arial, Helvetica, sans-serif;}

-->
</style>
<style>
#divc { max-height: 5px }

</style>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="datatable/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="datatable/css/dataTables.responsive.min.js">


<script type="text/javascript" language="javascript" src="datatable/js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="datatable/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="datatable/js/dataTables.responsive.min.js"></script>

<style>
header, footer, nav, aside {
  display: none;
}
</style>

<style>


#dt {
    font-size: small;
    font-style: normal;
    color: -internal-quirk-inherit;
    text-align: start;
     border: 1px solid black;
}

#dt th {    
	 border: 2px solid black;
	background-color: 	#cde;
	text-align: center;
}#dt td {    
       text-align: ceter;
	font-size: 80%;
    font-family: Arial, Helvetica, sans-serif;
	padding: 0px 5px 0px;
	 border: 1px solid gray;
}





</style>


</head>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<div align="left" class="boxBgWhite45">
 <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
      <tr>
        <td><div align="center">
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="13%"></td>
              <!--<td width="72%"><div align="center" class="legal1">Tarjeta de Kardex de Almacen Compra General</div></td>-->
			  
              <!--<td width="15%"><div align="center"><img src="mineco.JPG" width="107" height="113"></div></td>-->
            </tr>
            <tr>
              <td colspan="3">Codigo Articulo
              <?PHP 
			  
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
		
	

print($categoria); echo ' - '; print($subcategoria);  echo ' - ';	print($producto);
		
		?></td>
              <td>&nbsp;</td>
            </tr>
          </table>
          </div></td>
      </tr>
  </table>

	 <div id="divc">
 <table id="dt" class="display compact nowrap" cellspacing="0" width="10%">
    <thead>
	<tr>
	<td style="border: 0px solid; border-color: #00FF00;" colspan="4"></td>
	<td style="border: 3px solid; border-color: #000000;" colspan="3"><center>UNIDADES</center></td>
	<td style="border: 0px solid; border-color: #00FF00;" colspan="4"> <center>    SALDO INICIAL     <input type="NUMBER" size="6"> </center></</td>
	</tr>
    <tr >
	          <th>Fecha</th>
          <th>Tipo Mov</th>
      <th>No. Desp</th>
	  <th>No. Ingre</th>
	  <th>Entrada</th>
      <th>Salida</th>
	   <th>Saldo</th>
          <th>Promedio</th>
          <th>Factura</th>
          <th>Mov</th>
          <th>Ext</th>
      <th>Proveedor/Dependencia</th>
 </tr>
 <tr>
	<td colspan="5">Viene de la tarjeta No. <input type="number" align="center"/></td>
	<td></td>
	<td></td>
	<td></td>
	<td ><center></center></td>
	<td></td>
	<td></td>
	<td></td>
	
	</tr>
	  </thead>
	  <tbody>
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
 d.nombre
 from tb_kardex k
inner join cat_tipo_movimiento m
on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
inner join direccion d
on k.id_dependencia = d.iddireccion
	where 
	CONVERT(varchar(20), k.fecha, 120) >= '".$fechahora1."' and CONVERT(varchar(20), k.fecha, 120) <= '".$fechahora2."' 
 and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = ".$_SESSION["empresax"]." and codigo_bodega = ". $_SESSION["bodega15"] . " 
 order by codigo_kardex asc";
 


print($fechahora1);
print($fechahora2);
 $consulta=mssql_query("select producto from dbo.cat_producto  where codigo_producto = $producto and codigo_categoria = $categoria and codigo_subcategoria = $subcategoria and  activo = 1");
 

	while($registro=mssql_fetch_row($consulta))
	{
		echo "<center>  Articulo: ".$registro['0']." </center>";
	}
 

 
 
 //print($query);

}
	
	
	
	
				$do=mssql_query($query);
				$i = 0;									
				$tmp = 0;
		

								
				while($vector = mssql_fetch_row($do))
				{	
					$err = 0;
		
					include("css/format_table.php");									
echo  '<tr ><td height="5">'.$vector[0].'</td><td height="5">'.$vector[2].'</td><td height="5">'.$vector[3].'</td><td height="5">'.$vector[4].'</td><td height="5">'.$vector[5].'</td><td height="5">'.$vector[6].'</td><td height="5">'.$vector[7].'</td><td height="5"> Q'.$vector[8].'</td><td height="5">'.$vector[9].'</td><td height="5"> Q'.$vector[10].'</td><td height="5"> Q'.$vector[11].'</td><td height="5">'.$vector[12].'</td></tr>';		
					echo"";		                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
					$tmp++;
					$i++;
					
				}				
				mssql_free_result($do);
?>

		</tbody>
            
  </table>
  </div>
  
  <script>

  $(document).ready(function(){
	  
	  
	  
    $('#dt').DataTable( {
        "pagingType": "simple",
		"searching": false,
		 "ordering": false,
		"lengthChange": false,
		"autoWidth": false,
		 "pageLength": 36,
		  "responsive": false,
		  "language": {
            "url": "datatable/json/Spanish.json"
			
        }
		  
		   		  
		  
		
    } );
	
	

	
	
	               
});

</script>


  

<!--  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;van a la tarjeta No.</p> --> 
</div>
<!-- /forum rules and admin links -->
<br />
			<div align="left"></div>
			
			
            
</body>

</html>

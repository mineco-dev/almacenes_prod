<?php 
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
	include('mpdf60/mpdf.php');
	ob_start();
	session_start();


$cboDiai = $_POST['cboDiai'];
$cboMesi = $_POST['cboMesi'];
$cboAnioi = $_POST['cboAnioi'];
$cboDiaf = $_POST['cboDiaf'];
$cboMesf = $_POST['cboMesf'];
$cboAniof = $_POST['cboAniof'];
$select1 = $_POST['select1'];
$select2 = $_POST['select2'];
$select3 = $_POST['select3'];


$cboDiai = 01;
$cboMesi = 10;
$cboAnioi = 2017;
$cboDiaf = 30;
$cboMesf = 10;
$cboAniof = 2017;
$select1 = 211;
$select2 = 1400;
$select3 = 1;



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


	
	$template = '

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

<body>


<div class="container">

	<table style="width:100%;" cellpadding="0" cellspacing="0"> 
		<tr>
			<td>
				<div style="text-align">
					<table>
					<tr>
						<td style="width:13%"></td>
					</tr>
					<tr>
						<td>Codigo Articulo
						211 - 1400 - 1';

							//print($categoria); echo ' - '; print($subcategoria);  echo ' - ';	print($producto);
						$template.='
					</td>
					</tr>
					</table>
				</div>
			</td>
		</tr>
	</table>

	<div id="divc ">
 		<table id="dt" class="table display compact nowrap" style="width:100%"  cellspacing="0">
    		<thead><tr>
	    			<td style="border: 0px solid; border-color: #00FF00;" colspan="4"></td>
					<td style="border: 3px solid; border-color: #000000;" colspan="3"><center>UNIDADES</center></td>
					<td style="border: 0px solid; border-color: #00FF00;" colspan="4"> <center>    SALDO INICIAL     <input type="NUMBER" size="6"> </center></</td>
					</tr>
				    <tr>
				    	  <th>Fecha</th>
					      <th>Tipo Mov.</th>
					      <th>No. Desp.</th>
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
			</thead>
			<tbody>';


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
 
 $query = "use almacen_nuevo 
select CONVERT(nvarchar(10), k.fecha, 103) as fecha, CONVERT(nvarchar(10), k.fecha, 108) as hora, 
m.tipo_movimiento, k.no_despacho, k.no_ingreso, k.entrada, k.salida, k.saldo, k.costo_promedio, 
k.costo_factura, costo_movimiento, costo_total, d.nombre from tb_kardex k inner join cat_tipo_movimiento m 
on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento inner join direccion d on k.id_dependencia = d.iddireccion 
where CONVERT(varchar(20), k.fecha, 120) >= '2017-10-01 00:00:00' and CONVERT(varchar(20), k.fecha, 120) <= '2017-10-30 24:59:59' 
and k.codigo_producto = 1 and k.codigo_categoria = 211 and k.codigo_subcategoria = 1400 and codigo_empresa = ".$_SESSION["empresax"]." 
and k.codigo_bodega = ". $_SESSION["bodega15"] . " and k.activo=1 order by codigo_kardex asc";
  $consulta=mssql_query("select producto, mit.unidad_medida from dbo.cat_producto as pro inner join cat_medida as mit on mit.codigo_medida=pro.codigo_medida   where codigo_producto = $producto and codigo_categoria = $categoria and codigo_subcategoria = $subcategoria and  pro.activo = 1");
 

	
	while($registro=mssql_fetch_row($consulta))
	{
		$template .= '<center>  Articulo: '; $template .=$registro['0']; $template .=' - '; $template .=$registro['1']; $template .=' </center>';
	}
	
}


$do=mssql_query($query);
				$gt=0;
				$i = 0;									
				$tmp = 0;
				$k=array();
		

								
				while($vector = mssql_fetch_row($do))
				{	
					$err = 0;
					
			$cantidad=$vector[7]*$vector[8];
			
			
					include("css/format_table.php");
					if($i==0){
					
						$template .= '<tr style="background-color:#EBEBEB"><td >VIENEN DE LA TARJETA NO.</td><td height="5"><input type="number"></td><td height="8"></td><td height="8"></td><td height="8"></td><td height="8"></td><td height="8"></td><td height="8"></td><td height="8"> </td><td height="8"></td><td height="8"></td><td height="8"></td></tr>';				
						}					
					
						$template .=  '<tr style="height:17px;"><td height="8">'; $template .=$vector[0]; $template .='</td><td height="8">'; $template .=$vector[2]; $template .='</td><td height="8">';$template .=$vector[3]; $template .='</td><td height="8">'; $template .=$vector[4]; $template .='</td><td height="8">'; $template .=$vector[5]; $template .='</td><td height="8">'; $template .=$vector[6]; $template .='</td><td height="8">'; $template .=$vector[7]; $template .='</td><td height="8"> Q'; $template .=$vector[8]; $template .='</td><td height="8">'; $template .=$vector[9]; $template .='</td><td height="8"> Q'; $template .=$vector[10]; $template .='</td><td height="8"> Q'; $template .=$vector[11]; $template .='</td><td height="8">'; $template .=$vector[12]; $template .='</td></tr>';		
						$template .="";	
					
					if(($i+1) % 36 == 0)
					{
											
										
										
											$template .=  '<tr style="background-color:#EBEBEB"><td >VAN A LA TARJETA NO.</td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5">'; $template .=$vector[7]; $template .='</td><td height="5"> Q'; $template .=$vector[8]; $template .='</td><td height="5"></td><td height="5"> </td><td height="5"> Q'; $template .=$vector[11]; $template .='</td><td height="5"></td></tr>';	
											
											$template .=  '<tr style="background-color:#EBEBEB"><td >VIENEN DE LA TARJETA NO.</td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5">'; $template .=$vector[7]; $template .='</td><td height="5">Q'; $template .= $vector[8]; $template .='</td><td height="5"> </td><td height="5"></td><td height="5">Q'; $template .=$vector[11]; $template .='</td><td height="5"></td></tr>'; 
										}

					
					$template .='<tr style="background-color:#EBEBEB"><td >VAN A LA TARJETA NO.</td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5"></td><td height="5">'; $template .= $vector[7]; $template .='</td><td height="5"> Q'; $template .=$vector[8]; $template .='</td><td height="5"></td><td height="5"></td><td height="5"> Q'; $template .=$vector[11]; $template .='</td><td height="5"></td></tr>';	
					$i++;
				}	
						
				mssql_free_result($do);
		$template .='
		</tbody>
		</table>
	</div>
</div>
</body>
	';

echo $template;
//  $pdf = new mPDF('L','A4-L');
//  //$css = file_get_contents('bootstrap/css/bootstrap.css');
//  $pdf->charset_in='windows-1252';
//  $pdf->setFooter("Page {PAGENO} of {nb}");
//  //$pdf->writeHTML($css,1);
//  $pdf->writeHTML($template);
	
// $filename = 'Solicitud No ';
	
//  $filename .= '.pdf';
//  $pdf->output($filename,'F',true);
//  $pdf->output($filename,'I',true);
 //exit;

?>
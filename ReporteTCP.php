<?php 
header('Content-Type: text/html; charset=utf-8');
ob_start();
session_start();
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
    
	


 $cboDiai = $p1;
 $cboMesi = $p2;
 $cboAnioi = $p3;
 $cboDiaf = $p4;
 $cboMesf = $p5;
 $cboAniof = $p6;
 $select1 = $p7;
 $select2 = $p8;
 $select3 = $p9;



$categoria = $select1;
$subcategoria =  $select2;
$producto = $select3;

// $cboDiai = 01;
// $cboMesi = 10;
// $cboAnioi = 2017;
// $cboDiaf = 30;
// $cboMesf = 10;
// $cboAniof = 2017;
// $select1 = 211;
// $select2 = 1400;
// $select3 = 1;


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
conectardb($almacen);
	 $query = "SELECT
			ROW_NUMBER() OVER(ORDER BY codigo_kardex asc) AS Row,  
			CONVERT(nvarchar(10), k.fecha, 103) as fecha,
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
			 and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = ".$_SESSION["empresax"]." and k.codigo_bodega = ". $_SESSION["bodega15"] . " and k.activo=1 
			 order by codigo_kardex asc";


 $consulta=mssql_query("select producto, mit.unidad_medida from dbo.cat_producto as pro inner join cat_medida as mit on mit.codigo_medida=pro.codigo_medida   where codigo_producto = $producto and codigo_categoria = $categoria and codigo_subcategoria = $subcategoria and  pro.activo = 1");


$QueryRow ="SELECT
	 	COUNT(codigo_kardex) as cantidad
		from tb_kardex k
		inner join cat_tipo_movimiento m
		on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
		inner join direccion d
		on k.id_dependencia = d.iddireccion 
		where 
			CONVERT(varchar(20), k.fecha, 120) >= '".$fechahora1."' and CONVERT(varchar(20), k.fecha, 120) <= '".$fechahora2."' 
		and k.codigo_producto = $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = ".$_SESSION["empresax"]." and k.codigo_bodega = ". $_SESSION["bodega15"] . " and k.activo=1 
		";

$cantidad=mssql_query($QueryRow);

while ($filas = mssql_fetch_row($cantidad)) {
	$countRows = $filas[0];
}


$do=mssql_query($query);


$array = array();
$a = 0;		
while($vector = mssql_fetch_array($do))	
		{
					
            $array[$a] = $vector;
            $a++;		
									
        }

$cantidadHojas = (int)($countRows /24)+1;



//while($page=mssql_fetch_row($do))
//	{}
		//$rows = $registro[0];
	


while($registro=mssql_fetch_row($consulta))
		{
			$DesProducto .= '<span >';
			$DesProducto .= $registro['0'];
			$DesProducto .= " - ";
			$DesProducto .= utf8_encode($registro['1']);
			$DesProducto .= '</span>'; 
		}
	

//print($cantidadHojas);
$template = '

<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<style>

	.kardex{
		text-align: center;
		font-size: 14px;
		color: #fff;
	}



.codigoA{
    font-weight: bold;
	padding-left: 150px !important;
	padding-top:10px !important;
	width:25%;
}

.Producto{
	font-weight: bold;
	padding-left: 150px !important;
	padding-top:10px !important;

}

.table th,
.table td {
  vertical-align: top;
  border-top: 1px solid #fff !important;
  border-buttom:1px solid #fff !important;

  
}

.table th{
	color:#fff;
	border:1px solid #fff !important;
}
.table td{
	padding:0.1rem 0rem 0.1rem 0;

}


.head{
	font-size: 12px;
	text-align: center;
	width:7%;
}
.content{
    font-size: 12px;
	text-align: left;
}


.contentPro{
	font-size: 9px;
	width:20%;
	text-align: center;
}
</style>

<page>
';

while ($Phoja < $cantidadHojas ) {
	//print((int)($rows/24)+1);
	//echo($countRows);

		$template .='
		<div class="container">

					<table class="table">
						<tr class="fila">
							<td class="td"></td>
							<td class="kardex">DIRECCIÓN DE ATENCION Y ASISTENCIA AL CONSUMIDOR <br>-DIACO- <br>TARJETA KARDEX DE ALMACEN</td>
							<td class="td"></td>
						</tr>
					</table>

					<table  class="table"  >
						<tr>
							<td class="codigoA">';
								$template .= $categoria; 
								$template .=  ' - '; 
								$template .=  $subcategoria;  
								$template .=  ' - ';	
								$template .=  $producto;
								$template .='	
											</td>
											<td class="Producto" >';
											$template .= $DesProducto;
													
								$template .='
											</td>
										</tr>
					</table>';
					
					$template .= '<table  style="margin-top:60px;"   class="table">
										<thead>
											<tr>
												<th class="head">Fecha</th>
												<th class="head">Tipo</th>
												<th class="head">No.D</th>
												<th class="head">No.i</th>
												<th class="head">Entrada</th>
												<th class="head">Salida</th>
												<th class="head">Saldo</th>
												<th class="head">Costop</th>
												<th class="head">Costof</th>
												<th class="head">Costotm</th>
												<th class="head">Costote</th>
												<th class="head">Pro</th>
											</tr>
										</thead>
										<tbody>';

							$p = 24	;
							while ($c < $countRows) {
								if ($x <= $p) {
								echo $template .= $array[10]['fecha'];$template .='<br>';
									
								}
								
								$x++;
								$c++;
								
						
							}
										
								
							
						
				 					

								
								//mssql_free_result($do);	
								$template .= '</tbody>

					</table>
					</div>'	;
					
					$Phoja++;
					

			
	}
	
					$template .='
	</page>
	';


//}




 //print $template;

	  // include('mpdf60/mpdf.php');
	  // $pdf = new mPDF('L','A4-L');
	  // //$css = file_get_contents('bootstrap/css/bootstrap.css');
	  // $pdf->charset_in='UTF-8';

	  // $pdf->setFooter("Page {PAGENO} of {nb}");
	  // //$pdf->writeHTML($css,1);
	  // $pdf->writeHTML($template);
	
	  // $filename = 'Solicitud No. ';
	
	  // $filename .= '.pdf';
	  // $pdf->output($filename,'F',true);
	  // $pdf->output($filename,'I',true);
	  // exit;

	 echo $template;
// $template = mb_convert_encoding($template,'UTF-8', 'windows-1252');
// require_once('dompdf/pdf/dompdf_config.inc.php');
// $dompdf = new DOMPDF();
// $dompdf ->set_paper("legal", "landscape");
// $dompdf ->load_html($template);
// $dompdf ->render();
// $dompdf ->stream("ACTA.pdf", array("Attachment" => false));





 ?>
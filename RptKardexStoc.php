<?php
header('Content-Type: text/html; charset=utf-8');
setlocale(LC_MONETARY, 'en_US');
session_start();
ob_start();
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
// $select2 = 1300;
// $select3 = 1;
// $categoria = $select1;
// $subcategoria =  $select2;
// $producto = $select3;

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
			('Q ' + convert(varchar(50),convert(varchar,CAST(k.costo_promedio as money),1))) as costo_promedio, 
			('Q ' + convert(varchar(50),convert(varchar,CAST(k.costo_factura as money),1))) as costo_factura, 
			('Q ' + convert(varchar(50),convert(varchar,CAST(costo_movimiento as money),1))) as costo_movimiento,
			('Q ' + convert(varchar(50),convert(varchar,CAST(costo_total as money),1))) as costo_total, 
			d.nombre
			from tb_kardex k
			inner join cat_tipo_movimiento m
			on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
			inner join direccion d
			on k.id_dependencia = d.iddireccion 
				where 
				convert(varchar(20),k.fecha, 120)  between  '".$fechahora1."' and '".$fechahora2."' 
				
			 and k.codigo_producto = $producto  and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = ".$_SESSION["empresax"]." and k.codigo_bodega = ". $_SESSION["bodega15"] . " and k.activo=1 
			 order by codigo_kardex asc";

			 //CONVERT(varchar(20), k.fecha, 120) >= '".$fechahora1."' and CONVERT(varchar(20), k.fecha, 120) <= '".$fechahora2."' 

 $consulta=mssql_query("select producto, mit.unidad_medida from cat_producto as pro inner join cat_medida as mit on mit.codigo_medida=pro.codigo_medida   where codigo_producto = $producto  and codigo_categoria = $categoria and codigo_subcategoria = $subcategoria and  pro.activo = 1");


$QueryRow ="SELECT
	 	COUNT(codigo_kardex) as cantidad
		from tb_kardex k
		inner join cat_tipo_movimiento m
		on m.codigo_tipo_movimiento = k.codigo_tipo_movimiento
		inner join direccion d
		on k.id_dependencia = d.iddireccion 
		where 
			CONVERT(varchar(20), k.fecha, 120) >= '".$fechahora1."' and CONVERT(varchar(20), k.fecha, 120) <= '".$fechahora2."' 
		and k.codigo_producto =  $producto and k.codigo_categoria = $categoria and k.codigo_subcategoria = $subcategoria and codigo_empresa = ".$_SESSION["empresax"]." and k.codigo_bodega = ". $_SESSION["bodega15"] . " and k.activo=1 
		";

$cantidad=mssql_query($QueryRow);

while ($filas = mssql_fetch_row($cantidad)) {
	$countRows = $filas[0];
}


$do=mssql_query($query);

//$cantidadHojas = (int)($countRows /29)+1;
$cantidadHojas = ceil($countRows /30); 



while($registro=mssql_fetch_row($consulta))
		{
			$DesProducto .= '<span >';
			$DesProducto .= $registro['0'];
			$DesProducto .= " - ";
			$DesProducto .= utf8_encode($registro['1']);
			$DesProducto .= '</span>'; 
		}
      
while($vector = $fetch_array($do))	
	{
		$row[] = $vector['Row'];
		$fecha[] = $vector['fecha'];
		$movimiento[] = $vector['tipo_movimiento'];
		$despacho[] = $vector['no_despacho'];
		$ingreso[] = $vector['no_ingreso'];
		$entrada[] = $vector['entrada'];
		$salida[] = $vector['salida'];
		$saldo[] = $vector['saldo'];
		$costo_promedio[] = $vector['costo_promedio'];
		$costo_factura[] = $vector['costo_factura'];
		$costo_movimiento[] = $vector['costo_movimiento'];
		$costo_total[] = $vector['costo_total'];
		$nombre[] = $vector['nombre'];

                    }	
$Phoja = 0;	
    $html = '<!DOCTYPE html>
<html lang="en">
<head>

	
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
<style>

@page {
	size: 11in 8.6in;
 	margin-top:0.6cm;
 	margin-left:0.5cm;
  
 
}
	.kardex{
		text-align: center;
		font-size: 14px;
        color: #fff;
        border:1px solid #fff;
	}

    .td{
        border:1px solid #fff;
        width:25%;
    }


.codigoA{
    font-weight: bold;
	width:25%;
	padding-left: 140px !important;
}

.Producto{
	font-weight: bold;
	font-size:10px;
	text-align: justify;
	width:45%;
	padding-left: 90px !important;

}

.container{
	width:102% !important;
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


.head,headMoney{
	font-size: 12px;
	text-align: center;
	width:6.2%;
}

.headMoney{
	width:5% !important;
}

.content{
    font-size: 12px;
	text-align: left;
}

.contentMoney{
	font-size: 9px;
	text-align: left;
	margin-left:-55px;
	
}

.contentPro{
	font-size: 10px;
	width:25%;
    text-align: center;
    font-wenight:bold;
}

.Paginacion{
	text-align: right;
	letter-spacing: 0.3em;
}

.Existencia{
	text-align: right;
	padding-right: 58px !important;
}
table.border td{
	border:1px solid #000 !important;
	border-top: 1px solid #000 !important;
  	border-buttom:1px solid #000 !important;

}
</style>
</head>
<body>';
 $SaldoInicial  = 0;
 $inicial = 0;
 $tamaño = 0;

do{

if ($Phoja > $cantidadHojas) {
	$html .= "";
}else{

$html .= '

<div class="container">
					<table class="table">
						<tr >
							<td class="td"></td>
							<td class="kardex">DIRECCIÓN DE ATENCION Y ASISTENCIA AL CONSUMIDOR <br>-DIACO- <br>TARJETA KARDEX DE ALMACEN</td>
							<td class="td"></td>
						</tr>
                    </table>
                    
</div>
<div class="container">
                    <table  class="table" style="padding-top: -13px;">
						<tr>
							<td class="codigoA" >';
								$html .= $categoria; 
								$html .=  ' - '; 
								$html .=  $subcategoria;  
								$html .=  ' - ';	
								$html .=  $producto;
								$html .='	
							</td>
							<td class="Producto"  >';
											$html .= $DesProducto;
													
								$html .='
							</td>
							<td class="Existencia">';
											if ($SaldoInicial == 0) {
												$html .=$inicial;
											}else{
												$html .=$saldo[$SaldoInicial];
											}
											 $html.='
							</td>
						</tr>
						<tr >
							    <td class="codigoA"></td>
								<td  colspan=2 class="Paginacion">';$html .= ($Phoja +1);
									 $html .='     '; 
									 if ($cantidadHojas == 0) {
										  $unica = 1; 
										  $html .= $unica;
									 }else{
										$html .= $cantidadHojas;
									 }
									 
									$html .='
								</td>
								';
								$html .='</td>
						</tr>
					</table>
</div>
<div class="container">';
                    
                    $html .= '<table      class="table border">
										<thead>
											<tr>
												<th class="head">Fecha</th>
												<th class="head">Tipo</th>
												<th class="head">No.D</th>
												<th class="head">No.i</th>
												<th class="head">Entrada</th>
												<th class="head">Salida</th>
												<th class="head">Saldo</th>
												<th class="headMoney">Costop</th>
												<th class="headMoney">Costof</th>
												<th class="headMoney">Costotm</th>
												<th class="headMoney">Costote</th>
												<th class="head">Pro</th>
											</tr>
										</thead>
										<tbody>';
                    $paso = $tamaño ;
					$tamaño = $tamaño +30;
					$SaldoInicial =  $tamaño -1 ;
                if ($Phoja < $cantidadHojas) {
                    while($paso < $tamaño){
					
						if (!empty($fecha[$paso])) {
							# code...
					

                        $html .= '
                            <tr>
                                
                                <td class="content">';$html .=$fecha[$paso];$html.='</td>
                                <td class="content">';$html .=$movimiento[$paso];$html.='</td>
                                <td class="content">';$html .=$despacho[$paso];$html.='</td>
                                <td class="content">';$html .=$ingreso[$paso];$html.='</td>
                                <td class="content">';$html .=$entrada[$paso];$html.='</td>
                                <td class="content">';$html .=$salida[$paso];$html.='</td>
                                <td class="content">';$html .=$saldo[$paso];$html.='</td>
                                <td class="contentMoney"> ';$html .= $costo_promedio[$paso];$html.='</td>
                                <td class="contentMoney"> ';$html .= $costo_factura[$paso];$html.='</td>
                                <td class="contentMoney"> ';$html .= $costo_movimiento[$paso];$html.='</td>
                                <td class="contentMoney"> ';$html .= $costo_total[$paso];$html.='</td>
                                <td class="contentPro">';$html .=$nombre[$paso];$html.='</td> 
						</tr>';
						}
						$paso++;
							
                        
                    }


                }
                    
								
                    $paso = 0;
								$html .= ' </tbody>

					</table>
</div>'	;

}
$Phoja++;
} while($Phoja < $cantidadHojas );

$html = mb_convert_encoding($html,'UTF-8', 'windows-1252');
require_once('dompdf/pdf/dompdf_config.inc.php');
$dompdf = new DOMPDF();
$dompdf ->set_paper("legal", "landscape");
//$dompdf ->set_paper(array(100,100,0,0));
$dompdf ->load_html($html);
$dompdf ->render();
$dompdf ->stream("Kardex.pdf", array("Attachment" => false));

$html .='

</body>
</html>';

//echo $html;
?>
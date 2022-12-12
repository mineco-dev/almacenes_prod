<?PHP
	require("../../../includes/funciones.php");
	require("../../../includes/sqlcommand.inc");
	ob_start();


	$hoja_ingreso=$_SESSION["hoja_ingreso"];

	$qry_ingreso_enc ="select CONVERT(nvarchar(10), e.fecha_ingreso, 103) as fecha_ingreso, 
	CONVERT(nvarchar(10), e.fecha_documento, 103) as fecha_documento,  e.numero_serie, convert(nvarchar(10), e.fecha_recepcion, 103) as fecha_recepcion,
	substring(e.observaciones,1,55) as observacion1,substring(e.observaciones,56, 2147483647)  as observacion2, e.codigo_ingreso_enc, e.solicitante, e.numero_documento, pro.nombre as proveedor
	from tb_ingreso_enc e  
	inner join tb_proveedor pro on
	e.codigo_proveedor = pro.rowid
	where codigo_ingreso_enc ='$hoja_ingreso'";
				conectardb($almacen);
				$res_ingreso_enc=$query($qry_ingreso_enc);
				while($row_ingreso_enc=$fetch_array($res_ingreso_enc))
				{
				 	$fecha_factura=$row_ingreso_enc["fecha_documento"];
					$observaciones1=$row_ingreso_enc["observacion1"];
					$observaciones2=$row_ingreso_enc["observacion2"];
					$codigo_ingreso_enc=$row_ingreso_enc["codigo_ingreso_enc"];
					$solicitante=$row_ingreso_enc["solicitante"];
					$programa=$row_ingreso_enc["programa"];
					$actividad=$row_ingreso_enc["actividad"];
					$proveedor=$row_ingreso_enc["proveedor"];
					$noserie=$row_ingreso_enc["numero_serie"];
					$nofactura=$row_ingreso_enc["numero_documento"];
					$fecha=$row_ingreso_enc["fecha_ingreso"];
					$fecha_recepcion=$row_ingreso_enc["fecha_recepcion"];
				}

$html = '
<!DOCTYPE html PUBLIC \'-//W3C//DTD XHTML 1.0 Strict//EN\' \'http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\'>
<html xmlns=\'http://www.w3.org/1999/xhtml\' xml:lang=\'es\' lang=\'es\'>
<head profile=\'http://gmpg.org/xfn/11\'>
	<meta http-equiv=\'Content-Type\' content=\'text/html; charset=UTF-8\' />
				<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
				<style>
					@page{ margin: 20px; }
					body { margin: 2px;font-family: serif; font-size: 10px; }
					p{ }
					.encabezado{
						
						height:30px;
					}
					.cantidad{
						width:80px;
						text-align:LEFT;
					}
					.descripcion{
						width:400px;
						text-align:justify;
						padding-top:10px;
						padding-botton:10px;
						padding-right:10px;
						height:auto;
						
					}
					.renglon{
						width:80px;
						text-align:center;
					}
					.precio{
						width:80px;
						text-align:center;
					}
					.valor{
						width:80px;
						text-align:center;
						padding-left:20px;
					}
					.observaciones{
						
						float: left;
		
					}
					.texta{
						
						text-align:justify;
						font-size:8px;
						
						
					}
				</style>
			</head>
			<body>
				<table  style="width: 97%; padding-top:100px; text-align: left; cellspacing: 10; " align="center">
					<tr >
					        <td width="50" height="30"></td>
					        <td width="192" valign="top"><span class="blue">'.$programa.'</span></td>
					        <td width="30">&nbsp;</td>
					        <td width="188" valign="top"><span class="blue" >'.$actividad.'</span></td>
					        <td width="5">&nbsp;</td>
					        <td width="116">&nbsp;</td>
					        <td width="29">&nbsp;</td>
					        <td width="172" valign="baseline"><span>'.substr($fecha_recepcion,0,12).'</span></td>
					</tr>
					<tr height="2px">
						<td ><br></td>
					</tr>
				    <tr>
				        <td >&nbsp;</td>
				        <td valign="top"><span class="blue">'.$proveedor.'</span></td>
				        <td>&nbsp;</td>
				        <td valign="bottom" ><span class="blue">'.$noserie.'   '.$nofactura.'</span> </td>
				        <td>&nbsp;</td>
				        <td ><span class="blue">'.substr($fecha_factura,0,12).'</span></td>
				        <td>&nbsp;</td>
				        <td >&nbsp;</td>
				    </tr>
				</table>
				<table style="width: 97%;max-height: 50px;padding-top:50px;border:1px solid #000;" >
					<tr> 
					        <td   class="encabezado"></td>
					        <td   class="encabezado"><span> </span></td>
					        <td   class="encabezado"></td>
					        <td   class="encabezado"><div align="left"></div></td>
					        <td   class="encabezado"><div align="left"></div></td>
					        <td   class="encabezado"></td>
					        <td   class="encabezado"></td>
					      </tr>

';

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

	  		$html .= '<tr><td class="cantidad"><span >'.$row_ingreso_det["cantidad_ingresada"].'</span></td>';
   			$html .= '<td class="descripcion"><span>'.$row_ingreso_det["codigo_categoria"].' '.$row_ingreso_det["codigo_subcategoria"].' '.$row_ingreso_det["codigo_producto"].'  -  '.$row_ingreso_det["descripcion"].'</span></td>';
			$html .= '<td class="renglon"><span>'.$row_ingreso_det["codigo_renglon"].'</span></td>';
			$html .= '<td class="precio"><span>Q '.number_format($row_ingreso_det["costo_unidad"],2).'</span></td>';
			$html .= '<td class="valor"><span>Q '.number_format($row_ingreso_det["Precio_total"],2).'</span></td></tr>';		
		
		}
		$free_result($res_ingreso_det);




		$qry_total = "select sum(Precio_total) as total from tb_ingreso_det
			where codigo_ingreso_enc = $codigo_ingreso_enc";

  		$res_ingreso_enc=$query($qry_total);
			while($row_ingreso_enc=$fetch_array($res_ingreso_enc))
			{
			 	
				$total=number_format($row_ingreso_enc["total"],2);	
			}

		$qry_total = "select observaciones as obs from tb_ingreso_enc
			where codigo_ingreso_enc = $codigo_ingreso_enc";

  		$res_ingreso_enc=$query($qry_total);
			while($row_ingreso_enc=$fetch_array($res_ingreso_enc))
			{
			 	
				$obs=$row_ingreso_enc["obs"];	
			}


$html .= '
    <tr> 
        
        <td   class="cantidad" ></td>
        <td   class="descripcion"><span> </span></td>
        <td   class="renglon"></td>
        <td   class="precio"><div></div></td>
        <td   class="valor"><div></div></td>
        <td width="143"></td>
        <td width="49" ></td>
    </tr>
    <tr> 
        
        <td   class="cantidad"></td>
        <td   class="descripcion"><span></span></td>
        <td   class="renglon"><span></span></td>
        <td   class="precio"><span>Total</span></td>
        <td   class="valor"><div><span>Q '.$total.'</span></div></td>
        <td width="143"></td>
        <td width="49"></td>
    </tr>
    </table>
    <table style="width:100%;font-size:8px;padding-top:15cm;position: absolute;">
    <tr > 
        <td class="texta"  >'.$obs.' </td>

    </tr>

';

$html .= '
				</table>
			</body>
		</html>
';


$html = mb_convert_encoding($html,'UTF-8', 'windows-1252');
include('../../mpdf60/mpdf.php');
$pdf = new mPDF('utf-8', array(216,279.4));
//$css = file_get_contents('../../../bootstrap/css/bootstrap.css');
$pdf->allow_charset_conversion=true;
$pdf->charset_in='UTF-8';
//$pdf->setFooter("Page {PAGENO} of {nb}");
//$pdf->writeHTMl($css,1);
$pdf->writeHTMl($html);
//$pdf->writeHTML('impre.pdf');
$pdf->output('impre.pdf','I',true);
exit;

?>


<?php
    session_start();
    ob_start();
	require("../../../includes/funciones.php");
	require("../../../includes/sqlcommand.inc");
			


	$hoja_ingreso=$_SESSION["hoja_ingreso"];

    

	$qry_ingreso_enc ="
    select  t.tipo_documento,CONVERT(nvarchar(10), e.fecha_ingreso, 103) as fecha_ingreso, 
	CONVERT(nvarchar(10), e.fecha_documento, 103) as fecha_documento,  e.numero_serie, convert(nvarchar(10), e.fecha_recepcion, 103) as fecha_recepcion,
	e.observaciones, e.codigo_ingreso_enc, e.solicitante, e.numero_documento, pro.nombre as proveedor, dp.nombre nombre_dependencia, cp.programa as programa, cat.actividad
	from tb_ingreso_enc e  
	inner join tb_proveedor pro on 	e.codigo_proveedor = pro.rowid
	inner join cat_tipo_documento t on 	t.codigo_tipo_documento = e.codigo_tipo_documento
	inner join direccion dp on dp.iddireccion= e.codigo_dependencia
	inner join cat_programa cp on cp.codigo_programa= e.codigo_programa
	inner join cat_actividad cat on cat.codigo_actividad= e.codigo_actividad and cat.codigo_programa= e.codigo_programa and cat.activo=1
	where codigo_ingreso_enc='$hoja_ingreso'";

    
				conectardb($almacen);
				$res_ingreso_enc=$query($qry_ingreso_enc);
				while($row_ingreso_enc=$fetch_array($res_ingreso_enc))
				{
                    $fecha_factura=$row_ingreso_enc["fecha_documento"];
                    
					$observaciones1=$row_ingreso_enc["observaciones"];
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
					$tipoDocumento = $row_ingreso_enc["tipo_documento"];
                    $nombreDependencia = $row_ingreso_enc["nombre_dependencia"];
                    

				}

$html = '

				<style>
                    
					@page{      margin-top: 7px;
							    margin-bottom: 50px;
							    margin-right: 2px;
							    margin-left: 24px;  }
					
					body { font-family: serif; font-size: 8px;font-weight: bold;  }
                    /*        
                    table{
                        table-layout: fixed;
                        
                    }*/

					.encabezado{
						
						height:30px;
					}
                    td{
                         word-wrap: break-word;

                        /*border: thin solid black;*/
                    }
					.cantidad{
						width:51px;
						text-align:left;
                        padding-left:5px;
                        
						
					}
					.descripcion{
						width: 330px;
						text-align:justify;
						padding-botton:10px;
						padding-right:10px;
						padding-left:15px;
                       
						
						
					}
					.des{
						/*width:30mm;*/
						text-align:justify;
						padding-top:10px;
						padding-botton:10px;
						padding-right:10px;
						height:5px;

						
						
					}
					.renglon{
						width:63px;
						text-align:center;
                       
                        
						
						
					}
					.precio{
						width:70px;
						text-align:left;
                        
						
					}
					.valor{
						/*width:7mm;*/
						text-align:left;
                        
						
					}
                    .valorvacio{
                        width:5mm;

                    }
					.valor2{
						width:1mm;
						text-align:center;
						
					}
					.observaciones{
						
						text-align:justify;
						font-size:8px;
						padding-right:10px;
						
						
		
					}
					.texta{
						
						padding-left:40px;	

					}
					.fecha{
						padding-left:-10px;
					}
					.tipo{
						
						padding-left:30px;
					}

				</style>
			
			<body>
				<table  style="width: 90% ; padding-top:105px; text-align: left; " align="center">
					<tr >
					        <td  width="50" height="20px"></td>
					        <td  width="202" class="texta" >'.	($programa).'</td>
					        <!--<td  width="30">&nbsp;</td> -->
					        <td  width="228" class="" >'.($actividad) .'</td>
					        <!--<td  width="5">&nbsp;</td>
					       	<td  width="5">&nbsp;</td>-->
					        <td  width="152"  class="texta"><span>'.substr($fecha_recepcion,0,12).'</span></td>
					</tr>
                    <tr>
                        <td  width="50" height="10px"></td>
                        <td  width="202" class="texta" ></td>
                        <td  width="198" class="texta" ></td>
                        <td  width="172" ><span></span></td>
				        <!--<td  class="fecha"></td>-->
				        
				        
				    </tr>
				
				    <tr>
                        <td  width="50" height="20px"></td>
                        <td  width="202" class="texta" >'.	strtoupper($proveedor).'</td>
                        <td  width="238" class="texta" >'.strtoupper($noserie) .' - '. strtoupper($nofactura) .'</td>
                        <td  width="172" class="texta" ><span>'.substr($fecha_factura,0,12).'</span></td>
				        <!--<td  class="fecha">'.substr($fecha_factura,0,12).'</td>-->
				        
				        
				    </tr>
				</table>
				<table style="width: 780px;padding-top:30px;" >
					<tr> 
					        <td   class="cantidad">&nbsp;</td>
					        <td   class="descripcion">&nbsp;</td>
					        <td   class="renglon">&nbsp;</td>
					        <td   class="precio">&nbsp;</td>
					        <td   class="valor">&nbsp;</td>
					        
					      </tr>

';


        $num = 0;
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

		
			$cantidad[] = $row_ingreso_det["cantidad_ingresada"];
            $descripcion[] = $row_ingreso_det["descripcion"];
   			$codigo[] = $row_ingreso_det["codigo_categoria"].' '.$row_ingreso_det["codigo_subcategoria"].' '.$row_ingreso_det["codigo_producto"];
			$renglon[] = $row_ingreso_det["codigo_renglon"];
			$costo[] = 'Q. '.number_format($row_ingreso_det["costo_unidad"],2);
			$precio[] = 'Q. '.number_format($row_ingreso_det["Precio_total"],2);
            $num++;
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
<td   class="descripcion"><spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam></td>
<td   class="renglon"></td>
<td   class="precio"></td>
<td   class="valor"></td>


</tr>


    <tr > 
        <td   class="cantidad" >'.$cantidad[0].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[0])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.($descripcion[0]).'</td>
        <td   class="renglon">'.$renglon[0].'</td>
        <td   class="precio">'.$costo[0].'</td>
        <td   class="valor">'.$precio[0].'</td>
        
        
    </tr>
    ';
    if ($cantidad[1]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[1].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[1])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[1].'</td>
        <td   class="renglon">'.$renglon[1].'</td>
        <td   class="precio">'.$costo[1].'</td>
        <td   class="valor">'.$precio[1].'</td>
        
        
    </tr>
    ';
    if ($cantidad[2]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[2].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[2])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[2].'</td>
        <td   class="renglon">'.$renglon[2].'</td>
        <td   class="precio">'.$costo[2].'</td>
        <td   class="valor">'.$precio[2].'</td>
        
        
    </tr>
    ';
    if ($cantidad[3]>0)
$html .= '
     <tr> 
        <td   class="cantidad" >'.$cantidad[3].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[3])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[3].'</td>
        <td   class="renglon">'.$renglon[3].'</td>
        <td   class="precio">'.$costo[3].'</td>
        <td   class="valor">'.$precio[3].'</td>
        
        
    </tr>
    ';
    if ($cantidad[4]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[4].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[4])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[4].'</td>
        <td   class="renglon">'.$renglon[4].'</td>
        <td   class="precio">'.$costo[4].'</td>
        <td   class="valor">'.$precio[4].'</td>
        
        
    </tr>
    ';
    if ($cantidad[5]>0)
$html .= '

    <tr> 
        <td   class="cantidad" >'.$cantidad[5].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[5])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[5].'</td>
        <td   class="renglon">'.$renglon[5].'</td>
        <td   class="precio">'.$costo[5].'</td>
        <td   class="valor">'.$precio[5].'</td>
        
        
    </tr>
    ';
    if ($cantidad[6]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[6].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[6])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[6].'</td>
        <td   class="renglon">'.$renglon[6].'</td>
        <td   class="precio">'.$costo[6].'</td>
        <td   class="valor">'.$precio[6].'</td>
        <td   class="valorvacio"></td>
        
    </tr>
    ';
    if ($cantidad[7]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[7].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[7])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[7].'</td>
        <td   class="renglon">'.$renglon[7].'</td>
        <td   class="precio">'.$costo[7].'</td>
        <td   class="valor">'.$precio[7].'</td>
        
        
    </tr>
    ';
    if ($cantidad[8]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[8].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[8])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[8].'</td>
        <td   class="renglon">'.$renglon[8].'</td>
        <td   class="precio">'.$costo[8].'</td>
        <td   class="valor">'.$precio[8].'</td>
        
        
    </tr>
    ';
    if ($cantidad[9]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[9].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[9])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[9].'</td>
        <td   class="renglon">'.$renglon[9].'</td>
        <td   class="precio">'.$costo[9].'</td>
        <td   class="valor">'.$precio[9].'</td>
        <td   class="valorvacio"></td>
        
    </tr>
    ';
    if ($cantidad[10]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[10].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[10])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[10].'</td>
        <td   class="renglon">'.$renglon[10].'</td>
        <td   class="precio">'.$costo[10].'</td>
        <td   class="valor">'.$precio[10].'</td>
        
        
    </tr>
    ';
    if ($cantidad[11]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[11].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[11])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[11].'</td>
        <td   class="renglon">'.$renglon[11].'</td>
        <td   class="precio">'.$costo[11].'</td>
        <td   class="valor">'.$precio[11].'</td>
        
        
    </tr>
    ';
    if ($cantidad[12]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[12].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[12])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[12].'</td>
        <td   class="renglon">'.$renglon[12].'</td>
        <td   class="precio">'.$costo[12].'</td>
        <td   class="valor">'.$precio[12].'</td>
        
        
    </tr>
    ';
    if ($cantidad[13]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[13].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[13])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[13].'</td>
        <td   class="renglon">'.$renglon[13].'</td>
        <td   class="precio">'.$costo[13].'</td>
        <td   class="valor">'.$precio[13].'</td>
        
        
    </tr>
    ';
    if ($cantidad[14]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[14].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[14])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[14].'</td>
        <td   class="renglon">'.$renglon[14].'</td>
        <td   class="precio">'.$costo[14].'</td>
        <td   class="valor">'.$precio[14].'</td>
        <td   class="valorvacio"&nbsp;></td>
        
    </tr>
    ';
    if ($cantidad[15]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[15].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[15])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[15].'</td>
        <td   class="renglon">'.$renglon[15].'</td>
        <td   class="precio">'.$costo[15].'</td>
        <td   class="valor">'.$precio[15].'</td>
        
        
    </tr>
    ';
    if ($cantidad[16]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[16].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[16])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[16].'</td>
        <td   class="renglon">'.$renglon[16].'</td>
        <td   class="precio">'.$costo[16].'</td>
        <td   class="valor">'.$precio[16].'</td>
        
        
    </tr>
    ';
    if ($cantidad[17]>0)
$html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[17].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[17])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[17].'</td>
        <td   class="renglon">'.$renglon[17].'</td>
        <td   class="precio">'.$costo[17].'</td>
        <td   class="valor">'.$precio[17].'</td>
        
        
    </tr>
    ';
    if ($cantidad[18]>0)
    $html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[18].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[18])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[18].'</td>
        <td   class="renglon">'.$renglon[18].'</td>
        <td   class="precio">'.$costo[18].'</td>
        <td   class="valor">'.$precio[18].'</td>
        
        
    </tr>
    ';
    if ($cantidad[19]>0)
    $html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[19].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[19])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[19].'</td>
        <td   class="renglon">'.$renglon[19].'</td>
        <td   class="precio">'.$costo[19].'</td>
        <td   class="valor">'.$precio[19].'</td>
        
        
    </tr>
    ';
    if ($cantidad[20]>0){
        $html .= '
    <tr> 
        <td   class="cantidad" >'.$cantidad[20].'</td>
        <td   class="descripcion">'  .utf8_encode($codigo[20])    .'<spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam>'.$descripcion[20].'</td>
        <td   class="renglon">'.$renglon[20].'</td>
        <td   class="precio">'.$costo[20].'</td>
        <td   class="valor">'.$precio[20].'</td>
        
        
    </tr>
    ';
    }
    
    
$html .= '

<tr> 
<td   class="cantidad" ></td>
<td   class="descripcion"><spam>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</spam></td>
<td   class="renglon"></td>
<td   class="precio"></td>
<td   class="valor"></td>


    <tr> 
        
        <td   class="cantidad"></td>
        <td   class="descripcion"><span>'.($obs).'</span></td>
        <td   class="renglon"><span></span></td>
        <td   class="precio"><span>Total</span></td>
        <td   class="valor" ><div><span>Q '.$total.'</span></div></td>
        
	</tr>
    </table>
            </body>
';




//include('../../mpdf60/mpdf.php');
  //  $pdf = new mPDF('L','A4');
    //$css = file_get_contents('bootstrap/css/bootstrap.css');
    //$pdf->charset_in='windows-1252';
    //$pdf->setFooter("Page {PAGENO} of {nb}");
    //$pdf->writeHTML($css,1);
    //$pdf->writeHTML("asdf");
    //$pdf->pdf->IncludeJS('print(TRUE)');
    //$filename = 'Solicitud No. ';
   // $filename .= $row['idSolicitud_Vehiculo'];
   // $filename .= '.pdf';
    //$pdf->output($filename,'F',true);
    //$pdf->output($filename,'I',true);
    //exit;




    //print($html);
  $html = mb_convert_encoding($html,'UTF-8', 'windows-1252');
require_once('../../dompdf/pdf/dompdf_config.inc.php');
$dompdf = new DOMPDF();
$dompdf ->set_paper("letter", "portrait");
//$dompdf ->set_paper("A4", "portrait");
$dompdf ->load_html($html);
$dompdf ->render();
$dompdf ->stream("ACTA.pdf", array("Attachment" => false));





?>


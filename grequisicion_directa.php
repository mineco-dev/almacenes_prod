<?PHP
	//session_start();
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	require_once('../includes/conectarse.php');
	//$tipo_reporte="rpt_despacho.php";
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<link href="../helpdesk.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
function Abrir_ventana(pagina) 
	{
		var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=700, height=400, top=85, left=140";
		window.open(pagina,"",opciones);
	}
</script>

<?PHP
/*if ($tipo_reporte!="") 
	{	
		echo "<body onload=Abrir_ventana('$tipo_reporte')>";
	}
	else 
	{
		echo "<body>";
	}
*/?><body>
<?PHP
if (isset($_SESSION["ingreso"]))
{
	conectardb($almacen);
	$solicitante=$nombre[0][2];
	$nombre_usuario=$_SESSION["user_name"];
	$observaciones=strtoupper($_REQUEST["observaciones"]);
	
	/////////////////////////////////// Verifica que esta hoja no se haya ingresado antes/////////////////////////////
	// Se puede implementar cuando en el almacen existan entregas parciales
	//$qry_consulta="select * from tb_ingreso_enc where codigo_tipo_documento='$cbo_tipo_docto' and numero_documento='$txt_no_ingreso' and numero_requisicion='$txt_numero_solicitud'";
	//$query($qry_consulta);

	/////////////////////////////////// consulta existencias //////////////////////////////////////////
   //session_register("hoja_requisicion");
  
  
  /* 
   $cnt=1; 		
   $saldo=true;
   while($cnt<=count($bien))
		{			
							
		$codigo = $bien[$cnt][4];		
        $solicitado = $cantidad_solicitada[$cnt];
		//print($solicitado);
		//$codigoproducto = $bien[$cnt][0];	
		//$categoria = $bien[$cnt][5];	
		//$subcategoria = $bien[$cnt][6];	
		////// consulta codigo de categoria, subcategoria, producto y bodega, segun id del producto que trae		
     	$qry_x_rowid_producto="select * from tb_inventario where rowid = '$codigo'";
		//print($qry_x_rowid_producto);
		$res_rowid_producto=$query($qry_x_rowid_producto);
		while($rowid=$fetch_array($res_rowid_producto))
		{
			$cproducto[$cnt]=$rowid["codigo_producto"];
			print($cproducto[$cnt]);
			$ccategoria[$cnt]=$rowid["codigo_categoria"];
			$csubcategoria[$cnt]=$rowid["codigo_subcategoria"];
			
			$cbodega[$cnt]=$rowid["codigo_bodega"];
			$cempresa[$cnt]=$rowid["codigo_empresa"];
				
		}		
		
		/////// fin de consulta codigo de categoria, subcategoria, producto y bodega, segun id del producto que trae
			 	
				//$diferencia_comprometida=$row["existencia"]-$row["cantidad_comprometida"];
						
			$qry_consulta_exist="select i.existencia, (p.producto +' '+ p.marca) as producto, i.codigo_producto, i.codigo_categoria, i.codigo_subcategoria, i.codigo_bodega, i.codigo_empresa from tb_inventario i 
								 inner join cat_producto p on i.codigo_producto=p.codigo_producto and i.codigo_categoria=p.codigo_categoria and i.codigo_subcategoria=p.codigo_subcategoria
								 where (i.codigo_empresa='$cempresa[$cnt]' and i.codigo_bodega='$cbodega[$cnt]' and i.codigo_producto='$cproducto[$cnt]' and i.codigo_categoria='$ccategoria[$cnt]' and i.codigo_subcategoria='$csubcategoria[$cnt]' and existencia < '$solicitado')";
			//print($qry_consulta_exist);
			$res_consulta_exist=$query($qry_consulta_exist);
			while($row=$fetch_array($res_consulta_exist))
			{
				$saldo=false;
				$existencia=$row["existencia"];
				$producto=$row["producto"];													
				echo '<TR><TD COLSPAN="5"><span class="error"><center>Unicamente existen '.$existencia.' '.$producto.' de '.$solicitado.' solicitado(a)s</span></center></TD></TR>';														
				$tipo_reporte="";				
			}
			$cnt++;
			echo '<br>';		
		}	
		
		*/	/////// fin de consulta codigo de categoria, subcategoria, producto y bodega, segun id del producto que trae
		
		///if ($saldo)
  //{	

		/////////////////////////////////// inserta datos generales de la requisición/////////////////////////////////////////
	
	
 $cnt=1; 		
   $saldo=true;
   while($cnt<=count($bien))
		{			
							
		$codigo = $bien[$cnt][4];		
        $solicitado = $cantidad_solicitada[$cnt];
		//print($solicitado);
		//$codigoproducto = $bien[$cnt][0];	
		//$categoria = $bien[$cnt][5];	
		//$subcategoria = $bien[$cnt][6];	
		////// consulta codigo de categoria, subcategoria, producto y bodega, segun id del producto que trae		
     	$qry_x_rowid_producto="select * from tb_inventario where rowid = '$codigo'";
		//print($qry_x_rowid_producto);
		$res_rowid_producto=$query($qry_x_rowid_producto);
		while($rowid=$fetch_array($res_rowid_producto))
		{
			$cproducto[$cnt]=$rowid["codigo_producto"];
			print($cproducto[$cnt]);
			$ccategoria[$cnt]=$rowid["codigo_categoria"];
			$csubcategoria[$cnt]=$rowid["codigo_subcategoria"];
			
			$cbodega[$cnt]=$rowid["codigo_bodega"];
			$cempresa[$cnt]=$rowid["codigo_empresa"];
				
		}		
		$cnt++;
	}
	
	
	 $usuario_id=$_SESSION["user_id"];	
		//$_SESSION["hoja_despacho"]=$txt_no_requisicion;
	$qry_ingreso ="insert into tb_requisicion_enc";
	$qry_ingreso.="(fecha_requisicion, codigo_dependencia, codigo_jefe_dependencia, codigo_solicitante, solicitante, codigo_estatus, 
				  observaciones, usuario_creo, fecha_creado, user_id)";
	$qry_ingreso.="values (getdate(), $cbo_dependencias, $cbo_jefe, '".$nombre[0][1]."', '$solicitante', $txt_estatus, 
				 '$observaciones', '$nombre_usuario', getdate(), '$usuario_id')";
	$query($qry_ingreso);
	
	
		//print $qry_ingreso;
	/////////////////////////////////// selecciona el ultimo ingreso guardado	/////////////////////////////////////////
	$qry_ultimo_ingreso="select max(codigo_requisicion_enc) as ultima_requisicion from tb_requisicion_enc";
	$res_ultimo_ingreso=$query($qry_ultimo_ingreso);
	while($row=$fetch_array($res_ultimo_ingreso))
	{
		$no_ingreso = $row["ultima_requisicion"];		
	}
		
		
		
		$cnt=1; 		
     while($cnt<=count($bien))
	{						

		 // $solicitado = $cantidad_solicitada[$cnt];
		$solicitado = $bien[$cnt][9];	
		
		$qry_ingreso_det ="insert into tb_requisicion_det";	
		$qry_ingreso_det.="(codigo_requisicion_enc, codigo_producto, codigo_categoria, codigo_subcategoria, cantidad_solicitada, codigo_bodega, codigo_empresa)";
		$qry_ingreso_det.="values ('$no_ingreso', '$cproducto[$cnt]', '$ccategoria[$cnt]', '$csubcategoria[$cnt]', '$solicitado', '$cbodega[$cnt]', '$cempresa[$cnt]')";			
		
		//print $qry_ingreso_det;
		
		$query($qry_ingreso_det);		
		$cnt++;		
	 }
		
	/*
	/////////////////////////////////// Actualiza en la tabla de inventario la cantidad comprometida/////////////////////////////
			
				$cnt=1; 		
				while($cnt<=count($bien))
				{						
						conectardb($almacen);
					 $solicitado = $cantidad_solicitada[$cnt];
					//$autorizado = $txt_autorizado[$cnt][0];
				
					//busca el producto en la tabla
					$qry_consulta="select * from tb_inventario where codigo_bodega='$cbodega[$cnt]' and codigo_empresa='$cempresa[$cnt]' and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' and codigo_subcategoria='$csubcategoria[$cnt]'";
					$res_consulta=$query($qry_consulta);
					$existe=false;
					while($row=$fetch_array($res_consulta))
					{
						$existe=true;
						$comprometido=$row["cantidad_comprometida"]+$solicitado;
						//$existencia_actual=$row["existencia"]-$solicitado;	
						$qry_ingreso_inventario ="update tb_inventario set cantidad_comprometida='$comprometido' where codigo_empresa='$cempresa[$cnt]' and codigo_bodega='$cbodega[$cnt]' and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' and codigo_subcategoria='$csubcategoria[$cnt]'";
						//$qry_ingreso_inventario ="update tb_inventario";			
						//$qry_ingreso_inventario.="set existencia='$existencia_actual', ultimo_egreso=getdate(), usuario_egreso='$nombre_usuario' where codigo_empresa='$empresa' and codigo_bodega='$bodega' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
					}					
			//print($qry_ingreso_inventario);
					$query($qry_ingreso_inventario);
					$cnt++;
				}	// fin actualiza inventario	
	*/
	
	//}
	
	
	session_unregister("ingreso");
	echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
	echo '<TR><TD COLSPAN="5"><span class="titulomenu"><center>Hoja de requisicion guardada correctamente!</span></center></TD></TR>';										



}
//cambiar_ventana("../index.php");
?>
</body>
</html>

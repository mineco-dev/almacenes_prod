<?php
	ini_set('display_errors', 1);
  	ini_set('display_startup_errors', 1);
  	error_reporting(E_ALL);
	//session_start();
	require("../../../includes/funciones.php");
	require("../../../includes/sqlcommand.inc");
	require_once('../../../includes/conectarse.php');
	
if (isset($_REQUEST["txt_id"])) 

{			
	    
		$cod=$_REQUEST["txt_id"];
		//$rowid=$_REQUEST["txt_rowid"];
		conectardb($almacen);
	    $nombre_usuario=$_SESSION["user_name"];
	
			/////////////////////////////////// consulta existencias /////////////////////////////////////////
		$cnt=1; 		
		
		while($cnt<=count($_REQUEST["bien"]))
		{			
			$codigo = $_REQUEST["bien"][$cnt][8];		
			$autorizado = $_REQUEST["txt_ingresado"][$cnt][13];
			// print($autorizado);
			 $codigo = $_REQUEST["txt_codigo"][$cnt][11];
			$producto = $_REQUEST["txt_producto"][$cnt][3];
			$categoria = $_REQUEST["txt_categoria"][$cnt][4];
			$subcategoria = $_REQUEST["txt_subcategoria"][$cnt][5];
			$bodega = $_REQUEST["txt_bodega"][$cnt][6];
			$empresa = $_REQUEST["txt_empresa"][$cnt][7];
	
			$qry_x_rowid_producto="select * from tb_inventario where codigo_producto = '$producto' and codigo_categoria = '$categoria' and codigo_subcategoria = '$subcategoria' and codigo_bodega = '$bodega' and codigo_empresa = '$empresa'";
			//print($qry_x_rowid_producto);
			//$qry_x_rowid_producto="select * from tb_inventario where rowid='$codigo'";
			$res_rowid_producto=$query($qry_x_rowid_producto);
			while($rowid=$fetch_array($res_rowid_producto))
			{
				$cproducto[$cnt]=$rowid["codigo_producto"];
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
	$qry_ingreso.="(fecha_requisicion, codigo_dependencia,  codigo_solicitante, solicitante, codigo_estatus, 
				  observaciones, usuario_creo, fecha_creado, user_id)";
	$qry_ingreso.="values (getdate(), ". $_REQUEST["txt_dependencia"]. ",  '".$_REQUEST["nombre"][0][1]."', '".$_REQUEST["nombre"][0][2]."', 5, 
				 '".utf8_decode($_REQUEST["txt_observaciones"])."', '$nombre_usuario', getdate(), '$usuario_id')";
	$query($qry_ingreso);
		//print $qry_ingreso;
	/////////////////////////////////// selecciona el ultimo ingreso guardado	/////////////////////////////////////////
	//$qry_ultimo_ingreso="select max(codigo_requisicion_enc) as ultima_requisicion from tb_requisicion_enc";
	$qry_ultimo_ingreso="select scope_identity() as ultima_requisicion";
	$res_ultimo_ingreso=$query($qry_ultimo_ingreso);
	while($row=$fetch_array($res_ultimo_ingreso))
	{
		$no_ingreso = $row["ultima_requisicion"];		
	}
		
		
		$cnt=1; 		
     while($cnt<=count($_REQUEST["bien"]))
	{						

		 // $solicitado = $cantidad_solicitada[$cnt];
		$autorizado = $_REQUEST["txt_ingresado"][$cnt][13];
		
		$qry_ingreso_det ="insert into tb_requisicion_det";	
		$qry_ingreso_det.="(codigo_requisicion_enc, codigo_producto, codigo_categoria, codigo_subcategoria, cantidad_solicitada, cantidad_autorizada, codigo_bodega, codigo_empresa)";
		$qry_ingreso_det.="values ('$no_ingreso', '$cproducto[$cnt]', '$ccategoria[$cnt]', '$csubcategoria[$cnt]', '$autorizado', '$autorizado', '$cbodega[$cnt]', '$cempresa[$cnt]')";			
		
		//print $qry_ingreso_det;
		
		$query($qry_ingreso_det);		
		$cnt++;		
	 }
		
 		

		
			$codigo=$_REQUEST["txt_id"];
		$qry_actualiza="UPDATE tb_ingreso_enc SET codigo_estatus=8 WHERE codigo_ingreso_enc='$codigo'";
	//	print($qry_actualiza);
		$query($qry_actualiza);	   
    			

	
	// session_unregister("ingreso");
	echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
	echo '<TR><TD COLSPAN="5"><span class="titulomenu"><center>Hoja de requisicion guardada correctamente!</span></center></TD></TR>';										

}

				

	 // fin if principal


?>

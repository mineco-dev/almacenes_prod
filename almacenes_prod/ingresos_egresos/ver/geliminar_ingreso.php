<?PHP
	
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($almacen));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/
?>
<?PHP
//echo '<hr>';
//echo $_REQUEST["txt_id"];
//echo '<hr>';
if (isset($_REQUEST["txt_id"]))
{			

        $codigo=$_REQUEST["txt_id"];
		$no_ingreso=$_REQUEST["txt_no_ingreso"];
        $nombre_usuario=$_SESSION["user_name"];
		  $justificacion=$_REQUEST["txt_justificacion"];
		conectardb($almacen);
	$qry_actualiza="UPDATE tb_ingreso_enc SET usuario_modifico='$nombre_usuario', justificacion='$justificacion', codigo_estatus='0', activo='2' WHERE no_ingreso='$no_ingreso'";
	//SELECT tb_resquisicion_enc set codigo_estatus = 0 FROM   tb_requisicion_enc WHERE (codigo_requisicion_enc = 13662)	 
	/*echo '<hr>';
	print($qry_actualiza);
	echo '<hr>';*/
	$query($qry_actualiza);				


	$qry_borra="DELETE FROM tb_kardex WHERE no_ingreso='$no_ingreso'";

	//echo '<hr>';
	//	print($qry_borra);
	//echo '<hr>';
		$query($qry_borra);				

	/////////////////////////////////// Actualiza tabla inventario /////////////////////////////
	//echo '<hr>';
	//echo 'actualizando inventario de tabla';
	//echo '<hr>';
				$cnt=1; 		
				while($cnt<=count($_REQUEST["bien"]))
				{						
			$producto = $_REQUEST["txt_producto"][$cnt][3];
			$categoria = $_REQUEST["txt_categoria"][$cnt][4];
			$subcategoria = $_REQUEST["txt_subcategoria"][$cnt][5];
			$bodega = $_REQUEST["txt_bodega"][$cnt][6];
			$empresa = $_REQUEST["txt_empresa"][$cnt][7];
			$cantidad_ingresada = $_REQUEST["txt_ingresado"][$cnt][12];
			$codigo = $_REQUEST["bien"][$cnt][8];
					//busca el producto en la tabla
					$qry_consulta="select * from tb_inventario where codigo_empresa='$empresa' and codigo_bodega='$bodega' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
					//print($qry_consulta);
					$res_consulta=$query($qry_consulta);
				    $existe=false;
					while($row=$fetch_array($res_consulta))
					{
					    $existe=true;		
						$existencia_total=$row["existencia"]-$cantidad_ingresada;
					
						$qry_ingreso_inventario ="update tb_inventario set existencia='$existencia_total', usuario_rechazo = '$nombre_usuario' where codigo_empresa='$empresa' and codigo_bodega='$bodega' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
						//echo '<hr>';
						//print($qry_ingreso_inventario);
						//echo '<hr>';
						$query($qry_ingreso_inventario);
				   }
						
					//print($qry_ingreso_inventario);
					//$query($qry_ingreso_inventario);
					$cnt++;
		         // fin actualiza inventario		
			
                } // cierre primer while     
				
					  echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
	echo '<TR><TD COLSPAN="5"><span class="titulomenu"><center>Se elimino el Ingreso</span></center></TD></TR>';	 
} // cierre del if

		
?>
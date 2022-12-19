<?PHP
//session_start();
require ("../../../includes/funciones.php");
require ("../../../includes/sqlcommand.inc");
require_once ('../../../includes/conectarse.php');

/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
//$tipo_reporte="rpt_despacho.php";

?>
<script language="JavaScript">
function Abrir_ventana(pagina) 
	{
		var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=700, height=400, top=85, left=140";
		window.open(pagina,"",opciones);
	}
</script>

<?PHP /*
if ($tipo_reporte!="") 
	{	
		echo "<body onload=Abrir_ventana('$tipo_reporte')>";
	}
	else 
	{
		echo "<body>";
	} */
?>

<?PHP
if (isset($_REQUEST["txt_id"]))
{
	$bien = $_REQUEST["bien"];
	$cod = $_REQUEST["txt_id"];

	conectardb($almacen);
	$queryconsulta = "select *  from  tb_requisicion_enc  WHERE codigo_requisicion_enc='$cod' and codigo_egreso is  null";
	$responsexyz = $query($queryconsulta);
	$contadorxxx = 0;
	while ($rowid = $fetch_array($responsexyz))
	{
		$contadorxxx += 1;

	}
	if ($contadorxxx >= 1)
	{

		//$rowid=$_REQUEST["txt_rowid"];
		conectardb($almacen);
		$nombre_usuario = $_SESSION["user_name"];
		/////////////////////////////////// consulta existencias /////////////////////////////////////////
		$cnt = 1;
		$saldo = true;
		while ($cnt <= count($bien))
		{
			$codigo = $bien[$cnt][8];
			//$solicitado = $entregado[$cnt];
			$solicitado = $_REQUEST["txt_solicitada"][$cnt][20];
			$autorizado = $_REQUEST["txt_autorizado"][$cnt][0];
			$numero = $_REQUEST["txt_rowid"][$cnt][2];
			$codigo = $_REQUEST["txt_codigo"][$cnt][11];
			$producto = $_REQUEST["txt_producto"][$cnt][3];
			//echo '<hr>'	;
			//echo $codigo;
			//echo '<hr>'	;
			//print_r($_REQUEST);
			//$data = json_decode(file_get_contents('php://input'), true);
			////echo $data;
			//echo '<hr>'	;
			$categoria = $_REQUEST["txt_categoria"][$cnt][4];
			$subcategoria = $_REQUEST["txt_subcategoria"][$cnt][5];
			$bodega = $_REQUEST["txt_bodega"][$cnt][6];
			$empresa = $_REQUEST["txt_empresa"][$cnt][7];
			//$renglon = $txt_renglon[$cnt][9];
			////session_register("hoja_despacho");
			//$_SESSION["hoja_despacho"]=$codigo;
			////// consulta codigo de categoria, subcategoria, producto y bodega, segun id del producto que trae
			$qry_x_rowid_producto = "select * from tb_inventario where codigo_producto = '$producto' and codigo_categoria = '$categoria' and codigo_subcategoria = '$subcategoria' and codigo_bodega = '$bodega' and codigo_empresa  ='$empresa'";
			//echo '<hr>';
			//echo 'query rowid producto';
			//print($qry_x_rowid_producto);
			//$qry_x_rowid_producto="select * from tb_inventario where rowid='$codigo'";
			$res_rowid_producto = $query($qry_x_rowid_producto);
			while ($rowid = $fetch_array($res_rowid_producto))
			{
				$cproducto[$cnt] = $rowid["codigo_producto"];
				$ccategoria[$cnt] = $rowid["codigo_categoria"];
				$csubcategoria[$cnt] = $rowid["codigo_subcategoria"];
				$cbodega[$cnt] = $rowid["codigo_bodega"];
				$cempresa[$cnt] = $rowid["codigo_empresa"];

			}
			/////// fin de consulta codigo de categoria, subcategoria, producto y bodega, segun id del producto que trae
			$qry_consulta_exist = "select i.existencia, (p.producto +' '+ p.marca) as producto, i.codigo_producto, i.codigo_categoria, i.codigo_subcategoria, i.codigo_bodega, i.codigo_empresa from tb_inventario i 
								 inner join cat_producto p on i.codigo_producto=p.codigo_producto and i.codigo_categoria=p.codigo_categoria and i.codigo_subcategoria=p.codigo_subcategoria
								 where (i.codigo_empresa='$cempresa[$cnt]' and i.codigo_bodega='$cbodega[$cnt]' and i.codigo_producto='$cproducto[$cnt]' and i.codigo_categoria='$ccategoria[$cnt]' and i.codigo_subcategoria='$csubcategoria[$cnt]' and existencia < '$autorizado')";
			//print ('query existencia');
			/*echo '<hr>';
			echo $qry_consulta_exist;
			echo '<hr>';*/
			$res_consulta_exist = $query($qry_consulta_exist);
			while ($row = $fetch_array($res_consulta_exist))
			{
				$saldo = false;
				$existencia = $row["existencia"];
				$producto = $row["producto"];
				echo '<TR><TD COLSPAN="5"><span class="error"><center>Unicamente existen ' . $existencia . ' ' . $producto . ' de ' . $autorizado . ' solicitado(a)s. SI APARECE ESTE MENSAJE ES QUE HA OCURRIDO UN GRABE ERROR EN LA TRANSACCION, POR FAVOR COMUNIQUESE CON EL ADMINISTRADOR DEL SISTEMA. GRACIAS.</span></center></TD></TR>';
				$tipo_reporte = "";
			}
			$cnt++;
			//echo '<br>';
			
		} //fin del while
		

		//	$tipo_reporte="";
		//}
		//$cnt++;
		//echo '<br>';
		//}	//fin del while
		//echo '<br>';
		/*
		echo '<hr>';
		//print_r($bien);
		echo $saldo;
		echo '<hr>';*/
		//$saldo = false;
		if ($saldo)
		{

			/////////////////////////////////// inserta datos generales del egreso	/////////////////////////////////////////
			conectardb($almacen);
			$recibe = $_REQUEST["nombre"][0][2];
			//$fecha=$_REQUEST["txt_fecha"];
			$codsolicitante = $_REQUEST["txt_codigo_solicitante"];
			$solicitante = $_REQUEST["txt_solicitante"];

			$observaciones = $_REQUEST["txt_observaciones"];
			$dependencia = $_REQUEST["txt_dependencia"];
			$qry_ingreso = "insert into tb_egreso_enc";
			$qry_ingreso .= "(tipo_documento, fecha_documento, solicitante, nombre_solicitante, observaciones, activo, usuario_creo, fecha_creado, recibe, codigo_dependencia)";
			$qry_ingreso .= "values (7, getdate(), '$codsolicitante', '$solicitante',
							  '$observaciones', 1, '$nombre_usuario', getdate(), '$recibe', '$dependencia')";
			//print($qry_ingreso);
			$query($qry_ingreso);

			/////////////////////////////////// selecciona el ultimo egreso guardado	/////////////////////////////////////////
			$qry_ultimo_egreso = "select max(codigo_egreso_enc) as ultimo_egreso from tb_egreso_enc";
			$res_ultimo_egreso = $query($qry_ultimo_egreso);
			while ($row = $fetch_array($res_ultimo_egreso))
			{
				$no_egreso = $row["ultimo_egreso"];
			}
			//session_register("hoja_depacho");
			$_SESSION["hoja_depacho"] = $no_egreso;
			/////////////////////////////////// inserta detalle del egreso //////////////////////////////////////////
			$cnt = 1;
			while ($cnt <= count($bien))
			{
				$codigo = $bien[$cnt][8];
				//$solicitado = $entregado[$cnt];
				$autorizado = $_REQUEST["txt_autorizado"][$cnt][0];
				$numero = $_REQUEST["txt_rowid"][$cnt][2];
				$producto = $_REQUEST["txt_producto"][$cnt][3];
				$categoria = $_REQUEST["txt_categoria"][$cnt][4];
				$subcategoria = $_REQUEST["txt_subcategoria"][$cnt][5];
				$bodega = $_REQUEST["txt_bodega"][$cnt][6];
				$empresa = $_REQUEST["txt_empresa"][$cnt][7];
				//$renglon = $txt_renglon[$cnt][9];
				$solicitado = $_REQUEST["txt_solicitada"][$cnt][20];
				$qry_ingreso_det = "insert into tb_egreso_det";
				$qry_ingreso_det .= "(codigo_egreso_enc, codigo_producto, codigo_categoria, codigo_subcategoria, codigo_bodega, codigo_empresa, cantidad_entregada, usuario_creo, fecha_creado, activo, cantidad_solicitada) ";
				$qry_ingreso_det .= "values ('$no_egreso', '$producto', '$categoria', '$subcategoria', '$bodega', '$empresa', '$autorizado', '$nombre_usuario', getdate(), 1, '$solicitado')";
				  //print($qry_ingreso_det);
				$query($qry_ingreso_det);
				$cnt++;
			}
			/////////////////////////////////// inserta detalle del egreso en la tabla kardex//////////////////////////////////////////
			$cnt = 1;
			while ($cnt <= count($bien))
			{
				$no_requisicion = $_REQUEST["txt_codigo"][$cnt][11];
				$codigo = $_REQUEST["bien"][$cnt][8];
				$solicitado = $_REQUEST["entregado"][$cnt];
				$autorizado = $_REQUEST["txt_autorizado"][$cnt][0];
				$numero = $_REQUEST["txt_rowid"][$cnt][2];
				$producto = $_REQUEST["txt_producto"][$cnt][3];
				$categoria = $_REQUEST["txt_categoria"][$cnt][4];
				$subcategoria = $_REQUEST["txt_subcategoria"][$cnt][5];
				$bodega = $_REQUEST["txt_bodega"][$cnt][6];
				$dependencia = $_REQUEST["txt_dependencia"];
				$empresa = $_REQUEST["txt_empresa"][$cnt][7];
				$qry_consulta = "select * from tb_kardex where codigo_bodega='$bodega' and codigo_empresa='$empresa' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
				//print($qry_consulta);
				/*echo '<hr>';
				echo $qry_consulta;
				echo '<hr>';*/
				$res_consulta = $query($qry_consulta);
				$existe = false;
				while ($row = $fetch_array($res_consulta))
				{
					$existe = true;

					$costo_promedio = round($row["costo_promedio"],4);

					$costo_total1 = round($row["costo_total"],4);

					$saldo = $row["saldo"] - $autorizado;
					//$costo_actual=$row["saldo"]*$row["costo_actual"];
					//$costo_nuevo=$autorizado*$costo_unitario[$cnt];
					//$suma_costo=$costo_actual+$costo_nuevo;
					//$promedio=$suma_costo/$saldo;
					//$costo_factura=$promedio*$ingresado[$cnt];
					$costo_movimiento = $row["costo_promedio"] * $autorizado;

					$costo_actual = $row["costo_actual"];

					$costo_total = round($costo_total1 -$costo_movimiento,4);
					$qry_ingreso_kardex = "insert into tb_kardex";
					$qry_ingreso_kardex .= "(no_despacho, codigo_bodega, codigo_empresa, codigo_producto, codigo_categoria, codigo_subcategoria, codigo_tipo_movimiento, fecha, cantidad, usuario_creo, fecha_creado, activo, saldo, salida, costo_promedio, costo_factura, costo_movimiento, id_dependencia, costo_total, no_requisicion, costo_actual)";
					$qry_ingreso_kardex .= "values ('$no_egreso', '$bodega', '$empresa', '$producto', '$categoria', '$subcategoria', 2, getdate(), '$autorizado', '$nombre_usuario', getdate(), 1, '$saldo', '$autorizado', '$costo_promedio', 0, '$costo_movimiento', '$dependencia', '$costo_total', '$no_requisicion', '$costo_actual')";
					//print($qry_ingreso_kardex);
					/*echo '<hr>';
					echo $qry_ingreso_kardex;
					echo '<hr>';*/
					
				}
				$query($qry_ingreso_kardex);
				$cnt++;
			} // fin kardex
			

			/////////////////////////////////// Actualiza tabla inventario /////////////////////////////
			$cnt = 1;
			while ($cnt <= count($bien))
			{

				$autorizado = $_REQUEST["txt_autorizado"][$cnt][0];
				conectardb($almacen);
				$producto = $_REQUEST["txt_producto"][$cnt][3];
				$nombre_usuario = $_SESSION["user_name"];
				$categoria = $_REQUEST["txt_categoria"][$cnt][4];
				$subcategoria = $_REQUEST["txt_subcategoria"][$cnt][5];
				$bodega = $_REQUEST["txt_bodega"][$cnt][6];
				$empresa = $_REQUEST["txt_empresa"][$cnt][7];
				$solicitado = $_REQUEST["txt_solicitada"][$cnt][20];
				//$autorizado = $txt_autorizado[$cnt][0];
				$codigo = $_REQUEST["bien"][$cnt][8];
				//busca el producto en la tabla
				$qry_consulta = "select * from tb_inventario where codigo_bodega='$bodega' and codigo_empresa='$empresa' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
				$res_consulta = $query($qry_consulta);
				$existe = false;
				while ($row = $fetch_array($res_consulta))
				{
					$existe = true;
					//$existencia_actual=$autorizado-$solicitado;
					$existencia_total = $row["existencia"] - $autorizado;
					$comprometido = $row["cantidad_comprometida"] - $autorizado;
					//$existencia_total=$row["existencia"]-$existencia_actual;
					$qry_ingreso_inventario = "update tb_inventario set existencia='$existencia_total', cantidad_comprometida='$comprometido', ultimo_egreso=getdate(), usuario_egreso='$nombre_usuario' where codigo_empresa='$empresa' and codigo_bodega='$bodega' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
					//$qry_ingreso_inventario ="update tb_inventario";
					//$qry_ingreso_inventario.="set existencia='$existencia_actual', ultimo_egreso=getdate(), usuario_egreso='$nombre_usuario' where codigo_empresa='$empresa' and codigo_bodega='$bodega' and codigo_producto='$producto' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria'";
					
				}
				//	print('inventario<hr>');
				//print($qry_ingreso_inventario);
				$query($qry_ingreso_inventario);
				$cnt++;
			} // fin actualiza inventario
			

			/*	/////////////////////////////////// Actualiza tabla inventario detalle/////////////////////////////
				$cnt=1; 						
				while($cnt<=count($bien))
				{						
					$codigo = $bien[$cnt][8];
					$producto = $bien[$cnt][1];
					$requerido = $entregado[$cnt];
					//busca el producto en la tabla
					$qry_consulta="select CONVERT(VARCHAR(23), fecha_vence, 121) as vencimiento, * from tb_inventario_det where codigo_bodega='$cbodega[$cnt]' and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' and codigo_subcategoria='$csubcategoria[$cnt]' and activo=1 order by fecha_vence";
					$res_consulta=$query($qry_consulta);							
					while($row=$fetch_array($res_consulta))
					{						
						$lote=$row["lote"];
						$vencimiento=$row["vencimiento"];																			
						if ($requerido>0)
						{
							if ($row["existencia"]>=$requerido)
							{
								$existencia_actual=$row["existencia"]-$requerido;
								$proveido=$requerido;
								$requerido=0;								
							}							
							else
							{
								$requerido=$requerido-$row["existencia"];
								$proveido=$row["existencia"];
								$existencia_actual=0;								
							}													
							if ($existencia_actual==0) 
							{
								$activo=2;							
							}
							else
							{
							    $activo=1;
							}
							$qry_ingreso_inventario ="update tb_inventario_det ";			
							$qry_ingreso_inventario.="set existencia='$existencia_actual', activo=$activo where codigo_bodega='$cbodega[$cnt]' and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' and codigo_subcategoria='$csubcategoria[$cnt]' and fecha_vence='$vencimiento'";							
							$query($qry_ingreso_inventario);
							///////////Almacena el detalle de los productos entregados por lote y fecha de vencimiento/////////////////
							$qry_entregado="insert into tb_producto_egresa_det(codigo_bodega, codigo_producto, codigo_categoria, codigo_subcategoria, lote, fecha_vence, entregado, fecha_operado, numero_documento, tipo_documento) ";
							$qry_entregado.="values ('$cbodega[$cnt]', '$cproducto[$cnt]', '$ccategoria[$cnt]', '$csubcategoria[$cnt]', '$lote', '$vencimiento', $proveido, getdate(), '$txt_no_ingreso', '$cbo_tipo_docto')";
							$query($qry_entregado);							
							///////////Fin de detalle de productos entregados por lote y fecha de vencimiento//////////////////////////
						}						
					}
					$cnt++;
				}	// fin actualiza inventario		
			
			*/

			$cod = $_REQUEST["txt_id"];
			//$rowid=$_REQUEST["txt_rowid"];
			conectardb($almacen);
			$nombre_usuario = $_SESSION["user_name"];
			$qry_actualiza = "UPDATE tb_requisicion_enc SET codigo_estatus=6, usuario_despacho='$nombre_usuario', codigo_egreso='$no_egreso',
								fecha_despacho=getdate() WHERE codigo_requisicion_enc='$cod'";
			$query($qry_actualiza);
			echo "REQUISICION DESPACHADA EXITOSAMENTE";
			echo '<a href="../versolicitud.php?ver=3"> <<--regresar </a>';

		} // fin saldo
		
	}
	else{
		echo "REQUISICION YA FUE DESPACHADA";
		echo '<a href="../versolicitud.php?ver=3"> <<--regresar </a>';
	}
}
// fin if principal
//header("Location: ../versolicitud.php?ver=3");

?>

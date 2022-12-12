
	<!DOCTYPE html>

	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
		<link href="../../../helpdesk.css" rel="stylesheet" type="text/css" />
	</head>
	<body>
		
		<?php session_start();
	// require("../../../includes/funciones.php");
	// require("../../../includes/sqlcommand.inc");
	require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($almacen));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');

		$nfilas = $_SESSION['nfilas'];
		$Pagina = $_POST["txt_id"];
		$cont = count($bien);


		if (isset($Pagina))
		{

			//actualiza estado de temporal a aprobado
			conectardb($almacen);
			$qry_ingreso_inventario = "update tb_requisicion_enc SET codigo_estatus = '3' WHERE codigo_requisicion_enc = $Pagina";
			$query($qry_ingreso_inventario);

			//fin********************************



			// recorrer toda la matris temporal y se actualiza con los nuevos valores ingresados
			for ($i=0; $i<=$nfilas; $i++)
			{		


				
				$cproducto = $bien[$i][1];
				$ccategoria = $bien[$i][5];
				$csubcategoria = $bien[$i][6];
				$solicitado = $cantidad_solicitada[$i];
				$Rowids = $bien[$i][10];

				
				conectardb($almacen);	
				$sql ="update tb_requisicion_det	
				set codigo_producto = '$cproducto', codigo_categoria = '$ccategoria', codigo_subcategoria = '$csubcategoria', cantidad_solicitada = '$solicitado'
				where codigo_requisicion_enc = $Pagina and rowid = '$Rowids'";
				$Result2 = $query($sql);

				$qry_ingreso_inventario ="update tb_inventario set 
				cantidad_comprometida=((select cantidad_comprometida from tb_inventario where codigo_bodega=12 
					and codigo_empresa=5 and codigo_producto='$cproducto' and codigo_categoria='$ccategoria'
					and codigo_subcategoria='$csubcategoria') + '$solicitado') 
					where codigo_empresa='5' and codigo_bodega='12' 
					and codigo_producto='$cproducto' and codigo_categoria='$ccategoria' 
					and codigo_subcategoria='$csubcategoria'";
					$query($qry_ingreso_inventario);	


			}
			// fin ****************************************

			//verifica si se ejecuto la actualizacion
			if($Result2 != 0){
				echo "Se actualizaron tus datos";
			}else{
				echo "No se pudo modificar tu registro";

			}
			// fin*****************************************



					//while($cnt<=count($bien))
		}
if (count($bien) > $nfilas) {



					//conectardb($almacen);
					$Solicitante=$solicitante;//si
					$nombre_usuario=$_SESSION["user_name"];
					$Observaciones=$observaciones;//si
					/////////////////////////////////// consulta existencias //////////////////////////////////////////
					////session_register("hoja_requisicion");
							/////////////////////////////////// inserta datos generales de la requisición/////////////////////////////////////////
					//$cnt=1; 		
					//$saldo=true;


					for ($cnt=$nfilas+1; $cnt <= count($bien) ; $cnt++)  
						

					{		
											//********************************* VERIFICA CUANTOS BIENES HAY EN EL TABLE 4	
						$codigo = $bien[$cnt][4]; 		
						$solicitado = $cantidad_solicitada[$cnt]; 
						$qry_x_rowid_producto = "select  distinct inventario.codigo_producto,inventario.codigo_categoria,inventario.codigo_subcategoria, inventario.codigo_bodega,
						inventario.codigo_empresa from tb_inventario as inventario
						inner join cat_producto as produc on
						inventario.codigo_categoria = produc.codigo_categoria and inventario.codigo_subcategoria = produc.codigo_subcategoria
						where inventario.codigo_producto =(select codigo_producto from cat_producto where rowid = '$codigo')  and produc.rowid ='$codigo' ";

						$res_rowid_producto=$query($qry_x_rowid_producto);
						while($rowid=$fetch_array($res_rowid_producto))
						{
							$cproducto[$cnt]=$rowid["codigo_producto"];
							$ccategoria=$rowid["codigo_categoria"];
							$csubcategoria=$rowid["codigo_subcategoria"];
							$cbodega[$cnt]=$rowid["codigo_bodega"];
							$cempresa[$cnt]=$rowid["codigo_empresa"];


						}		

					}
								// $usuario_id=$_SESSION["user_id"];	
								// $qry_ingreso ="insert into tb_requisicion_enc
								// 			   (fecha_requisicion, codigo_dependencia, codigo_jefe_dependencia, codigo_solicitante, solicitante, codigo_estatus, 
								// 			   observaciones, usuario_creo, fecha_creado, user_id)
								// 			   values (getdate(), $dependencia, $Jefe, '$CodSolicitante', '$Solicitante', 3, 
								// 			   '$Observaciones', '$nombre_usuario', getdate(), '$usuario_id')";
								// $query($qry_ingreso);


					$no_ingreso = $Pagina;		





					for ($cnt=$nfilas+1; $cnt <= count($bien) ; $cnt++) 
					{						
						$solicitado = $cantidad_solicitada[$cnt];
						$qry_ingreso_det ="insert into tb_requisicion_det	
						(codigo_requisicion_enc,codigo_bodega, codigo_producto, codigo_categoria, codigo_subcategoria, cantidad_solicitada,  codigo_empresa)
						values ('$no_ingreso',  '$cbodega[$cnt]','$cproducto[$cnt]', '$ccategoria', '$csubcategoria', 
							'$solicitado', '$cempresa[$cnt]')";			
							$query($qry_ingreso_det);	


					}

						/////////////////////////////////// Actualiza en la tabla de inventario la cantidad comprometida/////////////////////////////

					for ($cnt=$nfilas+1; $cnt <= count($bien) ; $cnt++) 
					{						
						conectardb($almacen);
						$solicitado = $cantidad_solicitada[$cnt];
						$qry_consulta="select * from tb_inventario where codigo_bodega='$cbodega[$cnt]' and codigo_empresa='$cempresa[$cnt]' 
						and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' 
						and codigo_subcategoria='$csubcategoria[$cnt]'";
						$res_consulta=$query($qry_consulta);
						$existe=false;
						while($row=$fetch_array($res_consulta))
						{
							$existe=true;
							$comprometido=$row["cantidad_comprometida"]+$solicitado;	
							$qry_ingreso_inventario ="update tb_inventario set cantidad_comprometida='$comprometido'
							where codigo_empresa='$cempresa[$cnt]' and codigo_bodega='$cbodega[$cnt]' 
							and codigo_producto='$cproducto[$cnt]' and codigo_categoria='$ccategoria[$cnt]' 
							and codigo_subcategoria='$csubcategoria[$cnt]'";
						}					
						$query($qry_ingreso_inventario);

					}	

					session_unregister("ingreso");
					echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';							
					echo '<TR><TD COLSPAN="5"><span class="titulomenu"><center>Requisición Enviada a Aprobación!</span></center></TD></TR>';
					echo '<TR><TD COLSPAN="5">&nbsp;</TD></TR>';

					conectardb($almacen);			
					$qry_ingreso_inventario ="update tb_requisicion_enc set codigo_estatus = 3 where codigo_requisicion_enc = $Pagina";	
					$Result1 = mssql_query($qry_ingreso_inventario);

}


?>


</body>
</html>
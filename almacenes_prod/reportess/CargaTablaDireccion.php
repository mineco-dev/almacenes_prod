<?php
	require('../conexion.php');
	
	$idDireccion = $_REQUEST['Dependencia'];
	$mesInicio = $_REQUEST['mesInicio'];
	$anioInicio = $_REQUEST['anioInicio'];
	$mesFinal = $_REQUEST['mesFinal'];
	$anioFinal = $_REQUEST['anioFinal'];
	header('Content-Type: text/html; charset=ISO-8859-1');
	$fechaInicio = "01".'-'.$mesInicio .'-'.$anioInicio ;
	$fechaFinal = "30".'-'.$mesFinal.'-'.$anioFinal ;

	$Meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
		
// 	$sql = "
// SELECT 
// 	[kd].[codigo_kardex], 
// 	[dr].[nombre], 
// 	[kd].[codigo_categoria], 
// 	[kd].[codigo_subcategoria], 
// 	[kd].[codigo_producto], 
// 	[cp].[producto], 
// 	[kd].[fecha_creado], 
// 	[kd].[salida], 
// 	[kd].[costo_promedio],
// 	[kd].[id_dependencia]
// FROM 
// 	[dbo].[tb_kardex] AS kd 
// 	inner join [dbo].[cat_producto] AS cp ON cp.codigo_categoria = kd.codigo_categoria 
// 		AND cp.codigo_subcategoria = kd.codigo_subcategoria 
// 		AND cp.codigo_producto = kd.codigo_producto 
// 	inner join [dbo].[direccion] AS dr ON [dr].[iddireccion] = [kd].[id_dependencia]
// WHERE 
// 	[kd].[id_dependencia] = $idDireccion
// 	AND [kd].[codigo_bodega] = 8  
// 	AND [kd].[fecha_creado] >= '$fechaInicio' 
// 	AND [kd].[fecha_creado] <= '$fechaFinal'
// ORDER BY [kd].[fecha_creado]";

	$sql = "SELECT 
	[kd].[codigo_kardex], 
	[dr].[nombre], 
	[kd].[codigo_categoria], 
	[kd].[codigo_subcategoria], 
	[kd].[codigo_producto], 
	[cp].[producto], 
	[kd].[fecha_creado], 
	[kd].[salida], 
	[kd].[costo_promedio],
	[kd].[id_dependencia]
FROM 
	[dbo].[tb_kardex] AS kd 
	inner join [dbo].[cat_producto] AS cp ON cp.codigo_categoria = kd.codigo_categoria 
		AND cp.codigo_subcategoria = kd.codigo_subcategoria 
		AND cp.codigo_producto = kd.codigo_producto 
	inner join [dbo].[direccion] AS dr ON [dr].[iddireccion] = [kd].[id_dependencia]
WHERE 
	[kd].[id_dependencia] = $idDireccion
	AND [kd].[codigo_bodega] = 12  
	and convert(varchar(10),[kd].[fecha_creado],103) between '$fechaInicio'  and '$fechaFinal'
ORDER BY [kd].[fecha_creado]";

	$result = mssql_query($sql);
	
	$Contenido = array();
	$Disponibles = array();
	
	echo "
		<table style = 'border: 1px solid;'>
		<thead >
			<tr>
				<td>Categoria</td>
				<td>Sub Categoria</td>
				<td>Cod. Producto</td>
				<td>Descripcion</td>
	";
	
	echo "		<td>Cantida despachada</td>
				<td>Costo Promedio</td>";
	
	echo "		<td>Costo Total</td>";
	echo "	</tr>
		</thead>
		<tbody>
	";
	
	$i = 0;
	while($row = mssql_fetch_array($result)){
		$Contenido[$i] = $row;
		//echo " | ". $fecha = date("m", strtotime($row['fecha_creado']));
		//echo $row['fecha_creado']->format("d-m-Y");
		//echo date_format($row['fecha_creado'], 'Y-m-d');
		/*if(($Contenido[$i]['producto'] === $Contenido[$i-1]['producto']) && $i > 0){
			echo "<tr>";
			echo "<td>". $Contenido[$i]['codigo_categoria']."</td>";
			echo "<td>". $Contenido[$i]['codigo_subcategoria']."</td>";
			echo "<td>". $Contenido[$i]['codigo_producto']."</td>";
			echo "<td style = 'width: 1000px'>Iguale</td>";
			echo "<td>". $Contenido[$i]['fecha_creado']->format("m-Y")."</td>";
			echo "</tr>";
		}
		else{
			echo "<tr>";
			echo "<td>". $Contenido[$i]['codigo_categoria']."</td>";
			echo "<td>". $Contenido[$i]['codigo_subcategoria']."</td>";
			echo "<td>". $Contenido[$i]['codigo_producto']."</td>";
			echo "<td style = 'width: 1000px'>". $Contenido[$i]['producto']."</td>";
			echo "<td>". $Contenido[$i]['fecha_creado']->format("m-Y")."</td>";
			echo "</tr>";
		}*/
		$i++;
	}
	echo "<br>";
	
	$y = 0;
	$x = 0 . ($mesInicio + 1);
	$codSali = 2;
	for($i = 0; $Contenido[$i]; $i++)
	{
		//echo " | " . $x;
		//echo $Contenido[$i]['codigo_kardex'] . " | ";
		$valida = false;
		for($j = 0; $Contenido[$j]; $j++)
		{
			if($Contenido[$i]['producto'] === $Disponibles[$j]['producto'])
			{
				$valida = true;
				//echo $Contenido[$i]['fecha_creado']->format("m"). " ! ". $x . " | ". $Contenido[$i]['codigo_kardex']. " ... " ;
				if($Disponibles[$j]['fecha_creo'] === date("m", strtotime($Contenido[$i]['fecha_creado'])))
				{
					$Contenido[$j]['salida'] += $Contenido[$i]['salida'];
					$Contenido[$j]['costo_promedio'] = $Contenido[$i]['costo_promedio'];
				}
				else
				{
					if( $x === date("m", strtotime($Contenido[$i]['fecha_creado'])) )
					{	
						$Contenido[$j]['salida'] += $Contenido[$i]['salida'];
						$Contenido[$j]['costo_promedio'] = $Contenido[$i]['costo_promedio'];
					}
					else
					{
						if($x <= 9 && $x >= 0){
							$z = $x+1;
							$x = 0 . $z;
						}
						else
						{
							$x++;
						}
						$codSali++;
						$Contenido[$j]['salida'] += $Contenido[$i]['salida'];
						$Contenido[$j]['costo_promedio'] = $Contenido[$i]['costo_promedio'];
					}
				}
			}
		}	
		if($valida == false)
		{
			$Disponibles[$y]['producto'] = $Contenido[$i]['producto'];
			$Disponibles[$y]['fecha_creo'] = date("m", strtotime($Contenido[$i]['fecha_creado']));
			$y++;			
		}
		
	}
	$total=0;
	$total2=0;
	for($i = 0; $Disponibles[$i]; $i++)
	{
		echo "<tr>";
		echo "<td>". $Contenido[$i]['codigo_categoria']."</td>";
		echo "<td>". $Contenido[$i]['codigo_subcategoria']."</td>";
		echo "<td>". $Contenido[$i]['codigo_producto']."</td>";
		echo "<td style = 'width: 1000px'>". $Contenido[$i]['producto']."</td>";
		echo "<td>". $Contenido[$i]['salida']."</td>";
		echo "<td>Q. ";
		echo $Contenido[$i]['costo_promedio']."</td>";
		echo "<td>Q. ";
		echo ($Contenido[$i]['costo_promedio']*$Contenido[$i]['salida'])."</td>";
		echo "</tr>";
		$total+=$Contenido[$i]['salida'];
		$total2+=($Contenido[$i]['costo_promedio']*$Contenido[$i]['salida']);
	}
	echo "<tr>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td></td>";
		echo "<td><center><b>TOTAL CONSUMIDO</b></center></td>";
		echo "<td><b>$total</b></td>";
		echo "<td></td>";
		echo "<td><b>Q. $total2</b></td>";
		echo "</tr>";
	echo '
		
		</tbody>
	</table>
	';
?>
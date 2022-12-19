<?php
	
	require('../conexion.php');
	
	$idSolicitante = $_REQUEST['Usuario'];
	$mesInicio = $_REQUEST['mesInicio'];
	$anioInicio = $_REQUEST['anioInicio'];
	$mesFinal = $_REQUEST['mesFinal'];
	$anioFinal = $_REQUEST['anioFinal'];
	header('Content-Type: text/html; charset=ISO-8859-1');
	$fechaInicio = $anioInicio . $mesInicio . "01";
	$fechaFinal = $anioFinal . $mesFinal . "30";
	
	$Meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
		
	$sql = "
SELECT 
	[kd].[codigo_kardex], 
	[re].[solicitante], 
	[re].[codigo_solicitante], 
	[kd].[codigo_categoria], 
	[kd].[codigo_subcategoria], 
	[kd].[codigo_producto], 
	[cp].[producto], 
	[kd].[fecha_creado], 
	[kd].[salida], 
	[kd].[costo_promedio] 
FROM 
	[dbo].[tb_kardex] AS kd 
	left join [dbo].[tb_requisicion_enc] AS re ON re.codigo_egreso = kd.no_despacho 
	inner join [dbo].[cat_producto] AS cp ON cp.codigo_categoria = kd.codigo_categoria 
		AND cp.codigo_subcategoria = kd.codigo_subcategoria 
		AND cp.codigo_producto = kd.codigo_producto 
WHERE 
	[re].[codigo_solicitante] = $idSolicitante 
	AND [kd].[codigo_bodega] = 15
	AND [kd].[fecha_creado] >= '$fechaInicio' 
	AND [kd].[fecha_creado] <= '$fechaFinal'
ORDER BY 
	[kd].[fecha_creado]";
	
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
	
	//$hHoraSOlgura = date('H:i:s', strtotime('+1 hours', $HoraSalida));
	
	for($auxMesIncio = $mesInicio; $auxMesIncio <= $mesFinal; $auxMesIncio++)
	{
		echo "<td>" . $Meses[$auxMesIncio - 1]. "</td>";
	}
	
	
	
	echo "		<td>Costo Pormedio</td>";
	
	echo "	</tr>
		</thead>
		<tbody>
	";
	
	$i = 0;
	while($row = mssql_fetch_array($result)){
		$Contenido[$i] = $row;
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
	
	$y = 0;
	$x = 0 . ($mesInicio + 1);
	$codSali = 2;
	for($i = 0; $Contenido[$i]; $i++)
	{
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
						$Contenido[$j]['salida'.$codSali] = $Contenido[$i]['salida'];
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
						$Contenido[$j]['salida'.$codSali] = $Contenido[$i]['salida'];
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
	
	for($i = 0; $Disponibles[$i]; $i++)
	{
		echo "<tr>";
		echo "<td>". $Contenido[$i]['codigo_categoria']."</td>";
		echo "<td>". $Contenido[$i]['codigo_subcategoria']."</td>";
		echo "<td>". $Contenido[$i]['codigo_producto']."</td>";
		echo "<td style = 'width: 1000px'>". $Contenido[$i]['producto']."</td>";
		echo "<td>". $Contenido[$i]['salida']."</td>";
		
		for($x = 1; $x <= ($mesFinal - $mesInicio); $x++)
		{
			echo "<td>". $Contenido[$i]['salida'.($x+1)]."</td>";
		}
		echo "<td>Q. ";
		echo $Contenido[$i]['costo_promedio']."</td>";
		echo "</tr>";
	}
	
	echo '
		
		</tbody>
	</table>
	';
?>
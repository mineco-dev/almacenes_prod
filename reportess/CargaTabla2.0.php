<?php
	
	require('../conexion.php');
	
	$idSolicitante = $_REQUEST['Usuario'];
	$mesInicio = $_REQUEST['mesInicio'];
	$anioInicio = $_REQUEST['anioInicio'];
	$mesFinal = $_REQUEST['mesFinal'];
	$anioFinal = $_REQUEST['anioFinal'];
	// header('Content-Type: text/html; charset=ISO-8859-1');
	$fechaInicio = "01".'-'.$mesInicio.'-'.$anioInicio ;
	$fechaFinal = "30".'-'.$mesFinal.'-'.$anioFinal;
	
	$Meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
		
	$sql = "
SELECT 
	[rq].[codigo_requisicion_enc],
	[rq].[fecha_creado],
	[rq].[codigo_solicitante],
	[rq].[solicitante],
	[rd].[rowid],
	[rd].[codigo_bodega],
	[rd].[codigo_categoria],
	[rd].[codigo_subcategoria],
	[rd].[codigo_producto],
	[p].[producto],
	[rd].[cantidad_solicitada],
	[rd].[cantidad_autorizada],
	[k].[salida],
	[k].[saldo],
	[k].[costo_promedio],
	[k].[costo_total]
FROM
	[dbo].[tb_requisicion_enc] AS [rq]
	INNER JOIN [dbo].[tb_requisicion_det] AS [rd] ON [rd].[codigo_requisicion_enc] = [rq].[codigo_requisicion_enc]
	INNER JOIN [dbo].[tb_kardex] AS [k] ON [k].[no_requisicion] = [rq].[codigo_requisicion_enc]
		AND [k].[codigo_categoria] = [rd].[codigo_categoria] 
		AND [k].[codigo_subcategoria] = [rd].[codigo_subcategoria] 
		AND [k].[codigo_producto] = [rd].[codigo_producto]
	INNER JOIN [dbo].[cat_producto] AS [p] ON 
		[p].[codigo_categoria] = [rd].[codigo_categoria] 
		AND [p].[codigo_subcategoria] = [rd].[codigo_subcategoria] 
		AND [p].[codigo_producto] = [rd].[codigo_producto]
WHERE 
	convert(varchar(10),[rq].[fecha_creado],103) between '$fechaInicio'  and '$fechaFinal'
	AND [rd].[codigo_bodega] = 12
	AND [rq].[codigo_solicitante] = $idSolicitante 
	AND [k].[activo] = 1
	AND [rq].[codigo_estatus] <> 9
ORDER BY
	[producto],
	[rq].[fecha_creado]
	
	";/*
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
	[kd].[costo_promedio],
	[kd].[saldo],
	[kd].[costo_total] 
FROM 
	[dbo].[tb_kardex] AS kd 
	left join [dbo].[tb_requisicion_enc] AS re ON re.codigo_egreso = kd.no_despacho 
	inner join [dbo].[cat_producto] AS cp ON cp.codigo_categoria = kd.codigo_categoria 
		AND cp.codigo_subcategoria = kd.codigo_subcategoria 
		AND cp.codigo_producto = kd.codigo_producto 
WHERE 
	[re].[codigo_solicitante] = $idSolicitante 
	AND [kd].[codigo_bodega] = 8 
	AND [kd].[fecha_creado] >= '$fechaInicio' 
	AND [kd].[fecha_creado] <= '$fechaFinal'
ORDER BY 
	[kd].[fecha_creado]";*/
	
	$result = mssql_query($sql);
	
	$Contenido = array();
	$Disponibles = array();
	
	echo "
		<table style = 'border: 1px solid;'>
		<thead >
			<tr>
				<td>No. </td>
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
	
	
	echo "		<td> Cantidad total despachada</td>
				<td>Costo Pormedio</td>
				<td>Costo Total</td>";
	
	echo "	</tr>
		</thead>
		<tbody>
	";
	
	$i = 0;
	while($row = mssql_fetch_array($result)){
		$Contenido[$i] = $row;
		/*echo "<tr>";
		echo "<td>$i</td>";
		echo "<td>". $row['codigo_categoria']."</td>";
		echo "<td>". $row['codigo_subcategoria']."</td>";
		echo "<td>". $row['codigo_producto']."</td>";
		echo "<td style = 'width: 1000px'>". $row['producto']."</td>";
		echo "<td>". $row['salida']."</td>";
		echo "<td>". date_create($row['fecha_creado'])->format("Y-m-d H:i:s")."</td>";
		echo "<td>Q. ";
		echo $row['costo_promedio']."</td>";
		echo "</tr>";*/
		$i++;
	}
	
	$y = 0;
	$veces = 1;
	for($i = 0; $Contenido[$i]; $i++)
	{
		$x = 0 . ($mesInicio + 1);
		$l = 0 . ($mesInicio + 1);
		//echo $Contenido[$i]['codigo_kardex'] . " | ";
		$valida = false;
		for($j = 0; $Disponibles[$j]; $j++)
		{
			if(($Contenido[$i]['producto'] === $Disponibles[$j]['producto'] ))
			{
				$valida = true;
				//echo $Contenido[$i]['fecha_creado']->format("m"). " ! ". $x . " | ". $Contenido[$i]['codigo_kardex']. " ... " ;
				if(date("m", strtotime($Disponibles[$j]['fecha_creado'])) === date("m", strtotime($Contenido[$i]['fecha_creado'])))
				{
					$Disponibles[$j]['costo_promedio'] = $Contenido[$i]['costo_promedio'];
					if((int)$l !== (int)date("m", strtotime($Contenido[$i]['fecha_creado'])))
					{
						for($z = 1; $z <= ($mesFinal - $mesInicio); $z++)
						{
							//echo "$z   ";
							//echo $x . " ~ " . date("m", strtotime($Contenido[$i]['fecha_creado'])) . " | ";
							if($l === (int)date("m", strtotime($Contenido[$i]['fecha_creado'])))
							{
								$Disponibles[$j]['salida'. $z] += $Contenido[$i]['salida'];
								$Disponibles[$j]['costo_promedio'] = $Contenido[$i]['costo_promedio'];
								break;
							}
							$l++;
						}
					}
					else
					{
						$Disponibles[$j]['salida'] += $Contenido[$i]['salida'];
					}
				}
				else
				{
				
					/*if( $x === date("m", strtotime($Contenido[$i]['fecha_creado'])) )
					{	
						$Disponibles[$j]['salida'.$codSali] = $Contenido[$i]['salida'];
						$Disponibles[$j]['costo_promedio'] = $Contenido[$i]['costo_promedio'];
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
						$Disponibles[$j]['salida'.$codSali] = $Contenido[$i]['salida'];
						$Disponibles[$j]['costo_promedio'] = $Contenido[$i]['costo_promedio'];
					}*/
					for($z = 1; $z <= ($mesFinal - $mesInicio); $z++)
					{
						//echo "$z   ";
						//echo $x . " ~ " . date("m", strtotime($Contenido[$i]['fecha_creado'])) . " | ";
						if($x === (int)date("m", strtotime($Contenido[$i]['fecha_creado'])))
						{
							$Disponibles[$j]['salida'.($z)] = $Contenido[$i]['salida'];
							break;
						}
						$x++;
					}
				}
				$Disponibles[$j]['saldo'] = $Contenido[$i]['saldo'];
				$Disponibles[$j]['costo_promedio'] = $Contenido[$i]['costo_promedio'];
				$Disponibles[$j]['costo_total'] = $Contenido[$i]['costo_total'];
			}
		}	
		if($valida == false)
		{
			$mess =  (int)($mesInicio + 1);
			$Disponibles[$y] = $Contenido[$i];	
			if((int)$mesInicio !== (int)date("m", strtotime($Disponibles[$y]['fecha_creado'])))
			{
				for($z = 1; $z <= ($mesFinal - $mesInicio); $z++)
				{
					//echo "$z   ";
					if((int)$mess === (int)date("m", strtotime($Disponibles[$y]['fecha_creado'])))
					{
						$Disponibles[$y]['salida'.($z)] = $Disponibles[$y]['salida'];
						$Disponibles[$y]['salida'] = 0;
						break;
					}
					$mess++;
					//echo $mess;
				}
			}
			$y++;		
		}
	}
	
	$Total = array();
	$Total['restultado'] = 0;
	$Total['Totale'] = 0;
	for($i = 0; $Disponibles[$i]; $i++)
	{
		echo "<tr>";
		echo "<td>".($i+1)."</td>";
		echo "<td>". $Disponibles[$i]['codigo_categoria']."</td>";
		echo "<td>". $Disponibles[$i]['codigo_subcategoria']."</td>";
		echo "<td>". $Disponibles[$i]['codigo_producto']."</td>";
		echo "<td style = 'width: 1000px'>". $Disponibles[$i]['producto']."</td>";
		echo "<td>". $Disponibles[$i]['salida']."</td>";
		$Total['salir' . 0] += $Disponibles[$i]['salida'];
		for($x = 1; $x <= ($mesFinal - $mesInicio); $x++)
		{
			if($Disponibles[$i]['salida'.($x)])
			{
				echo "<td>". $Disponibles[$i]['salida'.($x)]."</td>";
				$Total['salir'.$x] += $Disponibles[$i]['salida'.($x)];
			}
			else
			{
				echo "<td>0</td>";
			}
		}
		$resultado = $Disponibles[$i]['salida'];
		for($h = 1; $h <= ($mesFinal - $mesInicio); $h++){$resultado += $Disponibles[$i]['salida'.($h)];}
		echo "<td>$resultado</td>";
		$Total['restultado'] += (int)$resultado;
		$PROM = ($Disponibles[$i]['costo_total']/$Disponibles[$i]['saldo']);
		echo "<td>Q. ". $Disponibles[$i]['costo_promedio']."</td>";
		$CostoTotale = ($resultado*$PROM);
		echo "<td>Q. ". number_format($CostoTotale,2) ."</td>";
		$Total['Totale'] += (float)$CostoTotale;
		echo "</tr>";
	}
	echo "<td>&nbsp;</td>";
	echo "<td>&nbsp;</td>";
	echo "<td>&nbsp;</td>";
	echo "<td>&nbsp;</td>";
	echo "<td style = 'font-size: 20px;'>Total Consumido</td>";
	echo "<td>". $Total['salir' . 0] . "</td>";
	for($k = 1; $k <= ($mesFinal - $mesInicio); $k++)
	{
		if($Total['salir'.$k])
		{
			echo "<td>". $Total['salir'.$k] . "</td>";
		}
		else
		{
			echo "<td>0</td>";
		}
	}

	echo "<td>" . $Total['restultado'] . "</td>";
	echo "<td>&nbsp;</td>";
	echo "<td>Q. " . number_format($Total['Totale'],2) . "</td>";
	echo '
		
		</tbody>
	</table>
	';
?>
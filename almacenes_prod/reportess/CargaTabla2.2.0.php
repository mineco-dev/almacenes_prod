<?php
	
	require('conexion.php');
	
	$idSolicitante = $_REQUEST['Usuario'];
	$mesInicio = $_REQUEST['mesInicio'];
	$anioInicio = $_REQUEST['anioInicio'];
	$mesFinal = $_REQUEST['mesFinal'];
	$anioFinal = $_REQUEST['anioFinal'];
	header('Content-Type: text/html; charset=ISO-8859-1');
	$fechaInicio = $anioInicio . $mesInicio . "01";
	$fechaFinal = $anioFinal . $mesFinal . "30";
	
	$Meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
		
	echo $sql = "
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
	AND [kd].[codigo_bodega] = 8 
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
	
	echo "		<td>Costo Pormedio</td>";
	
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
	$x = 0 . ($mesInicio + 1);
	$codSali = 2;
	$Columna = 1; 
	for($i = 0; $Contenido[$i]; $i++)
	{
		$valida = false;
		for($j = 0; $Disponibles[$j]; $j++)
		{
			if($Disponibles[$j]['producto'] === $Contenido[$i]['producto'])
			{
				$valida = true;
				if( date("m", strtotime($Disponibles[$j]['fecha_creo'])) === date("m", strtotime($Contenido[$i]['fecha_creado'])) )
				{
				 	$Disponibles[$j]['salida'] += $Contenido[$i]['salida'];
					
				}
				else
				{
				
					if( $x === date("m", strtotime($Contenido[$i]['fecha_creado'])) )
					{	
						$Disponibles[$j]['salida'.$codSali] = $Contenido[$i]['salida'];
					}
					else
					{
						if($x <= 9 && $x >= 0){
							$z = $x+1;
							$x = 0 . $z;
						}
						else
						{
							echo $x++;
						}
						$codSali++;
						$Disponibles[$j]['salida'.$codSali] = $Contenido[$i]['salida'];
					}
				}
				$Disponibles[$j]['costo_promedio'] = $Contenido[$i]['costo_promedio'];
				/*Demas campos que remplazaran*/
			}			
		}
		
		if($valida == false)
		{
			$Disponibles[$y] = $Contenido[$i];
			$y++;			
			if(Columna !== date("m", strtotime($Contenido[$i]['fecha_creado'])))
			{
				$Columna++;
				$Disponibles[$y]['Columna'] = $Columna; 
			}
			else
			{
				$Disponibles[$y]['Columna'] = $Columna; 
			}
		}
		
	}
	
	for($i = 0; $Disponibles[$i]; $i++)
	{
		$g = $mesInicio;
		echo "<tr>";
		echo "<td>$i</td>";
		echo "<td>". $Disponibles[$i]['codigo_categoria']."</td>";
		echo "<td>". $Disponibles[$i]['codigo_subcategoria']."</td>";
		echo "<td>". $Disponibles[$i]['codigo_producto']."</td>";
		echo "<td style = 'width: 1000px'>". $Contenido[$i]['producto']."</td>";
		
		for($k = 1; $k <= $Disponibles[$k]['Columna']; $k++)
		{
			if( $k ==  $Disponibles[$k]['Columna'] )
			{	
				echo "<td>". $Contenido[$k]['salida']."</td>";
				break;
			}
			else
			{
				echo "<td>0</td>";
			}
		}
		for($x = 1; $x <= ($mesFinal - $mesInicio); $x++)
		{
			if( $g === date("m", strtotime($Disponibles[$i]['fecha_creado'])) )
			{	
				echo "<td>". $Disponibles[$i]['salida'.($x+1)]."</td>";
			}
			else
			{
				echo "<td>0</td>";
				$g++;
			}
		}
		echo "<td>Q. ";
		echo $Disponibles[$i]['costo_promedio']."</td>";
		echo "</tr>";
	}
	
	echo '
		
		</tbody>
	</table>
	';
?>
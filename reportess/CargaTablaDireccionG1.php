<?php
	
	require('../conexion.php');
	
	header('Content-Type: text/html; charset=ISO-8859-1');
	$idDireccion = $_REQUEST['Dependencia'];
	$mesInicio = $_REQUEST['mesInicio'];
	$anioInicio = $_REQUEST['anioInicio'];
	
	$fechaInicio = $anioInicio . $mesInicio . "01";
	if(($mesInicio)  === '02')
	{
		$fechaFinal = $anioInicio . $mesInicio . "28";
	}
	else{
		if((($mesInicio) == 4) || (($mesInicio) == 6) || (($mesInicio) == 9) ||(($mesInicio) == 11) ) 
		{
			$fechaFinal = $anioInicio . $mesInicio . "30";
		}
		else
		{
			$fechaFinal = $anioInicio . $mesInicio . "31";
		}
	}
	
	$Meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
		
	 $sql = "
SELECT 
	[k].[fecha_creado],
	[k].[codigo_categoria],
	[k].[codigo_subcategoria],
	[k].[codigo_producto],
	[p].[producto],
	[m].[unidad_medida], 
	[k].[costo_promedio],
	[k].[no_ingreso],
	[k].[no_despacho],
	[k].[costo_total],
	[k].[costo_actual],
	[id].[cantidad_ingresada],
	[id].[Precio_total] AS [precio_ingreso],
	[ed].rowid,
	[ed].[cantidad_entregada],
	([ed].[cantidad_entregada] * [k].[costo_promedio]) AS [precio_despacho],
	[ed].[fecha_creado]
	
FROM 
	[tb_kardex] AS [k]
	INNER JOIN [cat_producto] AS [p] ON [p].[codigo_categoria] = [k].[codigo_categoria] AND [p].[codigo_subcategoria] = [k].codigo_subcategoria AND [p].[codigo_producto] = [k].[codigo_producto]
	INNER JOIN [cat_medida] AS [m] ON [m].[codigo_medida] = [p].[codigo_medida]
	LEFT JOIN [tb_ingreso_enc] AS [ie] ON [ie].[no_ingreso] = [k].[no_ingreso] 
	LEFT JOIN [tb_ingreso_det] AS [id] ON [id].[codigo_ingreso_enc]  = [ie].[codigo_ingreso_enc]  
		AND [id].[codigo_categoria] = [k].[codigo_categoria] 
		AND [id].[codigo_subcategoria] = [k].[codigo_subcategoria] 
		AND [id].[codigo_producto] = [k].[codigo_producto] 
	LEFT JOIN [tb_egreso_enc] AS [ec] ON [ec].[codigo_egreso_enc] = [k].[no_despacho] 
	LEFT JOIN [tb_egreso_det]  AS [ed] ON [ed].[codigo_egreso_enc] = [ec].[codigo_egreso_enc] 
		AND [ed].[codigo_categoria] = [k].[codigo_categoria] 
		AND [ed].[codigo_subcategoria] = [k].[codigo_subcategoria] 
		AND [ed].[codigo_producto] = [k].[codigo_producto]   
WHERE 
	[k].[fecha_creado] >= '$fechaInicio' 
	AND [k].[fecha_creado] <= '$fechaFinal'
	AND [k].[codigo_bodega] = 15
ORDER BY
	[p].[producto],
	[k].[fecha_creado]
";
	
	$result = mssql_query($sql);
	
	$Contenido = array();
	$Disponibles = array();
	
	$i = 0;
	while($row = mssql_fetch_array($result)){
		$Contenido[$i] = $row;
		$i++;
	}
	
	$y = 0;
	for($i = 0; $Contenido[$i]; $i++)
	{
		$valida = false;
		for($j = 0; $Contenido[$j]; $j++)
		{
			if($Contenido[$i]['producto'] === $Disponibles[$j]['producto'])
			{
				$valida = true;
				$Disponibles[$j]['costo_promedio'] = $Contenido[$i]['costo_promedio'];
				$Disponibles[$j]['costo_total'] = $Contenido[$i]['costo_total'];
				if($Contenido[$i]['precio_ingreso'])
				{
					$Disponibles[$j]['precio_ingreso'] += $Contenido[$i]['precio_ingreso'];
				}
				if($Contenido[$i]['precio_despacho'])
				{
					$Disponibles[$j]['precio_despacho'] += $Contenido[$i]['precio_despacho'];
				}
			}
		}	
		if($valida == false)
		{
			$Disponibles[$y] = $Contenido[$i];
			$Disponibles[$y] = $Contenido[$i];
			$Disponibles[$y]['Costo_Inicial'] = $Contenido[$i]['costo_total'];
			
			$y++;			
		}
	
	}
	
	echo "
		<table style = 'border: 1px solid;'>
		<thead >
			<tr>
				<th>No. </th>
				<th>Categoria</th>
				<th>Sub Categoria</th>
				<th>Cod. Producto</th>
				<th>Descripcion</th>
				<th>Unidad de medidia</th>
				<th>Costo Pormedio</th>
				<th>Existencia Inicial</th>
				<th>Ingresos</th>
				<th>Despacho</th>
				<th>Existencia Final</th>
			</tr>
		</thead>
		<tbody>
	";
	
	
	for($i = 0; $Disponibles[$i]; $i++)
	{
		echo "<tr>";
		echo "<td>". ($i+1) . "</td>";
		echo "<td>". $Disponibles[$i]['codigo_categoria']."</td>";
		echo "<td>". $Disponibles[$i]['codigo_subcategoria']."</td>";
		echo "<td>". $Disponibles[$i]['codigo_producto']."</td>";
		echo "<td style = 'width: 1000px'>". $Disponibles[$i]['producto']."</td>";
		echo "<td>". $Disponibles[$i]['unidad_medida'] . "</td>";
		echo "<td>Q. ". $Disponibles[$i]['costo_promedio']."</td>";
		echo "<td style = 'width: 100px'>Q. ";
		$CostoIncicial = $Disponibles[$i]['costo_total'];
		if($Disponibles[$i]['precio_ingreso']){
			$CostoIncicial = $CostoIncicial - $Disponibles[$i]['precio_ingreso'];
		}
		if($Disponibles[$i]['precio_despacho']){
			$CostoIncicial = $CostoIncicial + $Disponibles[$i]['precio_despacho'];
		}
		echo  $CostoIncicial . "</td>";
		if($Disponibles[$i]['precio_ingreso'])
		{
			echo "<td>Q.".$Disponibles[$i]['precio_ingreso']. "</td>";
		}
		else
		{
			echo "<td> --- </td>";
		}
		if($Disponibles[$i]['precio_despacho'])
		{
			echo "<td>Q.".$Disponibles[$i]['precio_despacho'] . "</td>";
		}
		else
		{
			echo "<td> --- </td>";
		}
				
		echo "<td style = 'width: 100px'>Q. ". $Disponibles[$i]['costo_total'] . "</td>";
	}
	
	echo '
		
		</tbody>
	</table>
	';
	
	if(!$result){
		echo "Error al intentar encontrar el contenido";
	}
?>
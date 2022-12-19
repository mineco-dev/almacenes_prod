<?php
	
	require('../conexion.php');
	
	// header('Content-Type: text/html; charset=ISO-8859-1');
	$idDireccion = $_REQUEST['Dependencia'];
	$mesInicio = $_REQUEST['idMes'];
	$anioInicio = $_REQUEST['idAnio'];
	
	$fechaInicio = $anioInicio . $mesInicio . "01";
	if(($mesInicio)  === '02')
	{
		$fechaFinal = $anioInicio . $mesInicio . "28";
		$Dia = "28";
	}
	else{
		if((($mesInicio) == 4) || (($mesInicio) == 6) || (($mesInicio) == 9) ||(($mesInicio) == 11) ) 
		{
			$fechaFinal = $anioInicio . $mesInicio . "30";
			$Dia = "30";
		}
		else
		{
			$fechaFinal = $anioInicio . $mesInicio . "31";
			$Dia = "31";
		}
	}
	
	$Meses = array("ENERO", "FEBRERO", "MARZO", "ABRIL", "MAYO", "JUNIO", "JULIO", "AGOSTO", "SEPTIEMBRE", "OCTUBRE", "NOVIEMBRE", "DICIEMBRE");
		
// 	$sql = "
// SELECT 
// 	[k].[codigo_kardex],
// 	[k].[fecha_creado],
// 	[k].[codigo_categoria],
// 	[k].[codigo_subcategoria],
// 	[k].[codigo_producto],
// 	[p].[producto],
// 	[m].[unidad_medida], 
// 	[k].[costo_promedio],
// 	[k].[no_ingreso],
// 	[k].[no_despacho],
// 	[k].[costo_total],
// 	[k].[costo_actual],
// 	[k].[saldo],
// 	[k].[salida] AS [cantidad_entregada],
// 	[k].[entrada] AS [cantidad_ingresada],
// 	[k].[costo_factura],
// 	[k].[costo_movimiento]
// FROM 
// 	[tb_kardex] AS [k]
// 	INNER JOIN [cat_producto] AS [p] ON [p].[codigo_categoria] = [k].[codigo_categoria] AND [p].[codigo_subcategoria] = [k].codigo_subcategoria AND [p].[codigo_producto] = [k].[codigo_producto]
// 	INNER JOIN [cat_medida] AS [m] ON [m].[codigo_medida] = [p].[codigo_medida]  
// WHERE 
// 	[k].[fecha_creado] >= '$fechaInicio' 
// 	AND [k].[fecha_creado] <= '$fechaFinal 23:59:59'
// 	AND [k].[codigo_bodega] = 8
// 	AND [k].[activo] = 1
// ORDER BY
// 	[p].[producto],
// 	[k].[fecha_creado]
// ";
	

	$sql = "
SELECT 
	[k].[codigo_kardex],
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
  t.costo_inicial,
  t.ultimo_costo,
	[k].[costo_actual],
	[k].[saldo],
	[k].[salida] AS [cantidad_entregada],
	[k].[entrada] AS [cantidad_ingresada],
	[k].[costo_factura],
	[k].[costo_movimiento]
FROM 
	[tb_kardex] AS [k]
	INNER JOIN [cat_producto] AS [p] 
    ON [p].[codigo_categoria] = [k].[codigo_categoria] 
    AND [p].[codigo_subcategoria] = [k].codigo_subcategoria 
    AND [p].[codigo_producto] = [k].[codigo_producto]
	INNER JOIN [cat_medida] AS [m] ON [m].[codigo_medida] = [p].[codigo_medida] 
  INNER JOIN tb_inventario t
    on t.codigo_categoria = k.codigo_categoria 
    and t.codigo_subcategoria = k.codigo_subcategoria
    and t.codigo_producto = k.codigo_producto 
WHERE 
[k].[codigo_categoria] = 267 and [k].codigo_subcategoria = 200
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
				if($Contenido[$i]['costo_factura'])
				{
					$Disponibles[$j]['costo_entrada'] += $Contenido[$i]['costo_factura'];
				}
				if($Contenido[$i]['costo_movimiento'] && $Contenido[$i]['no_despacho'])
				{
					$Disponibles[$j]['costo_salida'] += $Contenido[$i]['costo_movimiento'];
				}
			}
		}	
		if($valida == false)
		{
			$Disponibles[$y] = $Contenido[$i];
			$Disponibles[$y] = $Contenido[$i];
			$Disponibles[$y]['Costo_Inicial'] = $Contenido[$i]['costo_total'];
			if($Contenido[$i]['cantidad_ingresada'])
				{
					$Disponibles[$y]['costo_entrada'] = $Contenido[$i]['costo_factura'];
				}
				if($Contenido[$i]['cantidad_entregada'])
				{
					$Disponibles[$y]['costo_salida'] = $Contenido[$i]['costo_movimiento'];
				}
			
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
				<th>Existencia Inicial 01/$mesInicio/$anioInicio</th>
				<th>Ingresos</th>
				<th>Despacho</th>
				<th>Existencia Final $Dia/$mesInicio/$anioInicio</th>
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
		if($Disponibles[$i]['costo_entrada']){
			$CostoIncicial = $CostoIncicial - $Disponibles[$i]['costo_entrada'];
		}
		if($Disponibles[$i]['ultimo_costo']){
			$CostoIncicial = $CostoIncicial + $Disponibles[$i]['ultimo_costo'];
		}
		echo  $CostoIncicial . "</td>";
		if($Disponibles[$i]['costo_entrada'])
		{
			echo "<td>Q.".$Disponibles[$i]['costo_entrada']. "</td>";
		}
		else
		{
			echo "<td> --- </td>";
		}
		if($Disponibles[$i]['ultimo_costo'])
		{
			echo "<td>Q.".$Disponibles[$i]['ultimo_costo'] . "</td>";
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
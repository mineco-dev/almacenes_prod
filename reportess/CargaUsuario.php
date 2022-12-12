<?php

	require('../conexion.php');
	
	$idDependencia = $_POST['idDependencia'];
	header('Content-Type: text/html; charset=ISO-8859-1');
	$sql = "SELECT 
				[a].[idasesor], 
				[a].[apellido] +' '+ [a].[apellido2] +' '+ [a].[apellidocasada] +', '+ [a].[nombre] +' '+ [a].[nombre2] +' '+ [a].[nombre3] AS [empleado]
			FROM 
				[rrhh].[dbo].[asesores] AS [a]
				INNER JOIN [rrhh].[dbo].[direccion] [d] ON [d].[iddireccion] = [a].[iddireccion]
			WHERE
				[d].[iddireccion] = $idDependencia
				AND [a].[activo] = 1 ";/*
				
		$sql = "
		SELECT 
				[r].[codigo_solicitante], 
				MAX([r].[solicitante]) AS [solicitante], 
				MAX([r].[codigo_dependencia]) AS [codigo_dependencia]
			FROM 
				[dbo].[tb_requisicion_enc] AS [r]
				INNER JOIN [rrhh].[dbo].[asesores] AS [a] ON [a].[idasesor] = [r].[codigo_solicitante]
			WHERE
				[codigo_dependencia]  = $idDependencia
				AND [a].[activo] = 1
			GROUP BY [codigo_solicitante] 
			";*/
			
	$result = mssql_query($sql);
	
	if($result)
	{
		while( $row = mssql_fetch_array($result) )
		{
			echo "<option value = '". $row['idasesor']."'>". $row['empleado']."</option>";
		}
	}
	else
	{
		echo "Datos no encontrados";
	}
?>
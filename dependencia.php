<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?php	
	require_once('connection/helpdesk.php');
	$consulta = "select * from dependencia WHERE codigo_dependencia = '$dependencia'";	
	$result=mssql_query($consulta);				
	while($row=mssql_fetch_array($result))
	{	
		$codigo_dependencia=$row["codigo_dependencia"];
		$nombre_dependencia=$row["nombre_dependencia"];
	}
	if ($codigo_dependencia==33) $nombre_dependencia="Opciones Generales";
	echo $nombre_dependencia;
	mssql_close($s);									
 ?> 
</body>
</html>

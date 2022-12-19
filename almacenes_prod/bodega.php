<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?			
	conectardb($almacen);
	$qry_bodega = "select * from cat_bodega WHERE codigo_bodega = '$codigo_bodega'";	
	$res_bodega=$query($qry_bodega);				
	while($row_bodega=$fetch_array($res_bodega))
	{	
		$codigo_bodega=$row_bodega["codigo_bodega"];
		$bodega=$row_bodega["bodega"];
	}	
	echo $bodega;
	$free_result($res_bodega);									
 ?> 
</body>
</html>

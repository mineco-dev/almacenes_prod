<?
// esto es lo que se pone al inicio de cada pagina

	include('../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
<?

	// esto es para borrar

	$dbms->sql="delete from prueba"; 
	$dbms->Query(); 

	// asi se inserta

	$dbms->sql="insert into prueba(prueba) values('test2')"; 
	$dbms->Query(); 
	
	// asi se modifica
	
	$dbms->sql="update prueba set prueba = 'cambio de prueba' where idprueba > 5"; 
	$dbms->Query(); 
	
	// asi se verifica cuantas filas hay en la consulta
	$dbms->sql="select idprueba,prueba from prueba"; 
	$dbms->Query(); 
	print $dbms->rowcount;

	//asi se realiza una consulta de datos

	$dbms->sql="select idprueba,prueba from prueba"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print $Fields["idprueba"]." ".$Fields["prueba"]."<br>"; 
	}

?>
</body>
</html>

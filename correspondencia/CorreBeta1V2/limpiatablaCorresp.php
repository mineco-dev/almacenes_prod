<?php 
	session_start(); 
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>
<?php  
//	require ('conexion.inc');
	include('../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
	include('../conectarse.php');


	//mssql_select_db($database_redes);
	$usuarioid = $_SESSION['idempleado'];	
	/*$query8 = "delete from diaasigna where idempleado=$usuarioid";
	print $query8;
	mssql_query($query8);
	$query8 = "delete from empleadoasigna where idempleado=$usuarioid";
	mssql_query($query8);
	print $query8;*/
	


//	Header("Location:/CorreBeta1V2/center.php"); 
  cambiar_ventana("center.php");

?>
</body>
</html>

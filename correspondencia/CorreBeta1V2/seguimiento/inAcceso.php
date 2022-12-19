<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>
<?
/* aca hace la insercion de la informacion dependiendo de los resultados asi sera 
   el mensaje que se despliegue */
   session_start();
		$usuario = $_SESSION['codigoUsuario'];
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
		$fecha= date("Y-m-d");
		$SQL = "INSERT INTO detalle_documento(docu,descr,fecha,idempleado) VALUES ($docu,'$txtDescripcion','$fecha',$usuario)";

		$result = mysql_query($SQL);
		
		mysql_close($db);
		header("Location: insertaReporte.php?docu=$docu");

?>

<body>
</body>
</html>

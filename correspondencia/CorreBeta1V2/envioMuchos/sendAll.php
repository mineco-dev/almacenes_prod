<?
     session_start();
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
.Estilo1 {
	font-size: 24px;
	font-weight: bold;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.Estilo2 {font-size: 12px}
-->
</style></head>
<?
/* aca hace la insercion de la informacion dependiendo de los resultados asi sera 
   el mensaje que se despliegue */

		$usuario = $_SESSION['codigoUsuario'];


		/*require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);*/

		include('../../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
		include('../../conectarse.php');

		$fecha = date("Y-m-d");
		//		$SQL = "INSERT INTO docemple(doc,idempleado,fecha,quien,status) VALUES ($docu,$cboEmpleado[$p],'$fecha',$usuario,0);";
				//print $SQL;
			   //$result = mysql_query($SQL);
				$SQL = "UPDATE docemple SET status=1 where doc=$docu";
				$result = mssql_query($SQL);
		//mysql_close($db);
		//header("Location: detalle_accesosT.php?docu=$docu");

?>
<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p align="center" class="Estilo1">Usted Envio la correspondencia Satisfactoriamente </p>
<p align="center" class="Estilo1">&nbsp;</p>
<p align="center" class="Estilo1 Estilo2"><a href="../center.php">Regresar</a></p>
</body>
</html>

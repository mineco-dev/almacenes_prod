<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<?
/* aca hace la insercion de la informacion dependiendo de los resultados asi sera 
   el mensaje que se despliegue */
   
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);

				$SQL = "delete from docemple where du = $ide";
			   $result = mysql_query($SQL);
		mysql_close($db);
		header("Location: detalle_accesosT.php?docu=$docu");

?>

<body>
</body>
</html>

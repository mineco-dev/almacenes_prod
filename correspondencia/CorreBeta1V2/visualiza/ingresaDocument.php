<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>
<?
session_start();
$usuario = $_SESSION['codigoUsuario'];

		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha)) 
			$SQL = "DELETE FROM tmp_documento WHERE empleado = $usuario";
			$result = mysql_query($SQL); // elimina informacion temporal
			$SQL = "DELETE FROM tmp_seguimiento WHERE idempleado = $usuario";
			$result = mysql_query($SQL); // elimina informacion temporal de documentos adjuntados
			$SQL = "INSERT INTO tmp_documento(empleado) values ($usuario);";
			$result = mysql_query($SQL); // inserta el valor temporalmente
			$SQL = "SELECT docu FROM tmp_documento WHERE empleado = $usuario";
			$result = mysql_query($SQL); // obtiene el valor del documento temporal;
			$row = mysql_fetch_row($result); // obtiene el valor del documento
			$SQL = "INSERT INTO tmp_seguimiento(docu,idempleado) values ($row[0],$usuario);";
			$result = mysql_query($SQL); // inserta el valor temporalmente
			$SQL = "DELETE FROM tmp_doc_adj WHERE docu=$row[0]";
			$result = mysql_query($SQL); // elimina informacion temporal de documentos adjuntados
			
			
//			$row = mysql_fetch_row($result);
//			print "Este valor obtiene el documento que se va a utilizar $row[0]";
			//$SQL = " SELECT docu from tmp_documento 
//				while ($row = mysql_fetch_row($result))	
		//		{
	header("Location: documento.php");
?>
<body>

</body>
</html>

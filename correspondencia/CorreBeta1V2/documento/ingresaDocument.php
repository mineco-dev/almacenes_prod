<?
	session_start();?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>
<?

	$usuario = $_SESSION['codigoUsuario'];
	include('../../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
	include("../../conectarse.php");

	/*require ('../conexion.inc');
	$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
	mysql_select_db($BASE_DATOS,$db);*/
	/*$SQL = "DELETE FROM tmp_doc_adj WHERE idasesor=$usuario";
	$result = mssql_query($SQL); // elimina informacion temporal de documentos adjuntados*/
	/*$SQL = "DELETE FROM tmp_documento WHERE empleado=$usuario";
	$result = mssql_query($SQL); // elimina informacion temporal de documentos adjuntados*/
	//$SQL = "DELETE FROM tmp_doc_adj2 WHERE idasesor=$usuario";
	//$result = mysql_query($SQL); // elimina informacion temporal de documentos adjuntados
	//header("Location: documento.php");//
	cambiar_ventana("../../documento.php");
?>
<body>
</body>
</html>

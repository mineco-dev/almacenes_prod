<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>
<?


		//require ('../conexion.inc');
		//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mysql_select_db($BASE_DATOS,$db);
		
		include('../../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
		include('../../conectarse.php');


		$SQL = "UPDATE correspondencia SET  titulo = '$txtTitulo' , quien='$txtQuien', descr='$txtDesc',insti='$txtInsti',ref='$txtRef' 
				WHERE idcorrespondencia = $docu";
		$result = mssql_query($SQL); // elimina informacion temporal
		//print $SQL;	
		if ($result > 0)
		   {
		    ?>
		<!--p align="center">Se modifico la informac�on correctamente..</p>
		<p>&nbsp;</p-->
			<?

			cambiar_ventana('../center.php');
exit;
		   }
		   else
		   {
		    print "Problemas al momento de modificar";
		   }
?>
<body>

<p align="center"><a href="../center.php">Regresar</a></p>
</body>
</html>

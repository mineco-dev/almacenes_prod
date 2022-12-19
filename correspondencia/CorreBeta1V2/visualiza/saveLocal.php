
<?
// este formato guarda el archivo en el inbox del usuario no lo envia al destinatario
session_start();
 $usuario = $_SESSION['codigoUsuario'];
 $fecha = date("Y-m-d");
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha)) 
			$SQL = "UPDATE tmp_documento SET titulo='$txtTitulo',quien='$txtQuien',descr='$txtDesc',insti='$txtInsti',ref='$txtRef' WHERE empleado = $usuario";
			$result = mysql_query($SQL); // elimina informacion temporal	
			$SQL = "UPDATE tmp_seguimiento SET aquien=$usuario,fecha ='$fecha',status='0' WHERE idempleado = $usuario and docu = $docu";
			$result = mysql_query($SQL); // elimina informacion temporal			
		/////////////////////////////////// se ingresa a los datos originales //////////////////////////
		$SQL = "INSERT INTO doc SELECT * FROM tmp_documento WHERE empleado = $usuario";
		$result = mysql_query($SQL); // ingreso de documento
		$SQL = "INSERT INTO doc_adj SELECT * FROM tmp_doc_adj WHERE docu = $docu";
		$result = mysql_query($SQL); // ingreso de documento
		$SQL = "INSERT INTO seguimiento SELECT * FROM tmp_seguimiento WHERE idempleado = $usuario and docu = $docu";
		$result = mysql_query($SQL); // ingreso de documento
		// la variable empleado indica quien creo el documento!!!
				header("Location: okSave.php");
?>

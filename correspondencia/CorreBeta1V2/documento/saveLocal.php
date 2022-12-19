
<?
// este formato guarda el archivo en el inbox del usuario no lo envia al destinatario
session_start();
 $usuario = $_SESSION['codigoUsuario'];
 $finalusuario=$_SESSION['codigoUsuario'];
 $fecha = date("Y-m-d");
	 	print "destino $select_2";
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
		
			$SQL = "UPDATE tmp_documento SET titulo='$txtTitulo',quien='$txtQuien',descr='$txtDesc',insti='$txtInsti',ref='$txtRef' WHERE empleado = $usuario";
			print $SQL;
			$result = mysql_query($SQL); // elimina informacion temporal	
			$SQL = "UPDATE tmp_seguimiento SET fecha ='$fecha',status='0',carpet=3  WHERE idempleado = $usuario and docu = $docu";
			print "<br>".$SQL;
			$result = mysql_query($SQL); // elimina informacion temporal			
		
			print "<br>";
		
//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha)) 
/*			$SQL = "UPDATE tmp_documento SET titulo='$txtTitulo',quien='$txtQuien',descr='$txtDesc',insti='$txtInsti',ref='$txtRef' WHERE empleado = $usuario";
			$result = mysql_query($SQL); // elimina informacion temporal	
			$SQL = "UPDATE tmp_seguimiento SET aquien=$usuario,fecha ='$fecha',status='0' WHERE idempleado = $usuario and docu = $docu";
			$result = mysql_query($SQL); // elimina informacion temporal			*/
//			print "En la actualizacion $SQL y $result <br>";
		/////////////////////////////////// se ingresa a los datos originales //////////////////////////
		$SQL = "INSERT INTO doc(docu,temporal,titulo,quien,descr,insti,ref,empleado) SELECT docu,1,titulo,quien,descr,insti,ref,empleado FROM tmp_documento WHERE empleado = $usuario";
		print $SQL;		$result = mysql_query($SQL); // ingreso de documento
		$SQL = "INSERT INTO doc_adj(docu,descripcion,extension,nombre,path) select docu,descripcion,extension,nombre,path from tmp_doc_adj WHERE docu = $docu";
		print $SQL;
		$result = mysql_query($SQL); // ingreso de documento
		print "aca adjunto el archivo de tempral a normal $SQL <br> $result";
		$SQL = "INSERT INTO seguimiento(docu,status,idempleado, fecha,descr,carpet) SELECT docu,status,idempleado,fecha,descr,3 FROM tmp_seguimiento WHERE idempleado = $usuario and docu = $docu";
		print $SQL;
		$result = mysql_query($SQL); // ingreso de documento
		


/*
		$SQL = "INSERT INTO doc SELECT * FROM tmp_documento WHERE empleado = $usuario";
		print "En la actualizacion $SQL<br>";
		$result = mysql_query($SQL); // ingreso de documento
		$SQL = "INSERT INTO doc_adj SELECT * FROM tmp_doc_adj WHERE docu = $docu";
		$result = mysql_query($SQL); // ingreso de documento
				print "En la actualizacion $SQL<br>";
		$SQL = "INSERT INTO seguimiento SELECT * FROM tmp_seguimiento WHERE idempleado = $usuario and docu = $docu";
		$result = mysql_query($SQL); // ingreso de documento
		print "En la actualizacion $SQL";
		// la variable empleado indica quien creo el documento!!!
*/		
		
		
		
		header("Location: okSave.php");
?>

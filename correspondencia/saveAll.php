<?
// esto es lo que se pone al inicio de cada pagina

	include('../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
?>



<!DOCTYPE html>
<html>
<head>
<met a http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>

<?
// este formato guarda el archivo en el inbox del usuario no lo envia al destinatario
session_start();
 $usuario = $_SESSION['codigoUsuario'];
 $fecha = date("Y-m-d");


		//require ('conexion.inc');
		//$db = mssql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mssql_select_db($BASE_DATOS,$db);



//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha)) 


$dbms->sql="select idprueba,prueba from prueba"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print $Fields["idprueba"]." ".$Fields["prueba"]."<br>"; 
	}


			$dbms->sql= "select * from empleados";
			$dbms->Query();
			while ($fields=$dbms->MoveNext())


//***************esto lo lo quite yo

//			$resultA = mssql_query($SQLA); // elimina informacion temporal	
//			while ($row23 = mssql_fetch_row($resultA))

			{
					//$SQL = "UPDATE tmp_documento SET titulo='$txtTitulo',quien='$txtQuien',descr='$txtDesc',insti='$txtInsti',ref='$txtRef' WHERE empleado = $usuario";
					//$result = mysql_query($SQL); // elimina informacion temporal	

					
					$dbms->sql= "UPDATE tmp_seguimiento SET aquien=$row23[0],fecha ='$fecha',status='0' WHERE idempleado = $usuario and docu = $docu";
					$dbms->Query();	
					
//***********ESTO LO QUITE YO
//					$result = mssql_query($SQL); // elimina informacion temporal			
		//			print "$SQL<br>";
				


				/*/////////////////////////////////// se ingresa a los datos originales //////////////////////////
				$SQL = "INSERT INTO documento SELECT * FROM tmp_documento WHERE empleado = $usuario";
				$result = mysql_query($SQL); // ingreso de documento
				$SQL = "INSERT INTO doc_adj SELECT * FROM tmp_doc_adj WHERE docu = $docu";
				$result = mysql_query($SQL); // ingreso de documento*/


					$dbms->sql = "INSERT INTO seguimiento SELECT * FROM tmp_seguimiento WHERE idempleado = $usuario and docu = $docu";
					$dbms->Query();


//*/*****************ESTO LO QUITE YO			
//					$result1 = mssql_query($SQL1); // ingreso de documento
//					print "$SQL1<br>";
		
		// la variable empleado indica quien creo el documento!!!
			}

		
			
?>

</body>
</html>

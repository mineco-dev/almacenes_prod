<?   session_start();

$_SESSION['nivel']=2;
include('../../valida.php');
?>
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
  // print $docu;

		$usuario = $_SESSION['codigoUsuario'];


//		include ('../../conectarse.php');
		//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mysql_select_db($BASE_DATOS,$db);
		
			include('../../INCLUDES/inc_header.inc');
			$dbms=new DBMS($conexion); 


		$fecha= date("Y-m-d");
		$SQL = "INSERT INTO detalle_documento(docu,descr,fecha,idempleado) VALUES ($_SESSION[correlativo],'$txtDescripcion',getdate(),$usuario)";
//print $SQL.'--'.$_SESSION['correlativo'];
//envia_msg('prueba');
		$result = mssql_query($SQL);
		
		//mssql_close($db);
		//header("Location: documento.php?docu=$docu");
		cambiar_ventana("documento.php?docu=$docu");
?>

<body>
</body>
</html>

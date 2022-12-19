<? 
session_start();

$_SESSION['nivel']=2;
include('../../valida.php');

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
body {
	background-image: url();
}
.Estilo2 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
	color: #FFFFFF;
}
.Estilo3 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo8 {color: #FFFFFF}
-->

</style>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<?
include('../../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
//include('../../conectarse.php');

 $usuario = $_SESSION['codigoUsuario'];
//tomo el valor de un elemento de tipo texto del formulario 
$cadenatexto = $_POST["cadenatexto"]; 
//echo "Escribi� en el campo de texto: " . $cadenatexto . "<br><br>"; 

//datos del arhivo 
$nombre_archivo = $HTTP_POST_FILES['userfile']['name']; 
$tipo_archivo = $HTTP_POST_FILES['userfile']['type']; 
$tamano_archivo = $HTTP_POST_FILES['userfile']['size'];
$archivo23 = split('[.]',$nombre_archivo);
$tipo_archivo = $archivo23[sizeof($archivo23)-1];
$fecha = date("dmYHis");
$path23 = $usuario.$fecha.".".$tipo_archivo;
 //session_start();
		

//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha)) 
		$dU=$_SESSION['codigoUsuario']; //codigo del usuario

		//$SQL = "insert into doc_adj(descripcion,docu,extension,nombre,path) values ('$txtDescripcion',$docu,'$tipo_archivo','$nombre_archivo','$path23')";

		$SQL = "INSERT INTO correspondencia_adjunto(
					idcorrespondencia,
					descripcion,
					extension,
					nombre,
					path) 
		values 		($docu,
					'$txtDescripcion',
					'$tipo_archivo',
					'$nombre_archivo',
					'$path23')";

		$result = mssql_query($SQL);
		// hasta aca inserto el archivo ahora le voy a poner nombre para q jamas se repita
		//mysql_close($db);


   //$info23 = move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "../documento/upload/".$path23);
	$info23 = move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "../../upload/".$path23);


//	header("location: ../center.php");

// envia_msg('aqui');
cambiar_ventana("../center.php");
	?> 
		
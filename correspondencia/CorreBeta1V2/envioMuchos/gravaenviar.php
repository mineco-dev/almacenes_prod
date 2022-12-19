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
-->
</style></head>
<?
/* aca hace la insercion de la informacion dependiendo de los resultados asi sera 
   el mensaje que se despliegue */
     session_start();
		$usuario = $_SESSION['codigoUsuario'];
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
		$fecha = date("Y-m-d");
		for($p=0;$p<sizeof($cboEmpleado);$p++)
		{
		//  for($d=0;$d<sizeof($cboRol);$d++)
		  //{
				//print "Datos seleccionados $cboPrograma[$d]<br>";
				// el campo USUARIO indica el usuario que envia la informacion a todos
				$SQL = "INSERT INTO docemple(doc,idempleado,fecha,quien) VALUES ($docu,$cboEmpleado[$p],'$fecha',$usuario);";
				print $SQL;
			   $result = mysql_query($SQL);
			   
/*****************************************************************************************/
				$SQL34 = "INSERT INTO seguimiento(docu,status,idempleado,fecha,aquien,descr,carpet,salida) VALUES ($docu,0,$usuario,'$fecha',$usuario,'$txtDesc',0,0)";
				
				print "Este valor importa!! ".$SQL34;
			   $result34 = mysql_query($SQL34);

			  
/**************graba el seguimiento real del sistema**************************************************************************************************/
		$fecha0 = date("Y-m-d");
		 $hora0 = date("H:i:s");
		$SQL210 = "INSERT INTO segDocu(de,a,fecha,hora,docu) values ($usuario,$cboEmpleado[$p],'$fecha0','$hora0',$docu)";
		$result210 = mysql_query($SQL210); // ingreso de documento
//		$row210 = mysql_fetch_row($result210);
//		
			//}
		}
//		$SQL = "INSERT INTO acceso(rol,programa) VALUES ($txtRol,$cboPrograma)";
		//$result = mysql_query($SQL);
		mysql_close($db);
		header("Location: detalle_accesosT.php?docu=$docu");

?>

<body>
</body>
</html>

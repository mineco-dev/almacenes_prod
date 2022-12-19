<?
     session_start();
?>

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
//function SendMsg($mm,$fidcorrespondencia,$fidempleado,$fdesc,$fquien){
		function SendMsg($mm,$fidcorrespondencia,$fidasesor,$fdesc,$fquien){

		$ffecha = date("y/m/d");
		$hhora = date("H:i:s");
		$usuario = $_SESSION['codigoUsuario'];
		//$usuario = $_SESSION[idempleado];	


		//require("../conexion.inc");
		//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mysql_select_db($BASE_DATOS,$db);

			/*include('../../INCLUDES/inc_header.inc');
			$dbms=new DBMS($conexion); 
			include('../../conectarse.php');*/

		$SQL = "SELECT correo, nombre+' '+apellido FROM asesor WHERE idasesor = $fidasesor ";
		$result = mssql_query($SQL); 
		$row = mssql_fetch_row($result);

		$SQL21 = "SELECT correo, nombre+' '+apellido FROM asesor WHERE idasesor = $usuario ";
		$result21 = mssql_query($SQL21); // ingreso de documento
		$row21 = mssql_fetch_row($result21);
		
		$bod = "Se le ha transferido una correspondencia <br> <br> Descripcion: $fdesc <br> atentamente, ".$row21[1]. 
							"<br><a href=http://localhost:8585/CorreBeta1V2/mtinicia.php?docu=$fidcorrespondencia&mtcc=$fidasesor&quien=$row21[1]>Ver Correspondencia</a>";
		
			$mail = $mm;
			$mail->IsSMTP();
//			$mail->Host = "mineco.gob.gt";
			$mail->Host = "me-s-mail";
			$mail->SMTPAuth = true;
			$mail->Username = "infocomex";
			$mail->Password = "cafta2006";

			$mail->From = $row21[0];
			$mail->FromName = $row21[1];
			$mail->AddAddress($row[0],$row[1]);
			$mail->WordWrap = 100;                                 // set word wrap to 50 characters
			$mail->IsHTML(true);                                  // set email format to HTML
			$mail->Subject = "Usted tiene correspondencia";
			$mail->Body    = $bod;
			$mail->AltBody = "Usted tiene correspondencia";
				if(!$mail->Send())
				{
				   echo "Message could not be sent. <p>";
				   echo "<br> FromName = $row21[1]";
				   echo "<br> AddAddress($row[0],$row[1])";
				   echo "<br> Mailer Error: " . $mail->ErrorInfo;
				}
				else
				{
					echo "El mensaje ha sido enviado a $row[0],$row[1] <br>";
				}
		return true;
}
?>

<?
/* aca hace la insercion de la informacion dependiendo de los resultados asi sera 
   el mensaje que se despliegue */
   		$fechaentrega=substr($date9,6,4)."/".substr($date9,3,2)."/".substr($date9,0,2);
		$horaentrega =substr($date9,12,5);

		$usuario = $_SESSION['codigoUsuario'];


		include('../../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
		include('../../conectarse.php');

		//require ('../conexion.inc');
		//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mysql_select_db($BASE_DATOS,$db);

		$fecha = date("Y-m-d");

/*		require("class.phpmailer.php");
		$mail = new PHPMailer();*/
		
		for($p=0;$p<sizeof($cboEmpleado);$p++)
		{
			$q_seguimiento = "insert into correspondencia(iddireccion,
														correlativo,
														carpeta,
														titulo,
														quien,
														descr,
														insti,
														ref,
														expe,
														tramite,
														secre,
														observacion,
														fechainicio,
														idasesor,
														idasesor2,
														idasesorcrea,
														idasesordestino,
														status,
														fechaenvio,
														correlativoinicial,
														horacreacion,
														horaenvio,
														correlativocrea,
														fechaentrega,
														horaentrega)
						select iddireccion,
								correlativo,
								carpeta,
								titulo,
								quien,
								descr,
								insti,
								ref,
								expe,
								tramite,
								secre,
								observacion,
								fechainicio,
								idasesor,
								$cboEmpleado[$p],
								idasesorcrea,
								$cboEmpleado[$p],
								status,
								fechaenvio,
								correlativoinicial+'-'+convert(char,($p+1)),
								horacreacion,
								horaenvio,
								correlativocrea,
								'$fechaentrega',
								'$horaentrega'
						from correspondencia where idcorrespondencia = $docu";
			$result = mssql_query($q_seguimiento);
			$SQL = "select max(idcorrespondencia) from correspondencia";
			$result = mssql_query($SQL);
			$row = mssql_fetch_row($result);
			$max_correspondencia =$row[0];
			$q_adjunto="insert into correspondencia_adjunto(idcorrespondencia,
															descripcion,
															extension,
															nombre,
															path)
						select $max_correspondencia,
								descripcion,
								extension,
								nombre,
								path
						from correspondencia_adjunto 
						where idcorrespondencia = $docu";			  
			$result = mssql_query($q_adjunto);

			$fecha0 = date("Y-m-d");
			$hora0 = date("H:i:s");
			$q_seguimiento = "INSERT INTO correspondencia_seguimiento(idcorrespondencia,idasesororigen,idasesordestino,fecha,hora,descripcion) 
										values ($docu,$usuario,$cboEmpleado[$p],getdate(),'$hora0','$txtDesc')";
			$result210 = mssql_query($q_seguimiento); 
			
			$q_seguimiento="insert into correspondencia_seguimiento(
															idcorrespondencia,
															idasesororigen,
															idasesordestino,
															fecha,
															hora,
															descripcion,
															fechafinaliza)
						select $max_correspondencia,
								idasesororigen,
								idasesordestino,
								fecha,
								hora,
								descripcion,
								fechafinaliza
						from correspondencia_seguimiento  
						where idcorrespondencia = $docu";			  
			$result = mssql_query($q_seguimiento);
			
			//SendMsg($mail,$max_correspondencia,$cboEmpleado[$p],$txtDesc."<br>Fecha y Hora de entrega: ".$date9."<br>",$fquien);
			//$row210 = mysql_fetch_row($result210);
		}
//		$SQL = "INSERT INTO acceso(rol,programa) VALUES ($txtRol,$cboPrograma)";
		//$result = mysql_query($SQL);
		//mysql_close($db);
		//header("Location: ../center.php");

		cambiar_ventana("../center.php");

?>

<body>
</body>
</html>

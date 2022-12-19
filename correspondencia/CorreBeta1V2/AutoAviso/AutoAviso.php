<html> 
<head> 
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title> 
<META HTTP-EQUIV="REFRESH" CONTENT="300;AutoAviso.htm"> 
</head> 
<body> 
<?
	function SendMsg($mm,$destinatario,$mensaje){

			$mail = $mm;
			$mail->IsSMTP();
			$mail->Host = "me-s-mail";
			$mail->SMTPAuth = true;
			$mail->Username = "Alerta de Correspondencia";
			$mail->Password = "cafta2006";

			$mail->From = "infocomex@mineco.gob.gt";
			$mail->FromName = "Aviso de Correspondencia";
			$mail->AddAddress($destinatario,"Destinatario");
			$mail->WordWrap = 100;                                 // set word wrap to 50 characters
			$mail->IsHTML(true);                                  // set email format to HTML
			$mail->Subject = "Usted tiene correspondencia";
			$mail->Body    = $mensaje;
			$mail->AltBody = "Usted tiene correspondencia";
				if(!$mail->Send())
				{
				   echo "Message could not be sent. <p>";
				   echo "<br> FromName = Pahola";
				   echo "<br> AddAddress(pfuentes@mineco.gob.gt,pahola)";
				   echo "<br> Mailer Error: " . $mail->ErrorInfo;
				}
				else
				{
					echo "Message has been sent";
				}
	return true;
}
?>

<?
		require_once('../conexion.inc');
		require("class.phpmailer.php");
		$mail = new PHPMailer();
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
		$SQL = "select e.email,if((fechaentrega-curdate())<=0,
							concat('Hoy tiene que entregar ',
									'<br>Asunto: ',titulo,
									'<br>Descripcion: ',descr, 
									'<br>',horaentrega),
							concat('Le faltan ',(fechaentrega-curdate()),' dia(s)',
									'<br>Asunto: ',titulo,
									'<br>Descripcion: ',descr, 
									'<br>Fecha entrega ',fechaentrega,' a las ',horaentrega)
							) mensaje,titulo,
						descr, date_format(fechaenvio,'%d/%m/%Y'), horaenvio, 
						if(fechaentrega=curdate(),'',date_format(fechaentrega,'%d/%m/%Y')),
						horaentrega,idcorrespondencia,
						hour(TIMEDIFF(curtime(),horaentrega)),
						minute(TIMEDIFF(horaentrega,curtime())),
						datediff(fechaentrega,curdate()),
						TIMEDIFF(horaentrega,curtime()),TIMEDIFF(horaentrega,curtime())<0
				from correspondencia c1,empleados e
				where carpeta <> 3 and  
					fechaentrega <> '0000/00/00' and 
					e.idempleado = idempleado2 and 
					fechaentrega-curdate() > 0";
					//print $SQL;
		$result = mysql_query($SQL); 
		while ($row = mysql_fetch_row($result))
		{
			print $row[0]."<br>";
			SendMsg($mail,$row[0],$row[1]);
		}
?>
</body> 
</html> 

<?
require_once("class.phpmailer.php");
$mail = new PHPMailer();

function envio($dest_n,$dest_c,$rem_n,$rem_c,$texto,$titulo,$a1,$a2)
{
	global $mail;
	$mail->IsSMTP();
	$mail->Host = "me-s-mail.mineco.gob.gt";
	$mail->SMTPAuth = false;
	//$mail->Username = "";
	//$mail->Password = "";
	$mail->From = "$rem_c";
	$mail->FromName = "$rem_n";
	$mail->AddAddress("$dest_c");
	$mail->Timeout=30;
	$mail->WordWrap = 5000;
	$mail->IsHTML(true);
	$mail->Subject = "$titulo";
	$mail->Body    = $texto;
	$mail->AltBody = "$titulo";
	if (strlen($a1)>0)    $mail->AddAttachment("$a2", "$a1");
	$exito = $mail->Send();

	$status = 0;
	if(!$exito)
	{
	    //print "Error en envio de correo: ".$mail->ErrorInfo;
		$status = 0;
	}else
	{
		//print "Si se envio el correo";
		$status = 1;
	}
		
	/*
		require_once('../Connections/conexion.php');
		mysql_select_db($database_redes);
	
		$query1 = "INSERT INTO correo1
					(nombredestinatario,correodestinatario,nombreremitente,correoremitente,cuerpo,
					subject,fechaenvio,status,msgerror)
					values
					('$dest_n','$dest_c','$rem_n','$rem_c','$texto',
					'$titulo',curdate(),$status,'$mail->ErrorInfo')";
	
		mysql_query($query1);
	*/
	return true;
}

?>

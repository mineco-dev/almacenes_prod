<?php
session_start(); 
//require("class.phpmailer.php");
//include('INCLUDES/inc_header.inc');
//			$dbms=new DBMS($conexion); 

require("class.phpmailer.php");
$mail = new PHPMailer();
if (SendMsg('kramirez@mineco.gob.gt') )
{
 print'enviado';
}

function SendMsg($mm)
{
//      $mm="miguate@atel.com.gt";
//      $mm="kramirez@mineco.gob.gt";
/*      $mail = $mm;
      $mail->IsSMTP();
//      $mail->Host = "mail.miguate.com.gt";\
			$mail->Host = "128.5.8.26";	  
      $mail->SMTPAuth = true;
      $mail->Username = "no-reply@atel.com.gt";
      $mail->Password = "2007noreply";

      $correo="no-reply@atel.com.gt";
      $noms="no-reply";
      $correo_to="miguate";
      $noms_to="no-reply";

      $Msg = "\r\n\r\n";
      $UserData .= "Nombre.....: " . $_POST["Itm_1"] . "\r\n";
      $UserData .= "E-mail.....: " . $_POST["Itm_2"] . "\r\n";
      $UserData .= "Comentario.: " . $_POST["Itm_3"] . "\r\n";  */
	  
	  			$mail = $mm;
				$bod = 'prueba';
			$mail->IsSMTP();
//			$mail->Host = "me-s-mail.mineco.gob.gt";
			$mail->Host = "128.5.8.26";
			$mail->SMTPAuth = true;
			$mail->Username = "infocomex";
			$mail->Password = "cafta2006";
/*			$mail->Username = "kramirez";
			$mail->Password = "964587";*/

//			$mail->From = $row21[0];
			$mail->From = $correo;
//			$mail->FromName = $row21[1];
			$mail->FromName = $noms;
//			$mail->AddAddress($row[0],$row[1]);
			$mail->AddAddress($correo_to,$noms_to);
			$mail->WordWrap = 100;                                
			$mail->IsHTML(true);                                  
			$mail->Subject = "Usted tiene correspondencia";
			$mail->Body    = $bod;
			$mail->AltBody = "Usted tiene correspondencia";
	  

       $mail->From = $correo;
       $mail->FromName = $noms;
       $mail->AddAddress($correo_to,$noms_to);
       $mail->WordWrap = 100;                                
       $mail->IsHTML(true);                                  
       $mail->Subject = "Mensaje Productos MiGuate";
       $mail->Body    = $Msg.$UserData;
       $mail->AltBody = "Mensaje Productos MiGuate";
       if(!$mail->Send())
       {
           echo "Message could not be sent. <p>";
           echo "<br> FromName = $noms";
           echo "<br> AddAddress($correo,$noms)";
           echo "<br> Mailer Error: " . $mail->ErrorInfo;
        }
        else
        {
           @header("Location: ../home.html");
        }
				return true;
	}
?>

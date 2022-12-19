<? 

if (isset($_POST['action'])) {
// $dest = "kalki.ramirez@gmail.com";
 $dest = "kramirez@mineco.gob.gt";
 $head = "From: ".$_POST['email']."\r\n";
// $head.= "To: kalki.ramirez@gmail.com\r\n";
$head.= "To: kramirez@mineco.gob.gt\r\n";

 // Ahora creamos el cuerpo del mensaje
 $msg = "------------------------------- \n";
 $msg.= "         Comentarios            \n";
 $msg.= "------------------------------- \n";
 $msg.= "NOMBRE:   ".$_POST['nombres']."\n";
 $msg.= "EMPRESA:  ".$_POST['empresa']."\n";
 $msg.= "EMAIL:    ".$_POST['email']."\n";
 $msg.= "TELEFONO: ".$_POST['telefono']."\n";
 $msg.= "ANEXO:    ".$_POST['anexo']."\n";
 $msg.= "HORA:     ".date("h:i:s a ")."\n";
 $msg.= "FECHA:    ".date("D, d M Y")."\n";
 $msg.= "IP:       ".$REMOTE_ADDR."\n";
 $msg.= "------------------------------- \n\n";
 $msg.= $_POST['comentarios']."\n\n";
 $msg.= "------------------------------- \n";
 $msg.= " Mensaje creado por blog.unijimpe.net \n";
 
 print $dest.'<br>';
 print $head.'<br>';
 // Finalmente enviamos el mensaje
 if (mail($dest, "Comentarios", $msg, $head)) {
  $aviso = "Su mensaje fue enviado.";
 } else {
  $aviso = "Error de env�o.";
 }
 print $aviso.'<br>';
 print $msg.'<br>';
} 
?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<form action="contactenos.php" method="post">
Nombres: <input name="nombres" type="text"><br>
Empresa: <input name="empresa" type="text"><br>
E-mail: <input name="email" type="text"><br>
Telefono: <input name="telefono" type="text"><br>
Comentarios:
<textarea name="comentarios" cols="30" rows="5">
</textarea><br>
<input name="action" type="hidden" value="send">
<input name="enviar" type="submit" value="Enviar">
</form> 
</body>
</html>



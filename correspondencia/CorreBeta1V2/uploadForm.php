<?
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	session_start();

	$_SESSION['folder'] = "correBeta1V2/";
	$_SESSION['pagina'] = $page;

	include('../security.php');
	print $_SESSION['iso_registro'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <b>Campo de tipo texto:</b>
    <br>
    <input type="text" name="cadenatexto" size="20" maxlength="100">
    <input type="hidden" name="MAX_FILE_SIZE" value="100000">
    <br>
    <br>
    <b>Enviar un nuevo archivo: </b>
    <br>
    <input name="userfile" type="file">
    <br>
    <input type="submit" value="Enviar">
</form>
<p>&nbsp;</p>
<p>f</p>
<p class="header">dadfasdf</p>
<p class="nav_bottom_selected">dfdsdSD</p>
<p class="connected">&nbsp;</p>
<table width="100%"  border="1">
  <tr class="nav_header">
    <td class="FlippableImage">DFASDF</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="FlippableImage">DFD</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="FlippableImage">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="FlippableImage">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="FlippableImage">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p class="text2">&nbsp;</p>
</body>
</html>

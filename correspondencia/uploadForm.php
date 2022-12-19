<?
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	session_start();

	$_SESSION['nivel']=1;
	include('valida.php');

	$_SESSION['folder'] = "correBeta1V2/documento/";
	$_SESSION['pagina'] = $page;

	
	//print $_SESSION['iso_registro'];
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
.Estilo3 {
	color: #FFFFFF;
	font-weight: bold;
}
-->

</style>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<link href="../style/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
	color: #0033CC;
}
-->
</style></head>

<body>
<?	
//include('conectarse.php');
//envia_msg('aqui si uploadform');
?>
<form action="upload.php<? print "?insti=$txtInsti&quien=$txtQuien&ref=$txtRef&titulo=$txtTitulo&desc=$txtDesc";?>" method="post" enctype="multipart/form-data">
  <br>
  <br>
  <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="5">
    <tr bgcolor="#000000">
      <td width="14%" bgcolor="#0033FF">&nbsp;</td>
      <td width="86%" bgcolor="#0033FF"><div align="center"><span class="Estilo3">Adjuntar Documentos</span></div></td>
    </tr>
    <tr>
      <td><strong>Archivo a Subir </strong></td>
      <td><input name="userfile" type="file"></td>
    </tr>
    <tr>
      <td><strong>Descripcion</strong></td>
      <td><textarea name="txtDescripcion" cols="45" rows="10" id="txtDescripcion"></textarea>
			<? 
/*			envia_msg($_POST['docu'].' este es el docu post');
			envia_msg($usuario);
			envia_msg($_SESSION['usuario']);*/
			?>
          <input name="docu" type="hidden" id="Proyecto" value="<? echo $_POST['docu'];?>"></td>
      <br>
      <br>
    </tr>
  </table>
  <div align="center"><br>
    <input type="submit" name="Submit" value="Enviar">
  </div>
</form>
<b> </b>
</body>
</html>


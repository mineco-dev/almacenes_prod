<?
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	session_start();

$_SESSION['nivel']=2;
include('../../valida.php');

	$_SESSION['folder'] = "correBeta1V2/visualiza/";
	$_SESSION['pagina'] = $page;

//	include('../../security.php');
//	print $_SESSION['iso_registro'];
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
<link href="../style/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<?
	//print "docu-$iddocumento";
	//$docu = $iddocumento;
//include('../../conectarse.php');
?>
<table width="80%" border="0" align="center" cellspacing="0">
  <tr>
    <th scope="col"><form action="upload.php<? print "?docu=$docu";?>" method="post" enctype="multipart/form-data">
      <br>
      <br>
      <table width="80%"  border="0" align="center" cellpadding="0" cellspacing="5">
        <tr bgcolor="#000000">
          <td width="25%">&nbsp;</td>
          <td width="75%"><div align="center"><span class="Estilo8">Adjuntar Documentos</span></div></td>
        </tr>
        <tr>
          <td><strong>Archivo a Subir </strong></td>
          <td><input name="userfile" type="file"></td>
        </tr>
        <tr>
          <td><strong>Descripcion</strong></td>
          <td><textarea name="txtDescripcion" cols="45" rows="10" id="txtDescripcion"></textarea>
              <input name="docu" type="hidden" id="Proyecto" value="<? echo $docu;?>"></td>
          <br>
          <br>
        </tr>
      </table>
      <div align="center"><br>
          <input type="submit" name="Submit" value="Enviar">
      </div>
    </form></th>
  </tr>
</table>
<b> </b>
</body>
</html>


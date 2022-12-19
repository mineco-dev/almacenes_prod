<?
	session_start();

$_SESSION['nivel']=2;
include('../../valida.php');

 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];


	$_SESSION['folder'] = "correBeta1V2/adjuntar/";
	$_SESSION['pagina'] = $page;

	//include('../../security.php');
	//print $_SESSION['iso_registro'];
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo8 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 16px;
}
-->

</style>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
<link href="../style/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo8 {font-size: 14px}
.Estilo9 {
	font-size: 14px;
	font-weight: bold;
}
.Estilo11 {
	color: #660000;
	font-size: 10px;
}
.Estilo12 {font-size: 10px}
.Estilo18 {font-size: 10px;
	font-weight: bold;
}
.Estilo21 {	color: #660033;
	font-size: 10px;
}


-->
</style>
</head>

<body>
<table width="100%" class="Estilo21">
	<td align="left" bgcolor="#990000" width="15%" class="Estilo21" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
	</td>
	<td align="right">
		<p align="right"><span class="Estilo18"><a href="../center.php"><span class="Estilo21"><-- Regresar al Menu</span></a></span></p>
	</td>
</table>


<table width="100%" border="0" cellspacing="0">
  <tr>
    <th align="center" valign="middle" scope="col"><form action="upload.php" method="post" enctype="multipart/form-data">
      <br>
      <br>
      <table width="80%"  border="0" align="center" cellpadding="0" cellspacing="5">
        <tr bgcolor="#000000">
          <td width="25%" bgcolor="#00CCFF">&nbsp;</td>
          <td width="75%" bgcolor="#00CCFF"><div align="center"><span class="Estilo8">Adjuntar Documentos</span></div></td>
        </tr>
        <tr>
          <td><span class="Estilo9">Archivo a Subir </span></td>
          <td><input name="userfile" type="file"></td>
        </tr>
        <tr>
          <td><span class="Estilo9">Descripcion</span></td>
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


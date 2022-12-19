<?
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	session_start();

	$_SESSION['folder'] = "correBeta1V2/";
	$_SESSION['pagina'] = $page;

	include('../security.php');
	print $_SESSION['iso_registro'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.Estilo2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #666666;
}
.Estilo5 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: smaller; }
.Estilo6 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 14px;
}
.Estilo8 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo11 {font-size: 14px}
.Estilo12 {font-size: 12px}
.Estilo13 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #3366FF;
}
.Estilo14 {font-family: Georgia, "Times New Roman", Times, serif}
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
.Estilo16 {	font-size: 14pt;
	color: #3366CC;
	font-weight: bold;
}
.Estilo18 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	color: #3366CC;
	font-size: 14px;
}
.Estilo20 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #3366FF;
	font-weight: bold;
}
.Estilo22 {color: #3366FF}
.Estilo23 {	font-size: 10px;
	color: #660000;
}
.Estilo24 {font-size: 18px;
	font-weight: bold;
}
-->
</style>
</head>

<body>
<form name="form1" method="post" action="datos_personales.php">
  <table width="63%"  border="0" align="center">
    <tr>
      <th scope="col"><div align="left"><span class="Estilo24"><a href="center.php"><img src="tareas.gif" width="16" height="16"><span class="Estilo23">Regresar al Menu</span></a></span></div></th>
      <th scope="col"><span class="Estilo12"><? print $letra;?></span><span class="Estilo12">R-RE-22</span></th>
    </tr>
    <tr>
      <th scope="col"><span class="Estilo16">Correspondecia del Viceministerio de Integraci&oacute;n </span></th>
      <th scope="col">&nbsp;</th>
    </tr>
    <tr>
      <th scope="col"><span class="Estilo16">y Comercio Exterior </span></th>
      <th scope="col"><p>&nbsp;</p>      </th>
    </tr>
    <tr>
      <th scope="row"><span class="Estilo18">Ministerio de Econom&iacute;a de Guatemala</span></th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row"><span class="Estilo2"> </span></th>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <th scope="row"><p align="center" class="Estilo5">&nbsp;</p></th>
      <td>&nbsp;</td>
    </tr>
  </table>
  <table width="62%"  border="1" align="center">
    <tr>
      <th scope="col"><p class="Estilo6 Estilo12 Estilo8 Estilo22">Instrucitvos de Correspondencia: </p>        </th>
    </tr>
    <tr>
      <th scope="row"><p align="left" class="Estilo13 Estilo22"><a href="Correspondencia Ingreso Doc"><img src="img/ayuda.jpg" width="16" height="16" border =0"></a>
	  <strong>1. </strong>Crear Correspondencia</strong></div></th>
    </tr>
    <tr>
      <th scope="row"><div align="left" class="Estilo12 Estilo8 Estilo22"><a href="Correspindecia Ingreso"><img src="img/ayuda.jpg" width="16" height="16" border =0"></a>
	<strong>2. Bandeja de Entrada</strong></div></th>
    </tr>
    <tr>
      <th scope="row"><div align="left" class="Estilo20"><a href="Correspondecia Salida 1"><img src="img/ayuda.jpg" width="16" height="16" border =0"></a>
	  <strong>3. Bandeja de Salida</strong></div></th>
    </tr>
    <tr>
      <th scope="row"><div align="left" class="Estilo13"><a href="Correspondencia Finalizada"><img src="img/ayuda.jpg" width="16" height="16" border =0"></a>
	  <strong>4. </strong>Correspondecia Finalizada</strong></div></th>
    </tr>
    <tr>
      <th scope="row"><div align="left" class="Estilo22">5. Correspondencia Almacenada </div></th>
    </tr>
    <tr>
      <th scope="row"><div align="left" class="Estilo13">
        <p><strong>6. Buscar </strong></p>
        </div></th>
    </tr>
  </table>
  <table width="61%"  border="1" align="center">
    <tr>
      <th width="77%" scope="col">        <p align="left" class="Estilo11 Estilo14"></th>
      <th width="23%" scope="col"><div align="right"></div></th>
    </tr>
  </table>
  <div align="right"><span class="Estilo1 Estilo6">    </span>
  </div>
  <p align="center">&nbsp;</p>
  <p>&nbsp; </p>
</form>
</body>
</html>

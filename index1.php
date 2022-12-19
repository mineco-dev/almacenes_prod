<?    

//header('location: http://lvasquez/aseggys/index.php');
	require("includes/funciones.php");
	require("includes/sqlcommand.inc");
	
	if (!isset($_SESSION["subgerencia"])) $dependencia=33;
	else $dependencia=($_SESSION["subgerencia"]);		
	if (!isset($_SESSION["this_cookie"]))
	{
		$user=3;
	}
	else
		{
			$user=($_SESSION["user_id"]);		
		}
?>

<script language='JavaScript'>
//    alert('prueba');
</script>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Tahoma, Verdana;
	font-size: 16px;
	font-style: italic;
	color: #000066;
	font-weight: bold;
}
-->
    </style>
</head>

<!--body leftmargin=0 topmargin=0 marginheight="0" marginwidth="0" bgcolor="#E6E6E6" background="images/fon.gif"-->
<body leftmargin=0 topmargin=0 marginheight="0" marginwidth="0" bgcolor="#FFFFFF">


<!--table border="0" cellpadding="0" cellspacing="0" width="100%" background="images/fon_top.gif" height="113"-->
<table border="0" cellpadding="0" cellspacing="0" width="100%"  bgcolor="#FFFFFF" height="63">
<tr>
	<td height="63" align="center" valign="top">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
	<td width="24%" valign="top" align="left" ><div align="center" class="Estilo1">ASEGGYS AUTOMATIZACION DE SERVICIOS DE LA GERENCIA Y SUBGERENCIAS    	  <!--img border="0" src="images/Escudo.gif" width="106" height="87"></td-->            
          <!--td width="84%" height="68" valign="top" align="left"-->            
          <!--td width="84%" height="48" valign="top" align="left"-->	
          </div>
	  <!--p align="center"><span class="Estilo3"><!--MINISTERIO DE ECONOM&Iacute;A (PC KALKI)<br>
	<span class="Estilo3"><strong>- ASEGGYS - <br><span class="Estilo3">Automatizaci&oacute;n de servicios, Gerencia General y Subgerencias</strong>
	</span></span--></td>
	<td align="left" width="76%">
		<table border="0" cellpadding="0" cellspacing="0" id="table1">
		<tr>
			<td><a href="inicio.php"><img src="images/bo1.gif" width="83" height="42" alt="" border="0"></a></td>
			<td><a href="gerencia.php"><img src="images/b03.gif" width="71" height="42" alt="" border="0"></a></td>
			<td><a href="informatica.php"><img src="images/b02.gif" width="95" height="42" alt="" border="0"></a></td>
			<td><a href="rrhh.php"><img src="images/b04.gif" width="91" height="42" alt="" border="0"></a></td>
			<td><a href="administrativa.php"><img src="images/b05.gif" width="95" height="42" alt="" border="0"></a></td>
			<td><a href="financiero.php"><img src="images/b06.gif" width="107" height="42" alt="" border="0"></a></td>
			<td><a href="planeacion.php"><img src="images/b07.gif" width="89" height="42" alt="" border="0"></a></td>
			<td><a href="comofi.php"><img src="images/b09.gif" alt="Comit&eacute; de modernizaci&oacute;n y  fortalecimiento institucional" width="89" height="42" border="0"></a></td>
			<td><a href="otros_anuncios.php"><img src="images/b08.gif" width="109" height="42" alt="Acceso a opciones avanzadas" border="0"></a></td>
		</tr>
		</table>
	</td>
</tr>
</table>
	</td>
</tr>
</table>
<div align="left">
<!--table width="98%" height="65%" border="0" cellpadding="0" background="images/fon.gif" style="border-collapse: collapse"-->
<table width="100%" height="100%" border="0" cellpadding="0"  bgcolor="#FFFFFF" style="border-collapse: collapse">
	<tr valign="top">
		<td width="16%" rowspan="2">
		&nbsp;<table border="0" cellpadding="0" cellspacing="0" width="159" background="images/fon_left02.gif">
		<tr>
			<td width="159" height="26" background="images/left01.gif"><p class="title">
			<?
			include("dependencia.php");
			?></p></td>
		</tr>
		<Tr align="right"><td width="159" >
		<?
			include("menu.php");	
		?>
		</td>
		</tr>
		<tr>
		<td>
		
		
		<?
			include("login.php");	
		?>
		</td>
		</tr>
		<tr>
			<td><img src="images/left_bot02.gif" alt="" width="159" height="17" border="0"></td>
		</tr>
		</table>	
	</td>
	<!--td width="100%" height="50%" bgcolor="#ABCBF1"><img src="images/m11.gif" width="1" height="16" alt="" border="0"><img src="images/px1.gif" width="1" height="1" alt="" border="0"-->
	<td width="100%" height="98%" bgcolor="#3399FF" ="#6699FF" bordercolor="#FF9900"><!--img src="images/m11.gif" width="1" height="16" alt="" border=""><img src="images/px1.gif" width="1" height="1" alt="" border="0"-->	
	  <p>	  
<iframe name="body" width="99%" height="98%" src="body.php" frameborder="0"  marginwidth="0" marginheight="0" >
El explorador no admite los marcos flotantes o no está configurado actualmente para mostrarlos.
</iframe>
	<img src="images/px1.gif" width="1" height="1" alt="" border="0"></td>
</tr>
</table>
</div>
<table border="0" cellpadding="0" cellspacing="0" width="740" align="center">
<tr>
	<td align="right" background="images/bot.gif" width="800"  height="38"  >
		<!--td height="38" align="right" background="images/bot.gif"-->
		<table border="0" cellpadding="0" cellspacing="0" width="570">
		<tr>
			<td>
		<p class="menu02" align="center">
		<a href="http://www.mineco.gob.gt" target="_blank">Portal</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="http://me-s-portal:8085" target="_blank">Intranet</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="http://webmail.mineco.gob.gt" target="_blank">Web-Mail</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="https://siges.minfin.gob.gt" target="_blank">SIGES</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="https://sicoin.minfin.gob.gt" target="_blank">SICOIN</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="https://inventarios.minfin.gob.gt" target="_blank">Inventarios</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<a href="http://www.guatecompras.gt" target="_blank">Guatecompras</a>
		</p>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
<table width="100%" height="80">
<Tr>
<td>
 <!--img src="images/Pie Pagina Grande.jpg" height="90" width="100%"-->
 <!--img src="images/Pie Pagina Grande.jpg"-->
  <img src="images/pie_medio_mod.gif" width=100%>
 </td>
 </Tr>
 <tr>
	<td><p align="center" style="margin-right: 200px;">Copyright &copy;2007 Subgerencia de Inform&aacute;tica - MINECO </p></td>
</tr>

</table>
</body>
</html>

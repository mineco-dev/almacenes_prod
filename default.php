<?    

//header('location: http://lvasquez/aseggys/index.php');
	require("includes/funciones.php");
	require("includes/sqlcommand.inc");	
	
	$dependencia=1;		
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

<div align="left">
<!--table width="98%" height="65%" border="0" cellpadding="0" background="images/fon.gif" style="border-collapse: collapse"-->
<table width="100%" height="100%" border="0" cellpadding="0"  bgcolor="#FFFFFF" style="border-collapse: collapse">
	<tr valign="top">
		<td width="14%" rowspan="2">
		&nbsp;
		<table border="0" cellpadding="0" cellspacing="0" width="162" background="images/fon_left02.gif">
		<tr>
			<td width="176" height="26" background="images/left01.gif"><p class="title">
			<?
			include("dependencia.php");
			?></p></td>
		</tr>
		<Tr align="right"><td width="176" >
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
	<td width="86%" height="98%" bgcolor="#3399FF" ="#6699FF" bordercolor="#FF9900"><!--img src="images/m11.gif" width="1" height="16" alt="" border=""><img src="images/px1.gif" width="1" height="1" alt="" border="0"-->	
	  <p>	  
<iframe name="body" width="99%" height="98%" src="body.php" frameborder="0"  marginwidth="0" marginheight="0" >
El explorador no admite los marcos flotantes o no está configurado actualmente para mostrarlos.
</iframe>
	<img src="images/px1.gif" width="1" height="1" alt="" border="0"></td>
</tr>
</table>
</div>
</body>
</html>

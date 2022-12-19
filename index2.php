

<?  


//Configuracion de la conexion a base de datos
$bd_host = "server_appl"; 
$bd_usuario = "sa"; 
$bd_password = "Sup3rus3r2009"; 
$bd_base = "almacen"; 
$con = mssql_connect($bd_host, $bd_usuario, $bd_password); 
mssql_select_db($bd_base, $con);  

//header('location: http://lvasquez/aseggys/index.php');
	
	//header('location: mantenimiento.php');

	
	require("includes/funciones.php");
	require("includes/sqlcommand.inc");
	
	
	
//validador de ocho dias habiles del sistema de almacen para las requisisciones 

 
  
 $dia_numero= date("d");
$dia_letras = date('D');



  

  conectardb($almacen);											
					$qry_tipo_empresa="SELECT * FROM dbo.fecha";										
					$res_qry_tipo_empresa=$query($qry_tipo_empresa);	
					   
				
					while($row_tipo_empresa=$fetch_array($res_qry_tipo_empresa))
					{
				    $contador = $row_tipo_empresa["id_fecha"];
					$valida =$row_tipo_empresa["dia"];

					}
							
					$free_result($res_qry_tipo_empresa);	
  
  
  
  
  
  

if($dia_numero >=1  && $dia_letras != "Sun" && $dia_letras != "Sat")
{
 
echo $contador= $contador +1;
 
 if($contador <= 8)
 
 {
      
	 if( $dia_numero != $valida)
	  {
	  $qry_actualiza="update dbo.fecha set id_fecha ='$contador', dia='$dia_numero' where id_fecha >=0";
		$query($qry_actualiza);	
	  }
 
 
	  
 }
 




}

            
		
			
		


 //validador de ocho dias habiles del sistema de almacen para las requisisciones 
	
	
	
	
	
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

<link rel="stylesheet" href="menuASDI_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>


<link rel="stylesheet" href="CSS3 Menu.css3prj_files/css3menu1/style.css" /><style type="text/css">._css3m{display:none}</style>

	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
	<!--link rel="stylesheet" type="text/css" href="style.css"-->
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
<body >


<!--table border="0" cellpadding="0" cellspacing="0" width="100%" background="images/fon_top.gif" height="113"-->
 <table border="0" cellpadding="0" cellspacing="0" width="100%" background="images/fondoprueva5.jpg"  height="63">
<tr>
	<td height="63" align="center" valign="top">
<table border="0" cellpadding="0" cellspacing="0" width="100%" background="images/fondoprueva5.jpg">
<tr>
	<td width="24%" valign="top" align="left" ><div align="center" class="Estilo1">SISTEMA DE AUTOMATIZACION ASEGGYS </div>
	  <!--p align="center"><span class="Estilo3"><!--MINISTERIO DE ECONOM&Iacute;A (PC KALKI)<br>
	<span class="Estilo3"><strong>- ASEGGYS - <br><span class="Estilo3">Automatizaci&oacute;n de servicios, Gerencia General y Subgerencias</strong>
	</span></span--></td>
	<td align="left" width="76%">
		<table border="0" cellpadding="0" cellspacing="0" id="table1" background="images/fondoprueva5.jpg">
		<tr>
		
    	<input type="text" disabled="disabled" size="200">
<ul id="css3menu1" class="topmenu" width="76%">


	<li class="topfirst"><a href="inicio.php" style="height:20px;line-height:20px;"><img src="menuASDI_files/css3menu1/home.png" alt=""/>Inicio</a></li>
	<li class="topmenu"><a href="informatica.php" style="height:20px;line-height:20px;">Direccion de Informatica</a></li>
	<li class="topmenu"><a href="administrativa.php" style="height:20px;line-height:20px;">Direccion Administrativa</a></li>
	<li class="topmenu"><a href="financiero.php" style="height:20px;line-height:20px;">Direccion Financiera</a></li>
	<li class="topmenu"><a href="planeacion.php" style="height:20px;line-height:20px;">Planeacion Estrategica</a></li>
	<li class="toplast"><a href="otros_anuncios.php" style="height:20px;line-height:20px;">Otros anuncios </a></li>

</ul>


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


<table width="100%" height="96%" border="0" cellpadding="0"  background="images/fondoprueva5.jpg"style="border-collapse: collapse">

<tr valign="top">
		<td width="207">
		&nbsp;
		<table border="0" cellpadding="0" cellspacing="0" width="162" background="images/fon_left02.gif">
		<tr>
			<td width="162"  align="center"height="26" background="images/left01.gif"><p class="title">
			 <?
			include("dependencia.php");
			?></p></td>
		</tr>
		<Tr align="center"><td width="162" ><?
			include("menu.php");	
		?></td>
		</tr>
		<tr>
		<td><?
			include("login.php");	
		?></td>
		</tr>
		<tr>
			<td><img src="images/left_bot02.gif" alt="" width="159" height="17" border="0"></td>
		</tr>
		</table>	</td>
	<!--td width="100%" height="50%" bgcolor="#ABCBF1"><img src="images/m11.gif" width="1" height="16" alt="" border="0"><img src="images/px1.gif" width="1" height="1" alt="" border="0"-->
	<td width="1453" height="341"><!--img src="images/m11.gif" width="1" height="16" alt="" border=""><img src="images/px1.gif" width="1" height="1" alt="" border="0"-->	
	  <p>	  
 <iframe name="body" width="1024px" height="824px" src="body.php" frameborder="0"  marginwidth="0" marginheight="0"  > 
El explorador no admite los marcos flotantes o no está configurado actualmente para mostrarlos.</iframe>
	  </td>
    </tr>
</table>

</div>
<p>&nbsp;</p>
<table border="0" cellpadding="0" cellspacing="0" width="740" align="center">
<tr>
	<td align="right" background="images/bot.gif" width="800"  height="38"  >
		<!--td height="38" align="right" background="images/bot.gif"-->
		<table border="0" cellpadding="0" cellspacing="0" width="578">
		<tr>
			<td width="603">
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
<table width="100%" height="80" background="images/fondoprueva5.jpg">
<Tr>
<td>
 <!--img src="images/Pie Pagina Grande.jpg" height="90" width="100%"-->
 <!--img src="images/Pie Pagina Grande.jpg"-->
 <!-- <img src="images/pie_medio_mod.gif" width=100%> -->
 </td>
 </Tr>
 <tr>
	<td><p align="center" style="margin-right: 200px;">Copyright &copy;2007-2015 Subgerencia de Inform&aacute;tica - MINECO </p></td>
</tr>

</table>
</body>
</html>

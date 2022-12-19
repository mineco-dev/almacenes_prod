<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
require("includes/funciones.php");
require("includes/sqlcommand.inc");
if (!isset($_SESSION["empresax"])) {
	$_SESSION["empresax"]=1;
}
if (!isset($_SESSION["bodega15"])) {
	$_SESSION["bodega15"]=15;
}


if (!isset($_SESSION["subgerencia"])) {
	$dependencia=33;
}else{
	$dependencia=($_SESSION["subgerencia"]);
}

// if (!isset($_SESSION["subgerencia"])) $dependencia=33;

// 	else $dependencia=($_SESSION["subgerencia"]);	

if (!isset($_SESSION["this_cookie"]))
{
	$user=3;
}
else
{
	$user=($_SESSION["user_id"]);				
}
//echo "<pre>".var_dump($_SESSION)."</pre>";
?>




<!DOCTYPE html>
<html lang="es">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	
	<link rel="stylesheet" type="text/css" href="STYLE/css.css">


	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
    <style type="text/css">

body{
	background: url("images/fondoprueva5.jpg");
	
}

a:link {text-decoration:none}
a:visited {text-decoration:none}
a:hover{text-decoration:none}

    </style>
</head>




<!--body leftmargin=0 topmargin=0 marginheight="0" marginwidth="0" bgcolor="#E6E6E6" background="images/fon.gif"-->
<body >


<nav>
	<ul>
				<li><a href="inicio.php" class="menu">INICIO</a></li>
				<li><a href="administrativa.php" class="menu">ALMACEN</a></li>
				<li><a href="informatica.php" class="menu">INFORMATICA</a></li>
	</ul>
</nav>
<div align="center" class="Titulo">ASEGGYS 2.0 - Sistema almacen MINECO </div>
<div   class="contenedorLogin">
		<div  class="Main" >
			<table width="100%" height="80%" border="0" cellpadding="0"   style="border-collapse: collapse">
				<tr valign="top" >
						<td >
								<table >
										<tr>
												<td  class="dependencia">
													<?php
													 include("dependencia.php");
													?>
												</td>
										</tr>
										<tr align="center" >
												<td width="162">
													<?php
													
														 include("menu.php");	
													?>
												</td>
										</tr>
										<tr>
												<td bgcolor="#CCCCCC" > 
													
												</td>
										</tr>

								</table>
						</td>
				</tr>
		</table>	
  
		</div>
			<div class="login">
			<?php
				include("login.php");	
			?>	
		</div>	
</div>

			<div class="footer" >
			<ul >
					<li ><a href="https://www.mineco.gob.gt/" target="_blank" class="lista" >Portal</a></li>
					
					<li><a href="https://correo.mineco.gob.gt/owa" target="_blank" class="lista" >Web-Mail</a></li>
					<!-- <li><a href="http://192.168.2.244/xampp/diacoweb/SIC" target="_blank" class="lista" >Ariane</a></li> -->
					

					<p >Copyright &copy;2021 Departamento de Tecnolog&iacute;as de la Informaci&oacute;n - MINECO - </p>
			</ul>
			</div>


</body>

<script type="text/javascript">
	
	window.onload = function(){$("#showPassword").hide();}

$("#txtPassword").on('change',function() {  
		if($("#txtPassword").val())
		{
			$("#showPassword").show();
		}
		else
		{
			$("#showPassword").hide();
		}
});

$(".reveal").on('click',function() {
    var $pwd = $("#txtPassword");
    if ($pwd.attr('type') === 'password') 
		{
        $pwd.attr('type', 'text');
    } 
		else 
		{
        $pwd.attr('type', 'password');
    }
});
</script>
</html>

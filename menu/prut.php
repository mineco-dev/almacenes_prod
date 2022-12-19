<? 
session_start();
include('../conexion.php');

$usn=$_SESSION['usern'];

$sql = "select apellido , nombre from usuario where usuario='$usn'";
$stmt = sqlsrv_query( $conn, $sql );
if( $stmt === false) {
    die( print_r( sqlsrv_errors(), true) );
}

while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
//echo	  "hola".$row["nombre"]."  ".$row["apellido"]."</option>"; 
$ap=$row["apellido"];
$nom=$row["nombre"];

}
sqlsrv_free_stmt( $stmt);	



if ($_GET['action']=='exit')
{
  session_destroy();
?>

 <meta http-equiv="refresh" target="true" content="0;url=http://128.5.101.78:8080/phpformularioveta/login.php">
 
<? } ?>

  <style type="text/css">
<!--
.Estilo1 {
	color: #FFFFFF;
	
	font-size: 36px;
}
-->
</style>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
		<!-- Start css3menu.com HEAD section -->
	<link rel="stylesheet" href="CSS3 Menu.css3prj_files/css3menu1/style.css" type="text/css" /><style type="text/css">._css3m{display:none}</style>
	<!-- End css3menu.com HEAD section -->

	
</head>
<body background="images/tecnologiablogfondosuniverso.jpg" >
<!-- Start css3menu.com BODY section -->
<ul id="css3menu1" class="topmenu">
<input type="checkbox" id="css3menu-switcher" class="switchbox"><label onclick="" class="switch" for="css3menu-switcher"></label>


	<li class="topfirst"><a href="../ingreso.php" target="despliegue"  style="height:22px;line-height:22px;">Ingresos</a></li>
	<li class="topmenu"><a href="../consulta/consulta.php" target="despliegue" style="height:22px;line-height:22px;">Pendientes</a></li>
	<li class="toplast"><a href="../consulta_especifica/consultaespesifica.php" target="despliegue" style="height:22px;line-height:22px;">Consulta especifia</a></li>
	<li class="toplast"><a href="../ingresoempresa/ingresoem.php" target="despliegue" style="height:22px;line-height:22px;">Ingrese nuevas empresas</a></li>
	<li class="toplast"><a href="?action=exit" target="true" style="height:22px;line-height:22px;">sing out</a></li>
</ul><p class="_css3m"><a href="http://css3menu.com/">css3 dropdown menu</a> by Css3Menu.com</p>

<table width="500"  align="right">
  <tr>
    <td> 
 <span class="Estilo1"> <?  echo  " Bienvenido  ",$nom," ",$ap, " ";?></span> </td>
  </tr>
</table>



<!-- End css3menu.com BODY section -->

</body>
</html>

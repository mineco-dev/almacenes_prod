<?php
//INICIO DE LA SESION
session_start();

// ESTE ES EL LOGEO DEL USUARIO **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  
  session_unregister('MM_Username');
  session_unregister('MM_UserGroup');
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php include('restrict.php'); ?>
<?php require_once('Conn.php'); ?>
<?php

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mssql_select_db($database_Conn, $Conn);

$query_Recordset1 = sprintf("SELECT * FROM usuarios WHERE usuario = '%s'", $colname_Recordset1);
$Recordset1 = mssql_query($query_Recordset1, $Conn) or die(mssql_error());
$row_Recordset1 = mssql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mssql_num_rows($Recordset1);

?>
<?php
mssql_free_result($Recordset1);
?>

<html>
<style type="text/css">
<!--
.Estilo1 {color: #FF0000}
body {
	background-color: #FFFFFF;
}
body,td,th {
	color: #0000CC;
}
-->
</style> 







<body> 
<p>Bienvenido <?php echo $row_Recordset1['nombre']; ?>!</p>

<form method='post' action='SECRETARIACONSULTA.PHP'> 
  <div align="center">
    <p class="Estilo1">PAQUETES PENDIENTES EN SECRETARIA</p>
    <p>      <?php 
$link = mssql_connect("SERVER_APPL", "msjharry", "lisa1607"); 
mssql_select_db("MENSAJERIA", $link);
$result = mssql_query("SELECT INGRESO, DETALLE, RECIBIO, NOMBRE_REMITENTE, FECHA, NOMBRE_EMPLEADO, DESCRIPCION, EMPLEADO, REMITENTE FROM VISTA1 WHERE STATUS='SECRETARIA'", $link); 
$i=0;
if ($row = mssql_fetch_array($result)){
   echo "<table width = '925' border = '2'> \n"; 

   echo "<tr><td>INGRESO</td><td>DETALLE</td><td>RECIBIO</td><td>REMITENTE</td><td>DESTINATARIO</td> <td>DESCRIPCION</td><td>DESCARGA</td></tr> \n"; 
   do {
	$cod = $row["DETALLE"];
     $codigo[ ] = $row["DETALLE"];
     $numelentos = count($codigo);
     $chk[ ] = "chk$i";
     echo "<tr><td>".$row["INGRESO"]."</td><td>"  .$row["DETALLE"]."</td><td>" .$row["RECIBIO"]."</td><td>" . $row["REMITENTE"]."</td><td>".$row["EMPLEADO" ]."</td><td>".$row["DESCRIPCION" ]."</td>
			<td> 
			<a href=\"ACTUALIZASECRETARIA.PHP?codigo=$cod\">Descargar</a>
			</td>
			</tr> \n"; 
//			echo "<a href=\"RECEPCIONCONSULTA.PHP\">Descargar</a>";
//<input type='checkbox' name=".$chk[$i]." value =1 >
        $i++;
     } while ($row = mssql_fetch_array($result));
   echo "</table> \n";
   



} else { 
echo "¡ No se ha encontrado ningún registro !"; 
}

?> 



    



    <p>  </div>
</form>  

 <p>&nbsp;</p>
<div align="center">   <a href="encabezado1.php?cmd=resetall" class="Estilo4"> <img src="imagenes/VOLVER.GIF" width="50" height="31" >
MENU  </a>   </div>


</body> 
</html>





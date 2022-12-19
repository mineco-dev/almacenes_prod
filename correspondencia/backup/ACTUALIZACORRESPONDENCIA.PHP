<?
session_start();

$link = mssql_connect("SERVER_APPL", "msjharry", "lisa1607"); 
mssql_select_db("MENSAJERIA", $link);

if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}

$query = "SELECT  ID, nombre, password FROM usuarios WHERE usuario = '$colname_Recordset1'";
$Recordset1 = mssql_query($query, $link) or die(mssql_error());
$Recordset2 = mssql_query($query, $link) or die(mssql_error());
$row_Recordset1 = mssql_fetch_assoc($Recordset1);
$row_Recordset2 = mssql_fetch_assoc($Recordset2);


$nom = $row_Recordset1["nombre"];
$ids = $row_Recordset2["ID"];

//$fec = date("d")."/".date("m")."/".date("Y");
//$hor = date("H:i:s:A");
//$status = ("MENSAJERIA");

$result = mssql_query("update usuarios set password='$password1' where ID='$ids'", $link);

//$result = mssql_query("UPDATE VISTA1 SET STATUS='SECRETARIA' WHERE DETALLE = $codigo",$link); 
//$result=mssql_query("INSERT INTO HISTORIAL (CODIGO_DETALLE, RECIBIO_HISTORIAL, FECHA_HISTORIAL, HORA_HISTORIAL, STATUS)
//       VALUES ($codigo, '$nom', '$fec', '$hor', '$status') ",$link);

print "<div align=\"center\"><a href=encabezado1.php> $nom modifico su contraseña su registro es el No. $ids, presione aqui para regresar</a></div>";
?>

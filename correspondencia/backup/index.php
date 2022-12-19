<?php
//initialize the session
session_start();

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
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
//End NeXTenesio Special List Recordset
?>
<?php
mssql_free_result($Recordset1);
?>
<body>
<table width="96%"  border="0" cellspacing="0">
  <tr>
    <td width="71%">Bienvenido <?php echo $row_Recordset1['nombre']; ?>! </td>

	<td width="29%"><a href="MENUINGRESOSDEPATAMENTO.php?cmd=resetall" class="Estilo4">MENU PRINCIPAL</a></td>
    <td width="29%"><a href="<?php echo $logoutAction ?>">Salir</a></td>
  </tr>
</table>
</body>

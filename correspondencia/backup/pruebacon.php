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
<style type="text/css">
<!--
.Estilo1 {color: #FF0000}
-->
</style>



 


<form name="form1" method="post" action="ACTUALIZACORRESPONDENCIA.PHP">
		    <p align="center" class="Estilo1">CAMBIO DE PASSWORD</p>
		    <table width="296" border="3" align="center" cellpadding="5" cellspacing="0">
    <tr>

<th width="100" scope="col">USUARIO   <?php echo $row_Recordset1['ID']; ?> </th>
  <th width="182" scope="col" class="Estilo10"><div align="left"><?php echo $row_Recordset1['nombre']; ?>  
		<input name="ID" type="hidden" id="ID" value="<?php echo $row_Recordset1['nombre']; ?>  <?php echo $row_Recordset1['ID']; ?>" >


<td width="100" scope="col"></td>

      <td width="148"><div align="center"><strong> PASSWORD</strong></div></td>
      <td width="140"><input name="password1"  type="password" id="password" size="35" ></td>

    </tr>
    <tr>
</td>

     
      
    </tr>
  </table>




            <div align="center"></div>
            <div align="center"></div>
            <p align="center">
              <input type="submit" name="Submit" value="CAMBIAR">
</p>
            <p>&nbsp;</p>
</form>



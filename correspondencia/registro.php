<?php require_once('Conn.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

$pass = md5($_POST['password']);

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO usuarios (usuario, password, nombre, apellido, email) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['usuario'], "text"),
                       GetSQLValueString($pass, "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['apellido'], "text"),
                       GetSQLValueString($_POST['email'], "text"));

  mssql_select_db($database_Conn, $Conn);

  $Result1 = mssql_query($insertSQL, $Conn) or die(mssql_error());

  $insertGoTo = "login.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
?>
<form name="form1" action="<?php echo $editFormAction; ?>" method="POST">
  <table width="90%"  border="0" cellspacing="0">
    <tr>
      <td> Nombre de usuario</td>
      <td><input name="usuario" type="text" id="usuario"></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input name="password" type="password" id="password"></td>
    </tr>
    <tr>
      <td> Nombre </td>
      <td><input name="nombre" type="text" id="nombre"></td>
    </tr>
    <tr>
      <td>Apellido</td>
      <td><input name="apellido" type="text" id="apellido"></td>
    </tr>
    <tr>
      <td> E-Mail</td>
      <td><input name="email" type="text" id="email"></td>
    </tr>
  </table>
  <p>


    <input type="hidden" name="MM_insert" value="form1">
    <input type="submit" name="Submit" value="Enviar">
</p>
</form>

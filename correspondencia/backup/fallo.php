<?php require_once('Conn.php'); ?>
<?php
// *** Validate request to login to this site.
session_start();

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($accesscheck)) {
  $GLOBALS['PrevUrl'] = $accesscheck;
  session_register('PrevUrl');
}

if (isset($_POST['usuario'])) {
  $loginUsername=$_POST['usuario'];
  $password=md5($_POST['password']);
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "encabezado1.php";
  $MM_redirectLoginFailed = "fallo.php";
  $MM_redirecttoReferrer = false;
  mssql_select_db($database_Conn, $Conn);
  
  $LoginRS__query=sprintf("SELECT usuario, password FROM usuarios WHERE usuario='%s' AND password='%s'",
    get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mssql_query($LoginRS__query, $Conn) or die(mssql_error());
  $loginFoundUser = mssql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
    //declare two session variables and assign them
    $GLOBALS['MM_Username'] = $loginUsername;
    $GLOBALS['MM_UserGroup'] = $loginStrGroup;	      

    //register the session variables
    session_register("MM_Username");
    session_register("MM_UserGroup");

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>
<form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
  <div align="center">Nombre de usuario o password incorrectos<br>
  </div>
  <table width="90%"  border="0" cellspacing="0">
    <tr>
      <td>Nombre de usuario </td>
      <td><input name="usuario" type="text" id="usuario"></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><input name="password" type="password" id="password"></td>
    </tr>
  </table>
  <p>
    <input type="submit" name="Submit" value="Aceptar">
  </p>
</form>
</body>
</html>

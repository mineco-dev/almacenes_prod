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





<html>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>  


<style type="text/css">
<!--
.botones {  font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; color: #FFFFFF; background-color: #0099FF; border-color: #000000 ; border-top-width: 1pix; border-right-width: 1pix; border-bottom-width: 1pix; border-left-width: 1pix}
.imputbox {  font-size: 10pt; color: #000099; background-color: #CCFFCC; font-family: Verdana, Arial, Helvetica, sans-serif; border: 1pix #000000 solid; border-color: #000000 solid; font-weight: normal}
.Estilo2 {color: #0000CC}
.Estilo5 {
	font-family: Tahoma;
	font-size: 10pt;
	color: #1C73A7;
}
.botones1 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9pt; color: #FFFFFF; background-color: #000099; border-color: #000000 ; border-top-width: 1pix; border-right-width: 1pix; border-bottom-width: 1pix; border-left-width: 1pix}
.imputbox1 {font-size: 10pt; color: #000099; background-color: #FFFFFF; font-family: Verdana, Arial, Helvetica, sans-serif; border: 1pix #000000 solid; border-color: #000000 solid; font-weight: normal}
.Estilo7 {color: #1C73A7}
.Estilo9 {color: #1C73A7; font-weight: bold; }
body {
	background-color: #CCCCCC;
}
body,td,th {
	color: #ECE9D8;
}
-->
</style>

<body>
<div align="center"><span class="botones"></span><span class="imputbox"></span>
</div>
<table width="700" height="676" align="center">
  <tr>
    <th width="56" rowspan="4" scope="col"><img src="img/barra_vertical.jpg" width="108" height="648"></th>
    <th width="632" scope="col"><img src="imagenes/mineco1.jpg" width="573" height="63"></th>
  </tr>
  <tr>
    <th scope="col"><div align="center"><img src="imagenes/prog_filled.png" width="175" height="15"><img src="imagenes/prog_filled.png" width="175" height="15"><img src="imagenes/prog_filled.png" width="175" height="15"></div></th>
  </tr>
  <tr>
    <th height="366" scope="col"><form name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
      <table width=47% border=0 align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
  <tr bgcolor="#0099FF">
    <td height="45" colspan="2" bordercolor="#FFFFFF" bgcolor="#1C73A7"><div align="center"><font face="Arial" color="#FFFFFF" size=2><b>INGRESE SUS DATOS <br>
    </b></font></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center">
        <table width="100%" border="0" cellpadding="5" cellspacing="0" bordercolor="#0000FF">
          <tr valign="middle" bgcolor="#FFFFFF">
            <td height="30" colspan="2"><div align="center"> </div></td>
          </tr>
          <tr>
            <td width="39%" bgcolor="#FFFFFF"><div align="right" class="Estilo2"><font face="Verdana, Arial, Helvetica, sans-serif" size="2"><span class="Estilo7"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Usuario</font></span>: </font></div></td>
            <td width="61%" bgcolor="#FFFFFF"><div align="left">
                <input name="usuario" type="text" id="usuario">
            </div></td>
          </tr>
          <tr>
            <td width="39%" bgcolor="#FFFFFF"><div align="right" class="Estilo5"><font face="Verdana, Arial, Helvetica, sans-serif" size="2">Password : </font></div></td>
            <td width="61%" bordercolor="#FFFFFF" bgcolor="#FFFFFF"><div align="left">
                <input name="password" type="password" id="password">
            </div></td>
          </tr>
        </table>
    </div></td>
  </tr>
  <tr valign="middle">
    <td height="50" colspan="2" bgcolor="#FFFFFF"><div align="center"><font face="Arial" color=black size=2>
      <input name=submit type=submit value="Enviar" class="botones1">
    </font></div></td>
  </tr>
</table>
    </form>    </th>
  </tr>
  <tr>
    <th height="118" scope="col"><span class="Estilo9"> <img src="imagenes/ajax-loader.gif" width="220" height="19"></span></th>
  </tr>
</table>
<div align="center"></div>
<div align="center"><br>
  <br>
  <br>
</div>
</body>
</html>

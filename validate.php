<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require("includes/funciones.php");
require("includes/sqlcommand.inc");


//include("samples/conectarse.php");
function make_safe($variable) 
{ 
	$variable = addslashes(trim($variable)); 
	return $variable; 
} 


/*function envia_msg($msg)
{
	echo("<script language='JavaScript'>");
	echo("alert('$msg');");
	echo("</script>");
}*/

header("Pragma: ");
header("Cache-Control: ");
header("Expires: Mon, 26 Jul 2007 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, proxy-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
//set global variables
global $username, $password, $user_id, $complete_name, $user_name, $pw, $group_id;
$username = make_safe(strtoupper($_POST['username'])); 
$password = make_safe(md5($_POST['password'])); 

require_once('connection/helpdesk.php');
//include('correspondencia/conectarse.php');

// session_register('usrcor');
// session_register('passcor');
// session_register('codigoUsuario');
$_SESSION['usrcor']= $username;
$_SESSION['passcor'] = $password;

/*envia_msg('username '.$_SESSION['usrcor']) ;
envia_msg('password '.$_SESSION['passcor']);	*/

$consulta = "Select * from usuario where nombre_usuario = '$username' and contrasena = '$password' and activo=1";


$result=mssql_query($consulta);
while($row=mssql_fetch_array($result))  
{
	$user_cod=$row['codigo_usuario'];			

	$complete_name=$row['nombres'];						
	$user_name=$row['nombre_usuario'];

	$pw=$row['contrasena'];
	$group_id=$row['codigo_grupo_enc'];
	$dependencia=$row['codigo_dependencia'];
	include('correspondencia/conectarse.php');
	/* selecciona el codigo de asesor de la base rrhh */
	include('correspondencia/INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 


	$qtv = "SELECT idasesor from asesor where usuario = '$username' and password = '$password' and habilitado = 'Y'";

	$rtv = mssql_query($qtv);

	while($roww=mssql_fetch_array($rtv))
	{
//									print $qtv."aaa";
//				envia_msg("query".$qtv);
//				print "<br>".$roww[0];
		$_SESSION['codigoUsuario'] = $roww[0];
	}	
	dirname('../');
}				

mssql_close($s);
$uname[1] = $user_name; 
$upass[1] = $pw;
$known_as[1] = $complete_name;
//the login page
$login_page = "login.php";
//where to go after login
$success_page = "samples/permisos.php";
//the path to validate.php
$validate_path = "full path to validate.php";
//login failed error message
$login_err = '<div align="center">Su usuario o contrase�a es INCORRECTA! o su usuario se encuentra desactivado</b></div>';
//no fields filled in
$empty_err = '<div align="center"><b>Usted necesita iniciar sesión con su usuario y contrase�a</b></div>';
//something entered that wasn't a letter or number error message
$chr_err = '<div align="center"><b>Please retry</b></div>';
//if the form is empty and the cookie isn't set
//then display error message the return to login
if($username == "" && $password == ""  && !isset($_SESSION["this_cookie"])){
	print($empty_err);
	include($login_page);
	exit();
}
//if the form is not empty and the cookie isn't set
//then make sure that only letters and numbers are entered
//if there are then display error message the return to login
if($username != "" || $password != ""  && !isset($_SESSION["this_cookie"])){	
	if (preg_match ("/[^a-zA-Z0-9]/", $username.$password)){ 	
		print($chr_err);
		include($login_page);
		exit();
	}
}



//if the cookie isn't set
if (!isset($_SESSION["this_cookie"]) ){
	$user_count = count($uname);
	$user_exists = false;

// check through all the users to see if they exist
	for ($i = 1; $i <= $user_count; $i++) {
		if ($uname[$i] == $username && $upass[$i] == $password){
			$user_id=$i;
	//$welcome_name = $known_as[$i];
			$user_exists = true;
		}
	}

	if(!$user_exists){
		print ($login_err);
		include($login_page);
		exit();
	}

//if the login is correct then set the cookie
	$cookie_val=crypt($uname[$user_id]);
//set the cookie so it dies when the browser is closed 
/*setcookie("name", $known_as[$user_id], 0);
setcookie("this_cookie", $cookie_val, 0);
setcookie("group_id", $group_id, 0);
setcookie("user_id", $user_cod, 0);*/
// session_register('name');
$_SESSION['name'] = $known_as[$user_id];

// session_register('this_cookie');
$_SESSION['this_cookie'] = $cookie_val;
// session_register('group_id');
$_SESSION['group_id'] = $group_id;
// session_register('user_id');
$_SESSION['user_id'] = $user_cod;
// session_register('departament_id');
$_SESSION['departament_id'] = $dependencia;
// session_register('user_name');
$_SESSION['user_name'] = $user_name;
cambiar_ventana($success_page);
//header("Location: $success_page"); 
exit();
}

//if a user tries to access validate.php directly and they are logged in
if ($_SERVER["PHP_SELF"] == $validate_path){
//if($REQUEST_URI == $validate_path){
	echo "<html>\n<head>\n";
	echo "<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>\n";
	echo "</head>\n";
	echo "<body bgcolor=\"white\">\n";
	echo "Tiene una sesión activa <a href=\"".$success_page."\" target='_self'>Continuar</a>\n";
	echo "</body>\n";
	echo "</html>\n";
}









?>
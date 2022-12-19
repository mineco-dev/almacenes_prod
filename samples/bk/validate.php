<?
include('../includes/conectarse.php'); //unicamente para poder usar cambiar_ventana()
function make_safe($variable) 
{ 
   $variable = addslashes(trim($variable)); 
   return $variable; 
} 
header("Pragma: ");
header("Cache-Control: ");
header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, proxy-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
//set global variables
global $username, $password, $user_id, $complete_name, $user_name, $pw, $group_id;
$username = make_safe(strtoupper($_POST['username'])); 
$password = make_safe(md5($_POST['password'])); 	
require_once('rgm.inc');
$consulta = "Select * from tb_usuario_sistema where (nombre_usuario = '$username' and contrasena = '$password') and activo=1";
$result=$query($consulta);
	while($row=$fetch_array($result))  
	{
		  	$user_cod=$row['codigo_usuario'];
			$complete_name=$row['nombre']." ".$row['apellidos'];
			$usuario=$row['nombre_usuario'];
			$pw=$row['contrasena'];				
	}				
$close($server);
$user_name=$usuario;
$uname[1] = $user_name; 
$upass[1] = $pw;
$known_as[1] = $complete_name;
//the login page
$login_page = "login.php";
//where to go after login
$success_page = "../index.php?id=28&ms=2";
//the path to validate.php
$validate_path = "full path to validate.php";
//login failed error message
$login_err = "../index.php?id=28&ms=3";
//no fields filled in
$empty_err = '<div align="center"><b>Usted necesita iniciar sesión con su usuario y contraseña</b></div>';
//something entered that wasn't a letter or number error message
$chr_err = '../index.php?id=28&ms=4';
//if the form is empty and the cookie isn't set
//then display error message the return to login
	if($username == "" && $password == ""  && !isset($_SESSION["conectado"])){
		//print($empty_err);
		include($login_page);
		exit();
	}
//if the form is not empty and the cookie isn't set
//then make sure that only letters and numbers are entered
//if there are then display error message the return to login
	if($username != "" || $password != ""  && !isset($_SESSION["conectado"])){	
		if (preg_match ("/[^a-zA-Z0-9.@]/", $username.$password)){ 	
			cambiar_ventana("$chr_err");
			exit();
		}
	}

//if the cookie isn't set
if (!isset($_SESSION["conectado"]) ){
$user_count = count($uname);
$user_exists = false;

// check through all the users to see if they exist
for ($i = 1; $i <= $user_count; $i++) 
	{
		if ($uname[$i] == $username && $upass[$i] == $password)
		{
			$user_id=$i;
			//$welcome_name = $known_as[$i];
			$user_exists = true;
		}
	}

	if(!$user_exists)
	{
		//print ($login_err);
		cambiar_ventana("$login_err");
		exit();
	}

//if the login is correct then set the cookie
$cookie_val=crypt($uname[$user_id]);
//set the cookie so it dies when the browser is closed 
/*setcookie("name", $known_as[$user_id], 0);
setcookie("this_cookie", $cookie_val, 0);
setcookie("group_id", $group_id, 0);
setcookie("user_id", $user_cod, 0);*/
session_register('name');
$_SESSION['name'] = $complete_name;
session_register('conectado');
$_SESSION['conectado'] = $cookie_val;
session_register('user_id');
$_SESSION['user_id'] = $user_cod;
session_register('user_name');
$_SESSION['user_name'] = $usuario;
session_unregister('param_conexion');
header("Location: $success_page"); 
exit();
}

//if a user tries to access validate.php directly and they are logged in
if ($_SERVER["PHP_SELF"] == $validate_path){
//if($REQUEST_URI == $validate_path){
echo "<html>\n<head>\n";
echo "<title>Ya ha iniciado una sesión</title>\n";
echo "</head>\n";
echo "<body bgcolor=\"white\">\n";
echo "Tiene una sesión activa <a href=\"".$success_page."\" target='_self'>Continuar</a>\n";
echo "</body>\n";
echo "</html>\n";
}
?>
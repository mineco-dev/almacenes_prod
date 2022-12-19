<?
	//clear the cookie and return to login
	$login_page = "index.php";	
	// Inicializa la sesi&oacute;n.
	// Si est&aacute; usando session_name("algo"), &iexcl;no lo olvide ahora!
	session_start();
	// Destruye todas las variables de la sesi&oacute;n
	$_SESSION = array();
	// Finalmente, destruye la sesi&oacute;n
	session_destroy();
	header("Location: $login_page"); 
	exit();
?>
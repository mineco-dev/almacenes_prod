<?
session_start();

	
 include("../conexion.php");

function protecVars($str)
{
  $str =addslashes($str);
  $str= mysql_real_escape_string ($str);
  $str= htmlspecialchars($str);
  return $str;

}

foreach($_POST as $param => $value)
{
  $_POST[$param]= protecVars($value);
}


foreach($_GET as $param => $value)
{
  $_GET[$param]= protecVars($value);
}
if (isset ($_POST['username']) && isset ($_POST['password']))
{
    $u=$_POST['username'];
	$p=$_POST['password'];
	
	$fail=false;
	$sql = "select id_usuario from usuario where usuario='$u' and passwordd='$p'" ;
    $GetUser = sqlsrv_query( $conn, $sql );
	
if( $GetUser === false) { //if de sql
    die( print_r( sqlsrv_errors(), true) );
}// fin if sql
while( $row = sqlsrv_fetch_array( $GetUser, SQLSRV_FETCH_ASSOC) ) {//while 
//print	  "ID  ".$row["id_usuario"]."<br>"; 
   $id=$row["id_usuario"];
}//fin while
	if(empty($u) && empty($p))
	{
	echo "los datos estan vacios";
		
	}
	elseif($id=='')
	{
	echo "El usuario no existe o la contrase�a es incorecta";
	$fail=true;
	}
	
	if($fail==false)
      {	
	  
		if($id>0)
	     {
		// echo	  "ID  ",$id,"<br>"; 
		   $_SESSION['username']=$u;
	       $_SESSION['password']=$p;
		  // echo "id2 ", $_SESSION['username'];
		  // echo "pas: ",$_SESSION['Password'];
	      }
	 }
	 
	 
}
if(isset($_SESSION['username']) && isset($_SESSION['password']) )
{
 $su=$_SESSION['username'];
 $sp=$_SESSION['password'];
 $sql = "select id_usuario, usuario from usuario where usuario='$su' and passwordd='$sp'" ;
   $GetUser = sqlsrv_query( $conn, $sql );
	
if( $GetUser === false) {//if get
    die( print_r( sqlsrv_errors(), true) );
} //if get
while( $row = sqlsrv_fetch_array( $GetUser, SQLSRV_FETCH_ASSOC) ) {//while
//echo  "ID  ".$row["usuario"]."<br>"; 
   $dd=$row["id_usuario"];
   $jd=$row["usuario"];
 
} //while
 if($dd>0)
 
		 {
  		 $lml=$jd;
  		 define('user',true); 
		 
    	}
	}
	
	else {
			define ('user',false);
			}

//	$lml= mysql_fetch_assoc($GetUser);
  //		 define('user',true) ;

if ($_GET['action']=='exit')
{
  session_destroy();
}
?>



<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

  <body bgcolor="#0099FF">
  <?  if(user==false) { ?>
     <center><h1> LOGEO DE USUARIOS </h1></center>
  
       
	   <form action="" method="post">	       
	   <table width="200"  align="center">
  <tr>
    <td> Usuario:</td>
    <td><input name="username" type="text"  placeholder="Nombre de usuario"/></td>
  </tr>
  <tr>
    <td>contrase�a:</td>
    <td><input type="password" name="password" placeholder="*******" /></td>
  </tr>
</table>
<center> <input type="submit"  value="entrar"/></center>

	     </form>
		 
		
	<form action="" method="post">
	 	   <table width="350"  align="center">
  <tr>
    <td > Usuario:</td>
    <td><input name="RUsername" type="text"  placeholder="Nombre de usuario"/></td>
  </tr>
  <tr>
    <td>contrase�a:</td>
    <td><input type="ROpassword" name="password" placeholder="*******" /></td>
  </tr>
   <tr>
    <td >verificar contrase�a:</td>
    <td><input type="RTpassword" name="password" placeholder="*******" /></td>
  </tr>
</table>
<center> <input  type="submit"  value="registrarme"/></center>

	     </form>
		  <? } if(user==true) { ?>
		 <b> <?
		 
		 // echo  "Bienvenido a expedientes ",$lml;
		  

		  
		   ?></b>
		 

 <meta http-equiv="Refresh" content="0;url=http://localhost:8080/phpformulario/index.php">


		<!-- <a href="?action=exit"> salir></a> -->
		 <? } ?>
  </body>
</html>

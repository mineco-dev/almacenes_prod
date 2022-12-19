<?php  
	session_start(); 
	$mtusuario = "aparedes";
	$mtpassword = "422411";
	print "hola";			
	require_once('Connections/redes.php');
	mysql_select_db($database_redes);
	$qtv = "SELECT * from empleados where user = '$mtusuario' and password = '$mtpassword'";
	$rtv = mysql_query($qtv);
	if ($rowa=mysql_fetch_array($rtv))
	{
		$mtval= $rowa[0];
		if (strlen(trim($mtval)) >0)
		{
			  $validado=true;
  			  session_register('sdireccion');
			  $_SESSION['siddireccion'] = $rowa[iddireccion];
			  session_register('user');
			  session_register('psswd');
			  session_register('stratado');
			  session_register('sidtratado');
			  session_register('sdireccio');
			  session_register('sotros');
  			  session_register('sstipo');
			  /****************************modificado por DataTech**************/
  			  session_register('idempleado');
			  $_SESSION['idempleado'] = $rowa[0];
			  session_register('empleado');
			  $_SESSION['empleado'] = $rowa[0];
			  $_SESSION['codigoUsuario'] =  $rowa[0];
			  $_SESSION['sstipo'] = $rowa[tipo];
			  /********************************************************************************/
			  $_SESSION['user'] =$mtusuario;
			  $_SESSION['psswd'] = $mtpassword;
			  $_SESSION['stratado'] = "OMC";
			  $_SESSION['sidtratado'] = "1";
			  /**************************PARA LAS ACTIVIDADES ******************************/
			  session_register('ssalon');
			  session_register('slugar');
			  session_register('shora');
  			  session_register('sdescripcion');
			  session_register('sreunion');
				$_SESSION['sotros'] = "0";
			/***************************************************************************/
				
			}
		}
	require ('conexion.inc');
	mysql_select_db($database_redes);
	$usuarioid = $_SESSION['idempleado'];	
	$query8 = "delete from diaasigna where idempleado=$usuarioid";
	mysql_query($query8);
	$query8 = "delete from empleadoasigna where idempleado=$usuarioid";
	mysql_query($query8);
	Header("Location:/CorreBeta1V2/center.php"); 
?>
<?php
			session_register('sdireccion');

			  session_register('user');
			  session_register('usr_val');
			  session_register('psswd');
			  session_register('stratado');
			  session_register('sidtratado');
			  session_register('sdireccio');
			  session_register('sotros');
  			  session_register('sstipo');
			  session_register('empleado');

			  session_register('ssalon');
			  session_register('slugar');
			  session_register('shora');
  			  session_register('sdescripcion');
			  session_register('sreunion');
 session_register('idempleado');
 session_register('sstipo');
 /*********** lo agregue para la correspondencia ************/
 session_register('codigoUsuario');
 session_register('pagina'); // esta variable indica que pagina tiene el usuario
 session_register('usuario');
 session_register('rolUsuario');
 session_register('deptoUsuario');


$mtval="";
	include('INCLUDES/inc_header.inc');
	$dbms=new DBMS(Conectarse("rrhh"));
	include('conectarse.php');
	$usrcor_ = $_SESSION['usrcor'];
	$passcor_ =  $_SESSION['passcor'];
	$codigo_usuario =  $_SESSION['user_id'];
/*envia_msg('usuario '.$_SESSION['usrcor']);	
envia_msg('password '.$_SESSION['passcor']);	
envia_msg('password '.$usrcor_);	
envia_msg('password '.$passcor_);	*/
/*			envia_msg($_POST['mtusuario']);
			envia_msg($_POST['mtpassword']);*/
	//envia_msg(md5($_POST['mtpassword']));
	$mtpassword = md5($mtpassword);
//	$qtv = "SELECT * from asesor where usuario = '$mtusuario' and password = '$mtpassword' and habilitado = 'Y'";
	$qtv = "SELECT * from asesor where codigo_usuario ='$codigo_usuario'";
	//print $qtv;
	$rtv = mssql_query($qtv);
	if ($rowa=mssql_fetch_array($rtv))
	{
		$mtval= $rowa[0];
		if (strlen(trim($mtval)) >0)
		{
			  $validado=true;


			  $_SESSION['siddireccion'] = $rowa['iddireccion'];
  			  
			


			
  /****************************modificado por DataTech**************/
			  $_SESSION['empleado'] = $rowa[0];
			  $_SESSION['codigoUsuario'] =  $rowa[0];

			  $_SESSION['sstipo'] = $rowa['idtipousuario'];

			  /********************************************************************************/
			  $_SESSION['user'] =$_POST['mtusuario'];
			  $_SESSION['psswd'] = md5($_POST['mtpassword']);
			  $_SESSION['stratado'] = "OMC";
			  $_SESSION['sidtratado'] = "1";

			  /**************************PARA LAS ACTIVIDADES ******************************/
				$_SESSION['sotros'] = "0";
				$mtdd = $rowa['iddireccion'];
			 /* if ( $rowa['iddireccion']==1)
			  {
//			 		header("location: user.php?mtusuario=$usuario&mtpsw=$password");
/*			envia_msg($_SESSION['user']);
			envia_msg($_SESSION['psswd']);*/
			$_SESSION['usr_val']='S';
//			cambiar_ventana("user.php?mtusuario=".$_POST['mtusuario']."&mtpsw=".md5($_POST['mtpassword']));
			cambiar_ventana("user.php?mtusuario=".$usrcor_."&mtpsw=".$passcor_);

			/*  }
			  else
			  {
				  session_register('idempleado');
				  session_register('tipo');*/

	  		 /*********** lo agregue para la correspondencia ************/
		              /*session_register('codigoUsuario');
					  session_register('pagina'); // esta variable indica que pagina tiene el usuario
					  session_register('usuario');
					  session_register('rolUsuario');
					  session_register('deptoUsuario');
					  session_register('sotros');
					  session_register('folder');
					  session_register('iso_registro');

		 			$_SESSION['codigoUsuario'] = $rowa[idempleado];
					$_SESSION['usuario'] = $rowa[nombres];
					$_SESSION['rolUsuario'] = "1";
					$_SESSION['deptoUsuario'] = $rowa[idempleado];
					$_SESSION['sotros'] = "1";
					$_SESSION['folder'] = "";
					$_SESSION['iso_registro'] = "";
					$_SESSION['idempleado'] = $rowa[idempleado];
				    $_SESSION['tipo'] = $rowa[tipo];
		 /*************************************************************/

			/*		if ($rowa['iddireccion']==9)
	  			    {
//						header("location: sinfonegocios.php?mtdireccion=$mtdd&prot=$rowa[protempore]");
						cambiar_ventana("sinfonegocios.php?mtdireccion=$mtdd&prot=$rowa[protempore]");
			  		}
			  		else
			  		{
//						header("location: sinfocomex.php?mtdireccion=$mtdd");			  		
						cambiar_ventana("sinfocomex.php?mtdireccion=$mtdd");			  		
					}
						
			}*/
		}
		else
		{
			$mtmsg = "Usuario no valido";
			$_SESSION['usr_val']='N';
//      		header("location:mtlogin.php?mtcadena=$mtmsg");
			cambiar_ventana("mtlogin.php?mtcadena=$mtmsg");
exit;

        }
   	}else
	{
		$mtmsg = "Usuario no valido";
			$_SESSION['usr_val']='N';
//   		header("location:mtlogin.php?mtcadena=$mtmsg");
			cambiar_ventana("mtlogin.php?mtcadena=$mtmsg");
exit;
    }
?>
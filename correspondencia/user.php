<?
 session_register('idempleado');
 session_register('sstipo');
 /*********** lo agregue para la correspondencia ************/
 session_register('codigoUsuario');
 session_register('pagina'); // esta variable indica que pagina tiene el usuario
 session_register('usuario');
 session_register('rolUsuario');
 session_register('deptoUsuario');

/*$usuario23 = $_SESSION['codigoUsuario'];
	if (strlen($usuario23) > 0)
	{
	 header("Location: mtlogin.php");
	}*/


//session_start();
$_SESSION['folder'] = "";


	include('INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
	include('conectarse.php');

//require_once('Connections/redes.php');
//mysql_select_db($database_redes);

		 $T1 = $_GET['mtusuario'];//$_SESSION['user'];
		 $T2 = $_GET['mtpsw'];//$_SESSION['psswd'];
  		 $_SESSION['user'] =  $T1;
		 $_SESSION['psswd'] = $T2;

/*envia_msg("USUARIO DE SESION ".$_SESSION['user']);
			envia_msg("PASSWD DE SESION ".$_SESSION['psswd']);
envia_msg("USUARIO GET ".$_GET['mtusuario']);
			envia_msg("PWD GET ".$_GET['mtpsw']);*/


//		 $T1 = $mtusuario;
		// $T2 = $mtpsw;

	
$sql= "SELECT * from asesor WHERE usuario like '".$T1."' and password like '".$T2."' "; //and tipo = '$tipo'";
//	print $sql;	
//$dbms->Query(); 

	$rtv = mssql_query($sql);
	$cantidad=mssql_num_rows($rtv);
if ($cantidad==0)
{
cambiar_ventana('mtlogin.php');
exit();

}
	while ($registro=mssql_fetch_array($rtv))
	{
//envia_msg($registro[idtipousuario]);
//print $query;

//$resultado = mssql_query($query);
//if ($registro = $dbms->Query())
//{

	  	  		 /*********** lo agregue para la correspondencia ************/
		          
		 			$_SESSION['codigoUsuario'] = $registro['idasesor'];
					$_SESSION['usuario'] = $registro['nombre'].' '.$registro['nombre2'].' '.$registro['nombre3'].' '.$registro['apellido'].' '.$registro['apellido2'].' '.$registro['apellidocasada'];
					$_SESSION['rolUsuario'] = "1";
					$_SESSION['deptoUsuario'] = $registro['idasesor'];
		 /*************************************************************/



	  $_SESSION['idempleado'] = $registro['idasesor'];
	  $_SESSION['sstipo'] = $registro['idtipousuario'];
//	envia_msg($_SESSION['usuario']);
	/*if ($registro[idtipousuario] =="omc")
	{
		header("Location: menuomcjefe.php");
	}

	
	if ($registro[idtipousuario] ==6)
	{
		header("Location: secre1.php");
	}
	if ($registro[idtipousuario] ==3)
	{
		$us=$registro["idempleado"];
		header("Location: menuasesor.php?usuario=$us");
	}
	if ($registro[idtipousuario] ==1)
	{
		header("Location: suboperador.php");
	}
	if ($registro[idtipousuario] ==10)
	{
		header("Location: menudirector.php");
	}
	if ($registro[idtipousuario] ==5)
	{
		header("Location: menujefeasesor.php");
	}
	if ($registro[idtipousuario] ==9)
	{*/
//		header("Location: visita.php");
		cambiar_ventana("visita.php");
/*	}
	if ($registro[idtipousuario] ==2)
	{
		//header("Location: vicedespacho.php");
//		header("Location: vice.htm");
	}

	if ($registro[idtipousuario] ==4)
	{
		header("Location: menucontingentes.php");
	}
//}*/
}

//if (strlen(trim($T1)) ==0)  header("location:mtlogin.php");

// echo $T1;
//echo $T2;

//		echo'<p align="center"><strong><em><font color="#FF3300" size="6" face="Comic Sans MS">Acceso No Valido</font></em></strong></p>';
?>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<p align="left"></p>
<form name="form1" method="post" action="consulta.php">
  <div align="center">
<? /*
    <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="105" height="23">
      <param name="BGCOLOR" value="">
      <param name="movie" value="button2.swf">
      <param name="quality" value="high">
      <embed src="button2.swf" quality="high" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?P1_Prod_Version=ShockwaveFlash" type="application/x-shockwave-flash" width="105" height="23" ></embed>
    </object>
 */
 echo $t1;
echo $t2;

 ?>
  </div>
</form>
<p align="center">&nbsp; </p>

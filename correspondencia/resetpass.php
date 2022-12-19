<?
session_start();
	include('INCLUDES/inc_header.inc');

	$dbms=new DBMS($conexion); 
	$_SESSION['nivel']=1;
	include('valida.php');

	if ( $sstipo != 1)
	{
	 cambiar_ventana('mtlogin.php');
	}

if (isset($_POST['ins'])) { $ins = $_POST['ins']; } else {$ins=0;}
 if ($ins == 1)
	{
	   $nip=$_POST['nip'];
//	   $pass_a=md5($_POST['clave_anterior']);
   	   $pass_n=md5($_POST['clave_nueva']);
   	   $conf_pass_n=md5($_POST['conf_clave_nueva']);
  /*     $querysel = "select password from empleado where password='$pass_a' and nip = '$nip'";
 	   $resultsel = @mysql_query($querysel,$link);
   	   if (@mysql_affected_rows() == 1) // verifica si el password anterior es correcto
	    {*/
		 if ($pass_n == $conf_pass_n) //verifica que el password nuevo se reconfirmo correctamente.
		  {
/*	       if ($pass_a != $pass_n) //verifica que el password nuevo sea diferente del anterior
	        {*/
 		     $query = "update asesor set password='$pass_n' where gafete = '$nip'";
//		     echo $query;
		     $result = mssql_query($query);
			 $rsRows = mssql_query("select @@rowcount as rows");
		     $rows = mssql_fetch_assoc($rsRows); 
			 //  envia_msg( $rows['rows']);
			 //envia_msg(mssql_rows_affected($result) );
			 if ( $rows['rows'] == 1 )
		//if (mssql_affected_rows() > 0)
	          {
		       envia_msg("Su clave ha sido actualizada");
		      } 
	         else
	          {   
		       envia_msg("Su clave no se pudo actualizar");
   		      }  
/*		    }
	      else // el password nuevo es igual al anterior
	       {
	        envia_msg("No es valido el cambio de contrase�a... Debe ser diferente a la anterior... No se actualizo!");
	       }*/
		 }
		else //el password confirmado no es igual al password nuevo
		 {
  	      envia_msg("La confirmacion del password no es correcta... No se pudo actualizar!");
		 }
/*		}
	   else // no es correcto el password anterior
	    {
		 envia_msg("Los datos no son correctos. No se pudo actualizar");
		}*/
//	   }
	   cambiar_ventana("visita.php");
   exit;
	}

?><!-- InstanceBegin template="/Templates/layout.dwt" codeOutsideHTMLIsLocked="false" -->
<style type="text/css">
<!--
.Estilo4 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo2 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 16px;
}
.Estilo6 {color: #FF0000}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {font-size: larger}
.Estilo22 {font-size: 11px}
.Estilo31 {font-size: 12px; font-weight: bold; }
.Estilo3 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #666666;
}
.Estilo13 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo46 {color: #666666; font-weight: bold;}
.Estilo47 {color: #000000}
.Estilo61 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;
}
.Estilo64 {
	color: #000000;
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
}
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
.Estilo28 {font-size: 12px}
.Estilo67 {font-size: 9px}
.Estilo69 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>
<style type="text/css">
<!--
.Estilo1 {
	color: #FFFF00;
	font-weight: bold;
}
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
.Estilo3 {color: #FFFFFF; font-weight: bold; }
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<script language="JavaScript"><!--

// Esta funcion verifica que se hayan ingresado todos los datos obligatorios

	function Verifica()
	{
	    if(form1.nip.value == "" || form1.clave_nueva.value == "" || form1.conf_clave_nueva.value == "")
		{alert('Todos los campos son requeridos');
		return false}
	}

//--></script>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<!-- InstanceBeginEditable name="doctitle" -->
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<!-- InstanceEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!-- InstanceBeginEditable name="head" -->
<link href="Templates/tablas-eec.css" rel="stylesheet" type="text/css">
<!-- InstanceEndEditable -->
<link href="tablas-eec.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	margin-left: 10px;
	margin-top: 10px;
	margin-right: 0px;
	margin-bottom: 0px;
}
-->
</style></HEAD>

<BODY>
<div align="center" class="tablas" id="1"><!-- InstanceBeginEditable name="contenido" -->
<table border="0" width="100%" class="Estilo4 Estilo18">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right"  width="70%">
		<a href="visita.php">[ <-- Regresar al Menu ]</a>
		</td>
		<!--td align="right" >
		<a href="mtlogin.php">[ Cerrar Sesión ]</a>
		</td-->

	</tr>
</table>

<form name="form1" action="resetpass.php" method="post" onSubmit="return Verifica()">
<p>&nbsp;</p>
<table width="400"  border="0" align="center" cellpadding="1" cellspacing="1" class="Estilo4 Estilo13">
  <tr>
    <td colspan="3" align="center"><p><strong>RESTAURAR CONTRASE&Ntilde;A DE USUARIOS</strong></p>
      <p>&nbsp;</p></td>
  </tr>
  <td width="288"><br></td>
  <tr>
    <td><strong>Gafete:</strong></td>
    <td width="105" align="left"><input type="text" name="nip" maxlength="8" size="8" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
  </tr>
  <!--tr>
    <td><strong>Contrase�a Actual:</strong></td>
    <td align="center"><input type="password"  name="clave_anterior" maxlength="32" size="32"></td>
  </tr-->
  <tr>
    <td><strong>Contrase�a Nueva:</strong></td>
    <td align="center"><input type="password"  name="clave_nueva" maxlength="32" size="32"></td>
  </tr>
  <tr>
    <td><strong>Confirmar Contrase�a Nueva:</strong></td>
    <td align="center"><input type="password"  name="conf_clave_nueva" maxlength="32" size="32"></td>
  </tr>
  
    <td><br></td>
  <tr bgcolor="#6699FF">
    <input type="hidden" name="ins" value="1">
    <td colspan="2" align="center"><input type="submit" name="agregar" value="Agregar"></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</form>
<!-- InstanceEndEditable --></div>
<p align="center">&nbsp;</p>
</BODY>
<!-- InstanceEnd --></HTML>

<?
session_start();
include('../../conectarse.php');

$_SESSION['nivel']=2;

if  (( !$_SESSION['usr_val']) || ($_SESSION['usr_val'] == 'N') || ($_SESSION['usr_val'] == '') )
		{
		//envia_msg('2-'.$_SESSION['nivel']);
		 if ($_SESSION['nivel'] == 1)
			{
			 cambiar_ventana('mtlogin.php');
			}
		if ($_SESSION['nivel'] == 4)
			{
			 cambiar_ventana('../mtlogin.php');
			}

		  if ($_SESSION['nivel'] == 2)
			{
			 cambiar_ventana('../../mtlogin.php');
			}
		 if ($_SESSION['nivel'] == 3)
			{
			 cambiar_ventana('../../../mtlogin.php');
			}
		}


	include('../../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 

?>
<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<table border="0" width="100%" class="Estilo1 Estilo18">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right"  width="70%">
		<a href="../../visita.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Regresar al Menu ]</a>
		</td>
		<td align="right" >
		<a href="../../mtlogin.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ Cerrar Sesión ]</a>
		</td>

	</tr>
</table>


<form name="form1" action="busqueda_asesor.php" method="post">

INGRES LOS PARAMETROS DE BUSQUEDA SEPARADOS POR EL SIMBOLO  %
<br>
<input type="text" name="busqueda" width="50">
<input type="hidden" name="parametro" value="1">

<input name="submit" type="submit"  value="buscar">

</form>


<?
if (!isset($buscar)){ 

echo "Debe especificar una cadena a buscar"; 

}

if ( $_POST['parametro'] == 1 )
{
	sql="select nombre+' '+nombre2+' '+nombre3, apellido+' '+apellido2+' '+apellidocasada, cedula from asesor where nombre LIKE '%$buscar%' ORDER BY nombre";

print $sql;
}

?>



</body>
</html>

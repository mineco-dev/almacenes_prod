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

<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo13 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }

-->
</style>




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
		<!--td align="right" >
		<a href="../../mtlogin.php"><!--img src="tareas.gif" width="16" height="16" border="0">[ Cerrar Sesión ]</a>
		</td-->

	</tr>
</table>
<form name="form1" action="busqueda_asesor1.php" method="post">
<table align="center" border="0" class="Estilo4 Estilo13">
<tr><td align="center"><strong>
INGRESE LOS PARAMETROS DE BUSQUEDA SEPARADOS POR EL SIMBOLO  %
</strong></td>
</tr><Tr>
<td align="center">
<input type="text" name="busqueda" size="80" onKeyUp="javascript:this.value=this.value.toUpperCase();">
<input type="hidden" name="parametro" value="1">
<input name="submit" type="submit"  value="buscar">
</Td>
</Tr>
</table>
</form>


<table border="0" width="70%" align="center" cellspacing="1" class="Estilo4 Estilo13">
<tr><td bgcolor="#D7F1FF" align="center"><strong>Nombre</strong></td><td bgcolor="#C5E1FE" align="center"><strong>Cedula</strong></td><TD bgcolor="#D7F1FF">&nbsp;</TD></tr>
<tr>
<?
if ( $_POST['parametro'] == 1 )
{
	$sql = "select idasesor, nombre+' '+nombre2+' '+nombre3+' '+apellido+' '+apellido2+' '+apellidocasada, cedula from asesor 
	where nombre like '%$busqueda%' or nombre2 like '%$busqueda%' or nombre3 like '%$busqueda%' or apellido like '%$busqueda%'
	or apellido2 like '%$busqueda%' or apellidocasada like '%$busqueda%' order by 2";
	$result = mssql_query($sql); 
	while ( $row = mssql_fetch_array ($result))
	{
		if ( $row['2'] != 11111111 )
		{
	?>

	<td width="75%" bgcolor="#D7F1FF">
		<?
		print $row[1];
		?>
	</td>
	<td width="25%" bgcolor="#C5E1FE">
		<?
		print $row[2];
		?>
	</td>
	<td width="25%" bgcolor="#D7F1FF">
		<?
		print "<a href=datos_personales_act.php?paramas=".$row[0].">Editar</a>";
		?>
	</td>
</tr>	
	<?
	 }
	}
//print $sql;
}

?>


</table>



</body>
</html>

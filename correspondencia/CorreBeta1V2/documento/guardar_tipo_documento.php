<?
session_start();

	session_register('PagNow');
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

	if ( $sstipo != 1) // valida que sea un usuario administrador
	{
	 cambiar_ventana('../../mtlogin.php');
	}

	include('../../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 

$codi1 = $_GET['codigo'];
	
?>

<!DOCTYPE html>
<html>
<head>
<met a http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>

<?
// este formato guarda el archivo en el inbox del usuario no lo envia al destinatario
$p = $_GET['paramas'];
//envia_msg($p);

 $usuario = $_SESSION['codigoUsuario'];
 $fecha = date("Y-m-d");

			$SQL= "UPDATE tipo_documento set  documento = '$_POST[documento]'
				 
				 WHERE id_tipo_doc = ".$_POST['codigo'];
//print $SQL;

			$result = mssql_query($SQL);

//		print $SQL;


cambiar_ventana("actualiza_documento.php?paramas=$p");
			//cambiar_ventana("actualiza_documento.php?paramas=$m");
?>


</body>
</html>

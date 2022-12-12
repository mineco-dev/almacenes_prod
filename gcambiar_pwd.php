<?PHP
 session_start();
$tecnico_id=($_SESSION["user_id"]);   //codigo del usuario
require_once('../connection/helpdesk.php');
$pass=md5($_REQUEST[txt_contrasena]);
$consulta = "UPDATE usuario SET contrasena='$pass' WHERE codigo_usuario='$tecnico_id'";
$result=mssql_query($consulta);
//print $consulta;

// AGREGADO EL 190208 PARA ACTUALIZAR CONTRASEÑA DE CORRESPONDENCIA
//include('../correspondencia/INCLUDES/inc_header.inc');
//$dbms=new DBMS($conexion); 
//include('../correspondencia/conectarse.php');
//$consultax = "UPDATE asesor SET password='$pass' WHERE usuario='".$_SESSION['usrcor']."'";
//print $consultax;
//envia_msg($consultax);
//$result1=mssql_query($consultax);

mssql_close($s);	
include('transaccion_operada.php');

?>
<?
// esto es lo que se pone al inicio de cada pagina

	include('../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
?>


<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>
<?
$dbms->sql="insert into asesor(nombre, nombre2, nombre3, apellido, apellido2, apellidocasada, estadocivil, edad, sexo, nit, igss, empadronamiento, gruposanguineo, idregistro, cedula, userfile, idmunicipio, iddepartamento, licencia, tipolicencia, idgrupoetnico, calle, numero, zona, colonia, nacionalidad, telefono, celular, correo, direccion_para_notificaciones, puesto, userfile2, reglon, partida, iddireccion, nacimiento) 
		values ('$nombre', '$nombre2', '$nombre3', '$apellido', '$apellido2', '$apellidocasada', '$estadocivil', '$edad', '$sexo', '$nit', '$igss', '$empadronamiento', '$gruposanguineo', $idregistro, '$cedula', '$userfile', $idmunicipio, $iddepartamento, '$licencia', '$tipolicencia', $idgrupoetnico, '$calle', '$numero', '$zona', '$colonia', '$nacionalidad', '$telefono', '$celular', '$correo', '$direccion_para_notificaciones', '$puesto', '$userfile2', '$reglon', '$partida', $iddireccion, '$dia3/$mes3/$ano3') ";
$dbms->Query(); 



?>


<?
//$dbms->sql="insert into asesor_departamento(nombre_departamento ) values('ESCUINTLA')"; 
	//$dbms->Query(); 




//'$nombre', '$nombre2', '$nombre3', '$apellido', '$apellido2', '$apellido3', '$sexo', '$nit', '$igss', '$empadronamiento', '$gruposanguineo', $idregistro, '$cedula', '$licencia', '$tipolicencia', $idgrupoetnico
?>




</body>
</html>

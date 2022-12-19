<?php

session_start(); 
include('../INCLUDES/inc_header.inc');
$dbms=new DBMS($conexion); 
include('conectarse.php');

/*require_once('../Connections/redes.php'); 
mysql_select_db($database_redes);*/
	$nombre=strtoupper($nombres);
	$apellido=strtoupper($apellidos);
    envia_msg($_POST['deptomineco']);
    envia_msg('$deptomineco');
    envia_msg($id_puesto);
	$deptomineco=$_POST['deptomineco'];
	$query="SELECT * FROM asesor ";	
	$result=mssql_query($query);
	$t=0;
	while ($row=mssql_fetch_array($result))
	{
		if((strtoupper($row["nombre"]) == $nombre) && (strtoupper($row["apellido"]) == $apellido))
		{			
			$t=1;
		}
	}
	if ($t == 1)
	{
		echo'<p align="center"><strong><em><font color="#FF3300" size="6" face="Comic Sans MS">Empleado no Valido, este nombre ya esta ingresado</font></em></strong></p>';		
	}
	if ($t == 0)
	{
		$len = strlen($nombres);
		$len1 = strlen($apellidos);		
		$p=0;
		if(($len != 0) && ($len1 != 0))
		{
//			phpinfo();
			$query5 = "INSERT INTO asesor 
					  (nombre, apellido, id_puesto, iddepartamento, extension, /*iddireccion,*/ telefonocasa, telefonocelular, correo, fecha_nacimiento, 
						usuario, password, habilitado, /*tipo, protempore, */ iddireccion) 
						values 
					  ('$nombres','$apellidos','$rol_emp','$deptomineco','$extension',/*'$direccion',*/'$telefonocasa','$telefonocelular',
						'$email','$fechacumple','$usermt','$passwordmt','$habilitado',/*'$tipo','$protempore',*/ $DireccionO)";
			print $query5;

			mssql_query($query5);
			
			$query5 = "update asesor set iniciales = substring(usuario,1,4)";
			mssql_query($query5);
			
			echo'<p align="center"><strong><em><font color="#0033CC" size="6" face="Comic Sans MS">La Informacion Ha Sido Guardada</font></em></strong></p>';		
			$p=1;			
		}
		if ($p == 0)
		{
			echo'<p align="center"><strong><em><font color="#FF3300" size="6" face="Comic Sans MS">Nombre de Empleado No Valido</font></em></strong></p>';					
		}
		print "<a href='empleados.php'>Regresar</a>";
	}
?>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<p align="left"></p>
<form name="form1" method="post" action="consulta.php">
  <div align="center">
    <p>
	<? $vs = $_SESSION[sotros];
    ?>
   </p>
  </div>
</form>
<p align="center">&nbsp; </p>
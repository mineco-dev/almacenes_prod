<?
// esto es lo que se pone al inicio de cada pagina
session_start();
include('../../conectarse.php');
$_SESSION['nivel']=2;
//include('../../valida.php');
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


 function sube_datos($idas,$tipo_file) // 1 foto, 2 copia cedula
  {
 
	 // validmos tipo de archivo para cambiar el nombre en el la funcion upload
		   if ($tipo_file == 1)
			{
			 $archivo = 'userfilefoto'; //foto
			}
			elseif ($tipo_file == 2)
			{
			 $archivo = 'userfilecurriculum'; //curriculum
			}

			else
			{
			 $archivo = 'userfile'; //cedula
			}
			
  			 /* sube la foto y archivo de copia de cedula*/
			 
			$nombre_archivo = $_FILES[$archivo]['name']; 
			$tipo_archivo = $_FILES[$archivo]['type']; 
			$tamano_archivo = $_FILES[$archivo]['size'];
			$archivo23 = split('[.]',$nombre_archivo);
			$tipo_archivo = $archivo23[sizeof($archivo23)-1];
			$fecha = date("dmYHis");
			$path23 = $usuario.$fecha.".".$tipo_archivo;
			
			//		$dU=$_SESSION['ID']; //codigo del usuario
					$dU=$_SESSION['codigoUsuario']; //codigo del usuario
					$corre = $_SESSION['correlativo'];
			//		envia_msg($_SESSION['correlativo']);
			
			
			
			$sql_="insert into doc_adj_rrhh(descripcion,extension,nombre,path,idasesor, id_tipo_doc, fecha) 
					values ('$txtDescripcion','$tipo_archivo','$nombre_archivo','$path23',$idas, $tipo_file, getdate())";
			//envia_msg($sql);					
					$result = mssql_query($sql_);
			//print $sql_;
				
					//$dbms->Query(); 
					//mssql_close($db);
					$q1=$insti;
					if ( $tipo_file == 1 ) // para subir fotos
					 {
					  $info23 = move_uploaded_file($_FILES[$archivo]['tmp_name'], "../../upload_rrhh/fotos/".$path23);
					 }
					elseif ( $tipo_file == 2 ) //		if ( $tipo_file == 2 ) // para subir copia cedula
					 {
					  $info23 = move_uploaded_file($_FILES[$archivo]['tmp_name'], "../../upload_rrhh/curriculum/".$path23);
					 }
			 
			   		else //		if ( $tipo_file == 2 ) // para subir copia cedula
					 {
					  $info23 = move_uploaded_file($_FILES[$archivo]['tmp_name'], "../../upload_rrhh/cedulas/".$path23);
					 }
			 
			 
			 /* sube la foto y archivo de copia de cedula*/

  }


?>
<?

$sql3 = "select nombre, direccion, nivel from direccion 
where iddireccion = $_POST[iddireccion]";
$result = mssql_query($sql3); 
				while ($row = mssql_fetch_array ($result)) 
			{		

$nivell	= $row[2];	

}


?>

<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<body>


	      <?
$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
//$conection = mssql_connect("ecortes","","") or die("no se puede conectar a SQL Server");
mssql_select_db("helpdesk",$conection);
   ?>

<? 


$usuario_mayus=strtoupper($usuario_s);
$consulta = "SELECT * FROM usuario";
$result=mssql_query($consulta);
$entro=1;
while($row=mssql_fetch_array($result))
{
	if(strtoupper($row["nombre_usuario"]) == $usuario_mayus)
	{
		$entro=0;
	}
}
if($entro == 1)
{


//print $_POST['iddireccion'];		
$sqlcon = "select codigo_dependencia, nombre_dependencia, activo, id_relac_finan_actividades, rrhh_direccion
from dependencia where rrhh_direccion = $_POST[iddireccion] ";
//print $sqlcon;

//print $result;
$result = mssql_query($sqlcon); 
				while ($row = mssql_fetch_array ($result)) 
				{
				
//print  $row[0];	
$direc	= $row[0];	
//print $direc;	
//envia_msg($direc);		
		
	$nombres = $nombre.' '.$nombre2.' '.$nombre3;
	//print $nombres;
	//envia_msg($nombres);
	$apellidos = $apellido.' '.$apellido2.' '.$apellidocasada;
	//print $apellidos;
	//envia_msg($apellidos);
	
//envia_msg($direc);


//print	$_POST['usuario_s'];
$password = $_POST['usuario_s'];

//envia_msg('aqui va el password');
//envia_msg($password);
//envia_msg('aqui va el usuario');
//envia_msg($usuario_s);

	
	$password=md5($password);
	$query = "EXEC proc_usuario_add @vapellidos='$apellidos', @vnombres='$nombres', @vnombre_usuario='$usuario_s', @vcodigo_grupo_enc=1, @vcodigo_dependencia=$direc, @vcontrasena='$password', @vnivel='$nivell', @vextension='$extension'";
		$result2 = mssql_query($query);
//print $query;
//print $result2;

}
}	
else
{
envia_msg("EL NOMBRE DE USUARIO YA EXISTE");
envia_msg("FAVOR HABLAR CON EL ADMINISTRADOR DEL SISTEMA");
cambiar_ventana('datos_personales.php');
}

?>








	      <?
		  


$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
//$conection = mssql_connect("ecortes","","") or die("no se puede conectar a SQL Server");

 mssql_select_db("RRHH",$conection);
   ?>

<?
//AQUI HAVIA PUESTO EL QUERY DEL NIVEL Y SI HAVIA FUNCIONADO, AHORA ESTA COLOCADO ARRIBA
//aqui empieza la comparacion con el usuario
/*$sql3 = "select usuario from asesor";
$result4 = mssql_query($sql3); 
while ($row = mssql_fetch_array ($result4)) 
{
if (trim($usuario_s)== trim($row[0]))
{
$xm=1;
}
else
{
$xm=2;
}
}

if ($xm==1)
{
envia_msg("USUARIO YA EXISTENTE EN RECURSOS HUMANOS");
envia_msg("FAVOR HABLAR CON EL ADMINISTRADOR DEL SISTEMA");
cambiar_ventana('datos_personales.php');
}
else
{
*/



//AQUI EMPIEZA LA NUEVA PRUEBA PARA VERIFICAR QUE NO EXISTA EL USUARIO ANTERIORMENTE
//envia_msg('si entro o no ');

/*$usuario_mayus2=strtoupper($usuario_S);
$consulta2 = "SELECT * FROM asesor";
$result2=mssql_query($consulta2);
$entro2=2;
while($row2=mssql_fetch_array($result2))
{
	if(strtoupper($row2["nombre_usuario"]) == $usuario_mayus2)
	{
		$entro2=1;
	}
}
if($entro2 == 2)
{
*/

?>


<?
if($entro == 1)
{


//envia_msg('si entro o no  dos');
//envia_msg('aqui va la fecha en que ingreso');
//envia_msg($date9);

$fecha_nac = $dia3.'/'.$mes3.'/'.$ano3;
$fechaingreso=substr($date9,3,2)."/".substr($date9,0,2)."/".substr($date9,6,4);
//$fechaingreso=substr($date9,0,2)."/".substr($date9,3,2)."/".substr($date9,6,4);
//envia_msg('aqui va la fecha en que ingreso ya concatenada');
//envia_msg($fechaingreso);

$id_tipo_usuario = $tipo_usuario;
$sql = "select nombre, nombre2, nombre3, apellido, apellido2, apellidocasada, idregistro, cedula, gafete 
		from asesor 
		where nombre = '$nombre' and nombre2='$nombre2' and nombre3='$nombre3' and  apellido = '$apellido' and apellido2 = '$apellido2'
			and apellidocasada='$apellidocasada' and idregistro='$idregistro' and cedula='$cedula' and usuario = '$usuario'"; //and gafete= '$gafete'";
//print $sql;
$resel = mssql_query($sql);
$canti = mssql_num_rows($resel);

//envia_msg('TOTAL '.$canti);
// si no existe entonces ingresa
if ($canti == 0) 
	{
		//$password=md5($password);
		$sql = "insert into asesor
					(nombre, nombre2, nombre3, apellido, apellido2, apellidocasada, estadocivil, edad, sexo, nit, igss, empadronamiento, 
					gruposanguineo, idregistro, cedula, userfile, idmunicipio_nac, iddepartamento_nac, licencia, tipolicencia, idgrupoetnico, 
					calle, numero, zona, colonia, nacionalidad, telefonocasa, telefonocelular, correo, direccion_para_notificaciones, id_puesto, userfile2, 
					reglon, partida, iddireccion, fecha_nacimiento, idmunicipio_reside, iddepartamento_reside,usuario,password,extension,habilitado,fecha_creacion,
					usuario_creacion,idtipousuario,gafete,hijos,userfilefoto,id_puesto1,fecha_ingreso,nivel,sueldo) 
				values 
					('$nombre', '$nombre2', '$nombre3', '$apellido', '$apellido2', '$apellidocasada', '$estadocivil', '$edad', '$sexo', '$nit', 
					'$igss', '$empadronamiento', '$gruposanguineo', $idregistro, '$cedula', '$userfile', $idmunicipio, $iddepartamento, 
					'$licencia', '$tipolicencia', $idgrupoetnico, '$calle', '$numero', '$zona', '$colonia', '$nacionalidad', '$telefono', 
					'$celular', '$correo', '$direccion_para_notificaciones', '$id_puesto', '$userfile2', '$reglon', '$partida',$_POST[iddireccion], 
					'$fecha_nac','$idgrupo2','$tema2','$usuario_s','$password','$extension','Y',getdate(),'$usuario','$id_tipo_usuario','$gafete',$hijos,
					'$userfilefoto', '$id_puesto1','$fechaingreso','$nivell','$sueldo')";
		$result = mssql_query($sql);
		//print $sql;
		//envia_msg('Total de Resultado'.mssql_num_rows($result));
$rsRows = mssql_query("select @@rowcount as rows");
    $rows = mssql_fetch_assoc($rsRows); 

//envia_msg("antes del  if");
//envia_msg(mssql_rows_affected($result) );
if ( $rows['rows'] == 1 )

//x|envia_msg("entro al if");
//		if ( mssql_num_rows($result) == 1 )
		 {
		  envia_msg('EMPLEADO INGRESADO EXITOSAMENTE');
		 
		   	$query_ase = 'select idasesor from asesor where usuario="'.$usuario_s.'"';
		//envia_msg($query_ase);
			$res_ase = mssql_query($query_ase);
			while ($rowas = mssql_fetch_array($res_ase))
			 {
				$idas = $rowas['idasesor'];
			 }
		 if ($hijos > 0)
		   { 
			
//			if (isset($_POST[$archivo]) && ($_POST[$archivo] != ''))
			if (isset($_FILES['userfilefoto']) && ( $_FILES['userfilefoto'] != '')) // insercion de fotos
			 {
			  sube_datos($idas,1); // archivo de foto
			 }
			 if (isset($_FILES['userfile']) && ( $_FILES['userfile'] != '')) //insercion de cedulas
			 {
			  sube_datos($idas,2); // archivo de foto
			 }
  		  	cambiar_ventana('actualiza_familia.php?numhi='.$hijos.'&paramas='.$idas);
		   }
  		  else
		   {
//			if (isset($_POST[$archivo]) && ($_POST[$archivo] != ''))
			if (isset($_FILES['userfilefoto']) && ($_FILES['userfilefoto'] != '')) // insercin de fotos
			 {
			  sube_datos($idas,1); // archivo de foto
			 }
			if (isset($_FILES['userfile']) && ($_FILES['userfile'] != '')) //insercion de cedulas
			 {
			  sube_datos($idas,2); // archivo de foto
			 }

		    cambiar_ventana('datos_personales.php');
		   }
		 }
		else
		 {
		  error_msg('NO SE PUDO INGRESAR EL EMPLEADO');
		 }
	}// si no existe entonces ingresa if ($canti == 0) 
	//este lo ingrese ahorita para probar lo de nivel
else
	{
		error_msg('EL EMPLEADO QUE INTENTA INGRESAR YA EXISTE EN EL SISTEMA. VERIFIQUE...');
	}
	
	//envia_msg('si entro o no  tres');
	//}	
//else
//{
//echo('<strong><font size="5"><Center><font color="#FF0000">USUARIO YA EXISTENTE EN RECURSOS HUMANOS</font></Center></font></strong>');
//echo('<strong><font size="5"><Center><font color="#FF0000">FAVOR HABLAR CON EL ADMINISTRADOR DEL SISTEMA</font></Center></font></strong>');
//cambiar_ventana('datos_personales.php');
//}
	}
	//} //AQUI TERMINA LA COMPARACION DEL NOMBRE DE USUARIO DE ASESOR
?>

</body>
</html>

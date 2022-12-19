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
			envia_msg($sql);					
					$result = mssql_query($sql_);
			//print $sql_;
				
					//$dbms->Query(); 
					//mssql_close($db);
					$q1=$insti;
					if ( $tipo_file == 1 ) // para subir fotos
					 {
					  $info23 = move_uploaded_file($_FILES[$archivo]['tmp_name'], "../../upload_rrhh/fotos/".$path23);
					 }
					else //		if ( $tipo_file == 2 ) // para subir copia cedula
					 {
					  $info23 = move_uploaded_file($_FILES[$archivo]['tmp_name'], "../../upload_rrhh/cedulas/".$path23);
					 }
			 
			 /* sube la foto y archivo de copia de cedula*/

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

$fecha_nac = $dia3.'/'.$mes3.'/'.$ano3;
$fechaingreso=substr($date9,3,2)."/".substr($date9,0,2)."/".substr($date9,6,4);
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
		$password=md5($password);
		$sql = "insert into asesor
					(nombre, nombre2, nombre3, apellido, apellido2, apellidocasada, estadocivil, edad, sexo, nit, igss, empadronamiento, 
					gruposanguineo, idregistro, cedula, userfile, idmunicipio_nac, iddepartamento_nac, licencia, tipolicencia, idgrupoetnico, 
					calle, numero, zona, colonia, nacionalidad, telefonocasa, telefonocelular, correo, direccion_para_notificaciones, id_puesto, userfile2, 
					reglon, partida, iddireccion, fecha_nacimiento, idmunicipio_reside, iddepartamento_reside,usuario,password,extension,habilitado,fecha_creacion,
					usuario_creacion,idtipousuario,gafete,hijos,userfilefoto,id_puesto1,fecha_ingreso) 
				values 
					('$nombre', '$nombre2', '$nombre3', '$apellido', '$apellido2', '$apellidocasada', '$estadocivil', '$edad', '$sexo', '$nit', 
					'$igss', '$empadronamiento', '$gruposanguineo', $idregistro, '$cedula', '$userfile', $idmunicipio, $iddepartamento, 
					'$licencia', '$tipolicencia', $idgrupoetnico, '$calle', '$numero', '$zona', '$colonia', '$nacionalidad', '$telefono', 
					'$celular', '$correo', '$direccion_para_notificaciones', '$id_puesto', '$userfile2', '$reglon', '$partida',$_POST[iddireccion], 
					'$fecha_nac','$idgrupo2','$tema2','$usuario_s','$password','$extension','Y',getdate(),'$usuario','$id_tipo_usuario','$gafete',$hijos,
					'$userfilefoto', '$id_puesto1','$fechaingreso')";
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
else
	{
		error_msg('EL EMPLEADO QUE INTENTA INGRESAR YA EXISTE EN EL SISTEMA. VERIFIQUE...');
	}
?>

</body>
</html>

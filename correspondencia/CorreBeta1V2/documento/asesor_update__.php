<?
// esto es lo que se pone al inicio de cada pagina
session_start();


	
	include('../../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
	include('../../conectarse.php');

/*	if ( $sstipo != 1) // valida que sea un usuario administrador
	{
	 cambiar_ventana('../../mtlogin.php');
	}*/
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
/*			envia_msg($idas,','.$tipo_file);
			envia_msg($_FILES[$archivo]['type']);*/
		if (!empty($nombre_archivo))  // si el archivo trae nombre
		 {
			if  (($_FILES[$archivo]['type'] != 'image/pjpeg') and
			     ($_FILES[$archivo]['type'] != 'image/jpeg') and
				 ($_FILES[$archivo]['type'] != 'image/x-png') and
				 ($_FILES[$archivo]['type'] != 'image/png') and
				 ($_FILES[$archivo]['type'] != 'image/gif'))
			  {
			   envia_msg('Esta extension de foto no es valida. Solo .jpg .png y .gif');
			  }
			 else
			  {
			
					$sql_="insert into doc_adj_rrhh(descripcion,extension,nombre,path,idasesor, id_tipo_doc, fecha) 
					values ('$txtDescripcion','$tipo_archivo','$nombre_archivo','$path23',$idas, $tipo_file, getdate())";
//			envia_msg($sql);					
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
			  }
			 /* sube la foto y archivo de copia de cedula*/
    } // fin si el archivo trae nombre
  }
	
	
	
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>

<body>

<?
// este formato guarda el archivo en el inbox del usuario no lo envia al destinatario

 $usuario = $_SESSION['codigoUsuario'];
 $fecha = date("Y-m-d");


		



			{

if ($_POST['paramas'] != null)
 {

	if ( $sueldo > 0 )  
	 { 
		$v_sueldo = $sueldo;
	 } 
	 else 
	 { 
	 	$v_sueldo = '0.00'; 
	} 
			$nombre = strtoupper($nombre);
			$nombre2 = strtoupper($nombre2);
			$nombre3 = strtoupper($nombre3);
			$apellido = strtoupper($apellido);			
			$apellido2 = strtoupper($apellido2);			
			$apellidocasada = strtoupper($apellidocasada);						
			$estadocivil = strtoupper($estadocivil);
			$sexo = strtoupper($sexo);
			$nit = strtoupper($nit);
			$empadronamiento = strtoupper($empadronamiento);
			$calle = strtoupper($calle);
			$numero =strtoupper($numero);
			$colonia = strtoupper($colonia);
			$nacionalidad = strtoupper($nacionalidad);
			$direccion_para_notificaciones = strtoupper($direccion_para_notificaciones);

			$SQL= "UPDATE asesor set nombre = '$nombre', nombre2 = '$nombre2', nombre3 = '$nombre3', apellido = '$apellido', apellido2 = '$apellido2',
				 apellidocasada = '$apellidocasada', estadocivil = '$estadocivil', sexo = '$sexo', nit = '$nit', igss = '$igss', 
				 empadronamiento = '$empadronamiento', gruposanguineo = '$gruposanguineo',idregistro = '$idregistro', cedula = '$cedula', 
				 idmunicipio_nac='$idmunicipio',iddepartamento_nac = '$iddepartamento', iddepartamento_reside = '$tema2', idmunicipio_reside = '$idgrupo2',licencia = '$licencia', 
				tipolicencia = '$tipolicencia', idgrupoetnico = '$idgrupoetnico', calle = '$calle', numero = '$numero', zona = '$zona', 
				colonia = '$colonia', nacionalidad = '$nacionalidad', telefonocasa = '$telefono', telefonocelular = '$celular', correo = '$correo', 
				direccion_para_notificaciones = '$direccion_para_notificaciones', id_puesto = '$id_puesto',  extension='$extension', habilitado = '$estatus',
				reglon = '$reglon', partida = '$partida', iddireccion ='".$_POST['iddireccion']."',fecha_nacimiento='$mes3/$dia3/$ano3', sueldo='$v_sueldo', idtipousuario = '$tipo_usuario', hijos= '$hijos',
				id_puesto1 = '".$_POST['id_puesto1']."', gafete='$_POST[gafete]', fecha_ingreso = '$_POST[mesi]/$_POST[diai]/$_POST[anoi]'
				 WHERE idasesor = ".$_POST['paramas'];
//print $SQL;

	$result = mssql_query($SQL);
	$rsRows = mssql_query("select @@rowcount as rows");
    $rows = mssql_fetch_assoc($rsRows); 
 //  envia_msg( $rows['rows']);

	//envia_msg(mssql_rows_affected($result) );
	if ( $rows['rows'] == 1 )
	{
	envia_msg('EL REGISTRO SE HA ACTUALIZADO EXITOSAMENTE');
	
//	envia_msg($_FILES['userfilefoto']['type']);
//	envia_msg($_POST['del_foto']);
	if ($_POST['del_foto'] == 1) // si desea eliminar la fotografia actual
	 {
		$sql_imagen = "select id_doc, path from doc_adj_rrhh where idasesor = ".$_POST['paramas']." and id_tipo_doc = 1";
//	envia_msg($sql_imagen);
		$res_im = mssql_query($sql_imagen); 
		$cantidad = mssql_num_rows($res_im);
		if ($cantidad > 0) 
		 {
			while ($row_im = mssql_fetch_array($res_im)) 
			 { 
			   unlink("../../upload_rrhh/fotos/".$row_im['path']);
			   $sql_del = "delete from doc_adj_rrhh where id_doc = ".$row_im['id_doc'];
//			   envia_msg($sql_del);
			   $res_del = mssql_query($sql_del);   
			   envia_msg('Se elimino la fotograf�a solicitada.');
			 }
		}
	 } // fin 	if ($_POST['del_foto'] == 1)

	if (isset($_FILES['userfilefoto']) && ( $_FILES['userfilefoto'] != '')) // insercion de fotos
	 {
//	 envia_msg('Entro en if de sube datos');
	  sube_datos($_POST['paramas'],1); // archivo de foto
	 }
	/*if (isset($_FILES['userfile']) && ( $_FILES['userfile'] != '')) //insercion de cedulas
	 {
	  sube_datos($idas,2); // archivo de foto
	 }*/
	
	} 
	else
	{
	error_msg('NO SE PUDO ACTUALIZAR EL REGISTRO');
//	envia_msg('NO SE PUDO ACTUALIZAR EL REGISTRO');
	
	exit;
	
	} 
	
			


}
					


			}

		//print $sql;


//cambiar_ventana('busqueda_asesor1.php');
cambiar_ventana('../../visita.php');
			
?>


</body>
</html>

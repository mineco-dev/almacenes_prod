<?
// esto es lo que se pone al inicio de cada pagina<strong></strong>
session_start();


	
	include('../../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
	include('../../conectarse.php');

/*	if ( $sstipo != 1) // valida que sea un usuario administrador
	{
	 cambiar_ventana('../../mtlogin.php');
	}*/
	
	$query = 'mssql_query';
	
	function valor_registro($param_field,$param_table,$param_cond,$val_cond)
  {
 	$sql= "select $param_field from $param_table where $param_cond = '$val_cond'";
//	echo $sql;
	$result = mssql_query($sql);
	while ($row = mssql_fetch_array($result))
	  {   
	    return($row[0]);
	  }
	}
	
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
<?

$sql3 = "select nombre, direccion, nivel from direccion 
where iddireccion = $_POST[iddireccion]";
$result = mssql_query($sql3); 
				while ($row = mssql_fetch_array ($result)) 
			{		

$nivell	= $row[2];	

}


$queryase = "select usuario from asesor where idasesor = ".$_POST['paramas'];
	//print $queryase;


$resultase = mssql_query($queryase); 
//print $resultase;
				while ($rowa = mssql_fetch_array ($resultase)) 
				{
$usua	= $rowa[0];	
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

 
$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");
//$conection = mssql_connect("ecortes","","") or die("no se puede conectar a SQL Server");

 mssql_select_db("helpdesk",$conection);
   ?>

<? 


//print $_POST['iddireccion'];		
$sqlcon = "select codigo_dependencia, nombre_dependencia, activo, id_relac_finan_actividades, rrhh_direccion
from dependencia where rrhh_direccion = $_POST[iddireccion]";
//print $sqlcon;

//print $result;
$result = mssql_query($sqlcon); 
				while ($row = mssql_fetch_array ($result)) 
				{
				

//print  $row[0];	
$direc	= $row[0];	
//print $direc;
//envia_msg('aqui va el departamento');
//envia_msg($direc);		


		
	$nombres = $nombre.' '.$nombre2.' '.$nombre3;
	//print $nombres;
	//envia_msg($nombres);
	
	$apellidos = $apellido.' '.$apellido2.' '.$apellidocasada;
	//print $apellidos;
	//envia_msg($apellidos);
	
	

//envia_msg($direc);

	//$password=md5($password);
	if ($_POST['estatus'] == N) {
	    $estatuss = 2; 
		}
		
	else {
		$estatuss = 1;
	    } 
	//print $estatuss;	  
	//envia_msg($estatuss);
	
	
	}
	
 	//$usu = $_SESSION['usuario2']; 
	//envia_msg("aqui va el usuario");
	//envia_msg($usu);
	
	$query5 = "update usuario set apellidos = '$apellidos', nombres='$nombres', codigo_grupo_enc=1,
		codigo_dependencia = $direc, nivel=$nivell, extension='$extension', activo=$estatuss WHERE nombre_usuario = '$usua' ";
		//codigo_dependencia = $direc, nivel=1, extension='$extension', activo='$estatus' WHERE nombre_usuario = '".$_SESSION['usuario']."'";
	
	//$result2 = mssql_query($query5);
	
	$result = mssql_query($query5);
	$rsRows = mssql_query("select @@rowcount as rows");
    $rows = mssql_fetch_assoc($rsRows); 
	
	
	//print $result;
	//print $result2;     ESTE LO QUITE PARA VER QUE PASA
	/*$query = "EXEC proc_usuario_add @vapellidos='$apellidos', @vnombres='$nombres', @vnombre_usuario='$usuario_s', @vcodigo_grupo_enc=1, @vcodigo_dependencia=$direc, @vcontrasena='$password', @vnivel=1, @vextension='$extension'";
		$result2 = mssql_query($query);*/
		
		
//print $query;
//print $result2;



?>




	      <?
$conection = mssql_connect("server_appl","sa","sa") or die("no se puede conectar a SQL Server");		  
//$conection = mssql_connect("ecortes","","") or die("no se puede conectar a SQL Server");

 mssql_select_db("RRHH",$conection);
   ?>



<?
// este formato guarda el archivo en el inbox del usuario no lo envia al destinatario

 $me = $_POST['mes3'];
 //envia_msg($me);
 $di = $_POST['dia3'];
 //envia_msg($di);
 $an = $_POST['ano3'];
 //envia_msg($an);
 
 

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
				tipolicencia = '$tipolicencia', idgrupoetnico = '$_POST[idgrupoetnico]', calle = '$calle', numero = '$numero', zona = '$zona', 
				colonia = '$colonia', nacionalidad = '$nacionalidad', telefonocasa = '$telefono', telefonocelular = '$celular', correo = '$correo', 
				direccion_para_notificaciones = '$direccion_para_notificaciones', id_puesto = '$id_puesto',  extension='$extension', habilitado = '$estatus',  nivel = '$nivell',
				reglon = '$reglon', partida = '$partida', iddireccion ='".$_POST['iddireccion']."',fecha_nacimiento='$_POST[mes3]/$_POST[dia3]/$_POST[ano3]', sueldo=$v_sueldo, idtipousuario = '$_POST[tipo_usuario]', hijos= '$hijos',
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
	
	
$texto_modifica = 'Se modificaron los datos siguientes: ';
	 	if ($_SESSION['1nombre'] != $_POST['nombre'])
		 {
		  $texto_modifica = $texto_modifica.' Nombre anterior '.$_SESSION['1nombre'].' x '.$_POST['nombre'].'--';
		 }
		 
		if ($_SESSION['1nombre2'] != $_POST['nombre2'])
		 {
		  $texto_modifica = $texto_modifica.' Nombre2 anterior '.$_SESSION['1nombre2'].' x '.$_POST['nombre2'].'--';
		 }
		 
		if ($_SESSION['1nombre3'] != $_POST['nombre3'])
		 {
 		  $texto_modifica = $texto_modifica.' Nombre3 anterior '.$_SESSION['1nombre3'].' x '.$_POST['nombre3'].'--';
		 }
		 
		if ($_SESSION['1apellido'] != $_POST['apellido']) 
		 {
  		  $texto_modifica = $texto_modifica.' Apellido anterior '.$_SESSION['1apellido'].' x '.$_POST['apellido'].'--';
		 }
		 
		if ($_SESSION['1apellido2'] != $_POST['apellido2'])
		 {
		  $texto_modifica = $texto_modifica.' Apellido anterior '.$_SESSION['1apellido2'].' x '.$_POST['apellido2'].'--';
		 }
		 
		if ($_SESSION['1apellidocasada'] != $_POST['apellidocasada'])
		 {
		  $texto_modifica = $texto_modifica.' Apellido Casada anterior '.$_SESSION['1apellidocasada'].' x '.$_POST['apellidocasada'].'--';
		 }


		if ($_SESSION['1estadocivil'] != $_POST['estadocivil'])
		 {
		  $texto_modifica = $texto_modifica.' Estado Civil anterior '.$_SESSION['1estadocivil'].' x '.$_POST['estadocivil'].'--';
		 }
		 
		if ($_SESSION['1edad'] != $_POST['edad'])
		 {
 		  $texto_modifica = $texto_modifica.' Edad anterior '.$_SESSION['1edad'].' x '.$_POST['edad'].'--';
		 }
				 
		 
		if ($_SESSION['1sexo'] != $_POST['sexo']) 
		 {
  		  $texto_modifica = $texto_modifica.' Sexo anterior '.$_SESSION['1sexo'].' x '.$_POST['sexo'].'--';
		 }
		 
		if ($_SESSION['1nit'] != $_POST['nit'])
		 {
		  $texto_modifica = $texto_modifica.' Nit anterior '.$_SESSION['1nit'].' x '.$_POST['nit'].'--';
		 }
		 
		if ($_SESSION['1igss'] != $_POST['igss'])
		 {
		  $texto_modifica = $texto_modifica.' Igss anterior '.$_SESSION['1igss'].' x '.$_POST['igss'].'--';
		 }
	
	
	
		if ($_SESSION['1empadronamiento'] != $_POST['empadronamiento'])
		 {
		  $texto_modifica = $texto_modifica.' Empadronamiento anterior '.$_SESSION['1empadronamiento'].' x '.$_POST['empadronamiento'].'--';
		 }
		 
		if ($_SESSION['1gruposanguineo'] != $_POST['gruposanguineo'])
		 {
 		  $texto_modifica = $texto_modifica.' Grupo Sanguineo anterior '.$_SESSION['1gruposanguineo'].' x '.$_POST['gruposanguineo'].'--';
		 }
		 
		 
		 //-----------ESTE ES UNO DE LOS QUE CAMBIE-----------
		if ($_SESSION['1idregistro'] != $_POST['idregistro']) 
		 {
  		  $texto_modifica = $texto_modifica.' Registro anterior ['.$_SESSION['1idregistro'].'] '.valor_registro('registro','asesor_registro', 'idregistro',$_SESSION['1idregistro']). 
		 '  x ['.$_POST['idregistro'].'] '.valor_registro('registro','asesor_registro','idregistro',$_POST['idregistro']).'--';
		 }
		 
		 		 
		if ($_SESSION['1cedula'] != $_POST['cedula'])
		 {
		  $texto_modifica = $texto_modifica.' Cedula anterior '.$_SESSION['1cedula'].' x '.$_POST['cedula'].'--';
		 }
		 
		/*if ($_SESSION['userfilefoto'] != $_POST['userfilefoto'])
		 {
		  $texto_modifica = $texto_modifica.' Userfilefoto anterior '.$_SESSION['userfilefoto'].' x '.$_POST['userfilefoto'];
		 }*/
	
	
		// este ya----------------
		if ($_SESSION['1idmunicipio_nac'] != $_POST['idmunicipio'])
		 {
		 $texto_modifica = $texto_modifica.' Municipio anterior ['.$_SESSION['1idmunicipio_nac'].'] '.valor_registro('nombre_municipio','asesor_municipio','idmunicipio',$_SESSION['1idmunicipio_nac']). 
		 '  x ['.$_POST['idmunicipio'].'] '.valor_registro('nombre_municipio','asesor_municipio','idmunicpio',$_POST['idmunicipio']).'--';
		 }
		 		
		//este ya --------------------------				 
		if ($_SESSION['1iddepartamento_nac'] != $_POST['iddepartamento'])
		 {
		$texto_modifica = $texto_modifica.' Departamento anterior ['.$_SESSION['1iddepartamento_nac'].'] '.valor_registro('nombre_departamento','asesor_departamento','iddepartamento',$_SESSION['1iddepartamento_nac']). 
		 '  x ['.$_POST['iddepartamento'].'] '.valor_registro('nombre_departamento','asesor_departamento','iddepartamento',$_POST['iddepartamento']).'--';
		 }
		

		 
		
		
		if ($_SESSION['1licencia'] != $_POST['licencia']) 
		 {
  		  $texto_modifica = $texto_modifica.' Licencia anterior '.$_SESSION['1licencia'].' x '.$_POST['licencia'].'--';
		 }
		 
		if ($_SESSION['1tipolicencia'] != $_POST['tipolicencia'])
		 {
		  $texto_modifica = $texto_modifica.' Licencia anterior '.$_SESSION['1tipolicencia'].' x '.$_POST['tipolicencia'].'--';
		 }
		 
		 
		 //este ya ----------------------------
		if ($_SESSION['1idgrupoetnico'] != $_POST['idgrupoetnico'])
		 {
		  	  
		  $texto_modifica = $texto_modifica.' Grupo Etnico anterior ['.$_SESSION['1idgrupoetnico'].'] '.valor_registro('grupoetnico','asesor_grupoetnico','idgrupoetnico',$_SESSION['1idgrupoetnico']). 
		 '  x ['.$_POST['idgrupoetnico'].'] '.valor_registro('grupoetnico','asesor_grupoetnico','idgrupoetnico',$_POST['idgrupoetnico']).'--';
		 
		 }
		 
		 
	
	
		if ($_SESSION['1calle'] != $_POST['calle'])
		 {
		  $texto_modifica = $texto_modifica.' Calle anterior '.$_SESSION['1calle'].' x '.$_POST['calle'].'--';
		 }
		 
		if ($_SESSION['1numero'] != $_POST['numero'])
		 {
 		  $texto_modifica = $texto_modifica.' Numero anterior '.$_SESSION['1numero'].' x '.$_POST['numero'].'--';
		 }
		 
		if ($_SESSION['1zona'] != $_POST['zona']) 
		 {
  		  $texto_modifica = $texto_modifica.' Zona anterior '.$_SESSION['1zona'].' x '.$_POST['zona'].'--';
		 }
		 
		if ($_SESSION['1colonia'] != $_POST['colonia'])
		 {
		  $texto_modifica = $texto_modifica.' Colonia anterior '.$_SESSION['1colonia'].' x '.$_POST['colonia'].'--';
		 }
		 
		if ($_SESSION['1nacionalidad'] != $_POST['nacionalidad'])
		 {
		  $texto_modifica = $texto_modifica.' Nacionalidad anterior '.$_SESSION['1nacionalidad'].' x '.$_POST['nacionalidad'].'--';
		 }
	
	
	
		if ($_SESSION['1telefonocasa'] != $_POST['telefono'])
		 {
		  $texto_modifica = $texto_modifica.' Telefono Casa anterior '.$_SESSION['1telefonocasa'].' x '.$_POST['telefono'].'--';
		 }
		 
		if ($_SESSION['1telefonocelular'] != $_POST['celular'])
		 {
 		  $texto_modifica = $texto_modifica.' Telefono Celular anterior '.$_SESSION['1telefonocelular'].' x '.$_POST['celular'].'--';
		 }
		 
		if ($_SESSION['1correo'] != $_POST['correo']) 
		 {
  		  $texto_modifica = $texto_modifica.' Correo anterior '.$_SESSION['1correo'].' x '.$_POST['correo'].'--';
		 }
		 
		if ($_SESSION['1direccion_para_notificaciones'] != $_POST['direccion_para_notificaciones'])
		 {
		  $texto_modifica = $texto_modifica.' Direccion para Notificaciones anterior '.$_SESSION['1direccion_para_notificaciones'].' x '.$_POST['direccion_para_notificaciones'].'--';
		 }
		 
		 //este ya ------------------------------------
		if ($_SESSION['1id_puesto'] != $_POST['id_puesto'])
		 {

$texto_modifica = $texto_modifica.' Puesto Nominal anterior ['.$_SESSION['1id_puesto'].'] '.valor_registro('puesto','puesto','id_puesto',$_SESSION['1id_puesto']). 
		 '  x ['.$_POST['id_puesto'].'] '.valor_registro('puesto','puesto','id_puesto',$_POST['id_puesto']).'--';
		 }
		 

		/*if ($_SESSION['userfile2'] != $_POST['userfile2'])
		 {
		  $texto_modifica = $texto_modifica.' Userfile2 anterior '.$_SESSION['userfile2'].' x '.$_POST['userfile2'];
		 }*/
		 
		if ($_SESSION['1reglon'] != $_POST['reglon'])
		 {
 		  $texto_modifica = $texto_modifica.' Reglon anterior '.$_SESSION['1reglon'].' x '.$_POST['reglon'].'--';
		 }
		 
		if ($_SESSION['1partida'] != $_POST['partida']) 
		 {
  		  $texto_modifica = $texto_modifica.' Partida anterior '.$_SESSION['1partida'].' x '.$_POST['partida'].'--';
		 }
		 
		 
		 //este ya ---------------------------------------------
		if ($_SESSION['1iddireccion'] != $_POST['iddireccion'])
		 {
		  
		  
		 $texto_modifica = $texto_modifica.' Direccion anterior ['.$_SESSION['1iddireccion'].'] '.valor_registro('nombre','direccion','iddireccion',$_SESSION['1iddireccion']). 
		 '  x ['.$_POST['iddireccion'].'] '.valor_registro('nombre','direccion','iddireccion',$_POST['iddireccion']).'--';
		 }
		 
		 		 
		if ($_SESSION['fecha_nacimiento'] != $_POST['ano3'].'/'.$_POST['mes3'].'/'.$_POST['dia3'])
		 {
 		  $texto_modifica = $texto_modifica.' Fecha Nacimiento anterior '.$_SESSION['fecha_nacimiento'].' x '.$_POST['ano3'].'/'.$_POST['mes3'].'/'.$_POST['dia3'].'--';
		 }
		 /*
		 if ($_SESSION['fecha_nacimiento'] != $_POST['dia3'])
		 {
 		  $texto_modifica = $texto_modifica.' Fecha Nacimiento anterior '.$_SESSION['fecha_nacimiento'].' x '.$_POST['dia3'];
		 }

		 
		 if ($_SESSION['fecha_nacimiento'] != $_POST['mes3'])
		 {
 		  $texto_modifica = $texto_modifica.' Fecha Nacimiento anterior '.$_SESSION['fecha_nacimiento'].' x '.$_POST['mes3'];
		 }
		 
		 if ($_SESSION['fecha_nacimiento'] != $_POST['ano3'])
		 {
 		  $texto_modifica = $texto_modifica.' Fecha Nacimiento anterior '.$_SESSION['fecha_nacimiento'].' x '.$_POST['ano3'];
		 }*/
	
		//este ya -----------------------------------------------
		if ($_SESSION['1idmunicipio_reside'] != $_POST['idgrupo2'])
		 {
		$texto_modifica = $texto_modifica.' Municipio Reside anterior ['.$_SESSION['1idmunicipio_reside'].'] '.valor_registro('nombre_municipio','asesor_municipio','idmunicipio',$_SESSION['1idmunicipio_reside']). 
		 '  x ['.$_POST['idgrupo2'].'] '.valor_registro('nombre_municipio','asesor_municipio','idmunicpio',$_POST['idgrupo2']).'--';
		 }
		
		
		 		
		//este ya ------------------------------------------------ 
		if ($_SESSION['1iddepartamento_reside'] != $_POST['tema2'])
		 {
 		 $texto_modifica = $texto_modifica.' Id Departamento anterior ['.$_SESSION['1iddepartamento_reside'].'] '.valor_registro('nombre_departamento','asesor_departamento','iddepartamento',$_SESSION['1iddepartamento_reside']). 
		 '  x ['.$_POST['tema2'].'] '.valor_registro('nombre_departamento','asesor_departamento','iddepartamento',$_POST['tema2']).'--';
		 }
		 
		 
		 
		 
		 
		 
		 
		/*if ($_SESSION['usuario'] != $_POST['usuario']) 
		 {
  		  $texto_modifica = $texto_modifica.' Usuario anterior '.$_SESSION['usuario'].' x '.$_POST['usuario'];
		 }
		 
		if ($_SESSION['password'] != $_POST['password'])
		 {
		  $texto_modifica = $texto_modifica.' Password anterior '.$_SESSION['password'].' x '.$_POST['password'];
		 }*/
		 
		if ($_SESSION['1extension'] != $_POST['extension'])
		 {
		  $texto_modifica = $texto_modifica.' Extension anterior '.$_SESSION['1extension'].' x '.$_POST['extension'].'--';
		 }
	
	
		
		if ($_SESSION['habilitado'] != $_POST['estatus'])
		 {
		  $texto_modifica = $texto_modifica.' Habilitado anterior '.$_SESSION['habilitado'].' x '.$_POST['estatus'].'--';
		 }
		 
		/*if ($_SESSION['fecha_creacion'] != $_POST['fecha_creacion'])
		 {
 		  $texto_modifica = $texto_modifica.' Fecha Creacion anterior '.$_SESSION['fecha_creacion'].' x '.$_POST['fecha_creacion'];
		 }
		
		if ($_SESSION['usuario_creacion'] != $_POST['usuario_creacion']) 
		 {
  		  $texto_modifica = $texto_modifica.' Usuario Creacion anterior '.$_SESSION['usuario_creacion'].' x '.$_POST['usuario_creacion'];
		 }*/
		 
		//este ya -------------------------------------------
		if ($_SESSION['1idtipousuario'] != $_POST['tipo_usuario'])
		 {
		  $texto_modifica = $texto_modifica.' Tipo Usuario anterior ['.$_SESSION['1idtipousuario'].'] '.valor_registro('tipo','tipo_usuario','idtipousuario',$_SESSION['1idtipousuario']). 
		 '  x ['.$_POST['tipo_usuario'].'] '.valor_registro('tipo','tipo_usuario','idtipousuario',$_POST['tipo_usuario']).'--';
		 }
		 
		 
		if ($_SESSION['1gafete'] != $_POST['gafete'])
		 {
		  $texto_modifica = $texto_modifica.' Gafete anterior '.$_SESSION['1gafete'].' x '.$_POST['gafete'].'--';
		 }
		
	
		if ($_SESSION['1sueldo'] != $_POST['sueldo'])
		 {
		  $texto_modifica = $texto_modifica.' Sueldo anterior '.$_SESSION['1sueldo'].' x '.$_POST['sueldo'].'--';
		 }
		 
		if ($_SESSION['1hijos'] != $_POST['hijos'])
		 {
 		  $texto_modifica = $texto_modifica.' Hijos anterior '.$_SESSION['1hijos'].' x '.$_POST['hijos'].'--';
		 }
		 
		 //este ya------------------------------------------------


		if ($_SESSION['1id_puesto1'] != $_POST['id_puesto1']) 
		 {
  		 	 
		 $texto_modifica = $texto_modifica.' Puesto Funcional anterior ['.$_SESSION['1id_puesto1'].'] '.valor_registro('puesto','puesto','id_puesto',$_SESSION['1id_puesto1']). 
		 '  x ['.$_POST['id_puesto1'].'] '.valor_registro('puesto','puesto','id_puesto',$_POST['id_puesto1']).'--';
		 
		 } 
		 
		 
		 
		/* 
		if ($_SESSION['fecha_ingreso'] != $_POST['diai'])
		 {
		  $texto_modifica = $texto_modifica.' Fecha Ingreso anterior '.$_SESSION['fecha_ingreso'].' x '.$_POST['diai'];
		 }
		 
		 if ($_SESSION['fecha_ingreso'] != $_POST['mesi'])
		 {
		  $texto_modifica = $texto_modifica.' Fecha Ingreso anterior '.$_SESSION['fecha_ingreso'].' x '.$_POST['mesi'];
		 }
		 
		 if ($_SESSION['fecha_ingreso'] != $_POST['anoi'])
		 {
		  $texto_modifica = $texto_modifica.' Fecha Ingreso anterior '.$_SESSION['fecha_ingreso'].' x '.$_POST['anoi'];
		 }
		*/
		
		 
		if ($texto_modifica != 'Se modificaron los datos siguientes: ')
		 {
	$consulta = "EXEC proc_add_usuario 
										@v_id_asesor_actualizo='$_SESSION[codigoUsuario]',  
										@v_descripcion='$texto_modifica',  
										@v_id_usuario_registro='$_POST[paramas]'";		
				
		//print $consulta;
		$result=$query($consulta);	
		//$close($s);		
		session_write_close();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
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

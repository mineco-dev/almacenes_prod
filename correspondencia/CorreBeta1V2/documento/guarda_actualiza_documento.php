<?
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
/*
$a = $_POST['userfile'];

envia_msg($a);


$b = $_POST['de'];
envia_msg($b);

$b = $_POST['de'];
envia_msg($b);


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




 function sube_datos($idas,$tipo_file) // 1 foto, 2 copia cedula
  {
 
	 // validmos tipo de archivo para cambiar el nombre en el la funcion upload
		   if ($tipo_file == 2)
			{
			 $archivo = 'userfile'; //foto
			}
   		  elseif ($tipo_file == 3)
			{
			 $archivo = 'userfilecurriculum'; //curriculum
			}
			

			
			
  			 /* sube la foto y archivo de copia de cedula*/
			 
		/*	$nombre_archivo = $_FILES[$archivo]['name']; 
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
					values ('$txtDescripcion','$tipo_archivo','$nombre_archivo','$path23',$idas, 2, getdate())";
			envia_msg($sql);					
					$result = mssql_query($sql_);
			print $sql_;
				
					//$dbms->Query(); 
					//mssql_close($db);
					$q1=$insti;
					if ( $tipo_file == 2 ) // para subir fotos
					 {
					  $info23 = move_uploaded_file($_FILES[$archivo]['tmp_name'], "../../upload_rrhh/curriculum/".$path23);
					 }
					elseif ( $tipo_file == 3 ) //		if ( $tipo_file == 2 ) // para subir copia cedula
					 {
					  $info23 = move_uploaded_file($_FILES[$archivo]['tmp_name'], "../../upload_rrhh/fotos/".$path23);
					 }
			 
			   	
			 
			 
			 /* sube la foto y archivo de copia de cedula*/
/*
  }
*/

?>

<?

$_GET['emple'];

//print $_GET['emple'];

$m = $_GET['emple'];
//envia_msg($m);

//print $_POST['id_tipo_doc'];
$d = $_POST['id_tipo_doc'];
//envia_msg($d);

$nombre_archivo = $HTTP_POST_FILES['userfile']['name']; 
$tipo_archivo = $HTTP_POST_FILES['userfile']['type']; 
$tamano_archivo = $HTTP_POST_FILES['userfile']['size'];
$archivo23 = split('[.]',$nombre_archivo);
$tipo_archivo = $archivo23[sizeof($archivo23)-1];
$fecha = date("dmYHis");
$path23 = $usuario.$fecha.".".$tipo_archivo;
//$docu=$_POST['docu'];
$docu= $_SESSION['correlativo'];
$d0F23 = $_SESSION['siddireccion'];



/*$sql_="insert into doc_adj_rrhh(descripcion,docu,extension,nombre,path,idasesor) 
		values ('$txtDescripcion',$docu,'$tipo_archivo','$nombre_archivo','$path23',$dU)";*/
		
	$sql_="insert into doc_adj_rrhh(descripcion,extension,nombre,path,idasesor, id_tipo_doc, fecha) 
					values ('$txtDescripcion','$tipo_archivo','$nombre_archivo','$path23',$m, '".$_POST['id_tipo_doc']."', getdate())";
		
		$result = mssql_query($sql_);
//print $sql_;
	
		//$dbms->Query(); 
		//mssql_close($db);
		$q1=$insti;
	    $info23 = move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "../../upload_rrhh/documentos/".$path23);
//		header("location: documento.php?insti=$q1&quien=$quien&ref=$ref&titulo=$titulo&desc=$desc");
//		cambiar_ventana("documento.php?insti=$q1&quien=$quien&ref=$ref&titulo=$titulo&desc=$desc");
		
		//cambiar_ventana("actualiza_documento.php <? print "?paramas=$m";  ");


		
		cambiar_ventana("actualiza_documento.php?paramas=$m");
?>


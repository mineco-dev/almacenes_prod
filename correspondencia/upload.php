<?
session_start();
	include('INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 

	$_SESSION['nivel']=1;
	include('valida.php');
	//include('conectarse.php');
//envia_msg('aqui si upload');


//ESTO ES LO NUEVO
// ESTE ES EL LOGEO DEL USUARIO **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  
  session_unregister('MM_Username');
  session_unregister('MM_UserGroup');
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}

//AQUI TERMINA LO NUEVO

//$usuario = $_SESSION['ID'];
//$cadenatexto = $_POST["cadenatexto"]; 
//echo "Escribió en el campo de texto: " . $cadenatexto . "<br><br>"; 
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



// session_start();

	

//require ('conexion.inc');
		//$db = mssql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mssql_select_db($BASE_DATOS,$db);


//		$dU=$_SESSION['ID']; //codigo del usuario
		$dU=$_SESSION['codigoUsuario']; //codigo del usuario
		$corre = $_SESSION['correlativo'];
//		envia_msg($_SESSION['correlativo']);
$sql_verifica = "select empleado, docu from tmp_documento where empleado = $dU and docu = $corre";
//print  $sql_verifica;
$res_ver = mssql_query($sql_verifica);
$cant_v = mssql_num_rows($res_ver);
//envia_msg($cant_v);
if ( (!$cant_v) || ($cant_v == 0) || ($cant_v == null)  )
	{
		$sql_1="insert into tmp_documento(docu,titulo,quien,descr,insti,ref,empleado,correlativo,idDireccion,corr) 
				values ($docu,'".$_GET['titulo']."','".$_GET['quien']."','".$_GET['desc']."','".$_GET['insti']."','".$_GET['ref']."',$dU,$corre,$d0F23,$corre)";
				$result = mssql_query($sql_1);
//		envia_msg('antes de mostrar query');
//	print $sql_1;
//		envia_msg('despues de mostrar query');
	}



//		$dbms->sql="insert into tmp_doc_adj(descripcion,docu,extension,nombre,path,idempleado) values ('$txtDescripcion',$docu,'$tipo_archivo','$nombre_archivo','$path23',$dU)";

$sql_="insert into tmp_doc_adj(descripcion,docu,extension,nombre,path,idasesor) 
		values ('$txtDescripcion',$docu,'$tipo_archivo','$nombre_archivo','$path23',$dU)";
		$result = mssql_query($sql_);
//print $sql_;
	
		//$dbms->Query(); 
		//mssql_close($db);
		$q1=$insti;
	    $info23 = move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], "upload/".$path23);
//		header("location: documento.php?insti=$q1&quien=$quien&ref=$ref&titulo=$titulo&desc=$desc");
		cambiar_ventana("documento.php?insti=$q1&quien=$quien&ref=$ref&titulo=$titulo&desc=$desc");
?> 
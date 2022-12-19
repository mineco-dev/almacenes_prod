<?	session_start(); 

	$_SESSION['nivel']=1;
	include('valida.php');

function getCorrelativoDireccion($fdireccion){
		include('../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
	//include("conectarse.php");


			
	$sql="select correlativo from direccion where iddireccion=$fdireccion";
	$result = mssql_query($sql); 
//	print '----'.mssql_num_rows($result);

		$scorrelativo =  intval($row[0]);

		/*$sql="update  direccion set correlativo=correlativo+1 where iddireccion=$fdireccion";      
		$result = mssql_query($sql);*/

		//print "si devolvio algo";
		return $scorrelativo;


}

function getVCorrelativoDireccion($fdireccion){

			include('INCLUDES/inc_header.inc');
			$dbms=new DBMS($conexion); 
//include("conectarse.php");

		$ssdir = $_SESSION['siddireccion'];	

		$sql="select correlativo,nombre from direccion where iddireccion=$ssdir";
		$prueba1 = mssql_query($sql); 
//		print mssql_num_rows($prueba1);
//		envia_msg ('correlativo '. mssql_num_rows($prueba1));
		$row = mssql_fetch_array($prueba1);
		$scorrelativo = $row[1]."-".$row[0];
		//print $ssdir." - ".$fdireccion;
		if (intval($ssdir) != intval($fdireccion))
		{


		$sql="update direccion set correlativo = correlativo+1 where iddireccion=$ssdir";
		$prueba = mssql_query($sql); 
//		envia_msg($sql);

		}	
		//print "si devolvio algo";
		return $scorrelativo;
}

function setCorrespondencia($fdireccion,$fidempleado,$fcorrelativo,$fob1,$fob2,$fob3,$fob4,$fob5,$fob6,$fob7,$fob8,$fob9,$fob10,$fob11)
	{

//	envia_msg('entra en funcion correspondencia'.$fidempleado);
//		$ffecha9 = '20'.substr($fob10,7,4).'/'.substr($fob10,1,2).'/'.substr($fob10,4,2);
		$ffecha = '20'.date("y/m/d");
		$hhora = date("H:i:s");
		$usuario = $_SESSION[idempleado];	
/*		envia_msg($ffecha);
		envia_msg($hhora);
		envia_msg($fcorrelativo. 'correlativo');
		
		
		envia_msg('id empleado'.$fidempleado);
		envia_msg('id usuario'.$usuario);*/


			include('../INCLUDES/inc_header.inc');
			$dbms=new DBMS($conexion); 


//* para imprimir el codigo de insercion
		$sqlin= "INSERT INTO correspondencia
						(
							iddireccion,
							correlativo,
							carpeta,
							titulo,
							quien,
							descr,
							insti,
							ref,
							tramite,
							observacion,
							fechainicio,
							idasesor,
							idasesor2,
							idasesorcrea,
							idasesordestino,
							status,
							fechaenvio,
							horacreacion,
							horaenvio,
							correlativoinicial,
							fechaentrega,
							horaentrega
							) 
				values 
						(
							$fdireccion,
							$fcorrelativo,
							$fob8,
							'$fob1',
							'$fob2',
							'$fob3',
							'$fob4',
							'$fob5',
							$fob6,
							'$fob7',
							'$ffecha',
							$usuario,
							$fidempleado,
							$usuario,
							$fidempleado,
							0,
							getdate(), 
							'$hhora',
							'$hhora',
							'$fob9',
							'$fob10',
							'$fob11'
						)
				";

				//envia_msg('aqui se inserta la correspondencia'.$sqlin);
				$result=mssql_query($sqlin);
		//print $sqlin;
// para imprimir el codigo de insercion		
		//$dbms->Query(); 

//envia_msg('antes de cambiar correlativo');
$sql="select max(idcorrespondencia) idcorresp FROM correspondencia where idasesorcrea=$usuario";
		$result=mssql_query ($sql); 
//		print $sql;
		while ($row = mssql_fetch_row ($result))
		{
				
/*				envia_msg($row[0]);
				envia_msg('idcorresp'.$row['idcorresp']);*/
				$scorrelativo =  intval($row[0]);
				return $scorrelativo;
		}
//envia_msg('despues de cambiar correlativo');
}

function setAdjunto($fidcorrespondencia){
//envia_msg('ingresa a la funcion del set adjunto');
		$ffecha = date("y/m/d");
		$hhora = date("H:i:s");
		$usuario = $_SESSION['codigoUsuario'];/*$_SESSION[idempleado];	*/

		include('../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 

		$sql = "INSERT INTO correspondencia_adjunto(
							idcorrespondencia,
							descripcion,
							extension,
							nombre,
							path) 
				select 		$fidcorrespondencia,
							descripcion,
							extension,
							nombre,
							path
				from 
					tmp_doc_adj 
				where 
					idasesor = $usuario and docu = $_SESSION[correlativo]";


//print "<br>".$sql;		
		$result=mssql_query($sql);

		return true;
}

function setSeguimiento($fidcorrespondencia,$fidempleado){
		//$ffecha = '20'.date("y/d/m");
		$ffecha = '20'.date("y/m/d");
		$hhora = date("H:i:s");
		$usuario = $_SESSION['idempleado'];	

			include('../INCLUDES/inc_header.inc');
			$dbms=new DBMS($conexion); 

		$sql2 = "INSERT INTO correspondencia_seguimiento
					(
							idcorrespondencia,
							idasesororigen,
							idasesordestino,
							fecha,
							hora
					) 
				values 		
					(
							$fidcorrespondencia,
							$usuario,
							$fidempleado,
							'$ffecha',
							'$hhora'
					)";
		//print $SQL;		

//			print "<br>".$sql2;		
			$result=mssql_query($sql2);

		return true;
}

function SendMsg($mm,$fidcorrespondencia,$fidempleado,$fdesc,$fquien){
		$ffecha = '20'.date("y/m/d");
		$hhora = date("H:i:s");
		$usuario = $_SESSION['idempleado'];	


			include('../INCLUDES/inc_header.inc');
			$dbms=new DBMS($conexion); 

//		$dbms->sql="select correo, nombre+' '+apellido from asesor where idasesor =$fidempleado";ç
/*		$dbms->sql="select correo, nombre+' '+apellido from asesor where idasesor =$fidempleado";
		$dbms->Query(); */
//		print $dbms->rowcount;

//			print "SELECT correo, nombre+' '+apellido FROM asesor WHERE idasesor = $fidempleado ";
/*		$dbms->sql= "SELECT correo, nombre+' '+apellido FROM asesor WHERE idasesor = $fidempleado ";
		$dbms->Query();*/
//		print $dbms->rowcount;

// DE QUIEN
		$sel_data = "select correo, nombre+' '+apellido nombres FROM asesor WHERE idasesor = $usuario ";
		$res_data = mssql_query($sel_data);
		while ($row_data = mssql_fetch_array($res_data))
		 {
		 	$correo = $row_data[0];
		 	$noms = $row_data[1];
		 }

// PARA QUIEN	    
		$sel_data_to = "select correo, nombre+' '+apellido nombres FROM asesor WHERE idasesor = $fidempleado ";
		$res_data_to = mssql_query($sel_data_to);
		while ($row_data_to = mssql_fetch_array($res_data_to))
		 {
		 	$correo_to = $row_data_to[0];
		 	$noms_to = $row_data_to[1];
		 }
		
		
/*		$bod = "Titulo $txtTitulo <br> <br> Descripcion: $fdesc <br> Quien envia: $fquien atentamente, ".$row21[1]. 
							"<br><a href=http://mensajeria/CorreBeta1V2/mtinicia.php?docu=$fidcorrespondencia&mtcc=$fidempleado&quien=$row21[1]>Ver Correspondencia</a>";*/
		$bod = "Titulo ".$_POST['txtTitulo']." <br> <br> Descripcion: $fdesc <br> Quien envia: $fquien <BR> Atentamente, ".$noms. 
									"<br><a href=http://aseggys/index.php>Ver Correspondencia</a>";
// comentado el 21/02/2008 para que haga el redireccionameinto desde el correo electronico del usuario a la pagina de assegys donde se encuentra correspondencia
//																		"<br><a href=http://mensajeria/CorreBeta1V2/visualiza/documento.php?docu=$fidcorrespondencia&quien=$noms_to>Ver Correspondencia</a>";
//							"<br><a href=http://mensajeria/CorreBeta1V2/mtinicia.php?docu=$fidcorrespondencia&mtcc=$fidempleado&quien=$noms>Ver Correspondencia</a>";
		
			$mail = $mm;
			$mail->IsSMTP();
//			$mail->Host = "me-s-mail.mineco.gob.gt";
			$mail->Host = "128.5.8.26";
			$mail->SMTPAuth = true;
			$mail->Username = "infocomex";
			$mail->Password = "cafta2006";
/*			$mail->Username = "kramirez";
			$mail->Password = "964587";*/

//			$mail->From = $row21[0];
			$mail->From = $correo;
//			$mail->FromName = $row21[1];
			$mail->FromName = $noms;
//			$mail->AddAddress($row[0],$row[1]);
			$mail->AddAddress($correo_to,$noms_to);
			$mail->WordWrap = 100;                                
			$mail->IsHTML(true);                                  
			$mail->Subject = "Usted tiene correspondencia";
			$mail->Body    = $bod;
			$mail->AltBody = "Usted tiene correspondencia";
				if(!$mail->Send())
				{
				   echo "Message could not be sent. <p>";
//				   echo "<br> FromName = $row21[1]";
				   echo "<br> FromName = $noms";
//				   echo "<br> AddAddress($row[0],$row[1])";
				   echo "<br> AddAddress($correo,$noms)";
				   echo "<br> Mailer Error: " . $mail->ErrorInfo;
				}
				else
				{
//					echo "El mensaje ha sido enviado a $row[0],$row[1] <br>";
					echo "El mensaje ha sido enviado a $correo, $noms <br>";
				}
		return true;
}

function envia($fccor,$fccorr){
//	header("Location: okTransfer.php?docu=$fccor&corrfinal=$fccorr");
//	se comento el 061207
		//	print "<br>Correspondencia Enviada a todos los usuarios<br>";
//	print "<a href=\"okTransfer.php?docu=$fccor&corrfinal=$fccorr\"> Continuar </a>";
?>
	<META HTTP-EQUIV="refresh" CONTENT="1;URL=okTransfer.php?docu=<? print $fccor; ?> &corrfinal= <? print $fccorr; ?>">
<?

}

?>

<?
//print "carpeta = $ccarpeta";
include('INCLUDES/inc_header.inc');
//include("conectarse.php");


/*envia_msg('asesor ESTE ES EL PRIMERO'.$_POST['idasesor']);
envia_msg('asesor1 ESTE ES EL SEGUNDO'.$_POST['idasesor1']);
envia_msg('asesor2 ESTE ES EL TERCERO'.$_POST['idasesor2']);
envia_msg('asesor3 ESTE ES EL CUARTO'.$_POST['idasesor3']);
envia_msg('asesor ESTE ES EL PRIMER SUBACT'.$_POST['SubActividades3']);
envia_msg('asesor1 ESTE ES EL SEGUNDO SUBACT'.$_POST['SubActividades4']);
envia_msg('asesor2 ESTE ES EL TERCERO SUBACT'.$_POST['SubActividades5']);
envia_msg('asesor3 ESTE ES EL CUARTO SUBACT'.$_POST['SubActividades6']);
envia_msg('DIRECCION '.$_POST['iddireccion3']);
envia_msg('DIRECCION 1'.$_POST['iddireccion4']);
envia_msg('DIRECCION 2'.$_POST['iddireccion5']);
envia_msg('DIRECCION 3'.$_POST['iddireccion6']);*/

//envia_msg('ccarpeta '.$ccarpeta);
if (intval($ccarpeta) == 1)
//	envia_msg(intval($iddireccion) + intval($iddireccion1)+intval($iddireccion2)+intval($iddireccion3));
	//if ((intval($iddireccion) + intval($iddireccion1)+intval($iddireccion2)+intval($iddireccion3)) == 0)
	if (intval($_POST['SubActividades3']) +intval($_POST['SubActividades4'])+intval($_POST['SubActividades5'])+intval($_POST['SubActividades6'])== 0)
	 {
//	envia_msg('entra a envia msg y cambia a documento');
		/*envia_msg(intval($iddireccion));
		envia_msg(intval($iddireccion1));
		envia_msg(intval($iddireccion2));
		envia_msg(intval($iddireccion3));*/
//		header("Location: documento.php");\
		cambiar_ventana("documento.php");
	 }

//envia_msg('entra a carpeta 1'.$date9);

//$fechaentrega=substr($date9,6,4)."/".substr($date9,3,2)."/".substr($date9,0,2);
$fechaentrega=substr($date9,3,2)."/".substr($date9,0,2)."/".substr($date9,6,4);
$horaentrega =substr($date9,12,5);

$usuario = $_SESSION['codigoUsuario'];
//$usuario = $_SESSION['idempleado'];	
$ssdir = $_SESSION['siddireccion'];	
//require('conexion.inc');

/*envia_msg('usuario'.$usuario);
envia_msg('direccion'.$ssdir);*/

require("class.phpmailer.php");
$mail = new PHPMailer();
//$db = mssql_connect($SERVIDOR,$USUARIO,$PASSWORD);
//mssql_select_db($BASE_DATOS,$db);
		$carpeta = $ccarpeta;
		$corcrea = getVCorrelativoDireccion($idasesor);
		//envia_msg($corcrea);
		
/*	envia_msg($mail);
envia_msg($sidcorre);
envia_msg($select_2);
envia_msg($txtDesc);
envia_msg($txtQuien);		*/


/*	if ( isset($_GET['borrad']) && $_GET['borrad'] == 1)  
		{*/
//			$usuario = $_SESSION['ID'];
//			$cadenatexto = $_POST["cadenatexto"]; 
			//echo "Escribió en el campo de texto: " . $cadenatexto . "<br><br>"; 
/*			$nombre_archivo = $HTTP_POST_FILES['userfile']['name']; 
			$tipo_archivo = $HTTP_POST_FILES['userfile']['type']; 
			$tamano_archivo = $HTTP_POST_FILES['userfile']['size'];
			$archivo23 = split('[.]',$nombre_archivo);
			$tipo_archivo = $archivo23[sizeof($archivo23)-1];*/
			$fecha = date("dmYHis");
//			$path23 = $usuario.$fecha.".".$tipo_archivo;
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
//			envia_msg($cant_v);
			if ( (!$cant_v) || ($cant_v == 0) || ($cant_v == null)  )
				{
/*					envia_msg('POST'.$_POST['txtQuien']);
					envia_msg('POST'.$_POST['txtInsti']);
					envia_msg('POST'.$_POST['txtTitulo']);
					envia_msg('POST'.$_POST['txtRef']);
					envia_msg('POST'.$_POST['txtDesc']);*/
					$sql_1="insert into tmp_documento(docu,titulo,quien,descr,insti,ref,empleado,correlativo,idDireccion,corr) 
							values ($docu,'".$_POST['txtTitulo']."','".$_POST['txtQuien']."','".$_POST['txtDesc']."','".$_POST['txtInsti']."','".$_POST['txtRef']."',$dU,$corre,$d0F23,$corre)";
							$result = mssql_query($sql_1);
			//		envia_msg('antes de mostrar query');
//				print $sql_1;
//					envia_msg('despues de mostrar query');
				}



//		}


		if (intval($carpeta) == 3)		
		{
			$scorr = getCorrelativoDireccion($usuario);
			$sidcorre = setCorrespondencia($_SESSION['siddireccion'],$usuario,$_SESSION['correlativo'],$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,3,$corcrea,$fechaentrega,$horaentrega);
			$ccorr = $sidcorre;
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$usuario))
			{
			}
			$ccor = $sidcorre;
		}
		/*if (intval($carpeta) == 1)		
		{
			print "<br> 1.. <br>";
			$scorr = getCorrelativoDireccion(1);
			$sidcorre = setCorrespondencia($_SESSION['siddireccion'],$_SESSION['user'],$_SESSION['correlativo'],$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea,$fechaentrega,$horaentrega);
			envia_msg('En carpeta 1 el correlativo de la funcion '.$sidcorre);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$_POST['idasesor1']))
			{
			}

			if (SendMsg($mail,$sidcorre,$select_2,$txtDesc,$txtQuien))
			{
			}
			$ccor = $sidcorre;
//		}		*/
		if (intval($_POST['SubActividades3']) > 0 || $_POST['idasesor'] > 0)		
		{
//			envia_msg('aqui empieza subActividades3');
//			print "<br> 1.. <br>";
			$scorr = getCorrelativoDireccion($_SESSION['siddireccion']);
			$sidcorre = setCorrespondencia($_SESSION['siddireccion'],$_POST['SubActividades3'],$_SESSION['correlativo'],$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea,$fechaentrega,$horaentrega);
			$ccorr = $sidcorre;
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$_POST['SubActividades3']))
			{
			}
//			print  ($mail.'*-*'.$sidcorre.'*-*'.$_POST['SubActividades3'].'*-*'.$txtDesc.'*-*'.$txtQuien);
			if (SendMsg($mail,$sidcorre,$_POST['SubActividades3'],$txtDesc,$txtQuien))
				{
				}
			$ccor = $sidcorre;
		}		
		if (intval($_POST['SubActividades4']) > 0 || $_POST['idasesor1'] > 0)		
		{
/*			if  ( $_POST['SubActividades4'] <> $_POST['idasesor1'] )
				{
					$_POST['SubActividades4'] = $_POST['idasesor1'];
				}*/

/*			envia_msg('aqui empieza subActividades4');
			print "<br> 2.. <br>";*/
//			$scorr = getCorrelativoDireccion($_POST['iddireccion1']);
			$scorr = getCorrelativoDireccion($_SESSION['siddireccion']);
//			$sidcorre = setCorrespondencia($_POST['iddireccion1'],$_POST['SubActividades4'],$_SESSION['correlativo'],$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea,$fechaentrega,$horaentrega);
			$sidcorre = setCorrespondencia($_SESSION['siddireccion'],$_POST['SubActividades4'],$_SESSION['correlativo'],$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea,$fechaentrega,$horaentrega);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$_POST['SubActividades4']))
			{
			}
			if (SendMsg($mail,$sidcorre,$_POST['SubActividades4'],$txtDesc,$txtQuien))
			{
			}
			$ccor = $sidcorre;
		}		
		if (intval($_POST['SubActividades5']) > 0 || $_POST['idasesor2'] > 0)		
		{
/*		envia_msg('aqui empieza subActividades5');		
			print "<br> 3..<br>";*/
//			$scorr = getCorrelativoDireccion($_POST['iddireccion2']);
//			$sidcorre = setCorrespondencia($_POST['iddireccion2'],$_POST['SubActividades5'],$_SESSION['correlativo'],$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea,$fechaentrega,$horaentrega);
			$scorr = getCorrelativoDireccion($_SESSION['siddireccion']);
			$sidcorre = setCorrespondencia($_SESSION['siddireccion'],$_POST['SubActividades5'],$_SESSION['correlativo'],$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea,$fechaentrega,$horaentrega);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$_POST['SubActividades5']))
			{
			}
			if (SendMsg($mail,$sidcorre,$_POST['SubActividades5'],$txtDesc,$txtQuien))
			{
			}
			$ccor = $sidcorre;
		}		
		if (intval($_POST['SubActividades6']) > 0 || $_POST['idasesor3'] > 0)		
		{
/*			envia_msg('aqui empieza subActividades6');
			print "<br> 4..<br>";*/
//			$scorr = getCorrelativoDireccion($_POST['iddireccion3']);
//			$sidcorre = setCorrespondencia($_POST['iddireccion3'],$_POST['SubActividades6'],$_SESSION['correlativo'],$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea,$fechaentrega,$horaentrega);
			$scorr = getCorrelativoDireccion($_SESSION['siddireccion']);
			$sidcorre = setCorrespondencia($_SESSION['siddireccion'],$_POST['SubActividades6'],$_SESSION['correlativo'],$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea,$fechaentrega,$horaentrega);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$_POST['SubActividades6']))
			{
			}
			if (SendMsg($mail,$sidcorre,$_POST['SubActividades6'],$txtDesc,$txtQuien))
			{
			}
			$ccor = $sidcorre;
		}		
		if (intval($select5_2) > 0)		
		{
			print "<br> 5 <br>";
			$scorr = getCorrelativoDireccion($select_51);
			$sidcorre = setCorrespondencia($select_51,$select5_2,$scorr,$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea,$fechaentrega,$horaentrega);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$select5_2))
			{
			}
			if (SendMsg($mail,$sidcorre,$select5_2,$txtDesc,$txtQuien))
			{
			}
		}		
/*		envia_msg('ccor'.$ccor);
		envia_msg('ccorr final'.$ccorr);*/

		envia($ccorr,$ccor);

/*header("Location: okTransfer.php?docu=$ccor&corrfinal=$ccorr");
header("Location: okTransfer.php?docu=$ccor&corrfinal=$ccorr");
header("Location: okTransfer.php?docu=$ccor&corrfinal=$ccorr");*/
?>

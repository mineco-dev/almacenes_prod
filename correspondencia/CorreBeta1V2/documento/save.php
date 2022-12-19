


<?
	include('conectarse.php');
envia_msg('aqui si save');
function getCorrelativoDireccion($fdireccion){
		include('../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 


			
	$dbms->sql="select correlativo from direccion where iddireccion=$fdireccion";
	$dbms->Query(); 
	print $dbms->rowcount;

		$scorrelativo =  intval($row[0]);

		$dbms->sql="update  direccion set correlativo=correlativo+1 where iddireccion=$fdireccion";      
		$dbms->Query(); 

		//print "si devolvio algo";
	envia_msg('si envia');
		return $scorrelativo;
}

function getVCorrelativoDireccion($fdireccion){

			include('../INCLUDES/inc_header.inc');
			$dbms=new DBMS($conexion); 

		$ssdir = $_SESSION['siddireccion'];	

		$dbms->sql="select correlativo,nombre from direccion where iddireccion=$ssdir";
		$dbms->Query(); 
		print $dbms->rowcount;

		
		$scorrelativo = $row[1]."-".$row[0];
		//print $ssdir." - ".$fdireccion;
		if (intval($ssdir) != intval($fdireccion))
		{


		$dbms->sql="update direccion set correlativo = correlativo+1 where iddireccion=$ssdir";
		$dbms->Query(); 

		}	
		//print "si devolvio algo";
		return $scorrelativo;
}

function setCorrespondencia($fdireccion,$fidempleado,$fcorrelativo,$fob1,$fob2,$fob3,$fob4,$fob5,$fob6,$fob7,$fob8,$fob9,$fob10,$fob11){
		$ffecha = date("y/m/d");
		$hhora = date("H:i:s");
		$usuario = $_SESSION[idempleado];	


			include('../INCLUDES/inc_header.inc');
			$dbms=new DBMS($conexion); 




		$dbms->sql = "INSERT INTO correspondencia
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
							idempleado1,
							idempleado2,
							idempleadocrea,
							idempleadodestino,
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
							'$ffecha',
							'$hhora',
							'$hhora',
							'$fob9',
							'$fob10',
							'$fob11'
						)
				";
		//print $SQL;		
		
		$dbms->Query(); 


$dbms->sql="select max (idcorrespondencia) FROM correspondencia where idempleadocrea=$usuario";
		$dbms->Query(); 
		print $dbms->rowcount;

		$scorrelativo =  intval($row[0]);
		return $scorrelativo;
}

function setAdjunto($fidcorrespondencia){
		$ffecha = date("y/m/d");
		$hhora = date("H:i:s");
		$usuario = $_SESSION[idempleado];	


			include('../INCLUDES/inc_header.inc');
			$dbms=new DBMS($conexion); 

		$dbms->sql = "INSERT INTO correspondencia_adjunto(
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
					idempleado = $usuario";
		//print $SQL;		
		$dbms->Query(); 

		return true;
}

function setSeguimiento($fidcorrespondencia,$fidempleado){
		$ffecha = date("y/m/d");
		$hhora = date("H:i:s");
		$usuario = $_SESSION[idempleado];	


			include('../INCLUDES/inc_header.inc');
			$dbms=new DBMS($conexion); 

		$dbms->sql = "INSERT INTO correspondencia_seguimiento
					(
							idcorrespondencia,
							idempleadoorigen,
							idempleadodestino,
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
		$dbms->Query(); 
		return true;
}

function SendMsg($mm,$fidcorrespondencia,$fidempleado,$fdesc,$fquien){
		$ffecha = date("y/m/d");
		$hhora = date("H:i:s");
		$usuario = $_SESSION[idempleado];	


			include('../INCLUDES/inc_header.inc');
			$dbms=new DBMS($conexion); 

		$dbms->sql="select email, concat(nombre,' ',apellidos) from empleados where idempleado =$fidempleado";
		$dbms->Query(); 
		print $dbms->rowcount;

		$dbms->sql= "SELECT email,concat(nombres,' ',apellidos) FROM empleados WHERE idempleado = $usuario ";
		$dbms->Query();
		print $dbms->rowcount;
		
		$bod = "Titulo $txtTitulo <br> <br> Descripcion: $fdesc <br> Quien envia: $fquien atentamente, ".$row21[1]. 
							"<br><a href=http://dace.mineco.gob.gt/CorreBeta1V2/mtinicia.php?docu=$fidcorrespondencia&mtcc=$fidempleado&quien=$row21[1]>Ver Correspondencia</a>";
		
			$mail = $mm;
			$mail->IsSMTP();
			$mail->Host = "me-s-mail";
			$mail->SMTPAuth = true;
			$mail->Username = "infocomex";
			$mail->Password = "cafta2006";

			$mail->From = $row21[0];
			$mail->FromName = $row21[1];
			$mail->AddAddress($row[0],$row[1]);
			$mail->WordWrap = 100;                                
			$mail->IsHTML(true);                                  
			$mail->Subject = "Usted tiene correspondencia";
			$mail->Body    = $bod;
			$mail->AltBody = "Usted tiene correspondencia";
				if(!$mail->Send())
				{
				   echo "Message could not be sent. <p>";
				   echo "<br> FromName = $row21[1]";
				   echo "<br> AddAddress($row[0],$row[1])";
				   echo "<br> Mailer Error: " . $mail->ErrorInfo;
				}
				else
				{
					echo "El mensaje ha sido enviado a $row[0],$row[1] <br>";
				}
		return true;
}

function envia($fccor,$fccorr){
//	header("Location: okTransfer.php?docu=$fccor&corrfinal=$fccorr");
	print "Correspondencia Enviada a todos los usuarios<br>";
	print "<a href=\"okTransfer.php?docu=$fccor&corrfinal=$fccorr\"> Continuar </a>";
}

?>

<?
//print "carpeta = $ccarpeta";
if (intval($ccarpeta) == 1)
	if ((intval($iddireccion) + intval($iddireccion1)+intval($iddireccion2)+intval($iddireccion3)) == 0)
		header("Location: documento.php");


$fechaentrega=substr($date9,6,4)."/".substr($date9,3,2)."/".substr($date9,0,2);
$horaentrega =substr($date9,12,5);

$usuario = $_SESSION['codigoUsuario'];
$usuario = $_SESSION[idempleado];	
$ssdir = $_SESSION['siddireccion'];	
//require('conexion.inc');
require("class.phpmailer.php");
$mail = new PHPMailer();
//$db = mssql_connect($SERVIDOR,$USUARIO,$PASSWORD);
//mssql_select_db($BASE_DATOS,$db);
		$carpeta = $ccarpeta;
		
		$corcrea = getVCorrelativoDireccion($select_1);
		
		if (intval($carpeta) == 3)		
		{
			$scorr = getCorrelativoDireccion($select_1);
			$sidcorre = setCorrespondencia("NULL","NULL",$scorr,$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,3,$corcrea,$fechaentrega,$horaentrega);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$select_2))
			{
			}
		}
		if (intval($select_2) > 0)		
		{
			print "<br> 1 <br>";
			$scorr = getCorrelativoDireccion($select_1);
			$sidcorre = setCorrespondencia($select_1,$select_2,$scorr,$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea,$fechaentrega,$horaentrega);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$select_2))
			{
			}
			if (SendMsg($mail,$sidcorre,$select_2,$txtDesc,$txtQuien))
			{
			}
			$ccor = $sidcorre;
		}		
		if (intval($select2_2) > 0)		
		{
			print "<br> 2 <br>";
			$scorr = getCorrelativoDireccion($select_21);
			$sidcorre = setCorrespondencia($select_21,$select2_2,$scorr,$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea,$fechaentrega,$horaentrega);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$select2_2))
			{
			}
			if (SendMsg($mail,$sidcorre,$select2_2,$txtDesc,$txtQuien))
			{
			}
		}		
		if (intval($select3_2) > 0)		
		{
			print "<br> 3 <br>";
			$scorr = getCorrelativoDireccion($select_31);
			$sidcorre = setCorrespondencia($select_31,$select3_2,$scorr,$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea,$fechaentrega,$horaentrega);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$select3_2))
			{
			}
			if (SendMsg($mail,$sidcorre,$select3_2,$txtDesc,$txtQuien))
			{
			}
		}		
		if (intval($select4_2) > 0)		
		{
			print "<br> 4 <br>";
			$scorr = getCorrelativoDireccion($select_41);
			$sidcorre = setCorrespondencia($select_41,$select4_2,$scorr,$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea,$fechaentrega,$horaentrega);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$select4_2))
			{
			}
			if (SendMsg($mail,$sidcorre,$select4_2,$txtDesc,$txtQuien))
			{
			}
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
		envia($ccor,$ccorr);
/*header("Location: okTransfer.php?docu=$ccor&corrfinal=$ccorr");
header("Location: okTransfer.php?docu=$ccor&corrfinal=$ccorr");
header("Location: okTransfer.php?docu=$ccor&corrfinal=$ccorr");*/
?>

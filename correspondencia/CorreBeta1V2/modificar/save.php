<?
	session_start();
?>
<?
function getCorrelativoDireccion($fdireccion){
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
		$SQL = "SELECT correlativo FROM direccion where iddireccion=$fdireccion";
		$result = mysql_query($SQL); 
		$row = mysql_fetch_row($result);
		$scorrelativo =  intval($row[0]);
		$SQL = "update direccion set correlativo=correlativo+1 where iddireccion=$fdireccion";
		$result = mysql_query($SQL); 
		print "si devolvio algo";
		return $scorrelativo;
}

function getVCorrelativoDireccion($fdireccion){
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
		$SQL = "SELECT correlativo,nombre FROM direccion where iddireccion=$fdireccion";
		$result = mysql_query($SQL); 
		$row = mysql_fetch_row($result);
		$scorrelativo = $row[1]."-".$row[0];
		$ssdir = $_SESSION['siddireccion'];	
		if (intval($ssdir) != intval($fdireccion))
		{
			$SQL = "update direccion set correlativo=correlativo+1 where iddireccion=$fdireccion";
			$result = mysql_query($SQL); 
		}	
		print "si devolvio algo";
		return $scorrelativo;
}

function setCorrespondencia($fdireccion,$fidempleado,$fcorrelativo,$fob1,$fob2,$fob3,$fob4,$fob5,$fob6,$fob7,$fob8,$fob9){
		$ffecha = date("y/m/d");
		$hhora = date("H:i:s");
		$usuario = $_SESSION[idempleado];	
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
		$SQL = "INSERT INTO correspondencia
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
							correlativoinicial
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
							'$fob9'
						)
				";
		print $SQL;		
		$result = mysql_query($SQL); 
		$SQL = "SELECT max(idcorrespondencia) FROM correspondencia where idempleadocrea=$usuario";
		$result = mysql_query($SQL); 
		$row = mysql_fetch_row($result);
		$scorrelativo =  intval($row[0]);
		return $scorrelativo;
}

function setAdjunto($fidcorrespondencia){
		$ffecha = date("y/m/d");
		$hhora = date("H:i:s");
		$usuario = $_SESSION[idempleado];	
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
		$SQL = "INSERT INTO correspondencia_adjunto(
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
		print $SQL;		
		$result = mysql_query($SQL); 
		return true;
}

function setSeguimiento($fidcorrespondencia,$fidempleado){
		$ffecha = date("y/m/d");
		$hhora = date("H:i:s");
		$usuario = $_SESSION[idempleado];	
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
		$SQL = "INSERT INTO correspondencia_seguimiento
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
		print $SQL;		
		$result = mysql_query($SQL); 
		return true;
}

function SendMsg($fidcorrespondencia,$fidempleado,$fdesc,$fquien){
		$ffecha = date("y/m/d");
		$hhora = date("H:i:s");
		$usuario = $_SESSION[idempleado];	
		require("../conexion.inc");
		require("class.phpmailer.php");
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
		$SQL = "SELECT email,concat(nombres,' ',apellidos) FROM empleados WHERE idempleado = $fidempleado ";
		$result = mysql_query($SQL); 
		$row = mysql_fetch_row($result);
		$SQL21 = "SELECT email,concat(nombres,' ',apellidos) FROM empleados WHERE idempleado = $usuario ";
		$result21 = mysql_query($SQL21); // ingreso de documento
		$row21 = mysql_fetch_row($result21);
		
		$bod = "Titulo $txtTitulo <br> <br> Descripcion: $fdesc <br> Quien envia: $fquien atentamente, ".$row21[1]. 
							"<br><a href=http://dace.mineco.gob.gt/CorreBeta1V2/mtinicia.php?docu=$fidcorrespondencia&mtcc=$fidempleado&quien=$row21[1]>Ver Correspondencia</a>";
		
			$mail = new PHPMailer();
			$mail->IsSMTP();
//			$mail->Host = "mineco.gob.gt";
			$mail->Host = "me-s-mail";
			$mail->SMTPAuth = true;
			$mail->Username = "infocomex";
			$mail->Password = "cafta2006";

			$mail->From = $row21[0];
			$mail->FromName = $row21[1];
			$mail->AddAddress($row[0],$row[1]);
			$mail->WordWrap = 100;                                 // set word wrap to 50 characters
			$mail->IsHTML(true);                                  // set email format to HTML
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
					echo "Message has been sent";
				}
		return true;
}

function envia($fccor,$fccorr){
	header("Location: okTransfer.php?docu=$fccor&corrfinal=$fccorr");
	print "ya envio";
}

?>

<?
//print "carpeta = $ccarpeta";
if (intval($ccarpeta) == 1)
	if ((intval($select2_2) + intval($select_2)+intval($select2_2)+intval($select3_2)+intval($select4_2)+intval($select5_2)) == 0)
		header("Location: documento.php");

$usuario = $_SESSION['codigoUsuario'];
$usuario = $_SESSION[idempleado];	
$ssdir = $_SESSION['siddireccion'];	
require('../conexion.inc');

$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
mysql_select_db($BASE_DATOS,$db);
		$carpeta = $ccarpeta;
		
		$corcrea = getVCorrelativoDireccion($ssdir);
			
		
		if (intval($carpeta) == 3)		
		{
			$scorr = getCorrelativoDireccion($select_1);
			$sidcorre = setCorrespondencia("NULL","NULL",$scorr,$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,3,$corcrea);
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
			$sidcorre = setCorrespondencia($select_1,$select_2,$scorr,$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$select_2))
			{
			}
			if (SendMsg($sidcorre,$select_2,$txtDesc,$txtQuien))
			{
			}
			$ccor = $sidcorre;
		}		
		if (intval($select2_2) > 0)		
		{
			print "<br> 2 <br>";
			$scorr = getCorrelativoDireccion($select_21);
			$sidcorre = setCorrespondencia($select_21,$select2_2,$scorr,$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$select2_2))
			{
			}
			if (SendMsg($sidcorre,$select2_2,$txtDesc,$txtQuien))
			{
			}
		}		
		if (intval($select3_2) > 0)		
		{
			print "<br> 3 <br>";
			$scorr = getCorrelativoDireccion($select_31);
			$sidcorre = setCorrespondencia($select_31,$select3_2,$scorr,$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$select3_2))
			{
			}
			if (SendMsg($sidcorre,$select3_2,$txtDesc,$txtQuien))
			{
			}
		}		
		if (intval($select4_2) > 0)		
		{
			print "<br> 4 <br>";
			$scorr = getCorrelativoDireccion($select_41);
			$sidcorre = setCorrespondencia($select_41,$select4_2,$scorr,$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$select4_2))
			{
			}
			if (SendMsg($sidcorre,$select4_2,$txtDesc,$txtQuien))
			{
			}
		}		
		if (intval($select5_2) > 0)		
		{
			print "<br> 5 <br>";
			$scorr = getCorrelativoDireccion($select_51);
			$sidcorre = setCorrespondencia($select_51,$select5_2,$scorr,$txtTitulo,$txtQuien,$txtDesc,$txtInsti,$txtRef,$radiobutton,$observacion,$carpeta,$corcrea);
			if (setAdjunto($sidcorre))
			{
			}
			if (setSeguimiento($sidcorre,$select5_2))
			{
			}
			if (SendMsg($sidcorre,$select5_2,$txtDesc,$txtQuien))
			{
			}
		}		
//		envia($ccor,$ccorr);
		header("Location: okTransfer.php?docu=$ccor&corrfinal=$ccorr");
?>

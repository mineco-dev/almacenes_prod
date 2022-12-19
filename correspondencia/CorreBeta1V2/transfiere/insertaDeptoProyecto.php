<? 
session_start();

$_SESSION['nivel']=2;
include('../../valida.php');

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
body {
	background-image: url(../images/fondo23.gif);
}
.Estilo2 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
	color: #FFFFFF;
}
.Estilo3 {
	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
<link href="../css/styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="100%"  border="0" cellpadding="0" cellspacing="0" bgcolor="#0066CC">
  <tr bgcolor="#000000">
    <td width="27%"><img src="../images/usuario.gif" width="16" height="16"> <span class="Estilo2"><? print $usuario;?></span></td>
    <td width="49%"><div align="center"><img src="../images/welcome.gif" width="16" height="16"> <span class="Estilo2">Bienveido al sistema </span></div></td>
    <td width="24%"><div align="right"><span class="Estilo2">Guatemala <? print date("d-M-Y");?> </span><img src="../images/login.gif" width="16" height="16"></div></td>
  </tr>
</table>

<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table15">
  <TBODY>
    <TR bgcolor="#000000">
      <TD height=15 colSpan=3 style="font-size: 10pt; font-family: verdana,arial"><div align="center" class="Estilo3">
        <table cellspacing=0 cellpadding=0 width="100%" border=0 id="table17">
          <tbody>
            <tr>
              <td style="font-size: 10pt; font-family: verdana,arial">&nbsp;</td>
              <td valign=bottom align=right style="font-size: 10pt; font-family: verdana,arial"><p align="justify"></td>
            </tr>
          </tbody>
        </table>
        Proyecto</div></TD>
    </TR>
    <TR>
      <TD width="14%" style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
      <TD width="72%" style="font-size: 10pt; font-family: verdana,arial"><TABLE borderColor=#000000 cellSpacing=0 cellPadding=40 width="100%" 
      border=2 id="table16">
          <TBODY>
            <TR>
              <TD width="100%" align="center" background="../images/fondoTablas.gif" bgColor=#ffffff style="font-size: 10pt; font-family: verdana,arial"><p style="margin-top: 0; margin-bottom: 0"><BR clear=all>
                  </p>
                  <?
/* aca hace la insercion de la informacion dependiendo de los resultados asi sera 
   el mensaje que se despliegue */

		
		include('../../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
//		include("../../conectarse.php");

   		//require ('../conexion.inc');
		//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mysql_select_db($BASE_DATOS,$db);

		$select_2 = $_POST['idasesor'];
		$fecha= date("Y-m-d");	
        $fEntrega= $cboAnioe ."-". $cboMese ."-". $cboDiae;
		$fAlarma1= $cboAnioal1 ."-". $cboMesal1 ."-". $cboDial1;
		$fAlarma2= $cboAnioal2 ."-". $cboMesal2 ."-". $cboDiaal2;				
		$hhora = date("H:i:s");
		
		$usuario = $_SESSION['codigoUsuario'];	
		$usuario = $_SESSION[idempleado];	
		
		$SQL ="INSERT INTO correspondencia_seguimiento
					(idcorrespondencia,idasesororigen,idasesordestino,fecha,descripcion,hora) 
				VALUES 
					($docu,$usuario,$SubActividades3,getdate(),'$txtDescripcion','$hhora')";
//	print "-$SQL-";

		$mtdocu= $docu;
		$result = mssql_query($SQL);
		
/**************** bitacora seguimiento en insercion del seguimitno*********************************************************************************************/
		$fecha01 = date("Y-m-d");
		 $hora01 = date("H:i:s");
		$SQL01 = "INSERT INTO bitaSeg(docu,usuario,fecha,hora,descr) VALUES ($_SESSION[correlativo],$usuario,getdate(),'$hora01',' inserta seguimiento ')";
		$result01 = mssql_query($SQL01); // ingreso de documento
		
	//	print "$SQL01 y $result01";
/****************************************************************************************************************/
		
		$fechaentrega=substr($date9,6,4)."/".substr($date9,3,2)."/".substr($date9,0,2);
		$horaentrega =substr($date9,12,5);
		
		$SQL1 = "UPDATE correspondencia SET 
				status = 0,idasesor = $usuario,idasesor2=$SubActividades3,fechaentrega='$fechaentrega',horaentrega='$horaentrega' 
					WHERE idcorrespondencia = $docu";
		$result1 = mssql_query($SQL1);						
			
			
			
/**************** bitacora seguimiento en ACTUALIZACION del seguimitno*********************************************************************************************/
		$fecha01 = date("Y-m-d");
		 $hora01 = date("H:i:s");
		$SQL01 = "INSERT INTO bitaSeg(docu,usuario,fecha,hora,descr) VALUES ($_SESSION[correlativo],$usuario,getdate(),'$hora01',' Actualiza seguimiento a estatus 2,carpet 1 y a salida con usuario $select_2')";
		$result01 = mssql_query($SQL01); // ingreso de documento
//		$row = mysql_fetch_row($result);
//		print "$SQL01 y $result01";
/****************************************************************************************************************/
			
			
			/**************************************************************/
			/*************************************************************************************************************/
		$SQL = "SELECT correo, nombre+' '+apellido FROM asesor WHERE idasesor = $SubActividades3 ";
		$result = mssql_query($SQL); // ingreso de documento
		$row = mssql_fetch_row($result);
/****************************************************************************************************************/
		$SQL21 = "SELECT correo, nombre+' '+apellido FROM asesor WHERE idasesor = $usuario ";
		$result21 = mssql_query($SQL21); // ingreso de documento
		$row21 = mssql_fetch_row($result21);
/****************************************************************************************************************/		

/**************graba el seguimiento real del sistema**************************************************************************************************/
		$fecha0 = date("Y-m-d");
		 $hora0 = date("H:i:s");
		$SQL210 = "INSERT INTO segDocu(de,a,fecha,hora,docu,idasesor) values ($usuario,$SubActividades3,getdate(),'$hora0',$_SESSION[correlativo],$usuario)";
		$result210 = mssql_query($SQL210); // ingreso de documento
//		$row210 = mysql_fetch_row($result210);
//		print "$SQL210 y $result210";
/****************************************************************************************************************/		

//			$pdocu="Le transfirieron una correspondencia<br>";
			/* 
					<br><a href=http://dace.mineco.gob.gt/CorreBeta1V2/mtinicia.php?docu=$mtdocu&mtcc=$select_2>
					Ver Correspondencia</a>";
*/

//			require("class.phpmailer.php");
			
			/*$mail = new PHPMailer();
			
			$mail->IsSMTP();                                      // set mailer to use SMTP
			
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
			$mail->Body    = $pdocu;
			$mail->AltBody = "Usted tiene correspondencia";
			
			if(!$mail->Send())
			{
			   echo "Message could not be sent. <p>";
			   echo "Mailer Error: " . $mail->ErrorInfo;
//			   exit;
			}
			
			echo "Message has been sent";*/
/***************************************************************************************************************/	

			
			
			
			//header("Location: ../center.php");
		
		cambiar_ventana("../center.php");

		
		
//		mysql_close($db);
		
		
?>
              <p>&nbsp;</p></TD>
            </TR>
          </TBODY>
      </TABLE></TD>
      <TD width="14%" style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
    </TR>
    <TR>
      <TD colSpan=3 style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
    </TR>
  </TBODY>
</TABLE>
<hr>
<p align="center" style="margin-top: 0; margin-bottom: 0"><b> </b></p>
</body>
</html>

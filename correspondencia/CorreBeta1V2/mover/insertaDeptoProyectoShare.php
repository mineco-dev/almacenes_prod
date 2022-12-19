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
      <TD height=15 colSpan=3 style="font-size: 10pt; font-family: verdana,arial"><div align="center" class="Estilo3">Correspondencia transferida </div></TD>
    </TR>
    <TR>
      <TD width="14%" style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
      <TD width="72%" style="font-size: 10pt; font-family: verdana,arial"><TABLE borderColor=#000000 cellSpacing=0 cellPadding=40 width="100%" 
      border=2 id="table16">
          <TBODY>
            <TR>
              <TD width="100%" align="center" background="../images/fondoTablas.gif" bgColor=#ffffff style="font-size: 10pt; font-family: verdana,arial"><TABLE cellSpacing=0 cellPadding=0 width="100%" border=0 id="table17">
                  <TBODY>
                    <TR>
                      <TD style="font-size: 10pt; font-family: verdana,arial">&nbsp;</TD>
                      <TD vAlign=bottom align=right style="font-size: 10pt; font-family: verdana,arial"><p align="justify"></TD>
                    </TR>
                  </TBODY>
                </TABLE>
                  <p style="margin-top: 0; margin-bottom: 0"><BR clear=all>
                  </p>
                  <?
/* aca hace la insercion de la informacion dependiendo de los resultados asi sera 
   el mensaje que se despliegue */

   		//require ('../conexion.inc');
		//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mysql_select_db($BASE_DATOS,$db);
		include('../../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
		include('../../conectarse.php');


		$fecha= date("Y-m-d");	
        $fEntrega= $cboAnioe ."-". $cboMese ."-". $cboDiae;
		$fAlarma1= $cboAnioal1 ."-". $cboMesal1 ."-". $cboDial1;
		$fAlarma2= $cboAnioal2 ."-". $cboMesal2 ."-". $cboDiaal2;				
//		session_start();
		$usuario = $_SESSION['codigoUsuario'];	
			$SQL1 = "UPDATE docemple SET status=$cboCarpeta where iddocemple=$idDoc";
			print $SQL1;
			$result1 = mssql_query($SQL1);						

			$SQL1 = "UPDATE correspondencia SET carpeta = $cboCarpeta WHERE idcorrespondencia = $docu";
			print $SQL1;
			$result1 = mssql_query($SQL1);						

//			header("Location: ../center.php");
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

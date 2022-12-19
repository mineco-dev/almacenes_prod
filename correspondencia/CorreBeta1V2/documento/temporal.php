<?
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	session_start();

	$_SESSION['folder'] = "correBeta1V2/documento/";
	$_SESSION['pagina'] = $page;

	include('../../security.php');
	print $_SESSION['iso_registro'];
?>
<style type="text/css">
<!--
.Estilo1 {font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
	color: #878EAA;
}
.Estilo3 {color: #FFFFFF;
	font-weight: bold;
}
.Estilo5 {color: #FFFFFF}
-->
</style>
<script language="javascript">
function transferir(form)
{
   form.action = "../transfiere/AsignaDeptos.php";
   return true;
}


function enviar(form)
{
   form.action = "uploadForm.php";
   return true;
}

function regresar(form)
{
   form.action = "../center.php";
   return true;
}

function enviar2(form)
{
   form.action = "saveLocal.php";
   return true;
}

function modificar(form)
{
}
</script>
<?
		session_start();
		$usuario = $_SESSION['codigoUsuario'];
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha))
		$SQL = "UPDATE seguimiento SET status = 1 WHERE docu = $docu";
			$result = mysql_query($SQL); // elimina informacion temporal
			$SQL = "SELECT docu,titulo,quien,insti,descr,ref,corrfinal,t.nombre,observacion FROM doc,tramite t WHERE t.idtramite=tramite and  docu = $docu";
			$result = mysql_query($SQL); // elimina informacion temporal
			$row = mysql_fetch_row($result);
?>
<link href="../style/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image:  url(../visualiza/Fondo%20de%20Fiesta.jpg);
}
.Estilo6 {
	color: #FF0000;
	font-weight: bold;
	font-size: 24px;
}
.Estilo7 {font-size: 16px}
.Estilo8 {
	color: #878EAA;
	font-weight: bold;
}
.combo {	font-family:Verdana;
	font-size:10px;
	border-color:#CCCCCC;
}
.punteado {	border-style:inset;
	border-color:#FFFFFF;
	background-color:#FFFFFF;
	font-family:Verdana;
	font-size:12px;
	text-align:center;
}
-->
</style>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <td><div align="center"><span class="Estilo7">Codigo del documento:</span> <span class="Estilo6"> <? print $row[6];?> </span> </div></td>
  </tr>
  <?
	 print "<tr><td>";
			//$SQL99 = "SELECT concat(e.nombres,' ',e.apellidos) FROM doc d, seguimiento s,empleados e WHERE e.idempleado=s.idempleado and d.docu=s.docu and s.aquien = $usuario and s.carpet=0 group by d.docu order by s.fecha desc";
/*			$SQL99 = "SELECT concat(e.nombres,' ',e.apellidos) FROM seguimiento s,empleados e WHERE e.idempleado=s.idempleado and s.docu = $docu";
			$result99 = mysql_query($SQL99); // elimina informacion temporal
			$row99 = mysql_fetch_row($result99);*/
			print "<div align='center'><span class='Estilo7'>Quien Envia:</span> <span class='Estilo6'> $quien </span> </div>";
		   if (strlen($dato)>0)
		   {
			print "<div align='center'><span class='Estilo7'>A quien transfiere:</span> <span class='Estilo6'> $dato </span> </div>";
			}
	print "</td></tr>";
	?>
</table>
<p>&nbsp;</p>
<table width="100%" border="1" cellspacing="0">
  <tr>
    <th align="center" valign="top" scope="col">Correspondencia a enviar </th>
    <th valign="top" scope="col">SEGUIMIENTO DEL DOCUMENTO </th>
  </tr>
  <tr>
    <th rowspan="2" align="center" valign="top" scope="col"><form name="form1" method="post" action="../center.php">
      <div align="left">
      <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="5">
        <tr bgcolor="#000000">
          <td width="23%" bgcolor="#0066FF"><div align="left"><span class="Estilo3">Correspondencia</span></div></td>
          <td width="77%" bgcolor="#0066FF"><div align="left"></div></td>
        </tr>
        <tr>
          <td><div align="left" class="Estilo1">
              <div align="left">
                <p>Titulo</p>
                </div>
          </div></td>
          <td><div align="left">
              <input name="txtTitulo" type="text" id="txtTitulo2" size="45" value="<? print $row[1]?>">
          </div></td>
        </tr>
        <tr>
          <td><span class="Estilo8">Referencia</span></td>
          <td><input name="txtRef" type="text" id="txtRef2" size="45" value="<? print $row[5]?>"></td>
        </tr>
        <tr bgcolor="#000000">
          <td bgcolor="#0066FF"><div align="left"><span class="Estilo3">Detalle del Documento </span></div></td>
          <td bgcolor="#0066FF"><div align="left" class="Estilo3"></div></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td background="../visualiza/Fondo%20de%20Fiesta.jpg"><div align="left"><strong>Quien Envia </strong></div></td>
          <td background="../visualiza/Fondo%20de%20Fiesta.jpg"><div align="left">
              <input name="txtQuien" type="text" id="txtQuien" size="45" value="<? print $row[2]?>">
          </div></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td background="../visualiza/Fondo%20de%20Fiesta.jpg"><div align="left"><strong>Institucion</strong></div></td>
          <td background="../visualiza/Fondo%20de%20Fiesta.jpg"><div align="left">
              <input name="txtInsti" type="text" id="txtInsti2" size="45" value="<? print $row[3]?>">
          </div></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td background="../visualiza/Fondo%20de%20Fiesta.jpg"><div align="left"><strong>Descripcion</strong></div></td>
          <td background="../visualiza/Fondo%20de%20Fiesta.jpg" bgcolor="#FFFFFF"><div align="left">
              <textarea name="txtDesc" cols="40" rows="7" id="textarea"> <? print $row[4]?></textarea>
          </div></td>
        </tr>
        <tr bgcolor="#FFFFFF" background="../visualiza/Fondo%20de%20Fiesta.jpg">
          <td colspan="2"><div align="left"></div>
            <div align="left"> Documentos Adjuntos a esta correspondencia
              <input name="docu2" type="hidden" id="docu22" value=<? echo $row[0]; ?> >
</div></td>
          </tr>
        <tr bgcolor="#FFFFFF">
          <td background="../visualiza/Fondo%20de%20Fiesta.jpg">&nbsp;</td>
          <td background="../visualiza/Fondo%20de%20Fiesta.jpg">&nbsp;</td>
        </tr>
      </table>
      <div align="center"> </div>
      <table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
        <tr>
          <td width="23%"><div align="center">
              <input type="submit" name="Submit" value="Transferir" onClick="transferir(this.form)">
          </div></td>
          <td width="26%"><div align="center">
</div></td>
          <td width="33%"><div align="center">
              <input type="submit" name="regresar" value="Regresar a pagina principal" onClick="regresar(this.form)">
          </div></td>
        </tr>
      </table>
    </form></th>



    <th height="323" valign="top" scope="col"> <form name="form2" method="post" action="../visualiza/inAcceso.php">
      <table width="100%" border="0" cellspacing="0">
  <tr>
    <th scope="col">Descripcion del seguimiento </th>
  </tr>
</table>
<div align="center">
  <table width="97%"  border="0" align="center" cellpadding="0" cellspacing="5">
    <tr bgcolor="#000000">
      <td width="8%" rowspan="2" bgcolor="#0066FF"><div align="left"><span class="Estilo5">Direcci&oacute;n</span></div></td>
      <td colspan="2" bgcolor="#6699FF"><div align="left">
          <p class="Estilo3 Estilo4">&nbsp;</p>
      </div></td>
    </tr>
    <tr bgcolor="#000000">
      <td colspan="2" bgcolor="#6699FF"><span class="Estilo3 Estilo4">A Quien va el documento </span></td>
    </tr>
    <tr>
      <td>dsd<span class="punteado"><span lang="es-gt"><span lang="es-gt">
        <?php generaSelect(); ?>
        <span lang="es-gt"><span lang="es-gt"><span lang="es-gt">
        <select class="combo" disabled="disabled" id="select17" name="select">
          <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
        </select>
        </span></span></span> </span></span></span></td>
      <td width="12%"><span class="punteado"><span lang="es-gt"><span lang="es-gt">
      <?php generaSelect(); ?>
      <span lang="es-gt">      </span> tttt </span> </span></span></td>
      <td><span lang="es-gt"><span lang="es-gt">
        <input name="docu23" type="hidden" id="docu24" value="<? print $row[0];?>">
        <span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt">
        <input name="docu" type="hidden" id="docu" value="<? print $row[0];?>">
      </span></span></span></span> </span></span></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td rowspan="4">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>dsd</td>
      <td width="2%"><span lang="es-gt"> <span lang="es-gt"> <span lang="es-gt"><span lang="es-gt"> </span></span> </span> </span></td>
    </tr>
  </table>
  <p>&nbsp;</p>
  <p>&nbsp;</p>
  </div>
      </form>
    </th>
  </tr>
  <tr>
    <th valign="top" scope="col"><table width="386" border="1">
      <tr><form name="form1" method="post" action="../center.php">
        <th scope="col"><input name="adjuntar" type="submit" id="adjuntar12" value="Adjuntar Archivo" onClick="enviar(this.form)"></th>


	  </form> </tr>
    </table></th>
  </tr>
</table>
<table width="97%"  border="0" align="center" cellpadding="0" cellspacing="5">
  <tr bgcolor="#000000">
    <td width="8%" rowspan="2" bgcolor="#0066FF"><div align="left"><span class="Estilo5">Direcci&oacute;n</span></div></td>
    <td colspan="2" bgcolor="#6699FF"><div align="left">
        <p class="Estilo3 Estilo4">&nbsp;</p>
    </div></td>
  </tr>
  <tr bgcolor="#000000">
    <td colspan="2" bgcolor="#6699FF"><span class="Estilo3 Estilo4">A Quien va el documento </span></td>
  </tr>
  <tr>
    <td><span class="Estilo4 Estilo5">Direcci&oacute;n</span></td>
    <td width="12%">
      <table border="0" width="600px" style="border-style:none;">
        <tr>
          <td width="200" bgcolor="#3399FF" class="punteado" id="fila_1"><span lang="es-gt">
            <?php generaSelect(); ?>
          </span></td>
          <td id="fila_2" width="200" class="punteado"> <span lang="es-gt">
          <span lang="es-gt">
          <select class="combo" disabled="disabled" id="select9" name="select_2">
            <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
          </select>
          </span> </span></td>
        </tr>
    </table></td>
    <td><span lang="es-gt"><span lang="es-gt">
      <input name="docu22" type="hidden" id="docu23" value="<? print $row[0];?>">
      <span lang="es-gt"><span lang="es-gt"><span lang="es-gt"><span lang="es-gt">
      <input name="docu3" type="hidden" id="docu3" value="<? print $row[0];?>">
    </span></span></span></span> </span></span></td>
  </tr>
  <tr>
    <td><span class="Estilo4 Estilo5">CC1</span></td>
    <td rowspan="4">
      <table border="0" width="600px" style="border-style:none;">
        <tr>
          <td width="200" bgcolor="#3399FF" class="punteado" id="fila_21"><span lang="es-gt">
            <?php generaSelect2(); ?>
          </span></td>
          <td id="fila_22" width="200" class="punteado"> <span lang="es-gt">
            <select class="combo" disabled="disabled" id="select2" name="select_22">
              <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
            </select>
          </span></td>
        </tr>
      </table>
      <table border="0" width="600px" style="border-style:none;">
        <tr>
          <td width="200" bgcolor="#3399FF" class="punteado" id="fila_31"><span lang="es-gt">
            <?php generaSelect3(); ?>
          </span></td>
          <td id="fila_32" width="200" class="punteado"> <span lang="es-gt">
            <select class="combo" disabled="disabled" id="select3" name="select_32">
              <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
            </select>
          </span></td>
        </tr>
      </table>
      <table border="0" width="600px" style="border-style:none;">
        <tr>
          <td width="200" bgcolor="#3399FF" class="punteado" id="fila_41"><span lang="es-gt">
            <?php generaSelect4(); ?>
          </span></td>
          <td id="fila_42" width="200" class="punteado"> <span lang="es-gt">
            <select class="combo" disabled="disabled" id="select4" name="select_42">
              <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
            </select>
          </span></td>
        </tr>
      </table>
      <div align="left">
        <table border="0" width="600px" style="border-style:none;">
          <tr>
            <td width="200" bgcolor="#3399FF" class="punteado" id="fila_51"><span lang="es-gt">
              <?php generaSelect5(); ?>
            </span></td>
            <td id="fila_52" width="200" class="punteado"> <span lang="es-gt">
              <select class="combo" disabled="disabled" id="select5" name="select_52">
                <option id="valor_defecto" value="0">Selecciona opci&oacute;n...</option>
              </select>
            </span></td>
          </tr>
        </table>
        <span lang="es-gt"><span lang="es-gt"></span></span></div></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="Estilo4 Estilo5">CC2</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span class="Estilo4 Estilo5">CC3</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><div align="left" class="Estilo4 Estilo5">CC4</div></td>
    <td width="2%"><span lang="es-gt"> <span lang="es-gt"> <span lang="es-gt"><span lang="es-gt"> </span></span> </span> </span></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
  <table width="98%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td colspan="2">&nbsp;</td>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><input name="radiobutton" type="radio" value="1">
      Para su conocimiento </td>
      <td><input name="radiobutton" type="radio" value="5">
      Preparar respuesta /Hacer nota </td>
      <td><input name="radiobutton" type="radio" value="9">
      Desig: Funcionario /s </td>
    </tr>
    <tr>
      <td colspan="2"><input name="radiobutton" type="radio" value="2">
      Emitir dict&aacute;men /opini&oacute;n </td>
      <td><input name="radiobutton" type="radio" value="6">
      Realizar consulta </td>
      <td><input name="radiobutton" type="radio" value="10">
      Asistir / Participar </td>
    </tr>
    <tr>
      <td colspan="2"><input name="radiobutton" type="radio" value="3">
      Rendir informe / Resultados </td>
      <td><input name="radiobutton" type="radio" value="7">
      Convocar / Dar cita </td>
      <td><input name="radiobutton" type="radio" value="11">
      Organizar Evento </td>
    </tr>
    <tr>
      <td colspan="2"><input name="radiobutton" type="radio" value="4">
      Preparar s&iacute;ntesis / Res&uacute;men </td>
      <td><input name="radiobutton" type="radio" value="8">
      Atender audiencia / Solicitante </td>
      <td><input name="radiobutton" type="radio" value="12">
      Investigar</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="radiobutton" type="radio" value="13">
      Distribuir</td>
    </tr>
    <tr align="left" valign="top">
      <td colspan="4">Asunto / Observaciones:
      <font face="Arial, Helvetica, sans-serif">
      <textarea name="observacion" cols="40" rows="3" id="observacion"></textarea>
</font></td>
    </tr>
    <tr>
      <td colspan="4">&nbsp;</td>
    </tr>
    <tr>
      <td><div align="center">Secretar&iacute;a      </div></td>
      <td>Llamar
      <input name="radiobutton2" type="radio" value="14"></td>
      <td>Archivar
      <input name="radiobutton2" type="radio" value="15"></td>
      <td>Agendar
      <input name="radiobutton2" type="radio" value="16"></td>
    </tr>
    <tr>
      <td colspan="2"><div align="center"></div></td>
      <td colspan="2"><div align="center">
</div></td>
    </tr>
  </table>
  <table width="473" height="31" border="1" align="center">
    <tr>
      <th width="193" scope="col"><input type="submit" name="Submit2" value="Enviar"></th>
      <th width="264" scope="col"><input type="submit" name="Submit3" value="Enviar a todos" onClick="enviarAll(this.form)"></th>
    </tr>
  </table>

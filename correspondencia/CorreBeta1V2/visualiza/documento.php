<?
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	session_start();

$_SESSION['nivel']=2;
include('../../valida.php');

	$_SESSION['folder'] = "correBeta1V2/visualiza/";
	$_SESSION['pagina'] = $page;

/*	include('../../security.php');
	print $_SESSION['iso_registro'];*/
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
function modificar(form)
{
   form.action = "modifica.php";
   return true;
}

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

</script>
<?
//		session_start();

include('../../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
//include('../../conectarse.php');

/*		$usuario = $_SESSION['codigoUsuario'];
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);*/
//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha))
		$SQL = "UPDATE correspondencia SET status = 1 WHERE idcorrespondencia = $docu";
		$result = mssql_query($SQL); // elimina informacion temporal
		/*$SQL = "SELECT
					docu,
					titulo,
					quien,
					insti,
					descr,
					ref,
					corrfinal,
					t.nombre,
					observacion
				FROM doc,tramite t WHERE t.idtramite=tramite and  docu = $docu";
		$SQL = "SELECT
					idcorrespondencia,
					titulo,
					quien,
					insti,
					descr,
					ref,
					correlativo,
					t.nombre,
					observacion,
					if(year(fechaentrega)=0,
						'',
						concat('Para ser entregado el ',date_format(fechaentrega,'%d/%m/%Y'),' a las ',horaentrega)
					  ) fechahoraentrega 
				FROM correspondencia,tramite t WHERE t.idtramite=tramite and  idcorrespondencia = $docu";*/
				$SQL = "SELECT
					idcorrespondencia,
					titulo,
					quien,
					insti,
					descr,
					ref,
					correlativo,
					t.nombre,
					observacion,
					fechaentrega,
					horaentrega
					 /*case when fechaentrega = 0 
						'','Para ser entregado el ',fechaentrega,' a las ',horaentrega)
					  ) fechahoraentrega 
					 end*/
				FROM correspondencia,tramite t WHERE t.idtramite=tramite and  idcorrespondencia = $docu";
//				print $SQL;
		$result = mssql_query($SQL); // elimina informacion temporal
		$row = mssql_fetch_row($result);
		$quien = $row[2];
		$fechahoraentrega = $row[9];
		
?>
<link href="../style/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
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
.Estilo18 {font-size: 10px;
	font-weight: bold;
}
.Estilo21 {
	color: #660033;
	font-size: 10px;
}
-->
</style>

<table border="0" width="100%">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right" class="Estilo21">
		<a href="../center.php"><img src="tareas.gif" width="16" height="16" border="0"><span class="Estilo21">Regresar al Menu</span></a>
		</td>
	</tr>
</table>


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

<table width="100%" border="1" cellspacing="0">
  <tr>
    <th align="center" valign="top" scope="col">CORRESPONDENCIA RECIBIDA </th>
    <th valign="top" scope="col">SEGUIMIENTO DEL DOCUMENTO </th>
  </tr>
  <tr>
    <th rowspan="2" align="center" valign="top" scope="col">
	<form name="form1" method="post" action="../center.php">

      <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="5">
        <tr bgcolor="#FFFFFF">
          <td >Nota de Tr&aacute;mite</td>
          <td ><input  disabled name="txtTitulo2" type="text" id="txtTitulo" size="45" value="<? print $row[7]?>"></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td >Observaci&oacute;n</td>
          <td ><textarea name="textarea"  disabled cols="50" rows="3" id="textarea2"> <? print $row[8]?></textarea></td>
        </tr>
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
          <td bgcolor="#0066FF"><div align="left"><span class="Estilo3">A Quien va el documento </span></div></td>
          <td bgcolor="#0066FF"><div align="left"></div></td>
        </tr>
        <tr>
          <td><div align="left">Nombre</div></td>
          <td><div align="left"><span lang="es-gt">
              <input name="iddocumento" type="hidden" id="iddocumento" value="<? print $row[0];?>">
          </span></div></td>
        </tr>
        <tr bgcolor="#000000">
          <td bgcolor="#0066FF"><div align="left"><span class="Estilo3">Detalle del Documento </span></div></td>
          <td bgcolor="#0066FF"><div align="left" class="Estilo3"></div></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td ><div align="left"><strong>Quien Envia </strong></div></td>
          <td ><div align="left">
              <input name="txtQuien" type="text" id="txtQuien" size="45" value="<? print $row[2]?>">
          </div></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td ><div align="left"><strong>Institucion</strong></div></td>
          <td ><div align="left">
              <input name="txtInsti" type="text" id="txtInsti2" size="45" value="<? print $row[3]?>">
          </div></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td ><div align="left"><strong>Descripcion</strong></div></td>
          <td  bgcolor="#FFFFFF"><div align="left">
              <textarea name="txtDesc" cols="40" rows="7" id="textarea"><? print $row[4]?></textarea>
          </div></td>
        </tr>
        <tr bgcolor="#FFFFFF">
          <td colspan="2"><div align="left"></div>
            <div align="left"> Documentos Adjuntos a esta correspondencia
              <input name="docu" type="hidden" id="docu" value=<? echo "$docu"; ?> >
</div></td>
          </tr>
        <tr bgcolor="#FFFFFF">
          <td >&nbsp;</td>
          <td >&nbsp;</td>
        </tr>
      </table>
      <div align="center"> </div>
      <table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
        <tr>
          <td width="23%"><div align="center">
              <input type="submit" name="Submit" value="Transferir" onClick="transferir(this.form)">
          </div></td>
          <td width="26%"><div align="center">
            <input type="submit" name="subm" value="Modificar" onClick="modificar(this.form)">
</div></td>
          <td width="33%"><div align="center">
              <input type="submit" name="regresar" value="Regresar a pagina principal" onClick="regresar(this.form)">
          </div></td>
        </tr>
      </table>
    </form></th>



    <th height="323" valign="top" scope="col"> <form name="form2" method="post" action="inAcceso.php">
      <table width="100%" border="0" cellspacing="0">
  <tr>
    <th scope="col">Descripcion del seguimiento </th>
  </tr>
</table>
<div align="center">
  <TABLE width="480"
                        border=0 align=center cellPadding=0 cellSpacing=10 id="table18">
          <TBODY>
            <TR>
              <TD width="74"><span lang="es-gt">Seguimiento</span></TD>
              <TD>&nbsp;</TD>
              <TD><span lang="es-gt"> <span lang="es-gt">
                <textarea name="txtDescripcion" cols="45" rows="5"></textarea>
              </span></span></TD>
            </TR>
            <TR>
              <TD width="74"></TD>
            </TR>
          </TBODY>
        </TABLE>
  <input name="docu" type="hidden" id="docu" value=<? echo $docu; ?> >
  <input type="submit" name="Submit2" value="Insertar Seguimiento">
      </div>
      </form>
      <table width="100%" border="0" cellspacing="0">
        <tr>
          <th bgcolor="#0066FF" scope="col"><span class="Estilo5">Archivos Adjuntos </span></th>
        </tr>
      </table>
      <table width="100%" border="1" cellpadding="0" cellspacing="0">
        <tr bgcolor="#000000">

          <td width="171" bgcolor="#0066FF"><div align="center"><span class="Estilo1 Estilo5">Documento</span></div></td>
          <td width="171" bgcolor="#0066FF"><div align="center"><span class="Estilo1 Estilo5">Descripci&oacute;n</span></div></td>
        </tr>
		<?
		 	//$SQL12 = "SELECT da,nombre,descripcion,path FROM doc_adj WHERE   idcorrespondencia = $docu";
		 	$SQL12 = "SELECT idcorrespondencia_adjunto,nombre,descripcion,path FROM correspondencia_adjunto WHERE idcorrespondencia = $docu";
			$result = mssql_query($SQL12); // elimina informacion temporal
			while ($row1 = mssql_fetch_row($result))
			{
				 print " <tr>";
//		        print " <td>$row1[0]</td>";
		        //print " <td><a href=../documento/upload/$row1[3] target='_blank' >$row1[1]</a></td>";
			    	print " <td><a href=../../upload/$row1[3] target='_blank' >$row1[1]</a></td>";
		        print " <td>$row1[2]</td>";
		      //  print " <td>Eliminar</td>";
		      print " </tr>";
			}
		?>
      </table></th>
  </tr>
  <tr>
    <th valign="top" scope="col"><table width="386" border="1">
      <tr><form name="form1" method="post" action="../center.php">
        <th scope="col"><input name="docu" type="hidden" id="docu" value=<? echo $docu; ?> >
        <input name="adjuntar" type="submit" id="adjuntar12" value="Adjuntar Archivo" onClick="enviar(this.form)"></th>


	  </form> </tr>
    </table></th>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0">
  <tr>
    <th bgcolor="#0066FF" scope="col"><span class="Estilo5">Detalle de Seguimiento </span></th>
  </tr>
</table>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
  <tr bgcolor="#000000">

    <td width="171" bgcolor="#0066FF"><div align="center"><span class="Estilo1 Estilo5">Usuario</span></div></td>
    <td width="171" bgcolor="#0066FF"><div align="center"><span class="Estilo1 Estilo5">Descripci&oacute;n</span></div></td>
    <td width="171" bgcolor="#0066FF"><div align="center"><span class="Estilo1 Estilo5">Fecha</span></div></td>
  </tr>
  <?php

//				   $SQL = "select d.dd,e.user,d.descr,concat(right(d.fecha,2),'/',month(d.fecha),'/',year(d.fecha)) FROM detalle_documento d,empleados e WHERE d.idempleado = e.idempleado and d.docu=$docu ";
				   $_SESSION['correlativo']=$row[6];
							$SQL = "select d.dd, e.usuario, d.descr, d.fecha
							FROM detalle_documento d, asesor e 
							WHERE d.idempleado = e.idasesor and d.docu=".$row[6];//$_SESSION['correlativo'];
				  // print $SQL;
				  $result = mssql_query($SQL);

					while ($row23 = mssql_fetch_row($result))
					{
		                   echo " <tr>";
                      //echo " <td>$row23[0]</td>";
                      echo " <td>$row23[1]</td>";
					  echo " <td>$row23[2]</td>";
					  echo " <td>$row23[3]</td>";


                    echo " </tr>";
					}
		        echo " <tr bgcolor=#0066FF><td>.</td><td>.</td><td>.</td>";
				echo " <tr>";
/*				$SQL = "select
							s.docu,
							e.user,
							s.descr,
							concat(right(s.fecha,2),'/',month(s.fecha),'/',year(s.fecha))
							FROM seguimiento s,empleados e WHERE s.idempleado=e.idempleado and s.docu=$docu ";
				$SQL = "select
							s.idcorrespondencia,
							e.nombres,
							s.descripcion,
							concat(right(s.fecha,2),'/',month(s.fecha),'/',year(s.fecha),' - ',s.hora)
						FROM correspondencia_seguimiento s,empleados e
						WHERE s.idempleadoorigen=e.idempleado and
							  s.idcorrespondencia=$docu ";*/
				$SQL = "select
							s.idcorrespondencia,
							e.nombre,
							s.descripcion,
							s.fecha
						FROM correspondencia_seguimiento s, asesor e
						WHERE s.idasesororigen=e.idasesor and
							  s.idcorrespondencia=$docu ";

//				  print $SQL;
				  $result = mssql_query($SQL);

					while ($row23 = mssql_fetch_row($result))
					{
		                   echo " <tr>";
                      //echo " <td>$row23[0]</td>";
                      echo " <td>$row23[1]</td>";
					  echo " <td>$row23[2]</td>";
					  echo " <td>$row23[3]</td>";


                    echo " </tr>";
					}
//					mssql_close($db);
?>

</table>
<table width="525" border="1">
  <tr>
    <th scope="col">
	<? 
		print $fechahoraentrega;
	?>
	</th>
  </tr>
</table>
<p>&nbsp;</p>

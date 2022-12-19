<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo1 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
	font-size: 10px;
	color: #878EAA;
}
.Estilo3 {	color: #FFFFFF;
	font-weight: bold;
}
-->
</style>
<script language="javascript">
function enviar(form)
{
   form.action = "uploadForm.php";
   return true;
}

function enviar2(form)
{
   form.action = "saveLocal.php";
   return true;
}

function enviarAll(form)
{
 form.action = "saveAll.php";
 return true;
}
</script>
<link href="../style/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
.Estilo4 {font-size: 12px}
.Estilo5 {
	color: #0033CC;
	font-weight: bold;
}
.Estilo6 {font-size: 12px; color: #0033CC; }
.Estilo7 {color: #0033CC}
body,td,th {
	font-size: 12px;
	color: #0066FF;
}
.Estilo8 {
	color: #FFFFFF;
	font-size: 18px;
}
-->
</style></head>
<?
		session_start();
		$usuario = $_SESSION['codigoUsuario'];
		require ('../conexion.inc');
		$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		mysql_select_db($BASE_DATOS,$db);
//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha)) 
			$SQL = "SELECT docu,titulo,quien,insti,descr,ref FROM tmp_documento WHERE empleado = $usuario";
			$result = mysql_query($SQL); // elimina informacion temporal
			$row = mysql_fetch_row($result);
?>
<body>
<p>&nbsp;</p>
<form name="form1" method="post" action="save.php">
  <div align="left">
    <table width="100%"  border="0" align="center" cellpadding="0" cellspacing="5">
      <tr bgcolor="#000000">
        <td bgcolor="#0033FF">&nbsp;</td>
        <td colspan="3" bgcolor="#0033FF"><div align="left"><span class="Estilo8">  CORRESPONDENCIA NUEVA </span></div></td>
      </tr>
      <tr bgcolor="#000000">
        <td width="22%" bgcolor="#0033FF"><div align="left"><span class="Estilo3 Estilo4">Correspondencia</span></div></td>
        <td colspan="3" bgcolor="#0033FF"><div align="left"></div></td>
      </tr>
      <tr>
        <td><div align="left" class="Estilo1">
            <div align="left" class="Estilo6">Titulo</div>
        </div></td>
        <td colspan="3"><div align="left">
            <input name="txtTitulo" type="text" id="txtTitulo" size="45" value="<? print $row[1]?>">
        </div></td>
      </tr>
      <tr bgcolor="#000000">
        <td bgcolor="#0033FF"><div align="left"><span class="Estilo3 Estilo4">A Quien va el documento </span></div></td>
        <td colspan="3" bgcolor="#6699FF"><div align="left"></div></td>
      </tr>
      <tr>
        <td><div align="left" class="Estilo4 Estilo5">Direcci&oacute;n</div></td>
        <td width="15%"><div align="left"><span lang="es-gt">
            <select name="cboDireccion" size="1" id="cboDirecion">
              <?
			  
					$SQL = "select aquien from tmp_seguimiento where iddirecion = $usuario and docu = $row[0]";
					$result = mysql_query($SQL);
					$segui = mysql_fetch_row($result); // obtiene a quien le va el seguimiento
					$SQL = "select * from direccion where habilitado = 'y' order by nombres";
					$result = mysql_query($SQL);
						while ($row23 = mysql_fetch_row($result))
						{
						   if ($segui[0]==$row23[0])
						   {
						   print "<option value='$row23[0]' selected>$row23[1]</option>";
						   }
						   else
						   {
						   print "<option value='$row23[0]' >$row23[1]</option>";
						   }
							
						}		
			?>
            </select>
            <input name="docu" type="hidden" id="docu" value="<? print $row[0]?>">
</span></div></td>
        <td width="17%"><span class="Estilo4 Estilo5">Nombre de la Persona </span></td>
        <td width="46%"><span lang="es-gt">
           <select name="cboEmpleado" size="1" id="cboEmpleado">
            <?
			  
					$SQL = "select aquien from tmp_seguimiento where idempleado = $usuario and docu = $row[0]";
					$result = mysql_query($SQL);
					$segui = mysql_fetch_row($result); // obtiene a quien le va el seguimiento
					$SQL = "select * from empleados where habilitado = 'y' order by nombres";
					$result = mysql_query($SQL);
						while ($row23 = mysql_fetch_row($result))
						{
						   if ($segui[0]==$row23[0])
						   {
						   print "<option value='$row23[0]' selected>$row23[1]</option>";
						   }
						   else
						   {
						   print "<option value='$row23[0]' >$row23[1]</option>";
						   }
							
						}		
			?>
          </select>
          <span lang="es-gt">
          <input name="docu2" type="hidden" id="docu2" value="<? print $row[0]?>">
        </span>        </span></td>
      </tr>
      <tr bgcolor="#000000">
        <td bgcolor="#0033FF"><div align="left"><span class="Estilo3 Estilo4">Detalle del Documento </span></div></td>
        <td colspan="3" bgcolor="#0099FF"><div align="left" class="Estilo3"></div></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td bgcolor="#FFFFFF"><div align="left" class="Estilo4 Estilo7"><strong>Quien Envia </strong></div></td>
        <td colspan="3"><div align="left">
            <input name="txtQuien" type="text" id="txtMonto" size="45" value="<? print $row[2]?>">
        </div></td>
      </tr>
      <tr >
        <td ><div align="left" class="Estilo6"><strong>Institucion</strong></div></td>
        <td colspan="3" ><div align="left">
            <input name="txtInsti" type="text" id="txtInsti" size="45" value="<? print $row[3]?>">
        </div></td>
      </tr>
      <tr>
        <td ><div align="left" class="Estilo6"><strong>Descripcion</strong></div></td>
        <td colspan="3" ><div align="left">
            <textarea name="txtDesc" cols="45" rows="7" id="txtDesc"> <? print $row[4]?></textarea>
        </div></td>
      </tr>
      <tr >
        <td><div align="left" class="Estilo6"><strong>Referencia</strong></div></td>
        <td colspan="3"><div align="left">
            <input name="txtRef" type="text" id="txtRef" size="45" value="<? print $row[5]?>">
        </div></td>
      </tr>
    </table>
    <table width="100%"  border="1">
      <tr>
        <td bgcolor="#0066FF"><div align="center" class="Estilo3">Adjuntar Archivos </div></td>
      </tr>
    </table>
    <table width="100%"  border="1">
      <tr bgcolor="#333333">
       
        <td width="42%" bgcolor="#0066FF"><div align="center"><span class="Estilo3">Documento</span></div></td>
        <td width="31%" bgcolor="#0066FF"><div align="center" class="Estilo3">
          <div align="center">Descripci&oacute;n</div>
        </div></td>
        <td width="12%" bgcolor="#0066FF"><div align="center" class="Estilo3">
          <div align="center">Acci&oacute;n</div>
        </div></td>
      </tr>
	  <?
	 		
//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha)) 
			$SQL = "SELECT da,nombre,descripcion,path,da FROM tmp_doc_adj WHERE   docu = $row[0]";
			
			$result = mysql_query($SQL); // elimina informacion temporal
			while ($row1 = mysql_fetch_row($result))
			{
			
				 print " <tr>";
//		        print " <td>$row1[0]</td>";
		        print " <td><a href=upload/$row1[3] target='_blank' >$row1[1]</a></td>";
		        print " <td>$row1[2]</td>";
		        print " <td><a href='eliminaDoc.php?da=$row1[4]&docu=$row[0]&nombreDoc=$row1[1] '>Eliminar</a></td>";
		      print " </tr>";
			} 

	  mysql_close($db);
	  ?>
    
    </table>
    <p>&nbsp;</p>
  </div>
  <table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td><div align="center">
        <input type="submit" name="Submit" value="Enviar">
      </div></td>
      <td><div align="center">
        <input name="cboAlmacenar" type="submit" id="cboAlmacenar" value="Almacenar" onClick="enviar2(this.form)">
      </div></td>
      <td><div align="center">
        <input type="submit" name="Submit" value="Enviar a todos" onClick="enviarAll(this.form)">
      </div></td>
      <td><div align="center">
        <input name="adjuntar" type="submit" id="adjuntar" value="Adjuntar Archivo" onClick="enviar(this.form)">
      </div></td>
    </tr>
  </table>
  <p align="center">&nbsp;</p>
</form>
<p>&nbsp;</p>
</body>
</html>

<?
session_start();


$_SESSION['nivel']=2;
include('../../valida.php');

 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	

	$_SESSION['folder'] = "correBeta1V2/buscar/";
	$_SESSION['pagina'] = $page;

	//include('../../security.php');
//	print $_SESSION['iso_registro'];
?>
<style type="text/css">
<!--
.Estilo5 {color: #FFFFFF}
-->
</style>
<script language="javascript">

function dato(form)
{
if (form.cboCriterio==3)
{
  form.cboEmpleado.disabled;
 }
 return;
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

function modificar(form)
{

}
function enviar3(form)
{
   form.action = "reporte.php";

}
function enviar4(form)
{
   form.action = "reporte.php?rangofecha=1";

}

function rango(form)
{
   form.action = "reporte.php";

}

</script>
<?
		
		$usuario = $_SESSION['codigoUsuario'];
		
		include('../../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
		//include('../../conectarse.php');
		//require ('../conexion.inc');
		//$db = mysql_connect($SERVIDOR,$USUARIO,$PASSWORD);
		//mysql_select_db($BASE_DATOS,$db);

//		concat(right(q.fecha,2),'/',month(q.fecha),'/',year(q.fecha))
		/*$SQL = "UPDATE seguimiento SET status = 1 WHERE docu = $docu";
			print $sql;
			$result = mssql_query($SQL); // elimina informacion temporal
			$SQL = "SELECT docu,titulo,quien,insti,descr,ref FROM doc WHERE docu = $docu";
			$result = mssql_query($SQL); // elimina informacion temporal
			$row = mssql_fetch_row($result);
print $sql;*/
?>
<link href="../style/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.Estilo8 {font-size: 10px; color: #003399; font-family: Verdana;}
.Estilo9 {font-family: Arial, Helvetica, sans-serif; color: #0066FF; font-size: 10px; }
.Estilo18 {font-size: 10px;
	font-weight: bold;
}
.Estilo21 {	color: #660033;
	font-size: 10px;
}
-->
</style>
<table width="100%" class="Estilo21">
	<td align="left" bgcolor="#990000" width="15%" class="Estilo21" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
	</td>
	<td align="right">
		<p align="right"><span class="Estilo18"><a href="../center.php"><span class="Estilo21"><-- Regresar al Menu</span></a></span></p>
	</td>
</table>

<table width="100%" border="0" cellspacing="0">
  <tr>
    <th bgcolor="#0066FF" scope="col"><span class="Estilo5">Busqueda de Documento </span></th>
  </tr>
  <tr>
    <th scope="col"><form name="form1" method="post" action="creaCriterio.php">
      <p>&nbsp;</p>
      <table width="200" border="0" cellspacing="0">
        <tr>
          <td>Busqueda</td>
          <td><input name="txtCriterio" type="text" id="txtCriterio"></td>
        </tr>
        <tr>
          <td>Criterio</td>
          <td><select name="cboCriterio" id="cboCriterio">
            <option value="1">Codigo</option>
            <option value="2">Fecha</option>
            <option value="3">Titulo</option>
            <option value="4">Quien Envia</option>
            <option value="5">Quien lo Tiene</option>
          </select></td>
        </tr>
        <tr>
          <td>Empleado</td>
          <td><select name="cboEmpleado" id="cboEmpleado" >
          <?
		    $SQLE = "SELECT idasesor,nombre+' '+apellido from asesor where habilitado <> 'n' and len(nombre+apellido) > 0 order by nombre";
			$resultE = mssql_query($SQLE); // elimina informacion temporal

			while ($rowE = mssql_fetch_row($resultE))
			{
				print "<option value=$rowE[0]> $rowE[1] </option>";
			}
		  ?>

          </select></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><p>&nbsp;</p>            </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><input type="submit" name="Submit" value="Enviar"></td>
        </tr>
      </table>
      <table width="314" border="0">
        <tr>
          <th colspan="4" class="Estilo8" scope="col">Reporte por fecha</th>
          </tr>
        <tr>
          <th width="37" valign="top" scope="col"><div a  gn="left">
              <select name="dia1" id="dia1">
                <?
			$dia = date ("d");
			$dd=1;
			while ($dd <= 31)
			{

				print "<option value=$dd "; if ($dd==$dia) print "selected" ; print ">$dd</option>";
				$dd= $dd+1;
				}
			?>
              </select>
          </div></th>
          <th width="37" valign="top" scope="col"><div align="left">
              <select name="mes1" id="mes1">
                <?
		  $mes= date("n");

			print "<option value=01 "; if (1==$mes) print "selected" ; print ">Enero</option>";
			print "<option value=02 "; if (2==$mes) print "selected" ; print ">Febrero</option>";
			print "<option value=03 "; if (3==$mes) print "selected" ; print ">Marzo</option>";
			print "<option value=04 "; if (4==$mes) print "selected" ; print ">Abri</option>";
			print "<option value=05 "; if (5==$mes) print "selected" ; print ">Mayo</option>";
			print "<option value=06 "; if (6==$mes) print "selected" ; print ">Junio</option>";
			print "<option value=07 "; if (7==$mes) print "selected" ; print ">Julio</option>";
			print "<option value=08 "; if (8==$mes) print "selected" ; print ">Agosto</option>";
			print "<option value=09 "; if (9==$mes) print "selected" ; print ">Septiembre</option>";
			print "<option value=10 "; if (10==$mes) print "selected" ; print ">Octubre</option>";
			print "<option value=11 "; if (11==$mes) print "selected" ; print ">Noviembre</option>";
			print "<option value=12 "; if (12==$mes) print "selected" ; print ">Diciembre</option>";


		?>
              </select>
          </div></th>
          <th width="37" valign="top" scope="col"><div align="left">
              <select name="ano1" id="select3">
                <?
		  $ano=date("Y");
		  $ano2= 2006;
		  while ($ano2 <= $ano+2)
		  {
			if ($ano2 == $ano)
				{
				print "<option selected value=$ano2>$ano2</option>";
				}
			else
			{
				print "<option value=$ano2>$ano2</option>";
			}
		$ano2 = $ano2 +1;
			}
			?>
              </select>
          </div></th>
          <th width="185" scope="col"><span class="Estilo9">
            <input name="reporte" type="submit" id="Enviar" value="Reporte" onClick="enviar3(this.form)">
          </span></th>
        </tr>
        <tr>
          <th colspan="4" valign="top" scope="col"><span class="Estilo8">Reporte por rango de fecha</span></th>
          </tr>
        <tr>
          <th valign="top" scope="col"><div align="left">
            <select name="dia2" id="select4">
              <?
			$dd = 1;
			while ($dd < 32)
			{
				if (strlen(trim($dd)) ==1) $dd = "0".$dd;
				print "<option value=$dd>$dd</option>";
				$dd++;
			}
		?>
                </select>
</div></th>
          <th valign="top" scope="col"><div align="left">
              <select name="mes2" id="mes2">
                <?
			print "<option value=01>Enero</option>";
			print "<option value=02>Febrero</option>";
			print "<option value=03>Marzo</option>";
			print "<option value=04>Abril</option>";
			print "<option value=05>Mayo</option>";
			print "<option value=06>Junio</option>";
			print "<option value=07>Julio</option>";
			print "<option value=08>Agosto</option>";
			print "<option value=09>Septiembre</option>";
			print "<option value=10>Octubre</option>";
			print "<option value=11>Noviembre</option>";
			print "<option value=12>Diciembre</option>";
		?>
                </select>
          </div></th>
          <th valign="top" scope="col"><div align="left">
            <select name="ano2" id="select3">
                <?
		  $ano=date("Y");
		  $ano2= 2006;
		  while ($ano2 <= $ano+2)
		  {
			if ($ano2 == $ano)
				{
				print "<option selected value=$ano2>$ano2</option>";
				}
			else
				{
				print "<option value=$ano2>$ano2</option>";
				}

			$ano2 = $ano2 +1;
			}
			?>
              </select>
</div></th>
          <th valign="top" scope="col">&nbsp;</th>
        </tr>
        <tr>
          <th valign="top" scope="col"><div align="left">
              <select name="dia3" id="select2">
                <?
			$dd = 1;
			while ($dd < 32)
			{
				if (strlen(trim($dd)) ==1) $dd = "0".$dd;
				print "<option value=$dd>$dd</option>";
				$dd++;
			}
		?>
                </select>
          </div></th>
          <th valign="top" scope="col"><div align="left">
              <select name="mes3" id="select">
                <?
			print "<option value=01>Enero</option>";
			print "<option value=02>Febrero</option>";
			print "<option value=03>Marzo</option>";
			print "<option value=04>Abril</option>";
			print "<option value=05>Mayo</option>";
			print "<option value=06>Junio</option>";
			print "<option value=07>Julio</option>";
			print "<option value=08>Agosto</option>";
			print "<option value=09>Septiembre</option>";
			print "<option value=10>Octubre</option>";
			print "<option value=11>Noviembre</option>";
			print "<option value=12>Diciembre</option>";
		?>
                </select>
          </div></th>
          <th valign="top" scope="col"><div align="left">
            <select name="ano3" id="select3">
                <?
		  $ano=date("Y");
		  $ano2= 2006;
		  while ($ano2 <= $ano+2)
		  {
			if ($ano2 == $ano)
				{
				print "<option selected value=$ano2>$ano2</option>";
				}
			else
			{
				print "<option value=$ano2>$ano2</option>";
			}


		$ano2 = $ano2 +1;
			}
			?>
                </select>
          </div></th>
          <th valign="top" scope="col"><span class="Estilo9">
            <input name="rango" type="submit" id="rango" value="Reporte por rango" onClick="enviar4(this.form)">
          </span></th>
        </tr>
      </table>
      <p>&nbsp;</p>
    </form>      </th>
  </tr>
  <tr>
    <th scope="col">&nbsp;</th>
  </tr>
</table>
<p>&nbsp;</p>

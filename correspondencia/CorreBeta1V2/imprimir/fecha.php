<?
	session_start();

$_SESSION['nivel']=2;
include('../../valida.php');

 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];

	$_SESSION['folder'] = "correBeta1V2/imprimir/";
	$_SESSION['pagina'] = $page;

//	include('../../security.php');
//	print $_SESSION['iso_registro'];
?>
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
<link href="../style/styles.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
body {
/*	background-image: url(Fondo%20de%20Fiesta.jpg);*/
}
.Estilo4 {font-size: 12px}
.Estilo6 {
	font-size: 36px;
	color: #000000;
}
.Estilo8 {font-size: 14}
.Estilo9 {
	color: #FF0000;
	font-weight: bold;
	font-size: 12px;
}
.Estilo5 {font-family: Arial, Helvetica, sans-serif; color: #0066FF; font-size: 10px; }
-->
</style></head>

<body><form name="form1" method="post" action="reporte_diario.php">
<p align="center" class="Estilo6">Ingrese fecha del reporte</p>



<table width="411" border="0" align="center">
  <tr>
    <th colspan="4" valign="top" scope="col">&nbsp;</th>
  </tr>
  <tr>
    <th valign="top" class="Estilo5" scope="col"><div align="right">Fecha inicial </div></th>
    <th valign="top" scope="col"><div align="left">
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
    <th valign="top" scope="col"><div align="left">
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
			print "<option value=09 "; if (9==$mes) print "selected" ; print ">Septiembre/option>";
			print "<option value=10 "; if (10==$mes) print "selected" ; print ">Octubre</option>";
			print "<option value=11 "; if (11==$mes) print "selected" ; print ">Noviembre</option>";
			print "<option value=12 "; if (12==$mes) print "selected" ; print ">Diciembre</option>";


		?>
        </select>
    </div></th>
    <th valign="top" scope="col"><div align="left">
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
  </tr>
  <tr>
    <th width="150" valign="top" class="Estilo5" scope="col"><div align="right">Del documento </div></th>
    <th width="68" valign="top" scope="col"><div align="left">
      <input name="correlativo" type="text" size="10">
    </div></th>
    <th width="45" valign="top" scope="col"><div align="right">al</div></th>
    <th width="130" valign="top" scope="col"><div align="left">
      <input name="correlativo1" type="text" size="10">
    </div></th>
  </tr>
  <tr>
    <th colspan="4" valign="top" class="Estilo5" scope="col"><input type="submit" name="Submit" value="Enviar"></th>
  </tr>
</table>
<p>&nbsp;</p></form>
</body>
</html>

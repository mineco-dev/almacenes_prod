<?
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];
	session_start();

	$_SESSION['folder'] = "calendario/";
	$_SESSION['pagina'] = $page;

	include('../security.php');
	print $_SESSION['iso_registro'];
?>
<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	color: #FFFFFF;
}
.Estilo2 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #000000;
	font-weight: bold;
	font-size: x-small;
}
.Estilo6 {font-size: small}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo13 {font-family: Verdana, Arial, Helvetica, sans-serif; color: #00FF00; font-weight: bold; font-size: x-small; }
.Estilo14 {color: #FF0000}
.Estilo15 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: small; }
body {
	background-image: url(../../../../Documents%20and%20Settings/SINFODACE/Mis%20documentos/correspon/Fondo%20de%20Fiesta.jpg);
}
-->
</style>
</head>

<body>
<form method="post" action="mtgrabaactividad.php">
  <table width="886" border="0" align="center">
    <tr>
      <th width="746" height="21" bgcolor="#000000" scope="col"><div align="left" class="Estilo1">
        <div align="center">Actividad</div>
      </div></th>
      <th width="62" bgcolor="#000000" scope="col"><span ><a href="modificaractividad.php" class="Estilo13">Modificar</a></span></th>
      <th width="64" bgcolor="#000000" class="Estilo2 Estilo14" scope="col" ><a href="eliminaactividad.php" class="Estilo2 Estilo14">Eliminar</a></th>
    </tr>
    <tr>
      <th height="465" colspan="3" valign="top" scope="col">
        <?
//require ("calendariomt.php");
$usuarioid = $_SESSION[idempleado];
?>

        <table width="619" border="0">
          <tr bordercolor="#000000">
            <th width="112" valign="top" scope="col"><div align="left" class="Estilo2 Estilo6">
              <div align="left">Tipo actividad </div>
            </div></th>
            <th width="497" valign="top" scope="col">
              <div align="left">
                <input name="textfield3" type="text" size="50">
</div></th>
            </tr>
		   <tr bordercolor="#000000">
		  	 <th width="112" valign="top" scope="col"><div align="left" class="Estilo2 Estilo6">
              <div align="left">Tema</div>
            </div></th>
            <th width="497" valign="top" scope="col">
               <div align="left">
                <input name="textfield3" type="text" size="50">
</div></th>
		    </tr>

           <tr bordercolor="#000000">
             <td valign="top"><span class="Estilo6 Estilo7">Seminario, Curso</span></td>
             <td valign="top"><input name="textfield32" type="text" size="50"></td>
           </tr>
          <tr bordercolor="#000000">
            <td valign="top"><div align="right" class="Estilo6">
              <div align="left"><span class="Estilo7">Lugar</span></div>
            </div></td>
            <td valign="top"><div align="left">
              <input name="lugar" type="text" id="lugar2" size="35">
</div></td>
          </tr>
          <tr bordercolor="#000000">
            <td valign="top"><div align="right" class="Estilo6">
              <div align="left"><span class="Estilo7">Salon</span></div>
            </div></td>
            <td valign="top"><div align="left">
              <input name="salon" type="text" id="salon">
            </div></td>
          </tr>
          <tr bordercolor="#000000">
            <td height="21" valign="top"><div align="right" class="Estilo6">
              <div align="left"><span class="Estilo7">Departamento</span></div>
            </div></td>
            <td valign="top"><input type="text" name="textfield"></td>
          </tr>
          <tr bordercolor="#000000">
            <td height="21" valign="top"><div align="right" class="Estilo6">
              <div align="left"><span class="Estilo7">Pais</span></div>
            </div></td>
            <td valign="top"><input type="text" name="textfield2"></td>
          </tr>
          <tr bordercolor="#000000">
            <td height="21" valign="top"><div align="right" class="Estilo6">
              <div align="left"><span class="Estilo7">Hora</span></div>
            </div></td>
            <td valign="top"><div align="left">
              <input name="hora" type="text" id="hora">
            </div></td>
          </tr>
          <tr bordercolor="#000000">
            <td height="21" valign="top"><div align="right" class="Estilo6">
              <div align="left"><span class="Estilo7">Descripcion</span></div>
            </div></td>
            <td valign="top"><div align="left">
              <textarea name="descripcion" cols="75" rows="4"></textarea>
            </div></td>
          </tr>
          <tr bordercolor="#000000">
            <td height="21" valign="top"><div align="right" class="Estilo6">
              <div align="left"><span class="Estilo7">Reunion</span></div>
            </div></td>
            <td valign="top"><div align="left">
              <textarea name="reunion" cols="75" rows="4"></textarea>
            </div></td>
          </tr>
          <tr bordercolor="#000000">
            <td height="21" valign="top"><div align="right" class="Estilo6">
              <div align="left"><span class="Estilo7">Resultados</span></div>
            </div></td>
            <td valign="top"><div align="left">
              <textarea name="resultado" cols="75" rows="4"></textarea>
            </div></td>
          </tr>
          <tr bordercolor="#000000">
            <td valign="top"><div align="right" class="Estilo6">
              <div align="left"><span class="Estilo7">Mineco</span></div>
            </div></td>
            <td valign="top"><div align="left">
              <input name="mineco" type="checkbox" id="mineco" value="checkbox">
            </div></td>
          </tr>
        </table>
	  </th>
    </tr>
  </table>
</form>
</body>
</html>

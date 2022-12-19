<?
	session_start();
	$dependencia=$_SESSION['subgerencia'];
?>
<!DOCTYPE html>
<html>
<head>
<link href="helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="REFRESH" CONTENT="50;URL=main33.php">
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo2 {font-size: small;
  font-family:Arial, Helvetica, sans-serif; 
   font-weight: bold;}
.Estilo3 {
	color: #000000;
	font-weight: bold;
}
.Estilo6 {font-family: Verdana, Arial, Helvetica, sans-serif; }

-->
</style>
</head>
<body>
<table width="100%" border="0">
  <!--tr bgcolor="#4FC654"-->
  <tr bgcolor="#000099">  
    <td colspan="3" valign="top"><div align="center" class="Estilo1 Estilo6"><strong>PLANEACI&Oacute;N ESTRAT&Eacute;GICA</strong></div></td>
  </tr>
  <tr>
    <td width="32%" valign="top" ><table width="100%" border="0">
      <tr>
        <td bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">MISI&Oacute;N</div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2"><p align="justify" class="tituloproducto">1. Realizaci&oacute;n del planeamiento estrat&eacute;gico del Ministerio.</p>
          <p align="justify" class="tituloproducto">2.Seguimiento mensual del avance de las metas institucionales de acuerdo al Plan Operativo Anual.</p>
          <p align="justify" class="tituloproducto">3. Elaborar y generar los diferentes informes institucionales de acuerdo a lo que establece la Ley de Presupuesto, Constituci&oacute;n de la Rep&uacute;blica y los solicitados por otros Ministerios. </p>
          <p align="justify" class="tituloproducto">4. Mantenimiento y actualizaci&oacute;n de enlaces institucionales como Fuentes de informaci&oacute;n. </p></td>
       </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#CAC9CE" class="Estilo2"><div align="center"><span class="Estilo3">POL&Iacute;TICA DE CALIDAD </span></div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2"><p align="justify" class="tituloproducto">Ser la Unidad de apoyo estrat&eacute;gico y protag&oacute;nico de apoyo a la Gerencia General para el an&aacute;lisis de datos de informaci&oacute;n critica, generando los informes que se requieran de manera eficiente y eficaz para una buena administraci&oacute;n p&uacute;blica . </p></td>
      </tr>	  
    </table></td>
    <td width="33%"  valign="top"><table width="100%">
      <tr>
        <td valign="top" bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">VISI&Oacute;N</div></td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#FFFFFF" class="Estilo2"><p align="justify" class="tituloproducto">Ser la unidad t&eacute;cnica de asesor&iacute;a permanente de las diferentes Direcciones, Registros y otras unidades administrativas del Ministerio, as&iacute; como a los distintos programas y proyectos, en aspectos de planeamiento, administrativos, financieros, clima organizacional, con el objetivo de cumplir en forma efectiva las funciones que le otorga al Ministerio de Econom&iacute;a la Ley del Organismo Ejecutivo; y lo establecido en su Reglamento Org&aacute;nico. </p></td>
      </tr>	  
    </table></td>
    <td width="35%" valign="top"><table width="100%" border="0">
      <tr>
        <td valign="top" bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">PERSONAL</div></td>
      </tr>
	  <?	  	
			  	$i=1;
	    		require_once('connection/helpdesk.php');				
				$consulta = "Select * from usuario where codigo_dependencia='$dependencia' and activo=1";
				$result=mssql_query($consulta);				
				while($row=mssql_fetch_array($result))
				{					
                	$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}					
						echo '<tr class='.$clase.'><td>'.$row["nombres"].'&nbsp;'.$row["apellidos"].'</a></td></tr>';
						$i++;										
				}				
	 ?>
    </table></td>
  </tr>
</table>
<BR>
<p>&nbsp;</p>
</body>
</html>

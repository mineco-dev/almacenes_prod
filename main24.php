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
    <td colspan="3" valign="top"><div align="center" class="Estilo1 Estilo6"><strong>DIRECCION ADMINISTRATIVA </strong></div></td>
  </tr>
  <tr>
    <td width="32%" valign="top" ><table width="100%" border="0">
      <tr>
        <td bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">MISI&Oacute;N</div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2"><p align="justify" class="tituloproducto">1.Dotaci&oacute;n de materiales y suministro oportunamente, apoy&aacute;ndose en las normas y procedimientos establecidos en la leyes correspondientes. </p>
          <p align="justify" class="tituloproducto">2. Organizar y ejecutar los procesos de atenci&oacute;n, orientaci&oacute;n e informaci&oacute;n al publico; recepci&oacute;n, registro, control, seguimiento y egreso de expedientes; efectuar la notificaci&oacute;n de resoluciones; archivar los expedientes, documentaci&oacute;n y libro de actas del Ministerio; realizar y agilizar la resoluci&oacute;n de toda solicitud, expediente y correspondencia que ingrese al Ministerio, y velar por su adecuada distribuci&oacute;n entre las diversas dependencias, seg&uacute;n corresponda. </p>
          <p align="justify" class="tituloproducto">3. Llevar a cabo el proceso legal, t&eacute;cnico y administrativo que conlleve a la adquisici&oacute;n de bienes y contrataci&oacute;n de servicios. </p>
          <p align="justify" class="tituloproducto">4. Establecer y dar seguimiento a los sistemas inform&aacute;ticos para el control de almac&eacute;n e inventarios y mantener actualizados los registros de suministros y bienes. </p>
          <p align="justify" class="tituloproducto">5. Planificar, coordinar y ejecutar las actividades de mantenimiento, reparaciones, transporte y dem&aacute;s servicios generales de apoyo. </p>
          <p align="justify" class="tituloproducto">6. Velar por el cuidado y resguardo de las instalaciones, equipo y maquinaria, veh&iacute;culos y dem&aacute;s bienes, as&iacute; como de las condiciones ambientales para la protecci&oacute;n de olas personas. </p>
          </td>
       </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#CAC9CE" class="Estilo2"><div align="center"><span class="Estilo3">POL&Iacute;TICA DE CALIDAD </span></div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2"><p align="justify" class="tituloproducto">Facilitar y apoyar el desempe&ntilde;o eficiente y eficaz del Ministerio a traves de una administracion optima y transparente de los recursos fisicos </p></td>
      </tr>	  
    </table></td>
    <td width="33%"  valign="top"><table width="100%">
      <tr>
        <td valign="top" bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">VISI&Oacute;N</div></td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#FFFFFF" class="Estilo2"><p align="justify" class="tituloproducto">Ser la unidad responsable de facilitar la funci&oacute;n t&eacute;cnica y administrativa de todas las dependencias del Ministerio de Econom&iacute;a, a trav&eacute;s de la dotaci&oacute;n de los recursos administrativos y log&iacute;sticos, para que dichas unidades presten sus servicios con productividad y efectividad. </p></td>
      </tr>	  
    </table></td>
    <td width="35%" valign="top"><table width="100%" border="0">
      <tr>
        <td valign="top" bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">PERSONAL</div></td>
      </tr>
	 <?	  	
			  	$i=1;
	    		require_once('connection/rrhhconsulta.inc');								
				$consulta = "select (a.nombre+' '+ a.nombre2+' '+a.nombre3+' ' + a.apellido+' '+ a.apellido2) as empleado, t.iddireccion from asesor a
left outer join tb_telefono t on t.idasesor = a.idasesor and t.id_tipo_telefono =1
where a.activo =1 and t.iddireccion =18 order by empleado";
				$result=$query($consulta);					                                 
				while($row=$fetch_array($result))
				{					
                	$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}					
						echo '<tr class='.$clase.'><td>'.$row["empleado"].'</a></td></tr>';
						$i++;										
				}				
	 ?>
    </table></td>
  </tr>
</table>
<BR>
<?
include("almacen.php");
?>
<p>&nbsp;</p>
</body>
</html>

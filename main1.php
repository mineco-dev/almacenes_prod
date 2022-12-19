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
    <td colspan="3" valign="top"><div align="center" class="Estilo1 Estilo6"><strong>DIRECCION DE TECNOLOGIAS DE LA INFORMACION </strong></div></td>
  </tr>
  <tr>
    <td width="32%" valign="top" ><table width="100%" border="0">
      <tr>
        <td bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">MISI&Oacute;N</div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2"><p align="justify" class="tituloproducto">1. Optimizar los recursos inform&aacute;ticos, mejorando el hardware-software, con el fin de brindar a los usuarios mejores recursos para hacer mas eficaz y eficiente su trabajo, estando a la vanguardia de la tecnolog&iacute;a.</p>
          <p align="justify" class="tituloproducto">2. Velar por el buen funcionamiento de todos los recursos inform&aacute;ticos-tecnol&oacute;gicos con los que cuenta esta entidad, brindadno a los usuarios soporte t&eacute;cnico de &iacute;ndole laboral, servicios generales y espec&iacute;ficos de red.</p>
          <p align="justify" class="tituloproducto">3. Seguimiento en el mantenimiento preventivo del equipo, instalaci&oacute;n de hardware y software, control preventivo de virus, servicio de telefon&iacute;a a trav&eacute;s de la planta telef&oacute;nica la cual provee comunicaci&oacute;n interna-externa. </p></td>
       </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#CAC9CE" class="Estilo2"><div align="center"><span class="Estilo3">POL&Iacute;TICA DE CALIDAD </span></div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2"><div align="justify" class="tituloproducto">Brindar seguridad de la informaci&oacute;n contenida tanto en los servidores como en las computadoras de cada uno de los usuarios, garantizando el buen funcionamiento de los servicios. </div></td>
      </tr>	  
    </table></td>
    <td width="33%"  valign="top"><table width="100%">
      <tr>
        <td valign="top" bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">VISI&Oacute;N</div></td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#FFFFFF" class="tituloproducto"><div align="justify">Ser la unidad t&eacute;cnica con recurso humano capacitado para la creaci&oacute;n, instalaci&oacute;n, administraci&oacute;n y mantenimiento de los sistemas y equipos inform&aacute;ticos, as&iacute; como la introducci&oacute;n de tecnolog&iacute;a moderna alos procesos administrativos y de comunicaci&oacute;n de las diferentes &aacute;reas, direcciones y/o departamentos del Ministerio de Econom&iacute;a. </div></td>
      </tr>	  
    </table></td>
    <td width="35%" valign="top"><table width="100%" border="0">
      <tr>
        <td valign="top" bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">PERSONAL</div></td>
      </tr>
	  <?	  	
			  	$i=1;
	    		require_once('connection/rrhhconsulta.inc');								
/*				SELECT (a.apellido +' '+ a.apellido2 +' '+ a.apellidocasada +', '+ a.nombre +' '+ a.nombre2 +' '+ a.nombre3) as empleado, a.activo, a.idasesor, a.gafete,
				                        d.nombre AS dependencia
									    FROM asesor a 
										left join tb_contratacion_gobierno g on a.idasesor=g.idasesor
										inner join direccion d on g.entidad_gobierno=d.iddireccion and g.entidad_gobierno=21											
							 			where a.activo=1
										order by a.apellido, a.apellido2, a.apellidocasada, a.nombre*/
										/*select (a.nombre+' '+ a.nombre2+' '+a.nombre3+' ' + a.apellido+' '+ a.apellido2) as empleado, t.iddireccion from asesor a
left outer join tb_telefono t on t.idasesor = a.idasesor and t.id_tipo_telefono =1
where a.activo =1 and t.iddireccion =21 order by empleado
										*/
				$consulta = "select (nombre+' '+ nombre2+' '+nombre3+' ' +apellido+' '+apellido2) as empleado from asesor 
where iddireccion=21 and activo=1 order by empleado";
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
<?
include("almacen.php");
?>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p> <BR>
</p>
<p>&nbsp;</p>
</body>
</html>

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
    <td colspan="3" valign="top"><div align="center" class="Estilo1 Estilo6"><strong>DIRECCION DE RECURSOS HUMANOS </strong></div></td>
  </tr>
  <tr>
    <td width="32%" valign="top" ><table width="100%" border="0">
      <tr>
        <td bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">MISI&Oacute;N</div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2"><p align="justify" class="tituloproducto">1. Administraci&oacute;n eficiente del personal, velando por el correcto cumplimiento de la Ley de Servicio Civil y su Reglamento, as&iacute; como de las dem&aacute;s normas aplicables.</p>
          <p align="justify" class="tituloproducto">2. Personal capacitado en diferentes &aacute;reas, definiendo pol&iacute;ticas, planes de capacitaci&oacute;n y coordinando eficientemente su ejecuci&oacute;n.</p>
          <p align="justify" class="tituloproducto">3. Asistencia m&eacute;dica al personal con atenci&oacute;n m&eacute;dica genera,l y visita domiciliaria.</p>
          <p align="justify" class="tituloproducto">4. Establecer normas y procedimientos de gesti&oacute;n de recursos humanos, con sus correspondientes sistemas inform&aacute;ticos.</p>
          <p align="justify"><span class="tituloproducto">5. Participar y coordinar, como representante del Ministerio en asuntos de relaciones laborales</span> </p></td>
       </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#CAC9CE" class="Estilo2"><div align="center"><span class="Estilo3">POL&Iacute;TICA DE CALIDAD </span></div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2"><div align="justify" class="tituloproducto">Desarrollar un rol estrat&eacute;gico y protag&oacute;nico de la administraci&oacute;n del recurso humano, logrando un equilibrio entre las decisiones y objetivos personales-organizacionales.</div></td>
      </tr>	  
    </table></td>
    <td width="33%"  valign="top"><table width="100%">
      <tr>
        <td valign="top" bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">VISI&Oacute;N</div></td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#FFFFFF" class="Estilo2"><div align="justify" class="tituloproducto">Ser la unidad t&eacute;cnica responsable de la administraci&oacute;n, capacitaci&oacute;n y desarrollo del recurso humano con que cuente el Ministerio de Econom&iacute;a con fundamento en la Ley de Servicio Civil y su reglamento; as&iacute; como del Pacto Colectivo.</div></td>
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
where a.activo =1 and t.iddireccion =20
order by empleado";
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
<p>&nbsp;</p>
</body>
</html>

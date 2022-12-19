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
    <td colspan="3" valign="top"><div align="center" class="Estilo1 Estilo6"><strong>DIRECCION FINANCIERA </strong></div></td>
  </tr>
  <tr>
    <td width="32%" valign="top" ><table width="100%" border="0">
      <tr>
        <td bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">MISI&Oacute;N</div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="tituloproducto"><p align="justify">1.  Integrar un Sistema Contable financiero, a trav&eacute;s de la implementaci&oacute;n de procesos adecuados bajo el marco legal establecido por el Ministerio de Finanzas, documentado y auditable. </p>
          <p align="justify">2. Implementar una eficiente administraci&oacute;n de �tesorer&iacute;a� que cumpla con los requerimientos modernos y &aacute;giles, as&iacute; como confiables para ofrecer el mejor servicio a los usuarios. </p>
          <p align="justify">3. Desarrollar un sistema presupuestario acorde a los reglamentos del Ministerio de Finanzas y organizaci&oacute;n interna del MINECO, que agilice las transferencias presupu&eacute;stales y se elaboren los necesarios informes de an&aacute;lisis. </p>
          <p align="justify">4. Implementar un sistema de inventarios r&aacute;pido, seguro y funcional, que registre todos los datos de existencias, ingresos y egresos en bases de datos automatizados, as&iacute; como asegure f&iacute;sicamente la informacion captada. </p></td>
       </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#CAC9CE" class="Estilo2"><div align="center"><span class="Estilo3">POL&Iacute;TICA DE CALIDAD </span></div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2"><p align="justify" class="tituloproducto">Administrar transparente y eficientemente los recursos financieros asignados al MINISTERIO DE ECONOMIA, atendiendo las necesidades internas de sus Direcciones y/o Unidades de apoyo de forma eficiente y eficaz, en cumplimiento a las metas planificadas en el ejercicio fiscal vigente. </p></td>
      </tr>	  
    </table></td>
    <td width="33%"  valign="top"><table width="100%">
      <tr>
        <td valign="top" bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">VISI&Oacute;N</div></td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#FFFFFF" class="Estilo2"><p align="justify" class="tituloproducto">Constituirse en la unidad t&eacute;cnica con recurso humano capacitado para la prestaci&oacute;n de un servicio eficiente y oportuno en la administraci&oacute;n de los recursos financieros asignados al Ministerio de Econom&iacute;a, conforme las leyes, reglamentos y normas que facilitan la operatividad y transparencia. </p></td>
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
where a.activo =1 and a.iddireccion =19
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

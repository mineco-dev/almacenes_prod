<?
	session_start();
	$dependencia=$_SESSION['subgerencia'];
	require("includes/funciones.php");
	require("includes/sqlcommand.inc");
?>
<!DOCTYPE html>
<html>
<head>
<link href="helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="REFRESH" CONTENT="100;URL=main33.php">
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
    <td colspan="3" valign="top"><div align="center" class="Estilo1 Estilo6"><strong>VICEMINISTERIO DE ADMINISTRATIVO FINANCIERO </strong></div></td>
  </tr>
  <tr>
    <td width="32%" valign="top" ><table width="100%" border="0">
      <tr>
        <td bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">MISI&Oacute;N</div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2"><div align="justify" class="tituloproducto">&quot;Administraci&oacute;n eficiente, eficaz y transparente de los recursos humanos, t&eacute;cnicos y materiales del Ministerio de Econom&iacute;a de Guatemala, atendiendo los requerimientos de unidades sustantivas de los Viceministerios de Inversi&oacute;n y Competencia, Integraci&oacute;n y Comercio Exterior y el de Desarrollo de la Micro, Peque&ntilde;a y Mediana Empresa.&quot; </div></td>
       </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#CAC9CE" class="Estilo2"><div align="center"><span class="Estilo3">POL&Iacute;TICA DE CALIDAD </span></div></td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Estilo2"><div align="justify" class="tituloproducto">Brindar un servicio de excelencia, eficiente, oportuno y transparente dentro del esquema de mejora continua, implementado a trav&eacute;s del Recurso Humano capacitado y un modelo Internacional de gesti&oacute;n, organizaci&oacute;n y documentaci&oacute;n.</div></td>
      </tr>	  
    </table></td>
    <td width="33%"  valign="top"><table width="100%">
      <tr>
        <td valign="top" bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">VISI&Oacute;N</div></td>
      </tr>
      <tr>
        <td valign="top" bgcolor="#FFFFFF" class="Estilo2"><div align="justify" class="tituloproducto">&quot;Ser una Unidad de apoyo a todas las unidades administrativas del Despacho del Ministro de Econom&iacute;a, vanguardista en el uso de m&eacute;todos de trabajo y de comunicaci&oacute;n moderna, as&iacute; como ser un modelo estatal de desempe&ntilde;o en la prestaci&oacute;n de servicios, respondiendo a las expectativas de los usuarios internos y externos. </div></td>
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
where a.activo =1 and t.iddireccion =3 order by empleado";
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

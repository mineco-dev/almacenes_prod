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
.Estilo6 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>
</head>
<body>
<table width="100%" border="0">
  <!--tr bgcolor="#4FC654"-->
  <tr bgcolor="#000099">
    <td colspan="3" valign="top"><div align="center" class="Estilo1 Estilo6">COMITE DE MODERNIZACION Y FORTALECIMIENTO INSTITUCIONAL</div></td>
  </tr>
  <tr>
    <td width="32%" valign="top" ><table width="100%" border="0">
        <tr>
          <td bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">MISI&Oacute;N</div></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF" class="Estilo2"><p align="justify" class="tituloproducto">Velar por el fiel cumplimiento del proceso de modernizaci&oacute;n, generando capacidades institucionales, para mejorar la efectividad, equidad, participaci&oacute;n, transparencia y rendici&oacute;n de cuentas de las pol&iacute;ticas p&uacute;blicas, para ofrecer servicios p&uacute;blicos transparentes y de calidad, promoviendo la integridad, honestidad y responsabilidad en los servidores p&uacute;blicos. </p>
              </td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF" class="Estilo2">&nbsp;</td>
        </tr>
        <tr>
          <td bgcolor="#CAC9CE" class="Estilo2"><div align="center"><span class="Estilo3">POL&Iacute;TICA DE CALIDAD </span></div></td>
        </tr>
        <tr>
          <td bgcolor="#FFFFFF" class="Estilo2"><div align="justify" class="tituloproducto">
            <p>Generar una cultura orientada al mejoramiento continuo de todos los servicios y/o funciones de las entidades del Ministerio de Econom&iacute;a, con capacitaci&oacute;n constante al personal que las conforman, e innovando nuevas tecnolog&iacute;as para garantizar la satisfacci&oacute;n del ciudadano. </p> 
            </div></td>
        </tr>
    </table></td>
    <td width="33%"  valign="top"><table width="100%">
        <tr>
          <td valign="top" bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">VISI&Oacute;N</div></td>
        </tr>
        <tr>
          <td valign="top" bgcolor="#FFFFFF" class="Estilo2"><div align="justify" class="tituloproducto">Ser el ente, que promueva el proceso de modernizaci&oacute;n dentro del Ministerio de Econom&iacute;a, con el objetivo de fortalecer la capacidad de gesti&oacute;n estatal, mejorar la eficiencia y eficacia en los servicios p&uacute;blicos y cimentar la confianza de la ciudadan&iacute;a en el sector p&uacute;blico. </div></td>
        </tr>
    </table></td>
    <td width="35%" valign="top"><table width="100%" border="0">
        <tr>
          <td valign="top" bgcolor="#CAC9CE" class="Estilo2">INTEGRANTES DEL COMIT&Eacute;</td>
        </tr>
        <?	  	
			  	$i=1;
	    		require_once('connection/helpdesk.php');				
				$consulta = "SELECT * FROM usuario WHERE activo=1 and codigo_usuario IN (20, 95, 96, 328, 384, 422, 572) ORDER BY nombres";
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

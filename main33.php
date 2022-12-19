<?
include("notificaciones_nuevas.php");
?>
<!DOCTYPE html>
<html>
<head>
<script language="JavaScript">
function Abrir_ventana(pagina) 
	{
		var opciones="toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, width=300, height=200, top=85, left=140";
		window.open(pagina,"",opciones);
	}
</script>
<link href="helpdesk.css" rel="stylesheet" type="text/css">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<META HTTP-EQUIV="REFRESH" CONTENT="120;URL=main33.php">
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
.Estilo4 {font-size: small}
.Estilo5 {font-weight: bold; color: #0066CC; font-family: Verdana, Arial, Helvetica, sans-serif;}
.Estilo6 {font-family: Verdana, Arial, Helvetica, sans-serif; }
a:link {
	color: #000000;
}

/* color de letra de vinculos #006699*/
-->
</style>
</head>
<? /*
	if ($hay_publicaciones==true) 
	{	
		echo '<body onload=Abrir_ventana("reciente.php")>';
	}
	else 
	{
		echo "<body>";
	} */
?>	
<table width="100%" border="0">
  <!--tr bgcolor="#4FC654"-->
  <tr bgcolor="#000099">
    <td colspan="3" valign="top"><div align="center" class="Estilo1 Estilo6"><strong>LO MAS RECIENTE</strong></div></td>
  </tr>
  <tr>
    <td width="32%" valign="top" ><table width="100%" border="0">
      <tr>
        <td bgcolor="#CAC9CE"  class="Estilo2"><div align="center" class="Estilo3">ANUNCIOS Y PUBLICACIONES </div></td>
      </tr>
	  <?	  	
  				$result=mssql_query($consulta);				
				while($row=mssql_fetch_array($result))
				{	
                	$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					if ($row["tipo_publicacion"]==1)					
                	{
						echo '<tr class='.$clase.'><td><a href="uploads/index.php?hoy='.$row["codigo_archivo"].'">'.$row["palabras_clave"].'</a></td></tr>';
						$i++;											
					}
				}				
	 ?>
    </table></td>
    <td width="33%"  valign="top"><table width="100%">
      <tr>
        <td valign="top" bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">PROCEDIMIENTOS Y MANUALES </div></td>
      </tr>
	  	  <?	  	
				$result=mssql_query($consulta);				
				while($row=mssql_fetch_array($result))
				{					
                	$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					if ($row["tipo_publicacion"]==2)					
                	{
						echo '<tr class='.$clase.'><td><a href="planeacion/index.php?hoy='.$row["codigo_archivo"].'">'.$row["palabras_clave"].'</a></td></tr>';
						$i++;					
					}
				}				
	 ?>
    </table></td>
    <td width="35%" valign="top"><table width="100%" border="0">
      <tr>
        <td valign="top" bgcolor="#CAC9CE" class="Estilo2"><div align="center" class="Estilo3">ANUNCIOS VARIOS</div></td>
      </tr>
	  <?	  	
	  
				$result=mssql_query($consulta);				
				while($row=mssql_fetch_array($result))
				{					
                	$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					if ($row["tipo_publicacion"]>2)					
                	{
						echo '<tr class='.$clase.'><td><a href="otros_anuncios/index.php?hoy='.$row["codigo_archivo"].'">'.$row["palabras_clave"].'</a></td></tr>';
						$i++;					
					}
				}				
	 ?>
    </table></td>
  </tr>
</table>
<BR>
<table width="100%" border="0" >
  <!--tr bgcolor="#4FC654"-->
  <tr bgcolor  ="#000099">
    <!--td colspan="4"><div align="center" class="Estilo1"><strong>OPCIONES PERSONALES </strong></div></td-->
   <td colspan="4"><div align="center" class="Estilo1 Estilo6"><strong>OPCIONES PERSONALES </strong></div></td>
  </tr>
  <tr>
    <td width="21%" valign="top"><table width="100%" border="0">
        <tr>
          <td valign="top" bgcolor="#CAC9CE" class="Estilo2"><div align="center"><strong>TAREAS PENDIENTES </strong></div></td>
        </tr>
		<?	  	
				$msj_txt="Select * from view_soporte where codigo_tecnico='$user' and codigo_estado=2";
				$resultado=mssql_query($msj_txt);				
				while($row2=mssql_fetch_array($resultado))
				{					
                	$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}

						echo '<tr class='.$clase.'><td><a href="tecnicos/actividad.php?hoy='.$row2["ticket"].'">'.$row2["categoria"].'</a></td></tr>';
						$i++;									
				}
	 	?>
    </table></td>
    <td width="27%" valign="top"><table width="100%" border="0">
        <tr>
          <td valign="top" bgcolor="#CAC9CE" class="Estilo2"><div align="center"><strong>MENSAJES DE TEXTO</strong></div></td>
        </tr>
		<?	  	
				$msj_txt="Select * from mensaje where codigo_estado=1 and codigo_usuario_rec='$user'";
				$resultado=mssql_query($msj_txt);				
				while($row2=mssql_fetch_array($resultado))
				{					
                	$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
						echo '<tr class='.$clase.'><td><a href="mensajes/lista_mensajes.php">'.$row2["asunto"].'</a></td></tr>';
						$i++;									
				}				
	 ?>
    </table></td>
    <td width="26%" valign="top"><table width="100%" border="0" bordercolor="#FFFFFF"> 
      <tr>
        <td class="Estilo2" valign="top" bgcolor="#CAC9CE"><div align="center"><strong>VISITANTES</strong></div></td>
      </tr>
	  <?	  		
	  			if (isset($departament_id))
				{			  				  				  	
					$visitas="Select * from view_visitas_dependencia where codigo_estado=1 and codigo_dependencia='$departament_id'";
					$resultado2=mssql_query($visitas);				
					while($row3=mssql_fetch_array($resultado2))
					{					
						$clase = "detalletabla2";
						if ($i % 2 == 0) 
						{
							$clase = "detalletabla1";
						}
							echo '<tr class='.$clase.'><td><a href="seguridad/visitas.php?vis='.$row3["codigo_visita"].'">'.$row3["nombre_visitante"].'</a></td></tr>';
							$i++;									
					}
				}
				mssql_close($s);
	 ?>
    </table></td>
    <td width="26%" valign="top"><table width="100%" border="0">
        <tr>
          <td bgcolor="#CAC9CE" class="Estilo2"><div align="center"><strong>CORRESPONDENCIA</strong></div></td>
        </tr>
		<? 
		include('correspondencia/INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
		include('correspondencia/conectarse.php');
		if(empty($_SESSION['codigoUsuario']))
		{
			$codigodeUsuario = 1;
			
		}
		else
		{
			$codigodeUsuario = $_SESSION['codigoUsuario'];
		}
		$SQL = "select
					c.idcorrespondencia,
					c.status,
					c.titulo,
					convert(varchar,c.fechaenvio,105),
					e.nombre+' '+e.apellido,
					c.correlativoinicial,
					di.nombre, 
					c.correlativo
					FROM correspondencia c, asesor e ,direccion di
					WHERE e.idasesor=c.idasesor and
						  c.idasesor2 = $codigodeUsuario and
						  c.carpeta = 1 and
						  di.iddireccion = c.iddireccion
						  and c.status = 0
					order by c.correlativo desc";
//		print $SQL."<br> codigo".$_SESSION['codigoUsuario'];
			$result = mssql_query($SQL);
			
			while($rowcor = mssql_fetch_row($result))
			{

//			echo '<tr class='.$clase.'><td><a href="correspondencia/CorreBeta1v2/center.php?vis='.$rowcor["titulo"].'">'.$rowcor["titulo"].'</a></td></tr>';
			?>
			<tr class="<? echo $clase; ?>"><td>
			<?
//			print 'a1'.$rowcor['2']; ?>
			<a href="correspondencia/mtconfirma.php"><? echo $rowcor[2]; ?></a>
			<?
//			envia_msg($rowcor["idcorrespondencia"]);
			?>
			</td>
			</tr>
			<?
			
			}
			//}
		?>
    </table></td>
  </tr>
</table>

<?
include("almacen.php");
?>
<p align="center"><!--<iframe src="valores_mineco/limpieza/index.html" frameborder="0"  width="1000" height="700"> </iframe> se quito por no tener cambios 13/06-2013--></p>
</body>
</html>

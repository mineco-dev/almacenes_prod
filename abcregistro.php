<?PHP
//Campos para ver detalle del mantenimiento del registro seleccionado
$consultaabc="select usuario_creo, usuario_modifico, usuario_desactivo, fecha_creado, fecha_modificado, fecha_desactivado
			   from $latabla where $campo_condicion=$rowid";
$res_abc=$query($consultaabc);	
while($row_abc=$fetch_array($res_abc))
	{	
		$creado=$row_abc["usuario_creo"];
		$fecha_creado=$row_abc["fecha_creado"];
		$modifico=$row_abc["usuario_modifico"];
		$fecha_modificado=$row_abc["fecha_modificado"];
		$desactivo=$row_abc["usuario_desactivo"];
		$fecha_desactivado=$row_abc["fecha_desactivado"];
	}	
?>

<table width="500" border="1" cellpadding="2" cellspacing="4">
  
  <tr>
    <td><div align="left" class="titulomenu">Modificado por: </div></td>
    <td align="left" class="titulomenu"><?PHP echo $modifico.' -- '.$fecha_modificado; ?>
    <div align="left"></div></td>
  </tr>
  <tr>
    <td><div align="left" class="titulomenu">Desactivado por: </div></td>
    <td align="left" class="titulomenu"><?PHP echo $desactivo.' -- '.$fecha_desactivado; ?>
    <div align="left"></div></td>
  </tr>
</table>


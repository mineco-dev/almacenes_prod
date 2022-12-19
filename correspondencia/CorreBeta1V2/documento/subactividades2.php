<?
	include('../../../INCLUDES/inc_header.inc'); 
	$dbms=new DBMS($conexion); 
	$IdActividad = $_REQUEST['Id']; 
?> 
<label for="SubActividad2"></label> 
<select name="idgrupo2"  id="SubActividades2"  class="TituloMedios"> 
<? 
	$dbms->sql="select idmunicipio,nombre_municipio from asesor_municipio where iddepartamento = $IdActividad"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idmunicipio"]."\">".$Fields["nombre_municipio"]."</option>"; 
	}
?> 
</select>

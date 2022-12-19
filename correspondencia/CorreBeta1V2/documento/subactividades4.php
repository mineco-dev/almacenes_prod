<?
	include('../INCLUDES/inc_header.inc'); 
	$dbms=new DBMS($conexion); 
	$IdActividad = $_REQUEST['Id']; 
?> 
<label for="SubActividad4"></label> 
<select name="idasesor"  id="SubActividades4"  class="TituloMedios"> 
<? 
	$dbms->sql="select  idasesor, nombre from asesor where iddireccion = $IdActividad"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idasesor"]."\">".$Fields["nombre"]."</option>"; 
	}
?> 
</select>
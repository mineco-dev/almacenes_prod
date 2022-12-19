<?
	include('../../INCLUDES/inc_header.inc'); 
	$dbms=new DBMS($conexion); 
	$IdActividad = $_REQUEST['Id']; 
?> 
<label for="SubActividad3"></label> 
<select name="SubActividades3"  id="SubActividades3"  class="TituloMedios"> 
<? 
	$dbms->sql="select  idasesor, nombre from asesor where iddireccion = $IdActividad"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idasesor"]."\">".$Fields["nombre"]."</option>"; 
	}
?> 
</select>
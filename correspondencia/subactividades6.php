<?
session_start();
	include('INCLUDES/inc_header.inc'); 
	$dbms=new DBMS($conexion); 
	$IdActividad = $_REQUEST['Id']; 
?> 
<label for="SubActividad6"></label> 
<select name="SubActividades6"  id="SubActividades6"  class="TituloMedios"> 
<? 
if ($_SESSION['sstipo'] == 3)
	 {
		$dbms->sql="select  idasesor, nombre, nombre2, nombre3, apellido, apellido2, apellidocasada  from asesor where iddireccion = $IdActividad and id_puesto = 2 order by 2"; 
	 }
else
	{
	$dbms->sql="select  idasesor, nombre, nombre2, nombre3, apellido, apellido2, apellidocasada  from asesor where iddireccion = $IdActividad order by 2"; 
	}
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
//		print "<option value=\"".$Fields["idasesor"]."\">".$Fields["nombre"]."</option>"; 
		print "<option value=\"".$Fields["idasesor"]."\">".$Fields["nombre"].' '.$Fields['nombre2'].' '.$Fields['apellido'].' '.$Fields['apellido2']."</option>"; 
	}
?> 
</select>
<?
	include('../INCLUDES/inc_header.inc'); 
	$dbms=new DBMS($conexion); 
	$IdActividad = $_REQUEST['Id']; 
	
	envia_msg($sstipo);
?> 
<label for="SubActividad3"></label> 
<select name="idasesor"  id="SubActividades3"  class="TituloMedios"> 
<? 
 if ( $sstipo == 3) // valida que el tipo de usuario sea recepcion para traladar documentos solo a secretarias.
  {
	$dbms->sql="select  idasesor,  nombre, nombre2, nombre3, apellido, apellido2, apellidocasada  from asesor where iddireccion = $IdActividad and id_puesto = 2"; 
  }
 else
  {
	$dbms->sql="select  idasesor, nombre, nombre2, nombre3, apellido, apellido2, apellidocasada from asesor where iddireccion = $IdActividad"; 
  }
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idasesor"]."\">".$Fields["nombre"].' '.$Fields["nombre2"].' '.$Fields["nombre3"].' '.$Fields["apellido"]."</option>"; 
	}
?> 
</select>
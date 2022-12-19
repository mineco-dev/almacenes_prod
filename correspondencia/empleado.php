<?
	session_start();
 	$pag = split("/",$PHP_SELF);
 	$page = $pag[sizeof($pag)-1];  

	$_SESSION['pagina'] = $page;
	//include('security.php');
include('INCLUDES/inc_header.inc');
$dbms=new DBMS($conexion); 
include('conectarse.php');			


?>
<?
/*
session_start();
  if (!$_SESSION['idempleado']);// && $_SESSION['tipo'] != 'asesor') 
//  if (!$_SESSION['idempleado'] ) 
  { 
  	 header("location: welcome.php");	
  
  } 

*/

?>

<html>
<head>
<script LANGUAGE="JavaScript">
function Validar(form)
{
if (confirm('SEGURO QUE DESEA GUARDAR LA INFORMACION?')){ 
    //  document.form.submit() 
		form.submit();
   		} 

}
</script>
<meta http-equiv="Content-Language" content="es">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
</head>
<body background="Fondo%20de%20Fiesta.jpg">
<? 
$gisett=(int)date("w");
$mesnum=(int)date("m");
$hora=date(" H:i",time());
?>
<form method="POST" action="guardarempleados.php">
	<div align="center">
		<table width="95%" border="0" background="Fondo%20de%20Fiesta.jpg" bgcolor="#F0FEFF" id="table1">
			<tr>
			  <td>
				<table border="0" width="100%" id="table2" bgcolor="#003366">
					<tr>
						<td><font color="#FFFFFF" size="5" face="Verdana, Arial, Helvetica, sans-serif"><b>Ingreso de Empleados</b></font></td>
					</tr>
				</table>
				<p>&nbsp;</p>
				<div align="center">
					<table width="99%" height="213" border="0" background="Fondo%20de%20Fiesta.jpg" bgcolor="#F0FEFF" id="table4">
						<tr>
							<td width="17%" height="28"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Nombres</font></td>
							<td width="41%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
						    <input name="nombres" type="text" id="nombres" size="30">
							  </font></td>
							<td width="17%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Apellidos</font></td>
							<td width="25%"><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
						    <input name="apellidos" type="text" id="fechaingresoexpediente2" size="35">
							  </font></td>
						</tr>
						  <tr>
							<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Cargo</font></td>
							<td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
							  <select name="rol_emp">
                                <?  
								  $sqlsel = "select id_puesto, puesto from puesto";
								$result = @mssql_query($sqlsel);
								while ($row = mssql_fetch_array($result))
								 { 
								 $id_puesto = $row['id_puesto'];
								 $puesto= $row['puesto'];
								 ?>
                                <option value= "<? echo $id_puesto; ?>"><? echo $puesto; ?> </option>
                                <? }	?>
                              </select></font></td>
							<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Departamento</font></td>
							<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">

                            <select name="deptomineco">
                              <?  
								    $sqlsel = "select iddireccion, nombre from direccion";
									$result = @mssql_query($sqlsel);
									while ($row = mssql_fetch_array($result))
									 { 
									 $id_direccion = $row['iddireccion'];
									 $direccion= $row['nombre'];
									 ?>
                              <option value= "<? echo $id_direccion; ?>"><? echo $direccion; ?> </option>
                              <? }	?>
                              <!--option selected>:: Seleccione Un Depto. ::</option-->
                            </select>
</font></td>
						</tr>
						<tr>
						  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Direcci&oacute;n Organizacional </font></td>
						  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
                          <select name="DireccionO" id="select">
                            <?php 
							  
							  //require_once('../Connections/redes.php'); 
							  //mysql_select_db($database_redes);
												  

							  $sSQL="Select iddireccion, direccion from direccion ";
							  $result=mssql_query($sSQL);
							  while ($row=mssql_fetch_array($result))
							  {
								echo "<option value ='".$row["iddireccion"]."'>".$row["direccion"];
								echo '</option>';
							  }
						?>
                          </select>
</font></td>
						  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
						  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">

					<select name="tema2" class="TituloMedios" id="iddepartamento2"  onChange="javascript:cargarCombo('subactividades2.php', 'tema2', 'Div_Subactividades2')">
            <option value=0> Seleccione </option>
            <? 
				$dbms->sql="select iddepartamento,nombre_departamento from asesor_departamento"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					print "<option value=\"".$Fields["iddepartamento"]."\">".$Fields["nombre_departamento"]."</option>"; 
				}
			?>
			</select>

&nbsp;
<select name="idgrupo2"  id="select" class="TituloMedios">
                </select>
</font></td>
					  </tr>
						<tr>
							<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Extensi&oacute;n</font></td>
							<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
						    <input name="extension" type="text" id="extension" size="10">
							  </font></td>
							<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Direcci&oacute;n Particular </font></td>
							<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
						    <input name="direccion" type="text" id="nodoc23" size="35">
							  </font></td>
						</tr>
						<tr>
							<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Tel&eacute;fono</font></td>
							<td>						    <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
						    <input name="telefonocasa" type="text" id="calificacion2" size="10">
						  </font></td>
							<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Celular</font></td>
							<td>						  <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
						    <input name="telefonocelular" type="text" id="telefonocelular" size="10">
						  </font></td>
						</tr>
						<tr>
							<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Correo Electr&oacute;nico </font></td>
							<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
						    <input name="email" type="text" id="email" size="40">
							  </font></td>
							<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Fecha de Cumplea&ntilde;os </font></td>
							<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
						    <input name="fechacumple" type="text" id="fechacumple" size="20">
							  </font></td>
						</tr>
						<tr>
						  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Nombre Usuario </font></td>
						  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
					      <input name="usermt" type="text" id="usermt" size="20">
						    </font></td>
						  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Password</font></td>
						  <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
					      <input name="passwordmt" type="password" id="passwordmt" size="15">
						    </font></td>
						</tr>
						<tr>
							<td><p><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Tipo User</font></p>						    </td>
						  <td><p>
						    <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
					  <!--select name="tipo" size="1" id="select">
                      <option>::: Seleccione un tipo :::</option>
                      <option value="secretaria">Secretaria</option>
                      <option value="asesor">Asesor</option>
                      <option value="supervisor">Supervisor</option>
                      <option value="visitante">Visitante</option>
                      <option value="despacho">Despacho</option>
                      <option value="director">Director</option>
                      <option value="contingentes">Contingentes</option>  
                      <option value="omc">Omc</option>
                      <option value="administrador">Administrador</option>
                        
    </select-->						  
Activo	
						  <select name="habilitado" id="select3">
                            <option value="y">Si</option>
                            <option value="n">No</option>
                          </select>			        
					        </font></p>					      </td>
							<td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">Pro-t&eacute;mpore</font></td>
						    <td><font size="2" face="Verdana, Arial, Helvetica, sans-serif">
						      <select name="protempore" id="select2">
                                <option value="0">No</option>
							    <option value="1">Si</option>
														       

    
							
                              </select>
						      </font></td>
						</tr>
						<tr>
							
					  </tr>
						<tr>
						</tr>
						<tr>
				  </table>
				</div>
				<p>&nbsp;</p>
				<table border="0" width="100%" id="table3" bgcolor="#CC3300">
                  <tr>
                    <td>
                      <p align="center">
                        <input name="cmd_guardar" type="button"onClick="Validar(this.form)" id="cmd_guardar" value="Guardar" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="reset" value="Restablecer" name="B2">
                    </td>
                  </tr>
                </table></td>
			</tr>
	  </table>
	</div>
</form>

<script type="text/javascript"> 
var peticion = false; 
var  testPasado = false; 
try { 
  peticion = new XMLHttpRequest(); 
  } catch (trymicrosoft) { 
  try { 
  peticion = new ActiveXObject("Msxml2.XMLHTTP"); 
  } catch (othermicros 
t) { 
  try { 
  peticion = new ActiveXObject("Microsoft.XMLHTTP"); 
  } catch (failed) { 
  peticion = false; 
  } 
  } 
} 
if (!peticion) 
alert("ERROR AL INICIALIZAR!"); 
  
function cargarCombo (url, comboAnterior, element_id) { 
    //Obtenemos el contenido del div 
    //donde se cargaran los resultados 
    var element =  document.getElementById(element_id); 
    //Obtenemos el valor seleccionado del combo anterior 
    var valordepende = document.getElementById(comboAnterior) 
    var x = valordepende.value 
    //construimos la url definitiva 
    //pasando como parametro el valor seleccionado 
    var fragment_url = url+'?Id='+x; 
    element.innerHTML = '<img src="Imagenes/loading.gif" />'; 
    //abrimos la url 
    peticion.open("GET", fragment_url); 
    peticion.onreadystatechange = function() { 
        if (peticion.readyState == 4) { 
//escribimos la respuesta 
element.innerHTML = peticion.responseText; 
        } 
    } 
   peticion.send(null); 
} 
</script>



</body>
</html>
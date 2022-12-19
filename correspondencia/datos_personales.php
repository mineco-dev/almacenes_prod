<?
	include('../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="HojaEstilo.css" rel="stylesheet" type="text/css">

<style type="text/css">
<!--
.Estilo1 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 11px;
}
.Estilo2 {
	color: #FFFFFF;
	font-weight: bold;
	font-size: 16px;
}
.Estilo6 {color: #FF0000}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {font-size: larger}
.Estilo22 {font-size: 11px}
.Estilo31 {font-size: 12px; font-weight: bold; }
.Estilo3 {	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #666666;
}
.Estilo13 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo46 {color: #666666; font-weight: bold;}
.Estilo47 {color: #000000}
.Estilo61 {	font-family: Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;
}
.Estilo64 {
	color: #000000;
	font-size: 11px;
	font-family: Arial, Helvetica, sans-serif;
}
body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}
.Estilo28 {font-size: 12px}
.Estilo67 {font-size: 9px}
.Estilo69 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>


</head>

<body>
<form name="form1" method="post" action="asesoringreso.php">
  <table width="91%"  border="0">
    <tr>
      <th width="83%" scope="col">&nbsp;</th>
      <th width="17%" scope="col"><table width="100%"  border="0">
        <tr>
          <th scope="col"><span class="Estilo28"><? print $letra;?></span></th>
        </tr>
      </table>      </th>
    </tr>
    <tr>
      <th colspan="2" scope="col"><span class="Estilo3"><span class="Estilo1 Estilo8">
        <input type="hidden" name="empresa_registro" value="<? print $empresa_registro;?>">
        <input type="hidden" name="registro2" value="<? print $registro;?>">
      </span>Direcci&oacute;n de Administraci&oacute;n de Comercio Exterior</span></th>
    </tr>
    <tr>
      <th colspan="2" class="Estilo13" scope="row"><span class="Estilo46">Ministerio de Econom&iacute;a de Guatemala</span></th>
    </tr>
    <tr>
      <th class="Estilo13" scope="row">
	  <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
	  <input type="hidden" name="MAX_FILE_SIZE2" value="100000000">
	  </th>
      <td class="Estilo13">&nbsp;</td>
    </tr>
    <tr>
      <td class="Estilo13"><div align="center"><span class="Estilo61">Curriculum </span></div></td>
    </tr>
  </table>
  <p class="Estilo8 Estilo7">&nbsp;</p>
  <table width="797" border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2">Datos Personales </span></div></td>
    </tr>
  <tr>
    <td><span class="Estilo67"><font color="#6699FF" face="Arial, Helvetica, sans-serif">Fecha</font></span></td>
    <td> <span class="Estilo67">
	<font face="Arial, Helvetica, sans-serif">
	<? echo'<font color="#003399"><strong>'.date("d")."/".date("m")."/".date("Y").'</strong></font>'; ?> 
	<? echo'<font color="#003399"><strong>'.$hora.'</strong></font>'; ?>	</font></span></td>
    </tr>&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td colspan="-1">&nbsp;</td>
  </tr>
  <tr>
    <td width="111">&nbsp;</td>
    <td width="233">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="299" colspan="-1">&nbsp;</td>
  </tr>
  <tr class="Estilo1">
    <td class="Estilo22">Primer Nombre</td>
    <td class="Estilo7">      <input name="nombre" type="text" class="Estilo7" id="nombre" size="30"></td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Segundo Nombre </div></td>
    <td colspan="-1"><input name="nombre2" type="text" class="Estilo7" id="nombre2" size="30">
      <span class="Estilo6">      </span></td>
  </tr>
  <tr class="Estilo7">
    <td class="Estilo7"><span class="Estilo22">Tercer  Nombre</span></td>
    <td class="Estilo7"><input name="nombre3" type="text" class="Estilo7" id="nombre3" size="30"></td>

    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Primer Apellido</div></td>
    <td colspan="-1"><input name="apellido" type="text" class="Estilo7" id="apellido" size="30"></td>
  </tr>
  <tr class="Estilo7">
    <td class="Estilo7"><span class="Estilo22">Segundo Apellido</span></td>
    <td class="Estilo7"><input name="apellido2" type="text" class="Estilo7" id="apellido2" size="30"></td>
    <td colspan="2" class="Estilo7"><div align="right"><span class="Estilo22">Apellido de Casada</span></div></td>
    <td colspan="5" class="Estilo7"><input name="apellidocasada" type="text" class="Estilo7" id="apellidocasada" size="30"></td>
  </tr>
  <tr class="Estilo7">
    <td class="Estilo7"><span class="Estilo22">Estado Civil</span></td>
    <td class="Estilo7"><span class="Estilo22">

<select name="estadocivil" id="estadocivil" class="Estilo7">
                  <option value="S">SOLTERO </option>
                  <option value="C">CASADO </option>
                  <option value="V">VIUDO </option>
                  <option value="D">DIVORSIADO </option>
        </select>


    </span></td>

    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Fecha nacimiento </div></td>
    <td colspan="5" class="Estilo7"><span class="Estilo22">d&iacute;a
        <input name="dia3" type="text" class="Estilo1" id="dia3" size="2">
mes
<input name="mes3" type="text" class="Estilo1" id="mes3" size="2">
a&ntilde;o
<input name="ano3" type="text" class="Estilo1" id="ano3" size="5"> 
Edad  
<input name="edad" type="text" id="nacimiento" size="5"> 
Sexo: M 
<input name="sexo" type="radio" value="M"> 
F
<input name="sexo" type="radio" value="F">
</span></td>
  </tr>
 

<tr class="Estilo1">
    <td class="Estilo22">NIT</td>
    <td class="Estilo7">
      <input name="nit" type="text" class="Estilo7" id="nit" size="30"></td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Igss</div></td>
    <td colspan="-1"><input name="igss" type="text" class="Estilo1" id="igss" size="30">
      <span class="Estilo6">      </span></td>
  </tr>



<tr class="Estilo1">
    <td class="Estilo22">Empadronamiento</td>
    <td class="Estilo7">
      <input name="empadronamiento" type="text" class="Estilo7" id="empadronamiento" size="30"></td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Grupo Sanguineo </div></td>
    <td colspan="-1"><input name="gruposanguineo" type="text" class="Estilo1" id="gruposanguineo" size="30">
      <span class="Estilo6">      </span></td>
  </tr>
  <tr class="Estilo7">
    <td class="Estilo7"><span class="Estilo22">C&eacute;dula de Vecindad</span></td>
    <td colspan="5" class="Estilo7"><span class="Estilo22">Registro
        




N&uacute;mero
<input name="cedula" type="text" class="Estilo7" id="cedula" size="6">
adj
<select name="idregistro" id="idregistro" class="Estilo7" size="1">
  <?
	$dbms->sql="select idregistro,registro from asesor_registro"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idregistro"]."\">".$Fields["registro"]."</option>"; 
	}
?>
</select>
unte copia de C&eacute;dula
<input name="userfile" type="file" id="userfile" size="30">
    </span></td>
    <td width="5" colspan="-1"><span class="Estilo22"></span></td>
  </tr>

<tr class="Estilo1">
    <td class="Estilo22">Departamento</td>
    <td class="Estilo7">
	<div align="left">
		    <select name="iddepartamento" class="TituloMedios" id="iddepartamento"  onChange="javascript:cargarCombo('subactividades.php', 'iddepartamento', 'Div_Subactividades')">
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
	    </div>
	
	</td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Municipio</div></td>
    <td colspan="-1">      
	<span class="Estilo6">      
		<div align="left">
		  <div id="Div_Subactividades"> 
				<label for="SubActividad"></label> 
                <select name="idmunicipio"  id="idmunicipio" class="TituloMedios">
            </select>
</div>
        </div>
	</span>
	</td>
  </tr>

<tr class="Estilo1">
    <td class="Estilo22">Numero de Licencia </td>
    <td class="Estilo7">
      <input name="licencia" type="text" class="Estilo7" id="licencia" size="30"></td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Tipo licencia </div></td>
    <td colspan="-1"><input name="tipolicencia" type="text" class="Estilo1" id="tipolicencia" size="30">
      <span class="Estilo22">    Grupo Etnico</span>
      <select name="idgrupoetnico" id="idgrupoetnico" class="Estilo7" size="1">
        <?
	$dbms->sql="select idgrupoetnico,grupoetnico from asesor_grupoetnico"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idgrupoetnico"]."\">".$Fields["grupoetnico"]."</option>"; 
	}
?>
      </select>      <span class="Estilo6">      </span></td>
  </tr>
</table>

  <p>&nbsp;</p>
  <table width="830" border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">

  </tr>
</table>
<table width="804"  border="0" align="center">
  <tr>
    <td colspan="7"><div align="left"><span class="Estilo47"><span class="Estilo7"><span class="Estilo31">Direcci&oacute;n</span></span></span></div>      </td>
    </tr>
  <tr>
    <td width="10%"><span class="Estilo47"><span class="Estilo7"><span class="Estilo22">Calle y avenida </span></span></span></td>
    <td width="24%"><span class="Estilo47"><span class="Estilo7">
      <input name="calle" type="text" class="Estilo7" id="calle" size="15">
    </span></span></td>


 <td  width="10%"><span class="Estilo22">Numero</span> </td>
<td width="16%"><span class="Estilo7">

      <input name="numero" type="text" class="Estilo7" id="numero" size="5">
</span></td>






    <td width="14%" class="Estilo7"><div align="right" class="Estilo22">
        <div align="right" class="Estilo22">
          <div align="left">Zona <input name="zona" type="text" class="Estilo7" id="zona" size="5">
      </div>
        </div>
    </div>
      </td>



    <td width="8%"><span class="Estilo7"><span class="Estilo22">Colonia / Edificio</span></span></td>
    <td width="18%"><div align="left" class="Estilo22">
      <input name="colonia" type="text" class="Estilo7" id="colonia" size="15">
    </div></td>
  </tr>
  <tr>
    <td><span class="Estilo47"><span class="Estilo7"><span class="Estilo22">Departamento</span></span></span></td>
    <td><span class="Estilo47"><span class="Estilo7">
	<div align="left">
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
	    </div>
</span></span></td>
    <td width="10%"><span class="Estilo22">Municipio</span></td>
    <td width="16%"><span class="Estilo7">
	<div align="left">
		  <div id="Div_Subactividades2"> 
				<label for="SubActividad2"></label> 
                <select name="idgrupo2"  id="select" class="TituloMedios">
                </select>
</div>
        </div>
    </span></td>
    <td><div align="right" class="Estilo22">Nacionalidad</div></td>
    <td colspan="2"><span class="Estilo7">
      <input type="text" name="nacionalidad" id="nacionalidad">
    </span></td>
    </tr>
  <tr>
    <td height="25"><span class="Estilo47"><span class="Estilo7"><span class="Estilo22">Tel&eacute;fono de casa </span></span></span></td>
    <td><span class="Estilo47"><span class="Estilo7">
      <input name="telefono" type="text" class="Estilo7" id="telefono" size="24">
    </span></span></td>



    <td  width="10%"><span class="Estilo22">celular</span> </td>
<td width="16%"><span class="Estilo7">

<input name="celular" type="text" class="Estilo7" id="celular" size="20">
</span></td>
    <td><div align="right"><span class="Estilo47"><span class="Estilo22">Correo electr&oacute;nico personal </span></span></div></td>
    <td colspan="2"><span class="Estilo7"><span class="Estilo47">
      <input name="correo" type="text" class="Estilo7" id="correo" size="20">
    </span>
    </span></td>
    </tr>
  <tr>
    <td class="Estilo22">Direccion para Notificacione </td>
    <td colspan="6"><span class="Estilo47">
      <input name="direccion_para_notificaciones" type="text" id="direccion_para_notificaciones" size="24">
    </span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="6">
</select>
&nbsp;</td>
</tr>

<tr>
<td>&nbsp;</td>
    <td colspan="6">
</select>
&nbsp;</td>


  </tr>
  <tr>
    <td colspan="7"><span class="Estilo69">Datos del Ministerio de Econom&iacute;a </span></td>
    </tr>
  <tr>
    <td><span class="Estilo22">Puesto</span></td>
    <td colspan="6"><span class="Estilo47"><span class="Estilo1">
      <input name="puesto" type="text" class="Estilo7" id="puesto">
 </span></span><span class="Estilo22">Descripcion del Puesto</span><span class="Estilo47"><span class="Estilo1"> <span class="Estilo7"><span class="Estilo22">
 <input name="userfile2" type="file" id="userfile2" size="30">
 </span></span> </span></span></td>
  </tr>
  <tr>
    <td><span class="Estilo22">Contrato</span></td>
    <td colspan="6">	<span class="Estilo22">Reglon 11</span><span class="Estilo1">        <input name="reglon" type="radio" value="11" checked>
        </span><span class="Estilo22">Reglon 22</span><span class="Estilo1">        <input name="reglon" type="radio" value="22">
        </span><span class="Estilo22">
        Reglon 29</span><span class="Estilo1">
        <input name="reglon" type="radio" value="29">
            </span></td>
  </tr>
  <tr>
    <td><span class="Estilo22">Partida Presupuestaira No. </span></td>
    <td colspan="15"><span class="Estilo47"><span class="Estilo1"> <input name="partida" type="text" class="Estilo7" id="partida">
    </span></span></td>
    <td colspan="15"><span class="Estilo22">Dependencia</span>
      <select name="iddireccion" id="iddireccion" class="Estilo7" size="1">
<?
	$dbms->sql="select iddireccion,nombre from direccion"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["iddireccion"]."\">".$Fields["nombre"]."</option>"; 
	}
?>
        </select> </td>
  </tr>
</table>

<table width="77%"  border="0" align="center">
  <tr>
    <th width="43%" scope="row">&nbsp;</th>
    <td width="31%"><div align="right"><span class="Estilo1 Estilo6">
        <input type="submit" name="Submit" value="Siguiente">
      <img src="images/flecha4.JPG" width="43" height="39"> </span></div></td>
  </tr>
</table>
<div align="center"></div>
<p class="Estilo1">Favor revisar sus datos antes de ser enviados, el sistema le responder&aacute; a su correo electr&oacute;nico haber ingresado sus datos </p>
<p class="Estilo1">Toda la  informaci&oacute;n proporcionada, ser&aacute; utilizada &uacute;nica y exclusivamente para registro del Ministerio de Econom&iacute;a.</p>
<p align="center" class="Estilo1 Estilo6">&nbsp;</p>
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

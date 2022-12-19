<?
session_start();
include('../../conectarse.php');
$_SESSION['nivel']=2;

if  (( !$_SESSION['usr_val']) || ($_SESSION['usr_val'] == 'N') || ($_SESSION['usr_val'] == '') )
		{
		//envia_msg('2-'.$_SESSION['nivel']);
		 if ($_SESSION['nivel'] == 1)
			{
			 cambiar_ventana('mtlogin.php');
			}
		if ($_SESSION['nivel'] == 4)
			{
			 cambiar_ventana('../mtlogin.php');
			}

		  if ($_SESSION['nivel'] == 2)
			{
			 cambiar_ventana('../../mtlogin.php');
			}
		 if ($_SESSION['nivel'] == 3)
			{
			 cambiar_ventana('../../../mtlogin.php');
			}
		}

	if ( $sstipo != 1) // valida que sea un usuario administrador
	{
	 cambiar_ventana('../../mtlogin.php');
	}

	include('../../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 

/*if ($_GET['paramas'] != null) 
	{*/



/*			, estadocivil, edad, sexo, nit, igss, empadronamiento, 
					gruposanguineo, idregistro, cedula, userfile, idmunicipio_nac, iddepartamento_nac, licencia, tipolicencia, idgrupoetnico, 
					calle, numero, zona, colonia, nacionalidad, telefonocasa, telefonocelular, correo, direccion_para_notificaciones, id_puesto, userfile2, 
					reglon, partida, iddireccion, CONVERT(varchar,fecha_nacimiento,105) fecha_nacimiento, idmunicipio_reside, iddepartamento_reside,usuario,password,extension,habilitado,fecha_creacion,
					usuario_creacion,idtipousuario,gafete, sueldo*/
		$sql = "select nombre, nombre2, nombre3, apellido, apellido2, apellidocasada
				from asesor where 
				idasesor = ".$_GET['paramas'];
				$result = mssql_query($sql); 
				while ($row = mssql_fetch_array ($result)) 
				{
				 $show_nomb = $row[0].' '.$row[1].' '.$row[2].' '.$row[3].' '.$row[4].' '.$row[5];
				}
// $sql = insert  into pregunta  variante values pregunta, examen 

// $sql= select idpregunta from pregunta where pregunta= $pregunta
//$result = mysql_query($sql);
//while ($row = mysql_fetch_array ($result);
//{
//insert into respuesta values (respuesta1, status, row[idpregunta];
//
//insert into respuesta values (respuesta2, status, row);
/*
$dia3 = (substr($row['fecha_nacimiento'],0,2));
$mes3 = (substr($row['fecha_nacimiento'],3,2));
$ano3 = (substr($row['fecha_nacimiento'],6,4));
*/


if ($_GET['val'] == 1) // realiza la insercion si agrega..
 {

  $hijos=1;
  $validos = 0;
  $invalidos = 0;
  for ($hijos =1; $hijos <= $_POST['numhi']; $hijos++) 
   { 
    if (!empty($_POST['dia3'.$hijos]) && !empty($_POST['mes3'.$hijos]) && !empty($_POST['ano3'.$hijos]) )
	{
//		envia_msg('fecha llena');
	 $fecha_nac = $_POST['mes3'.$hijos].'/'.$_POST['dia3'.$hijos].'/'.$_POST['ano3'.$hijos];
	}
	else
	 {
//	 		envia_msg('fecha vacia');
	 $fecha_nac = 'null';
	 }
	if ( empty($_POST['id_orden'.$hijos]) )
	 {
		$orden_ced = 'null';	  
	 }
	else
	 {
		 $orden_ced = $_POST['id_orden'.$hijos];	 
	 }

	if ( empty($_POST['registro_cedula'.$hijos]) )
	 {
		$reg_ced = 'null';	  
	 }
	else
	 {
		 $reg_ced = $_POST['registro_cedula'.$hijos];	 
	 }	 
/*	 envia_msg('PRIMER NOMBRE '.$_POST['primer_nombre'.$hijos]);
	 envia_msg('PRIMER APELLIDO '.$_POST['primer_apellido'.$hijos]);
 	 envia_msg('SEXO '.$_POST['sexo'.$hijos]);
  	 envia_msg('FECHA NAC '.$fecha_nac);
 	 envia_msg('valido '.$validos);
	 envia_msg('invalido '.$invalidos);*/

	if ( (!empty($_POST['primer_nombre'.$hijos])) && (!empty($_POST['primer_apellido'.$hijos] )) && (!empty($_POST['sexo'.$hijos] )) && ($fecha_nac != 'null' ) )
	 {
	 
	
		$sql = "insert into familiaridad
					(primer_nombre, segundo_nombre, tercer_nombre, primer_apellido, segundo_apellido, apellido_casada, id_orden_cedula, registro_cedula, sexo, 
					fecha_nacimiento, id_asesor, fecha_registro, id_parentesco) 
				values 
					('".$_POST['primer_nombre'.$hijos]."', '".$_POST['segundo_nombre'.$hijos]."', '".$_POST['tercer_nombre'.$hijos]."', '".$_POST['primer_apellido'.$hijos].
					"', '".$_POST['segundo_apellido'.$hijos]."', '".$_POST['apellido_casada'.$hijos]."', $orden_ced, $reg_ced, '".$_POST['sexo'.$hijos]."', '".$fecha_nac."',".$_GET['paramas'].", getdate(), 4 )";		
				$result = mssql_query($sql);
//		print $sql;
//		envia_msg('Total de Resultado'.mssql_num_rows($result));
		$rsRows = mssql_query("select @@rowcount as rows");
	    $rows = mssql_fetch_assoc($rsRows); 
//  	envia_msg( $rows['rows']);

	//	envia_msg(mssql_rows_affected($result) );
		if ( $rows['rows'] == 1 )
		 {
		  $validos = $validos + 1; 
//		  envia_msg('valido --'.$hijos);
//		  cambiar_ventana('actualiza_familia.php');
			 mssql_free_result($result);
		 }
		else
		 {
 		  $invalidos = $invalidos + 1;
//  		  envia_msg('invalido --'.$hijos);
//		  envia_msg('NO SE PUDO INGRESAR EL FAMILIAR '.$hijos);
		 }
		
		
	 } // fin 	if ( (!empty($primer_nombre.$hijos)) && (!empty($primer_apellido.$hijos == null)) && (!empty($sexo.$hijos == null)) && (!empty($fecha_nac == null)) )
   } // fin for   for ($hijos =1; $hijos <= $_GET['numhi']; $hijos++) 

	if ( $validos < $_POST['numhi'] )
	 {
	  $invalidos = $_POST['numhi'] - $validos;
	 }
  if ( $validos > 0 )
 	{
	  envia_msg($validos.' FAMILIARES INGRESADOS EXITOSAMENTE');
	}
 if ( $invalidos > 0 )
 	{
	  envia_msg($invalidos.' FAMILIARES NO FUERON INGRESADOS');
	}
 }	// fin if ($_GET['val'] == 1)
 
 
/*procedimiento de actulizar en el cual verifica si hay informacion de familiares para el empleado y los muestra*/ 
	$query = 'select id_familiaridad, primer_nombre, segundo_nombre, tercer_nombre, primer_apellido, segundo_apellido, apellido_casada, id_orden_cedula, registro_cedula, sexo, 
			 convert(varchar,fecha_nacimiento,105) fecha_nacimiento, id_asesor, fecha_registro, id_parentesco from familiaridad where id_asesor = '.$_GET['paramas'];
	$resel = mssql_query($query);
	$tot_cons = mssql_num_rows($resel);
	if (mssql_num_rows($result) > 0)
	 {   
	 	$actualiza = 1;
	 }
	else
	 {
 	 	$actualiza = 0;
	 }
 
 
?>
<script language="JavaScript">
	function Verifica()
	 {
/*		textoCampo = window.document.form1.cedula.value 
     	 textoCampo = validarEntero(textoCampo) 
     	 window.document.form1.cedula.value = textoCampo 

		textoCampo = window.document.form1.empadronamiento.value 
     	 textoCampo = validarEntero(textoCampo) 
     	 window.document.form1.empadronamiento.value = textoCampo 


		textoCampo = window.document.form1.dia3.value 
     	 textoCampo = validarEntero(textoCampo) 
     	 window.document.form1.dia3.value = textoCampo 
		
		textoCampo = window.document.form1.mes3.value 
     	 textoCampo = validarEntero(textoCampo) 
     	 window.document.form1.mes3.value = textoCampo 

		textoCampo = window.document.form1.ano3.value 
     	 textoCampo = validarEntero(textoCampo) 
     	 window.document.form1.ano3.value = textoCampo 

*/
//		if (form1.nombre.value == "" || form1.apellido.value == "" || form1.idregistro.value == "" || form1.cedula.value == "" || form1.iddepartamento.value == "" || form1.usuario.value = "" || form1.password.value == "" || form1.iddepartamento2 == value ""  )
/*		if (form1.nombre.value == "" || form1.apellido.value == "" || form1.cedula.value == "" || form1.iddepartamento.value == "" || form1.dia3.value == "" || form1.mes3.value == ""  || form1.ano3.value == "")
			{
				alert('Por favor llene los campos requeridos **');
				return false
			}

		if (form1.usuario.value == "" || form1.sexo.value == "")
			{
				alert('Por favor llene los campos requeridos **');
				return false
			}

		if (form1.password.value == "")
			{
				alert('Por favor llene los campos requeridos **');
				return false
			}

		if (form1.tema2.value == "")
			{
				alert('Por favor llene los campos requeridos **');
				return false
			}*/
//	|| form1.idmunicipio.value == ""
	//	|| form1.idmunicipio_reside == value ""
		}
 

function validarEntero(numero){ 
      //Compruebo si es un valor num�rico 
      if (isNaN(numero)) { 
            //entonces (no es numero) devuelvo el valor cadena vacia 
            alert("Solo puede ingresar numeros en el campo");
			return ""
//   		    document.numeros.numero.focus();
      }else{ 
            //En caso contrario (Si era un número) devuelvo el valor 
            return numero
           // document.numeros.numero.focus();
      } 
}
</script>

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
/*body {
	background-image: url(Fondo%20de%20Fiesta.jpg);
}*/
.Estilo28 {font-size: 12px}
.Estilo67 {font-size: 9px}
.Estilo69 {font-family: Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; }
-->
</style>


</head>

<body>
<table border="0" width="100%" class="Estilo1 Estilo18">
	<tr>
		<td align="left" bgcolor="#990000" width="15%" >
		<strong><font color="#FFFFFF" size="-1"><? print 'Usuario: '.$_SESSION['user']; ?></font></strong>
		</td>
		<td align="right"  width="70%">
		<a href="../../visita.php"><!--img src="tareas.gif" width="16" height="16" border="0"-->[ <-- Regresar al Menu ]</a>
		</td>
		<!--td align="right" >
		<a href="../../mtlogin.php"><!--img src="tareas.gif" width="16" height="16" border="0">[ Cerrar Sesión ]</a>
		</td-->

	</tr>
</table>
<form name="form1" method="POST" action="actualiza_familia.php?val=1&numhi=<? echo $_GET['numhi']; ?>&paramas=<? echo $_GET['paramas']; ?>" onSubmit="return Verifica()">
<!--form name="form1" method="post" action="asesoringreso.php"-->
  <table width="91%"  border="0" align="center">

    <tr>
      <!--th width="83%" scope="col">&nbsp;</th-->
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
      </span>Ministerio de Econom�a de Guatemala </span></th>
    </tr>
  </table>
  <p class="Estilo8 Estilo7"></p>
  <table width="800" border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="13"><div align="center"><span class="Estilo1 Estilo2">Datos Personales de Familiares</span></div></td>
    </tr>
	<tr bgcolor="#99CCFF"><td colspan="13" align="center"  class="Estilo1 estilo3" ><strong><? echo $show_nomb; ?></strong></td></tr>
  <tr>
    <td><span class="Estilo67"><font color="#6699FF" face="Arial, Helvetica, sans-serif">Fecha</font></span></td>
    <td> <span class="Estilo67">
	<font face="Arial, Helvetica, sans-serif">
	<? echo'<font color="#003399"><strong>'.date("d")."/".date("m")."/".date("Y").'</strong></font>'; ?> 
	<? echo'<font color="#003399"><strong>'.$hora.'</strong></font>'; ?>	</font></span></td>
    </tr>&nbsp;</td>
    <!--td colspan="2">&nbsp;</td>
    <td colspan="-1">&nbsp;</td-->
  </tr>
  
<? if ($_GET['numhi'] > 0) 
	{  ?>
<tr class="Estilo22" >
	<!--td class="Estilo7" align='center'>No.</td-->
	<td class="Estilo7" align="center">1er. Nombre<font color="#FF0000">**</font></td>
	<td class="Estilo7" align="center">2do. Nombre</td>
	<td class="Estilo7" align="center">3er. Nombre</td>	
	<td class="Estilo7" align="center">1er. Apellido<font color="#FF0000">**</font></td>
	<td class="Estilo7" align="center">2do. Apellido</td>
	<td class="Estilo7" align="center">Apellido Casada</td>
	<td class="Estilo7" align="center">Sexo<font color="#FF0000">**</font></td>
	<td class="Estilo7" align="center" colspan="3">Fecha Nacimiento<font color="#FF0000">**</font></td>
	<td class="Estilo7" align="center">No. Orden</td>
	<td class="Estilo7" align="center">Registro</td>		
</tr>
<?	
	if ($tot_cons > 0)
	 {
		while ($row = mssql_fetch_array($resel))
		 { ?>
  			<tr class="Estilo1">
					<input type="hidden" size="10" maxlength="10" value="<?  echo $row['id_familiaridad']; ?>" disabled>
				<Td>
					<input type="text" size="15" maxlength="20" value="<?  echo $row['primer_nombre']; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" disabled>
				</td>
				<td>
					<input type="text" size="15" maxlength="20" value="<?  echo $row['segundo_nombre']; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" disabled>
				</Td>
				<td>
					<input type="text" size="15" maxlength="20" value="<?  echo $row['tercer_nombre']; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" disabled>
				</Td>
				<td>
					<input type="text" size="15" maxlength="20" value="<?  echo $row['primer_apellido']; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" disabled>
				</Td>
				<td>
					<input type="text" size="15" maxlength="20" value="<?  echo $row['segundo_apellido']; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" disabled>
				</Td>
				<td>
					<input type="text" size="15" maxlength="20" value="<?  echo $row['apellido_casada']; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" disabled>
				</Td>
				<td>
					<input type="text" size="2" maxlength="2" value="<?  echo $row['sexo']; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" disabled>
				</Td>
				<td>
					<input type="text" size="2" maxlength="2" value="<?  echo substr($row['fecha_nacimiento'],0,2); ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" disabled>
				</Td>
				<td>
					<input type="text" size="2" maxlength="2" value="<?  echo substr($row['fecha_nacimiento'],3,2); ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" disabled>
				</Td>
				<td>
					<input type="text" size="4" maxlength="4" value="<?  echo substr($row['fecha_nacimiento'],6,4); ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" disabled>
				</Td>
				<td>
					  <?
						$dbms->sql="select idregistro,registro from asesor_registro"; 
						$dbms->Query(); 
						while($Fields=$dbms->MoveNext()) 
						 {
						  if ( $Fields["idregistro"] == $row['id_orden_cedula']) 
							{
/*							 print "<option value=\"".$Fields["idregistro"]."\" selected>".$Fields["registro"]."</option>"; */ ?>
 		 					 <input type="text" size="2" maxlength="4" value="<? echo $Fields['registro'] ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" disabled>
<?							}
						 }
					?>
				</Td>
				<td>
					<input type="text" size="8" maxlength="10" value="<?  echo $row['registro_cedula']; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" disabled>
				</Td>
				<td><a href="mod_familia.php?id=<?  echo $row['id_familiaridad']; ?>&paramas=<? echo $_GET['paramas']; ?>&numhi=<? echo $_GET['numhi']; ?>" target="_self"><img src="b_edit.png" border="0" width="15" height="15" alt="Editar Registro" ></a>
				</td>
			</tr>
<?		 }
	}
	$hijos = 1;
    for ($hijos =1; $hijos <= $_GET['numhi']-$tot_cons; $hijos++) 
	  { ?>
<tr class="Estilo1">
	<!--td-->
	<input type="hidden" name="id<? echo $hijos; ?>" size="2" maxlength="2" value="<? echo $hijos; ?>" disabled>
	<!--/td-->
	<td>
	<input type="text" name="primer_nombre<? echo $hijos; ?>" size="15" maxlength="20" onKeyUp="javascript:this.value=this.value.toUpperCase();">
	</td>
	<td>
	<input type="text" name="segundo_nombre<? echo $hijos; ?>" size="15" maxlength="20" onKeyUp="javascript:this.value=this.value.toUpperCase();">
	</td>
	<td>
	<input type="text" name="tercer_nombre<? echo $hijos; ?>" size="15" maxlength="20" onKeyUp="javascript:this.value=this.value.toUpperCase();">
	</td>
	<td>
	<input type="text" name="primer_apellido<? echo $hijos; ?>" size="15" maxlength="20" onKeyUp="javascript:this.value=this.value.toUpperCase();">
	</td>
	<td>
	<input type="text" name="segundo_apellido<? echo $hijos; ?>" size="15" maxlength="20" onKeyUp="javascript:this.value=this.value.toUpperCase();">
	</td>
	<td>
	<input type="text" name="apellido_casada<? echo $hijos; ?>" size="15" maxlength="20" onKeyUp="javascript:this.value=this.value.toUpperCase();">
	</td>
	<td><span class="Estilo22">
	<select name="sexo<? echo $hijos; ?>">
		<option></option>
		<option value="M">M</option>
		<option value="F">F</option>
	</select>
	</span></td>

<td>
<select name="dia3<? echo $hijos; ?>" class="Estilo1">
<option></option>
	<?
	$i=1;
	 while ($i<=31)
	  {
	    if ($dia3 == $i)
			{
	  ?>			
			<option value="<? if ($i < 10) { echo '0'.$i; } else { echo $i; } ?>" selected><? echo $i; ?></option>
	  <?	}
		else 
			{
	  ?>			
			<option value="<? if ($i < 10) { echo '0'.$i; } else { echo $i; } ?>"><? echo $i; ?></option>			
	<?		}
		$i++;
	 }
	?>
</select>	 
</Td>
<Td>
<select name="mes3<? echo $hijos; ?>" class="Estilo1">
<option></option>
	<?
	$i=1;
	 while ($i<=12)
	  {
	  if ($mes3 == $i)
			{
	  ?>			
			<option value="<? if ($i < 10) { echo '0'.$i; } else { echo $i; } ?>" selected><? echo $i; ?></option>
	  <?	}
		else 
			{
	  ?>			
			<option value="<? if ($i < 10) { echo '0'.$i; } else { echo $i; } ?>"><? echo $i; ?></option>			
	<?		}
		$i++;
	 }
	 
	?>
</select>   
</Td><td>
<!--input name="ano3" type="text" class="Estilo1" id="ano3" size="4" maxlength="4" value="<? //print $ano3;  ?>"--> 
<select name="ano3<? echo $hijos; ?>" class="Estilo1">
<option></option>
	<?
	$i=1920;
	 while ($i<=date('Y'))
	  {
		 if ($ano3 == $i)
			{
	  ?>			
			<option value="<? echo $i; ?>" selected><? echo $i; ?></option>
	  <?	}
		else 
			{
	  ?>			
			<option value="<? echo $i; ?>"><? echo $i; ?></option>			
	<?		}
		$i++;
	 }
	 
	?>
</select> 
</td> 
   <td class="Estilo7"><span class="Estilo22">

<select name="id_orden<? echo $hijos; ?>"  class="Estilo7" size="1" value="<? print $row['idregistro'];  ?>">
<option></option>
  <?
	$dbms->sql="select idregistro,registro from asesor_registro"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idregistro"]."\">".$Fields["registro"]."</option>"; 
	}
?>
</select>
</td>
<td><input name="registro_cedula<? echo $hijos; ?>" type="text" class="Estilo7" id="cedula" size="8" maxlength="10"></td>
 <? } // fin for 
  } // fin if?>
</tr>



</table>
<table width="77%"  border="0" align="center">
  <tr>
    <th width="43%" scope="row">&nbsp;</th>
    <td width="31%"><div align="right"><span class="Estilo1 Estilo6"><font color="#FF0000">** Campos Requeridos</font>

		<input type="hidden" name="paramas" value="<? print $_GET['paramas'];?>">
		<input type="hidden" name="numhi" value="<? print $_GET['numhi'] - $tot_cons;?>">
<? // proceso si va a ser actualizacion
	if ( $actualiza == 1 )
	{
?>
		<input type="hidden" name="actualiza" value="<? print $_GET['numhi']; ?> ">
<?
	}
	
	if ($tot_cons < $_GET['numhi'])
	 {
?>		
        <input type="submit" name="Submit" value="Actualizar">
<?   } ?>
      <!--img src="images/flecha4.JPG" width="43" height="39"--> </span></div></td>
  </tr>
</table>
<div align="center"></div><font color="#990000">
<p class="Estilo1">Favor revisar los datos antes de ser enviados. </p>
<p class="Estilo1">Toda la  informaci&oacute;n proporcionada, ser&aacute; utilizada &uacute;nica y exclusivamente para registro del Ministerio de Econom&iacute;a.</p>
<p align="center" class="Estilo1 Estilo6">&nbsp;</p></font>
</form>
<?

//	}//finalizacion while del query principal
//}//finalizacion de if de hasta arriba

?>
<script type="text/javascript"> 
var peticion = false; 
var  testPasado = false; 
try { 
  peticion = new XMLHttpRequest(); 
  } catch (trymicrosoft) { 
  try { 
  peticion = new ActiveXObject("Msxml2.XMLHTTP"); 
  } catch (othermicrosoft) { 
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
    element.innerHTML = '<img src="../../../Imagenes/loading.gif" />'; 
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

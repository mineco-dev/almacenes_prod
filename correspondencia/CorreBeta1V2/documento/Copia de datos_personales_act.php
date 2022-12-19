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

/*	if ( $sstipo != 1) // valida que sea un usuario administrador
	{
	 cambiar_ventana('../../mtlogin.php');
	}*/
//envia_msg($sstipo);
	if ( $sstipo != 1) // valida que sea un usuario administrador
	{
	  if ($_SESSION['idempleado'] != $_GET['paramas'])
	   {
	   	 envia_msg('Usted solo puede modificar sus datos personales.');
	   	 cambiar_ventana('../../mtlogin.php');
	   }
	}

	include('../../INCLUDES/inc_header.inc');
	$dbms=new DBMS($conexion); 

if ($_GET['paramas'] != null) 
	{

//print $_GET[$id_puesto];
//envia_msg("aqui va el puesto");
//envia_msg($id_puesto);

//print $_GET[$id_puesto1];
//envia_msg("aqui va el puesto funcional");
//envia_msg($id_puesto1);

		$sql = "select nombre, nombre2, nombre3, apellido, apellido2, apellidocasada, estadocivil, edad, sexo, nit, igss, empadronamiento, 
					gruposanguineo, idregistro, cedula, userfile, idmunicipio_nac, iddepartamento_nac, licencia, tipolicencia, idgrupoetnico, 
					calle, numero, zona, colonia, nacionalidad, telefonocasa, telefonocelular, correo, direccion_para_notificaciones, id_puesto, userfile2, 
					reglon, partida, iddireccion, CONVERT(varchar,fecha_nacimiento,105) fecha_nacimiento, idmunicipio_reside, iddepartamento_reside,usuario,password,extension,habilitado,fecha_creacion,
					usuario_creacion,idtipousuario,gafete, sueldo, hijos, id_puesto1, convert(varchar, fecha_ingreso, 105) fecha_ingreso
				from asesor where 
				idasesor = $_GET[paramas]";
				$result = mssql_query($sql); 
				while ($row = mssql_fetch_array ($result)) 
				{
//convert varchar 105
// $sql = insert  into pregunta  variante values pregunta, examen 

// $sql= select idpregunta from pregunta where pregunta= $pregunta
//$result = mysql_query($sql);
//while ($row = mysql_fetch_array ($result);
//{
//insert into respuesta values (respuesta1, status, row[idpregunta];
//
//insert into respuesta values (respuesta2, status, row);

//$fechaingreso=substr($date9,3,2)."/".substr($date9,0,2)."/".substr($date9,6,4);
//$fechaingreso=substr($row['fecha_ingreso'],3,3)."/".substr($row['fecha_ingreso'],6,3)."/".substr($row['fecha_ingreso'],6,5);

$dia3 = (substr($row['fecha_nacimiento'],0,2));
$mes3 = (substr($row['fecha_nacimiento'],3,2));
$ano3 = (substr($row['fecha_nacimiento'],6,4));

$diai = (substr($row['fecha_ingreso'],0,2));
$mesi = (substr($row['fecha_ingreso'],3,2));
$anoi = (substr($row['fecha_ingreso'],6,4));

//$cadfe = $dia3.'/'.$mes3.'/'.$ano3;
//envia_msg($cadfe);
//  alert("'.$dia3.'"/"'.$mes3.'"/"'.$ano3.'")
/*echo '<script language="JavaScript">
 var varfe = "'.$cadfe.'";
//alert(varfe)
	alert(calcular_edad(varfe));
 window.document.form1.edad.value = calcular_edad(varfe);
 
   </script>';*/
?>
<script language="JavaScript">
//alert('a')
//	  alert(window.document.form1.dia3.value+'/'+window.document.form1.mes3.value+'/'+window.document.form1.ano3.value)	

	function Verifica()
	 {

		comprueba_extension(window.document.form1, window.document.form1.userfilefoto.value)
//	  alert(calcular_edad(window.document.form1.dia3.value+'-'+window.document.form1.mes3.value+'-'+window.document.form1.ano3.value)
	 
		textoCampo = window.document.form1.cedula.value 
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


//		if (form1.nombre.value == "" || form1.apellido.value == "" || form1.idregistro.value == "" || form1.cedula.value == "" || form1.iddepartamento.value == "" || form1.usuario.value = "" || form1.password.value == "" || form1.iddepartamento2 == value ""  )
		if (form1.nombre.value == "" || form1.apellido.value == "" || form1.cedula.value == "" || form1.iddepartamento.value == "" || form1.dia3.value == "" || form1.mes3.value == ""  || form1.ano3.value == "")
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
			}
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



//calcular la edad de una persona 
//recibe la fecha como un string en formato espa�ol 
//devuelve un entero con la edad. Devuelve false en caso de que la fecha sea incorrecta o mayor que el dia actual 
function calcular_edad(fecha){ 

    //calculo la fecha de hoy 
    hoy=new Date() 
    //alert(hoy) 

    //calculo la fecha que recibo 
    //La descompongo en un array 
    var array_fecha = fecha.split("/") 
    //si el array no tiene tres partes, la fecha es incorrecta 
    if (array_fecha.length!=3) 
       return false 

    //compruebo que los ano, mes, dia son correctos 
    var ano 
    ano = parseInt(array_fecha[2]); 
    if (isNaN(ano)) 
       return false 

    var mes 
    mes = parseInt(array_fecha[1]); 
    if (isNaN(mes)) 
       return false 

    var dia 
    dia = parseInt(array_fecha[0]); 
    if (isNaN(dia)) 
       return false 


    //si el a�o de la fecha que recibo solo tiene 2 cifras hay que cambiarlo a 4 
    if (ano<=99) 
       ano +=1900 

    //resto los a�os de las dos fechas 
    edad=hoy.getYear()- ano - 1; //-1 porque no se si ha cumplido a�os ya este a�o 

    //si resto los meses y me da menor que 0 entonces no ha cumplido a�os. Si da mayor si ha cumplido 
    if (hoy.getMonth() + 1 - mes < 0) //+ 1 porque los meses empiezan en 0 
       return edad 
    if (hoy.getMonth() + 1 - mes > 0) 
       return edad+1 

    //entonces es que eran iguales. miro los dias 
    //si resto los dias y me da menor que 0 entonces no ha cumplido a�os. Si da mayor o igual si ha cumplido 
    if (hoy.getUTCDate() - dia >= 0) 
       return edad + 1 

	
    return edad 
} 


function comprueba_extension(formulario, archivo) { 
   extensiones_permitidas = new Array(".gif", ".jpg",".png"); 
   mierror = ""; 
   if (!archivo) { 
      //Si no tengo archivo, es que no se ha seleccionado un archivo en el formulario 
       mierror = "No has seleccionado ning�n archivo"; 
   }else{ 
      //recupero la extensión de este nombre de archivo 
      extension = (archivo.substring(archivo.lastIndexOf("."))).toLowerCase(); 
      //alert (extension); 
      //compruebo si la extensión está entre las permitidas 
      permitida = false; 
      for (var i = 0; i < extensiones_permitidas.length; i++) { 
         if (extensiones_permitidas[i] == extension) { 
         permitida = true; 
         break; 
         } 
      } 
      if (!permitida) { 
         mierror = "Comprueba la extensión de los archivos a subir. \nS�lo se pueden subir archivos con extensiones: " + extensiones_permitidas.join(); 
       }else{ 
          //submito! 
//         alert ("Todo correcto. Voy a submitir el formulario."); 
         formulario.submit(); 
         return true 
       } 
   } 
   //si estoy aqui es que no se ha podido submitir 
   alert (mierror); 
   return false
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
		<!---td align="right" >
		<a href="../../mtlogin.php"><!--img src="tareas.gif" width="16" height="16" border="0"--><!--[ Cerrar Sesión ]</a>
		</td-->

	</tr>
</table>
<form name="form1" method="post" action="asesor_update.php" onSubmit="return Verifica()" enctype="multipart/form-data">
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
    <!--tr>
      <th colspan="2" class="Estilo13" scope="row"><span class="Estilo46">Ministerio de Econom&iacute;a de Guatemala</span></th>
    </tr-->
    <tr>
      <th class="Estilo13" scope="row">
	  <input type="hidden" name="MAX_FILE_SIZE" value="100000000">
	  <input type="hidden" name="MAX_FILE_SIZE2" value="100000000">
	  </th>
      <!--td class="Estilo13">&nbsp;</td-->
    </tr>
    <!--tr>
      <td class="Estilo13" colspan="2"><div align="center"><span class="Estilo61">Curriculum</span></div></td>
    </tr-->
  </table>
  <p class="Estilo8 Estilo7"></p>
  <table width="800" border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">
    <td colspan="7"><div align="center"><span class="Estilo1 Estilo2">Actualizaci&oacute;n de Datos Personales </span></div></td>
    </tr>
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
  <tr>
    <td width="111">&nbsp;</td>
    <td width="233">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
    <td width="299" colspan="-1">&nbsp;</td>
  </tr>
  <tr class="Estilo1">
    <td class="Estilo22">Primer Nombre<font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7"><input name="nombre" type="text" class="Estilo7" id="nombre" size="30" value="<? print $row['nombre'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Segundo Nombre </div></td>
    <td colspan="-1"><input name="nombre2" type="text" class="Estilo7" id="nombre2" size="30" value="<? print $row['nombre2'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">      <span class="Estilo6">      </span></td>
  </tr>
  <tr class="Estilo7">
    <td class="Estilo7"><span class="Estilo22">Tercer  Nombre</span></td>
    <td class="Estilo7"><input name="nombre3" type="text" class="Estilo7" id="nombre3" size="30" value="<? print $row['nombre3'];  ?>"  onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>

    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Primer Apellido<font color="#FF0000"><strong>**</strong></font></div></td>
    <td colspan="-1"><input name="apellido" type="text" class="Estilo7" id="apellido" size="30" value="<? print $row['apellido'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
  </tr>
  <tr class="Estilo7">
    <td class="Estilo7"><span class="Estilo22">Segundo Apellido</span></td>
    <td class="Estilo7"><input name="apellido2" type="text" class="Estilo7" id="apellido2" size="30"  value="<? print $row['apellido2'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
    <td colspan="2" class="Estilo7"><div align="right"><span class="Estilo22">Apellido de Casada</span></div></td>
    <td colspan="5" class="Estilo7"><input name="apellidocasada" type="text" class="Estilo7" id="apellidocasada" size="30" value="<? print $row['apellidocasada'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
  </tr>
  <tr class="Estilo7">
    <td class="Estilo7"><span class="Estilo22">Estado Civil</span></td>
    <td class="Estilo7"><span class="Estilo22">

<select name="estadocivil" id="estadocivil">
	<?  if ($row['estadocivil'] == 'S' ) 
			{
	?>

				 <option value="S" selected>SOLTERO </option>
                  <option value="C">CASADO </option>
                  <option value="V">VIUDO </option>
                  <option value="D">DIVORCIADO </option>

                 
<?
			}
		elseif ($row['estadocivil'] == 'C' )
{

?>
                 

				 <option value="S">SOLTERO </option>
                  <option value="C" selected>CASADO </option>
                  <option value="V">VIUDO </option>
                  <option value="D">DIVORCIADO </option>


<?
			}
		elseif ($row['estadocivil'] == 'V' )
{

?>

				 <option value="S">SOLTERO </option>
                  <option value="C">CASADO </option>
                  <option value="V" selected>VIUDO </option>
                  <option value="D">DIVORCIADO </option>

<?
			}
		
		else
{
?>
				<option value="S">SOLTERO </option>
                  <option value="C">CASADO </option>
                  <option value="V">VIUDO </option>
                  <option value="D" selected>DIVORCIADO </option>

                 
                 
		<?				}	?>


</select>



    </span></td>

    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Fecha nacimiento<font color="#FF0000"><strong>**</strong></font></div></td>
    <td colspan="5" class="Estilo7"><span class="Estilo22">

d�a

	 <!--input name="dia3" type="text" class="Estilo1" id="dia3" maxlength="2"  size="2" value="<? //print $dia3;  ?>"-->
<select name="dia3" class="Estilo1">
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
mes
	<!--input name="mes3" type="text" class="Estilo1" id="mes3" size="2" maxlength="2" value="<? //print $mes3;  ?>"-->    
<select name="mes3" class="Estilo1">
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
a&ntilde;o
<!--input name="ano3" type="text" class="Estilo1" id="ano3" size="4" maxlength="4" value="<? //print $ano3;  ?>"--> 
<select name="ano3" class="Estilo1">
	<?
	$i=1920;
	 while ($i<=date('Y')-18)
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


<?php
//$fecha_nac ="1981/06/01";

//$dia=17;
//$mes=10;
//$anno=1981;
//$fecha_nac = $anno.$mes.$dia;

//print $_POST[$dia3];
//envia_msg("aqui va el dia");
//envia_msg($dia3);

//print $_POST[$mes3];
//envia_msg("aqui va el mes");
//envia_msg($mes3);

//print $_POST[$ano3];
//envia_msg("aqui va el a�o");
//envia_msg($ano3);

$fecha_nacimiento = $ano3.'/'.$mes3.'/'.$dia3;
function edad($fecha_nacimiento){
$dia3=date("j");
$mes3=date("n");
$ano3=date("Y");
$dia_nac=substr($fecha_nacimiento, 8, 2);
$mes_nac=substr($fecha_nacimiento, 5, 2);
$anno_nac=substr($fecha_nacimiento, 0, 4);
if($mes_nac>$mes3){
$calc_edad= $ano3-$anno_nac-1;
}else{
if($mes3==$mes_nac AND $dia_nac>$dia3){
$calc_edad= $ano3-$anno_nac-1; 
}else{
$calc_edad= $ano3-$anno_nac;
}
}
return $calc_edad;
}
//echo $calc_edad;
/*$prueba= 'resultado';
$prueba1 = 3;
$prueba2 = $prueba.$prueba1;

envia_msg("aqui va la fecha nacimiento");
envia_msg($fecha_nac);*/
?>

Edad <input name="edad" id="edad"  type="text" disabled size="2" value="<? echo edad($fecha_nacimiento); ?>" >
<!--onClick="return calcular_edad(window.document.form1.dia3.value+'-'+window.document.form1.mes3.value+'-'+window.document.form1.ano3.value)"-->
 
<!--input name="edad" type="text" id="nacimiento" size="5"--> </span></td> 
</tr>
<tr class="Estilo1">
<td><span class="Estilo22">Sexo:<font color="#FF0000"><strong>**</strong></font></span> </td>
<td><span class="Estilo22">
<?  if ($row['sexo'] == 'M' ) 
		{
?>		M<input name="sexo" type="radio" value="M" checked> 
		F<input name="sexo" type="radio" value="F">
<?		}
	else
		{
?>		M<input name="sexo" type="radio" value="M"> 
		F<input name="sexo" type="radio" value="F" checked>
<? 		}
?>
</span></td>
<td class="Estilo7" align="right" colspan="2">Hijos</td>
<td>
<input type="text" name="hijos" size="2" maxlength="2" value="<? if ( $row['hijos'] > 0) { echo $row['hijos']; } else { echo '0'; } ?>">&nbsp;&nbsp;&nbsp;&nbsp;<? if ( $row['hijos'] > 0) { ?> <a href="actualiza_familia.php?paramas=<? echo $_GET['paramas']; ?>&numhi=<? echo $row['hijos']; ?>" target="_self"><font color='#FF0000'><strong> Actualizar Familiaridad</strong></font></a><? } ?>
</td>
  </tr>
 

<tr class="Estilo1">
    <td class="Estilo22">NIT</td>
    <td class="Estilo7">
      <input name="nit" type="text" class="Estilo7" id="nit" size="30" value="<? print $row['nit'];  ?>"  onKeyUp="javascript:this.value=this.value.toUpperCase();"></td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Igss</div></td>
    <td colspan="-1"><input name="igss" type="text" class="Estilo1" id="igss" size="30" value="<? print $row['igss'];  ?>">
      <span class="Estilo6">      </span></td>
  </tr>



<tr class="Estilo1">
    <td class="Estilo22">Empadronamiento</td>
    <td class="Estilo7">
      <input name="empadronamiento" type="text" class="Estilo7" id="empadronamiento" size="30" value="<? print $row['empadronamiento'];  ?>"></td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Grupo Sanguineo </div></td>
    <td colspan="-1">

<select name="gruposanguineo" id="gruposanguineo" >
	<?  if ($row['gruposanguineo'] == 'AB+' ) 
			{
	?>

                 <option value="AB+" selected>AB+ </option>
                  <option value="AB-">AB-</option>
                  <option value="A+">A+ </option>
                  <option value="A-">A- </option>
                  <option value="B+">B+ </option>
                  <option value="B-">B- </option>
                  <option value="O+">O+ </option>
                  <option value="O-">O- </option>
                 
<?
			}
		elseif ($row['gruposanguineo'] == 'AB-' )
{

?>
                 <option value="AB+">AB+ </option>
                  <option value="AB-" selected>AB-</option>
                  <option value="A+">A+ </option>
                  <option value="A-">A- </option>
                  <option value="B+">B+ </option>
                  <option value="B-">B- </option>
                  <option value="O+">O+ </option>
                  <option value="O-">O- </option>
                 


<?
			}
		elseif ($row['gruposanguineo'] == 'A+' )
{

?>
                 <option value="AB+">AB+ </option>
                  <option value="AB-">AB-</option>
                  <option value="A+" selected>A+ </option>
                  <option value="A-">A- </option>
                  <option value="B+">B+ </option>
                  <option value="B-">B- </option>
                  <option value="O+">O+ </option>
                  <option value="O-">O- </option>

<?
			}
		elseif ($row['gruposanguineo'] == 'A-' )
{

?>
                 <option value="AB+">AB+ </option>
                  <option value="AB-">AB-</option>
                  <option value="A+">A+ </option>
                  <option value="A-" selected>A- </option>
                  <option value="B+">B+ </option>
                  <option value="B-">B- </option>
                  <option value="O+">O+ </option>
                  <option value="O-">O- </option>


<?
			}
		elseif ($row['gruposanguineo'] == 'B+' )
{

?>
                 <option value="AB+">AB+ </option>
                  <option value="AB-">AB-</option>
                  <option value="A+">A+ </option>
                  <option value="A-">A- </option>
                  <option value="B+" selected>B+ </option>
                  <option value="B-">B- </option>
                  <option value="O+">O+ </option>
                  <option value="O-">O- </option>


<?
			}
		elseif ($row['gruposanguineo'] == 'B-' )
{

?>
                 <option value="AB+">AB+ </option>
                  <option value="AB-">AB-</option>
                  <option value="A+">A+ </option>
                  <option value="A-">A- </option>
                  <option value="B+">B+ </option>
                  <option value="B-" selected>B- </option>
                  <option value="O+">O+ </option>
                  <option value="O-">O- </option>


<?
			}
		elseif ($row['gruposanguineo'] == 'O+' )
{

?>
                 <option value="AB+">AB+ </option>
                  <option value="AB-">AB-</option>
                  <option value="A+">A+ </option>
                  <option value="A-">A- </option>
                  <option value="B+">B+ </option>
                  <option value="B-">B- </option>
                  <option value="O+" selected>O+ </option>
                  <option value="O-">O- </option>


<?
			}
		//elseif  ($row['tipolicencia'] == 1 ) 
		else
{
?>

                 <option value="AB+">AB+ </option>
                  <option value="AB-">AB-</option>
                  <option value="A+">A+ </option>
                  <option value="A-">A- </option>
                  <option value="B+">B+ </option>
                  <option value="B-">B- </option>
                  <option value="O+">O+ </option>
                  <option value="O-" selected>O- </option>
                 
		<?				}	?>

                  
        </select>


				
<!--input name="gruposanguineo" type="text" class="Estilo1" id="gruposanguineo" size="30"-->
      <span class="Estilo6">      </span></td>
  </tr>
  <tr class="Estilo7">
    <td class="Estilo7"><span class="Estilo22">C&eacute;dula de Vecindad</span></td></tr>
  <tr class="Estilo7">
    <td class="Estilo7"><span class="Estilo22">Registro<font color="#FF0000"><strong>**</strong></font></span></td>
     <td class="Estilo7"><span class="Estilo22">

<select name="idregistro" id="idregistro" class="Estilo7" size="1" value="<? print $row['idregistro'];  ?>">
  <?
	$dbms->sql="select idregistro,registro from asesor_registro"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idregistro"]."\">".$Fields["registro"]."</option>"; 
	}
?>
</select>
N&uacute;mero<font color="#FF0000"><strong>**</strong></font>
<input name="cedula" type="text" class="Estilo7" id="cedula" size="6" value="<? print $row['cedula'];  ?>"></span></td>

     <!--td colspan="2" class="Estilo7"><div align="right" class="Estilo22">
adjunte copia de C&eacute;dula</div>
</span></td><td c><span class="Estilo22"><input name="userfile" type="file" id="userfile" size="30" value="<? //print $row['userfile'];  ?>">
    </span></td>
    <td width="5" colspan="-1"><span class="Estilo22"></span></td>
  </tr-->

<tr class="Estilo1">
    <td class="Estilo22">Departamento<font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7">
	<div align="left">
		  

		<select name="iddepartamento" class="TituloMedios" id="iddepartamento"  onChange="javascript:cargarCombo('../../subactividades.php', 'iddepartamento', 'Div_Subactividades')">
          <option value=''> Seleccione </option>
          <? 
				$dbms->sql="select iddepartamento,nombre_departamento from asesor_departamento"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					if ($row['iddepartamento_nac'] == $Fields["iddepartamento"])
					 {
						print "<option value=\"".$Fields["iddepartamento"]."\" selected>".$Fields["nombre_departamento"]."</option>"; 
					 }
					else 
					 {
						print "<option value=\"".$Fields["iddepartamento"]."\">".$Fields["nombre_departamento"]."</option>"; 
					 }
				}
			?>
        </select>

		</span></span> </div>
	
	</td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Municipio<font color="#FF0000"><strong>**</strong></font></div></td>
    <td colspan="-1">      
	<span class="Estilo6">      
		<div align="left">
		  <div id="Div_Subactividades"> 
				<label for="SubActividad"></label> 
                <select name="idmunicipio"  id="idmunicipio" class="TituloMedios">
 <option value=''> Seleccione </option>
          <? 
				$dbms->sql="select idmunicipio,nombre_municipio from asesor_municipio where iddepartamento =".$row['iddepartamento_nac']; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					if ($row['idmunicipio_nac'] == $Fields["idmunicipio"])
					 {
						print "<option value=\"".$Fields["idmunicipio"]."\" selected>".$Fields["nombre_municipio"]."</option>"; 
					 }
					else 
					 {
						print "<option value=\"".$Fields["idmunicipio"]."\">".$Fields["nombre_municipio"]."</option>"; 
					 }
				}
			?>
            </select>
</div>
        </div>
	</span>
	</td>
  </tr>

<tr class="Estilo1">
    <td class="Estilo22">Numero de Licencia </td>
    <td class="Estilo7">
      <input name="licencia" type="text" class="Estilo7" id="licencia" size="30" value="<? print $row['licencia'];  ?>"></td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Tipo licencia </div></td>
    <td colspan="-1">

<select name="tipolicencia" id="tipolicencia" >
           <option></option>
	<?  if ($row['tipolicencia'] == 'A' ) 
			{
	?> 
                  <option value="A" selected>A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>

                 
<?
			}
		elseif ($row['tipolicencia'] == 'B' )
{

?>
                  <option value="A">A</option>
                  <option value="B" selected>B</option>
                  <option value="C">C</option>
                 

<?
			}
		//elseif  ($row['tipolicencia'] == 1 ) 
			elseif ($row['tipolicencia'] == 'C' )
{
?>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C" selected>C</option>
		<?				}	
           else
{
?>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="C">C</option>
                 
		<?				}	?>
        </select>

<!--input name="tipolicencia" type="text" class="Estilo1" id="tipolicencia" size="30"-->

      <span class="Estilo22">    Grupo Etnico</span>
      <select name="idgrupoetnico" id="idgrupoetnico" class="Estilo7" size="1" value="<? print $row['idgrupoetnico'];  ?>">
        <?
	$dbms->sql="select idgrupoetnico,grupoetnico from asesor_grupoetnico order by 2"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{
		print "<option value=\"".$Fields["idgrupoetnico"]."\">".$Fields["grupoetnico"]."</option>"; 
	}
?>
      </select>      <span class="Estilo6">      </span></td>
  </tr>
  <Tr>
  <td class="Estilo1">Estatus de Usuario</td>
  <td class="Estilo1"><select name="estatus">
  <? if ($row['habilitado'] == 'Y') { ?>
      <option value="Y" selected>Activo</option>
      <option value="N">Inactivo</option>
  <? $mensag = '  Si puede utilizar el sistema'; }
    else { ?>
	  <option value="Y">Activo</option>
      <option value="N"  selected>Inactivo</option>
  <? $mensag = '  No puede utilizar el sistema'; } ?>
	  
  </select><font color="#660000"><strong><? echo $mensag;?></strong></font></td>
  </Tr>
<!--tr class="Estilo1">
    <td class="Estilo22">Usuario<font color="#FF0000"><strong>**</strong></font></td>
    <td class="Estilo7"><input name="usuario" type="text" class="Estilo7" id="usuario" size="30"  value="<? print $row['usuario'];  ?>" onKeyUp="javascript:this.value=this.value.toLowerCase();"></td>
    <td colspan="2" class="Estilo7"><div align="right" class="Estilo22">Password<font color="#FF0000"><strong>**</strong></font></div></td>
    <td colspan="-1"><input name="password" type="password" class="Estilo1" id="password" size="30" value="<? print $row['password'];  ?>"></td>
  </tr-->
  <tr class="estilo1">
  <? 
   	$sql_imagen = "select path from doc_adj_rrhh where idasesor = $_GET[paramas] and id_tipo_doc = 1";
//	envia_msg(	$sql_imagen);
    $res_im = mssql_query($sql_imagen); 
	$cantidad = mssql_num_rows($res_im);
	if ($cantidad > 0) 
	 {
		while ($row_im = mssql_fetch_array ($res_im)) 
		 { ?>
		   <Td class="Estilo22" height="100" colspan="2">
		 <img src="../../upload_rrhh/fotos/<? echo $row_im[0]; ?>" width="100" height="80"> 
		 			Eliminar la fotograf�a... Seleccionar ==><input type="checkbox" name="del_foto" value="1">
<? 
		 }	 
	 }
	else
	 { ?>
		<td class="Estilo22">
			Adjunte Fotografia
		</td>
		<td>
			<span class="Estilo22"><input name="userfilefoto" type="file">
		    </span>
		</td>
<?	 }
  ?>
  </Td>
  </tr>
</table>

  <p>&nbsp;</p>
  <table width="830" border="0" align="center" cellspacing="0">
  <tr bgcolor="#0066CC">

  </tr>
</table>
<table width="800"  border="0" align="center" class="Estilo7">
  <tr>
    <td colspan="4"><div align="left"><span class="Estilo47"><span class="Estilo7"><span class="Estilo31">Datos de residencia</span></span></span></div>      </td>
    </tr>
  <tr>
    <td width="10%"><span class="Estilo22">Calle y avenida </span></td>
    <td width="24%"><span class="Estilo47"><span class="Estilo7">
      <input name="calle" type="text" class="Estilo7" id="calle" size="15"  value="<? print $row['calle'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
    </span></span></td>


	<td  width="10%" align="right"><span class="Estilo22">Numero</span> </td>
	<td width="16%">
		<span class="Estilo7">
		  <input name="numero" type="text" class="Estilo7" id="numero" size="5" value="<? print $row['numero'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
		</span>
	</td>
<tr>
    <td width="14%" class="Estilo7">
		<div align="right" class="Estilo22">
        	<div align="right" class="Estilo22">
          		<div align="left">
					Zona      
				</div>
        	</div>
	    </div>
 	</td>
	<td class="Estilo7">
	          	<div align="left">
					<input name="zona" type="text" class="Estilo7" id="zona" size="5" value="<? print $row['zona'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
				</div>

    </td>

  <td width="8%" align="right" class="Estilo7"><span class="Estilo22">Colonia / Edificio</span></span></td>
    <td width="18%">
		<div align="left" class="Estilo22">
	      <input name="colonia" type="text" class="Estilo7" id="colonia2" size="15" value="<? print $row['colonia'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
		</div>
	</td>
</tr>
    <td><span class="Estilo47"><span class="Estilo7"><span class="Estilo22">Departamento<font color="#FF0000"><strong>**</strong></font></span></span></span></td>
    <td><span class="Estilo47"><span class="Estilo7">
	<div align="left">
		    <select name="tema2" class="TituloMedios" id="iddepartamento2"  onChange="javascript:cargarCombo('../../subactividades2.php', 'tema2', 'Div_Subactividades2')">
            <option value=''> Seleccione </option>
            <? 
				$dbms->sql="select iddepartamento,nombre_departamento from asesor_departamento"; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					if ($row['iddepartamento_reside'] == $Fields["iddepartamento"])
					 {
		 			  print "<option value=\"".$Fields["iddepartamento"]."\" selected>".$Fields["nombre_departamento"]."</option>"; 
					 }
					else
					 {
		 			  print "<option value=\"".$Fields["iddepartamento"]."\">".$Fields["nombre_departamento"]."</option>"; 
					 }
				}
			?>
			</select>
	    </div>
</span></span></td>
    <td width="10%" align="right"><span class="Estilo22">Municipio<font color="#FF0000"><strong>**</strong></font></span></td>
    <td width="16%"><span class="Estilo7">
	<div align="left">
		  <div id="Div_Subactividades2"> 
				<label for="SubActividad2"></label> 
                <select name="idgrupo2"  id="select" class="TituloMedios">
 <option value=''> Seleccione </option>
          <? 
				$dbms->sql="select idmunicipio,nombre_municipio from asesor_municipio where iddepartamento =".$row['iddepartamento_reside']; 
				$dbms->Query(); 
				while($Fields=$dbms->MoveNext()) 
				{
					if ($row['idmunicipio_reside'] == $Fields["idmunicipio"])
					 {
						print "<option value=\"".$Fields["idmunicipio"]."\" selected>".$Fields["nombre_municipio"]."</option>"; 
					 }
					else 
					 {
						print "<option value=\"".$Fields["idmunicipio"]."\">".$Fields["nombre_municipio"]."</option>"; 
					 }
				} ?>

                </select>
</div>
        </div>
    </span></td>
</tr><tr>
    <td><div align="left" class="Estilo22">Nacionalidad</div></td>
    <td colspan="2"><span class="Estilo7">
      <input type="text" name="nacionalidad" id="nacionalidad" value="<? print $row['nacionalidad'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
    </span></td>
    </tr>
  <tr>
    <td height="25"><span class="Estilo47"><span class="Estilo7"><span class="Estilo22">Tel&eacute;fono de casa </span></span></span></td>
    <td><span class="Estilo47"><span class="Estilo7">
      <input name="telefono" type="text" class="Estilo7" id="telefono" size="24" value="<? print $row['telefonocasa'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
    </span></span></td>



    <td  width="10%" align="right"><span class="Estilo22">celular</span> </td>
<td width="16%"><span class="Estilo7">

<input name="celular" type="text" class="Estilo7" id="celular" size="20" value="<? print $row['telefonocelular'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
</span></td>
   
    </tr>
  <tr>
    <td class="Estilo22">Direccion para Notificaciones </td>
    <td><span class="Estilo47">
      <input name="direccion_para_notificaciones" type="text" id="direccion_para_notificaciones" size="24" value="<? print $row['direccion_para_notificaciones'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();">
    </span>
</td>  

 <td align="right"><div align="right"><span class="Estilo47"><span class="Estilo22">Correo electr&oacute;nico personal </span></span></div></td>
    <td ><span class="Estilo7"><span class="Estilo47">
      <input name="correo" type="text" class="Estilo7" id="correo" size="20" value="<? print $row['correo'];  ?>" onKeyUp="javascript:this.value=this.value.toLowerCase();">
    </span>
    </span></td>


</tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="6">&nbsp;

</td>
</tr>

<tr>
<td>&nbsp;</td>
    <td colspan="6">&nbsp;

</td>
<?
//envia_msg($sstipo);
/*if ( $sstipo == 1)
 {*/

?>

  </tr>
  <tr>
    <td colspan="7"><span class="Estilo69">Datos del Ministerio de Econom&iacute;a </span></td>
    </tr>
  <tr>
<td><div align="left"><span class="Estilo47"><span class="Estilo22">Cargo Nominal </span></span></div>
  </font></td>
							<td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
							  <select name="id_puesto" <? if ( $sstipo != 1) { echo 'disabled'; } ?> >
                                <?  
								  $sqlsel = "select id_puesto, puesto from puesto";
								$result = @mssql_query($sqlsel);
								while ($rows = mssql_fetch_array($result))
								 { 
								 $id_puesto = $rows['id_puesto'];
								 $puesto= $rows['puesto'];
								 if ($row['id_puesto'] == $rows['id_puesto'])
									{	
								 ?>
                                <option value= "<? echo $id_puesto; ?>" selected><? echo $puesto; ?> </option>
                                <? }
								else { ?>		
                                <option value= "<? echo $id_puesto; ?>"><? echo $puesto; ?> </option>
								<?  }
								  }	?>
                              </select></font></td>



<td><div align="left"><span class="Estilo47"><span class="Estilo22">Cargo Funcional</span></span></div></font></td>
							<td> <font size="2" face="Verdana, Arial, Helvetica, sans-serif">
							  <select name="id_puesto1" <? if ( $sstipo != 1) { echo 'disabled'; } ?>>
                                <?  
								  $sqlsel_ = "select id_puesto, puesto from puesto";
								$result_ = @mssql_query($sqlsel_);
								while ($rows2 = mssql_fetch_array($result_))
								 { 
								 $id_puesto1 = $rows2['id_puesto'];
								 $puesto1= $rows2['puesto'];
								 if ($row['id_puesto1'] == $rows2['id_puesto'])
									{	
								 ?>
                                <option value= "<? echo $id_puesto1; ?>" selected><? echo $puesto1; ?> </option>
                                <? }
								else { ?>		
                                <option value= "<? echo $id_puesto1; ?>"><? echo $puesto1; ?> </option>
								<?  }
								  }	?>
                              </select></font></td>





<!--td align="right">
 </span></span><span class="Estilo22">Descripcion del Puesto</span></td>
<td-->
<span class="Estilo47">
<span class="Estilo1"> <span class="Estilo7"><span class="Estilo22">
 <!--input name="userfile2" type="file" id="userfile2" size="30" value="<?// print $row['userfile2'];  ?>"-->
 </span></span></span></span></td>

  </tr>
  <tr>
    <td><span class="Estilo22">Renglon</span></td>
    <td colspan="1">	<span class="Estilo22"> 011</span><span class="Estilo1">
<?  if ($row['reglon'] == '11' ) 
		{        
?>      <input name="reglon" type="radio" value="11" checked <? if ( $sstipo != 1) { echo 'disabled'; } ?> >
        </span><span class="Estilo22">022</span><span class="Estilo1">        
        <input name="reglon" type="radio" value="22" <? if ( $sstipo != 1) { echo 'disabled'; } ?> >
        </span><span class="Estilo22">
        029</span><span class="Estilo1">
         <input name="reglon" type="radio" value="29" <? if ( $sstipo != 1) { echo 'disabled'; } ?> >
<? 		} 
	elseif ($row['reglon'] == '22' ) 
		{        
?>      <input name="reglon" type="radio" value="11" <? if ( $sstipo != 1) { echo 'disabled'; } ?> >
        </span><span class="Estilo22">022</span><span class="Estilo1">        
        <input name="reglon" type="radio" value="22" checked <? if ( $sstipo != 1) { echo 'disabled'; } ?> >
        </span><span class="Estilo22">
        029</span><span class="Estilo1">
         <input name="reglon" type="radio" value="29"  <? if ( $sstipo != 1) { echo 'disabled'; } ?> >
<? 		} 
	elseif ($row['reglon'] == '29' ) 
		{        
?>      <input name="reglon" type="radio" value="11" <? if ( $sstipo != 1) { echo 'disabled'; } ?> >
        </span><span class="Estilo22">022</span><span class="Estilo1">        
        <input name="reglon" type="radio" value="22" <? if ( $sstipo != 1) { echo 'disabled'; } ?>  >
        </span><span class="Estilo22">
        029</span><span class="Estilo1">
         <input name="reglon" type="radio" value="29" checked  <? if ( $sstipo != 1) { echo 'disabled'; } ?> >
<? 		} 
	else
		{        
?>      <input name="reglon" type="radio" value="11" <? if ( $sstipo != 1) { echo 'disabled'; } ?> >
        </span><span class="Estilo22">022</span><span class="Estilo1">        
        <input name="reglon" type="radio" value="22" <? if ( $sstipo != 1) { echo 'disabled'; } ?>  >
        </span><span class="Estilo22">
        029</span><span class="Estilo1">
         <input name="reglon" type="radio" value="29" <? if ( $sstipo != 1) { echo 'disabled'; } ?> >
<? 		} 
?>

</span></td>

<td><span class="Estilo22">
Fecha Ingreso
</span>
</td>
<td>


<div align="left" class="Estilo22">
dia
<select name="diai" class="Estilo1" <? if ($diai != '' && $sstipo != 1 )  { ?> disabled  <? } ?> >
	<?
	$i=1;
	 while ($i<=31)
	  {
	    if ($diai == $i)
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
mes
	<!--input name="mes3" type="text" class="Estilo1" id="mes3" size="2" maxlength="2" value="<? //print $mes3;  ?>"-->    
<select name="mesi" class="Estilo1" <? if ($mesi != ''  && $sstipo != 1 ) { ?> disabled  <? } ?>>
	<?
	$i=1;
	 while ($i<=12)
	  {
	  if ($mesi == $i)
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
a&ntilde;o
<!--input name="ano3" type="text" class="Estilo1" id="ano3" size="4" maxlength="4" value="<? //print $ano3;  ?>"--> 
<select name="anoi" class="Estilo1" <? if ($anoi != ''  && $sstipo != 1 ) { ?> disabled  <? } ?> >
	<?
	$i=1920;
	 while ($i<=date('Y'))
	  {
		 if ($anoi == $i)
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


	      <!--input name="fecha_ingreso" type="text" <? // if ($row['fecha_ingreso'] != '' ) { ?> disabled <? // } ?> class="Estilo7"  id="fecha_ingreso" size="15" value="<? //print $row['fecha_ingreso']; ?>" >
	      <input name="fecha_ingreso"  type="hidden" class="Estilo7"  id="fecha_ingreso" size="15" value="<?  //print $row['fecha_ingreso']; ?>" -->
		</div>
</td>  

</tr>
  <tr>
    <td><span class="Estilo22">Partida Presupuestaria No. </span></td>
    <td><span class="Estilo47"><span class="Estilo1"> <input name="partida" type="text" class="Estilo7" id="partida" value="<?  print $row['partida'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" <? if ( $sstipo != 1) { echo 'disabled'; } ?> >
    </span></span></td>
    <td align="right"><span class="Estilo22">Dependencia</span></td>
	<td>
      <select name="iddireccion" id="iddireccion" class="Estilo7" <? if ( $sstipo != 1) { echo 'disabled'; } ?> >
<?
	$dbms->sql="select iddireccion,nombre from direccion"; 
	$dbms->Query(); 
	while($Fields=$dbms->MoveNext()) 
	{  
		if ($row['iddireccion'] == $Fields["iddireccion"])
		 {
			print "<option value=\"".$Fields["iddireccion"]."\" selected>".$Fields["nombre"]."</option>"; 
		 }
		else
		 {
			print "<option value=\"".$Fields["iddireccion"]."\">".$Fields["nombre"]."</option>"; 
		 }
	}
?>
        </select> 
</td>
</tr>
<tr>
<td><span class="Estilo22">Extension</span></td>
<td>

	  <input name="extension" type="text" id="extension" size="10" value="<? print $row['extension'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" <? if ( $sstipo != 1) { echo 'disabled'; } ?>>
</td>
<td align="right"><span class="Estilo22">Gafete</span></td>



<td>
<input name="gafete" type="text" id="gafete" size="10" value="<? print $row['gafete'];  ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" <? if ( $sstipo != 1) { echo 'disabled'; } ?>>
</td>

  </tr>
<tr class="Estilo22" >
<td align="left"><span class="Estilo22">Sueldo Q. </span></td>
<td>
<input name="sueldo" type="text" id="sueldo" size="10" value="<? print $row['sueldo']; ?>" onKeyUp="javascript:this.value=this.value.toUpperCase();" <? if ( $sstipo != 1) { echo 'disabled'; } ?>>
</td>

<?
/*if ( $sstipo == 1)
 {*/
?>

		<td align="right">Tipo de usuario</td>
		<td>
		<select name="tipo_usuario" <? if ( $sstipo != 1) { echo 'disabled'; } ?>  >
		<?  
		  $sqlsel = "select idtipousuario, tipo from tipo_usuario";
 		  $result = @mssql_query($sqlsel);
	  	  while ($rows = mssql_fetch_array($result))
 		   { 
			 $id_tipo = $rows['idtipousuario'];
			 $tipo= $rows['tipo'];
			 if ( $id_tipo == $row['idtipousuario'])
			 	{	?>
		          <option value= "<? echo $id_tipo; ?>" selected><? echo $tipo; ?> </option>
	    <? 		}
			 else
			 	{ ?>
		          <option value= "<? echo $id_tipo; ?>"><? echo $tipo; ?> </option>
		<?		}
			}	?>
		
		
	<? /* if ($row['idtipousuario'] == 1 ) 
			{*/
	?>
		<!--option value="1" selected>Administrador</option>
		<option value="2">Operador</option-->
<?
/*			}
		else {*/
?>
		<!--option value="1">Administrador</option>
		<option value="2" selected>Operador</option-->
<?	//			}	?>
		</select>
<? if ( $sstipo != 1) { ?> 
	<input name="tipo_usuario" type="hidden" size="1" value="<? echo $row['idtipousuario']; ?>" >
	<input name="iddireccion" type="hidden" size="3" value="<? echo $row['iddireccion']; ?>" >
	<input name="id_puesto" type="hidden" size="3" value="<? echo $row['id_puesto']; ?>" >
	<input name="partida" type="hidden" value="<? echo $row['partida']; ?>" >
	<input name="extension" type="hidden" value="<? echo $row['extension']; ?>" >
	<input name="sueldo" type="hidden" value="<? echo $row['sueldo']; ?>" >
	<input name="gafete" type="hidden" value="<? echo $row['gafete']; ?>" >
	<input name="id_puesto" type="hidden" value="<? echo $row['id_puesto']; ?>" >
	<input name="id_puesto1" type="hidden" value="<? echo $row['id_puesto1']; ?>" >
	<input name="renglon" type="hidden" value="<? echo $row['renglon']; ?>" >
	<input name="diai" type="hidden" value="<? echo $diai; ?>" >
	<input name="mesi" type="hidden" value="<? echo $mesi; ?>" >
	<input name="anoi" type="hidden" value="<? echo $anoi; ?>" >

<?  } ?>
		<td>
	</tr>
<?
/*}
else
{*/
?>
<!--input name="tipo_usuario" type="hidden" size="1" value="2" >
	</tr-->
<?
//}
?>

</table>
<table width="77%"  border="0" align="center">
  <tr>
    <th width="43%" scope="row">&nbsp;</th>
    <td width="31%"><div align="right"><span class="Estilo1 Estilo6"><font color="#FF0000">** Campos Requeridos</font>

		<input type="hidden" name="paramas" value="<? print $_GET['paramas'];?>">
        <input type="submit" name="Submit" value="Actualizar">		
        <!--input type="submit" name="Submit" value="Actualizar" onclick="comprueba_extension(this.form, this.form.userfilefoto.value)"-->
      <!--img src="images/flecha4.JPG" width="43" height="39"--> </span></div></td>
  </tr>
</table>
<div align="center"></div><font color="#990000">
<p class="Estilo1">Favor revisar los datos antes de ser enviados. </p>
<p class="Estilo1">Toda la  informaci&oacute;n proporcionada, ser&aacute; utilizada &uacute;nica y exclusivamente para registro del Ministerio de Econom&iacute;a.</p>
<p align="center" class="Estilo1 Estilo6">&nbsp;</p></font>
</form>
<?

	}//finalizacion while del query principal
}//finalizacion de if de hasta arriba

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
    element.innerHTML = '<img src="../../Imagenes/loading.gif" />'; 
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

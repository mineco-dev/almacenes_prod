<?php
  /*ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);*/
	require('../includes/cnn/inc_header.inc');
  require('../includes/funciones.php');
	$dbms=new DBMS(conectardb($almacen));	
  //echo "database cnn::";
  //echo database_cnn;
	$dbms->bdd=$database_cnn;
	//echo database_cnn;
  //print_r($dbms);

  $ver = $_GET['ver'];

?>

<!DOCTYPE html>
<html>
<head>
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
 <script type='text/javascript' src="../bootstrap/jquery/jquery-3.2.1.js"></script> 
 <script type='text/javascript' src="../datatable/js/jquery.dataTables.min.js"></script>
 <link rel="stylesheet" type="text/css" href="../datatable/css/jquery.dataTables.min.css">
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
      element.innerHTML = '<img src="../../images/loading.gif" />';
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
<script type="text/javascript">
  function compara (form) {
      if (form.clave1.value == form.clave2.value) 
        form.img.src = "../../imagenes/yes.jpg";
      else
        form.img.src = "../../imagenes/no.jpg";
    }
  function valida (form) {
  if (form.clave1.value = form.clave2.value) form.img.src = "../../imagenes/no.jpg";
  alert("hola");
}
</script>
<script language=javascript src=../includes/FormCheck.js></script>
<SCRIPT>
function trim(s){
	s = s.replace(/\s+/gi, ''); //sacar espacios repetidos dejando solo uno
	s = s.replace(/^\s+|\s+$/gi,''); //sacar espacios blanco principio y final
	return s;
}

function verificar (form) {
//	alert (form['pregunta'].value.length);
/*    if(document.getElementById("pregunta").value.length == 0)
		alert("Debe Ingresar la descripcion de la informacion a solicitar");
	}else
	{
		alert("No coincide la confirmación de la clave");
	}
*/        
		// alert( "Todo verificado con exito" );
}
function imprimir()
{
//	alert(window.document.form1.opnacionalidad[0].value);
//	alert(window.document.form1.opnacionalidad[1].value);
	if (window.document.form1.opnacionalidad[0].checked)
	{
	   document.getElementById("div_extranjero").style.display = "none";
	   document.getElementById("div_nacional").style.display = "inline";
	}else
	{
		if (window.document.form1.opnacionalidad[1].checked)
		{
		   document.getElementById("div_extranjero").style.display = "inline";
		   document.getElementById("div_nacional").style.display = "none";
		}else
		{
		   document.getElementById("div_extranjero").style.display = "none";
		   document.getElementById("div_nacional").style.display = "none";
		}
	}
}
</SCRIPT>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="../estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body oncontextmenu="return false">
<form action="" method="post" enctype="multipart/form-data" name="form1">
<table width="97%" border="0" align="center" class="panel">
  <tr>
    <td><table width="100%" border="0" class="grey">
      <tr>
        <td><strong> Solicitudes al <?PHP print get_formatofecha(date("d")."-".date("m")."-".date("Y")); ?></strong></td>
      </tr>
    </table>
		<br>
      <table width="95%%" border="0" align="center">
        <tr>
          <td>
          <?php
              $mensaje = "";
              if ($ver==1) $mensaje = "<img src=\"imagenes/led_circle_green.png\"> Ingresadas";
              if ($ver==2) $mensaje = "<img src=\"imagenes/led_circle_red.png\"> Egresadas";
              if ($ver==3) $mensaje = "<img src=\"imagenes/led_circle_red.png\"> Igresos Anulados";
			
		      ?>          
        </td>
        </tr>
        <tr>
          <td>
          <?php
          	if ($ver==1)   { include("ingresos.php"); } 	  
          	if ($ver==2)   { include("egresos.php"); }  
			      if ($ver==3)   { include("ingresos_anulados.php"); }       
          	   
			
		  
          ?>          </td>
        </tr>
      </table>
      <p>&nbsp;</p>
      </td>
  </tr>
</table>

</form>

</body>
</html>

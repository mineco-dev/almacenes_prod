
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script language="javascript" src="calendar/calendar.js"></script>

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
    element.innerHTML = '<img src="../images/loading.gif" />';
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
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
</head>
<body oncontextmenu="return false">
<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");	
?>
<?php


 $dia_numero= date("d");
$dia_letras = date('D');



  

  conectardb($almacen);											
					$qry_tipo_empresa="SELECT * FROM dbo.fecha";										
					$res_qry_tipo_empresa=$query($qry_tipo_empresa);	
					   
				
					while($row_tipo_empresa=$fetch_array($res_qry_tipo_empresa))
					{
				    $contador = $row_tipo_empresa["id_fecha"];
					$valida =$row_tipo_empresa["dia"];

					}
							
					$free_result($res_qry_tipo_empresa);	
  
  
  
  
  
  

if($dia_numero >=1  && $dia_letras != "Sun" && $dia_letras != "Sat")
{
 
 $contador= $contador +1;
 
 if($contador <= 8)
 
 {
      
	 if( $dia_numero != $valida)
	  {
	  $qry_actualiza="update dbo.fecha set id_fecha ='$contador', dia='$dia_numero' where id_fecha >=0";
		$query($qry_actualiza);	
	  }
 
 
	  
 }
 
else

{
 echo "ERROR CONSULTE AL ADMINISTRADOR TECNICO";
 
 if($dia_numero >1 && $dia_numero <3  && $dia_letras != "Sun" && $dia_letras != "Sat")
 {
 $qry_actualiza="update dbo.fecha set id_fecha =0, dia=0 where id_fecha >=0";
		$query($qry_actualiza);	
 
 }
 
}
 



}

else

{
 echo "El sistema se encuentra fuera de servicio, por encontrarse en fin de semana";

}




?>


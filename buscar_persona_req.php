<?PHP
include("../includes/funciones.php");
include("../includes/sqlcommand.inc");

	if (isset($_REQUEST["tipo"]))
	{
		//session_register("tipo");
		$_SESSION["tipo"]=$_REQUEST["tipo"];
		//session_register("posi");
		$_SESSION["posi"]=$_REQUEST["posi"];
		$tipo=$_REQUEST["tipo"];
		$posi=$_REQUEST["posi"];
	}
	else
	{
		$tipo=$_SESSION["tipo"];
		$posi=$_SESSION["posi"];
	}	
	if (isset($_REQUEST["dependencia"]))
	{
		$_SESSION["codigodependencia"] = $_REQUEST["dependencia"];
	}
echo "<hr>cod dependencia: --" . $_SESSION["codigodependencia"] 

?>
<html><head>
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

if (!peticion){

alert("ERROR AL INICIALIZAR!");
}


function cargarCombo (url, comboAnterior, element_id) {

    //Obtenemos el contenido del div

    //donde se cargaran los resultados

    var element =  document.getElementById(element_id);

    //Obtenemos el valor seleccionado del combo anterior

    var valordepende = document.getElementById(comboAnterior);

    var x = valordepende.value;

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
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="../includes/ajax_request.js"></script>
<script type="text/javascript">
<!--
function obtenVal(op){
	
	var urlarg = '';
	if (op > 0)
	{
	    if (op == 1) urldestino = 'individual.php?';
	    if (op == 2) urldestino = 'representantemandatario.php?';
	    ajax_request(urldestino,'embebida',true);
	}
}
//-->
</script>

<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.txt_buscar.value == "")
  { 
  	alert("Escriba el nombre o apellido del empleado para realizar la búsqueda"); 
	form.txt_buscar.focus(); 
	return;
 }  
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_buscar.focus(); 
}
</script>
<link href="../helpdesk.css" rel="stylesheet" type="text/css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">

</style>
</head>

<body>
<div align="left">
  <form name="form1" method="post" action="">
    <table width="100%" border="0" bordercolor="#ECE9D8">
      <tr>
        <td><div align="left" class="titulocategoria">
          <div align="center">FORMULARIO PARA B&Uacute;SQUEDA DE EMPLEADOS MINECO </div>
        </div></td>
      </tr>
      <tr>
        <td><center>
            </center></td>
      </tr>
      <tr>
        <td>        <div align="left" class="Estilo1">
          <div align="left">
            <p><strong><strong>            
            	[<a href="buscar_persona_req.php?in=A" alt="Muestra los registros que inician con A">A</a>] 
            	[<a href="buscar_persona_req.php?in=B">B</a>] 
            	[<a href="buscar_persona_req.php?in=C">C</a>] 
            	[<a href="buscar_persona_req.php?in=D">D</a>] 
            	[<a href="buscar_persona_req.php?in=E">E</a>] 
            	[<a href="buscar_persona_req.php?in=F">F</a>] 
            	[<a href="buscar_persona_req.php?in=G">G</a>] 
            	[<a href="buscar_persona_req.php?in=H">H</a>]
            	[<a href="buscar_persona_req.php?in=I">I</a>] 
            	[<a href="buscar_persona_req.php?in=J">J</a>] 
            	[<a href="buscar_persona_req.php?in=K">K</a>] 
            	[<a href="buscar_persona_req.php?in=L">L</a>] 
            	[<a href="buscar_persona_req.php?in=M">M</a>] 
            	[<a href="buscar_persona_req.php?in=N">N</a>] 
            	[<a href="buscar_persona_req.php?in=O">O</a>] 
            	[<a href="buscar_persona_req.php?in=P">P</a>] 
            	[<a href="buscar_persona_req.php?in=Q">Q</a>] 
            	[<a href="buscar_persona_req.php?in=R">R</a>] 
            	[<a href="buscar_persona_req.php?in=S">S</a>] 
            	[<a href="buscar_persona_req.php?in=T">T</a>] 
            	[<a href="buscar_persona_req.php?in=U">U</a>] 
            	[<a href="buscar_persona_req.php?in=V">V</a>] 
            	[<a href="buscar_persona_req.php?in=W">W</a>] 
            	[<a href="buscar_persona_req.php?in=X">X</a>] 
            	[<a href="buscar_persona_req.php?in=Y">Y</a>] 
            	[<a href="buscar_persona_req.php?in=Z">Z</a>] 
            	<a href="buscar_persona_req.php?in=all">[TODO]</a><BR></strong></strong><strong><strong>
              <input name="txt_buscar" type="text" id="txt_buscar2" size="30">
                <input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar" value="Buscar"> 
    (ESCRIBA NOMBRE, APELLIDO O DEPENDENCIA)</strong></strong></p>
            </div>
        </div></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="0" cellspacing="1" border="0" width="100%" id="table17">
      <tr align="center" bgcolor="#006699" class="thead">
        <td width="9%" class="titulotabla"><div align="center"><strong>Seleccionar
        </strong></div></td>
        <td width="51%" class="titulotabla"><strong>Apellidos y nombres</strong></td>
       
     
              <td width="51%" class="titulotabla"><strong>ID ASESOR</strong></td>
       
      </tr>
		<?PHP
				if ($_REQUEST["txt_buscar"]!="")
				{
				$busqueda=strtoupper($_REQUEST["txt_buscar"]);					
				$consulta = "SELECT (a.apellido +' '+ a.apellido2 +' '+ a.apellidocasada +', '+ a.nombre +' '+ a.nombre2 +' '+ a.nombre3) as empleado, 
	a.activo, a.idasesor ,d.nombre AS dependencia
	FROM asesores a
INNER JOIN direccion d ON a.iddireccion = d.iddireccion 
where (a.apellido like '%$busqueda%' or a.apellido2 like '%$busqueda%' or a.nombre like '%$busqueda%' or a.nombre2 like '%$busqueda%' or d.nombre like '%$busqueda%') and (a.activo=1)";//primera consulta

				}
				else	
				if (isset($_REQUEST["in"]))	
				{
					$inicial=$_REQUEST["in"];
					echo "Listado de personal que su apellido inicia con $inicial";
					if ($inicial!="all")
						$consulta = "SELECT (a.apellido +' '+ a.apellido2 +' '+ a.apellidocasada +', '+ a.nombre +' '+ a.nombre2 +' '+ a.nombre3) as empleado, a.activo, a.idasesor,
				                    d.nombre AS dependencia
									FROM asesores a INNER JOIN
                					direccion d ON a.iddireccion = d.iddireccion
									where a.apellido like '$inicial%' and a.activo=1";//segunda consulta
							       
						else
							$consulta = "SELECT (a.apellido +' '+ a.apellido2 +' '+ a.apellidocasada +', '+ a.nombre +' '+ a.nombre2 +' '+ a.nombre3) as empleado, a.activo, a.idasesor,
				                        d.nombre AS dependencia
									    FROM asesores a INNER JOIN
                					    direccion d ON a.iddireccion = d.iddireccion 
										where a.activo=1
							 			order by a.apellido, a.apellido2, a.apellidocasada, a.nombre";//tercer consulta
				}
				else
				{
					$consulta =     "SELECT top 10(a.apellido +' '+ a.apellido2 +' '+ a.apellidocasada +', '+ a.nombre +' '+ a.nombre2 +' '+ a.nombre3) as empleado, a.activo, a.idasesor,
				                    d.nombre AS dependencia
									FROM asesores a INNER JOIN
                					direccion d ON a.iddireccion = d.iddireccion
							     	where a.apellido like 'a%' and a.activo=1";//cuarta consulta
				}

				//echo $consulta;
				conectardb($rrhh);
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					$completo=$row["empleado"];
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}


					
					echo '<tr class='.$clase.'>';


					echo "<td class='boton'><center><img src=\"../images/iconos/ico_ir.gif\" border=\"0\" alt=\"Seleccionar este empleado\"></a></center></td>";					
					echo '<td>'.$row["empleado"].'</td>';	
					echo '<td>'.$row["idasesor"].'</td></tr>';	

					// echo "<td><a href=\"javascript:void(0)\" onClick=\"window.opener.document.getElementById('$tipo"."[".$posi."][0]').value = '$completo'; 
					// window.opener.document.getElementById('$tipo"."[".$posi."][2]').value = '$completo'; 
					// window.opener.document.getElementById('$tipo"."[".$posi."][1]').value = '".$row["idasesor"]."';
					// window.close();
					// window.opener.focus(); 
					// return false;\"><center><img src=\"../images/iconos/ico_ir.gif\" border=\"0\" alt=\"Seleccionar este empleado\"></a></center></td>";					
					// echo '<td>'.$row["empleado"].'</td>';	
					// echo '<td>'.$row["idasesor"].'</td></tr>';								
					$i++;
				}				
				$free_result($result);				
			 ?>
    </table>
  </form>
  <p>&nbsp;</p>
</div>

<script type="text/javascript">   

window.onload = function(){

        $(".boton").click(function(){

 

            var valores= new Array();

 

            // Obtenemos todos los valores contenidos en los <td> de la fila

            // seleccionada

            $(this).parents("tr").find("td").each(function(){

                // valores+=$(this).html()+"\n";
                valores.push($(this).html())
                

            });



window.opener.document.getElementById("nombre[0][0]").value = valores[1]
window.opener.document.getElementById("nombre[0][2]").value = valores[1];
window.opener.document.getElementById("nombre[0][1]").value = valores[2];
window.close();
window.opener.focus();

        });



// var tags_td = new Array();
// var tags_td=document.getElementsByTagName('td');
// for (i=0; i<tags_td.length; i++) {
//             if (tags_td[i].addEventListener) {   // IE9 y el resto
//                 tags_td[i].addEventListener ("click", function () {valor_celda(this)}, false);
//             } 
//             else {
//                 if (tags_td[i].attachEvent) {    // IE9 -
// //                    tags_td[i].attachEvent ('onclick',  function () {valor_celda(this)}, false);
//    tags_td[i].setAttribute('onclick', 'valor_celda(this)');                 
                    
//                 }
//             }
// }
};


</script>
</body>

</html>

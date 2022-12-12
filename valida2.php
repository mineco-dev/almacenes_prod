
<?PHP




$jefe = ($_POST['cbo_jefe']); 
print($jefe);
?>
<?PHP
	session_start(); 	// Quien inicio la sesion
?>
<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");


    $usuario_id=($_SESSION["user_id"]);   //codigo del usuario
	$grupo_id=($_SESSION["group_id"]);    // Codigo del grupo	
	$usuario_nombre=$_SESSION["user_name"];
    $dependencia=$_SESSION["departament_id"];
print($usuario_nombre);

?>

<html>
<head>
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

<script type="text/javascript">
/***********************************************
* Contractible Headers script- � Dynamic Drive (www.dynamicdrive.com)
* This notice must stay intact for legal use. Last updated Mar 23rd, 2004.
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

var enablepersist="on" //Enable saving state of content structure using session cookies? (on/off)
var collapseprevious="no" //Collapse previously open content when opening present? (yes/no)

if (document.getElementById){
document.write('<style type="text/css">')
document.write('.switchcontent{display:none;}')
document.write('</style>')
}

function getElementbyClass(classname){
ccollect=new Array()
var inc=0
var alltags=document.all? document.all : document.getElementsByTagName("*")
for (i=0; i<alltags.length; i++){
if (alltags[i].className==classname)
ccollect[inc++]=alltags[i]
}
}

function contractcontent(omit){
var inc=0
while (ccollect[inc]){
if (ccollect[inc].id!=omit)
ccollect[inc].style.display="none"
inc++
}
}

function expandcontent(cid){
if (typeof ccollect!="undefined"){
if (collapseprevious=="yes")
contractcontent(cid)
document.getElementById(cid).style.display=(document.getElementById(cid).style.display!="block")? "block" : "none"
}
}

function revivecontent(){
contractcontent("omitnothing")
selectedItem=getselectedItem()
selectedComponents=selectedItem.split("|")
for (i=0; i<selectedComponents.length-1; i++)
document.getElementById(selectedComponents[i]).style.display="block"
}

function get_cookie(Name) { 
var search = Name + "="
var returnvalue = "";
if (document.cookie.length > 0) {
offset = document.cookie.indexOf(search)
if (offset != -1) { 
offset += search.length
end = document.cookie.indexOf(";", offset);
if (end == -1) end = document.cookie.length;
returnvalue=unescape(document.cookie.substring(offset, end))
}
}
return returnvalue;
}

function getselectedItem(){
if (get_cookie(window.location.pathname) != ""){
selectedItem=get_cookie(window.location.pathname)
return selectedItem
}
else
return ""
}

function saveswitchstate(){
var inc=0, selectedItem=""
while (ccollect[inc]){
if (ccollect[inc].style.display=="block")
selectedItem+=ccollect[inc].id+"|"
inc++
}

document.cookie=window.location.pathname+"="+selectedItem
}

function do_onload(){
uniqueidn=window.location.pathname+"firsttimeload"
getElementbyClass("switchcontent")
if (enablepersist=="on" && typeof ccollect!="undefined"){
document.cookie=(get_cookie(uniqueidn)=="")? uniqueidn+"=1" : uniqueidn+"=0" 
firsttimeload=(get_cookie(uniqueidn)==1)? 1 : 0 //check if this is 1st page load
if (!firsttimeload)
revivecontent()
}
}


if (window.addEventListener)
window.addEventListener("load", do_onload, false)
else if (window.attachEvent)
window.attachEvent("onload", do_onload)
else if (document.getElementById)
window.onload=do_onload

if (enablepersist=="on" && document.getElementById)
window.onunload=saveswitchstate

</script>

<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.cbo_categoria.value == "0" && form.txt_buscar.value == "")
  { 
  	alert("Seleccione la clasificación del producto"); 
	form.cbo_subcategoria.focus(); 
	return;
 }
  if (form.cbo_medida.value == "0" && form.txt_buscar.value == "")
  { 
  	alert("Seleccione la forma de presentación del producto"); 
	form.cbo_medida.focus(); 
	return;
 }
   if (form.txt_producto.value == "" && form.txt_buscar.value == "")
  { 
  	alert("Escriba el nombre del producto"); 
	form.txt_producto.focus(); 
	return;
 }
  if (form.txt_marca.value == "" && form.txt_buscar.value == "")
  { 
  	alert("Escriba la marca u otra identificación"); 
	form.txt_marca.focus(); 
	return;
 }
//
// { 
//	alert("La existencia m�xima debe ser igual o superior a la existencia m�nima"); 
//	form.txt_maxima.focus(); 
//	return;
//}
 if (!numerico(form.txt_minima.value))
    { 
        alert("La existencia m�nima se debe ingresar en números");
		form.txt_minima.focus(); 
		return;
	}
  if (!numerico(form.txt_maxima.value))
    { 
        alert("La existencia m�xima se debe ingresar en números");
		form.txt_maxima.focus(); 
		return;
	}
 function numerico(valor)
{ 
	   campo=valor.toString();
	   var nuLongitud = campo.length;
	   var i= 0;
	   var bobandera = "TRUE";
	   for(i=0;i<nuLongitud;i++)
	   {
		  switch(campo.charAt(i))
		  {
				case '1': case '2': case '3':
				case '4': case '5': case '6':
				case '7': case '8': case '9': case '0':
				bobandera = "TRUE";
				break;
				default:
				bobandera = "FALSE";				
		  } //end switch           
	   }//end for
	   if (bobandera == "FALSE") return false
	   else return true;      
} 
  form.submit();
}
function Refrescar(form)
{
	form.reset();
	form.txt_subcategoria.focus(); 
}
</script>

<link href="HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">


<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<style type="text/css">
<!--
.Estilo1 {font-size: 12px}
.Estilo3 {color: #FFFFFF}
-->
</style>
</head>

<body>
<div align="left">
  <form name="form1" method="post" action="">
   
    <div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
  
    
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
   
    <table width="100%" border="0" bordercolor="#ECE9D8">
     
    
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="left" class="titulocategoria">
          <div align="center">
            <p>REQUISICIONES PENDIENTES DE APROBAR </p>
            <p>&nbsp;</p>
          </div>
        </div></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="0" cellspacing="1" border="0" width="100%" id="table17">
      <tr align="center" bgcolor="#aeccf2" class="thead">
        <td width="3%" height="21" class="titulotabla"><strong><strong>No.</strong></strong></td>
        <td width="21%" class="titulotabla"><strong><strong>Solicitante</strong></strong></td>
        <td width="18%" class="titulotabla"><strong>Dependencia</strong></td>
        
        <td width="21%" class="titulotabla"><strong>Fecha Requisicion</strong></td>
        <td width="2%" colspan="-1" class="thead Estilo3"><span class="titulotabla"><strong>Ver</strong></span></td>
        <td width="7%" colspan="-1" class="thead Estilo3"><span class="titulotabla"><strong>Rechazar</strong></span></td>
      </tr>
		
		<?PHP
				conectardb($almacen);
				$consulta = "select e.codigo_requisicion_enc, d.Descripcion_Depen, j.Nombre_Jefe_Depen,
e.solicitante, e.codigo_estatus, e.fecha_requisicion, j.Codigo_Jefe_Depen from tb_requisicion_enc e
inner join tb_dependencias d
on d.codigo_depen = e.codigo_dependencia
inner join tb_jefes_depen j
on j.codigo_jefe_depen = e.codigo_jefe_dependencia 
where e.codigo_estatus=3 and j.Codigo_Jefe_Depen = '$jefe'
order by e.codigo_requisicion_enc"; 
				
				conectardb($almacen);
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					//$completo=$row["producto"]."-".$row["unidad_medida"];
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					$estado=$row["codigo_estatus"];
					if ($estado==3)
					{										
					
					echo '<tr class='.$clase.'>';								
					echo '<td>'.$row["codigo_requisicion_enc"].'</td><td>'.$row["solicitante"].'</td><td>'.$row["Descripcion_Depen"].'</td><td>'.$row["fecha_requisicion"].'</td><td><center><a href="aprobar_producto.php?id='.$row["codigo_requisicion_enc"].'"><img src="../images/iconos/ico_editar.jpg" alt="Modificar información"></a></center></td><td><center><a href="anular_producto.php?id='.$row["codigo_requisicion_enc"].'"><img src="../images/iconos/ico_borrar.jpg" alt="Activo"></a></center></td></tr>';					
					}
					else
					echo '<tr class='.$clase.'><td>'.$row["codigo_requisicion_enc"].'</td><td>'.$row["solicitante"].'</td><td>'.$row["Descripcion_Depen"].'</td><td>'.$row["fecha_requisicion"].'</td><td><center><a href="aprobar_producto.php?id='.$row["codigo_requisicion_enc"].'"><img src="../images/iconos/ico_editar.jpg" alt="Modificar información"></a></center></td><td><center><a href="anular_producto.php?id='.$row["codigo_requisicion_enc"].'"><img src="../images/iconos/ico_borrar.jpg" alt="Activo"></a></center></td></tr>';										
					$i++;
				}
				$free_result($result);
			session_write_close();
			 ?>
    </table>
  </form>
  <p>&nbsp;</p>
</div>
</body>
</html>




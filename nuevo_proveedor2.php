<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
?>
<?PHP
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

if (isset($_REQUEST["txt_nit"]))
{	
	if ($_REQUEST["txt_nit"]!="")
	{	
		conectardb($almacen);
		$nit=($_REQUEST["txt_nit"]);	
		$proveedor=utf8_decode(strtoupper($_REQUEST["txt_nombre"]));	
		$direccion=$_REQUEST["txt_direccion"];
		$telefono=$_REQUEST["txt_telefono"];	
		$contacto=$_REQUEST["txt_contacto"];	
		$correo=$_REQUEST["txt_correo"];	
		$qry_si_existe="select * from tb_proveedor where nit='$nit'";
		$res_qry_si_existe=$query($qry_si_existe);	
		$existe=false;	
		while($row_subcategoria=$fetch_array($res_qry_si_existe))
		{
			echo "este proveedo ya esta ingresado";
			$existe=true;
		}
		if ($existe==false)
		{						
			
			//$nombre_usuario=$_SESSION["user_name"];			
			$qry_producto="INSERT INTO tb_proveedor(nit, nombre, direccion, telefonos, contacto, corrreo) 
							VALUES ('$nit', '$proveedor', '$direccion', '$telefono', '$contacto', '$correo')";
			$query($qry_producto);		
								
			
		}
	}
}
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
 
  if (form.txt_nit.value == "" && form.txt_buscar.value == "")
  { 
  	alert("Escriba la marca u otra identificación"); 
	form.txt_nit.focus(); 
	return;
 }
//
// { 
//	alert("La existencia m�xima debe ser igual o superior a la existencia m�nima"); 
//	form.txt_maxima.focus(); 
//	return;
//}
 
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
<link href="../helpdesk.css" rel="stylesheet" type="text/css">

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
    <table width="100%" border="0" bordercolor="#ECE9D8">
      <tr>
        <td class="titulocategoria"><div align="center">INGRESO DE NUEVOS PROVEEDORES AL CAT&Aacute;LOGO</div></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>          <div align="left">
            <div align="justify"><img src="../images/e05.gif" width="21" height="21"> <span class="defaultfieldname">Para ingresar un nuevo producto al cat&aacute;logo </span><b onClick="expandcontent('aleg1')" style="cursor:hand; cursor:pointer"> [Haga clic aqu&iacute;] </B><span class="defaultfieldname">por favor aseg&uacute;rese que el producto no exista, realizando previamente una b&uacute;squeda. </span></div>
            </span></div></td>
      </tr>
      <tr>
        <td><div align="left" class="titulocategoria">
          <div align="justify"></div>
        </div></td>
      </tr>
      <tr>
        <td><center>
		<div id="aleg1" class="switchcontent">
		  <table width="95%"  border="1" cellpadding="0" cellspacing="0">
            <tr>
              <td><table width="100%" border="0" align="center" cellspacing="1">
              <tr>
                <td height="8" colspan="3"><img src="../images/linea.gif" width="100%" height="6"></td>
              </tr>
              
             
              <tr>
                <td height="25" colspan="3"><span class="tituloproducto">Nit</span>                  <input name="txt_nit" type="text" id="txt_subcategoria2" value="" size="15"></td>
              </tr>
              <tr>
                <tr>
                <td height="25" colspan="3"><span class="tituloproducto">Nombre</span>                  <input name="txt_nombre" type="text" id="txt_subcategoria2" value="" size="75"></td>
              </tr>
              <tr>
                <tr>
                <td height="25" colspan="3"><span class="tituloproducto">Direccion</span>                  <input name="txt_direccion" type="text" id="txt_subcategoria2" value="" size="75"></td>
              </tr>
              <tr>
                <tr>
                <td height="25" colspan="3"><span class="tituloproducto">Telefono</span>                  <input name="txt_telefono" type="text" id="txt_subcategoria2" value="" size="75"></td>
              </tr>
              <tr>
                <td height="25" colspan="3"><span class="tituloproducto">Correo
                    <input name="txt_correo" type="text" id="txt_correo" size="40">
                </span>                  <div align="left"></div></td>
              </tr>
          
              <tr align="center" valign="top">
                <td height="25" colspan="3"><div align="left"><span class="tituloproducto">Contacto
                      <input name="txt_contacto" type="text" id="txt_contacto" size="82">
                </span></div></td>
              </tr>
              <tr align="center" valign="top">
                <td height="25" colspan="3"><p class="tituloproducto">
                  <input name="bt_guardar" onClick="Validar(this.form)" type="button" id="bt_guardar8" value="Guardar">
                  </p>                </td>
              </tr>
              <tr>
                <td height="8" colspan="3"><img src="../images/linea.gif" width="100%" height="6"></td>
              </tr>
            </table></td>
            </tr>
          </table>
            
		</div>  <!-- Fin del DIV para expander o contraer tabla -->
        </center></td>
      </tr>
      <tr>
        <td><b onClick="expandcontent('aleg1')" style="cursor:hand; cursor:pointer"><span class="curriculo"><img src="../images/e05.gif" width="21" height="21"></span></b> <span class="defaultfieldname">Para realizar b&uacute;squedas puede pulsar sobre una de las letras encerradas entre [], o bien escriba el nombre o parte del mismo para realizar una b&uacute;squeda espec&iacute;fica.</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="left" class="titulocategoria">
          <div align="center">CONSULTA DE  PRODUCTOS EXISTENTES EN EL CAT&Aacute;LOGO </div>
        </div></td>
      </tr>
      <tr>
        <td>        <div align="left" class="Estilo1">
          <div align="left"><strong><strong>            [<a href="nuevo_proveedor2.php?in=A" alt="Muestra los registros que inician con A">A</a>] [<a href="nuevo_proveedor2.php?in=B">B</a>] [<a href="nuevo_proveedor2.php?in=C">C</a>] [<a href="nuevo_proveedor2.php?in=D">D</a>] [<a href="nuevo_proveedor2.php?in=E">E</a>] [<a href="nuevo_proveedor2.php?in=F">F</a>] [<a href="nuevo_proveedor2.php?in=G">G</a>] [<a href="nuevo_proveedor2.php?in=H">H</a>] [<a href="nuevo_proveedor2.php?in=I">I</a>] [<a href="nuevo_proveedor2.php?in=J">J</a>] [<a href="nuevo_proveedor2.php?in=K">K</a>] [<a href="nuevo_proveedor2.php?in=L">L</a>] [<a href="nuevo_proveedor2.php?in=M">M</a>] [<a href="nuevo_proveedor2.php?in=N">N</a>] [<a href="nuevo_proveedor2.php?in=O">O</a>] [<a href="nuevo_proveedor2.php?in=P">P</a>] [<a href="nuevo_proveedor2.php?in=Q">Q</a>] [<a href="nuevo_proveedor2.php?in=R">R</a>] [<a href="nuevo_proveedor2.php?in=S">S</a>] [<a href="nuevo_proveedor2.php?in=T">T</a>] [<a href="nuevo_proveedor2.php?in=U">U</a>] [<a href="nuevo_proveedor2.php?in=V">V</a>] [<a href="nuevo_proveedor2.php?in=W">W</a>] [<a href="nuevo_proveedor2.php?in=X">X</a>] [<a href="nuevo_proveedor2.php?in=Y">Y</a>] [<a href="nuevo_proveedor2.php?in=Z">Z</a>] <a href="nuevo_proveedor2.php?in=all">[TODO]</a>                  <input name="txt_buscar" type="text" id="txt_buscar2" size="20">
              <input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar" value="Buscar">
          </strong></strong></div>
        </div></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="0" cellspacing="1" border="0" width="100%" id="table17">
      <tr align="center" bgcolor="#006699" class="thead">
        <td width="12%" class="titulotabla"><strong><strong>Nit</strong></strong></td>
        <td width="33%" class="titulotabla">Proveedor</td>
        <td width="27%" class="titulotabla">Direccion</td>
         <td width="18%" class="titulotabla">Telefono</td>
      
        
        <td width="10%" colspan="-1" class="titulotabla"><span class="titulotabla"><strong>Editar</strong></span></td>
     
      </tr>
		<?PHP
				if ($_REQUEST["txt_buscar"]!="")
				{
				$busqueda=strtoupper($_REQUEST["txt_buscar"]);					
				$consulta = "select * from tb_proveedor
									where nombre like '%$busqueda%' order by nombre";				
				}
				else	
				if (isset($_REQUEST["in"]))	
				{
					$inicial=$_REQUEST["in"];
					if ($inicial!="all")
						$consulta = "select * from tb_proveedor
				where nombre like '$inicial%' or nit like '$inicial%'";
						else
							$consulta = "select * from tb_proveedor
				order by nombre";
				}
				else
				{
					$consulta = "select * from tb_proveedor
				where nombre like 'A%'order by nombre";
				}
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
					$estado=$row["activo"];
					if ($estado==1)
					{										
					echo '<tr class='.$clase.'>';								
					echo '<td>'.$row["nit"].'</td><td>'.utf8_encode($row["nombre"]).'</td><td>'.$row["direccion"].'</td><td>'.$row["telefonos"].'</td><td><center><a href="editar_proveedor.php?id='.$row["rowid"].'"><img src="../images/iconos/ico_editar.png" width ="27"  height= "29" alt="Modificar información"></a></center></td></tr>';					
					}
					else
					echo '<tr class='.$clase.'><td>'.$row["nit"].'</td><td>'.utf8_encode($row["nombre"]).'</td><td>'.$row["direccion"].'</td><td>'.$row["telefonos"].'</td><td><center><a href="editar_proveedor.php?id='.$row["rowid"].'"><img src="../images/iconos/ico_editar.png" width ="27"  height= "29" alt="Modificar información"></a></center></td></tr>';										
					$i++;
				}
				$free_result($result);
			 ?>
    </table>
  </form>
  <p>&nbsp;</p>
</div>
</body>
</html>

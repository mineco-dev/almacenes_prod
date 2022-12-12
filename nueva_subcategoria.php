<?PHP
	require("../includes/sqlcommand.inc");	
	require('../includes/funciones.php');
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

if (isset($_REQUEST["txt_subcategoria"]))
{	
	if ($_REQUEST["txt_subcategoria"]!="")
	{	
		conectardb($almacen);
		$nueva_subcategoria=strtoupper($_REQUEST["txt_subcategoria"]);	
		$codigo=($_REQUEST["txt_codigo"]);	
		$categoria=$_REQUEST["cbo_categoria"];		
	
		$qry_si_existe="select * from cat_subcategoria where (subcategoria='$nueva_subcategoria' and codigo_subcategoria=$codigo and codigo_categoria='$categoria')";
		$res_qry_si_existe=$query($qry_si_existe);	
		$existe=false;	
		while($row_subcategoria=$fetch_array($res_qry_si_existe))
		{
			echo "esta subcategoria ya esta ingresada";
			$existe=true;
		}
		if ($existe==false)
		{					/*	
			//consultar el codigo del nuevo producto ingresado de esta categoria y subcategoria
			$qry_codigo_producto="select max(codigo_producto) as ultimo_cod_prod from cat_producto where codigo_subcategoria='$subcategoria' and codigo_categoria='$categoria'";
			$res_qry_codigo_producto=$query($qry_codigo_producto);	
			while($row_codigo_producto=$fetch_array($res_qry_codigo_producto))
			{
				$ult_cod_prod_mineco=$row_codigo_producto["ultimo_cod_prod"]+1;					
			}  */
			$nombre_usuario=$_SESSION["user_name"];			
			$qry_producto="INSERT INTO cat_subcategoria(codigo_subcategoria, codigo_categoria, categoria, activo, usuario_creo, fecha_creado) 
							VALUES ($codigo, $categoria, '$nueva_categoria', 1, '$nombre_usuario', getdate())";
			$query($qry_producto);		
								
	/*		// Insertar el nuevo producto con saldo cero, al inventario por bodega
			$qry_bodegas="Select * from cat_bodega where activo=1";
			$res_qry_bodegas=$query($qry_bodegas);
			while($row_bodegas=$fetch_array($res_qry_bodegas))
			{
				$codigo_bodega=$row_bodegas["codigo_bodega"];
				$qry_producto="INSERT INTO tb_inventario(codigo_bodega, codigo_producto, codigo_categoria, codigo_subcategoria, existencia, ultimo_ingreso, usuario_ingreso) 
							   VALUES ($codigo_bodega, $ult_cod_prod_mineco, $categoria, $subcategoria, 0, getdate(), '$nombre_usuario')";
				$query($qry_producto);			
			}
		
		*/
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
  if (form.cbo_categoria.value == "0" && form.txt_buscar.value == "")
  { 
  	alert("Seleccione la clasificación de la categoria"); 
	form.cbo_subcategoria.focus(); 
	return;
 }
 
 if (form.txt_codigo.value == "" && form.txt_buscar.value == "")
  { 
  	alert("Escriba el codigo de la Subcategoria"); 
	form.txt_codigo.focus(); 
	return;
 }
  if (form.txt_subcategoria.value == "" && form.txt_buscar.value == "")
  { 
  	alert("Escriba la subcategoria"); 
	form.txt_subcategoria.focus(); 
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
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="HojaEstilo.css" rel="stylesheet" type="text/css" />
<link href="estilos/style.css" rel="stylesheet" type="text/css" media="screen" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css">
</head>
<body oncontextmenu="return false">
<form method="post" action="" name="form1">
<table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td>
<div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
    <li class="TabbedPanelsTab" tabindex="0"><strong>Ingreso de un nuevo producto a la categoria</strong></li>
    
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
      <table width="99%" border="0" align="center" cellpadding="0" cellspacing="0" class="panel">
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
         <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
        
    <tr>
               <td valign="top">&nbsp;</td>
                  <td>Categoria</td>
                  <td colspan="2">
                  <?PHP
				  	conectardb($almacen);
					$qry_categoria="SELECT codigo_categoria, categoria FROM cat_categoria
										WHERE activo=1 ORDER BY codigo_categoria";										
					$res_qry_categoria=$query($qry_categoria);	
					echo('<select name="cbo_categoria">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row_categoria=$fetch_array($res_qry_categoria))
					{
						echo'<option value="'.$row_categoria["codigo_categoria"].'">'.$row_categoria["codigo_categoria"].'-'.$row_categoria["categoria"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_categoria);
				?>
                 <span class="tituloproducto">
                  </span></td>
              </tr>
               <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
              <tr>
            
             <td valign="top">&nbsp;</td>
                <td>Nuevo Codigo de la Subcategoria</td>
                <td colspan="2"><input name="txt_codigo" type="text" id="txt_codigo" value="" size="8"></td>
              </tr>
              
               <tr>
          <td valign="top">&nbsp;</td>
          <td>&nbsp;</td>
          <td colspan="2">&nbsp;</td>
        </tr>
              
              <tr>
               <td valign="top">&nbsp;</td>
                <td>Nombre Subcategoria</td>
                <td colspan="2"><input name="txt_subcategoria" type="text" id="txt_subcategoria" size="40">
                 <div align="left"></div></td>
              </tr>
      <tr>
     <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="4">&nbsp;</td>
        </tr>
      </table>
 </tr>
      </table>
  </td>
</tr>
</table>
<br>
<br>

<p align="center">
  <input name="cmd_guardar" type="button" onClick="validar(this.form)" id="cmd_guardar" value="Guardar hoja de ingreso" >
</p>
   

 <tr>
        <td><b onClick="expandcontent('aleg1')" style="cursor:hand; cursor:pointer"><span class="curriculo"><img src="../images/e05.gif" width="21" height="21"></span></b> <span class="defaultfieldname">Para realizar b&uacute;squedas puede pulsar sobre una de las letras encerradas entre [], o bien escriba el nombre o parte del mismo para realizar una b&uacute;squeda espec&iacute;fica.</span></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        
   <div id="TabbedPanels1" class="TabbedPanels">
  <ul class="TabbedPanelsTabGroup">
  
    
  </ul>
  <div class="TabbedPanelsContentGroup">
    <div class="TabbedPanelsContent">
        
        <td><div align="left" class="titulocategoria">
          <div align="center">CONSULTA DE  SUBCATEGORIAS EXISTENTES EN EL CAT&Aacute;LOGO </div>
        </div></td>
      </tr>
      <tr>
        <td>        <div align="left" class="Estilo1">
          <div align="left"><strong><strong>            [<a href="nueva_subcategoria.php?in=A" alt="Muestra los registros que inician con A">A</a>] [<a href="nueva_subcategoria.php?in=B">B</a>] [<a href="nueva_subcategoria.php?in=C">C</a>] [<a href="nueva_subcategoria.php?in=D">D</a>] [<a href="nueva_subcategoria.php?in=E">E</a>] [<a href="nueva_subcategoria.php?in=F">F</a>] [<a href="nueva_subcategoria.php?in=G">G</a>] [<a href="nueva_subcategoria.php?in=H">H</a>] [<a href="nueva_subcategoria.php?in=I">I</a>] [<a href="nueva_subcategoria.php?in=J">J</a>] [<a href="nueva_subcategoria.php?in=K">K</a>] [<a href="nueva_subcategoria.php?in=L">L</a>] [<a href="nueva_subcategoria.php?in=M">M</a>] [<a href="nueva_subcategoria.php?in=N">N</a>] [<a href="nueva_subcategoria.php?in=O">O</a>] [<a href="nueva_subcategoria.php?in=P">P</a>] [<a href="nueva_subcategoria.php?in=Q">Q</a>] [<a href="nueva_subcategoria.php?in=R">R</a>] [<a href="nueva_subcategoria.php?in=S">S</a>] [<a href="nueva_subcategoria.php?in=T">T</a>] [<a href="nueva_subcategoria.php?in=U">U</a>] [<a href="nueva_subcategoria.php?in=V">V</a>] [<a href="nueva_subcategoria.php?in=W">W</a>] [<a href="nueva_subcategoria.php?in=X">X</a>] [<a href="nueva_subcategoria.php?in=Y">Y</a>] [<a href="nueva_subcategoria.php?in=Z">Z</a>] <a href="nueva_subcategoria.php?in=all">[TODO]</a>                  <input name="txt_buscar" type="text" id="txt_buscar2" size="20">
              <input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar" value="Buscar">
          </strong></strong></div>
        </div></td>
      </tr>
    </table>
   
   
 
   
    <table class="tborder" cellpadding="0" cellspacing="1" border="0" width="100%" id="table17">
      <tr align="center" bgcolor="#aeccf2" class="thead">
        <td width="21%" height="16" class="titulotabla"><strong><strong>Codigo SubCategoria</strong></strong></td>
        <td width="53%" class="titulotabla"><strong>SubCategoria</strong></td>
        <td width="13%" colspan="-1" class="thead Estilo3"><span class="titulotabla"><strong>Editar</strong></span></td>
       
      </tr>
		<?PHP
				if ($_REQUEST["txt_buscar"]!="")
				{
				$busqueda=strtoupper($_REQUEST["txt_buscar"]);					
				$consulta = "select * from cat_subcategoria
									where subcategoria like '%$busqueda%' and activo=1 order by subcategoria";				
				}
				else	
				if (isset($_REQUEST["in"]))	
				{
					$inicial=$_REQUEST["in"];
					if ($inicial!="all")
						$consulta = "select * from cat_subcategoria
				where subcategoria like '$inicial%' and activo=1";
						else
							$consulta = "select * from cat_subcategoria
				order by subcategoria";
				}
				else
				{
					$consulta = "select * from cat_subcategoria
				where subcategoria like 'A%' and activo=1 order by subcategoria";
				}
				conectardb($almacen);
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					$estado=$row["activo"];
					if ($estado==1)
					{										
					echo '<tr class='.$clase.'>';								
					echo '<td>'.$row["codigo_subcategoria"].'</td><td>'.$row["subcategoria"].'</td><td><center><a href="editar_subcategoria.php?id='.$row["rowid"].'"><img src="../images/iconos/ico_editar.jpg" alt="Modificar información"></a></center></td></tr>';					
					}
					else
						echo '<tr class='.$clase.'><td>'.$row["codigo_subcategoria"].'</td><td>'.$row["subcategoria"].'</td><td><center><a href="editar_subcategoria.php?id='.$row["rowid"].'"><img src="../images/iconos/ico_editar.jpg" alt="Modificar información"></a></center></td></tr>';										
					$i++;
				}
				$free_result($result);
			 ?>
    </table>
</form>

<p>&nbsp;</p>

</body>
</html>
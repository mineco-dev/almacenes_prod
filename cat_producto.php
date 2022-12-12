<?PHP
	require("../includes/funciones.php");
	require("../includes/sqlcommand.inc");
	//ini_set('display_errors', 1);
	//ini_set('display_startup_errors', 1);
	//error_reporting(E_ALL);
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

if (isset($_REQUEST["txt_producto"]))
{	
	if ($_REQUEST["txt_producto"]!="")
	{	
		conectardb($almacen);
		$nuevo_producto=strtoupper(utf8_decode($_REQUEST["txt_producto"]));	
		$marca=strtoupper($_REQUEST["txt_marca"]);	
		$presentacion=$_REQUEST["cbo_medida"];
		$categoria=$_REQUEST["cbo_categoria"];	
		$subcategoria=$_REQUEST["cbo_subcategoria"];	
		$estado=$_REQUEST["cbo_estado"];	
		
		$uso=$_REQUEST["txt_uso"];	
		$qry_si_existe="select * from cat_producto where (producto='$nuevo_producto' and codigo_medida=$presentacion and marca='$marca' and codigo_categoria='$categoria' and codigo_subcategoria='$subcategoria')";
		$res_qry_si_existe=$query($qry_si_existe);	
		$existe=false;	
		while($row_subcategoria=$fetch_array($res_qry_si_existe))
		{
			echo "este producto ya esta ingresado";
			$existe=true;
		}
		if ($existe==false)
		{						
			//consultar el codigo del nuevo producto ingresado de esta categoria y subcategoria
			$qry_codigo_producto="select max(codigo_producto) as ultimo_cod_prod from cat_producto where codigo_subcategoria='$subcategoria' and codigo_categoria='$categoria'";
			$res_qry_codigo_producto=$query($qry_codigo_producto);	
			while($row_codigo_producto=$fetch_array($res_qry_codigo_producto))
			{
				$ult_cod_prod_mineco=$row_codigo_producto["ultimo_cod_prod"]+1;					
			}
			$nombre_usuario=$_SESSION["user_name"];			
			$qry_producto="INSERT INTO cat_producto(codigo_categoria, codigo_subcategoria, codigo_producto, producto, marca, codigo_medida, codigo_estado, uso, activo, usuario_creo, fecha_creado) 
							VALUES ($categoria, $subcategoria, '$ult_cod_prod_mineco', '$nuevo_producto', '$marca', $presentacion, 1, '$uso', 1,'$nombre_usuario', getdate())";
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
 /* if (form.txt_marca.value == "" && form.txt_buscar.value == "")
  { 
  	alert("Escriba la marca u otra identificación"); 
	form.txt_marca.focus(); 
	return;
 }*/
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
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" > -->

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
        <td class="titulocategoria"><div align="center">INGRESO DE NUEVOS PRODUCTOS AL CAT&Aacute;LOGO</div></td>
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
                <td height="25" colspan="3"><span class="tituloproducto">Categor&iacute;a
                  <?PHP
				  	conectardb($almacen);
					$qry_categoria="SELECT s.codigo_categoria, s.categoria FROM cat_categoria s
										WHERE activo=1 ORDER BY s.codigo_categoria";	
					$res_qry_categoria=$query($qry_categoria);					
					?>
					<select name="cbo_categoria" id="cbo_categoria" onChange="javascript:cargarCombo('cbo_subcategoria.php', 'cbo_categoria', 'Div_subcategoria')">
					<?PHP
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row_categoria=$fetch_array($res_qry_categoria))
					{
						echo'<option value="'.$row_categoria["codigo_categoria"].'">'.$row_categoria["codigo_categoria"].'-'.$row_categoria["categoria"].'</option>';
					}
					?>
					</select>
					<?				
						$free_result($res_qry_categoria);
					?>
                </span></td>
              </tr>
              <tr>
                <td height="25" colspan="3"><span class="tituloproducto">Subcategoria
				<div id="Div_subcategoria">
		  		<select name="subcategoria"  id="select3">
		  		</select>
	 			 </div>
                  Presentaci&oacute;n
                  <?PHP
				  	conectardb($almacen);
					$qry_medida="SELECT * FROM cat_medida WHERE activo=1 ORDER BY unidad_medida";										
					$res_qry_medida=$query($qry_medida);	
					echo('<select name="cbo_medida">');
					$nombre=":: Seleccione ::";
					echo'<option value="0">'.$nombre.'</option>';
					while($row_medida=$fetch_array($res_qry_medida))
					{
						echo'<option value="'.$row_medida["codigo_medida"].'">'.$row_medida["unidad_medida"].'</option>';
					}
					echo('</select>');				
					$free_result($res_qry_medida);
				?>
                  <a href="medida.php?ref=4"><img src="../images/iconos/ico_plus.gif" alt="Agregar nueva presentaci&oacute;n" width="17" height="17" border="0"></a></span><span class="tituloproducto">
                  </span></td>
              </tr>
              <tr>
                <td height="25" colspan="3"><span class="tituloproducto">Producto</span>                  <input name="txt_producto" type="text" id="txt_subcategoria2" value="" size="75"></td>
              </tr>
              <tr>
                <td height="25" colspan="3" style="display:none"><span class="tituloproducto">Marca
                  <input name="txt_marca" type="text" id="txt_marca" size="40">
                </span>                  <div align="left"></div></td>
              </tr>
              
              <tr align="center" valign="top">
                <td height="25" colspan="3"><div align="left"><span class="tituloproducto">código de catálogo MINFIN
                  <input name="txt_uso" type="text" id="txt_uso" size="60">
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
          <div align="left"><strong><strong>            [<a href="cat_producto.php?in=A" alt="Muestra los registros que inician con A">A</a>] [<a href="cat_producto.php?in=B">B</a>] [<a href="cat_producto.php?in=C">C</a>] [<a href="cat_producto.php?in=D">D</a>] [<a href="cat_producto.php?in=E">E</a>] [<a href="cat_producto.php?in=F">F</a>] [<a href="cat_producto.php?in=G">G</a>] [<a href="cat_producto.php?in=H">H</a>] [<a href="cat_producto.php?in=I">I</a>] [<a href="cat_producto.php?in=J">J</a>] [<a href="cat_producto.php?in=K">K</a>] [<a href="cat_producto.php?in=L">L</a>] [<a href="cat_producto.php?in=M">M</a>] [<a href="cat_producto.php?in=N">N</a>] [<a href="cat_producto.php?in=O">O</a>] [<a href="cat_producto.php?in=P">P</a>] [<a href="cat_producto.php?in=Q">Q</a>] [<a href="cat_producto.php?in=R">R</a>] [<a href="cat_producto.php?in=S">S</a>] [<a href="cat_producto.php?in=T">T</a>] [<a href="cat_producto.php?in=U">U</a>] [<a href="cat_producto.php?in=V">V</a>] [<a href="cat_producto.php?in=W">W</a>] [<a href="cat_producto.php?in=X">X</a>] [<a href="cat_producto.php?in=Y">Y</a>] [<a href="cat_producto.php?in=Z">Z</a>] <a href="cat_producto.php?in=all">[TODO]</a>                  <input name="txt_buscar" type="text" id="txt_buscar2" size="20">
              <input name="bt_buscar" onClick="Validar(this.form)" type="button" id="bt_buscar" value="Buscar">
          </strong></strong></div>
        </div></td>
      </tr>
    </table>
    <table class="tborder" cellpadding="0" cellspacing="1" border="0" width="100%" id="table17">
      <tr align="center" bgcolor="#006699" class="thead">
	  	<td width="5%" class="titulotabla"><strong><strong>C&oacute;digo</strong></strong></td>
        <td width="37%" class="titulotabla"><strong><strong>Descripci&oacute;n</strong></strong></td>
        <td width="23%" class="titulotabla">Marca</td>
        <td width="24%" class="titulotabla">Presentaci&oacute;n</td>
        <td width="6%" colspan="-1" class="titulotabla"><span class="titulotabla"><strong>Editar</strong></span></td>
       
      </tr>
	<?PHP
				if ($_REQUEST["txt_buscar"]!="")
				{
				$busqueda=strtoupper(utf8_decode($_REQUEST["txt_buscar"]));					
				$consulta = "SELECT * FROM cat_producto p
				inner join cat_medida m on p.codigo_medida=m.codigo_medida
									where p.activo=1 and producto like '%$busqueda%' ";			
									
				}
				else	
				if (isset($_REQUEST["in"]))	
				{
					$inicial=$_REQUEST["in"];
					if ($inicial!="all")
						$consulta = "SELECT * FROM cat_producto p
				inner join cat_medida m on p.codigo_medida=m.codigo_medida
				where p.activo=1 and producto like '$inicial%' ";
						else
							$consulta = "SELECT * FROM cat_producto p
				inner join cat_medida m on p.codigo_medida=m.codigo_medida where p.activo=1
				order by p.producto ";
				}
				else
				{
					$consulta = "SELECT * FROM cat_producto p
				inner join cat_medida m on p.codigo_medida=m.codigo_medida
				where p.producto like 'A%' and p.activo=1 order by producto";
				}
				conectardb($almacen);
				$result=$query($consulta);
				$i = 0;				
				while($row=$fetch_array($result))
				{
					$completo=$row["producto"]."-".$row["unidad_medida"];
					$clase = "detalletabla2";
					if ($i % 2 == 0) 
					{
						$clase = "detalletabla1";
					}
					$estado=$row["activo"];
					if ($estado==1)
					{										
					echo '<tr class='.$clase.'>';								
					echo '<td class= "colcentrada"> '.utf8_encode($row["codigo_producto"]).'</td>';
					echo '<td>'.utf8_encode($row["producto"]).'</td><td>'.utf8_encode($row["marca"]).'</td><td>'.$row["unidad_medida"].'</td><td><center><a href="editar_producto.php?id='.$row["rowid"].'"><img src="../images/iconos/ico_editar.png" width ="27"  height= "29" alt="Modificar información"></a></center></td></tr>';					
					}
					else
						echo '<tr class='.$clase.'><td>'.utf8_encode($row["producto"]).'</td><td>'.utf8_encode($row["marca"]).'</td><td>'.$row["unidad_medida"].'</td><td><center><a href="editar_producto.php?id='.$row["rowid"].'"><img src="../images/iconos/ico_editar.png"  width ="27"  height= "29" alt="Modificar información"></a></center></td></tr>';										
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
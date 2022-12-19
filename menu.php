<?php 
header('Content-Type: text/html; charset=UTF-8');
?>

<!DOCTYPE html>
<html lang="es">
<head>
	
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
	<link rel="stylesheet" type="text/css" href="helpdesk.css">
<STYLE TYPE="text/css">
<!--
a:link {text-decoration: none}
a:visited {text-decoration: none}
a:active {text-decoration: none}
a:hover {text-decoration: none}
color : #006699;	
-->
.menutitle{
	cursor:pointer;
	margin-top : 2px;
	padding-bottom : 1px;
	margin-bottom : 1px;
	margin-left : 10px;
	margin-right : 0px;
	font-size : 16px;
	font-family : Tahoma,Verdana,Arial;
	text-align:left;	
	text-decoration:none;	
	color : #006699;			
}

/*codigo anterior -- 23-11-2017 --*/

/*.submenu{
	cursor:pointer;
	margin-top : 2px;
	padding-bottom : 1px;
	margin-bottom : 1px;
	margin-left : 22px;
	font-size : 11px;
	font-family : Tahoma,Verdana,Arial;
	text-align:left;
	text-decoration:none;		
	color : #006699;
}
*/
a { text-decoration: none; }
.submenu a { margin: 0px; display: block; width: 100%; height: 100%; }
.submenu{
	
	cursor:pointer;

	
	font-size : 13px;
	font-family : Tahoma,Verdana,Arial;
	text-align:left;
	text-decoration:none;		
	color : #006699;
	
}
/*.submenu ul {
	background-color: #ecf0f1;
}*/
.submenu ul li{
	border-bottom: 1px solid #a6a8a9;
	color: #776b6c;
	height: 100%;
	line-height: 40px;
	padding: 0 0;

}

.submenu ul li:hover {
	background-color: #56a3c7;
	color: #ecf0f1;
}

.submenu ul li a {
	color: #3e4146;
}

.submenu ul li:hover a {
	color: #ecf0f1;
}



.Estilo1 {color: #006699}
</STYLE>
 <script type="text/javascript">

/***********************************************
* Switch Menu script- by Martial B of http://getElementById.com/
* Modified by Dynamic Drive for format & NS4/IE4 compatibility
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

var persistmenu="yes" //"yes" or "no". Make sure each SPAN content contains an incrementing ID starting at 1 (id="sub1", id="sub2", etc)
var persisttype="sitewide" //enter "sitewide" for menu to persist across site, "local" for this page only

if (document.getElementById){ //DynamicDrive.com change
document.write('<style type="text/css">\n')
document.write('.submenu{display: none;}\n')
document.write('</style>\n')
}

function SwitchMenu(obj){
	if(document.getElementById){
	var el = document.getElementById(obj);
	var ar = document.getElementById("masterdiv").getElementsByTagName("span"); //DynamicDrive.com change
		if(el.style.display != "block"){ //DynamicDrive.com change
			for (var i=0; i<ar.length; i++){
				if (ar[i].className=="submenu") //DynamicDrive.com change
				ar[i].style.display = "none";
			}
			el.style.display = "block";
		}else{
			el.style.display = "none";
		}
	}
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

function onloadfunction(){
if (persistmenu=="yes"){
var cookiename=(persisttype=="sitewide")? "switchmenu" : window.location.pathname
var cookievalue=get_cookie(cookiename)
if (cookievalue!="")
document.getElementById(cookievalue).style.display="block"
}
}

function savemenustate(){
var inc=1, blockid=""
while (document.getElementById("sub"+inc)){
if (document.getElementById("sub"+inc).style.display=="block"){
blockid="sub"+inc
break
}
inc++
}
var cookiename=(persisttype=="sitewide")? "switchmenu" : window.location.pathname
var cookievalue=(persisttype=="sitewide")? blockid+";path=/" : blockid
document.cookie=cookiename+"="+cookievalue
}

if (window.addEventListener)
window.addEventListener("load", onloadfunction, false)
else if (window.attachEvent)
window.attachEvent("onload", onloadfunction)
else if (document.getElementById)
window.onload=onloadfunction

if (persistmenu=="yes" && document.getElementById)
window.onunload=savemenustate
</script> 



<body>

<?php	
	echo '<div id="masterdiv" class="barramenu">';
	// Opciones principales del menu izquierdo, clasificado por subgerencia
	require_once('connection/helpdesk.php');
	$consulta = "select * from view_menu WHERE ((codigo_usuario ='$user') AND (codigo_dependencia = '$dependencia')) and ref_submenu='1' order by orden_x_dependencia";	
	$result=mssql_query($consulta);				
	
	while($row=mssql_fetch_array($result))
	{	
				// print($row["det_codigo_grupo_det"]);
				// $orden_x_dependencia=$row["orden_x_dependencia"];
				$orden_x_dependencia=$row["orden_x_dependencia"];
				$link=$row["det_link"];		
				$sub="sub$orden_x_dependencia";		
				$codigo_grupo_det=$row["det_codigo_grupo_det"];	
				if( ($codigo_grupo_det == 251 && $dependencia == 24) || ($codigo_grupo_det == 2 && $dependencia == 33) ){		
							if ($link=="NA")  //si las opciones principales no tienen link, en su lugar aparece NA= no aplica, porque contiene un submenu, al dar clic lo expande
							{echo '<div class="menutitle" onclick="SwitchMenu(\''.$sub.'\')"><B>'.utf8_encode($row["det_nombre_rol"]).'</B></div>';
							}	
							else //si tiene link en el campo link, entonces al dar clic sobre la opcion lo ejecutar�
							{echo '<div class="menutitle"><a href="'.$row["det_link"].'" target="'.$row["destino"].'">'.utf8_encode($row["det_nombre_rol"]).'</a></div>'; 					
							}
						echo '<img src="images/hr01.gif" width="137" height="5" alt="" border="0"><br>';
				}else if($dependencia != 24 && $dependencia != 33)
				{
						if ($link=="NA")  //si las opciones principales no tienen link, en su lugar aparece NA= no aplica, porque contiene un submenu, al dar clic lo expande
						{
							echo '<div class="menutitle" onclick="SwitchMenu(\''.$sub.'\')"><B>'.utf8_encode($row["det_nombre_rol"]).'</B></div>';
						}	
						else //si tiene link en el campo link, entonces al dar clic sobre la opcion lo ejecutar�
						{
								if(($codigo_grupo_det != 14 && $dependencia == 1)){
									echo '<div class="menutitle"><a href="'.$row["det_link"].'" target="'.$row["destino"].'">'.utf8_encode($row["det_nombre_rol"]).'</a></div>';
									echo '<img src="images/hr01.gif" width="137" height="5" alt="" border="0"><br>';	
								}
								else if($dependencia != 1)
								{
									echo '<div class="menutitle"><a href="'.$row["det_link"].'" target="'.$row["destino"].'">'.utf8_encode($row["det_nombre_rol"]).'</a></div>';
									echo '<img src="images/hr01.gif" width="137" height="5" alt="" border="0"><br>';
								}
						}
				}
				echo '<span class="submenu" id="'.$sub.'"><ul>'; //contenido del submenu, de acuerdo a la opcion seleccionada, su referencia es codigo_grupo_det
				
				$consulta2 = "select * from view_menu WHERE ((codigo_usuario ='$user') AND (codigo_dependencia = '$dependencia')) and ref_submenu='$codigo_grupo_det' order by orden_x_dependencia";
						$result2=mssql_query($consulta2);	
				while($row2=mssql_fetch_array($result2))
				{	
							$NoSubMenu = $row2["det_codigo_grupo_det"];
							$codigo_tecnico=$row2["codigo_empleado"];
							if ($codigo_tecnico>0)	//si codigo_empleado no es nulo, actualiza el campo tickets, para saber cuantos tickets tiene pendientes.			
							{
								$actualizatickets = "EXEC proc_conteo_tickets_up @vcodigo_tecnico='$codigo_tecnico', @vcodigo_dependencia='$dependencia'";
								$resultatickets=mssql_query($actualizatickets);
						
								//consultar cuantos ticket tiene pendientes de resolver el empleado
								$consultatickets = "EXEC proc_conteo_tickets_view @vcodigo_tecnico='$codigo_tecnico', @vcodigo_dependencia='$dependencia'";
								$resultatickets2=mssql_query($consultatickets);				
								while($row3=mssql_fetch_array($resultatickets2))  //si tiene tickets, muestra el total a la par del nombre del empleado()
								{
									echo '<a href="'.$row2["det_link"].'?emp='.$row2["codigo_empleado"].'" target="'.$row2["destino"].'"><img src="images/e02.gif" width="9" height="5" alt="" border="0" align="absmiddle">&nbsp;'.utf8_encode($row2["det_nombre_rol"]).'<b>&nbsp;('.$row3["tickets_compl"].'/'.$row3["tickets"].')</b></a><br>';
								}	
							}
							else //si la subopcion no es un empleado
							{
									if($dependencia == 1 && $NoSubMenu != 91){
										echo '<a href="'.$row2["det_link"].'" target="'.$row2["destino"].'"><img src="images/e02.gif" width="9" height="5" alt="" border="0" align="absmiddle">&nbsp;'.utf8_encode($row2["det_nombre_rol"]).'</a><br>';
									}
									else if($dependencia != 1){
										echo '<li><a href="'.$row2["det_link"].'" target="'.$row2["destino"].'">&nbsp;'.utf8_encode($row2["det_nombre_rol"]).'</a></li>';	
									}
							}
					//echo '<img src="images/hr01.gif" width="137" height="3" alt="" border="0"><br>'; //linea horizontal para separar opciones del menu <img src="images/e02.gif" width="9" height="5" alt="" border="0" align="absmiddle">					
				}
				echo '</ul></span>';
		}

		echo '</div>';
		mssql_close($s);									
?>



</body>
</html>

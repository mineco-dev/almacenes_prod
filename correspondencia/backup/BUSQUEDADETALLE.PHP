<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml">

<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
   <script language="javascript">
 //texto del mensaje
   var texto_estado = "                                                                                 Bienvenidos Al Sistema de Correspondencia"
   var posicion = 0
   
    //funcion para mover el texto de la barra de estado
   function mueve_texto(){
      if (posicion < texto_estado.length) 
         posicion ++;
      else
  posicion = 1;
      string_actual = texto_estado.substring(posicion) + texto_estado.substring(0,posicion)
      window.status = string_actual
      setTimeout("mueve_texto()",50)
   }
   mueve_texto()
   </script>



<?php
//include ("includes/javascript.php");
include ("temas/xp/tema.php");
include ("ajax/ajax_menu.js");
?>
<html>
<head>

    <style type="text/css">
	   A:link, A:visited { text-decoration: underline }
	   A:hover { text-decoration: none }
	</style>



        <style type="text/css">
  <!--
  h1 {font-size: 15pt; font-family: Arial;font-weight: bold; color: maroon;}
  h2 {font-size: 13pt; font-family: Arial; font-weight: bold;color: blue;}
  p {font-size: 10pt; font-family:Arial;color: black;}
  -->
        </style>

<style type="text/css">

	html{
		height:100%;
	}
	body{
	height:100%;
	margin:0px;
	padding:0px;
	font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
	background-color: #D0E6E3;
	}
	.ad{
		margin-top:130px;
	}
	h1{
		font-size:0.9em;
	}

	a{
		color:red;
	}
	/* Entire pane */

	#dhtmlgoodies_xpPane{
		background-color:#7190e0;
		float:left;
		height:1500px;
		width:195px;
	}
	#dhtmlgoodies_xpPane .dhtmlgoodies_panel{
		margin-left:5px;
		margin-right:10px;
		margin-top:5px;
	}
	#dhtmlgoodies_xpPane .panelContent{
		font-size:1.0em;
		background-image:url('/images/menu_principal/bg_pane_right.gif');
		background-position:top right;
		background-repeat:repeat-y;
		border-left:2px solid #FFF;
		border-bottom:2px solid #FFF;
		padding-left:1px;
		padding-right:1px;
		overflow:hidden;
		position:relative;
		clear:both;
	}
	#dhtmlgoodies_xpPane .panelContent div{
		position:relative;
	}
	#dhtmlgoodies_xpPane .dhtmlgoodies_panel .topBar{
		background-image:url('/images/menu_principal/bg_panel_top_right.gif');
		background-repeat:no-repeat;
		background-position:top right;
		height:25px;
		padding-right:15px;
		cursor:pointer;
		overflow:hidden;

	}
	#dhtmlgoodies_xpPane .dhtmlgoodies_panel .topBar span{
		line-height:30px;
		vertical-align:middle;
		font-family:arial;
		font-size:0.7em;
		color:#215DC6;
		font-weight:bold;
		float:left;
		padding-left:7px;
	}
	#dhtmlgoodies_xpPane .dhtmlgoodies_panel .topBar img{
		float:right;
		cursor:pointer;
	}
	#otherContent{	/* Normal text content */
		float:left;	/* Firefox - to avoid blank white space above panel */
		padding-left:12px;	/* A little space at the left */
	}
	.Estilo6 {
	font-size: 12px;
	color: #0000CC;
}
.Estilo7 {color: #D0E6E3}
</style>
	<script type="text/javascript">
	
		var xpPanel_slideActive = true;	// Slide down/up active?
	var xpPanel_slideSpeed = 20;	// Speed of slide
	var xpPanel_onlyOneExpandedPane = false;	// Only one pane expanded at a time ?

	var dhtmlgoodies_xpPane;
	var dhtmlgoodies_paneIndex;

	var savedActivePane = false;
	var savedActiveSub = false;

	var xpPanel_currentDirection = new Array();

	var cookieNames = new Array();


	var currentlyExpandedPane = false;

	/*
	These cookie functions are downloaded from
	http://www.mach5.com/support/analyzer/manual/html/General/CookiesJavaScript.htm
	*/
	function Get_Cookie(name) {
	   var start = document.cookie.indexOf(name+"=");
	   var len = start+name.length+1;
	   if ((!start) && (name != document.cookie.substring(0,name.length))) return null;
	   if (start == -1) return null;
	   var end = document.cookie.indexOf(";",len);
	   if (end == -1) end = document.cookie.length;
	   return unescape(document.cookie.substring(len,end));
	}
	// This function has been slightly modified
	function Set_Cookie(name,value,expires,path,domain,secure) {
		expires = expires * 60*60*24*1000;
		var today = new Date();
		var expires_date = new Date( today.getTime() + (expires) );
	    var cookieString = name + "=" +escape(value) +
	       ( (expires) ? ";expires=" + expires_date.toGMTString() : "") +
	       ( (path) ? ";path=" + path : "") +
	       ( (domain) ? ";domain=" + domain : "") +
	       ( (secure) ? ";secure" : "");
	    document.cookie = cookieString;
	}

	function cancelXpWidgetEvent()
	{
		return false;

	}

	function showHidePaneContent(e,inputObj)
	{
		if(!inputObj)inputObj = this;

		var img = inputObj.getElementsByTagName('IMG')[0];
		var numericId = img.id.replace(/[^0-9]/g,'');
		var obj = document.getElementById('paneContent' + numericId);
		if(img.src.toLowerCase().indexOf('up')>=0){
			currentlyExpandedPane = false;
			img.src = img.src.replace('up','down');
			if(xpPanel_slideActive){
				obj.style.display='block';
				xpPanel_currentDirection[obj.id] = (xpPanel_slideSpeed*-1);
				slidePane((xpPanel_slideSpeed*-1), obj.id);
			}else{
				obj.style.display='none';
			}
			if(cookieNames[numericId])Set_Cookie(cookieNames[numericId],'0',100000);
		}else{
			if(this){
				if(currentlyExpandedPane && xpPanel_onlyOneExpandedPane)showHidePaneContent(false,currentlyExpandedPane);
				currentlyExpandedPane = this;
			}else{
				currentlyExpandedPane = false;
			}
			img.src = img.src.replace('down','up');
			if(xpPanel_slideActive){
				if(document.all){
					obj.style.display='block';
					//obj.style.height = '1px';
				}
				xpPanel_currentDirection[obj.id] = xpPanel_slideSpeed;
				slidePane(xpPanel_slideSpeed,obj.id);
			}else{
				obj.style.display='block';
				subDiv = obj.getElementsByTagName('DIV')[0];
				obj.style.height = subDiv.offsetHeight + 'px';
			}
			if(cookieNames[numericId])Set_Cookie(cookieNames[numericId],'1',100000);
		}
		return true;
	}



	function slidePane(slideValue,id)
	{
		if(slideValue!=xpPanel_currentDirection[id]){
			return false;
		}
		var activePane = document.getElementById(id);
		if(activePane==savedActivePane){
			var subDiv = savedActiveSub;
		}else{
			var subDiv = activePane.getElementsByTagName('DIV')[0];
		}
		savedActivePane = activePane;
		savedActiveSub = subDiv;

		var height = activePane.offsetHeight;
		var innerHeight = subDiv.offsetHeight;
		height+=slideValue;
		if(height<0)height=0;
		if(height>innerHeight)height = innerHeight;

		if(document.all){
			activePane.style.filter = 'alpha(opacity=' + Math.round((height / subDiv.offsetHeight)*100) + ')';
		}else{
			var opacity = (height / subDiv.offsetHeight);
			if(opacity==0)opacity=0.01;
			if(opacity==1)opacity = 0.99;
			activePane.style.opacity = opacity;
		}


		if(slideValue<0){
			activePane.style.height = height + 'px';
			subDiv.style.top = height - subDiv.offsetHeight + 'px';
			if(height>0){
				setTimeout('slidePane(' + slideValue + ',"' + id + '")',10);
			}else{
				if(document.all)activePane.style.display='none';
			}
		}else{
			subDiv.style.top = height - subDiv.offsetHeight + 'px';
			activePane.style.height = height + 'px';
			if(height<innerHeight){
				setTimeout('slidePane(' + slideValue + ',"' + id + '")',10);
			}
		}




	}

	function mouseoverTopbar()
	{
		var img = this.getElementsByTagName('IMG')[0];
		var src = img.src;
		img.src = img.src.replace('.gif','_over.gif');

		var span = this.getElementsByTagName('SPAN')[0];
		span.style.color='#428EFF';

	}
	function mouseoutTopbar()
	{
		var img = this.getElementsByTagName('IMG')[0];
		var src = img.src;
		img.src = img.src.replace('_over.gif','.gif');

		var span = this.getElementsByTagName('SPAN')[0];
		span.style.color='';



	}


	function initDhtmlgoodies_xpPane(panelTitles,panelDisplayed,cookieArray)
	{
		dhtmlgoodies_xpPane = document.getElementById('dhtmlgoodies_xpPane');
		var divs = dhtmlgoodies_xpPane.getElementsByTagName('DIV');
		dhtmlgoodies_paneIndex=0;
		cookieNames = cookieArray;
		for(var no=0;no<divs.length;no++){
			if(divs[no].className=='dhtmlgoodies_panel'){

				var outerContentDiv = document.createElement('DIV');
				var contentDiv = divs[no].getElementsByTagName('DIV')[0];
				outerContentDiv.appendChild(contentDiv);

				outerContentDiv.id = 'paneContent' + dhtmlgoodies_paneIndex;
				outerContentDiv.className = 'panelContent';
				var topBar = document.createElement('DIV');
				topBar.onselectstart = cancelXpWidgetEvent;
				var span = document.createElement('SPAN');
				span.innerHTML = panelTitles[dhtmlgoodies_paneIndex];
				topBar.appendChild(span);
				topBar.onclick = showHidePaneContent;
				if(document.all)topBar.ondblclick = showHidePaneContent;
				topBar.onmouseover = mouseoverTopbar;
				topBar.onmouseout = mouseoutTopbar;
				topBar.style.position = 'relative';

				var img = document.createElement('IMG');
				img.id = 'showHideButton' + dhtmlgoodies_paneIndex;
				img.src = '/images1/menu_principal/arrow_up.gif';
				topBar.appendChild(img);

				if(cookieArray[dhtmlgoodies_paneIndex]){
					cookieValue = Get_Cookie(cookieArray[dhtmlgoodies_paneIndex]);
					if(cookieValue)panelDisplayed[dhtmlgoodies_paneIndex] = cookieValue==1?true:false;

				}

				if(!panelDisplayed[dhtmlgoodies_paneIndex]){
					outerContentDiv.style.height = '0px';
					contentDiv.style.top = 0 - contentDiv.offsetHeight + 'px';
					if(document.all)outerContentDiv.style.display='none';
					img.src = '/images1/menu_principal/arrow_down.gif';
				}

				topBar.className='topBar';
				divs[no].appendChild(topBar);
				divs[no].appendChild(outerContentDiv);
				dhtmlgoodies_paneIndex++;
			}
		}
	}
function carga(x){
//document.forms[0].yo.value=x;
// 	document.forms[0].submit();
//document.forms[0].yo.value=x;
 var capaContenedora = document.getElementById('d');
 	capaContenedora.innerHTML=x;
 	return;
}
	</script>


</head>
<body>
<!-- START OF PANE CODE -->

<div id="dhtmlgoodies_xpPane">
	

  <div align="center"><br>
      <a href="menu.php?cmd=resetall" class="Estilo4"><img src="imagenes/mineco.GIF" width="92" height="83" ></A><br>
    <br>
 <br>
  <br>
    <br>
  

  </div>
  <div class="dhtmlgoodies_panel">
				<div>
					<!-- Start content of pane -->
					<!-- End content -->
				</div>
  </div>
						<div class="dhtmlgoodies_panel">
				<div>
					<!-- Start content of pane -->



<!-- End content -->
			  </div>




			</div>

<br>
<br>
<br><br><br>

<div align="center">
BIENVENIDOS
</div>
</div>
	
	<script type="text/javascript">
		initDhtmlgoodies_xpPane(Array('INGRESO','CORRESPONDENCIA'),Array(true,false),Array('panel1','panel2'));
	</script>
	
		<!-- END OF PANE CONTENT -->
<div id="d"></div>		
<div id="formulario">

</form>
</div>
</body>
</html>



<!DOCTYPE html>
<html>
<head>
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<table width="200" border="4" cellspacing="0" cellpadding="5" align="center">
  <tr>
    <td><img src="imagenes/MINISTERIO1.gif" width="671" height="50"></td>
  </tr>
</table>
<br>
<br>

<body> 

<div align="center" ><span class="Estilo1"><strong>
CONTROL DE MENSAJERIA
</strong>
</span>
</div>
</marquee>
<br>
<br>

<form method = "POST" action = "http://mensajeria/BUSQUEDADETALLE.PHP">

<strong>INGRESO No. </strong>


<input type="text" name="buscar" size="20"><br><br>
<input type="submit" value="Buscar">

</form>





<?php 


if (!isset($buscar)){ 



//echo &quo 


echo "<p><a href=menu.php>Volver</p> \n"; 

echo "</html></body> \n"; 

exit; 

} 

$link = mssql_connect("SERVER_APPL", "msjharry","lisa1607"); 

mssql_select_db("MENSAJERIA", $link); 

echo "<div align='center' class=Estilo6>";
$sql = "SELECT DETALLE, RECIBIO, FECHA, HORA, STATUS, REMITENTE, DESCRIPCION, DESTINATARIO, RECIBIO_RECEPCION FROM VISTA4 WHERE DETALLE LIKE '$buscar' ORDER BY DETALLE" ; 

$result = mssql_query($sql, $link); 

if ($row = mssql_fetch_array($result)){ 



echo"<p>MENSAJERIA EN CAMINO</p>\n";

echo "<table border = '2' align='center' class=Estilo1> \n"; 





mssql_field_seek($result,0); 

while ($field = mssql_fetch_field($result)){ 

echo "<td><b>$field->name</b></td> \n"; 

} 

echo "</tr> \n"; 

do { 

echo "<tr> \n"; 

echo "<td align=center class=Estilo6>".$row["DETALLE"]."</td> \n"; 

echo "<td align=center class=Estilo6>".$row["RECIBIO"]."</td> \n"; 

echo "<td align=center class=Estilo6>".$row["FECHA"]."</td> \n"; 

echo "<td align=center class=Estilo6>".$row["HORA"]."</td> \n"; 

echo "<td align=center class=Estilo6>".$row["STATUS"]."</td> \n"; 

echo "<td align=center class=Estilo6>".$row["REMITENTE"]."</td> \n"; 

echo "<td align=center class=Estilo6>".$row["DESCRIPCION"]."</td> \n"; 

echo "<td align=center class=Estilo6>".$row["DESTINATARIO"]."</td> \n"; 

echo "<td align=center class=Estilo6>".$row["RECIBIO_RECEPCION"]."</td> \n"; 



echo "</tr> \n"; 

} while ($row = mssql_fetch_array($result)); 

echo "<p><a href=menu.php>Volver</p> \n"; 

echo "</table> \n"; 
echo "</div> \n";
} else { 

echo "<p>�No se ha encontrado ning�n registro!</p>\n"; 

echo"<p> MENSAJERIA EN CAMINO</p>\n";
echo "<p><a href=menu.php>Volver</p> \n"; 

} 

?>
</body>



</html>





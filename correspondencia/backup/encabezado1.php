<?php
//initialize the session
//session_start();

// ** Logout the current user. **
$logoutAction = $_SERVER['PHP_SELF']."?doLogout=true";
if ((isset($_SERVER['QUERY_STRING'])) && ($_SERVER['QUERY_STRING'] != "")){
  $logoutAction .="&". htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_GET['doLogout'])) &&($_GET['doLogout']=="true")){
  //to fully log out a visitor we need to clear the session varialbles
  session_unregister('MM_Username');
  session_unregister('MM_UserGroup');
	
  $logoutGoTo = "login.php";
  if ($logoutGoTo) {
    header("Location: $logoutGoTo");
    exit;
  }
}
?>
<?php include('restrict.php'); ?>
<?php require_once('Conn.php'); ?>
<?php

$colname_Recordset1 = "-1";
if (isset($_SESSION['MM_Username'])) {
  $colname_Recordset1 = $_SESSION['MM_Username'];
}
mssql_select_db($database_Conn, $Conn);

$query_Recordset1 = sprintf("SELECT * FROM usuarios WHERE usuario = '%s'", $colname_Recordset1);
$Recordset1 = mssql_query($query_Recordset1, $Conn) or die(mssql_error());
$row_Recordset1 = mssql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mssql_num_rows($Recordset1);
//End NeXTenesio Special List Recordset
?>
<?php
mssql_free_result($Recordset1);
?>







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
	background-color: #FFFFFF;
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
      <a href="ENTREGA.php?cmd=resetall" class="Estilo4"><img src="imagenes/mineco.gif" width="92" height="83" ></A><br>
    <br>
 <br>
  <br>
    <br>
  

  </div>
  <div class="dhtmlgoodies_panel">
				<div>
					<!-- Start content of pane -->
					<table width="197">			
				  </table>
					<!-- End content -->
				</div>
  </div>
						<div class="dhtmlgoodies_panel">
				<div>
					<!-- Start content of pane -->

<a href="RECEPCIONBUSQUEDA.PHP?cmd=resetall" class="Estilo4 Estilo7"> Recepcion<br>
</A>			
<a href="MENSAJERIABUSQUEDA.PHP?cmd=resetall" class="Estilo4 Estilo7"> Mensajeria<br>
</A>			
<a href="SECRETARIABUSQUEDA.PHP?cmd=resetall" class="Estilo4 Estilo7"> Secretaria<br></A>			
<a href="USUARIOFINALBUSQUEDA.PHP?cmd=resetall" class="Estilo4 Estilo7"> Usuario Final<br></A>			

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

<br>
<br>




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






<!-- TemplateBeginEditable name="doctitle" -->
<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
<!-- TemplateEndEditable --><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.Estilo1 {
	color: #999999;
	font-size: 18px;
}
.Estilo2 {color: #FF0000}
.Estilo5 {color: #999999; font-size: 30px; }
.Estilo6 {
	color: #999999;
	font-size: 24px;
}
.Estilo10 {color: #000000; font-weight: bold; }
.Estilo11 {
	color: #999999;
	font-weight: bold;
	font-size: 10px;
}
-->
</style>
<!-- TemplateBeginEditable name="head" --><!-- TemplateEndEditable -->
</head>



<body link="#0038B5" vlink="#0038B5" alink="#0038B5" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="MM_preloadImages('images/nav114081096a.gif','images/nav114081090a.gif','images/nav114081091a.gif','images/nav114081093a.gif','images/nav114081094a.gif','images/nav114081095a.gif')">

<table width="600" border="0" cellspacing="2" cellpadding="3">
  <tr>
  
    <td><table width="10" height="161" border="8" cellpadding="1" cellspacing="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table></td>
    <td><table width="304" border="0" align="left" cellpadding="8" cellspacing="3">
      <tr>
        <td width="315"><span class="Estilo1">Ministerio de Economia de Guatemala </span></td>
      </tr>
      <tr>
        <td><span class="Estilo1">Manejo de Correspondencia </span></td>
      </tr>
      <tr>
        <td height="37"><span class="Estilo1">2007</span></td>
      </tr>
    </table>      <p class="Estilo5">&nbsp;</p>    </td>
    <td>&nbsp;</td>
    <td><table width="256" border="0" align="left" cellpadding="6" cellspacing="3">
      <tr>
        <td width="90"> <a href="menu.php?cmd=resetall" span class="Estilo2"> Cerrar Sesión</span></td>
        <td width="138"><?echo $REMOTE_ADDR?></td>
      </tr>
      <tr>
        <td><a href="INGRESOPAQUETE.PHP?cmd=resetall" span class="Estilo4">
          <div align="left"> {Recepcion}</div>          </span></td>

        <td><a href="MENSAJERIACONSULTA.PHP?cmd=resetall" span class="Estilo4">
          <div align="left">{Mensajeria}</div>          </span></td>
      </tr>
      <tr>

        <td><a href="SECRETARIACONSULTA.PHP?cmd=resetall" span class="Estilo4">
          <div align="left">{Secretaria}</div>          </span></td>


        <td><a href="USUARIOFINALCONSULTA.PHP?cmd=resetall" span class="Estilo4">
          <div align="left">{Usuario Final}</div>          </span></td>
      </tr>


      <tr>
        <td><a href="menus.php?cmd=resetall" span class="Estilo4">
          <div align="left">{Admin}</span></div></td>

        <td><a href="pruebacon.php?cmd=resetall" span class="Estilo4">
          <div align="left">{Cambio de Contrase�a}</span></div></td>


      </tr>


    </table></td>
  </tr>
  <tr>
    <td width="159"> <div align="left"><span class="Estilo10">Usuario    <?php echo $row_Recordset1['nombre']; ?>!
      </span>
      <link href="../CORRESPONDENCIA/www.fcbarcelona.com"></div></td>
    <td width="26">&nbsp;</td>
    <td width="425"><p class="Estilo1 Estilo10">fecha:  <?php echo (date("d")."/".date("m")."/".date("Y"));?> </p>
    </td>
    <td width="73">&nbsp;</td>
    <td width="296"><p class="Estilo1">
   </td>
  </tr>
</table>
<table width="1050" height="36" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td> <p class="Estilo11">SISTEMA DE CONTROL DE CORRESPONDENCIA </p>    </td>
  </tr>
</table>

</body>

</html>

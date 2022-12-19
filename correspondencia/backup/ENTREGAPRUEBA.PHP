<?php
//initialize the session
session_start();

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
<!--
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

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>



<?php
//include ("includes/javascript.php");
include ("temas/xp/tema.php");
include ("ajax/ajax_menu.js");
?>
<html>
<style type="text/css">
<!--
body,td,th {
	font-size: 12px;
}
-->
</style><head>

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
				img.src = '/images/menu_principal/arrow_up.gif';
				topBar.appendChild(img);

				if(cookieArray[dhtmlgoodies_paneIndex]){
					cookieValue = Get_Cookie(cookieArray[dhtmlgoodies_paneIndex]);
					if(cookieValue)panelDisplayed[dhtmlgoodies_paneIndex] = cookieValue==1?true:false;

				}

				if(!panelDisplayed[dhtmlgoodies_paneIndex]){
					outerContentDiv.style.height = '0px';
					contentDiv.style.top = 0 - contentDiv.offsetHeight + 'px';
					if(document.all)outerContentDiv.style.display='none';
					img.src = '/images/menu_principal/arrow_down.gif';
				}

				topBar.className='topBar';
				divs[no].appendChild(topBar);
				divs[no].appendChild(outerContentDiv);
				dhtmlgoodies_paneIndex++;
			}
		}
	}
function carga(x){

 var capaContenedora = document.getElementById('d');
 	capaContenedora.innerHTML=x;
 	return;
}
	</script>


</head>
<body onLoad="MM_preloadImages('IMAGENES/NUEVO.GIF')">

<div id="dhtmlgoodies_xpPane">
  <div align="center"><br>
      <a href="ENTREGA.php?cmd=resetall" class="Estilo4"><img src="imagenes/mineco.GIF" width="92" height="83" ></A><br>
    <br>
 <br>
  <br>
    <a href="USUARIOFINALBUSQUEDA.PHP?cmd=resetall" class="Estilo4 Estilo7"><br>
    </A>			

  
  </div>
  <div class="dhtmlgoodies_panel"></div>

<br>
<br>
<br>

<div align="center" >
 <p align="center"><span class="Estilo2">CORRESPONDENCIA</span></p>

 <a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav51','','IMAGENES/NUEVO.GIF',1)" href="ENTREGAPRUEBA.PHP"><img src="IMAGENES/NUEVO.GIF" alt="" name="nav51" border=0 id="nav51" onload="MM_preloadImages('IMAGES/NUEVO1.GIF')"></a><br>
<br>
<a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav50','','IMAGENES/MOVIMIENTO.GIF',1)" href="RECEPCIONCONSULTA.PHP"><img src="IMAGENES/MOVIMIENTO.GIF" alt="" name="nav50" border=0 id="nav50" onLoad="MM_preloadImages('IMAGES/NUEVO1.GIF')"></a>   

<br>
<br>
<br>
<br>
<a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav52','','IMAGENES/MENUPRINCIPAL.GIF',1)" href="encabezado1.php"><img src="IMAGENES/MENUPRINCIPAL.GIF" alt="" name="nav52" border=0 id="nav52" onLoad="MM_preloadImages('IMAGES/NUEVO1.GIF')"></a>   



  <p>&nbsp;</p>
  <p>&nbsp;</p>
  <p>&nbsp;  </p>
</div>
</div>
	
	<script type="text/javascript">

</script>



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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">

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



<script LANGUAGE="JavaScript">
function Validar(form)
{
  if (form.RECIBIO.value == "")
  { alert("Por favor ingrese un NOMBRE"); form.RECIBIO.focus(); return; }
  if (form.FECHA.value == "")
  { alert("Por favor ingrese una FECHA"); form.FECHA.focus(); return; }
  if (form.HORA.value == "")
  { alert("Por favor ingrese una HORA"); form.HORA.focus(); return; }
  if (form.CODIGO_REMITENTE.value == "")
  { alert("Por favor ingrese un REMITENTE"); form.CODIGO_REMITENTE.focus(); return; }
  if (form.NOMBRE_MENSAJERO.value == "")
  { alert("Por favor ingrese un MENSAJERO"); form.NOMBRE_MENSAJERO.focus(); return; }


	if (confirm('�Estas seguro de guardar estos datos?')){ 
    //  document.form.submit() 
		form.submit();
   		} 

}
</script>



<script LANGUAGE="JavaScript">
function Back(form,opc)
{
	if (opc=='0') {
   			form.action = "ENTREGAPRUEBA.PHP?regreso=1";	} 
}
</script>


</head>



<body>


<p><marquee>
		<p>Bienvenido <?php echo $row_Recordset1['nombre']; ?>!</p>


</marquee>
<form name="form1" method="post" action="conexionentrega.php">
<table width="759" border="0" align="center">
  <tr>
    <th width="106" scope="col"><div align="left">CODIGO INGRESO :</div></th>
    <th width="57" scope="col">
      <div align="left"><span class="Estilo9"><strong> <strong>
        <?
$conection = mssql_connect("server_appl","msjharry","lisa1607") or die("no se puede conectar a SQL Server");

 mssql_select_db("MENSAJERIA",$conection);


				  $q= "(SELECT MAX (CODIGO_INGRESO)+1 FROM INGRESO_MENSAJERIA)";
	$res=mssql_query($q);
	
	while ($row = mssql_fetch_row($res))
	{
		print "<option value=$row[0]>  $row[0] </row>"; 

}




?>
    </strong> </strong></span> </div></th>
    <th width="45" scope="col">&nbsp;</th>
    <th width="8" scope="col">&nbsp;</th>
    <th width="100" scope="col">USUARIO </th>
    <th width="182" scope="col" class="Estilo10"><div align="left"><?php echo $row_Recordset1['nombre']; ?>  <?php echo $row_Recordset1['apellido']; ?>
		<input name="RECIBIO" type="hidden" id="RECIBIO" value="<?php echo $row_Recordset1['nombre']; ?>  <?php echo $row_Recordset1['apellido']; ?>" >

    </div></th>
    <th width="10" scope="col">&nbsp;</th>
    <th width="217" scope="col"><table width="167" border="0" align="left" cellpadding="6" cellspacing="0">
        <tr class="Estilo10">
          <td width="53">FECHA</td>
          <td width="90"><?php echo (date("d")."/".date("m")."/".date("Y"));?>
			<input name="FECHA"  type="hidden" id="FECHA" value="<?php echo (date("d")."/".date("m")."/".date("Y"));?>" size="25"></td>
        </tr>
        <tr class="Estilo10">
          <td height="34">HORA</td>
          <td><?php echo  (date("H:i:s:A"));?>       
		  <input name="HORA" type="hidden" id="HORA" value="<?php echo  (date("H:i:s:A"));?>" size="15">

</td>
        </tr>
    </table></th>
  </tr>
  <tr>
    <td height="26"><div align="left"><strong>REMITENTE</strong></div></td>
    <td>
      <div align="left">
        <p>
          <select name="CODIGO_REMITENTE" id="select">
            <?
$conection = mssql_connect("server_appl","msjharry","lisa1607") or die("no se puede conectar a SQL Server");

 mssql_select_db("MENSAJERIA",$conection);


				  $q= "select CODIGO_REMITENTE, NOMBRE_REMITENTE+' '+APELLIDO_REMITENTE from REMITENTE";
	$res=mssql_query($q);
	
	while ($row = mssql_fetch_row($res))
	{
		print "<option value=$row[0]>  $row[1] </row>"; 

}




?>
          </select>
        </p>
    </div></td>
    <td>
      <p> <a href="REMITENTE1.PHP?cmd=resetall" class="Estilo4">Nuevo</a> </p></td>
    <td>&nbsp;</td>
    <td><strong>MENSAJERO</strong></td>
    <td><input name="NOMBRE_MENSAJERO" type="text" id="NOMBRE_MENSAJERO" size="30"   ></td>
    <td>&nbsp;</td>
  </tr>
</table>

<p align="center">&nbsp;</p>
<p align="center">
   



    <input name="cmd_guardar" type="button"onClick="Validar(this.form)" id="cmd_guardar" value="Guardar" >

                  
</p>
<p align="center">&nbsp;  </p>
<p>&nbsp;          </p>
</form>






<form name="form2" method="post" action="conexionentregadetalleoriginal.php">
  <p align="center" class="Estilo6">DETALLE</p>
  <div align="left"></div>
  <table width="840" border="1" align="center" cellpadding="2" cellspacing="0">
    <tr>
      <td width="53" height="26"><div align="center" class="Estilo9"><strong> DETALLE </strong></div></td>
      <td width="63"><div align="center"><span class="Estilo9"><strong> INGRESO </strong></span></div></td>
      <td width="179"><div align="center" class="Estilo9"><strong>DESTINATARIO</strong></div></td>
      <td width="185"><div align="center"><span class="Estilo9"><strong>TIPO</strong></span></div></td>
      <td width="322"><div align="center"><span class="Estilo9"><strong>DESCRIPCION</strong></span></div></td>
      <td width="17"></td>
    </tr>
    <tr>
      <td><span class="Estilo9"><strong>

<select name="CODIGO_DETALLE" type="hidden"    class="Estilo7"  id="select3">
        <?
$conection = mssql_connect("server_appl","msjharry","lisa1607") or die("no se puede conectar a SQL Server");

 mssql_select_db("MENSAJERIA",$conection);


				  $q= "(SELECT MAX (CODIGO_DETALLE)+1 FROM DETALLE_INGRESO)";
	$res=mssql_query($q);
	
	while ($row = mssql_fetch_row($res))
	{
		print  "<option value=$row[0]>  $row[0] </row>"; 

}




?>
</select>

       

      </strong></span></td>
      <td><div align="center"><span class="Estilo9"><strong>        <strong>
          <select name="CODIGO_INGRESO" type= "hidden"  class="Estilo7" id="select2">
            <?
$conection = mssql_connect("server_appl","msjharry","lisa1607") or die("no se puede conectar a SQL Server");

 mssql_select_db("MENSAJERIA",$conection);


				  $q= "select MAX(CODIGO_INGRESO) FROM INGRESO_MENSAJERIA  ";
	$res=mssql_query($q);
	
	while ($row = mssql_fetch_row($res))
	{



		print "<option value=$row[0]>  $row[0] </row>"; 

}




?>
          </select>







      </strong> </strong></span></div></td>
      <td><div align="center">
        <select name="CODIGO_EMPLEADO" id="select">
          <?
$conection = mssql_connect("server_appl","msjharry","lisa1607") or die("no se puede conectar a SQL Server");

 mssql_select_db("MENSAJERIA",$conection);


				  $q= "select CODIGO_EMPLEADO, NOMBRE_EMPLEADO, APELLIDO_EMPLEADO, NOMBRE_EMPLEADO+ ' ' +APELLIDO_EMPLEADO, EMAIL FROM EMPLEADO";
	$res=mssql_query($q);
	
	while ($row = mssql_fetch_row($res))
	{
		print "<option value=$row[0]>  $row[3] </row>"; 

}


?>
        </select>











</div></td>
      <td><div align="center">
        <select name="TIPO_DOCUMENTO" id="select"  class=".Estilo11{color: #000000; font-size:6px;}">
            <option value=""> </option>
            <option value="EXPEDIENTE PARA TRAMITE ADMINISTRATIVO">EXPEDIENTE PARA TRAMITE ADMINISTRATIVO </option>
            <option value="CORRESPONDENCIA INSTITUCIONAL NACIONAL">CORRESPONDENCIA INSTITUCIONAL NACIONAL</option>
            <option value="CORRESPONDENCIA INTERNACIONAL">CORRESPONDENCIA INTERNACIONAL</option>
            <option value="CORRESPONDENCIA PERSONAL">CORRESPONDENCIA PERSONAL </option>
        </select>
      </div></td>
      <td><div align="center">
        <select name="CODIGO_DESCRIPCION" id="select">
            <?
$conection = mssql_connect("server_appl","msjharry","lisa1607") or die("no se puede conectar a SQL Server");

 mssql_select_db("MENSAJERIA",$conection);


				  $q= "select * from DESCRIPCION";
	$res=mssql_query($q);
	
	while ($row = mssql_fetch_row($res))
	{
		print "<option value=$row[0]>  $row[1] </row>"; 

}




?>
        </select>
      
        <a href="DESCRIPCION1.php?cmd=resetall" class="Estilo4">Nuevo</a></td>
      <td width="17" ><input  name="STATUS" type="hidden" id="STATUS"  value= "RECEPCION"></td>
    </tr>
  </table>

  <p align="center">&nbsp;</p>
  <p align="center">



<?

//esta parte realiza la conexión al servidor, yo tengo configurado autentificación de Windows, por eso no pongo ni user ni password.       

$conection = mssql_connect("server_appl","msjharry","lisa1607") or die("no se puede conectar a SQL Server");



 mssql_select_db("MENSAJERIA",$conection);




//$SQL = "SELECT  CODIGO_DETALLE, CODIGO_INGRESO, CODIGO_EMPLEADO, STATUS, TIPO_DOCUMENTO, CODIGO_DESCRIPCION FROM VISTA2 WHERE  CODIGO_INGRESO LIKE '%$CODIGO_INGRESO%'";

$SQL= "SELECT * FROM VISTA1 WHERE INGRESO = (SELECT MAX(INGRESO) FROM VISTA1)";
//$SQL = "SELECT MAX(CODIGO_INGRESO) FROM VISTA2";   



?>

 
   <input type="submit" name="Submit" value="Enviar">    

 </p>

  
</form>		

		
<p>&nbsp;          </p>
<p>&nbsp;          </p>




 <html>

<head>

<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>

</head>

<body>

            <table width="840" border="1" cellspacing="3" cellpading="20" align="center">

                        <tr align="center" class="Estilo10">

                                   <td>DETALLE</td>

                                   <td>INGRESO</td>

                                   <td>DESTINATARIO</td>

                                   <td>TIPO</td>

                                   <td>DESCRIPCION</td>

                                   <td>STATUS</td>

                        </tr>

                        <?

                                    

                                   $result = mssql_query( $SQL );

                                   while( $row = mssql_fetch_array( $result ) ){

                                   

                        ?>

                        <tr align="center">

                                   <td > <? echo $row['DETALLE'] ?> </td>

                                   <td> <? echo $row['INGRESO'] ?> </td>

                                   <td> <? echo $row['EMPLEADO'] ?> </td>

                                   <td> <? echo $row['TIPO_DOCUMENTO'] ?> </td>

                                   <td> <? echo $row['DESCRIPCION'] ?></td>

                                   <td> <? echo $row['STATUS'] ?></td>

                        </tr>

                        <?

                                   }

                        ?>                    

            </table>

            <? 

                        mssql_close( $conection );

            ?>

</body>

</html>


<p>&nbsp;          </p>

<div align="center">   <a href="encabezado1.php?cmd=resetall" class="Estilo4"> <img src="imagenes/VOLVER.GIF" width="50" height="31" >
MENU  </a>   </div>


</body>

</html>
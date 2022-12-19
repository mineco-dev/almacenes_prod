<html>
<head>
	<title>ASEGGYS 2.0 - SISTEMA ALMACEN MINECO</title>
	<style type="text/css">
	<!--
 	INPUT, TEXTAREA, SELECT {font-size: xx-small;}
	.phpmaker {font-size: xx-small;}
.Estilo4 {
	font-size: 14px;
	color: #C2DCDC;
	font-weight: bold;
}
body {
	background-color: #FFFFFF;
}
.Estilo5 {color: #C2DCDC}
.Estilo7 {color: #FF0000; font-size: 24px; }
	-->
	</style>
<meta name="generator" content="PHPMaker v3.0.0.2" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script language="JavaScript" type="text/JavaScript">
<!--
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
</head>





<?php if (@$sExport == "") { ?>
	
<table width="100%" height="65%" border="1" cellspacing="10" cellpadding="10">

<tr>
	<td><a href="registro.php?cmd=resetall" span class="Estilo7">
          <div align="center">{Crear Usuario}</span></div></td>

	<td><div align="left"><span  class="Estilo7">CONTROL </span></div></td>

</tr>



<p>&nbsp;</p>

<tr>
	<!-- left column -->
	<td width="20%" height="250%" valign="top">
			<table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" bordercolor="#000000" bgcolor="#000000" class="Estilo4">
			<tr>

			  <td><p align="center" class="phpmaker">
<div id="container">
<div id="image1" style="position:absolute; overflow:visible; left:40px; top:150px; width:1102px; height:350px; z-index:0"><img src="images/newspanel.jpg" border=0 width=204 height=357>
  </p>
<div id="nav1" style="position:absolute; left:32px; top:98px; z-index:2"><a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav10','','images/nav114081090a.gif',1)" href="encabezado1.php"><img name="nav10" onLoad="MM_preloadImages('images/nav114081090a.gif')" alt="" border=0 src="images/nav114081090i.gif"></a></div>
<div id="nav1" style="position:absolute; left:31px; top:145px; z-index:2"><a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav11','','imagenes/EMPLEADO1.GIF',1)" href="EMPLEADOS.PHP"><img name="nav11" onLoad="MM_preloadImages('imagenes/EMPLEADO.GIF')" alt="" border=0 src="imagenes/EMPLEADO.GIF"></a></div>


<div id="nav1" style="position:absolute; left:15px; top:183px; z-index:2"><a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav14','','imagenes/DEPARTAMENTO1.GIF',1)" href="DEPARTAMENTO.php"><img name="nav14" onLoad="MM_preloadImages('imagenes/DEPARTAMENTO.GIF')" alt="" border=0 src="imagenes/DEPARTAMENTO.GIF"></a></div>
<div id="nav1" style="position:absolute; left:29px; top:220px; z-index:2"><a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav15','','imagenes/REMITENTE1.GIF',1)" href="REMITENTE.php"><img src="imagenes/REMITENTE.GIF" alt="" name="nav15" border=0 id="nav15" onload="MM_preloadImages('imagenes/REMITENTE.GIF')"></a></div>
<div id="nav1" style="position:absolute; left:23px; top:257px; z-index:2"><a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav16','','imagenes/DESCRIPCION1.GIF',1)" href="DESCRIPCION.php"><img src="imagenes/DESCRIPCION.GIF" alt="" name="nav16" border=0 id="nav16" onload="MM_preloadImages('imagenes/DESCRIPCION.GIF')"></a></div>
</div>
</div>
	          </td>

			</tr>
  </table>
	</td>
	<!-- right column -->
	<td width="60%" valign="top">



<? } ?>
<p>
<a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav25','','imagenes/CONSULTA1.GIF',1)" href="EMPLEADOS.PHP"><img src="imagenes/CONSULTA.GIF" alt="" name="nav25" border=0 id="nav25" onLoad="MM_preloadImages('imagenes/CONSULTA1.GIF')"></a>   
<a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav26','','imagenes/MODIFICACION1.GIF',1)" href="DEPARTAMENTO.php"><img src="imagenes/MODIFICACION.GIF" alt="" name="nav26" border=0 id="nav26" onLoad="MM_preloadImages('imagenes/MODIFICACION1.GIF')"></a>
<a onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('nav27','','imagenes/ELIMINACION1.GIF',1)" href="REMITENTE.php"><img src="imagenes/ELIMINACION.GIF" alt="" name="nav27" border=0 id="nav27" onLoad="MM_preloadImages('imagenes/ELIMINACION1.GIF')"></a>






</p>






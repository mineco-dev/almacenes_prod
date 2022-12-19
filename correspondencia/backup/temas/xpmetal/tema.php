<?php
if ( !defined('sistema_tema') ) {
	define('sistema_tema', 1);
	
$wbfondo='5.jpg'; //imagen de fondo
$wbbarra='barr_xp.gif'; //imagen de la barra
$wbbgcolor1 = "#FFFFFF"; //color fondo del sistema
$wbbgcolor2 = "#83A5F6"; //color barra y menú
$wbbgcolor3 = "#EEEEE6"; //color fondo de la caja madre
$wbbgcolor4 = "#E7E2CD"; //color fondo caja hija
$wbbgcolor5 = "#E6E7E6"; //color formularios
$wbbgcolor6 = "#E6E7E6"; //color entre las tablas
$wbtxcolor1 = "#000000";
$wbtxcolor2 = "#000000";
$wbmenu = 2; //configuracion de posición del menú 1 vertical 2 horizontal
$wbtemamenu = 2;
$wbcolorkursor1="#90C0F0"; //color del kursor por defecto 
$wbtemaiconos="crystal";
function abretabla($titulotabla="",$typ=0) {
global $wbbgcolor1, $wbbgcolor2, $wbbgcolor3, $wbbgcolor4,$wbbgcolor5,$wbbarra,$wbtema, $printer, $wbfontsize,$op,$descripcion_modulo,$ayuda_modulo,$wbdescripcion;

global $hiddenblocks;
//echo("<h1> --> $hiddenblocks</h1>");
	if ($op<11) {
		if ($op==10) {$typ=0;}
		if ($printer<>true) {
			if ($typ==0) { 
				echo("<div align=lef>$titulotabla</div>");
				//<img id='pic8' src='temas/$wbtema/images/restaurar.gif' onclick='blockswitch(8);' style='cursor: pointer;' align='right'> 
			?>
<table WIDTH=100% border=0 VALIGN=TOP cellpadding=1 cellspacing=0>
	<tr>
	<td width="100%" bgcolor="#D8D2BD" align="center">
	<table width="100%" height="100%" border="0" align="center" cellpadding="5" cellspacing="0" summary="" bgcolor="#F0EFE4">
		<tr>
		<td bgcolor="#F0EFE4" valign="top" width="100%" CLASS="content">
		<?php } elseif ($typ==1) { ?>
		<br><br><br>
		<table width="99%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>
			<td width="1" height="1"><img src="<?php echo("temas/$wbtema/");?>images/frame_corner1.gif" border="0"></td>
			<td height="1" nowrap background="<?php echo("temas/$wbtema/");?>images/frame_top.gif" class="frametitle" align="right"><?php 	echo("<img src='temas/$wbtema/images/frame_grip.gif' border=0><font color='#000000'><b>&nbsp;$titulotabla&nbsp;</b></font>"); $height=10+$wbfontsize;
			$width=10+$wbfontsize;echo("<img src='temas/$wbtema/images/restaurar.gif' id='pic8' onclick='blockswitch(8);' height=$height width=$width border='0'><a href='index.php' title='Cerrar' ><img src='temas/$wbtema/images/cerrar.gif' height=$height width=$width onmouseOver=cambiar_imagen(this,'temas/$wbtema/images/cerrar2.gif') onmouseOut=cambiar_imagen(this,'temas/$wbtema/images/cerrar.gif') border='0'></a>"); ?></td>
			<td width="1" height="1"><img src="<?php echo("temas/$wbtema/");?>images/frame_corner2.gif" border="0"></td>
			</tr>
			<tr>
			<td width="1" background="<?php echo("temas/$wbtema/");?>images/frame_right.gif"><img src="<?php echo("temas/$wbtema/");?>images/frame_right.gif" border="0"></td>
			<td bgcolor="#FFFFFF" align="center" height="100%">
			<?php if (trozo($hiddenblocks,-1,"8")==0) { ?>
				<div id="pe8" style="">
			<?php } else { ?>
				<div id="pe8" style="display: none;">
			<?php } ?>
			<table width="100%" height="100%" border="0" align="center" cellpadding="10" cellspacing="0" summary="" bgcolor="#FFFFFF">
				<tr>
				<td bgcolor="<?php echo("$wbbgcolor5");?>" valign="top" >
				
				
				<?php if (trozo($hiddenblocks,-1,"9")==0) {?>
					<img alt="[x]" title="Mostrar/Esconder contenido" id="pic9" src="images/minus.gif" onclick="blockswitch('9');" style="cursor: pointer;" align="right"><br>
					<div id="pe9" style="">
				<?php } else { ?>
					<img alt="[x]" title="Mostrar/Esconder contenido" id="pic9" src="images/plus.gif" onclick="blockswitch('9');" style="cursor: pointer;" align="right"><br>
					<div id="pe9" style="display: none;">
				<?php } ?>
				<table><tr><td>
				<table width="168" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					<td height="25" height="1" align="left" valign="middle" background="<?php echo("temas/$wbtema/");?>images/frameb_top.gif" id="pic7" onclick="blockswitch('7');" class="sidetitle">&nbsp;&nbsp;Descripción</td>
					</tr>
					<tr>
					<td bgcolor="#FFFFFF" align="center" height="100%" colspan="3">
					<?php if (trozo($hiddenblocks,-1,"7")==0) { ?>
						<div id="pe7" style="">
					<?php } else { ?>
						<div id="pe7" style="display: none;">
					<?php } ?>
					<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" summary="" bgcolor="#FFFFFF">
						<tr>
						<td bgcolor="<?php echo("$wbbgcolor4");?>" valign="top" width="100%" CLASS="sidecontent">
						<?php echo("$descripcion_modulo"); ?>
						</td>
						</tr>
					</table>
					</div>
					</td>
					</tr>	
				</table>
				<font size=1><br></font>
				<table width="168" border="0" align="center" cellpadding="0" cellspacing="0">
					<tr>
					<td height="25" height="1" align="left" valign="middle" background="<?php echo("temas/$wbtema/");?>images/frameb_top.gif" id="pic6" onclick="blockswitch('6');" class="sidetitle">&nbsp;&nbsp;Ayuda</td>
					</tr>
					<tr>
					<td bgcolor="#FFFFFF" align="center" height="100%" colspan="3">
					<?php if (trozo($hiddenblocks,-1,"6")==0) { ?>
						<div id="pe6" style="">
					<?php } else { ?>
						<div id="pe6" style="display: none;">
					<?php } ?>
					<table width="100%" border="0" align="center" cellpadding="5" cellspacing="1" summary="" bgcolor="#FFFFFF">
						<tr>
						<td bgcolor="<?php echo("$wbbgcolor4");?>" valign="top" width="100%" CLASS="sidecontent">
						<?php echo("$ayuda_modulo"); ?>
						</td>
						</tr>
					</table>
					</div>
					</td>
					</tr>
				</table>
				</table></div>
				</td>
				<td bgcolor="#FFFFFF" valign="top" width="100%" CLASS="content">
				<?php }
				} else {
				echo("<b><center>".trozo("$titulotabla",1,"<titulo>","</titulo>")."</center></b>");
				}
				}
}



function cierratabla($typ=0) {
global $printer,$op, $comentario_modulo,$wbtema,$wbdescripcion;
global $hiddenblocks;
if ($op==10) {$typ=0;}
	if ($printer<>true) {
		if ($typ==0) { ?>
				</td>
				</tr>
				<tr>
				<td bgcolor="#F0EFE4" valign="top" width="100%">
				</td>
				</tr>
			</table>
			</div>
			</td>
			</tr>
		</table>
		<?php } elseif ($typ==1) { ?>
		<font size=1><br></font>
		</td>
		</tr>
	</table>
	</td>
	<td width="1" background="<?php echo("temas/$wbtema/");?>images/frame_right.gif"><img src="<?php echo("temas/$wbtema/");?>images/frame_right.gif" border="0"></td>
	</tr>
	<tr>
	<td width="1" background="<?php echo("temas/$wbtema/");?>images/frame_right.gif"><img src="<?php echo("temas/$wbtema/");?>images/frame_right.gif" border="0"></td>
	<td height="25" background="<?php echo("temas/$wbtema/");?>images/frame_status.gif">&nbsp;&nbsp;<?php echo("$comentario_modulo"); echo("&nbsp;<img src=temas/$wbtema/images/ora2.gif border=0>"); ?></td>
	<td width="1" background="<?php echo("temas/$wbtema/");?>images/frame_right.gif"><img src="<?php echo("temas/$wbtema/");?>images/frame_right.gif" border="0"></td>
	</tr>

	<tr>
	<td width="1" height="1"><img src="<?php echo("temas/$wbtema/");?>images/frame_corner3.gif" border="0"></td>
	<td height="1" background="<?php echo("temas/$wbtema/");?>images/frame_bottom.gif"><img src="<?php echo("temas/$wbtema/");?>images/frame_bottom.gif" border="0"></td>
	<td width="1" height="1"><img src="<?php echo("temas/$wbtema/");?>images/frame_corner4.gif" border="0"></td>
	</tr>
</table>
<br>		


		<?php if (trozo($hiddenblocks,-1,"6")==0) { ?>
			<div id="ph6" style="display: none;">
			</div>
		<?php } else { ?>
			<div id="ph6" style="">
			</div>
		<?php } ?>
		
		
		<?php if (trozo($hiddenblocks,-1,"7")==0) { ?>
			<div id="ph7" style="display: none;">
			</div>
		<?php } else { ?>
			<div id="ph7" style="">
			</div>
		<?php } ?>
		
		
		<?php if (trozo($hiddenblocks,-1,"8")==0) { ?>
			<div id="ph8" style="display: none;">
			</div>
		<?php } else { ?>
			<div id="ph8" style="">
			</div>
		<?php } ?>
		
		
		<?php if (trozo($hiddenblocks,-1,"9")==0) { ?>
			<div id="ph9" style="display: none;">
			</div>
		<?php } else { ?>
			<div id="ph9" style="">
			</div>
		<?php } ?>
		
		
		
		
		<?php }
	}
}






function abrecuadro($tipo=1) {
global $wbtema;
if ($tipo==1) {
	echo("
	<table border='0' cellspacing='0' cellpadding='0' cols='3' align='center' > 
	<tr> 
	<td background='temas/$wbtema/images/1.gif' width='18' height='18'> </td> 
	<td background='temas/$wbtema/images/2.gif' height='18'> </td> 
	<td background='temas/$wbtema/images/3.gif' width='18' height='18'> </td> 
	</tr> 
	<tr> 
	<td background='temas/$wbtema/images/8.gif' width='18'> </td> 
	<td align='center' valign='middle'>
	");
} elseif ($tipo==2) {
	echo("
	<table border='0' cellspacing='0' cellpadding='0' align='center' >
	<tr> 
	<td rowspan='2' align='center' colspan='2' width='8' height='3'>
	");
}
} 

function cierracuadro($tipo=1) {
global $wbtema;
if ($tipo==1) {
	echo("
	</td> 
	<td background='temas/$wbtema/images/4.gif' width='30'> </td> 
	</tr> 
	<tr> 
	<td background='temas/$wbtema/images/7.gif' width='18' height='30'> </td>
	<td background='temas/$wbtema/images/6.gif' height='30'> </td> 
	<td background='temas/$wbtema/images/5.gif' width='30' height='30'> </td> 
	</tr> 
	</table>
	");
} elseif ($tipo==2) {
	echo("
	</td>
	<td background='temas/$wbtema/images/e3.gif' width='8' height='3'> </td>
	</tr>
	<tr>
	<td background='temas/$wbtema/images/e4.gif' width='8' height='82'> </td>
	</tr>
 	<tr>
	<td background='temas/$wbtema/images/e7.gif' width='3' height='8'> </td>
	<td background='temas/$wbtema/images/e6.gif' width='152' height='8'> </td>
	<td background='temas/$wbtema/images/e5.gif' width='3' height='3'> </td>
	</tr>
	</table>
	");
}
}

}
?>

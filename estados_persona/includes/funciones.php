<?PHP
function getTabla($strquery,$ccol,$ncol,$campos,$tamano,$dbms,$width,$mod,$eli,$ver)
{
	$col1 = "#EEEBE6";
	$col2 = "#FFFFFF";
	$impresion = 
	"<table width=\"$width%\" border=\"0\" align=\"center\">
	  <tr bgcolor=\"#FFFFFC\" class=\"blue\">";
	$cnt = 0;
	while ($cnt < $ccol)
	{
	$impresion = $impresion . "<td $tamano[$cnt] class=\"white\">$ncol[$cnt]</td>";
		$cnt ++;
	}
	if (strlen(trim($mod)) > 0)	$impresion = $impresion . "<td width=\"10%\" class=\"white\">Modificar</td>";
	if (strlen(trim($eli)) > 0)	$impresion = $impresion . "<td width=\"10%\" class=\"white\">Borrar</td>";
	if (strlen(trim($ver)) > 0)	$impresion = $impresion . "<td width=\"10%\" class=\"white\">Ver</td>";
	$impresion = $impresion . "</tr>";
	$dbms->sql=$strquery;
	$dbms->Query();
	$ban = 0;
	$cantidad = 1;
	while($Fields=$dbms->MoveNext())
	{
		if (($ban - intval($ban/2)*2) != 0)
			$col= $col1;
		else
			$col= $col2;
		$impresion = $impresion . "<tr bgcolor= \"$col\">";
		$cnt = 0;
		while ($cnt < $ccol)
		{
			$impresion = $impresion . "<td><span class=\"Estilo1\">".$Fields[$campos[$cnt]]."</span></td>";
			$cnt ++;
		}
		if (strlen(trim($mod)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$mod".$Fields[$campos[$cnt]]."\"><img src=\"../../imagenes/modificar.png\" border=\"0\"/>Modificar</span></td>";
		if (strlen(trim($eli)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$eli".$Fields[$campos[$cnt]]."\"><img src=\"../../imagenes/borrar.png\" border=\"0\"/>Borrar</span></td>";
		if (strlen(trim($ver)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$ver".$Fields[$campos[$cnt]]."\" title=\"ver\"><img src=\"../../imagenes/ver.png\" border=\"0\"/></span></td>";

		$impresion = $impresion . "</tr>";
		$cantidad++;
		$ban = $ban + 1;
	}
	$impresion = $impresion . "</table>";
	if ($cantidad > 1) 
		print $impresion;
	else
		print "<img src=\"../../imagenes/atencion.png\" border=\"0\"/> no hay datos ingresados...<br>";
}

function getTabla_valida($strquery,$ccol,$ncol,$campos,$tamano,$dbms,$width,$mod,$eli,$ver,$campot,$campov)
{
	$col1 = "#EEEBE6";
	$col2 = "#FFFFFF";
	$impresion =  
	"<table width=\"$width%\" border=\"0\" align=\"center\">
	  <tr bgcolor=\"#FFFFFC\" class=\"blue\">";
	$cnt = 0;
	while ($cnt < $ccol)
	{
		$impresion = $impresion . "<td $tamano[$cnt] class=\"white\">$ncol[$cnt]</td>";
		$cnt ++;
	}
	if (strlen(trim($mod)) > 0)	$impresion = $impresion . "<td width=\"10%\" class=\"white\">Modificar</td>";
	//if (strlen(trim($eli)) > 0)	print "<td width=\"10%\" class=\"white\">Borrar</td>";
	//if (strlen(trim($ver)) > 0)	print "<td width=\"10%\" class=\"white\">Ver</td>";
	$impresion = $impresion . "</tr>";
	$dbms->sql=$strquery;
	$dbms->Query();
	$ban = 0;
	$cantidad = 1;
	while($Fields=$dbms->MoveNext())
	{
		if (($ban - intval($ban/2)*2) != 0)
			$col= $col1;
		else
			$col= $col2;
		$impresion = $impresion . "<tr bgcolor= \"$col\">";
		$cnt = 0;
		while ($cnt < $ccol)
		{
			$impresion = $impresion . "<td><span class=\"Estilo1\">".$Fields[$campos[$cnt]]."</span></td>";
			$cnt ++;
		}
		if (strlen(trim($mod)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$mod".$Fields[$campos[$cnt]]."\"><img src=\"../../imagenes/modificar.png\" border=\"0\"/>Modificar</span></td>";
		
		if (strlen(trim($eli)) > 0)
		{
			if (intval($Fields[$campot]) == intval($campov))
			{
				$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$eli".$Fields[$campos[$cnt]]."\" title=\"Borrar\"><img src=\"../../imagenes/borrar2.png\" border=\"0\"/></span></td>";
			}
		}else
		{
			$impresion = $impresion . "&nbsp;";
		}
		if (strlen(trim($ver)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$ver".$Fields[$campos[$cnt]]."\" title=\"ver\"><img src=\"../../imagenes/ver.png\" border=\"0\"/></span></td>";

		$impresion = $impresion . "</tr>";
		$cantidad++;
		$ban = $ban + 1;
	}
	$impresion = $impresion . "</table>";
	if ($cantidad > 1) 
		print $impresion;
	else
		print "<img src=\"../../imagenes/atencion.png\" border=\"0\"/> no hay datos ingresados...<br>";
}

function getTablaUsuarios($strquery,$ccol,$ncol,$campos,$tamano,$dbms,$width,$mod,$eli,$ver)
{
	$col1 = "#EEEBE6";
	$col2 = "#FFFFFF";
	print
	"<table width=\"$width%\" border=\"0\" align=\"center\">
	  <tr bgcolor=\"#FFFFFC\" class=\"blue\">";
	$cnt = 0;
	while ($cnt < $ccol)
	{
		print "<td $tamano[$cnt] class=\"white\">$ncol[$cnt]</td>";
		$cnt ++;
	}
	if (strlen(trim($mod)) > 0)	print "<td width=\"10%\" class=\"white\">Modificar</td>";
	if (strlen(trim($eli)) > 0)	print "<td width=\"10%\" class=\"white\">Borrar</td>";
	if (strlen(trim($ver)) > 0)	print "<td width=\"10%\" class=\"white\">Ver</td>";
	print "</tr>";
	$dbms->sql=$strquery;
	$dbms->Query();
	$ban = 0;
	$cantidad = 1;
	while($Fields=$dbms->MoveNext())
	{
		if (($ban - intval($ban/2)*2) != 0)
			$col= $col1;
		else
			$col= $col2;
		print "<tr bgcolor= \"$col\">";
		$cnt = 0;
		while ($cnt < $ccol)
		{
			print "<td><span class=\"Estilo1\">".$Fields[$campos[$cnt]]."</span></td>";
			$cnt ++;
		}
		if (strlen(trim($mod)) > 0)
			print "<td><span class=\"Estilo1\"><a href=\"$mod".$Fields[$campos[$cnt]]."\"><img src=\"../../imagenes/modificar.png\" border=\"0\"/>Modificar</span></td>";
		if (strlen(trim($eli)) > 0)
			print "<td><span class=\"Estilo1\"><a href=\"$eli".$Fields[$campos[$cnt]]."\"><img src=\"../../imagenes/borrar.png\" border=\"0\"/>Borrar</span></td>";
		if (strlen(trim($ver)) > 0)
			print "<td><span class=\"Estilo1\"><a href=\"$ver".$Fields[$campos[$cnt]]."\"><img src=\"../../imagenes/ver.png\" border=\"0\"/>Ver</span></td>";

		print "</tr>";
		$cantidad++;
		$ban = $ban + 1;
	}
	print "</table>";
}

function getTablaArchivo($strquery,$ccol,$ncol,$campos,$tamano,$dbms,$width,$mod,$eli,$ver)
{
	$col1 = "#EEEBE6";
	$col2 = "#FFFFFF";
	$impresion = 
	"<table width=\"$width%\" border=\"0\" align=\"center\">
	  <tr bgcolor=\"#FFFFFC\" class=\"blue\">";
	$cnt = 0;
	while ($cnt < $ccol)
	{
		$impresion = $impresion . "<td $tamano[$cnt] class=\"white\">$ncol[$cnt]</td>";
		$cnt ++;
	}
	if (strlen(trim($mod)) > 0)	$impresion = $impresion . "<td width=\"10%\" class=\"white\">Modificar</td>";
	if (strlen(trim($eli)) > 0)	$impresion = $impresion . "<td width=\"10%\" class=\"white\">Borrar</td>";
	if (strlen(trim($ver)) > 0)	$impresion = $impresion . "<td width=\"10%\" class=\"white\">Ver</td>";
	$impresion = $impresion . "</tr>";
	$dbms->sql=$strquery;
	$dbms->Query();
	$ban = 0;
	$cantidad = 1;
	while($Fields=$dbms->MoveNext())
	{
		if (($ban - intval($ban/2)*2) != 0)
			$col= $col1;
		else
			$col= $col2;
		$impresion = $impresion . "<tr bgcolor= \"$col\">";
		$cnt = 0;
		while ($cnt < $ccol)
		{
			$impresion = $impresion . "<td><span class=\"Estilo1\">".$Fields[$campos[$cnt]]."</span></td>";
			$cnt ++;
		}
		if (strlen(trim($mod)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$mod".$Fields[$campos[$cnt]]."\"><img src=\"../../imagenes/modificar.png\" border=\"0\"/>Modificar</span></td>";
		if (strlen(trim($eli)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$eli".$Fields[$campos[$cnt]]."\"><img src=\"../../imagenes/borrar.png\" border=\"0\"/>Borrar</span></td>";
		if (strlen(trim($ver)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"".$Fields[$campos[$cnt]]."\" target=\"_blank\"><img src=\"../../imagenes/ver.png\" border=\"0\"/>Ver</span></td>";

		$impresion = $impresion . "</tr>";
		$cantidad++;
		$ban = $ban + 1;
	}
	$impresion = $impresion . "</table>";
	if ($cantidad > 1) 
		print $impresion;
	else
		print "<img src=\"../../imagenes/atencion.png\" border=\"0\"/> no hay datos ingresados...<br>";
}

function getTablaArchivo_valida($strquery,$ccol,$ncol,$campos,$tamano,$dbms,$width,$mod,$eli,$ver,$campot,$campov)
{
	$col1 = "#EEEBE6";
	$col2 = "#FFFFFF";
	$impresion = 
	"<table width=\"$width%\" border=\"0\" align=\"center\">
	  <tr bgcolor=\"#FFFFFC\" class=\"blue\">";
	$cnt = 0;
	while ($cnt < $ccol)
	{
		$impresion = $impresion . "<td $tamano[$cnt] class=\"white\">$ncol[$cnt]</td>";
		$cnt ++;
	}
	if (strlen(trim($mod)) > 0)	$impresion = $impresion . "<td width=\"10%\" class=\"white\">Modificar</td>";
	//if (strlen(trim($eli)) > 0)	print "<td width=\"10%\" class=\"white\">Borrar</td>";
	//if (strlen(trim($ver)) > 0)	print "<td width=\"10%\" class=\"white\">Ver</td>";
	$impresion = $impresion . "</tr>";
	$dbms->sql=$strquery;
	$dbms->Query();
	$ban = 0;
	$cantidad = 1;
	while($Fields=$dbms->MoveNext())
	{
		if (($ban - intval($ban/2)*2) != 0)
			$col= $col1;
		else
			$col= $col2;
		$impresion = $impresion . "<tr bgcolor= \"$col\">";
		$cnt = 0;
		while ($cnt < $ccol)
		{
			$impresion = $impresion . "<td><span class=\"Estilo1\">".$Fields[$campos[$cnt]]."</span></td>";
			$cnt ++;
		}
		if (strlen(trim($mod)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$mod".$Fields[$campos[$cnt]]."\"><img src=\"../../imagenes/modificar.png\" border=\"0\"/>Modificar</span></td>";
		if (strlen(trim($ver)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"".$Fields[$campos[$cnt]]."\" target=\"_blank\" title=\"ver\"><img src=\"../../imagenes/ver.png\" border=\"0\"/></span></td>";
		if (strlen(trim($eli)) > 0)
		{
			if (intval($Fields[$campot]) == intval($campov))
			{
				$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$eli".$Fields[$campos[$cnt+1]]."\" title=\"Borrar\"><img src=\"../../imagenes/borrar2.png\" border=\"0\"/></span></td>";
			}
		}else
		{
			$impresion = $impresion . "&nbsp;";
		}
		$impresion = $impresion . "</tr>";
		$cantidad++;
		$ban = $ban + 1;
	}
	$impresion = $impresion . "</table>";
	if ($cantidad > 1) 
		print $impresion;
	else
		print "<img src=\"../../imagenes/atencion.png\" border=\"0\"/> no hay datos ingresados...<br>";
}

function getTablaResolucion($strquery,$ccol,$ncol,$campos,$tamano,$dbms,$width,$mod,$eli,$ver)
{
	$col1 = "#EEEBE6";
	$col2 = "#FFFFFF";
	print
	"<table width=\"$width%\" border=\"0\" align=\"center\">
	  <tr bgcolor=\"#FFFFFC\" class=\"blue\">";
	$cnt = 0;
	while ($cnt < $ccol)
	{
		print "<td $tamano[$cnt] class=\"white\">$ncol[$cnt]</td>";
		$cnt ++;
	}
	if (strlen(trim($mod)) > 0)	print "<td width=\"10%\" class=\"white\">Modificar</td>";
	if (strlen(trim($eli)) > 0)	print "<td width=\"10%\" class=\"white\">Borrar</td>";
	if (strlen(trim($ver)) > 0)	print "<td width=\"10%\" class=\"white\">Ver</td>";
	print "</tr>";
	$dbms->sql=$strquery;
	$dbms->Query();
	$ban = 0;
	$cantidad = 1;
	while($Fields=$dbms->MoveNext())
	{
		if (($ban - intval($ban/2)*2) != 0)
			$col= $col1;
		else
			$col= $col2;
		print "<tr bgcolor= \"$col\">";
		$cnt = 0;
		while ($cnt < $ccol)
		{
			print "<td><span class=\"Estilo1\">".$Fields[$campos[$cnt]]."</span></td>";
			$cnt ++;
		}
		if (strlen(trim($mod)) > 0)
			print "<td><span class=\"Estilo1\"><a href=\"$mod".$Fields[$campos[$cnt]]."\"><img src=\"../../imagenes/modificar.png\" border=\"0\"/>Modificar</span></td>";
		if (strlen(trim($eli)) > 0)
			print "<td><span class=\"Estilo1\"><a href=\"$eli".$Fields[$campos[$cnt]]."\"><img src=\"../../imagenes/borrar.png\" border=\"0\"/>Borrar</span></td>";
		if (strlen(trim($ver)) > 0)
			print "<td><span class=\"Estilo1\"><a href=\"resolucionimp.php?imp=1&idrespuesta=".$Fields[$campos[$cnt]]."\" target=\"_blank\" title=\"ver\"><img src=\"../../imagenes/ver.png\" border=\"0\"/></span></td>";

		print "</tr>";
		$cantidad++;
		$ban = $ban + 1;
	}
	print "</table>";
}

function getTablaResolucion_valida($strquery,$ccol,$ncol,$campos,$tamano,$dbms,$width,$mod,$eli,$ver,$campot,$campov)
{
	$col1 = "#EEEBE6";
	$col2 = "#FFFFFF";
	$impresion = $impresion . 
	"<table width=\"$width%\" border=\"0\" align=\"center\">
	  <tr bgcolor=\"#FFFFFC\" class=\"blue\">";
	$cnt = 0;
	while ($cnt < $ccol)
	{
		$impresion = $impresion . "<td $tamano[$cnt] class=\"white\">$ncol[$cnt]</td>";
		$cnt ++;
	}
	if (strlen(trim($mod)) > 0)	$impresion = $impresion . "<td width=\"10%\" class=\"white\">Modificar</td>";
//	if (strlen(trim($eli)) > 0)	print "<td width=\"10%\" class=\"white\">Borrar</td>";
	//if (strlen(trim($ver)) > 0)	print "<td width=\"10%\" class=\"white\">Ver</td>";
	$impresion = $impresion . "</tr>";
	$dbms->sql=$strquery;
	$dbms->Query();
	$ban = 0;
	$cantidad = 1;
	while($Fields=$dbms->MoveNext())
	{
		if (($ban - intval($ban/2)*2) != 0)
			$col= $col1;
		else
			$col= $col2;
		$impresion = $impresion . "<tr bgcolor= \"$col\">";
		$cnt = 0;
		while ($cnt < $ccol)
		{
			$impresion = $impresion . "<td><span class=\"Estilo1\">".$Fields[$campos[$cnt]]."</span></td>";
			$cnt ++;
		}
		if (strlen(trim($mod)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$mod".$Fields[$campos[$cnt]]."\"><img src=\"../../imagenes/modificar.png\" border=\"0\"/>Modificar</span></td>";
		if (strlen(trim($ver)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"resolucionimp.php?imp=1&idrespuesta=".$Fields[$campos[$cnt]]."\" target=\"_blank\" title=\"ver\"><img src=\"../../imagenes/ver.png\" border=\"0\"/></span></td>";
		if (strlen(trim($eli)) > 0)
		{
			if (intval($Fields[$campot]) == intval($campov))
			{
				$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$eli".$Fields[$campos[$cnt]]."\" title=\"Borrar\"><img src=\"../../imagenes/borrar2.png\" border=\"0\"/></span></td>";
			}
		}else
		{
			$impresion = $impresion . "&nbsp;";
		}
		$impresion = $impresion . "</tr>";
		$cantidad++;
		$ban = $ban + 1;
	}
	$impresion = $impresion . "</table>";
	if ($cantidad > 1) 
		print $impresion;
	else
		print "<img src=\"../../imagenes/atencion.png\" border=\"0\"/> no hay datos ingresados...<br>";

}

function get_usuario($idusuario,$dbms)
{
	$dbms->sql="select 
					idusuario,idtipousuario,(nombre1 + ' ' + nombre2 + ' ' + apellido1 + apellido2) as nombre,correo,telefono,extension,usuario,clave
				from tbl_usuario where idusuario = $idusuario";
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	return $Fields;
}

function get_max($tabla,$llave,$dbms)
{
	$dbms->sql="select max($llave) as campo from $tabla ";
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	return $Fields["campo"];
}

function getIP() {
    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
       $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } 
    elseif (isset($_SERVER['HTTP_VIA'])) {
       $ip = $_SERVER['HTTP_VIA'];
    } 
    elseif (isset($_SERVER['REMOTE_ADDR'])) {
       $ip = $_SERVER['REMOTE_ADDR'];
    }
    else { 
       $ip = "unknown";
    }
    
    return $ip;
}

function get_fuente($idfuente,$dbms)
{
	$dbms->sql="select 
					idfuente,idtipofuente,codigo,nombre
				from fuente where idfuente = $idfuente";
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	return $Fields;
}

function get_programa($idprograma,$dbms)
{
	$dbms->sql="select 
					idprograma,codigo,nombre
				from programa where idprograma = $idprograma";
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	return $Fields;
}

function get_actividad($idactividad,$dbms)
{
	$dbms->sql="select 
					idactividad,idprograma,codigo,nombre
				from actividad where idactividad = $idactividad";
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	return $Fields;
}

function get_grupo($idgrupo,$dbms)
{
	$dbms->sql="select 
					idgrupo,codigo,nombre
				from grupo where idgrupo = $idgrupo";
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	return $Fields;
}

function get_renglon($idrenglon,$dbms)
{
	$dbms->sql="select 
					idrenglon,codigo,nombre,idgrupo
				from renglon where idrenglon = $idrenglon";
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	return $Fields;
}

function get_parrafo($idforma,$idtipo,$idparrafo,$dbms)
{
	$dbms->sql="select 
					parrafo 
				from tbl_formulario 
				where 
					idforma = $idforma and
					idtiporespuesta = $idtipo and 
					idparrafo = $idparrafo
				";
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	return convertLatin1ToHtml($Fields["parrafo"]);
}

function get_valores($campos,$tabla,$condicion,$orden,$dbms)
{
	$dbms->sql="select 
					$campos
				from $tabla $condicion $orden";
	$dbms->Query();
	$Fields=$dbms->MoveNext();
	return $Fields;
}

function get_genero($valor)
{
	if (intval($valor)==1)
		return "Masculino";
	else
		return "Femenino";
}

function convertLatin1ToHtml($str) {
    $html_entities = array (
        "�" =>  "&aacute;",     #latin a
        "�" =>  "&eacute;",     #latin e
        "�" =>  "&iacute;",     #latin i
        "�" =>  "&oacute;",     #latin o
        "�" =>  "&uacute;",     #latin u
		"�" =>	"&ntilde;",  	#latin �

        "�" =>  "&Aacute;",     #latin A
        "�" =>  "&Eacute;",     #latin E
        "�" =>  "&Iacute;",     #latin I
        "�" =>  "&Oacute;",     #latin O
        "�" =>  "&Uacute;",     #latin U
		"�" =>	"&Ntilde;",  	#latin �
    );
    foreach ($html_entities as $key => $value) {
        $str = str_replace($key, $value, $str);
    }
    return $str;
} 

function get_materialessolicitud($idsolicitud,$dbms)
{
	$dbms->sql="select 
					m.cantidad,tm.descripcion,m.descripcion as descri 
				from 
					tbl_tipomaterial tm, tbl_materialentregado m
				where 
					tm.idtipomaterial = m.idtipomaterial and
					m.idsolicitud = $idsolicitud";
	$dbms->Query();
	$ban = 0;
	$material = " ";
	while ($Fields=$dbms->MoveNext())
	{
		if ($ban == 1) 
			$material = $material . ", ";
		else
			$ban = 1;
		$material = $material . $Fields["cantidad"]." ".$Fields["descripcion"]."(".$Fields["descri"].")";
	}
	return convertLatin1ToHtml($material);
}

function get_mes($idmes)
{
	$mes[1] = "Enero";
	$mes[2] = "Febrero";
	$mes[3] = "Marzo";
	$mes[4] = "Abril";
	$mes[5] = "Mayo";
	$mes[6] = "Junio";
	$mes[7] = "Julio";
	$mes[8] = "Agosto";
	$mes[9] = "Septiembre";
	$mes[10] = "Ocbubre";
	$mes[11] = "Noviembre";
	$mes[12] = "Diciembre";
	return $mes[$idmes];
}

function get_formatofecha($fecha)
{
	$formatofecha = substr($fecha,0,2)." de ".get_mes(intval(substr($fecha,3,2)))." de ".substr($fecha,6,4);
	return $formatofecha;
}


?>
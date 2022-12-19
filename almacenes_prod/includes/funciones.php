<?PHP

function getTabla2($strquery,$ccol,$ncol,$campos,$tamano,$dbms,$width,$mod,$eli,$ver)
{
	$col1 = "#fea";
	$col2 = "#FFFFFF";
	$impresion = 
	"<div class=\"container2 mt-5\" ><table width=\"$width%\" id=\"Contenido\" class=\"table\" border=\"0\" align=\"center\">
	<thead>
	  <tr bgcolor=\"#FFFFFC\" class=\"blue\">";
	$cnt = 0;
	while ($cnt < $ccol)
	{
	$impresion = $impresion . "<th $tamano[$cnt] class=\"white\">$ncol[$cnt]</th>";
		$cnt ++;
	}
	if (strlen(trim($mod)) > 0)	$impresion = $impresion . "<th style=\"text-align:center;\" width=\"10%\" class=\"white\">Editar</th>";
	 if (strlen(trim($eli)) > 0)	$impresion = $impresion . "<th width=\"15%\" class=\"white\">Borrar</th>";
	if (strlen(trim($ver)) > 0)	$impresion = $impresion . "<th width=\"15%\" class=\"white\">Ver</th>";
	$impresion = $impresion . "</tr></thead>";
	$dbms->sql=$strquery;
	$dbms->Query();
	$ban = 0;
	$cantidad = 1;
	//print_r($dbms);
	
	while($Fields=$dbms->MoveNext())
	{
		// var_dump($Fields[$campos]);
		if (($ban - intval($ban/2)*2) != 0)
			$col= $col1;
		else
			$col= $col2;
		$impresion = $impresion . "<tr bgcolor= \"$col\">";
		$cnt = 0;
		while ($cnt < $ccol)
		{
			$impresion = $impresion . "<td><span class=\"Estilo1\">";


			if(($cnt == 8 || $cnt == 9)&& (int)$Fields[$campos[5]]  <=0 ){
				$impresion = $impresion . "0";
				}
				else{ 
					if (gettype($Fields[$campos[$cnt]])=='double'){
						$impresion = $impresion . round($Fields[$campos[$cnt]],2);
					}
					else{
						$impresion = $impresion . utf8_encode($Fields[$campos[$cnt]]);
					}
				}


			
			
			
			$impresion = $impresion . "</span></td>";
			$cnt ++;
		}
		if (strlen(trim($mod)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\" ><a href=\"$mod".utf8_encode($Fields[$campos[0]])."\"><center><img src=\"../ingresos_egresos/imagenes/modificar.png\" border=\"0\"/></center></span></td>";
		
		 if (strlen(trim($eli)) > 0)
		 	$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$eli".$Fields[$campos[0]]."\"><center><img src=\"../ingresos_egresos/imagenes/borrar.png\" border=\"0\"/></center></span></td>";
		if (strlen(trim($ver)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$ver".$Fields[$campos[0]]."\" title=\"ver\"><center><img src=\"../ingresos_egresos/imagenes/ver.png\" border=\"0\"/><center></span></td>";

		$impresion = $impresion . "</tr>";
		$cantidad++;
		$ban = $ban + 1;
	}
	$impresion = $impresion . "</table></div>";
	if ($cantidad > 1) 
		print $impresion;
	else
		print "<img src=\"../ingresos_egresos/imagenes/atencion.png\" border=\"0\"/> no hay datos ingresados...<br>";
}



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
	if (strlen(trim($mod)) > 0)	$impresion = $impresion . "<td width=\"10%\" class=\"white\">Cambiar</td>";
	if (strlen(trim($eli)) > 0)	$impresion = $impresion . "<td width=\"10%\" class=\"white\">Borrar</td>";
	if (strlen(trim($ver)) > 0)	$impresion = $impresion . "<td width=\"10%\" class=\"white\">Ver</td>";
	$impresion = $impresion . "</tr>";
	
	$dbms->sql=$strquery;
	$dbms->Query();
	$ban = 0;
	$cantidad = 1;
	//print_r($dbms);
	
	while($Fields=$dbms->MoveNext())
	{
		if (($ban - intval($ban/2)*2) != 0)
			$col= $col1;
		else
			$col= $col2;
		$impresion = $impresion . "<tr bgcolor= \"$col\">";
		$cnt = 0;
		echo "<br>";
		echo $cnt;
		while ($cnt < $ccol)
		{
			
			if(($cnt == 8 || $cnt == 9)&& (int)$Fields[$campos[5]] === 0){ $impresion = $impresion . "<td><span class=\"Estilo1\">0</span></td>";}
			else{ $impresion = $impresion . "<td><span class=\"Estilo1\">".utf8_encode($Fields[$campos[$cnt]])."</span></td>"; }

			/*Cambio 03-02-2017
				$impresion = $impresion . "<td><span class=\"Estilo1\">".$Fields[$campos[$cnt]]."</span></td>";
			*/
			$cnt ++;
		}
		if (strlen(trim($mod)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$mod".utf8_encode($Fields[$campos[$cnt]])."\"><img src=\"../ingresos_egresos/imagenes/modificar.png\" border=\"0\"/></span></td>";
		if (strlen(trim($eli)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$eli".utf8_encode($Fields[$campos[$cnt]])."\"><img src=\"../ingresos_egresos/imagenes/borrar.png\" border=\"0\"/></span></td>";
		if (strlen(trim($ver)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$ver".utf8_encode($Fields[$campos[$cnt]])."\" title=\"ver\"><img src=\"../ingresos_egresos/imagenes/ver.png\" border=\"0\"/></span></td>";

		$impresion = $impresion . "</tr>";
		$cantidad++;
	
		$ban = $ban + 1;
	}
	$impresion = $impresion . "</table>";

	if ($cantidad > 1) 
		print $impresion;
		//print 'la tabla';
	else
		print "<img src=\"../ingresos_egresos/imagenes/atencion.png\" border=\"0\"/> no hay datos ingresados...<br>";

	
}


function getTabla3($strquery,$ccol,$ncol,$campos,$tamano,$dbms,$width,$mod,$eli,$ver)
{
	
	$col1 = "#fea";
	$col2 = "#FFFFFF";
	$impresion = 
	"<table width=\"$width%\" class=\"table\" border=\"0\" align=\"center\">
	  <tr bgcolor=\"#FFFFFC\" class=\"blue\">";
	$cnt = 0;
	while ($cnt < $ccol)
	{

		if(($cnt == 8 || $cnt == 9)&& (int)$Fields[$campos[5]]  <=0 ){
			$impresion = $impresion . "<td><span class=\"Estilo1\">0</span></td>";
			}
			else{ 
				$impresion = $impresion . "<td><span class=\"Estilo1\">".$Fields[$campos[$cnt]]."</span></td>"; 
			}
	/*$impresion = $impresion . "<td $tamano[$cnt] class=\"white\">$ncol[$cnt]</td>";*/
		$cnt ++;
	}
	if (strlen(trim($mod)) > 0)	$impresion = $impresion . "<td style=\"text-align:center;\" width=\"10%\" class=\"white\">Editar</td>";
	 if (strlen(trim($eli)) > 0)	$impresion = $impresion . "<td width=\"15%\" class=\"white\">Borrar</td>";
	if (strlen(trim($ver)) > 0)	$impresion = $impresion . "<td width=\"15%\" class=\"white\">Ver</td>";
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
			if(($cnt == 8 || $cnt == 9)&& (int)$Fields[$campos[5]] === 0){ 
				$impresion = $impresion . "<td><span class=\"Estilo1\">0</span></td>";
			}
			else{ 
				$impresion = $impresion . "<td><span class=\"Estilo1\">".$Fields[$campos[$cnt]]."</span></td>"; }
			/*$impresion = $impresion . "<td><span class=\"Estilo1\">".$Fields[$campos[$cnt]]."</span></td>";*/
			$cnt ++;
		}
		if (strlen(trim($mod)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\" ><a href=\"$mod".$Fields[$campos[0]]."\"><center><img src=\"../ingresos_egresos/imagenes/modificar.png\" border=\"0\"/></center></span></td>";
		
		 if (strlen(trim($eli)) > 0)
		 	$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$eli".$Fields[$campos[0]]."\"><center><img src=\"../ingresos_egresos/imagenes/borrar.png\" border=\"0\"/></center></span></td>";
		if (strlen(trim($ver)) > 0)
			$impresion = $impresion . "<td><span class=\"Estilo1\"><a href=\"$ver".$Fields[$campos[0]]."\" title=\"ver\"><center><img src=\"../ingresos_egresos/imagenes/ver.png\" border=\"0\"/><center></span></td>";

		$impresion = $impresion . "</tr>";
		$cantidad= $cantidad+1;
		$ban = $ban + 1;
	}
	$impresion = $impresion . "</table>";
	if ($cantidad > 1) 
		print $impresion;
	else
		print "<img src=\"../ingresos_egresos/imagenes/atencion.png\" border=\"0\"/> no hay datos ingresados...<br>";
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
<style>
	.mt-5{
		margin-top:25px;
	}
.container2 table {     font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
    font-size: 10px;    margin: 8px;     width: 100%; text-align: center;    border-collapse: collapse; }

.container2 th {     font-size: 14px;     font-weight: normal;     padding: 7px;    
    border-top: 4px solid #aabcfe;    border-bottom: 1px solid #fff; color: #fff; }

.container2 td { font-size: 12px;   padding: 15px;      border-bottom: 1px solid #fff;
      border-top: 1px solid transparent; }

.container2 tr:hover td { background: #353535; color: #fff; }
</style>
 <script type='text/javascript' src="../bootstrap/jquery/jquery-3.2.1.js"></script> 
 <script type='text/javascript' src="../datatable/js/jquery.dataTables.min.js"></script>
 <link rel="stylesheet" type="text/css" href="../datatable/css/jquery.dataTables.min.css">
<script>
    $(document).ready(function(){
		$("#Contenido").DataTable({
			'destroy': true,
			'pagingType': 'full',
			'searching': true,
			'ordering': true,
			'lengthChange': true,
			'autoWidth': false,
			'pageLength': 18,    
			'responsive': true,
			'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, "Todos"] ],
			"language":{
				"url": "../js/Spanish.json"
			}
        })
    });
</script>




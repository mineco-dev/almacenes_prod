<style type="text/css">
<!--
.Estilo_iso_mt {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-weight: bold;
	color: #000000;
}

-->
</style>

<?
	require ('Connections/redes.php');
    $db = mysql_connect($hostname_redes,$username_redes,$password_redes);
	mysql_select_db($database_redes,$db);
	session_start();
	$usuario23 = $_SESSION['codigoUsuario'];
	$page = $_SESSION['pagina'];
	$page = $_SESSION['folder'].$page;

	$_SESSION['iso_registro'] = "";


	$SQL = "select t.registro from empleados  e, temas t where e.area = t.idtemas and e.idempleado = $usuario23";
	$result = mysql_query($SQL);
	$row_iso = mysql_fetch_row($result);
	$mt_nombre_iso = $row_iso[0];

	if (strlen(trim($mt_nombre_iso))==0) $mt_nombre_iso = "SS";
	
	$mt_registro_iso = "R";

	$SQL = "select count(*) from iso_registro where pagina = '$page' and nombre = '$mt_nombre_iso'";
	//print $SQL;
	$result = mysql_query($SQL);
	$row_iso = mysql_fetch_row($result);
	$mt_no_iso = intval($row_iso[0]);
	//if (intval($usuario23)==36)
	//{
		if (intval($mt_no_iso)==0)
		{
			$SQL = "select if(max(numero)=null,1,max(numero)+1) from iso_registro where nombre = '$mt_nombre_iso'";
//			print $SQL;
			$result = mysql_query($SQL);
			$row_iso = mysql_fetch_row($result);
			$mt_no_iso = intval($row_iso[0]);

			$SQL = "select titulo,descripcion from iso_registro where pagina = '$page' and length(titulo) > 0";
			//print $SQL;
			$result = mysql_query($SQL);
			$row_iso = mysql_fetch_row($result);
			$tit = $row_iso[0];
			$des = $row_iso[1];
	
			$SQL = "insert into iso_registro(registro,nombre,numero,pagina,titulo,descripcion) 
					values 
					('$mt_registro_iso','$mt_nombre_iso',$mt_no_iso, '$page','$tit','$des')";
			$result = mysql_query($SQL);
			$_SESSION['iso_registro'] = $mt_registro_iso."-".$mt_nombre_iso."-".$mt_no_iso;

	}
	//}
	$SQL = "select concat(registro,'-',nombre,'-',
	if (length(numero) = 1,concat('0',numero),numero)
	) from iso_registro where pagina = '$page' and nombre = '$mt_nombre_iso'";
	
//	$SQL = "select concat(registro,'-',nombre,'-',numero) from iso_registro where pagina = '$page' and nombre = '$mt_nombre_iso'";
	
	$result = mysql_query($SQL);
	$row_iso = mysql_fetch_row($result);

	$_SESSION['iso_registro'] = 	"<span class=\"Estilo_iso_mt\">$row_iso[0]</span>";
	
	$usuario23 = $_SESSION['codigoUsuario'];
	
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
	$fech = date("Y-m-d");
	$SQL = "insert into bitacora(pagina,ip,fecha,usuario) values ('$page','$ip','$fech', $usuario23)";
	$result = mysql_query($SQL);




/*
	require ('Connections/redes.php');
    $db = mysql_connect($hostname_redes,$username_redes,$password_redes);
	mysql_select_db($database_redes,$db);
	session_start();	$_SESSION['folder'] = "";
     $usuario23 = $_SESSION['codigoUsuario'];
	 $page = $_SESSION['pagina'];
		$SQL = "select *  from rol r, programa p, acceso a,empleados e, permiso pe where r.rol = a.rol  and p.programa = a.programa  and p.nombre = '$page'  and pe.rol = r.rol and pe.empleado = e.idempleado and e.idempleado = ".$usuario23;
		$result = mysql_query($SQL);
		$row = mysql_fetch_row($result);
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
			$fech = date("Y-m-d");
			$SQL = "insert into bitacora(pagina,ip,fecha,usuario) values ('$page','$ip','$fech', $usuario23)";
			$result = mysql_query($SQL);

		if ($row[0]>0)
		{

		}
		else
		{
			header("Location: Nologin.php");
		}
		mysql_close($db);*/
	//require('selmenu.php');
?>

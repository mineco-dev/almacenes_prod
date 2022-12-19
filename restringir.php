<?php	
session_start();
	//Validar la sesi�n 	
	if (!isset($_SESSION["subgerencia"])) $dependencia=33;			
	else $dependencia=($_SESSION["subgerencia"]);		
	if (!isset($_SESSION["this_cookie"]))
	{
		$user=3;
	}
	else
		{
			$user=($_SESSION["user_id"]);			
			$departament_id=($_SESSION["departament_id"]);			
		}	
	$entro=0;	
   	require_once('connection/helpdesk.php');
	$consulta = "select * from rol WHERE ((codigo_usuario ='$user') AND (codigo_dependencia = '$dependencia') AND (codigo_grupo_enc = '$grupo_id'))";
//	$consulta = "select * from rol WHERE ((codigo_usuario ='$user') AND (codigo_dependencia = '$dependencia') AND (codigo_grupo_enc >= '$grupo_id'))";
	$result=mssql_query($consulta);				
	while($row=mssql_fetch_array($result))
	{
		$entro=1;
	}
	//if ($entro==0) header("Location: restringido.php"); 		
?>
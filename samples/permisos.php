<?php
session_start();
error_reporting(0);

	$user=($_SESSION["user_id"]);	// id del usuario logeado		
    require_once('../connection/helpdesk.php');
	//verifica si el usuario tiene permiso para el rol solicitado
	if (!isset($_SESSION["param_conexion"])) 
	{		
		$qry_grupos="select distinct(codigo_grupo_enc), permisos  from rol where codigo_usuario='$user'";		
		//print($qry_grupos);
		$i=1;
		$res_qry_grupos=$query($qry_grupos);
		while($row_qry_grupos=$fetch_array($res_qry_grupos))
		{					
			$grupo[$i]=$row_qry_grupos["codigo_grupo_enc"];									
			$permiso[$i]=$row_qry_grupos["permisos"];
			$i ++;			
			
		}					
			// session_register("param_conexion");
			$i=1;
			$j=1;
			while ($i <= count($grupo))
			{				
				$qry_permisodb="select db.nombre, db.contrasena, db.base_de_datos, p.codigo_grupo_rol, p.codigo_tipo_permiso
								from tb_usuario_db db 							
								inner join tb_permiso_db_xusuario p on
								p.codigo_usuario_db=db.codigo_usuario_db and p.codigo_tipo_permiso=$permiso[$i]
								where codigo_grupo_rol=$grupo[$i] and db.activo= 1";  //obtiene usuario y password de db por grupo_rol autorizado													
				$res_qry_permisodb=$query($qry_permisodb);
				while($row_permisodb=$fetch_array($res_qry_permisodb))
				{											
					$_SESSION["param_conexion"]["$j"][1]=$row_permisodb["nombre"];
					$_SESSION["param_conexion"]["$j"][2]=$row_permisodb["contrasena"];
					$_SESSION["param_conexion"]["$j"][3]=$row_permisodb["codigo_grupo_rol"];	
					$_SESSION["param_conexion"]["$j"][4]=$row_permisodb["base_de_datos"];		
					$_SESSION["param_conexion"]["$j"][5]=$row_permisodb["codigo_tipo_permiso"];						
					$j++;																		
				}
				$i++;
			}									
		}
header("Location: ../index.php");
exit();
?>
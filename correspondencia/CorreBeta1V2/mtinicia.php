<?php 
   session_start() ; 
		include('../INCLUDES/inc_header.inc');
		$dbms=new DBMS($conexion); 
		include('../conectarse.php');	
$mtval="";
	$qtv = "SELECT * from asesor where idasesor = $mtcc ";
	//print $qtv;
	$rtv = mssql_query($qtv);
	if ($rowa=mssql_fetch_array($rtv)) 
	{
		$mtval= $rowa[0];
		if (strlen(trim($mtval)) >0)
		{
			  $validado=true; 
			  session_register('user');
			  session_register('psswd');
			  session_register('stratado');
			  session_register('sidtratado');
			  session_register('sdireccio');
			  
			  /****************************modificado por DataTech**************/
			  
			  session_register('empleado');
			  $_SESSION['empleado'] = $rowa[0];
			  $_SESSION['codigoUsuario'] =  $rowa[0];
			  

			  /********************************************************************************/
			  $_SESSION['user'] =$mtusuario;
			  $_SESSION['psswd'] = $mtpassword;
			  $_SESSION['stratado'] = "OMC";
			  $_SESSION['sidtratado'] = "1";
			  
			  /**************************PARA LAS ACTIVIDADES ******************************/
			  session_register('ssalon');
			  session_register('slugar');
			  session_register('shora');
  			  session_register('sdescripcion');
			  session_register('sreunion');

			if (strlen($docu) > 0)
			{
		//		header("Location: http://dace.mineco.gob.gt/CorreBeta1V2/visualiza/documento.php?docu=$docu&quien=$quien");
			cambiar_ventana("http://localhost:8585/CorreBeta1V2/visualiza/documento.php?docu=$docu&quien=$quien");
			}
		}
    }
?> 
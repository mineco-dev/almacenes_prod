<?php


    require_once('../comandos/inc_seguridad.inc');
    require_once('../comandos/funciones.php');
    require_once('../comandos/sqlcommand.inc');
    require_once('../comandos/controldb.inc');
    $dbms = new DBMS(conectardb($almacen));
    $dbms->bdd = $database_cnn;
    
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);


	/*require('../includes/cnn/inc_header.inc');
	$dbms=new DBMS(conectardb($almacen));	
	$dbms->bdd=$database_cnn;
	require('../includes/funciones.php');
    */
	$value_change = $_POST['value'];
	$change_id = $_POST['row_id'];



	$new_change="UPDATE tb_requisicion_det SET cantidad_solicitada ='$value_change'WHERE rowid='$change_id'";
	if($query($new_change)){
		$values_data = "SELECT cantidad_solicitada FROM tb_requisicion_det WHERE rowid = '$change_id'";
		$result = $query($values_data);
		while($row=$fetch_array($result))
			{				
			
			$cantidad=$row["cantidad_solicitada"];
			
			}
		
		print($cantidad);
	}else{
		print(false);
	};

?>
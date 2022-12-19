<?php
    // phpinfo();
    session_start();
    ob_start();

    require_once('../../../connection/conectionPool.php');
    $conn = new Conexion('almacen_nuevo_qa');
    $conexion = $conn->Conectar();

    // require("../../../includes/funciones.php");
	// require("../../../includes/sqlcommand.inc");

    // function getData($despacho){

    //     $data = "SELECT 
    //         CONVERT(nvarchar(10), e.fecha_requisicion, 103) as fecha_requisicion,
    //         CONVERT(nvarchar(10), e.fecha_despacho, 103) as fecha_despacho,
    //         e.codigo_egreso,
    //         e.numero_ingresofac,
    //         dep.nombre,
    //         e.codigo_requisicion_enc,
    //         e.solicitante,
    //         e.observaciones
    //         FROM tbl_requisicion_env e
    //         INNER JOIN direccion dep on dep.iddireccion = e.codigo_dependencia
    //         WHERE e.codigo_estatus = 6 and e.codigo_requisicion_enc =" . $despacho;
    //     conectardb($almacen);
    //     $search = $query($data);
    //     $data_array = array();

    //     while ($row = $fetch_array($search)) {
    //         $numero_requisicion=$row_ingreso_enc["codigo_requisicion_enc"];
    //         $solicitante=$row_ingreso_enc["solicitante"];
    //         $dependencia=$row_ingreso_enc["nombre"];
    //         $observaciones=$row_ingreso_enc["observaciones"];
    //         $numero_egreso=$row_ingreso_enc["codigo_egreso"];
    //         $numero_ingreso=$row_ingreso_enc["numero_ingresofac"];
    //         $fecha=$row_ingreso_enc["fecha_requisicion"];
    //         $fecha_despacho=$row_ingreso_enc["fecha_despacho"];
    //         $existe=true;
    //     }
    // }

    // $hoja_despacho=$_SESSION["hoja_despacho"];
	// 		$existe=false;
	// 		$qry_ingreso_enc = "select convert(nvarchar(10), e.fecha_requisicion, 103) as fecha_requisicion,
    //         convert(nvarchar(10), e.fecha_despacho, 103) as fecha_despacho, 
    //         e.codigo_egreso, e.numero_ingresofac,
    //         dep.nombre, e.codigo_requisicion_enc, 
    //         e.solicitante, e.observaciones 
    //         from tb_requisicion_enc e inner join direccion dep on dep.iddireccion = e.codigo_dependencia where e.codigo_estatus = 6 and e.codigo_requisicion_enc = '$hoja_despacho'";

	// 		conectardb($almacen);
	// 		$res_ingreso_enc=$query($qry_ingreso_enc);
	// 		while($row_ingreso_enc=$fetch_array($res_ingreso_enc))
	// 		{
	// 		 	$numero_requisicion=$row_ingreso_enc["codigo_requisicion_enc"];
	// 			$solicitante=$row_ingreso_enc["solicitante"];
	// 			$dependencia=$row_ingreso_enc["nombre"];
	// 			$observaciones=$row_ingreso_enc["observaciones"];
	// 			$numero_egreso=$row_ingreso_enc["codigo_egreso"];
	// 			$numero_ingreso=$row_ingreso_enc["numero_ingresofac"];
	// 			$fecha=$row_ingreso_enc["fecha_requisicion"];
	// 			$fecha_despacho=$row_ingreso_enc["fecha_despacho"];
	// 			$existe=true;
				
	// 		}
	// 		$free_result($res_ingreso_enc);	
	// 		if ($existe==true)
	// 		{	
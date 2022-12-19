<?
	require("envio_correo.php");
	
	///// se llena la información /////////////
	
	$nomb_destino = "MINECO";
	$mail_destino = "wzurdo@mineco.gob.gt";
	$nomb_remitente = "Ministerio de Economía";
	$mail_remitente = "wzurdo@mineco.gob.gt";
	$mensaje = "Este es un mensaje de prueba <br> para utilizar la funcion de envio de correos";
	$titulo = "Prueba del correo";	
	
	////////  de esta manera se envian los correos //////
	
	envio($nomb_destino,$mail_destino,$nomb_remitente,$mail_remitente,$mensaje,$titulo,"","");   


	/*
		Los ultimos dos parametros se utilizan para enviar documentos adjuntos,
		el primer parametro es :
		$HTTP_POST_FILES['userfile']['name']
		el segundo parametro es el que tiene la ubicación del documento
		por el momento no se llenan estos parametros si no se adjuntan archivos
	*/

?>

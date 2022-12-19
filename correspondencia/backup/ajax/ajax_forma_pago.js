<script language="javascript" type="text/javascript">
function nuevoAjax(){ 
	var xmlhttp=false; 
	try { 
		xmlhttp=new ActiveXObject("Msxml2.XMLHTTP"); 
	}
	catch(e) { 
		try { 
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
		} 
		catch(E) { xmlhttp=false; }
	}
	if (!xmlhttp && typeof XMLHttpRequest!='undefined') { xmlhttp=new XMLHttpRequest(); } 

	return xmlhttp; 
}
function eliminarDatos(){
	        var nombre=document.forma_pago.nombre.value;
	        var id_fpa=document.forma_pago.id_fpa.value;
		    var eliminar = confirm("confirma eliminar: "+ nombre +" ?");
	    
	    if ( eliminar ) {
			ajax=nuevoAjax();
			
			ajax.open("POST", "/modulos/mo_forma_pago.php", true);
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
				var var_send="op1=delete"+"&id_fpa="+id_fpa;
			
			ajax.send(var_send);
			
		    nuevoDatos();
		    
			cargaContenido("forma_pago","1");
	    }
}        
function guardarDatos(){
 		var id_fpa=document.forma_pago.id_fpa.value;
			nombre=document.forma_pago.nombre.value;
	
		ajax=nuevoAjax();
		
		ajax.open("POST", "/modulos/mo_forma_pago.php", true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			var var_send="id_fpa="+id_fpa+"&op1=insert&nombre="+nombre;

		ajax.send(var_send);
		
		nuevoDatos();
		
		cargaContenido("forma_pago","1"); 
}
function nuevoDatos(){
 	   document.forma_pago.id_fpa.value=""
       document.forma_pago.nombre.value="";
       document.forma_pago.nombre.focus();
}

function cargaContenido(consulta,fila){
		  var ajax=nuevoAjax();
          var capaContenedora = document.getElementById(fila);
          ajax.open ("POST","/modulos/selected.php", true);
          ajax.onreadystatechange = function() {
		         if (ajax.readyState==1) {
		                          capaContenedora.innerHTML="Cargando.......";
		         } else if (ajax.readyState==4){
		                   if(ajax.status==200){
		                        document.getElementById(fila).innerHTML=ajax.responseText;
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="consulta="+consulta;
         ajax.send(var_send);
  return;
}

function leerDatos(){
	 var lista_forma_pago=document.getElementById('formas_pagos');
	 var id_fpa=lista_forma_pago.value;

		  var ajax=nuevoAjax();

          var capaContenedora = document.getElementById('d');
          ajax.open ("POST","/modulos/mo_xml.php", true);
          ajax.onreadystatechange = function() {
		         if (ajax.readyState==1) {
		                          capaContenedora.innerHTML="Cargando.......";
		         } else if (ajax.readyState==4){
		                   if(ajax.status==200){
				                   	capaContenedora.innerHTML="";
		                       		var vari=ajax.responseXML;
						          		document.forma_pago.id_fpa.value=id_fpa;
										document.forma_pago.nombre.value = vari.getElementsByTagName('nombre').item(0).firstChild.data; 
						        		document.forma_pago.nombre.focus();
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="id_fpa="+id_fpa+"&modulo=forma_pago";
         ajax.send(var_send);
  return; 
}
</script>
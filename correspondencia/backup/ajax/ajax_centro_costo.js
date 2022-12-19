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
	        var nombre=document.centro_costo.nombre.value;
	        var id_cto=document.centro_costo.id_cto.value;
		    var eliminar = confirm("confirma eliminar: "+ nombre +" ?");
	    
	    if ( eliminar ) {
			ajax=nuevoAjax();
			
			ajax.open("POST", "/modulos/mo_centro_costo.php", true);
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
				var var_send="op1=delete"+"&id_cto="+id_cto;
			
			ajax.send(var_send);
			
			nuevoDatos();
		    
			cargaContenido("centro_costo","2");
		    
	    }
}        
function guardarDatos(){
 			var id_cto=document.centro_costo.id_cto.value;
			var lista1=document.getElementById('sucursal')
		id_suc=lista1.value;
		nombre=document.centro_costo.nombre.value;
	
		ajax=nuevoAjax();
		
		ajax.open("POST", "/modulos/mo_centro_costo.php", true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			var var_send="id_cto="+id_cto+"&op1=insert&id_suc="+id_suc+"&nombre="+nombre;

		ajax.send(var_send);
		
		nuevoDatos();
		
		cargaContenido("centro_costo","2"); 
}
function nuevoDatos(){
 	   document.centro_costo.id_cto.value=""
       document.centro_costo.nombre.value="";
            var lista1=document.getElementById('sucursal')
	        lista1.options[0].selected=true;
       document.centro_costo.nombre.value="";
       document.centro_costo.nombre.focus();
    return;
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
	 var lista_centro_costo=document.getElementById('centro_costos');
	 var id_cto=lista_centro_costo.value;

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
					          		document.centro_costo.id_cto.value=id_cto;
									document.centro_costo.nombre.value = vari.getElementsByTagName('nombre').item(0).firstChild.data; 
										var id_suc=vari.getElementsByTagName('id_suc').item(0).firstChild.data;//-1; 
												 for (i=0;i<document.centro_costo.sucursal.options.length+1;i++) {
												   if(document.centro_costo.sucursal.options[i].value==id_suc){
														document.centro_costo.sucursal.options[i].selected=true;	
														break;
													}
												 } 
					        		document.centro_costo.nombre.focus();
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="id_cto="+id_cto+"&modulo=centro_costo"
         ajax.send(var_send);
  return; 
}
</script>
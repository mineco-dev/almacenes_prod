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
		    var eliminar = confirm("confirma eliminar comisión actual ?");
	    
	    if ( eliminar ) {
			ajax=nuevoAjax();
			ajax.open("POST", "/modulos/mo_finiquitos.php", true);
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
				var var_send="op1=delete"+"&id_fin="+document.finiquito.id_fin.value;
			
			ajax.send(var_send);

		    nuevoDatos();

		    cargaContenido("finiquito","1");
	    }        
}        

function guardarDatos(){
		rut_per=document.finiquito.rut_per.value;
		id_fin=document.finiquito.id_fin.value;
		fh_fin=document.finiquito.fh_fin.value;
		var id_cfi=document.getElementById('causal');
		
		ajax=nuevoAjax();
		
		ajax.open("POST", "/modulos/mo_finiquitos.php", true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");

			var var_send="op1=insert&id_fin="+id_fin+"&rut_per="+rut_per+"&fh_fin="+fh_fin+"&id_cfi="+id_cfi.value;

		ajax.send(var_send);
		cargaContenido("finiquito","1");
		return;
}

function nuevoDatos(tipo_nuevo){
       document.finiquito.fh_fin.value="";
       document.finiquito.id_fin.value="";
       document.finiquito.fh_fin.focus();

   	 if(tipo_nuevo==1){
   	  	document.finiquito.rut_per.value="";
		 var tabla = document.getElementsByName('ingreso');
              tabla[0].style.display = 'none';
		 var tabla = document.getElementsByName('bottones');
              tabla[0].style.display = 'none';
        var tabla = document.getElementsByName('buscador');
        tabla[0].style.display = '';       
     }

    return;
}

function filtro_rut(){
    var tabla = document.getElementsByName('buscador');
        tabla[0].style.display = 'none';
	cargaContenido('finiquito','1');	
	return;
}

function buscar_persona(){
	var lista_finiquito=document.getElementById('buscar_personas');
	var rut=lista_finiquito.value;
	  var buscar = confirm("confirma busqueda ?");
	      if ( buscar ) {
	       	document.finiquito.rut_per.value=rut;
	       	 var tabla = document.getElementsByName('buscador');
		         tabla[0].style.display = 'none';
			 	 BuscarTrabajador();
		  } 
	return;
}

function BuscarTrabajador(){
 		  var rut=document.finiquito.rut_per.value;
 		 
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
									 if(vari.getElementsByTagName('rut').item(0).firstChild.data=='error'){
										alert('Rut ingresado '+rut+' no existe ?');
										document.finiquito.rut_per.focus();
									 } else  {
									  	document.getElementById('r').innerHTML=vari.getElementsByTagName('rut').item(0).firstChild.data;
									  	document.getElementById('e').innerHTML=vari.getElementsByTagName('nombre').item(0).firstChild.data;
									  	document.getElementById('f').innerHTML=vari.getElementsByTagName('telefono').item(0).firstChild.data;									  	
									  	var tabla = document.getElementsByName('buscador');
									        tabla[0].style.display = 'none';
										cargaContenido('finiquito','1');
									}
									 
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="rut_per="+rut+"&modulo=trabajador";
         ajax.send(var_send);
  return;
}

function filtro_nombres(tipo_filtro,fila){
	var parametro=document.finiquito.nombres.value	
  	if (tipo_filtro==0){
 	 	nlike='nombre';
	}else{
		nlike='apellido';	
	}
  		  var ajax=nuevoAjax();
          var capaContenedora = document.getElementById(fila);
          ajax.open ("POST","/modulos/filtro.php", true);
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
         var var_send="filtro="+parametro+"&nlike="+nlike;
         ajax.send(var_send);
  return;
}

function cargaContenido(consulta,fila){ 
 		var rut=document.finiquito.rut_per.value;
	    
		var ajax=nuevoAjax();
	   
          var capaContenedora = document.getElementById(fila);
          ajax.open ("POST","/modulos/selected.php", true);
          ajax.onreadystatechange = function() {
		         if (ajax.readyState==1) {
		                          capaContenedora.innerHTML="Cargando.......";
		         } else if (ajax.readyState==4){
		                   if(ajax.status==200){
		                        document.getElementById(fila).innerHTML=ajax.responseText;
		                        if(document.finiquito.rut_per.value==''){					
								} else {
							  		 var tabla = document.getElementsByName('ingreso');
							              tabla[0].style.display = '';
									 var tabla = document.getElementsByName('bottones');
							              tabla[0].style.display = '';
						         }
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="consulta="+consulta+"&rut_per="+rut;
         ajax.send(var_send);
  return;  
}

function leerDatos(){
		 var lista_finiquito=document.getElementById('finiquitos');
	 	 document.finiquito.id_fin.value=lista_finiquito.value;

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

						         		document.finiquito.fh_fin.value = vari.getElementsByTagName('fh_fin').item(0).firstChild.data;
						         		var id_cfi = vari.getElementsByTagName('id_cfi').item(0).firstChild.data;
									    for (i=0;i<document.finiquito.causal.options.length+1;i++) {
										   if(document.finiquito.causal.options[i].value==id_cfi){
												document.finiquito.causal.options[i].selected=true;	
												break;
											}
										 } 
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="id_fin="+lista_finiquito.value+"&modulo=finiquito";
         ajax.send(var_send);
  return; 										
}
</script>
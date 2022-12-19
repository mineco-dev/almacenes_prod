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
	        var nombre=document.tipo_cargo.nombre.value;
	        var id_cgo=document.tipo_cargo.id_cgo.value;
		    var eliminar = confirm("confirma eliminar: "+ nombre +" ?");

	    if ( eliminar ) {
		  var ajax=nuevoAjax();

          var capaContenedora = document.getElementById('d');
          ajax.open ("POST","/modulos/mo_tipo_cargos.php", true);
          ajax.onreadystatechange = function() {
		         if (ajax.readyState==1) {
		                          capaContenedora.innerHTML="Cargando.......";
		         } else if (ajax.readyState==4){
		                   if(ajax.status==200){
			                    capaContenedora.innerHTML="";
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
          ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
          var var_send="op1=delete"+"&id_cgo="+id_cgo;
          ajax.send(var_send);
          cargaContenido("tipo_cargo","2");
		  nuevoDatos();
	    }
	  return; 
}        
function guardarDatos(){
 			var id_cgo=document.tipo_cargo.id_cgo.value;
			var lista1=document.getElementById('centro_costo')
		c1=lista1.value;
		c2=document.tipo_cargo.nombre.value;
		ajax=nuevoAjax();
		
		ajax.open("POST", "/modulos/mo_tipo_cargos.php", true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			var var_send="id_cgo="+id_cgo+"&op1=insert&c1="+c1+"&c2="+c2;
		ajax.send(var_send);
		
		if(document.tipo_cargo.id_cgo.value==''){
			nuevoDatos();
		}
		
		cargaContenido("tipo_cargo","2");
		
}
function nuevoDatos(){
 	   document.tipo_cargo.id_cgo.value=""
       document.tipo_cargo.nombre.value="";
            var lista1=document.getElementById('centro_costo')
	        lista1.options[0].selected=true;
       document.tipo_cargo.nombre.value="";
       document.tipo_cargo.nombre.focus();
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
	var lista_tipo_cargo=document.getElementById('tipos_cargos');
	var id_cgo=lista_tipo_cargo.value;

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
						          		document.tipo_cargo.id_cgo.value=id_cgo;
										document.tipo_cargo.nombre.value = vari.getElementsByTagName('nombre').item(0).firstChild.data; 
											var id_cto=vari.getElementsByTagName('id_cto').item(0).firstChild.data;//-1; 
													 for (i=0;i<document.tipo_cargo.centro_costo.options.length+1;i++) {
													   if(document.tipo_cargo.centro_costo.options[i].value==id_cto){
															document.tipo_cargo.centro_costo.options[i].selected=true;	
															break;
														}
													 } 
						        		document.tipo_cargo.nombre.focus();
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="id_cgo="+id_cgo+"&modulo=tipo_cargo";
         ajax.send(var_send);
  return;    
}
</script>
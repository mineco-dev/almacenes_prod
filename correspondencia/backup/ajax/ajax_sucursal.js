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
	        var nombre=document.sucursal.nombre.value;
	        var rut_suc=document.sucursal.rut_suc.value;
		    var eliminar = confirm("confirma eliminar: "+ nombre +" ?");
	    
	    if ( eliminar ) {
		  var ajax=nuevoAjax();

          var capaContenedora = document.getElementById('d');
          ajax.open ("POST","/modulos/mo_sucursales.php", true);
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
          var var_send="op1=delete"+"&rut_suc="+rut_suc;
          ajax.send(var_send);
		  nuevoDatos();
	    }
	  return; 
}        
function guardarDatos(){
 			var rut_suc=document.sucursal.rut_suc.value;
		c1=document.sucursal.rut.value;
		c2=document.sucursal.digito.value;
		c3=document.sucursal.nombre.value;
		c4=document.sucursal.direccion.value;
		c5=document.sucursal.sector.value;
			var lista1=document.getElementById('comuna')
		c6=lista1.value;
		c7=document.sucursal.telefono.value;
		c8=document.sucursal.representante.value;
	
		ajax=nuevoAjax();
		
		ajax.open("POST", "/modulos/mo_sucursales.php", true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			var var_send="rut_suc="+rut_suc+"&op1=insert&c1="+c1+"&c2="+c2+"&c3="+c3+"&c4="+c4+"&c5="+c5+"&c6="+c6+"&c7="+c7+"&c8="+c8;
		ajax.send(var_send);
		cargaContenido("sucursal","2");
		
		if(document.sucursal.rut_suc.value==''){	
	    	nuevoDatos();
	    }
}
function nuevoDatos(){
		document.sucursal.rut.disabled=false;
       	document.sucursal.digito.disabled=false;
       	
 	   document.sucursal.rut_suc.value=""
       document.sucursal.rut.value="";
       document.sucursal.digito.value="";
       document.sucursal.nombre.value="";
       document.sucursal.direccion.value="";
       document.sucursal.sector.value="";
       document.sucursal.telefono.value="";
       document.sucursal.representante.value="";
            var lista1=document.getElementById('comuna')
	        lista1.options[0].selected=true;
       document.sucursal.rut.focus();
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
 	if(document.sucursal.rut.value!='' && document.sucursal.rut_suc.value==''){
		rut_suc=document.sucursal.rut.value;		
	} else {
		 var lista_sucursal=document.getElementById('sucursales');
		 var rut_suc=lista_sucursal.value;
	 }
		var _rut=document.sucursal.rut.value;
		
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
				          		
				          		if(vari.getElementsByTagName('rut').item(0).firstChild.data!=0) {

   		 				          		document.sucursal.rut_suc.value=rut_suc;

					          			document.sucursal.rut.disabled=true;
								       	document.sucursal.digito.disabled=true;
									document.sucursal.rut.value = vari.getElementsByTagName('rut').item(0).firstChild.data; 
									document.sucursal.digito.value = vari.getElementsByTagName('digito').item(0).firstChild.data; 
									document.sucursal.nombre.value = vari.getElementsByTagName('nombre').item(0).firstChild.data; 
									document.sucursal.direccion.value = vari.getElementsByTagName('direccion').item(0).firstChild.data;
									document.sucursal.sector.value = vari.getElementsByTagName('sector').item(0).firstChild.data;  
									document.sucursal.telefono.value = vari.getElementsByTagName('telefono').item(0).firstChild.data; 
									document.sucursal.representante.value = vari.getElementsByTagName('representante').item(0).firstChild.data; 
										var id_cm=vari.getElementsByTagName('comuna').item(0).firstChild.data;//-1; 
												 for (i=0;i<document.sucursal.comuna.options.length+1;i++) {
												   if(document.sucursal.comuna.options[i].value==id_cm){
														document.sucursal.comuna.options[i].selected=true;	
														break;
													}
												 } 
					        		document.sucursal.nombre.focus();
				        		} else {
 				        		    document.sucursal.rut.value=_rut;
									document.sucursal.digito.focus();										
								}
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="rut_suc="+rut_suc+"&modulo=sucursales";
         ajax.send(var_send);
  return; 

}
</script>
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
	        var nombre=document.empresa.nombre.value;
	        var id_emp=document.empresa.id_emp.value;
		    var eliminar = confirm("confirma eliminar: "+ nombre +" ?");
	    
	    if ( eliminar ) {
			ajax=nuevoAjax();
			
			ajax.open("POST", "/modulos/mo_empresa.php", true);
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
				var var_send="op1=delete"+"&id_emp="+id_emp;
			
			ajax.send(var_send);
		    cargaContenido("empresa","2");
		    nuevoDatos();
	    }
}        
function guardarDatos(){
	 		var _id_emp=document.empresa.id_emp.value;
			var lista1=document.getElementById('comuna');
		_rut=document.empresa.rut.value;
		_digito=document.empresa.digito.value;
		_nombre=document.empresa.nombre.value;
		_giro=document.empresa.giro.value;
		_domicilio=document.empresa.domicilio.value;
		_sector=document.empresa.sector.value;
		_comuna=lista1.value;
		_telefono=document.empresa.telefono.value;
		_fax=document.empresa.fax.value;
		_representante1=document.empresa.representante1.value;
		_representante2=document.empresa.representante2.value;
		_cheque=document.empresa.cheque.value;
		_email=document.empresa.email.value;
		
		ajax=nuevoAjax();
		
		ajax.open("POST", "/modulos/mo_empresa.php", true);
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			var var_send="id_emp="+_id_emp+"&op1=insert&rut="+_rut+"&digito="+_digito+"&nombre="+_nombre+"&giro="+_giro+"&domicilio="+_domicilio+"&sector="+_sector+"&comuna="+_comuna+"&telefono="+_telefono+"&representante1="+_representante1+"&giro="+_giro+"&representante2="+_representante2+"&fax="+_fax+"&cheque="+_cheque+"&email="+_email;

		ajax.send(var_send);
		cargaContenido("empresa","2");
		if(document.empresa.id_emp.value==''){
		 	nuevoDatos();
		 }
}
function nuevoDatos(){
		document.empresa.rut.disabled=false;
		document.empresa.digito.disabled=false;

       document.empresa.id_emp.value=""
       document.empresa.rut.value="";
       document.empresa.digito.value="";
       document.empresa.nombre.value="";
       document.empresa.giro.value="";
       document.empresa.domicilio.value="";
       document.empresa.sector.value="";
            var lista1=document.getElementById('comuna')
	        lista1.options[0].selected=true;
       document.empresa.telefono.value="";
       document.empresa.fax.value="";
       document.empresa.representante1.value="";
       document.empresa.representante2.value="";
       document.empresa.cheque.value="";
       document.empresa.email.value="";
       document.empresa.rut.focus();
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

function leerDatos(tipo_busqueda){
 	if(tipo_busqueda==1) {
		rut_emp=document.empresa.rut.value;	
		id_emp='';	
	} else {
		 var lista_empresa=document.getElementById('empresas');
		 var id_emp=lista_empresa.value;
		 rut_emp='';
	}
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
				          		document.empresa.id_emp.value=id_emp;
				          		if(vari.getElementsByTagName('rut').item(0).firstChild.data==' '){
									document.empresa.digito.focus();
								} else {
					         		document.empresa.rut.value = vari.getElementsByTagName('rut').item(0).firstChild.data;
									    document.empresa.rut.disabled=true;
										document.empresa.digito.disabled=true;
					         		document.empresa.id_emp.value = vari.getElementsByTagName('id_emp').item(0).firstChild.data;
					         		
					          		document.empresa.digito.value = vari.getElementsByTagName('digito').item(0).firstChild.data;
					          		document.empresa.nombre.value = vari.getElementsByTagName('nombre').item(0).firstChild.data;
					          		document.empresa.giro.value = vari.getElementsByTagName('giro').item(0).firstChild.data;
									document.empresa.domicilio.value = vari.getElementsByTagName('domicilio').item(0).firstChild.data; 
									document.empresa.sector.value = vari.getElementsByTagName('sector').item(0).firstChild.data;
									
										var id_cm=vari.getElementsByTagName('comuna').item(0).firstChild.data;//-1; 
												 for (i=0;i<document.empresa.comuna.options.length+1;i++) {
												   if(document.empresa.comuna.options[i].value==id_cm){
														document.empresa.comuna.options[i].selected=true;	
														break;
													}
												 } 
									document.empresa.telefono.value = vari.getElementsByTagName('telefono').item(0).firstChild.data;
									document.empresa.fax.value = vari.getElementsByTagName('fax').item(0).firstChild.data;
									document.empresa.representante1.value = vari.getElementsByTagName('representante1').item(0).firstChild.data;
									document.empresa.representante2.value = vari.getElementsByTagName('representante2').item(0).firstChild.data;
									document.empresa.cheque.value = vari.getElementsByTagName('cheque').item(0).firstChild.data;
									document.empresa.email.value = vari.getElementsByTagName('email').item(0).firstChild.data;
	
					        		document.empresa.nombre.focus();
					        	}
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="id_emp="+id_emp+"&modulo=empresa&rut_emp="+rut_emp;
         ajax.send(var_send);
  return; 
}
</script>
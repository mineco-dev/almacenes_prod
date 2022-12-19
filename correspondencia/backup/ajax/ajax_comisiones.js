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
			
			ajax.open("POST", "/modulos/mo_comisiones.php", true);
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
				var var_send="op1=delete"+"&id_com="+document.comision.id_com.value;
			
			ajax.send(var_send);
		    cargaContenido("comision","1");
		    nuevoDatos();
	    }        
}        

function EsMenor(fecha1,fecha2){
Data1_arr = fecha1.split('/');
Data2_arr = fecha2.split('/');

if (parseInt(Data1_arr[2],10) > parseInt(Data2_arr[2],10)) return true; //año
if (parseInt(Data1_arr[1],10) > parseInt(Data2_arr[1],10)) return true; //mes
if (parseInt(Data1_arr[0],10) > parseInt(Data2_arr[0],10)) return true; //dia
return false;
}

function guardarDatos(){
 	var setFocus=1;
 	var error='';
 	
		rut_per=document.comision.rut_per.value;
		id_com=document.comision.id_com.value;
		porcentaje=document.comision.porcentaje.value;
		fh_ini=document.comision.fh_ini.value;
		fh_fin=document.comision.fh_fin.value;
		var id_fpr=document.getElementById('producto');
		
		if (porcentaje==''){
			error='porcentaje\n';
		}
		if (fh_ini==''){
			error=error+'fecha inicio\n';
		}
		if (fh_fin==''){
			error=error+'fecha termino\n';
		}
		if(isNaN(porcentaje)==true){
			error=error+'el porcentaje debe contener solo numeros\n';	
			
		}
		if(EsMenor(fh_ini,fh_fin)==true){
			error=error+"fecha inicio no puede ser mayor a fecha termino";
			setFocus=2;
		}
		//x=validar_fecha(fh_ini);
		//alert(x);
		//	fhi=date.parse(fh_ini);
		//	fhf=date.parse(fh_fin);
		//if (fhi>fhf){
		//	error=error+"fecha inicio no puede ser mayor a fecha termino";	
		//	setFocus=2;
		//}
		if(error==''){
			ajax=nuevoAjax();
			
			ajax.open("POST", "/modulos/mo_comisiones.php", true);
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
				var var_send="op1=insert&id_com="+id_com+"&rut_per="+rut_per+"&porcentaje="+porcentaje+"&fh_ini="+fh_ini+"&fh_fin="+fh_fin+"&id_fpr="+id_fpr.value;
	
			ajax.send(var_send);
			cargaContenido("comision","1");
		} else {
			alert('Debe ingresar los siguientes datos:\n\n'+error);
			 	if(setFocus==1){
				  document.comision.porcentaje.focus();
				 } else	{
					document.comision.fh_ini.focus();	
				}
		}
		return;
}

function nuevoDatos(tipo_nuevo){
   	   document.comision.fh_ini.value=""
       document.comision.fh_fin.value="";
       document.comision.porcentaje.value="";
       document.comision.id_com.value="";
       document.comision.porcentaje.focus();

   	 if(tipo_nuevo==1){
   	  	document.comision.rut_per.value="";
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
 	if(document.comision.rut_per.value==''){
 	 	alert('debe ingresar R.U.T. para realizar una busqueda');
 	 	document.comisiones.rut.focus();
 	} else {
		BuscarTrabajador();
	}
	return;
}

function buscar_persona(){
	var lista_comision=document.getElementById('buscar_personas');
	var rut=lista_comision.value;
	  var buscar = confirm("confirma busqueda ?");
	      if ( buscar ) {
	       	document.comision.rut_per.value=rut;
	       	 var tabla = document.getElementsByName('buscador');
		         tabla[0].style.display = 'none';
			 	 //--> cargaContenido('comision','1');	<--//
			 	 BuscarTrabajador();
		  } 
	return;
}

function filtro_nombres(tipo_filtro,fila){

	var parametro=document.comision.nombres.value	
 
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
function BuscarTrabajador(){
 		  var rut=document.comision.rut_per.value;
 		 
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
										document.comision.rut_per.focus();
									 } else  {
									  	document.getElementById('r').innerHTML=vari.getElementsByTagName('rut').item(0).firstChild.data;
									  	document.getElementById('e').innerHTML=vari.getElementsByTagName('nombre').item(0).firstChild.data;
									  	document.getElementById('f').innerHTML=vari.getElementsByTagName('telefono').item(0).firstChild.data;									  	
									  	var tabla = document.getElementsByName('buscador');
									        tabla[0].style.display = 'none';
										cargaContenido('comision','1');
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

function cargaContenido(consulta,fila){ 
 		var rut=document.comision.rut_per.value;
	    
		var ajax=nuevoAjax();
	   
          var capaContenedora = document.getElementById(fila);
          ajax.open ("POST","/modulos/selected.php", true);
          ajax.onreadystatechange = function() {
		         if (ajax.readyState==1) {
		                          capaContenedora.innerHTML="Cargando.......";
		         } else if (ajax.readyState==4){
		                   if(ajax.status==200){
		                        document.getElementById(fila).innerHTML=ajax.responseText;
		                        if(document.comision.rut_per.value==''){					
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
		 var lista_comision=document.getElementById('comisiones');
	 	 document.comision.id_com.value=lista_comision.value;

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
						         		document.comision.porcentaje.value = vari.getElementsByTagName('porcentaje').item(0).firstChild.data;
						         		document.comision.fh_ini.value = vari.getElementsByTagName('fh_ini').item(0).firstChild.data;
						         		document.comision.fh_fin.value = vari.getElementsByTagName('fh_fin').item(0).firstChild.data;
						         		var id_fpr = vari.getElementsByTagName('id_fpr').item(0).firstChild.data;
									    for (i=0;i<document.comision.producto.options.length+1;i++) {
										   if(document.comision.producto.options[i].value==id_fpr){
												document.comision.producto.options[i].selected=true;	
												break;
											}
										 } 
					        		document.comision.porcentaje.focus();
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="id_com="+lista_comision.value+"&modulo=comision";
         ajax.send(var_send);
  return; 
}
</script>
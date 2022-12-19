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
function tipo_contrato(){
	var id_tco=document.getElementById('contrato');
		if(id_tco.options[id_tco.value].text=='INDEFINIDO')	{
			document.empleado.fh_fin.disabled=true;
			document.empleado.f_fin.style.display='none'
			
		}
return;	
}
function recarga(){
 cargaContenido("empleado","5");
return;	
}

function EsMenor(fecha1,fecha2){
Data1_arr = fecha1.split('/');
Data2_arr = fecha2.split('/');

if (parseInt(Data1_arr[2],10) > parseInt(Data2_arr[2],10)) return true; //año
if (parseInt(Data1_arr[1],10) > parseInt(Data2_arr[1],10)) return true; //mes
if (parseInt(Data1_arr[0],10) > parseInt(Data2_arr[0],10)) return true; //dia
return false;
}

function eliminarDatos(){
	        var nombres=document.empleado.nombres.value+' '+document.empleado.apellidos.value;
	        var rut_per=document.empleado.rut_per.value;
		    var eliminar = confirm("confirma eliminar: "+ nombres +" ?");
	    
	    if ( eliminar ) {
			ajax=nuevoAjax();
			
			ajax.open("POST", "/modulos/mo_empleado.php", true);
			ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
				var var_send="op1=delete"+"&rut_per="+rut_per;
			
			ajax.send(var_send);
		    cargaContenido("empleado","5");
		    nuevoDatos();
	    }
}        
function guardarDatos(){
 	setFocus=1;
	 error='';
	if(document.empleado.nombres.value=='' || document.empleado.apellidos.value==''){
		error=error+'Nombres y Apellidos\n';	
	}
 	
	if(document.empleado.fecha_nacimiento.value==''){
		error=error+'Fecha nacimiento\n';
	}

	if(document.empleado.domicilio.value=='' || document.empleado.sector.value==''){
		error=error+'Dirección y Sector\n';
	}
	
	if(EsMenor(document.empleado.fh_ini.value,document.empleado.fh_fin.value)==true){
			error=error+"fecha inicio no puede ser mayor a fecha termino";
			setFocus=2;
	}
	
	if(document.empleado.fh_ini.value=='' || document.empleado.fh_fin.value==''){
		error=error+'Fecha inicio y Fecha termino\n';
	}
		
	if(error!=''){
		alert('Debe verificar o ingresar los siguientes datos:\n\n'+error);	
	} else {
	
	 		var _rut_per=document.empleado.rut_per.value;
		_rut=document.empleado.rut.value;
		_digito=document.empleado.digito.value;
		_nombres=document.empleado.nombres.value;
		_apellidos=document.empleado.apellidos.value;
		_domicilio=document.empleado.domicilio.value;	
		_sector=document.empleado.sector.value;
		_telefono=document.empleado.telefono.value;		
		_profesion=document.empleado.profesion.value;		
		_nro_cuenta=document.empleado.cuenta_vista.value;		
		_fh_nacimiento=document.empleado.fecha_nacimiento.value;		
		_horario=document.empleado.horario_trabajo.value;

				var _id_cm=document.getElementById('comuna');
				var _id_sex=document.getElementById('sexo');
				var _id_ecv=document.getElementById('estado_civil');
				var _id_ps=document.getElementById('nacionalidad');

		// --------- Antecedentes laborales -------------------- //
				var id_emp=document.getElementById('empresa');
				var id_suc=document.getElementById('sucursal');
				var id_cto=document.getElementById('centro');
				var id_cgo=document.getElementById('cargo');
				var id_tsu=document.getElementById('sueldo');
				var sb=document.empleado.base.value;
				var id_tcf=document.getElementById('carga');
				var ncf=document.empleado.familiares.value;
				var mc=document.empleado.colacion.value;
				var mv=document.empleado.movilizacion.value;
				var id_afp=document.getElementById('afp');
				var id_fpa=document.getElementById('forma');
					for (i=0;i<document.empleado.seguro.length;i++){
						if (document.empleado.seguro[i].checked==true)
							var seguro=i;			
					}

				var id_tco=document.getElementById('contrato');
				var id_sal=document.getElementById('salud');
				var fhi=document.empleado.fh_ini.value;
				var fhf=document.empleado.fh_fin.value;
				var id_cah=document.getElementById('ch');

		// --------- Fin antecedentes laborales --------------- //	

		ajax=nuevoAjax();
		
		ajax.open("POST", "/modulos/mo_empleado.php", true);
	
		ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			var var_send="rut_per="+_rut_per+"&op1=insert&rut="+_rut+"&digito="+_digito+"&nombres="+_nombres+"&apellidos="+_apellidos+"&domicilio="+_domicilio+"&sector="+_sector+"&telefono="+_telefono+"&profesion="+_profesion+"&nro_cuenta="+_nro_cuenta+"&fh_nacimiento="+_fh_nacimiento+"&horario="+_horario+"&id_cm="+_id_cm.value+"&id_sex="+_id_sex.value+"&id_ecv="+_id_ecv.value+"&id_ps="+_id_ps.value+"&id_emp="+id_emp.value;
			    var_send=var_send+"&id_suc="+id_suc.value+"&id_cto="+id_cto.value+"&id_cgo="+id_cgo.value+"&id_tsu="+id_tsu.value;
			    var_send=var_send+"&sb="+sb+"&id_tcf="+id_tcf.value+"&ncf="+ncf+"&mc="+mc+"&mv="+mv;
			    var_send=var_send+"&id_afp="+id_afp.value+"&id_sal="+id_sal.value+"&id_fpa="+id_fpa.value+"&seguro="+seguro;
			    var_send=var_send+"&id_tco="+id_tco.value+"&fhi="+fhi+"&fhf="+fhf+"&id_cah="+id_cah.value;

		ajax.send(var_send);
		
		cargaContenido("empleado","5");
		
		if(document.empleado.rut_per.value==''){
		 	nuevoDatos();
		}
	}
}
function nuevoDatos(){
       document.empleado.rut.value="";
       document.empleado.rut_per.value="";       
       
       document.empleado.digito.value="";
       	document.empleado.rut.disabled=false;
       	document.empleado.digito.disabled=false;
       document.empleado.nombres.value="";
       document.empleado.apellidos.value="";      
       document.empleado.domicilio.value="";
       document.empleado.sector.value="";
       document.empleado.telefono.value="";
       document.empleado.fecha_nacimiento.value="";
       document.empleado.horario_trabajo.value="";      
       document.empleado.profesion.value="";
       document.empleado.cuenta_vista.value="";
       
	       	var _sexo=document.getElementById('sexo');
	       	var _estado_civil=document.getElementById('estado_civil');
	       	
	       				for (i=0;i<document.empleado.comuna.options.length+1;i++) {
							   if(document.empleado.comuna.options[i].value==8001){
									document.empleado.comuna.options[i].selected=true;	
									break;
								}
							 } 
			_sexo.options[1].selected=true;
			_estado_civil.options[2].selected=true;
			
	       				for (i=0;i<document.empleado.nacionalidad.options.length+1;i++) {
							   if(document.empleado.nacionalidad.options[i].value==1){
									document.empleado.nacionalidad.options[i].selected=true;	
									break;
								}
							 }
							
			var _contrato=document.getElementById('contrato');				
			    _contrato.options[0].selected=true;

	   document.empleado.base.value="";					
  	   document.empleado.familiares.value=""; 
  	   document.empleado.colacion.value="";
  	   document.empleado.movilizacion.value="";
  	   document.empleado.fh_ini.value="";
  	   document.empleado.fh_fin.value="";
  	   document.empleado.seguro[0].checked=true;
  	   
  	   		document.empleado.fh_fin.disabled=false;
			document.empleado.f_fin.style.display=''

       document.empleado.rut.focus();
}

function cargaContenido(consulta,fila){
	var parametro=document.empleado.filtro_nombres.value	

 	for (i=0;i<document.empleado.filtra.length;i++){
						if (document.empleado.filtra[i].checked==true)
							var tipo_filtro=i;			
					}
 	if (tipo_filtro==0){ 
	  nlike='nombre'; 
	} else {
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
function seekRut(){
		document.empleado.rut_per.value=document.empleado.rut.value;
		buscar_persona(0);	
	return;
}

function buscar_persona(var_tipo_seek){
 		 if(var_tipo_seek==1){
	 		  var lista_empleado=document.getElementById('buscar_personas');
		 	  var rut_per=lista_empleado.value;
	 	 } else {
			rut_per=document.empleado.rut_per.value;
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
          		
			          		if(vari.getElementsByTagName('rut').item(0).firstChild.data!=0){
									 document.empleado.rut_per.value=vari.getElementsByTagName('rut').item(0).firstChild.data;
					
					         		document.empleado.rut.value = vari.getElementsByTagName('rut').item(0).firstChild.data;
					          		document.empleado.digito.value = vari.getElementsByTagName('digito').item(0).firstChild.data;
					          		document.empleado.nombres.value = vari.getElementsByTagName('nombres').item(0).firstChild.data;
					          		document.empleado.apellidos.value = vari.getElementsByTagName('apellidos').item(0).firstChild.data;
									document.empleado.domicilio.value = vari.getElementsByTagName('domicilio').item(0).firstChild.data; 
									document.empleado.sector.value = vari.getElementsByTagName('sector').item(0).firstChild.data;
									document.empleado.telefono.value = vari.getElementsByTagName('telefono').item(0).firstChild.data;
									document.empleado.fecha_nacimiento.value = vari.getElementsByTagName('fh_nacimiento').item(0).firstChild.data;
									document.empleado.horario_trabajo.value = vari.getElementsByTagName('horario').item(0).firstChild.data;
									document.empleado.profesion.value = vari.getElementsByTagName('profesion').item(0).firstChild.data;
									document.empleado.cuenta_vista.value = vari.getElementsByTagName('nro_cuenta_vista').item(0).firstChild.data;
									
									var id_cm=vari.getElementsByTagName('id_cm').item(0).firstChild.data;//-1; 
												 for (i=0;i<document.empleado.comuna.options.length+1;i++) {
												   if(document.empleado.comuna.options[i].value==id_cm){
														document.empleado.comuna.options[i].selected=true;	
														break;
													}
												 } 
									var id_sex=vari.getElementsByTagName('id_sex').item(0).firstChild.data;//-1; 
												 for (i=0;i<document.empleado.sexo.options.length+1;i++) {
												   if(document.empleado.sexo.options[i].value==id_sex){
														document.empleado.sexo.options[i].selected=true;	
														break;
													}
												 } 
									var id_ecv=vari.getElementsByTagName('id_ecv').item(0).firstChild.data;//-1; 
												 for (i=0;i<document.empleado.estado_civil.options.length+1;i++) {
												   if(document.empleado.estado_civil.options[i].value==id_ecv){
														document.empleado.estado_civil.options[i].selected=true;	
														break;
													}
												 } 
									var id_ps=vari.getElementsByTagName('id_ps').item(0).firstChild.data;//-1; 
												 for (i=0;i<document.empleado.nacionalidad.options.length+1;i++) {
												   if(document.empleado.nacionalidad.options[i].value==id_ps){
														document.empleado.nacionalidad.options[i].selected=true;	
														break;
													}
												 } 
									document.empleado.rut.disabled=true;
									document.empleado.digito.disabled=true;
									
									// -------- antecedentes laborales ------------ //
								    document.empleado.fh_ini.value = vari.getElementsByTagName('fh_ini').item(0).firstChild.data;
								    document.empleado.fh_fin.value = vari.getElementsByTagName('fh_fin').item(0).firstChild.data;				
								    document.empleado.nombres.focus();
							} else {
							 		document.empleado.rut.value=document.empleado.rut_per.value;
									document.empleado.rut_per.value="";
									document.empleado.digito.focus();
							}
		                   }else if(ajax.status==404){
		                          capaContenedora.innerHTML = "error de carga de formulario";
		                  } else {
		                            capaContenedora.innerHTML = "Error: ".ajax.status;
		                           }
				 }
           }
         ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
         var var_send="rut_per="+rut_per+"&modulo=empleado";
         ajax.send(var_send);
  return;
}
</script>
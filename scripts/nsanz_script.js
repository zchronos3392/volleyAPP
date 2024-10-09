// JavaScript Document PARA EL banner que crece automaticamente...
		// cuando PRESIONO CLICK , LO ACTUALIZO


$(document).ready(function(){
    // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo



         $("#iclub").empty();
         $("#icity").empty();
         $("#inumeros").empty();
         $("#icate").empty();
         $("#isede").empty();
        var iclubes = $("#iclub");
        var icity   = $("#icity");
        var icate   = $("#icate");
		var isede   = $("#isede");        
        // esto arreglo el tema del alta triplle..
		$("#AltaCiudad").off('click');
    	$("#btnIngreso").off('click'); 
    	$("#INGRESOcancha").off('click');    	    
        $("#AltaCategoria").off('click');
		$("#btnSedes").off('click');        
        //	data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
        //	el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
         //sin embargo la direccion final queda: http://localhost/volleyAPP/equipos.php?abms/obtener_clubes.php
         // y eso esta mal !!

         $.ajax({ 
            url:   './abms/obtener_clubes.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#iclub").prop('disabled', true);
    			//$("#icity").prop('disabled', true);
    		},
            done: function(data){
            	console.log('DONE: ');
				console.log(data);	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
                		//TUVE QUE AGREGARLE, QUE NO EXISTA EL ELEMENTO, PORQUE SE ESTA
                		// TRIPLICANDO UN EVENTO QUE NO PUDE ENCONTRAR Y CARGABA TODOS LOS DATOS TRES VECESSS
                	if (! $('#iclub').find("option[value='" + v.idclub + "']").length)
                	{						
    					$("#iclub").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
					}		
                });
                $("#iclub").prop('disabled', false);
                //$("#icity").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#iclub").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#iclub").val('9999');
				console.log(xhr.responseText);
				console.log(thrownError);
				$("#iclub").prop('disabled', false);
			}
            }); // FIN funcion ajax CLUBES
            
//----------------------------
//OBTIENE CIUDADES
//----------------------------
         $.ajax({ 
            url:   './abms/obtener_ciudades.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#icity").prop('disabled', true);
    			//$("#iclub").prop('disabled', true);
            },
            done: function(data){
            	console.log('DONE: ');
				console.log(data);	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['Ciudades']).each(function(i, v)
                { // indice, valor
                	
                    if (! $('#icity').find("option[value='" + v.idCiudad + "']").length)
                	{		
                    $("#icity").append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
					}
                });
                $("#icity").prop('disabled', false);
                //$("#iclub").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#icity").append('<option value="' + '9999' + '">' + 'JQERY:Tabla Ciudades vacia' + '</option>');
			$("#icity").val('9999');
				console.log(xhr.responseText);
				console.log(thrownError);
				$("#icity").prop('disabled', false);
			}
            }); // FIN funcion ajax para CIUDADES
//----------------------------
//OBTIENE CIUDADES
//----------------------------

//----------------------------
//OBTIENE CIUDADES 2
//----------------------------
         $.ajax({
				url:   './abms/obtener_ciudades.php',
				type:  'GET',
				dataType: 'json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX
				beforeSend: function () {
					// Bloqueamos el SELECT de los cursos
					$("#icity2").prop('disabled', true);

				},
				done: function(data) {
					console.log('DONE: ');
					console.log(data);
				},
				success:  function (r) {
					// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
					// DESBloqueamos el SELECT de los cursos
					// Limpiamos el select
					// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"]
					$(r['Ciudades']).each(function(i, v) { // indice, valor

						if (! $('#icity2').find("option[value='" + v.idCiudad + "']").length) {
							$("#icity2").append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
						}
					});
					$("#icity2").prop('disabled', false);

				},
				error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					$("#icity2").append('<option value="' + '9999' + '">' + 'JQERY:Tabla Ciudades vacia' + '</option>');
					$("#icity2").val('9999');
					console.log(xhr.responseText);
					console.log(thrownError);
					$("#icity2").prop('disabled', false);
				}
			}); // FIN funcion ajax para CIUDADES 2 PARA RESPONSIVO
//----------------------------
//OBTIENE CIUDADES 2
//----------------------------


/**************************************numeros / usuario ********************************/
    $.ajax({
	url:   './abms/obtener_numeros2.php',
	type:  'GET',
	dataType: 'json',
	// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX
	beforeSend: function () {
		// Bloqueamos el SELECT de los cursos
		$("#inumeros").prop('disabled', true);
	},
	done: function(data) {
		console.log('DONE: ');
		console.log(data);
	},
	success:  function (r) {
		// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
		// DESBloqueamos el SELECT de los cursos
		// Limpiamos el select
		// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"]
		$(r['Numeros']).each(function(i, v) { // indice, valor

		if (! $('#inumeros').find("option[value='" + v.ultnumero + "']").length) {
			$("#inumeros").append('<option value="' + v.ultnumero + '">' + v.TABLA + '</option>');
			}
		});
		$("#inumeros").prop('disabled', false);
	},
	error: function (xhr, ajaxOptions, thrownError) {
		// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
		$("#inumeros").append('<option value="' + '9999' + '">' + 'JQERY:Tabla Numeros vacia' + '</option>');
		$("#inumeros").val('9999');
		console.log(xhr.responseText);
		console.log(thrownError);
		$("#inumeros").prop('disabled', false);
	}
}); // FIN funcion ajax para numeros


/**************************************numeros / usuario ********************************/	

//************************ CATEGORIAS *************************************************         
         $.ajax({ 
            url:   './abms/obtener_categorias.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#iclub").prop('disabled', true);
    			$("#icity").prop('disabled', true);
    			$("#icate").prop('disabled', true);
    		},
            done: function(data){
					console.log(data);	
			},
            success:  function (r){
            	$(r['Categorias']).each(function(i, v)
                { // indice, valor
                	if (! $('#icate').find("option[value='" + v.idcategoria + "']").length)
                	{
                		if(v.categoriaActiva==1)
							$("#icate").append('<option value="' + v.idcategoria + '">(A) ' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
						else
							$("#icate").append('<option value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
					}		
                });
                $("#iclub").prop('disabled', false);
                $("#icate").prop('disabled', false);
                $("#icity").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#icate").append('<option value="' + '9999' + '">' + 'JQERY:Tabla CATEGORIAS vacia' + '</option>');
			$("#icate").val('9999');
				//console.log(xhr.responseText);
				//console.log(thrownError);
				$("#icate").prop('disabled', false);
			}
            }); // FIN funcion ajax categorias
//************************** SEDES ***************************************************
         $.ajax({ 
            url:   './abms/obtener_sedes.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#isede").prop('disabled', true);
    		},
            done: function(data){
            	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['Sedes']).each(function(i, v)
                { // indice, valor
              	if (! $('#isede').find("option[value='" + v.idsede + "']").length)
                	{
						$("#isede").append('<option value="' + v.idsede + '">' + v.direccion + '</option>');
					}		
                });
                $("#isede").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#isede").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#isede").val('9999');
				console.log(xhr.responseText);
				console.log(thrownError);
				$("#isede").prop('disabled', false);
			}
            }); // FIN funcion ajax SEDES
            
//**************** SEDES *********************************************/
            
//**************** COMPETENCIAS *********************************************/            
         $.ajax({ 
            url:   './abms/obtener_comps.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#icomp").prop('disabled', true);
    		},
            done: function(data){
            	console.log('DONE: ');
				console.log(data);	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['Competencias']).each(function(i, v)
                { // indice, valor
						//TUVE QUE AGREGARLE, QUE NO EXISTA EL ELEMENTO, PORQUE SE ESTA
                		// TRIPLICANDO UN EVENTO QUE NO PUDE ENCONTRAR Y CARGABA TODOS LOS DATOS TRES VECESSS
                	if (! $('#icomp').find("option[value='" + v.idcomp + "']").length)
                	{
						$("#icomp").append('<option value="' + v.idcomp + '">' + v.cnombre + '</option>');
					}		
                });
                $("#icomp").prop('disabled', false);
           },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#icomp").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#icomp").val('9999');
				console.log(xhr.responseText);
				console.log(thrownError);
				$("#iclub").prop('disabled', false);
			}
            }); // FIN funcion ajax COMPETENCIAS
            

                                    
 	// CARGAMOS EL BOTON INGRESO Y SUS FUNCIONES
 	// de CADA POSIBLE FORMULARIO QUE HAY...
//**************** CLUBES *********************************************/            
$("#btnIngreso").click(function(){ 
    //INGRESO DE NUEVO CLUB.
    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	//alert('Submit activado');
        // Guardamos el select de cursos
        if( ($("#nombre").val() != '') &&  ($("#clubabr").val() != '') )
        {
        // el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
        //data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
		var parametros = {
        	"nombre" : $("#nombre").val(),
        	"ciudad" : $("#iciudadclub").val(),
        	"clubabr" : $("#clubabr").val(),
        	"escudo"  : $("#iescudosclub").val()
	};		         
         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_club.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#iclub").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			$("#iclub").prop('disabled', false);
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$("#iclub").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
        } // else THIS.VAL <> ''
        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
        {
        }
    }); // parentesis el .CLICK BTNINGRESO
//**************** CIUDADES *********************************************/            

//**************** COMPETENCIAS *********************************************/            
$("#formConfig").on('submit', function(e){
	    //e.preventDefault();
    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	//alert('Submit activado');
        // Guardamos el select de cursos
        //obtengo el file y el check
			var competenciaActiva = 0;
			if ($("#SetActivo").is(":checked")) {
				// it is checked
					competenciaActiva = 1;
			};
		//var myFile ='';
//		var myFile = $('#miLogo').prop('files');
		//$('#miLogo').prop('files', myFile );        
        //obtengo el file y el check
        if( ($("#nombre").val() != '')  )
        {
        // el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
        //data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
/*
		var parametros = {
        	"nombre" : $("#nombre").val(),
        	"setnmax": $("#SetMaxCate").val(),
        	"archivoLogo": myFile,
        	"CompetenciaActiva": competenciaActiva
	};		         
*/
         
         $.ajax({ //el signo de pregunta apunta a la 
         			//direccion url base que es donde corre equipos.php
            url:   './abms/insertar_competencia.php',
            type:  'POST',
	            data: new FormData(this),
	            contentType: false,
	            cache: false,
	            processData:false,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#icomp").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			$("#icomp").prop('disabled', false);
    			
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$("#icomp").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
        } // else THIS.VAL <> ''
        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
        {
        }
}); // parentesis el .CLICK AltaComp
//**************** COMPETENCIAS *********************************************/            

$("#AltaCiudad").click(function(){ 
    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	//alert('Submit activado');
        // Guardamos el select de cursos
        if( ($("#ciudad").val() != '') &&  ($("#provCity").val() != '') )
        {
        // el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
        //data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
		var parametros = {
        	"ciudad" : $("#ciudad").val(),
        	"provincia" : $("#provCity").val()
	};		         
         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_ciudad.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#icity").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			$("#icity").prop('disabled', false);
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$("#icity").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
        } // else THIS.VAL <> ''
        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
        {
        }
}); // parentesis el .CLICK altaciudad
           
//******************************** alta numeros **************************************************/
$("#AltaNumeros").click(function() {
	//QUE SE RECARGUE CUANDO PRESIONO CLICK..
	//alert('Submit activado');
	// Guardamos el select de cursos
	if ( ($("#tabla").val() != '') &&  ($("#numclave").val() != '') ) {
		// el otro, activado en CLICK, envia a otro script el valor de los campos cargados..
		//data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
		var parametros = {
			"tabla" : $("#tabla").val(),
			"clave" : $("#numclave").val()
		};

		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
			url:   './abms/insertar_numero.php',
			type:  'POST',
			data: parametros,
			beforeSend: function () {
				// Bloqueamos el SELECT de los cursos
				$("#inumeros").prop('disabled', true);
			},

			success:  function (r) {
				// DESBloqueamos el SELECT de los cursos
				$("#numeros").prop('disabled', false);
			},
			//error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
				// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$("#inumeros").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
			}
		}); // FIN funcion ajax
	} // else THIS.VAL <> ''
	else
		// SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
	{
	}
}); // parentesis el .CLICK altanumeros


 /******************************** alta numeros **************************************************/           
           
$("#AltaCategoria").click(function(e){ 
    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
		//e.preventDefault();
    	//alert('Submit activado');
        // Guardamos el select de cursos
        if( ($("#categoria").val() != '') &&  ($("#edadi").val() != '') &&  ($("#edadf").val() != '') )
        {
        // el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
        //data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
			var activar =0;
			if ($("#activar").is(":checked")) {
				// it is checked
				activar = 1;
			};

		var parametros = {
        	"categoria" : $("#categoria").val(),
        	"edadi" : $("#edadi").val(),
        	"edadf" : $("#edadf").val(),
        	"setM"  : $("#setM").val(),
        	"activas" : activar
	};		         
         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_categoria.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#icate").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			$("#icate").prop('disabled', false);
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$("#icate").append('<option value="9998">' + 'SUBMIT:: Error en el servidor Tabla Categorias..</option>');
            }
            }); // FIN funcion ajax
        } // else THIS.VAL <> ''
        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
        {
        }
    }); // parentesis el .CLICK AltaCategoria
    
//**************** SEDES *********************************************/            
$("#btnSedes").click(function(){ 
    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	//alert('Submit activado');
        // Guardamos el select de cursos
        if( ($("#sedenom").val() != '') &&  ($("#direccion").val() != '')  )
        {
        // el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
        //data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
		var parametros = {
        	"sedenom" : $("#sedenom").val(),
        	"direxsede" : $("#direxsede").val(),
        	"iclub" : $("#iclub").val()
	};		         
         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_sede.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#isede").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			$("#isede").prop('disabled', false);
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				$("#isede").append('<option value="9998">' + 'SUBMIT:: Error en el servidor Tabla Sedes..</option>');
            }
            }); // FIN funcion ajax
        } // else THIS.VAL <> ''
        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
        {
        }
    }); // parentesis el .CLICK BtnSedes    
   
//**************** PARTIDOS *********************************************/            

$("#altap").click(function(){ 
    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	//alert('Submit activado');
        // Guardamos el select de cursos
//        if( ($("#nombre").val() != '')  )
//        {
  		var parametros = {
        	"fechap" : $("#fechap").val(),
			"icate" : $("#icate").val(),        	
			"iclub" : $("#iclub").val(),
			"iclubb" : $("#iclubb").val(),
			"isede" : $("#isede").val(),
			"icomp" : $("#icomp").val(),
			"icity" : $("#icity").val(),
			"horai" : $("#horai").val(),
	         };		         
         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_partido.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', true);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			//$("#icomp").prop('disabled', false);
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#icomp").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
            }); // FIN funcion ajax
//        } // else THIS.VAL <> ''
//        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
//        {
//        }
}); // parentesis el .CLICK ALTAP
//**************** PARTIDPS *********************************************/      

//**************** busqueda clubes con jquery *********************************************/      

//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA ******************************/   
$("#itextbuscar").keyup(function()
	//	on("keyup keydown",function()
         {   
			var parametros = {
	        	"llamador" : "CONTROLAPP",
	        	"funcion" : "buscarclub",			
	        	"filtro" : $("#itextbuscar").val(),
				};		         
		
         $.ajax({ 
            url:   './abms/obtener_varios.php',
            type:  'GET',
            data: parametros,
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
				$("#iclub").empty();
				$("#iclubb").empty();
    		},
            done: function(data){
			},
            success:  function (r){
 					
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
              	if (! $('#iclub').find("option[value='" + v.idclub + "']").length)
                	{
						$("#iclub").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre +'/'+v.ciudadnombre+'</option>');
					}		
                });
             },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			 console.log(xhr);
			 console.log(thrownError);
			}
            }); // FIN funcion ajax CANCIONES todas:
       });

//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 

$("#btnBuscarClub").click(function(){ 
        var textoSearch =	$("#itext").val().toUpperCase();
 //               $("#iclub option:contains("+textoSearch+")").attr('selected', true).css({"font-size":"40px","color":"red"});
                //$("#iclub option:contains("+textoSearch+")").attr('selected', true).css({"font-size":"40px","color":"red"});
        if(textoSearch != ''){
		$("#iclub option:contains("+textoSearch+")").each(function(){
    			$(this).attr('selected', true).css({"font-size":"40px","color":"red"});
				//else $(this).attr('selected', true).css('');
		});
		} else
		$("#iclub option:contains("+textoSearch+")").each(function(){
    			$(this).attr('selected', true).css("");
		});
		return false;
}); // parentesis el .CLICK buscar club
//**************** PARTIDPS *********************************************/ 

	// stopwatchjquery

    var tiempo = {
        hora: 0,
        minuto: 0,
        segundo: 0
    };

    var tiempo_corriendo = null;

    $("#inistopp").click(function(){
        if ( $(this).text() == 'Jugar' )
        {
            $(this).text('Tiempo');                        
            tiempo_corriendo = setInterval(function(){
                // Segundos
                tiempo.segundo++;
                if(tiempo.segundo >= 60)
                {
                    tiempo.segundo = 0;
                    tiempo.minuto++;
                }      

                // Minutos
                if(tiempo.minuto >= 60)
                {
                    tiempo.minuto = 0;
                    tiempo.hora++;
                }

				var tiempoTxtHora = tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora;
				var tiempoTxtMin  = tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto;
				var tiempoTxtSeg  = tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo;
		
				var tiempoTxt = tiempoTxtHora +':' + tiempoTxtMin +':' + tiempoTxtSeg ;
				
				$("#stopwatch").text(tiempoTxt);

			}, 10);
        }
        else 
        {
            $(this).text('Jugar');
            clearInterval(tiempo_corriendo);
        }
    });
    
	$("#resetp").click(function(){

    	tiempo.hora = 0;
        tiempo.minuto = 0;
        tiempo.segundo = 0;
		
		var tiempoTxtHora = tiempo.hora < 10 ? '0' + tiempo.hora : tiempo.hora;
		var tiempoTxtMin  = tiempo.minuto < 10 ? '0' + tiempo.minuto : tiempo.minuto;
		var tiempoTxtSeg  = tiempo.segundo < 10 ? '0' + tiempo.segundo : tiempo.segundo;
		
		var tiempoTxt = tiempoTxtHora +':' + tiempoTxtMin +':' + tiempoTxtSeg ;
		$("#stopwatch").text(tiempoTxt);

    });
	//	getFiltros();
	// stopwatchjquery
}); // parentesis del READY



    

// JavaScript Document PARA EL banner que crece automaticamente...
		// cuando PRESIONO CLICK , LO ACTUALIZO

$(document).ready(function(){
    // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
         $("#iclub").empty();
         $("#icity").empty();
         $("#icate").empty();
         $("#isedes").empty();
         $("#iclubb").empty();

		$("#horai").on("focus",function()
		{
			//alert('recfibi el focus..');	
			var dt = new Date();
	//		var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
		    var tiempo = {
		        hora: dt.getHours(),
		        minuto: dt.getMinutes(),
		        segundo: dt.getSeconds()
		    };

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
			
				var tiempoTxt = tiempoTxtHora +':' + tiempoTxtMin ; //+':' + tiempoTxtSeg 
					
			   $("#horai").val(tiempoTxt);

		});					
			
		

         
        var iclubes = $("#iclub");
        var iclubeB = $("#iclubb");
        var icity   = $("#icity");
        var icate   = $("#icate");
		var isede   = $("#isede");        
        // esto arreglo el tema del alta triplle..
		$("#altap").off('click');
    	//	data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
        //	el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
         //sin embargo la direccion final queda: http://localhost/volleyAPP/equipos.php?abms/obtener_clubes.php
         // y eso esta mal !!
		/*
		var parametros =  {"CPartido" : "N"};
         $.ajax({ 
            url:   './abms/obtener_clubes.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#iclub").prop('disabled', true);
    			$("#icity").prop('disabled', true);
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
						$("#iclub").append('<option value="' + v.idclub + '">'+v.clubabr+'-'+  v.nombre + '</option>');
					}		
                });
                $("#iclub").prop('disabled', false);
                $("#icity").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#iclub").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#iclub").val('9999');
				//console.log(xhr.responseText);
				//console.log(thrownError);
				$("#iclub").prop('disabled', false);
			}
            }); // FIN funcion ajax CLUBES
            */
         $.ajax({ 
            url:   './abms/obtener_ciudades.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#icity").prop('disabled', true);
    			$("#iclub").prop('disabled', true);
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
                $("#iclub").prop('disabled', false);
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
    	/*
    	  var parametros =  {"CPartido" : "S"};  
         $.ajax({ 
            url:   './abms/obtener_clubes.php',
            type:  'GET',
            dataType: 'json',
            data:parametros,
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			$("#iclubb").prop('disabled', true);
    		},
            done: function(data){
            	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
                $(r['Clubs']).each(function(i, v)
                { // indice, valor
              	if (! $('#iclubb').find("option[value='" + v.idclub + "']").length)
                	{
						$("#iclubb").append('<option value="' + v.idclub + '">'+v.clubabr+'-'+ v.nombre + '</option>');
					}		
                });
                $("#iclubb").prop('disabled', false);
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#iclubb").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#iclubb").val('9999');
				console.log(xhr.responseText);
				console.log(thrownError);
				$("#iclubb").prop('disabled', false);
			}
            }); // FIN funcion ajax CLUBES            
            */
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
            }); // FIN funcion ajax CLUBES
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

$("#altap").click(function(){ 


    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	//alert('Submit activado');
        // Guardamos el select de cursos
        if( ($("#fechap").val() != '') && ($("#horai").val() != '')  )
        {
        // el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
        
        
        //data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
		var parametros = {
        	"fechap" : $("#fechap").val(),
        	"icate" : $("#icate").val(),
        	"iclub" : $("#iclub").val(),
        	"iclubb" : $("#iclubb").val(),
        	"icancha" : $("#icancha").val(),
        	"icomp" : $("#icomp").val(),
        	"icity" : $("#icity").val(),
        	"horai" : $("#horai").val(),
        	"SetMaxCat" : $("#SetMaxCat").val(),
        	"SetMaxComp" : $("#SetMaxComp").val(),
			"valtbset":$("#valtbset").val(),
			"valfinset":$("#valfinset").val(),
			"descripcionp":$("#dscp").val(),
			"ianio":$("#ianio").val()

	};		         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_partido.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#isede").prop('disabled', true);
    			//console.log(parametros);
            },
            
            success:  function (r){
               	// DESBloqueamos el SELECT de los cursos
    			//$("#isede").prop('disabled', false);
    				alert('Partido ingresado');
    				//console.log(r);
    				// esta linea aca y luego en Cpartidos.php frenan el submit 
								// window.location='AdministrarAPP.php';
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#isede").append('<option value="9998">' + 'SUBMIT:: Error en el servidor Tabla Sedes..</option>');
            	console.log("errorrrr");
            }
            }); // FIN funcion ajax

        } // else THIS.VAL <> ''
        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
        {
        }
    }); // parentesis el .CLICK alta partido
//**************** PARTIDO: CABECERA *********************************************/
    

}); // parentesis del READY



    

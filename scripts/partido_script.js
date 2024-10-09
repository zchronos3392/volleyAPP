// JavaScript Document PARA EL banner que crece automaticamente...
		// cuando PRESIONO CLICK , LO ACTUALIZO

$(document).ready(function(){
    // Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
        //  $("#iclub").empty();
        //  $("#icity").empty();
        //  $("#icate").empty();
        //  $("#isedes").empty();
        //  $("#iclubb").empty();

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

// Alta real del partido...
$("#altap").click(function(){ 
    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	//alert('Submit activado');
        // Guardamos el select de cursos
        if( ($("#fechap").val() != '') && ($("#horai").val() != '')  )
        {
        // el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
        
        // $("#isede").val() este valor esta formado por el club y la sede unidos por un "_": "83_1"
        //data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
		var parametros = {
        	"fechap" : $("#fechap").val(),
        	"icate" : $("#icate").val(),
        	"iclub" : $("#iclub").val(),
        	"iclubb" : $("#iclubb").val(),
        	"icancha" : $("#icancha").val(),
        	"icomp" : $("#icomp").val(),
			"isede" : $("#isede").val(),
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
    			$("mensaje").append('Partido ingresado');
    				//console.log(r);
						alert('Partido ingresado');
    				// esta linea aca y luego en Cpartidos.php frenan el submit 
    				$("#FormPartidoC").submit(function(e){e.preventDefault();});			
					//window.location='AdministrarAPP.php';
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



    

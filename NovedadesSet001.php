<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>novedades set</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <link rel="stylesheet" href="./css/tablero_style.css">


	   <style>
			.XModales::backdrop,.XSModales::backdrop
			{
			background-color: rgba(0,0,0,.55);
			
			}

			.XModales,.XSModales
			{
			 	width:100%;
			}

	   .btnCAMBIO{
			text-decoration: none;
			background: #2e89f2;
			color: #FFF;
			width: 100%;
			text-align: center;
			vertical-align: middle;
			overflow: hidden;
			border: solid 1px #FFF;
			transition: .4s;
			height: 100%;
			word-wrap: break-word;
			}
		.bloqueFotos{
			display:grid;
			padding: 0.5rem;				
				grid-template-columns: 50% 50%;
				grid-template-rows: 50%;

				/*borde redondeado*/
						border: 0px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/	
		}			
		.bloqueRotar{
				display:grid;
				padding: 0.5rem;				
				grid-template-columns: 50% 50%;
				/*borde redondeado*/
						border: 0px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/	
		}			
		 .repararrotacion2{
			padding: 0.5rem; 		 	
			display:grid;
			 grid-template-areas: "atras adelante";
				/*borde redondeado*/
						border: 1px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/				
			
		 }   	
		.repararrotacion{
			display:grid;
			 grid-template-areas: "atras adelante";
			padding: 0.5rem; 
				/*borde redondeado*/
						border: 1px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/				
			font-size:20px;	

		}	
		.itemAtrasA
		{
		  grid-area: atras;
				/*borde redondeado*/
						border: 1px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/			
		background-color:#2dc6d2;	
		height:2em;	
		width: 100%;			
		}	
		.itemAdelaA{
			grid-area: adelante;
		    background-color: #db3a62;
		    border-bottom: 50px solid transparent;			     			     
				/*borde redondeado*/
						border: 1px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/				
		height:2em;	
		width: 100%;					    
		}


		.itemAtrasB
		{
		  grid-area: atras;
		/*borde redondeado*/
				border: 1px solid #000000;
				-moz-border-radius: 7px;
				-webkit-border-radius: 7px;
		/*borde redondeado*/				
		background-color:#2dc6d2;			
		height:2em;					     
		width: 100%;		
		}	
		.itemAdelaB{
			grid-area: adelante;
		    background-color: #db3a62;
    		margin-top: 0em;			     
				/*borde redondeado*/
						border: 1px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/				
		height:2em;		
		width: 100%;
		}

		
		
		@media (max-width: 450px){
			

			.itemAtrasA
			{
		  grid-area: atras;
				/*borde redondeado*/
						border: 1px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/			
		background-color:#2dc6d2;	
		height:2em;	
		width: 100%;							     
			}	
			.itemAdelaA{
			grid-area: adelante;
		    background-color: #db3a62;
		    border-bottom: 50px solid transparent;			     			     
				/*borde redondeado*/
						border: 1px solid #000000;
						-moz-border-radius: 7px;
						-webkit-border-radius: 7px;
				/*borde redondeado*/				
		height:2em;	
		width: 100%;					    

			}

			.itemAtrasB
			{
			  grid-area: atras;
			/*borde redondeado*/
					border: 1px solid #000000;
					-moz-border-radius: 7px;
					-webkit-border-radius: 7px;
			/*borde redondeado*/				
			background-color:#2dc6d2;			
			height:2em;					     
			width: 100%;		
			}	
			.itemAdelaB{
				grid-area: adelante;
			    background-color: #db3a62;
	    		margin-top: 0em;			     
					/*borde redondeado*/
							border: 1px solid #000000;
							-moz-border-radius: 7px;
							-webkit-border-radius: 7px;
					/*borde redondeado*/				
			height:2em;		
			width: 100%;

			}			
		}			
	   </style>
	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		
		<script type="text/javascript">

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function cargarEstrategiaL(destinoID){

// TRAIGO UNA VEZ VECTOR DE PUESTOS			
iStrats1 = new Array();	
	 $.ajax({ 
        url:   './abms/obtener_strats1.php',
	    type:  'GET',
	    dataType: 'json',
	    async:false,
		// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
	    beforeSend: function (){},
	    done: function(data){},
	    success:  function (r){
	    	iStrats1 = Object.values(r['Strats1']);
	     },
	     error: function (xhr, ajaxOptions, thrownError) {}
	    }); // FIN funcion ajax	
// TRAIGO UNA VEZ VECTOR DE PUESTOS			
//PROBANDO LA CARGA UNICA DE LAS POSICIONES
//alert(iPosiciones);	
 return iStrats1;
	
}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ACTIVAR O  DESACTIVAR LIBEROS Y CENTRALES..
function activacion(claveCompuesta)
{
var array_accionjugador ='';
var accion ='';
var idjugador=idclub=idcategoria=0;
array_accionjugador =	claveCompuesta.split("_");
accion = array_accionjugador[0];
iaccion ='ACTIVAR';
    if(accion.indexOf('des') != -1)
    	iaccion ='DESACTIVAR';

	idjugador   = array_accionjugador[1];
	idclub      = array_accionjugador[2];
	idcategoria = array_accionjugador[3];

	idpartido = $("#partidoid").val();
    idset     = $("#numSet").text();
    fechas    = $("#fecha").text();

//alert('accion: ' + accion);
//	alert('jugador id: ' + idjugador);
//	alert('club id: ' + idclub);
//	alert('categoria id: ' + idcategoria);
//	alert('partido : ' +idpartido);
//	alert('fecha partido : ' +fechas);
//	alert('set nro : ' + idset);

		var parametros =
			{
		    "idpartido"   : idpartido,
			"fechapartido": fechas,
			"setnumero"   : idset,
			"idjugador"   : idjugador,
			"iclub"       : idclub,
			"icategoria"  : idcategoria,
			"horas"       : $("#stopwatch").text(),
			"ianio"       :	$("#ianio").val(),
			"accion"      : iaccion
			};
			
	 $.ajax({ 
				url:   './abms/activacion_jugador_partido.php',
				type:  'POST',
				data: parametros,
				dataType: 'text json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX   
				beforeSend: function (){},
				done: function(data){},
				success:  function (r)
				{},// SUCCESS	
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(thrownError);
					console.log(xhr.responseText);
				}// fin ERROR:FUNCT
				}); // FIN funcion ajax JUGASPARTIDO..	

 destinoId='#nombreactivar_'+idjugador+'_'+idclub+'_'+idcategoria;
  
  if(iaccion == 'ACTIVAR')	
	  $(destinoId).addClass('fondoActivo');
  else
  $(destinoId).removeClass('fondoActivo');			  		

}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// calcular los minutos transcurridos...
	function calculoTiempoRestante(inicio,fin){
	  var resultado='';
	//   console.log('Inicio: ' + inicio);
	// RECIEN CUANDO SE CONFIRMA EL INICIO DEL SET, ES CUANDO COMIENZA A TENER VALOR
	// PERO COMO NO SE RECARGA, NO LO VEO EN PANTALLA.
	// NECESITO ACTUALIZAR ESTE VALOR CUANDO CONFIRMO EL SET INICIO
	inicioMinutos ='';
	  inicioHoras  ='';
	  inicioMinutos = parseInt(inicio.substr(3,2));
	  inicioHoras = parseInt(inicio.substr(0,2));

	//  console.log('Fin: '+fin);	
	  
	  
	  finMinutos = parseInt(fin.substr(3,2));
	  finHoras = parseInt(fin.substr(0,2));

	  transcurridoMinutos = finMinutos - inicioMinutos;
	  transcurridoHoras = finHoras - inicioHoras;
	  
	  if (transcurridoMinutos < 0) {
	    transcurridoHoras--;
	    transcurridoMinutos = 60 + transcurridoMinutos;
	  }
	  
	  horas = transcurridoHoras.toString();
	  minutos = transcurridoMinutos.toString();
	  
	  
	  if (horas.length < 2) {
	    horas = "0"+horas;
	  }

 
	  if (minutos.length < 2) {
	    minutos = "0"+minutos;
	  }	  
	  		
		//console.log("PASARON : "+horas+":"+minutos+" mins");		
		resultado = horas+" hs :"+minutos+" min";
		return (resultado);
	}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function actualizaPosicion(idpartido,fechaJuego,SetNumero,MaxCountSets,
						   idjugador,posCancha,clubid,cateJugador,posicionumerica){
//no actualiza entre cambios de liberos !!
//USO ESTA FUNCION PARA REALIZAR Y REGISTRAR LOS CAMBIOS..
var array_suplente ='';
var idsuplente =0;
	if($(".bordeSeleccion").attr("id") == undefined)
		alert('	Primero el suplente, dsps el posta...');
	else{
		var array_suplente =	$(".bordeSeleccion").attr("id").split("_");
		var idsuplente = array_suplente[0];
//		fechaJuego = "'"+fechaJuego+"'";
		var parametros =
			{
		    "idpartido" : idpartido,
			"iclubescab" : clubid,
			"icatcab" : cateJugador,
			"fechapartido": fechaJuego,
			"idjugadorEntra":idsuplente,
			"idjugadorSale":idjugador,
			"posenset":posCancha,
			"setnumero" : SetNumero,
			"horas"     : $("#stopwatch").text(),
			"posicion"  :posicionumerica,
			"ianio":	$("#ianio").val()
			};
			 $.ajax({ 
				url:   './abms/cambiar_jugador_partido.php',
				type:  'POST',
				data: parametros,
				dataType: 'text json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){},
				done: function(data){},
				success:  function (r)
				{
				  cargaCancha();		
						//console.log(r);
			},// SUCCESS	
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(thrownError);
					console.log(xhr.responseText);
				}// fin ERROR:FUNCT
				}); // FIN funcion ajax JUGASPARTIDO..			
	} //else, esta todo disponible..	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++



//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
// ++++++++++++ marcar seleccion de suplente o libero
function elegirSuplente(dataSelector,claseOrigen){
	//$("#"+xidmoneda).removeClass('moneda');
	//alert($("#"+dataSelector).hasClass( 'bordeSeleccion' ));
	//border: 3px solid #d51a04;		
	if($("#"+dataSelector).hasClass( 'bordeSeleccion' ))
	{
	 		 $("#"+dataSelector).removeClass('bordeSeleccion');
	 		 //$("#"+dataSelector).addClass(claseOrigen);
	 		 $("#"+dataSelector).css("border", "1px solid #ffffff");
	}
	else
	{
	 		 $("#"+dataSelector).addClass('bordeSeleccion');
	 		 $("#"+dataSelector).css("border", "3px solid #d51a04");		 
	 		 //$("#"+dataSelector).removeClass(claseOrigen);
		
	}
	
}
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++		
//traigo escudo
	function obtenerEscudo(idClub,idescudoclub,claseSaque){
		//console.log(idClub);
         var parametros = {"idClub" : idClub};	
         $.ajax({ 
            url:   './abms/obtener_club_por_id.php',
            type:  'GET',
            data: parametros ,
            datatype:   'text json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				$(idescudoclub).html('');
    		},
            done: function(data){
            	
			},
            success:  function (r){
				var re = JSON.parse(r);
				//console.log(re['escudo']);
				var escudoSpan		 = '';
				var cierreEscudoSpan = '';
				
				if(re['escudo'] !='')
				{
									
					$("#"+idescudoclub).html(escudoSpan+'<img  src="'+"img/escudos/"+re['escudo']+'" class="imgjugadorTablero '+claseSaque+'" id="'+idescudoclub+'IMG"></img>'+cierreEscudoSpan); 
				}
    			else            	
    				$(idescudoclub).html('<img  src="img/jugadorGen.png" class="imgjugadorTablero" ></img>'); 
            },
             error: function (xhr, ajaxOptions, thrownError) 
             {
			 }
            });

 	}
 			
// OBTENEMOS LA DATA DE LOS SETS ANTERIORMENTE JUGADOS
			function traerSetAnteriores(clubID){
			//	$("#setsganados").empty();
				var setNumero20 =0;

				<?php $idpartido = $_GET['id']; ?>
				var idpartido = <?php echo $idpartido;?>;

				var parametros =
				{
					"idpartido" : idpartido,
					"idfecha"    : <?php echo("'".$_GET['fecha'])."'";?>,
					"setNum"	   : setNumero20,
					"llama"			:"traeSetsAnteriores"
				};
			     $.ajax({ 
			        url:   './abms/obtener_sets.php',
			        type:  'GET',
			        data: parametros,
			        dataType: 'json',
			        beforeSend: function (){
						// Bloqueamos el SELECT de los cursos
					},
			        done: function(data){

					},
			        success:  function (r)
			        {
			        	//$("#setsganadosA").empty();
						//$("#setsganadosB").empty();

			            $(r['Sets']).each(function(i, v){ // indice, valor				

						if(v.mensaje=='Fin del set')
						{
							
								if(parseInt(v.puntoa,10) >= parseInt(v.puntob,10))
								  if(clubID == 'nomA')
									$("#setsganadosA").append('<div class="parciales"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div>');								if(v.puntoa <= v.puntob)
									if(clubID == 'nomB')
									$("#setsganadosB").append('<div class="parciales"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div>');							
						 }
						  else
							{
//							var jugando='<section class="puntoJugando21">'+
//									'<div class="" id="setsjugandosA">'+
//										'<div class="parcialesj"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div></div>'+
//									 '</section>';
//							$("#categoria").append(jugando);
							}
//	  			      		$("#periodo").text(v.setnumero);
	  			      	});
	  			    },

			         error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						}
			        }); // FIN funcion ajax 			
			}
// OBTENEMOS LA DATA DE LOS SETS ANTERIORMENTE JUGADOS

		
		
		// nueva funcion para cambiar el color del indicador de tiempo	pedido
		function tiempoGraba(idclub,clubQuepide,fondoTiempoID,botonPresionado){
			//console.log('tiempoGraba()');
			var idbtn = "#"+botonPresionado;
			var fondoVisu = "#"+fondoTiempoID;
			//alert("CLUB QUE PIDE: "+clubQuepide);
			//alert("partido: "+$("#partidoid").val());
			var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"fechas"    : $("#fecha").text(),
    			"idclub"    : idclub,
    			"clubpide"     : clubQuepide
			 };
			
			$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   'pedirtiempo_set.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
			
            },
            success:  function (r){
            	//console.log(r);
            	// volver a PAGINA DE SETS: CSets2.php
					//analizo el contador de TIEMPOS DISPONIBLES..
					// devuelve el ok para cerrar la botonera del club correspondiente
				//	console.log('pre::cargarpuntosaque()');
					cargaCancha(); //antes cargarpuntosaque();
				//	console.log('post::cargarpuntosaque()');
				},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            	console.log(thrownError);
            }
            }); // FIN funcion ajax			
			
		};
		// nueva funcion para cambiar el color del indicador de tiempo	pedido		
		
		$.urlParam = function(name){
			var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
			if (results==null){
			   return null;
			}
			else{
			   return decodeURI(results[1]) || 0;
			}
		};
		
		function SaqueInicio(){
        // una vez puestas las posiciones iniciales, ubico al central de la posicionumerica
        // trasera y lo cambio por el libero "elegible"
        //necesito obtener la posicion e id del central de 1,5 o 6AB

    	var idpartido = $("#partidoid").val();
    	var SetNumero     = $("#numSet").text();
    	var fechas    = "'"+<?php echo($_GET['fecha']);?>+"'";

		// obtener centrales, y liberos		
		// obtener la posicion de a donde quedó el central.
		// obtener al libero activo...(pueden haber varios)
		
		//actualizaPosicion(idpartido,fechas,SetNumero,MaxCountSets,
		//				  idjugador,posCancha,clubid,cateJugador,
		//				  posicionumerica)
	
			
		}
		
		function adelantarRotacion(idclub){
			// viene 'idcluba'
			 var idclubAntiRota = $("#"+idclub).val();
			 //alert(idclubAntiRota);
		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : $("#resa").text(),
    			"resb"      : $("#resb").text(),
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"saque"     : $("#saque").val(),
    			"anioEquipo":	$("#ianio").val(),
    			"antirotacion"  : "S",
    			"quienAntiRota" : idclubAntiRota,
    			"sentido"       : "FF"
    		};

    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertarsetdata.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
			
            },
            success:  function (r){
				//console.log(r);
				var clubadetc = $("#idcluba").val();
				var clubbdetc = $("#idclubb").val();
				// porque necesito tener grabado el ultimo punto para controlar..
				//var valtiebreak = 25;
				var valtiebreak = $("#valorFINSETCOMUN").val();
				//SI VIENE EN 0 HABRAN ERRORES !!!!
				if(valtiebreak==0) alert("FIN DEL SET EN 0 !!!");
				//if($("#setmax").val() == $("#setactual").val()) valtiebreak= 15;
				if($("#setmax").val() == $("#setactual").val()) valtiebreak= $("#valorFINENTIE").val();
									if(valtiebreak==0) alert("FIN DEL SET en tb EN 0 !!!");
				//alert($("#setmax").val());
				//alert($("#setactual").val());
				var resultado01 = $("#resa").text(); //resa01; //levanto el nuevo valor que envie a insertar	//	$("#resa").text();//levanto el valor que esta actualizado en pantalla..
				var resultado02 = $("#resb").text(); //resa02; //levanto el nuevo valor que envie a insertar	//	$("#resb").text();
					//console.log('pre::DetectarGanador()');
						DetectarGanador(resultado01,resultado02,clubadetc,clubbdetc);
						cargaCancha(); //para que se actualice solo...
						//cargarpuntosaque();
			},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            }
            }); // FIN funcion ajax
}
		
		function retrasarRotacion(idclub){
			// viene 'idcluba'
			 var idclubAntiRota = $("#"+idclub).val();
			 //alert(idclubAntiRota);
		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : $("#resa").text(),
    			"resb"      : $("#resb").text(),
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"saque"     : $("#saque").val(),
    			"anioEquipo":	$("#ianio").val(),
    			"antirotacion"  : "S",
    			"quienAntiRota" : idclubAntiRota,
    			"sentido"       : "BW"
    		};

    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertarsetdata.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
			
            },
            success:  function (r){
				//console.log(r);
				var clubadetc = $("#idcluba").val();
				var clubbdetc = $("#idclubb").val();
				// porque necesito tener grabado el ultimo punto para controlar..
				//var valtiebreak = 25;
				var valtiebreak = $("#valorFINSETCOMUN").val();
				//SI VIENE EN 0 HABRAN ERRORES !!!!
				if(valtiebreak==0) alert("FIN DEL SET EN 0 !!!");
				//if($("#setmax").val() == $("#setactual").val()) valtiebreak= 15;
				if($("#setmax").val() == $("#setactual").val()) valtiebreak= $("#valorFINENTIE").val();
									if(valtiebreak==0) alert("FIN DEL SET en tb EN 0 !!!");
				//alert($("#setmax").val());
				//alert($("#setactual").val());
				var resultado01 = $("#resa").text(); //resa01; //levanto el nuevo valor que envie a insertar	//	$("#resa").text();//levanto el valor que esta actualizado en pantalla..
				var resultado02 = $("#resb").text(); //resa02; //levanto el nuevo valor que envie a insertar	//	$("#resb").text();
					//console.log('pre::DetectarGanador()');
						DetectarGanador(resultado01,resultado02,clubadetc,clubbdetc);
						cargaCancha(); //para que se actualice solo...
						//cargarpuntosaque();
					//console.log('post::DetectarGanador()');
			},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            }
            }); // FIN funcion ajax
}
		
					// FUNCION PARA DETECTAR GANADORES AUTOMATICAMENTE REARMADA DESDE EXCEL..
		function DetectarGanador(resA,resB,clubA,clubB)
			{
			//console.log('DetectarGanador()');
			var diferencia = 0;
			var maxPuntaje = 0;
			<?php 		
					require_once './abms/Partido.php';
					$idpartido	= 0;
					$idpartido = (int)$_GET['id'];
					$fecha='';
					$fecha    = "'".$_GET['fecha']."'";
					$valoresfinales=0;  
					$valoresfinales = Partido::getfinset($idpartido,$fecha);
					//print_r($valoresfinales);
			?>
			
			var valtiebreak = 0;
			valtiebreak = <?php echo($valoresfinales["0"]["valFinSet"]);?>;

		//	console.log('parametros: valortie: '+valtiebreak);

			//SI VIENE EN 0 HABRAN ERRORES !!!!
				//if($("#setmax").val() == $("#setactual").val()) valtiebreak= 15;
				if($("#setmax").val() == $("#setactual").val()) valtiebreak= <?php echo($valoresfinales["0"]["valTBSet"]);?>;
			if(resA >= resB)
			{ // INICIO IF
			  // resA es MAYOR O IGUAL 
			  if(resA >=valtiebreak)
			   {
							
				 diferencia = resA - resB;
				 if(diferencia >=2)
				 {
					 //console.log('94 parametros: valor fin set: '+valtiebreak);	
				 	 //console.log(clubA + " - (a) wins the set");
									cerrarSet();
				 };	
			   }
			} // FIN DEL IF
			else	
			{  // RESB ES MAYOR
			  if(resB >=valtiebreak)
			   {

				 diferencia = resB - resA;
				 if(diferencia >=2)
				 {
				  	//console.log(' 108parametros: valor fin set: '+valtiebreak);	 					 
				 	//console.log(clubB + " (b) wins the set");
										cerrarSet();
				 };	
			   }
			}; // fin del ELSE
			}; // FIN DE LA FUNCION		
		
		function  cerrarSet()
		{ // esta funcion cierra el set y vuelve a la pagina de CargaSets
		//console.log('cerrarSet()');
			var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text()
			 };
			$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/cerrarsetdata.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
			
            },
            success:  function (r){
            	// volver a PAGINA DE SETS: CSets2.php
            	var partido = $("#partidoid").val();
				var fechapart = $("#fecha").text();
            	// COMENTO ESTO PARA QUE NO SE VAYA EL ERROR..
            	location.href = href='CSets2.php?id='+partido+'&setmax=<?php echo($_GET['setmax']); ?>'+'&fecha='+fechapart;
			},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            }
            }); // FIN funcion ajax
            
		};
/* +++++++++++++++ FIN FUNCION ROTAR ++++++++++*/

/* +++++++++++++++ FUNCION ENVIAR ESTRATEGIA MANUALMENTE ++++++++++*/
function   enviaEstrategia(resa,resb,rotar)
{
		//quite este parametro: "debeRotar" : $("#NOROTA").text()    			
   		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : resa,
    			"resb"      : resb,
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"rotacion" : rotar,
    			"estrategiaLA": $("#estrategiaLA").val(),
    			"estrategiaLB": $("#estrategiaLB").val(),    			
    			"mensajeAlta" : 'Novedades30::ESTRATEGIA'
			 };
    		
    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertarsetdata.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
			
            },
            success:  function (r){
						DetectarGanador(resultado01,resultado02,clubadetc,clubbdetc);
						cargaCancha(); //para que se actualice solo...
						//cargarpuntosaque();
			},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            }
            }); // FIN funcion ajax			
}
/* +++++++++++++++ FUNCION ENVIAR ESTRATEGIA MANUALMENTE ++++++++++*/


		function reanudar(resa,resb,rotar){
			//quite este parametro: "debeRotar" : $("#NOROTA").text()    			
   		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : resa,
    			"resb"      : resb,
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"rotacion" : rotar,
    			"mensajeAlta" : 'Novedades30::REANUDAR'
				
			 };
    		
    		$.ajax({ 
            url:   './abms/insertarsetdata.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
			
            },
            success:  function (r){
						DetectarGanador(resultado01,resultado02,clubadetc,clubbdetc);
						cargaCancha(); //para que se actualice solo...
						//cargarpuntosaque();
			},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            }
            }); // FIN funcion ajax			
		}
/* +++++++++++++++ FIN FUNCION ROTAR ++++++++++*/		
		function enviarJugada(resa01,resa02)
		{
			//quite este parametro: "debeRotar" : $("#NOROTA").text()    			
   		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : resa01,
    			"resb"      : resa02,
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"estrategiaLA": $("#estrategiaLA").val(),
    			"estrategiaLB": $("#estrategiaLB").val()    			
				
			 };
    		
    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertarsetdata.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
			
            },
            success:  function (r){
				//console.log(r);
				var clubadetc = $("#idcluba").val();
				var clubbdetc = $("#idclubb").val();
				// porque necesito tener grabado el ultimo punto para controlar..
				//var valtiebreak = 25;
				var valtiebreak = $("#valorFINSETCOMUN").val();
				//SI VIENE EN 0 HABRAN ERRORES !!!!
				if(valtiebreak==0) alert("FIN DEL SET EN 0 !!!");
				//if($("#setmax").val() == $("#setactual").val()) valtiebreak= 15;
				if($("#setmax").val() == $("#setactual").val()) valtiebreak= $("#valorFINENTIE").val();
									if(valtiebreak==0) alert("FIN DEL SET en tb EN 0 !!!");
				//alert($("#setmax").val());
				//alert($("#setactual").val());
				var resultado01 = $("#resa").text(); //resa01; //levanto el nuevo valor que envie a insertar	//	$("#resa").text();//levanto el valor que esta actualizado en pantalla..
				var resultado02 = $("#resb").text(); //resa02; //levanto el nuevo valor que envie a insertar	//	$("#resb").text();
					//console.log('pre::DetectarGanador()');
						DetectarGanador(resultado01,resultado02,clubadetc,clubbdetc);
						cargaCancha(); //para que se actualice solo...
						//cargarpuntosaque();
					//console.log('post::DetectarGanador()');
			},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
            }
            }); // FIN funcion ajax
		};
		
		$(document).ready(function(){
		
//LIBEROS LOCAL
		//controles de apertura y cierra modal
		const btnAbrirModalLibLocal =
		 document.querySelector("#SelLiberosA");
		const btnCerrarModalLibLocal =
		 document.querySelector("#btn-cerrar-modalLibA");
		// ventana modal en si.
		const modalLiberosLocal =
		 document.querySelector("#modalLiberosA");

		btnAbrirModalLibLocal.addEventListener("click",()=>
		{
			modalLiberosLocal.showModal();
		});

		btnCerrarModalLibLocal.addEventListener("click",()=>
		{
			modalLiberosLocal.close();
		});

// SUPLENTES LOCAL		
		//controles de apertura y cierra modal
		const btnAbrirModalSUPL_A =
		 document.querySelector("#Local");
		const btnCerrarModalSUPL_A =
		 document.querySelector("#btn-cerrar-modalSuplA");
		// ventana modal en si.
		const modalSUPL_A =
		 document.querySelector("#modalSuplentesA");

		 btnAbrirModalSUPL_A.addEventListener("click",()=>
		{
			modalSUPL_A.showModal();
		});

		btnCerrarModalSUPL_A.addEventListener("click",()=>
		{
			modalSUPL_A.close();
		});
// SUPLENTES LOCAL		

// SUPLENTES VISITA		
		//controles de apertura y cierra modal
		const btnAbrirModalSUPL_B =
		 document.querySelector("#Visitante");
		const btnCerrarModalSUPL_B =
		 document.querySelector("#btn-cerrar-modalSuplB");
		// ventana modal en si.
		const modalSUPL_B =
		 document.querySelector("#modalSuplentesB");

		 btnAbrirModalSUPL_B.addEventListener("click",()=>
		{
			modalSUPL_B.showModal();
		});

		btnCerrarModalSUPL_B.addEventListener("click",()=>
		{
			modalSUPL_B.close();
		});
// SUPLENTES VISITA

//CENTRALES Local
		//controles de apertura y cierra modal
		const btnAbrirModalCenA =
		 document.querySelector("#SelCentralesA");
		const btnCerrarModalCenA =
		 document.querySelector("#btn-cerrar-modalCentA");
		// ventana modal en si.
		const modalCentraleA =
		 document.querySelector("#modalCentralesA");

		btnAbrirModalCenA.addEventListener("click",()=>
		{
			modalCentraleA.showModal();
		});

		btnCerrarModalCenA.addEventListener("click",()=>
		{
			modalCentraleA.close();
		});

//LIBEROS VISITANTE
		//controles de apertura y cierra modal
		const btnAbrirModalLibB =
		 document.querySelector("#SelLiberosB");
		const btnCerrarModalLibB =
		 document.querySelector("#btn-cerrar-modalLibB");
		// ventana modal en si.
		const modalLiberosB =
		 document.querySelector("#modalLiberosB");

		btnAbrirModalLibB.addEventListener("click",()=>
		{
			modalLiberosB.showModal();
		});

		btnCerrarModalLibB.addEventListener("click",()=>
		{
			modalLiberosB.close();
		});
		
//CENTRALES VISITANTE
		//controles de apertura y cierra modal
		const btnAbrirModalCenB =
		 document.querySelector("#SelCentralesB");
		const btnCerrarModalCenB =
		 document.querySelector("#btn-cerrar-modalCentB");
		// ventana modal en si.
		const modalCentraleB =
		 document.querySelector("#modalCentralesB");

		btnAbrirModalCenB.addEventListener("click",()=>
		{
			modalCentraleB.showModal();
		});

		btnCerrarModalCenB.addEventListener("click",()=>
		{
			modalCentraleB.close();
		});		
		
		
		var escudoAMarco=escudoBMarco="NoBorde";//		
		// COIGO PARA ANIMAR LA HAMBURGUESA
		var win = $(this); //this = window
			$("#medidas").val('W-' + win.width());

			// COIGO PARA ANIMAR LA HAMBURGUESA
			$(window).on('resize', function(){
					var win = $(this); //this = window
					$("#medidas").val('W-' + win.width());
					$("#medidas").val('RESPONSIVE DATA:W: ' + win.width()+' - H: '+ win.height());
			});				


//para tener el año actual, para las cargas de jugadores
		var f=new Date();
		var fechapartido = f.getFullYear()-1 ;
		fechainicial = fechapartido -10;
		fechaFinal   = fechapartido +10;
		for (var i = fechainicial; i < fechaFinal; i++) 
		{
			if(i == fechapartido) $("#ianio").prepend('<option selected>' + (i + 1) + '</option>');
			else  $("#ianio").prepend('<option>' + (i + 1) + '</option>');
		}
		$("#ianio").prop('disabled', true);

		var FechaParametros = $.urlParam('fecha');
			//CHATGPT Supongamos que el campo de texto tiene un ID de "miCampoTexto"
				var valorCampoTexto = FechaParametros; //$('#miCampoTexto').val();
				var fecha = new Date(valorCampoTexto);
				var anio = fecha.getFullYear();
				$("#ianio").val(anio);
		

//para tener el año actual, para las cargas de jugadores

		vStrats1 = cargarEstrategiaL();
		//lo traigo una vez para todos , son dos controles.
	
	    $(vStrats1).each(function(i, v)
            { // indice, valor
                	if (! $('#estrategiaLA').find("option[value='" + v.codigo + "']").length)
                	{
    					$("#estrategiaLA").append('<option value="' + v.codigo + '" label="('+v.codigo+')'+v.nombre+'">' +v.nombre + '</option>');
					}
			});

	    $(vStrats1).each(function(i, v)
            { // indice, valor
                	if (! $('#estrategiaLB').find("option[value='" + v.codigo + "']").length)
                	{
    					$("#estrategiaLB").append('<option value="' + v.codigo + '" label="('+v.codigo+')'+v.nombre+'">' +v.nombre + '</option>');
					}
			});
		
			var iclubescab1 = 0;
			var iclubescab2 = 0;
			var icatcab1    = 0 ;

/* CARGA CAEBECERA DEL set*/
			<?php $idpartido = $_GET['id']; ?>
			var idpartido = <?php echo $idpartido;?>;

			<?php $continuaCarga = $_GET['continuar']; ?>
			var contcargapart = <?php echo $continuaCarga;?>;
			/*
			//cargar puntoa,puntob,saque, esto trae todos los sets, resumidos
			// hacer una que traiga especificamente lo mismo pero de ese set...
				// obtener_set_id
			*/	
				var parametros = {"id" : idpartido,"fechapart" : <?php echo("'".$_GET['fecha'])."'";?> };
				$.ajax({ 
						url:   './abms/obtener_partidos.php',
						type:  'GET',
						data: parametros,
						dataType: 'text json',
						// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
						beforeSend: function (){
							
						},
						done: function(data){
								
						},
						success:  function (r){
							$(r['Partido']).each(function(i, v)
							{ // indice,0 valor
								$("#partidoCancha").text('Cancha: '+v.cancha);
								$("#competencia").text(v.cnombre);
								$("#fecha").text(v.Fecha);

								$("#categoria").text(v.DescCate);
								$("#categoria").append('<input id="idcat" type="hidden" value="'+v.idcat+'"/>');
								icatcab1 = v.idcat;
								
								traerSetAnteriores('nomA');
								//$("#nomA").text(v.ClubA + "  ("+v.ClubARes +")");
								$("#jugATitulo").text(v.ClubA);
								$("#nomA").append('<input id="idcluba" type="hidden" value="'+v.idcluba+'"/></div>');
				        	  	$("#HoraInicial").val(r['horainicio']);
								iclubescab1 = v.idcluba;
								//$("#nomB").text(v.ClubB+"  ("+v.ClubBRes +")");
				        	  	$("#HoraInicioSet").val(r['valorHoraInicioSet']);
								$("#jugBTitulo").text(v.ClubB);
								$("#nomB").append('<input id="idclubb" type="hidden" value="'+v.idclubb+'"/>');
//				    	 		var puntajeB	='<section class="punto21 sinMarginTop"><div class="" id="setsganadosB">Sets previos..Visitante</div></section>';	 	 
//								$("#nomB").append(puntajeB);
								traerSetAnteriores('nomB');
								iclubescab2 = v.idclubb ;
								$("#setmax").text(v.setsnmax);	
								$("#valorFINSETCOMUN").val(v.valFinSet);	
								$("#valorFINENTIE").val(v.valTBSet);	
								// aca deberia dejar marcado quien tenia el saque...
								$("#saque").append('<option value="'+v.idcluba+'">'+v.ClubA+'</option>');
								$("#saque").append('<option value="'+v.idclubb+'">'+v.ClubB+'</option>');
/* INCORPORAMOS LA CARGA DEL ESCUDO DE CADA CLUB */

							if(r['saque'] == v.idcluba)
							{ 
								//textoClubA = v.ClubA;
								escudoAMarco = "bordeRojo";
								escudoBMarco = "NoBorde"; 
							}
							
							if(r['saque'] == v.idclubb)
							{ 
								//textoClubB  = v.ClubB;
								escudoAMarco = "NoBorde";
								escudoBMarco = "bordeRojo"; 
							}
			// CARGO LOS ESCUDOS DE CADA EQUIPO JUNTO CON EL RESULTADO ACTUAL DEL SET
						var ESCUDOA = '<span id="escudoAMarco" class="'+escudoAMarco+'"><img  src="img/jugadorGen.png" class="imgjugadorTablero2" ></img></span>';
						
						
						var textoClubA ='<div class="grillaIdClubv20"><div class="itmidclub2a" id="escudoA">'+ESCUDOA+'</div><div class="itmidclub1a"><span id="nombrelocal">'+v.ClubA+'</span></div>'+
							 '<div id="nomA" class="" >'+
							 '<input id="idcluba" type="hidden" value="'+v.idcluba+'"/>'+
							'</div>'+
						'</div>';	
						
						$("#ClubVisitanteLibero").text(v.ClubB);
						$("#ClubVisitanteCentrales").text(v.ClubB);
							$("#ClubVisitaSuplentes").text(v.ClubB);
	
						
						$("#ClubLocalLibero").text(v.ClubA);
						$("#ClubLocalCentrales").text(v.ClubA);
							$("#ClubLocalSuplentes").text(v.ClubA);
						

						var ESCUDOB = '<span id="escudoBMarco" class="'+escudoBMarco+'"><img  src="img/jugadorGen.png" class="imgjugadorTablero2" ></img></span>';
						
						var textoClubB  = '<div class="grillaIdClubv20"><div class="itmidclub2a" id="escudoB" >'+ESCUDOB+'</div><div class="itmidclub1a"><span id="nombrevisita">'+v.ClubB+'</span></div>'+
							 '<div id="nomB" class="" >'+
							 	'<input id="idclubb" type="hidden" value="'+v.idclubb+'"/>'+
							'</div>'+
						'</div>';

						obtenerEscudo(v.idcluba,"escudoA",escudoAMarco) ;
						obtenerEscudo(v.idclubb,"escudoB",escudoBMarco) ;

						$("#clublocal").empty();
						$("#clublocal").append(textoClubA);						
						$("#clubvisitante").empty();
						$("#clubvisitante").append(textoClubB);						
			// CARGO LOS ESCUDOS DE CADA EQUIPO JUNTO CON EL RESULTADO ACTUAL DEL SET
/* INCORPORAMOS LA CARGA DEL ESCUDO DE CADA CLUB*/								
								//26/09/2018 cargo las cosas cargadas si puse continuar carga...
										cargaCancha();

							});// SUCCESS DE LA COLECCION PARTIDO desde obtener_partidos
							//TENGO QUE TRAER ACA EL VALOR DEL ULTIMO SET / ACTUAL
							//lO TRAIGO ACA, PARA QUE SE REFRESQUE BIEN CUANDO SALGO Y VUELVO 
							// A ENTRAR A LA PANTALLA, O CUANDO TIRO UN F5	
								$("#resa").text(r['puntoa']);
								$("#resb").text(r['puntob']);

						},
						 error: function (xhr, ajaxOptions, thrownError) {
						// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						console.log(thrownError);
						console.log(xhr.responseText);
						}
				}); // FIN funcion ajax obtener_partido

				
		
		var dt = new Date();
//		var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds();
	    var tiempo = {
	        hora: dt.getHours(),
	        minuto: dt.getMinutes(),
	        segundo: dt.getSeconds()
	    };

    	var tiempo_corriendo = null;

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
		var tiempoSinSegs = tiempoTxtHora +':' + tiempoTxtMin;		
		var tiempoTxt = tiempoTxtHora +':' + tiempoTxtMin +':' + tiempoTxtSeg ;
		$("#stopwatch").text(tiempoTxt);
		var horaDesde = $("#HoraInicial").val();
		var horaInicioRealSet = $("#HoraInicioSet").val();
		var TiempoTranscurridoActual = '';
		// console.log('trancurrido principal:');
		var TiempoTranscurridoActual = calculoTiempoRestante(horaDesde,tiempoSinSegs);		
		// console.log('trancurrido del set:');
		var TTranscurridoSetActual = calculoTiempoRestante(horaInicioRealSet,tiempoSinSegs);		
		
		$("#horaactual").text(tiempoTxt);
		$("#tiempotranscurridoSet").text(TTranscurridoSetActual);				
		$("#tiempotranscurrido").text(TiempoTranscurridoActual);
		}, 1000); //funcion setinterval..
					
		 var resA = 0;
		 var resB = 0;
		$("#ocultaControles").click(function(){
				
			$("#xgrid-container22").toggle();
			$(".bloqueFotos").toggle();
		});
				
		$("#incremA").click(function(){
			var resa01 = $("#resa").text();
			resa01++;
			$("#resa").text(resa01);//LO PEGA BIEN PERO LUEGO SE BORRA CON EL VIEJO VALOR...
			$("#ROTA").text("S");	
				enviarJugada(resa01,0);
			//30 09 2018
				cargaCancha();
				//cargarpuntosaque();
	
    	});
    	
    	$("#decremA").click(function(){
			var resa01 = $("#resa").text();
			if(resa01 > 1) resa01--;
			else resa01 = 0;
			$("#resa").text(resa01);
			$("#ROTA").text("N");//ESTA MAL, NO HAY QUE ROTAR ACA..			
				// agregamos el ajuste..
				enviarJugada(resa01,0);
    	});		
    
		$("#incremB").click(function(){
			var resa02 = $("#resb").text();
			resa02++;
			$("#resb").text(resa02);
			//$("#NOROTA").text("S");			
			enviarJugada(0,resa02);
			//30 09 2018
			cargaCancha();
			//cargarpuntosaque();
    	});
    	
    	$("#decremB").click(function(){
			var resa02 = $("#resb").text();
			if(resa02 > 1) resa02--;
			else resa02 = 0;
			
			$("#resb").text(resa02);
			//$("#NOROTA").text("N"); // ESTA MAL NO HAY QUE ROTAR AL QUITAR PUNTOS..
				// agrego el ajustar resultado..
			enviarJugada(0,resa02);
    	});


    	
    	$("#CierraSet").click(function(){
				cerrarSet();
    	});

		$("#reanudar").click(function(){

			var resa = $("#resa").text();
			var resb = $("#resb").text();	
			var rotar = "N";	
			 reanudar(resa,resb,rotar);
			//30 09 2018
	    		//cargaCancha();
	    		//cargarpuntosaque();
		});   

		$("#estrategiaLA").click(function(){

			var resa = $("#resa").text();
			var resb = $("#resb").text();	
			var rotar = "N";	
			enviaEstrategia(resa,resb,rotar);
			//30 09 2018
	    		//cargaCancha();
	    		//cargarpuntosaque();
		});   		

		$("#estrategiaLB").click(function(){

			var resa = $("#resa").text();
			var resb = $("#resb").text();	
			var rotar = "N";	
			enviaEstrategia(resa,resb,rotar);
			//30 09 2018
	    		//cargaCancha();
	    		//cargarpuntosaque();
		});   		

		
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		$("#Sacando").click(function(){		
		// CAMBIO A LOS LIBEROS POR LOS CENTRALES DE AMBOS EQUIPOS AL MISMO TIEMPO
		//UTILIZA LA LISTA DE LIBEROS ACTIVOS Y DE CENTRALES ACTIVOS.
		// debe ser similar a CAMBIO
			idpartido   = $("#partidoid").val();
		    SetNumero       = $("#numSet").text();
		    fechaJuego  = $("#fecha").text();
		
		var parametros =
			{
		    "idpartido" : idpartido,
			"fechapartido": fechaJuego,
			"setnumero" : SetNumero,
			"ianio":	$("#ianio").val(),
			"horas"     : $("#stopwatch").text(),
			"MODO" : "PRESAQUEINICIAL"
			};

			 $.ajax({ 
				url:   './abms/cambiar_jugador_partido.php',
				type:  'POST',
				data: parametros,
				dataType: 'text json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){},
				done: function(data){},
				success:  function (r)
				{
				  
						//console.log(r);
				},// SUCCESS	
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(thrownError);
					console.log(xhr.responseText);
				}// fin ERROR:FUNCT
				}); // FIN funcion ajax JUGASPARTIDO..			
		  cargaCancha();
		});    
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		
		$("#grabarPos").click(function(){		
		// SETEA PARAMETROS INICIALES !!!! NO SIRVE PARA OTRA COSA
		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : $("#resa").text(),
    			"resb"      : $("#resb").text(),
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"saque"     : $("#saque").val(),
    			"mensajeAlta" : 'Novedades30::grabaPos',
    			"anioEquipo":	$("#ianio").val() 
    		};
    		
			///funciona : alert(JSON.stringify(parametros));
    		//mandar por ajax a novedadSet
    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_sets.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#iclub").prop('disabled', true);
            },
            
            success:  function (r){
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
						var re = JSON.parse(r);		
						alert(re['HoraInicial']);
						$("#HoraInicial").val(re['HoraInicial']);		
						cargaCancha();
	    				//cargarpuntosaque();
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#iclub").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }
		   });
		});    
/*            
		$("#grabarPos_20").click(function(){		
		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : $("#resa").text(),
    			"resb"      : $("#resb").text(),
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"saque"     : $("#saque").val(),
    			"anioEquipo":	$("#ianio").val()
    		};
    		
			///funciona : alert(JSON.stringify(parametros));
    		//mandar por ajax a novedadSet
    		// capaz un insertar set 2
    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_sets_20.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#iclub").prop('disabled', true);
            },
            
            success:  function (r){
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
	    				cargaCancha();
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#iclub").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }            
           }); // FIN funcion ajax
    	});//fin grabarPOS QUE NO EXISTE ACA...	
*/

    	
		$("#ContinuarP").click(function(){		
		var parametros =
    		 {
    			"idpartido" : $("#partidoid").val(),
    			"idset"     : $("#numSet").text(),
    			"resa"      : $("#resa").text(),
    			"resb"      : $("#resb").text(),
    			"fechas"    : $("#fecha").text(),
    			"horas"     : $("#stopwatch").text(),
    			"saque"     : $("#saque").val(),
    			"anioEquipo":	$("#ianio").val()
    		};
    		//console.log(parametros);
			///funciona : alert(JSON.stringify(parametros));
    		//mandar por ajax a novedadSet
    		// capaz un insertar set 2
    		$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/insertar_sets_20.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    			//$("#iclub").prop('disabled', true);
            },
            
            success:  function (r){
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
	    		console.log(r);
	    		cargaCancha();
	    		//cargarpuntosaque();
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#iclub").append('<option value="9998">' + 'SUBMIT:: Error en el servidor ..</option>');
            }            
           }); // FIN funcion ajax
    	});//fin grabarPOS QUE NO EXISTE ACA...    	

		$("#subirFotos").click(function(){
			$("#TablaInfoReferencial").show();
		
		});


		$("#LIMPIAR").on("click",function(e)
		{
			 $(".respuesta").html('');
			 $("#TablaInfoReferencial").hide();
		});
		
		$("#fLIMPIAR").on("click",function(e)
		{
			 $(".respuesta").html('');
			 $("#TablaInfoReferencial").hide();
		});

		
	    $("#fsubir").on('submit', function(e){
	        e.preventDefault();
	        $.ajax({
	            type: 'POST',
	            url:   './abms/sube_foto.php',
	            data: new FormData(this),
	            contentType: false,
	            cache: false,
	            processData:false,
		            beforeSend: function (){
		            	$("#subeFoto").val("Enviando"); // Para input de tipo button
                		$("#subeFoto").attr("disabled","disabled");
 						$('#fsubir').css("opacity",".5");
                		//$(".respuesta").html(parametros);
		            },
					complete:function(data){
	                /*
	                * Se ejecuta al termino de la petición
	                * */
	            	    $("#subeFoto").val("Sube Fotos");
    	           		$("#subeFoto").removeAttr("disabled");
        		    },		            
		            success:  function (r){
						$(".respuesta").html(r);
                		$('#fsubir').css("opacity","");
                		$("#subeFoto").attr("disabled","disabled");
						//$("#TablaInfoReferencial").hide();
						
		            },
					error: function (xhr, ajaxOptions, thrownError) {
						console.log(xhr.responseText);
						console.log(thrownError);
		            }
		            }); // FIN funcion ajax
		});

    	
		});// document,.ready 	

function buscarLibero(vectorEquipo,idABuscar,posicionBuscada,retorno){
	var conteo=0;
	var botonCentral='';
	$(vectorEquipo).each(function(j, w)
			{ // indice =j ,0 valor = w
					//console.log('indice : ' + j + ' valor : ' +w);
					if (w.idjugador  == idABuscar)
					{
						var puestoPosta = w.puestoxcat;
						if(puestoPosta != w.puesto) puestoPosta = w.puesto;
						if(puestoPosta == posicionBuscada){
							botonCentral='<button id="cambio" class="btnCAMBIO libero" style="display: inline-block;">';
//							console.log('ENCONTRE CENTRAL.. w.idjugador '+w.idjugador+' idABuscar ' +idABuscar );					
							conteo++;		
						}
						else botonCentral = '<button id="cambio" class="btnCAMBIO" style="display: inline-block;">';
					}
			});	

   //console.log(' encontro (0=no,1>=si: ' +conteo);
return botonCentral;

}		

function buscarPosicion(vectorEquipo,idABuscar,posicionBuscada,retorno){
/* DOCUMENTACION IMPORTANTE: 
 vectorEquipo CONTIENE POSICIONES DE CANCHA:
ColorPuestoCancha: "#1bd80e"
ColorPuestoCat	 : "#dc2327"
idjugador        : "154"
posicion		 : "6"
puesto			 : "4"
puestoxcat		 : "5"

PARAMETRO posicionBuscada NO SE USA MAS, DEPRECADO..
*/	
	var conteo=0;
	var botonCentral='';
	var colorFondo = 'style="backGround:#000;"';
	var colorFondoModo1 = ' backGround:#000;"';	
	//console.log('buscar jugador ID ' + idABuscar);

	$(vectorEquipo).each(function(j, w)
			{ // indice =j ,0 valor = w
					//console.log('indice : ' + j + ' valor : ' +w);
					if (w.idjugador  == idABuscar)
					{
						//console.log('jugador coincidente: ' + w.idjugador );
						var puestoPosta = w.puestoxcat;
								colorFondo = 'style="backGround:'+w.ColorPuestoCat+';"';
								colorFondoModo1 = ' backGround:'+w.ColorPuestoCat+';"';
						//console.log(' 1 puesto posta: ' + puestoPosta);
						if(puestoPosta != w.puesto)
						{
							 puestoPosta = w.puesto;
								colorFondo = 'style="backGround:'+w.ColorPuestoCancha+';"';
								colorFondoModo1 = ' backGround:'+w.ColorPuestoCancha+';"';
						} 
						//console.log(' 2 puesto posta: ' + puestoPosta);

						 if(retorno== 1);
							 colorFondo = '<button id="cambio" class="btnCAMBIO" style="display: inline-block;'+colorFondoModo1+'">';
					}
					//else
					  //console.log('No encontró este jugador: ' + w.idjugador + ' contra ' +idABuscar);

			});	
	return colorFondo;	

}		

	
function cargaCancha(){
//CARGAMOS LA CANCHA DE AMBOS EQUIPOS..	
//	console.log('cargaCancha()');
$("#erroresmensajes").empty();
var mensajesCentrales='';
	var params2 =
	 {
		"idpartido" : $("#partidoid").val(),
		"idset"     : $("#numSet").text(),
		"ianio"		:$("#ianio").val(),
		"fechas"    : <?php echo("'".$_GET['fecha']."'");?>,
		"quien"     :"cargaCancha"

	};
		
		$.ajax({ 
				url:   './abms/obtener_set_partido.php',
				type:  'GET',
				data: params2,
				dataType: 'json',
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){
					
				},
				done: function(data){
						
				},
				success:  function (r){
					var linki = '';
					var idclubLocal     = $("#idcluba").val();
					var idclubVisitante = $("#idclubb").val();
				if(r['estado'] != "0") {
					$("#liberosA").html('');
					$("#suplentesA").html('');					
					contlibA='';//armado de LIBEROS DEL LOCAL
					var xSuplentesA=xSuplentesB='';
					var puestoControl = 0;
					var xAllA=xAllB='';
					$("#liberosB").html('');
					$("#suplentesB").html('');
					contlibB='';//armado de LIBEROS DEL VISITANTE
					LiberosActivosLocal =LiberosActivosVis='';
					CentralesActivosLoc =CentralesActivosVis ='';			
				/**** CARGAMOS LA LISTA DE LIBEROS...de ambos EQUIPOS **/	
				/**	ACA HABRIA QUE CARGAR LOS SUPLENTES...de ambos EQUIPOS **/	
					$(r['Sets']).each(function(i, v)
						{ // indice =j ,0 valor = w
							puestoControl = 2; //Liberos, asi es mas facil copiar la logica y cambiar poco.
							$(v.equipoA).each(function(j, w)
							{ // indice =j ,0 valor = w
							  var puestoPostaINI=w.puestoxcat;
				  			  if(puestoPostaINI != w.puesto) puestoPostaINI= w.puesto;
							  
							  if(puestoPostaINI == puestoControl) //libero
							   {
								//console.log('indice : ' + j + ' valor : ' +w);
								//LA CLASE ITEML YA CONTIENE EL COLOR DEL LIBERO..
								//HAY QYE CAMBIARLO..
								if (! $('#liberosA').find("div[value='" + w.nombre + "']").length){
									var colorFondo = 'style="backGround:#000;"';
									var puestoPostaX = w.puestoxcat;
										colorFondo = 'style="backGround:'+w.ColorPuestoCat+';"';

										if(puestoPostaX != w.puesto)
										{
											puestoPostaX = w.puesto;
											colorFondo = 'style="backGround:'+w.ColorPuestoCancha+';"';
										} 
											contlibA +='<div '+colorFondo+ ' id="'+w.idjugador +'_L"  onclick="elegirSuplente(this.id,this.class);" >'+w.nombre +'<br>('+w.numero+')' +'</div>';
						
									//Cargo en lista de Activos.
									// armando boton de Activar:
										//si esta activado le pongo un fondo de color?
										var jugActivo = " fondoActivo ";
										if(w.activoSN != 1) jugActivo = '';
										
										LiberosActivosLocal +='<div class="GrillaActivos" id="Libero_'+w.idjugador +'">';
										LiberosActivosLocal +='<div class="grillaActivos_1">'+w.numero+'</div>';
										LiberosActivosLocal +='<div class="grillaActivos_2 '+jugActivo+'" id="nombreactivar_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'">'+w.nombre +'</div>';
										LiberosActivosLocal +='<div class="grillaActivos_3">';
										LiberosActivosLocal +='<button  class="botonMas" id="activarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" name="activarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" onclick="activacion(this.id);">+</button>';
										LiberosActivosLocal +='</div>';
										LiberosActivosLocal +='<div class="grillaActivos_4">';
										LiberosActivosLocal +='<button class="botonMenos" id="desactivarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" name="desactivarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" onclick="activacion(this.id);">-</button>';
										LiberosActivosLocal +='</div>';
										LiberosActivosLocal +='</div>';
									}
						   		}
							});   
						});	
						// FIN PROCESAMIENTO DE LIBEROS

						//agregarLiberosA
						$(r['Sets']).each(function(i, v)
						{ // indice =j ,0 valor = w
							$(v.equipoA).each(function(j, w)
							{ // indice =j ,0 valor = w
									esCentral='';
									//esCentral = buscarPosicion(r['SuplentesA'],w.idjugador,6,2);
									var colorFondo = 'style="backGround:#000;"';
									var puestoPostaX = w.puestoxcat;
										colorFondo = 'style="backGround:'+w.ColorPuestoCat+';"';

									if(puestoPostaX != w.puesto)
									{ 
										puestoPostaX = w.puesto;
												colorFondo = 'style="backGround:'+w.ColorPuestoCancha+';"';
									}

									if(puestoPostaX == 6)
									{
									mensajesCentrales +='(C)'+w.nombre+' - ';
									
										var jugActivo = " fondoActivo ";
											if(w.activoSN != 1) jugActivo = '';
									}
									else
										mensajesCentrales +='puesto : ('+puestoPostaX+')'+w.nombre+' - ';
											
									if (w.posicion == 7)
										xSuplentesA +='<div class="itemS" '+colorFondo+' id="'+w.idjugador +'_S"  onclick="elegirSuplente(this.id,this.class);" >'+w.nombre +'<br>('+w.numero+')' +'</div>';

									if ((! $('#suplentesA').find("div[value='" + w.nombre + "']").length )
									&& (puestoPostaX != 2) )
									{
										var Activado = ' onclick="elegirSuplente(this.id,this.class);" ';
										if(w.FechaEgreso != null)
											var Activado = ' onclick="alert(\'Jugador no disponible\');" ';
										var selecter='';
											if(w.posicion==1) selecter+='<div class="itemcjug2_1 redondo Grisado"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_1" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_1"  value="1" label="1" '+Activado+' >1</div>'
											else selecter+='<div class="itemcjug2_1 redondo"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_1" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_1"  value="1" label="1" '+Activado+' >1</div>';

											if(w.posicion==2) selecter+='<div class="itemcjug2_2 redondo Grisado"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_2" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_2"   value="2" label="2" '+Activado+' >2</div>';
											else selecter+='<div class="itemcjug2_2 redondo"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_2" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_2"   value="2" label="2" '+Activado+' >2</div>';

											if(w.posicion==3) selecter+='<div class="itemcjug2_3 redondo Grisado"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_3" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_3"  value="3" label="3" '+Activado+' >3</div>';
											else selecter+='<div class="itemcjug2_3 redondo"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_3" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_3"  value="3" label="3" '+Activado+' >3</div>';

											if(w.posicion==4) selecter+='<div class="itemcjug2_4 redondo Grisado"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_4" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_4"   value="4" label="4" '+Activado+' >4</div>';
											else selecter+='<div class="itemcjug2_4 redondo"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_4" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_4"   value="4" label="4" '+Activado+' >4</div>';

											if(w.posicion==5) selecter+='<div class="itemcjug2_5 redondo Grisado"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_5" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_5"  value="5" label="5" '+Activado+' >5</div>';
											else selecter+='<div class="itemcjug2_5 redondo"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_5" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_5"  value="5" label="5" '+Activado+' >5</div>';

											if(w.posicion==6) selecter+='<div class="itemcjug2_6 redondo Grisado"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_6" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_6"   value="6" label="6" '+Activado+' >6</div>';
											else selecter+='<div class="itemcjug2_6 redondo"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_6" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_6"   value="6" label="6" '+Activado+' >6</div>';

											if(w.posicion==7) selecter+='<div class="itemcjug2_7 redondo Grisado"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_7" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_7"   value="7" label="7" '+Activado+' >Sup</div>';
											else selecter+='<div class="itemcjug2_7 redondo"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_7" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_7"   value="7" label="7" '+Activado+' >Sup</div>';

										//elegirSuplente(this.id,this.class);
										var nombreData = w.nombre;
										if(w.FechaEgreso != null)
											nombreData = w.nombre + ' (BAJA)';
										//CARGAR INDICADOR DE PUESTO ACTUAL 
										botonCentral='';	
										// ES PUNTA
										if(puestoPostaX == 4)						
										{
											botonCentral='<button id="central_pos_'+w.idjugador+'" name="punta" class="itemcjug4 punta" title="marcar central al jugador" >{P}</button>';
										}
										
										// ES CENTRAL
										if(puestoPostaX == 6){
											botonCentral='<button id="central_pos_'+w.idjugador+'" name="central" class="itemcjug4 central" title="marcar central al jugador" >{C}</button>';
										}						
										
										if(puestoPostaX == 3)	//ARMADOR..					
										{
											botonCentral='<button id="central_pos_'+w.idjugador+'" name="armador" class="itemcjug4 armador" title="marcar armador al jugador" >{a}</button>';							
										}
										if(puestoPostaX == 5)	//OPUESTO..
										{
											botonCentral='<button id="central_pos_'+w.idjugador+'" name="opuesto" class="itemcjug4 opuesto" title="marcar opuesto al jugador" >{o}</button>';
										}					

										if(puestoPostaX == 2){	//libero..
											botonCentral='<button id="central_pos_'+w.idjugador+'" name="libero" class="itemcjug4 libero" title="marcar opuesto al jugador" >{L}</button>';
										}	
										//CARGAR INDICADOR DE PUESTO ACTUAL 

										xAllA += '<div id="pos_'+w.idjugador+'" name="pos_'+w.idjugador+'" class="grillaAllJug">'+
														'<div class="grillaAll_1">'+
															'<span class="itemcjug2  nombreJugador">'+nombreData+'</span>'+
															botonCentral+
														'</div>'+
														'<div class="grillaAll_2" >'+
															selecter+				   	  														  
														'</div>'+
													'</div>';
										//xAllA +='<div class="itemS" '+colorFondo+' id="'+w.idjugador +'_S"  onclick="" >'+w.nombre +'</div>';
									}
							});	
						});		
					//HAY CENTRALES ACA TAMBIEN..	
					$(r['Sets']).each(function(i, v)
					{ // indice,0 valor
					  $(v.equipoA).each(function(y, w)
					  {
					  	
						var puestoPostaX = w.puestoxcat;
						if(puestoPostaX != w.puesto)
							puestoPostaX = w.puesto;
					  	
						if(puestoPostaX == 6)//centrales
						{
						 var jugActivo = " fondoActivo ";
							if(w.activoSN != 1) jugActivo = '';
							CentralesActivosLoc +='<div class="GrillaActivos" id="Libero_'+w.idjugador +'">';
							CentralesActivosLoc +='<div class="grillaActivos_1">'+w.numero+'</div>';
							CentralesActivosLoc +='<div class="grillaActivos_2 '+jugActivo+'" id="nombreactivar_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'">'+w.nombre+'(pos '+w.posicion +')</div>';
							CentralesActivosLoc +='<div class="grillaActivos_3">';
							CentralesActivosLoc +='<button  class="botonMas" id="activarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" name="activarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" onclick="activacion(this.id);">+</button>';
							CentralesActivosLoc +='</div>';
							CentralesActivosLoc +='<div class="grillaActivos_4">';
							CentralesActivosLoc +='<button class="botonMenos" id="desactivarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" name="desactivarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" onclick="activacion(this.id);">-</button>';
							CentralesActivosLoc +='</div>';
							CentralesActivosLoc +='</div>';
						}					  	
					  });
					});
						
					$("#liberosA").html(contlibA);	
					$("#agregarLiberosA").html(LiberosActivosLocal);
					$("#agregarJugadoresA").html(xAllA);
					$("#agregarCentralesA").html(CentralesActivosLoc);
					$("#suplentesA").html(xSuplentesA);
					//$("#erroresmensajes").html(mensajesCentrales);

					$(r['Sets']).each(function(i, v)
						{ // indice =j ,0 valor = w
							puestoControl = 2; //Liberos, asi es mas facil copiar la logica y cambiar poco.
							$(v.equipoB).each(function(j, w)
							{ // indice =j ,0 valor = w
							  var puestoPostaINI=w.puestoxcat;
				  			  if(puestoPostaINI != w.puesto) puestoPostaINI= w.puesto;
							  
							  if(puestoPostaINI == puestoControl) //liberos
							   {
									if (! $('#liberosB').find("div[value='" + w.nombre + "']").length)
									{
										var colorFondo = 'style="backGround:#000;"';
										var puestoPostaX = w.puestoxcat;
											colorFondo = 'style="backGround:'+w.ColorPuestoCat+';"';

											if(puestoPostaX != w.puesto)
											{
												puestoPostaX = w.puesto;
												colorFondo = 'style="backGround:'+w.ColorPuestoCancha+';"';
											} 

												var claseBorde="class='bordeNegro'";
												contlibB +='<div '+colorFondo+claseBorde+ ' id="'+w.idjugador +'_L"  onclick="elegirSuplente(this.id,this.class);" >'+w.nombre +'<br>('+w.numero+')' +'</div>';
														
											var jugActivo = " fondoActivo ";
												if(w.activoSN != 1) jugActivo = '';

										//Cargo en lista de Activos.
											LiberosActivosVis +='<div class="GrillaActivos" id="Libero_'+w.idjugador +'">';
											LiberosActivosVis +='<div class="grillaActivos_1">'+w.numero+'</div>';
											LiberosActivosVis +='<div class="grillaActivos_2 '+jugActivo+'" id="nombreactivar_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'">'+w.nombre +'</div>';
											LiberosActivosVis +='<div class="grillaActivos_3">';
											LiberosActivosVis +='<button  class="botonMas" id="activarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" name="activarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" onclick="activacion(this.id);">+</button>';
											LiberosActivosVis +='</div>';
											LiberosActivosVis +='<div class="grillaActivos_4">';
											LiberosActivosVis +='<button class="botonMenos" id="desactivarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" name="desactivarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" onclick="activacion(this.id);">-</button>';
											LiberosActivosVis +='</div>';
											LiberosActivosVis +='</div>';
									}	
							   }
							});
						});	
					//TRABAJANDO CON SUPLENTES	
					$(r['Sets']).each(function(i, v)
						{ // indice =j ,0 valor = w
							$(v.equipoB).each(function(j, w)
							{ // indice =j ,0 valor = w
								if (! $('#suplentesB').find("div[value='" + w.nombre + "']").length)
									{
										var colorFondo = 'style="backGround:#000;"';
										var puestoPostaX = w.puestoxcat;
											colorFondo = 'style="backGround:'+w.ColorPuestoCat+';"';

										if(puestoPostaX != w.puesto)
										{ 
											puestoPostaX = w.puesto;
													colorFondo = 'style="backGround:'+w.ColorPuestoCancha+';"';
										}
										if(w.posicion == 7)	
											xSuplentesB +='<div class="itemS" '+colorFondo+' id="'+w.idjugador +'_S" onclick="elegirSuplente(this.id,this.class);"  >'+w.nombre +'<br>('+w.numero+')' +'</div>';

										if(puestoPostaX == 6)//centrales
										{
											mensajesCentrales +='(C)'+w.nombre+' - ';
										}
										else
											mensajesCentrales +='puesto : ('+puestoPostaX+')'+w.nombre+' - ';
											//elegirSuplente(this.id,this.class);	
											if ((! $('#suplentesB').find("div[value='" + w.nombre + "']").length )
											&& (puestoPostaX != 2) )
											{
											   var Activado = ' onclick="enviapos(this);" ';
												if(w.FechaEgreso != null)
													var Activado = ' onclick="alert(\'Jugador no disponible\');" ';
												var selecter='';
												if(w.posicion==1) selecter+='<div class="itemcjug2_1 redondo Grisado"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_1" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_1"  value="1" label="1" '+Activado+' >1</div>'
												else selecter+='<div class="itemcjug2_1 redondo"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_1" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_1"  value="1" label="1" '+Activado+' >1</div>';

												if(w.posicion==2) selecter+='<div class="itemcjug2_2 redondo Grisado"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_2" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_2"   value="2" label="2" '+Activado+' >2</div>';
												else selecter+='<div class="itemcjug2_2 redondo"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_2" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_2"   value="2" label="2" '+Activado+' >2</div>';

												if(w.posicion==3) selecter+='<div class="itemcjug2_3 redondo Grisado"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_3" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_3"  value="3" label="3" '+Activado+' >3</div>';
												else selecter+='<div class="itemcjug2_3 redondo"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_3" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_3"  value="3" label="3" '+Activado+' >3</div>';

												if(w.posicion==4) selecter+='<div class="itemcjug2_4 redondo Grisado"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_4" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_4"   value="4" label="4" '+Activado+' >4</div>';
												else selecter+='<div class="itemcjug2_4 redondo"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_4" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_4"   value="4" label="4" '+Activado+' >4</div>';

												if(w.posicion==5) selecter+='<div class="itemcjug2_5 redondo Grisado"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_5" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_5"  value="5" label="5" '+Activado+' >5</div>';
												else selecter+='<div class="itemcjug2_5 redondo"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_5" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_5"  value="5" label="5" '+Activado+' >5</div>';

												if(w.posicion==6) selecter+='<div class="itemcjug2_6 redondo Grisado"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_6" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_6"   value="6" label="6" '+Activado+' >6</div>';
												else selecter+='<div class="itemcjug2_6 redondo"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_6" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_6"   value="6" label="6" '+Activado+' >6</div>';

												if(w.posicion==7) selecter+='<div class="itemcjug2_7 redondo Grisado"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_7" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_7"   value="7" label="7" '+Activado+' >Sup</div>';
												else selecter+='<div class="itemcjug2_7 redondo"   id="jugadorubi_'+w.idclub+'_'+w.idjugador+'_'+w.categoria+'_7" name="jugadorubi_'+w.idclub+'_'+w.idjugador+'_7"   value="7" label="7" '+Activado+' >Sup</div>';

											    //elegirSuplente(this.id,this.class);
												var nombreData = w.nombre;
												if(w.FechaEgreso != null)
													nombreData = w.nombre + ' (BAJA)';
												//CARGAR INDICADOR DE PUESTO ACTUAL 
												botonCentral='';	
												// ES PUNTA
												if(puestoPostaX == 4)						
												{
													botonCentral='<button id="central_pos_'+w.idjugador+'" name="punta" class="itemcjug4 punta" title="marcar central al jugador" >{P}</button>';
												}
												
												// ES CENTRAL
												if(puestoPostaX == 6){
													botonCentral='<button id="central_pos_'+w.idjugador+'" name="central" class="itemcjug4 central" title="marcar central al jugador" >{C}</button>';
												}						
												
												if(puestoPostaX == 3)	//ARMADOR..					
												{
													botonCentral='<button id="central_pos_'+w.idjugador+'" name="armador" class="itemcjug4 armador" title="marcar armador al jugador" >{a}</button>';							
												}
												if(puestoPostaX == 5)	//OPUESTO..
												{
													botonCentral='<button id="central_pos_'+w.idjugador+'" name="opuesto" class="itemcjug4 opuesto" title="marcar opuesto al jugador" >{o}</button>';
												}					

												if(puestoPostaX == 2){	//libero..
													botonCentral='<button id="central_pos_'+w.idjugador+'" name="libero" class="itemcjug4 libero" title="marcar opuesto al jugador" >{L}</button>';
												}	
												//CARGAR INDICADOR DE PUESTO ACTUAL 

												xAllB += '<div id="pos_'+w.idjugador+'" name="pos_'+w.idjugador+'" class="grillaAllJug">'+
																'<div class="grillaAll_1">'+
																	'<span class="itemcjug2  nombreJugador">'+nombreData+'</span>'+
																	botonCentral+
																'</div>'+
																'<div class="grillaAll_2" >'+
																	selecter+				   	  														  
																'</div>'+
															'</div>';
										
												//xAllB +='<div class="itemS" '+colorFondo+' id="'+w.idjugador +'_S"  onclick="" >'+w.nombre +'</div>';
											}	
									}
							});
						});								
					//HAY CENTRALES ACA TMB		
					$(r['Sets']).each(function(i, v)
					{ // indice,0 valor
					  $(v.equipoB).each(function(y, w)
					  {
							var puestoPostaX = w.puestoxcat;
							if(puestoPostaX != w.puesto)
								puestoPostaX = w.puesto;

							if(puestoPostaX == 6)//centrales
							{
							var jugActivo = " fondoActivo ";
								if(w.activoSN != 1) jugActivo = '';
							CentralesActivosVis +='<div class="GrillaActivos" id="Libero_'+w.idjugador +'">';
							CentralesActivosVis +='<div class="grillaActivos_1">'+w.numero+'</div>';
							CentralesActivosVis +='<div class="grillaActivos_2 '+jugActivo+'" id="nombreactivar_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'">'+w.nombre +'</div>';
							CentralesActivosVis +='<div class="grillaActivos_3">';
							CentralesActivosVis +='<button  class="botonMas" id="activarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" name="activarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" onclick="activacion(this.id);">+</button>';
							CentralesActivosVis +='</div>';
							CentralesActivosVis +='<div class="grillaActivos_4">';
							CentralesActivosVis +='<button class="botonMenos" id="desactivarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" name="desactivarLibero_'+w.idjugador+'_'+w.idclub+'_'+w.categoria+'" onclick="activacion(this.id);">-</button>';
							CentralesActivosVis +='</div>';
							CentralesActivosVis +='</div>';

							}					  	
					  });
					});		
								
					$("#liberosB").html(contlibB);	
					$("#agregarJugadoresB").html(xAllB);
						$("#SuplentesB").html(xSuplentesB);
					$("#agregarLiberosB").html(LiberosActivosVis);
					$("#agregarCentralesB").html(CentralesActivosVis);
/********* CARGAMOS LA LISTA DE LIBEROS...de ambos EQUIPOS ************/	
					
					var esCentral = '';
					var esLibero  = '';
					var esArmador = '';

/********* CARGAMOS ESCUDO, NOMBRE Y QUIEN SACA...de ambos EQUIPOS ************/	
					$(r['PartidoData']).each(function(i,v)
					{
							var escudoAMarco=escudoBMarco='NoBorde';
							$("#saque").val(v.saque);
							
							$("#estrategiaLA").val(v.codigoStratA);
							$("#estrategiaLB").val(v.codigoStratB);
							
							if(v.saque == v.ClubA)
							{ 
								//textoClubA = v.ClubA;
								escudoAMarco = "bordeRojo";
								escudoBMarco = "NoBorde"; 
							}
							
							if(v.saque == v.ClubB)
							{ 
								//textoClubB  = v.ClubB;
								escudoAMarco = "NoBorde";
								escudoBMarco = "bordeRojo"; 
							}
							
						var ESCUDOA = '<span id="escudoAMarco" class="'+escudoAMarco+'"><img  src="img/jugadorGen.png" class="imgjugadorTablero2" ></img></span>';
						var textoClubA ='<div class="grillaIdClubv20"><div class="itmidclub2a" id="escudoA">'+ESCUDOA+'</div><div class="itmidclub1a">'+v.ClubA+'</div></div>';
						var ESCUDOB = '<span id="escudoBMarco" class="'+escudoBMarco+'"><img  src="img/jugadorGen.png" class="imgjugadorTablero2" ></img></span>';
						var textoClubB  = '<div class="grillaIdClubv20"><div class="itmidclub2a" id="escudoB" >'+ESCUDOB+'</div><div class="itmidclub1a">'+v.ClubB+'</div></div>';
								
						obtenerEscudo(v.ClubA,"escudoA",escudoAMarco) ;
						obtenerEscudo(v.ClubB,"escudoB",escudoBMarco) ;
						
					idclubLocal     = v.ClubA;
					idclubVisitante = v.ClubB;

					});
/********* CARGAMOS ESCUDO, NOMBRE Y QUIEN SACA...de ambos EQUIPOS ************/	

/********* CARGAMOS LA LISTA DE JUGADORES EN SU POSICION...de ambos EQUIPOS ************/	
					$(r['Sets']).each(function(i, v)
					{ // indice,0 valor
					//	console.log(v.equipoA);
						//console.log('entra al equipo Local: ');
					
					  esCentral = buscarPosicion($(v.equipoA),v.pa_1idjugx,6,1);
					//ACA VA EL COLOR !!!!
						//console.log('cuando no está el equiopo cargado devuelve: '+esCentral );
							//devuelve style="backGround:#000;"
						if(v.pa_1['jugx'] != undefined )
						{
						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pa_1idjugx+',\'A1\','+idclubLocal+','+$.urlParam('catP')+',1)">'+
								esCentral+
								'I - '+v.pa_1['jugx']+'</button></a>';
						$("#canchaa1").text('');
						$("#canchaa1").append(linki);
						}

						esCentral = buscarPosicion($(v.equipoA),v.pa_2idjugx,6,1);
						if(v.pa_2['jugx'] != undefined )
						{
						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pa_2idjugx+',\'A2\','+idclubLocal+','+$.urlParam('catP')+',2)">'+
								esCentral+
								'II - '+v.pa_2['jugx']+'</button></a>';
						$("#canchaa2").text('');
						$("#canchaa2").append(linki);
						}
						
						esCentral = buscarPosicion($(v.equipoA),v.pa_3idjugx,6,1);
						if(v.pa_3['jugx'] != undefined )
						{
						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pa_3idjugx+',\'A3\','+idclubLocal+','+$.urlParam('catP')+',3)">'+
								esCentral+
								'III - '+v.pa_3['jugx']+'</button></a>';
						$("#canchaa3").text('');
						$("#canchaa3").append(linki);
						}
						esCentral = buscarPosicion($(v.equipoA),v.pa_4idjugx,6,1);
						if(v.pa_4['jugx'] != undefined )
						{
						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pa_4idjugx+',\'A4\','+idclubLocal+','+$.urlParam('catP')+',4)">'+

								esCentral+
								'IV - '+v.pa_4['jugx']+'</button></a>';
						$("#canchaa4").text('');
						$("#canchaa4").append(linki);
						}
						esCentral = buscarPosicion($(v.equipoA),v.pa_5idjugx,6,1);
						if(v.pa_5['jugx'] != undefined )
						{
						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pa_5idjugx+',\'A5\','+idclubLocal+','+$.urlParam('catP')+',5)">'+
								esCentral+
								'V - '+v.pa_5['jugx']+'</button></a>';
						$("#canchaa5").text('');
						$("#canchaa5").append(linki);
						}
						esCentral = buscarPosicion($(v.equipoA),v.pa_6idjugx,6,1);			
						if(v.pa_6['jugx'] != undefined )
						{
						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pa_6idjugx+',\'A6\','+idclubLocal+','+$.urlParam('catP')+',6)">'+
								esCentral+
								'VI - '+v.pa_6['jugx']+'</button></a>';
						$("#canchaa6").text('');
						$("#canchaa6").append(linki);
						}
						//console.log('entrando a visitantes');	
						//+++++++++++++++++ PROCESAMOS LOS VISITANTES. +++++++++++++++
						//console.log('analizando a  JUG_B1 '+v.pb_1['jugx']);
						esCentral = buscarPosicion($(v.equipoB),v.pb_1idjugx,6,1);			
						if(v.pb_1['jugx'] != undefined )
						{
						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pb_1idjugx+',\'B1\','+idclubVisitante+','+$.urlParam('catP')+',1)">'+
								esCentral+
								'I - '+v.pb_1['jugx']+'</button></a>';
						$("#canchab1").text('');
						$("#canchab1").append(linki);
						}
						
						esCentral = buscarPosicion($(v.equipoB),v.pb_2idjugx,6,1);			
						if(v.pb_2['jugx'] != undefined )
						{						
						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pb_2idjugx+',\'B2\','+idclubVisitante+','+$.urlParam('catP')+',2)">'+

								esCentral+
								'II - '+v.pb_2['jugx']+'</button></a>';
						$("#canchab2").text('');
						$("#canchab2").append(linki);
						}	
						esCentral = buscarPosicion($(v.equipoB),v.pb_3idjugx,6,1);			
						if(v.pb_3['jugx'] != undefined )
						{	
						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pb_3idjugx+',\'B3\','+idclubVisitante+','+$.urlParam('catP')+',3)">'+

								esCentral+
								'III - '+v.pb_3['jugx']+'</button></a>';
						$("#canchab3").text('');
						$("#canchab3").append(linki);
						}
						esCentral = buscarPosicion($(v.equipoB),v.pb_4idjugx,6,1);			
						if(v.pb_4['jugx'] != undefined )
						{
						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pb_4idjugx+',\'B4\','+idclubVisitante+','+$.urlParam('catP')+',4)">'+
								esCentral+
								'IV - '+v.pb_4['jugx']+'</button></a>';
						$("#canchab4").text('');
						$("#canchab4").append(linki);
						}
						esCentral = buscarPosicion($(v.equipoB),v.pb_5idjugx,6,1);			
						if(v.pb_5['jugx'] != undefined )
						{	
						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pb_5idjugx+',\'B5\','+idclubVisitante+','+$.urlParam('catP')+')",5>'+
								esCentral+
								'V - '+v.pb_5['jugx']+'</button></a>';
						$("#canchab5").text('');
						$("#canchab5").append(linki);
						}
						esCentral = buscarPosicion($(v.equipoB),v.pb_6idjugx,6,1);			
						if(v.pb_6['jugx'] != undefined )
						{
						linki = '<a onclick="actualizaPosicion('+$("#partidoid").val()+',\'<?php echo($_GET['fecha']);?>\','+$("#numSet").text()+',<?php echo($_GET['setmax']);?>,'+
							v.pb_6idjugx+',\'B6\','+idclubVisitante+','+$.urlParam('catP')+')",6>'+
								esCentral+
								'VI- '+v.pb_6['jugx']+'</button></a>';
						$("#canchab6").text('');
						$("#canchab6").append(linki);
						}
						
								$("#saque").val(v.saque);
//analisis del tiempo pedido del equipo LOCAL				
								if(v.CantPausaA == 1)
								{
									$("#tiempoA1").css("background","#DC0A89");
								};

								if(v.CantPausaA == 0)
								{
									$("#tiempoA1").css("background","#DC0A89");	
									$("#tiempoA2").css("background","#DC0A89");

									$("#btnt1A").css("background","#142D5B");
									$("#btnt1A").prop('disabled', true);
									$("#btnt2A").css("background","#142D5B");
									$("#btnt2A").prop('disabled', true);
								};						
//analisis del tiempo pedido del equipo LOCAL	
//analisis del tiempo pedido del equipo VISTANTE
								if(v.CantPausaB == 1)	
								{
									$("#tiempoB1").css("background","#DC0A89");
								};
								if(v.CantPausaB == 0)
								{
									$("#tiempoB1").css("background","#DC0A89");	
									$("#tiempoB2").css("background","#DC0A89");
									$("#btnt1B").css("background","#142D5B");
									$("#btnt1B").prop('disabled', true);
									$("#btnt2B").css("background","#142D5B");
									$("#btnt2B").prop('disabled', true);							   
								};						

					});
/********* CARGAMOS LA LISTA DE JUGADORES EN SU POSICION...de ambos EQUIPOS ************/	
				  } // fin estado != 0	
			},
				 error: function (xhr, ajaxOptions, thrownError) {
				// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						console.log(thrownError);
						console.log(xhr.responseText);
				}
				}); // FIN funcion ajax set partido
				//LLER DATOS DE JUGADORES BASICOS LUEGO DEL ALTA PARTIDO/SET
};	
	

function QuienSaque(clubsaque)
{
	switch(clubsaque) {
		case 1: 
				//alert($("#idcluba").val());
				$("#saqueA").val($("#idcluba").val());
				break;
		case 2 :
				//alert($("#idclubb").val());
				$("#saqueA").val($("#idclubb").val());
				break;
	}
};
		
		</script>
    </head>
    <body>
		<?php include('includes/newmenu.php'); ?>
		<?php 
			require('abms/Set.php'); 
 			  $idpartido = (int) $_GET['id'];
			  //$newset = Sett::ultSetNum($idpartido);
			  $idnewset = (int) $_GET['setid']; 
		
		?>	
<section id="medioset" class="medioset">
<div class="grid-container22" id="grid-container22">
	<div class="item22_0a">
		<select id="ianio" name="ianio" class="ianio">
			<option value="9999">Seleccionar año...</option>
		</select>
	</div>
	<div class="item22_0b">
    <a href="CSets2.php?id=<?php echo $idpartido; ?>&setmax=<?php echo($_GET['setmax']); ?>&fecha=<?php echo($_GET['fecha']);?>">
    <button id="volver" title="volver a partidos" name="volver" class="btnPop29"> << </button>
    </a>
	</div>
	<div class="item22_0c">
 		<button id="ocultaControles" name="CierraSet" class="btnPop3">X</button>
	</div>
</div>


<div class="grid-container22" id="xgrid-container22">
	<div class="item22_0a"></div>
	<div class="item22_0b"></div>
	<div class="item22_0c"></div>
	<div class="item22_1"><div id="competencia"></div></div>
	<div class="item22_2">
		<div id="categoria" >CATEGORIA<input id="idcat" type="hidden" value=""/></div>
	    <input id="partidoid" value="<?php echo $idpartido; ?>" type="hidden"/>
	</div>
	<div class="item22_3"><div id="fecha" name="fecha" >FECHA - </div></div>		
	<div class="item22_4" id="stopwatch"></div>	
	<div class="item22_5" id="partidoCancha"></div>
	<div class="item22_6" id="numSet" ><?php echo($idnewset);?></div>	
	<div class="item22_7">
		<select id="saque" name="saque" class="SELECTEXTREMO">
			<option value="9999">Tiene saque..</option>
		</select>
	</div>
	<div class="item22_7a">
		<a href="ModPartido.php?id=<?php echo $idpartido; ?>&fechapart=<?php echo($_GET['fecha']);?>&novedad=1&setid=<?php echo($_GET['setid']);?>&setmax=<?php echo($_GET['setmax']);?>">
	<button id="modifica" title="modifica partido" name="modifica" class="btnPop3">Mod.Part.</button></a>
	</div>
	<div class="item22_7b">
    	<button id="grabarPos" name="grabarPos" title="Grabar Inicio Set" class="btnPop31">
    		Imprime Set inicio
    	</button>		
	</div>
	<div class="item22_7c">
    	<button id="CierraSet" name="CierraSet" class="btnPop30">X (Set)</button>
	</div>		
	<div class="item22_8"></div>
	<div class="item22_9">
		<button id="reanudar" name="reanudar" title="Reanudar partido" class="btnPop32"><span class="icon-play2"> (Reanudar)</span></button> 
	</div>
	<div class="item22_10">
		<button id="Sacando" name="grabarPos_20" title="Saque" class="btnPop3"><span class="icon-download"> (Ef.Saque)</span></button>
<!--		<button id="reload" name="grabarPos_20" title="Reload" class="btnPop3" onclick="javascript:location.reload();"><span class="icon-download"> (reload)</span></button>-->
	</div>
	<div class="item22_11">
	</div>
	<div class="item22_12">
			
	</div>	
</div> 
 <div class="grid-containerAlfa">
 	<div class="itemA_1">
 		<input type="text" id="medidas" name="medidas" value="" disabled/>
 	</div>
 	<div class="itemA_2">
 	</div>
 	<div class="itemA_3">Tiempo Total Partido</div>
 	<div class="itemA_4">
 		 <span id="tiempotranscurrido" name="tiempostranscurrido"></span>
 	</div>
 	<div class="itemA_5">Tiempo del Set</div>
 	<div class="itemA_6">
 		<span id="tiempotranscurridoSet" name="tiempostranscurridoSet"></span>
 	</div>
 	<div class="itemA_7">Hora Actual</div>
	<div class="itemA_8">
		<span id="horaactual" name="horaactual"></span>
	</div>	 	
 </div>   

    <section id="botoneraAx" class="botoneraAx">
    	<div class="GridBotCol">
    	</div>
    	<div class="GridBotCol">
    		<input type="hidden" id="setactual" value="<?php echo($idnewset); ?>"/><input type="hidden" id="setmax" value="<?php echo($_GET['setmax']); ?>"/>    	
			<input type="hidden" id="valorFINSETCOMUN" value=""/>
		    <input type="hidden" id="valorFINENTIE" value=""/>	
		</div>
    	<div class="GridBotCol"></div>
   </section>

<!--
<section class="bloqueFotos">	
	<button id="subirFotos" name="subirFotos" title="Agregar fotos al tablero" class="btnPopSubeFotos">Sube Fotos</button>
	<button   id="LIMPIAR" name="LIMPIAR" title="Limpiar mensajes" class="btnPopSubeFotos">Clear</button>
</section>	
-->
<section class="bloquemensajes">	
	<div id="erroresmensajes"></div>
</section>
<div  id="TablaInfoReferencial" class="TablaInfoReferencial">
	<form  method='POST' id='fsubir' name='fsubir' enctype='multipart/form-data' >
		<div class="itemTitulo1Ref">Subir foto para tablero del partido</div>
		<div class="itemTitulo2Ref"><input type="file" name="fotoPartido" id="fotoPartido"/></div>
		<div>
			<input type="hidden" name="partidoid"  value="<?php echo($_GET['id']); ?>"/>
			<input type="hidden" name="fechapart"  value="<?php echo($_GET['fecha']); ?>"/>			
		</div>
		<div class="itemRef0">
			<select id="icarpetas" name="icarpetas" title="carpetas de fotos" class="selectCarpetas">Carpeta destino
				<?php 
					$imagenEncontrada = scandir('./img/partidos/');
					foreach($imagenEncontrada as $indice => $valor)
						if($valor != "." && $valor != ".." && $valor != "" )
					  			echo "<option value='$valor'>$valor</option>";
				?>
			</select>
		</div>		
		<div class="itemRef">
			<button type="submit"  id="subeFoto" name="subeFoto" title="Upload foto" class="btnPopSubeFotos">Subir</button>
			<button   id="fLIMPIAR" name="LIMPIAR" title="Limpiar mensajes" class="btnPopSubeFotos">Clear</button>
		</div>
	</form>
	<hr>
    <p class="respuesta">
</div>

<div class="TabsGeneral">
	<ul class="ul">
		<li class="li" id="Local" >Local</li>
		<li class="li" id="Visitante" >Visitante</li>
	</ul>
	<div class="SubTab">	
		<div class="BloqueSubTab"></div>
		<div class="BloqueSubTab"></div>
	</div>
</div>

<!----SOLO SUMAR Y RESTAR -->
<section class="bloqueRotar">	
    	<section class="repararrotacion">
    	<button id="incremA" title="Sumar PUNTO LOCAL" name="incremA" class="btnPop26">+</button>	    	
	<button id="decremA" title="Restar PUNTO LOCAL/corregir" name="decremA" class="btnPop25">-</button>
	
		<button id="itemAdelaA"  name="itemAdelaA" class="btnPop28" onclick="adelantarRotacion('idcluba');"> Forwrd </button>
		<button id="itemAtrasA"  name="itemAtrasA" class="btnPop27" onclick="retrasarRotacion('idcluba') ;"> Backwrd </button>
	<!-- nueva incoporacion funcional.dic.07.12.22.	
		Seleccionar Liberos y Centrales Activos x Equipo -->
	    <button id="SelLiberosA" title="Seleccionar el o los líberos activos del equipo local" name="SelLiberosA" class="btnPop3">Liberos Loc</button>
    	<button id="SelCentralesA" title="Seleccionar el o los líberos activos del equipo local" name="SelCentralesA" class="btnPop3">Cent.Loc.</button>	
		
	</section>
    	<section class="repararrotacion">		
<button id="incremB" title="Suma PUNTO VISITANTE" name="incremB" class="btnPop26">+</button>   
<button id="decremB" title="Restar PUNTO VISITANTE/corregir" name="decremB" class="btnPop25">-</button>
		<button id="itemAtrasB"  name="itemAtrasB"  class="btnPop28" onclick="adelantarRotacion('idclubb');">Forwrd</button>
		<button id="itemAdelaB"  name="itemAdelaB"  class="btnPop27" onclick="retrasarRotacion('idclubb') ;">Backwrd</button>

	<!-- nueva incoporacion funcional.dic.07.12.22.	
		Seleccionar Liberos y Centrales Activos x Equipo -->
    <button id="SelLiberosB" title="Seleccionar el o los líberos activos del equipo visit" name="SelLiberosA" class="btnPop3">Liberos Vis</button>
    <button id="SelCentralesB" title="Seleccionar el o los líberos activos del equipo visit" name="SelCentralesA" class="btnPop3">Cent.Vis.</button>	
	</section>    	    	
    </section>
<!-- SOLO SUMAR Y RESTAR -->
<!-- GIRAR ROTACION 
<section class="bloqueRotar">	
	<section class="repararrotacion">
		<button id="itemAdelaA"  name="itemAdelaA" class="btnPop3" onclick="adelantarRotacion('idcluba');"> Forwrd </button>
		<button id="itemAtrasA"  name="itemAtrasA" class="btnPop3" onclick="retrasarRotacion('idcluba') ;"> Backwrd </button>
	</section>
	<section class="repararrotacion2">
		<button id="itemAtrasB"  name="itemAtrasB"  class="btnPop3" onclick="adelantarRotacion('idclubb');">Forwrd</button>
		<button id="itemAdelaB"  name="itemAdelaB"  class="btnPop3" onclick="retrasarRotacion('idclubb') ;">Backwrd</button>
	</section>
</section>	
-->

<!-- SUPLENTES -->
<dialog id="modalSuplentesA" class="XSModales">
	<div  class="CabGrillaSuplentes">
		<h2 id="ClubLocalSuplentes">HACOAJ</h2>
		<button id="btn-cerrar-modalSuplA">X</button>
	
	</div> 
	<div class="GrillaListaSuplentes">
		<div>Grilla Jugadores</div>
		<div id="agregarJugadoresA"></div>
	</div>
</dialog>

<dialog id="modalSuplentesB" class="XSModales">
	<div  class="CabGrillaSuplentes">
		<h2 id="ClubVisitaSuplentes">---</h2>
		<button id="btn-cerrar-modalSuplB">X</button>
	
	</div> 
	<div class="GrillaListaSuplentes">
		<div>Grilla Jugadores</div>
		<div id="agregarJugadoresB"></div>
	</div>
</dialog>


<!-- SUPLENTES -->


<!-- activar LIBEROS Y CENTRALES LOCALES -->
<dialog id="modalCentralesA" class="XModales">
	<div  class="CabGrillaActivo">
		<h2 id="ClubLocalCentrales">HACOAJ</h2>
		<button id="btn-cerrar-modalCentA">X</button>
	
	</div> 
	<div class="GrillaListaActivos">
		<div>Centrales</div>
		<div id="agregarCentralesA"></div>
	</div>
</dialog>


<dialog id="modalLiberosA" class="XModales">
	<div  class="CabGrillaActivo">
		<h2 id="ClubLocalLibero">HACOAJ</h2>
		<button id="btn-cerrar-modalLibA">X</button>
		<select id="estrategiaLA" name="estrategiaLA" class="SELECTEXTREMO">
			<option value="9999">Estrategias Liberos</option>
		</select>
    	<button id="StratChangeA" name="StratChangeA" class="btnPop3">Set Strat A</button>
	</div> 
	<div class="GrillaListaActivos">
		<div>Liberos</div>
		<div id="agregarLiberosA"></div>
	</div>
</dialog>
<!-- activar LIBEROS Y CENTRALES LOCALES -->


<!-- actiar LIBEROS Y CENTRALES VISITANTE -->
<dialog id="modalCentralesB" class="XModales">
	<div class="CabGrillaActivo">
		<h2 id="ClubVisitanteCentrales">HACOAJ</h2>
		<button id="btn-cerrar-modalCentB">X</button>
	</div> 
	<div class="GrillaListaActivos">
		<div>Centrales</div>
		<div id="agregarCentralesB"></div>
	</div>
</dialog>

<dialog id="modalLiberosB" class="XModales">
	<div  class="CabGrillaActivo">
		<h2 id="ClubVisitanteLibero">HACOAJ</h2>
		<button id="btn-cerrar-modalLibB">X</button>
		<select id="estrategiaLB" name="estrategiaLB" class="SELECTEXTREMO">
			<option value="9999">Estrategias Liberos</option>
		</select>
    	<button id="StratChangeB" name="StratChangeB" class="btnPop3">Set Strat B</button>
	</div> 
	<div class="GrillaListaActivos">
		<div>Liberos</div>
		<div id="agregarLiberosB"></div>
	</div>
</dialog>

<!-- actiar LIBEROS Y CENTRALES VISITANTE -->

<!--    <section id="cronocontroles" class="cronocontroles">  -->
		<div class="Espacioclub2">
						 <div class="itemEC2_1">
							 <div class="" id="clublocal">
							 <div id="nomA" class="" >
							 	<input id="idcluba" type="hidden" value=""/>
							</div>	
								<div class="grillaIdClub">
									<div class="itmidclub2"></div>
									<div class="itmidclub1"></div>
								</div>
							</div>
						</div>
						<div class="itemEC2_2">
								<div class="numero" id="resa">##</div>
						</div>
						 <div class="itemEC2_3">			
							   <div class="numero" id="resb">##</div>
						</div>
						
						 <div class="itemEC2_4">			
							 <div class="" id="clubvisitante">
							 <div id="nomB" class="" >
							 	<input id="idclubb" type="hidden" value=""/>
							</div>	
								<div class="grillaIdClub">
									<div class="itmidclub2"></div>
									<div class="itmidclub1"></div>
								</div>
							</div>
						</div>
						<div class="itemEC2_4A">
					<section id="tiemposA" class="gridcol tiempos"> 
						<div id="tiempoA1" class="tiempoIndividual t1">1T</div>
						<div id="tiempoA2" class="tiempoIndividual t2">2T</div>
						<div id="tiempoAB" class="tiempoIndividual t1"><button id="btnt1A" class="botont1" name="botont1a" onclick="var clubpide=$('#nombrelocal').text();var clubSelId=$('#idcluba').val();tiempoGraba(clubSelId,clubpide,'tiempoA1',this.id);">pide T1</button></div>
						<div id="tiempoAB" class="tiempoIndividual t2"><button id="btnt2A" class="botont2" name="botont2a" onclick="var clubpide=$('#nombrelocal').text();var clubSelId=$('#idcluba').val();tiempoGraba(clubSelId,clubpide,'tiempoA2',this.id);">pide T2</button></div>	
					</section>
						</div>
						<div class="itemEC2_4B">
						<section id="tiemposB" class="gridcol tiempos gridColMargenRight"> 
							<div id="tiempoB1" class="tiempoIndividual t1">1T</div>
							<div id="tiempoB2" class="tiempoIndividual t2">2T</div>
							<div id="tiempoAB" class="tiempoIndividual t1"><button id="btnt1B" class="botont1" name="botont1b" onclick="var clubpide=$('#nombrevisita').text();var clubSelId=$('#idclubb').val();tiempoGraba(clubSelId,clubpide,'tiempoB1',this.id);">pide T1</button></div>
							<div id="tiempoAB" class="tiempoIndividual t2"><button id="btnt2B" class="botont2" name="botont2b" onclick="var clubpide=$('#nombrevisita').text();var clubSelId=$('#idclubb').val();tiempoGraba(clubSelId,clubpide,'tiempoB2',this.id);">pide T2</button></div>	
						</section>	
							
							
						</div>
						<div class="itemEC2_5">
							<span id="nomAEstado">
								<section class="xpunto21  sinMarginTop">
								 <div class="" id="setsganadosA"></div>
								</section>	 	 			
							</span>
						</div>
						<div class="itemEC2_6">
							<span id="nomBEstado">
								<section class="xpunto21  sinMarginTop">
								 <div class="" id="setsganadosB"></div>
								</section>	 	 			
							</span>
						</div>
				</div>
<!--	  </section>	 -->
	<input id="HoraInicial" name="HoraInicial" value="" type="hidden"/>
	<input id="HoraInicioSet" name="HoraInicioSet" value="" type="hidden"/>	
	<section id="liberosA" class="ControlLiberos"></section>	
	<section id="suplentesA" class="ControlSuplentes"></section>		
    <section id="canchaA" class="canchaversion2">
    <div id="canchaa5" class="canchaversion2item5" >EN 5A - REMERA ##</div>
    <div id="canchaa4" class="canchaversion2item4  bordeRight" >JUGADOR EN 4A - REMERA ##</div>
    <div id="canchaa6" class="canchaversion2item6" >JUGADOR EN 6A - REMERA ##</div>
    <div id="canchaa3" class="canchaversion2item3  bordeRight" >JUGADOR EN 3A - REMERA ##</div>
    <div id="canchaa1" class="canchaversion2item1" >JUGADOR EN 1A - REMERA ##</div>
    <div id="canchaa2" class="canchaversion2item2  bordeRight" >JUGADOR EN 2A - REMERA ##</div>
    </section>

	<section id="liberosB" class="ControlLiberos segundoControl"></section>	
	<section id="suplentesB" class="ControlSuplentes tercerControl"></section>		
    <section id="canchaV" class="canchaversion2">
    <div id="canchab2" class="canchaversion2item2  bordeLeft" >JUGADOR EN 2B - REMERA ##</div>
    <div id="canchab1" class="canchaversion2item1" >JUGADOR EN 1B - REMERA ##</div>
    <div id="canchab3" class="canchaversion2item3  bordeLeft" >JUGADOR EN 3B - REMERA ##</div>
    <div id="canchab6" class="canchaversion2item6" >JUGADOR EN 6B - REMERA ##</div>
    <div id="canchab4" class="canchaversion2item4  bordeLeft" >JUGADOR EN 4B - REMERA ##</div>
    <div id="canchab5" class="canchaversion2item5" >JUGADOR EN 5B - REMERA ##</div>
    </section>

<!--    

</section> 

-->
</body>
</html>
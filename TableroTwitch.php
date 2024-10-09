<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Tablero on line</title>
        <meta name="title" content="Tablero partidos volleyAPP"/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <link rel="stylesheet" href="./css/tablero_style.css">
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	
    <style>
		.itemTableroTw1{
			display: flex;
			align-items:center;
			background-color: #e29d1d;
			height:2em;
			gap:1rem;
			font-size:x-large;
			color:#fff;
		}
		.itemTableroTw2{
			display: flex;
			justify-content:center;
			gap:1em;
			align-items:center;
			background-color: #e29d1d;
			color:#fff;
			height:5em;
			/* padding-left:20%; */
		}

		.grillaIdClub{
			display: flex;
			flex-direction:row;
			justify-content:center;
			align-items: center;

		}
		.itmidclub1a{
			font-size:5em;	

		}
		.Espacioclub4{
			background-color: #fff;
			display: flex;
			flex-direction:row;
			gap:1em;
			justify-content:center;
		}

		.TableroFondoTwitch{
			height:100%;
			display: flex;
			flex-direction:column;
			background-color: #e29d1d;


		}	
		.LogoContenedor
		{
			display: flex;
			flex-direction:row;
			align-items:flex-start


		}
       .LogoTwich{
            height: 2.5em;
			width:auto;
			z-index:10;
			margin-top: auto;
			
        }
		
		IMG {
			width: 4.5em;
    		height: 4em;
			padding:0.6rem;
		}

        .Espacioclub3 {
            display: flex;
            flex-direction: row;
            flex-wrap: initial; /* Para mostrar cada DetalleGrillaTabla en una sola línea */
            align-items: center;
            border: 1px solid #ccc;
			width:auto;
			justify-content:space-around;

        }
        .itemEC2_A,.itemEC2_B{
            display: flex;
            flex-direction: row;
            flex-wrap: initial; /* Para mostrar cada DetalleGrillaTabla en una sola línea */
            align-items: center;
            border: 1px solid #ccc;
        }

        .Tiempos{
            display: flex;
            flex-direction: column;
            flex-wrap: initial; /* Para mostrar cada DetalleGrillaTabla en una sola línea */
            align-items: center;
            border: 1px solid #ccc;
            width:max-content;
        }        
        /* .AltoInicial{
			margin: 0 auto;
			height: 0;
        } */
        .itemTablero21{
            height:2em;
        }
        itmidclub3a IMG
        {
            width: 2em;
            height: 2em;
        }
		.numero{
			font-size:5em;
		}

		
		.PosicionesInicialesTodos{
			display: flex;
			justify-content: space-between;
		}

		.PosicionesInicialesA,.PosicionesInicialesB{
            display: flex;
            flex-direction: column;
            flex-wrap: initial; /* Para mostrar cada DetalleGrillaTabla en una sola línea */
            align-items: center;
            border: 1px solid #ccc;
            width:max-content;
		}

		.ijugadorEnPos  {
            display: flex;
            flex-direction: row;
            /*flex-wrap: inheri; /* Para mostrar cada DetalleGrillaTabla en una sola línea */
            align-items: left;
			text-align:center;
			justify-content: space-around;
			width:100%;
            border: 1px solid #ccc;
			padding:0.1rem;
		}
		.nombreJugador{
			
			font-size:1rem;
		}

		.xpunto21 {
    		display: flex;
			flex-direction:column;
			justify-content: center;
			width:5em;
            border: 1px solid #ccc;
		}

		.xpunto21 div {
			color: #000;
			background: #fff;
			border: 1pxsolid #000000;
			-moz-border-radius: 7px;
			-webkit-border-radius: 7px;
			width:5.7em;
		}		
     </style>

    <script type="text/javascript">


	var iEscudo='';
	var hayEscudos=0;
//	var estadoLocal = 'NADA';
// calcular los minutos transcurridos...
//FUNCION CHEQUEO ESTADO partido		
// posiciones iniciales, global.
	var MatrixPosicionesIniciales = new Array();
	var JugadoresEnCanchados = ['a','b'];
	var CorrespondenciasL=CorrespondenciasV = [];
	CorrespondenciasL = [
						{"a1": "a6", "a2": "a1", "a3": "a2", "a4": "a3", "a5": "a4", "a6": "a5"},
						{"a1": "a5", "a2": "a6", "a3": "a1", "a4": "a2", "a5": "a3", "a6": "a4"},
						{"a1": "a4", "a2": "a5", "a3": "a6", "a4": "a1", "a5": "a2", "a6": "a3"},
						{"a1": "a3", "a2": "a4", "a3": "a5", "a4": "a6", "a5": "a1", "a6": "a2"},
						{"a1": "a2", "a2": "a3", "a3": "a4", "a4": "a5", "a5": "a6", "a6": "a1"},
						{"a1": "a1", "a2": "a2", "a3": "a3", "a4": "a4", "a5": "a5", "a6": "a6"}
						];

	CorrespondenciasV = [
						{"b1": "b6", "b2": "b1", "b3": "b2", "b4": "b3", "b5": "b4", "b6": "b5"},
						{"b1": "b5", "b2": "b6", "b3": "b1", "b4": "b2", "b5": "b3", "b6": "b4"},
						{"b1": "b4", "b2": "b5", "b3": "b6", "b4": "b1", "b5": "b2", "b6": "b3"},
						{"b1": "b3", "b2": "b4", "b3": "b5", "b4": "b6", "b5": "b1", "b6": "b2"},
						{"b1": "b2", "b2": "b3", "b3": "b4", "b4": "b5", "b5": "b6", "b6": "b1"},
						{"b1": "b1", "b2": "b2", "b3": "b3", "b4": "b4", "b5": "b5", "b6": "b6"}
						];
	var indiceRotacionLocal=indiceRotacionVisita= 0;	
// posiciones iniciales, global.
function controlAncho(identificadorAccesoMatrix)
{
	var anchoEncontrado =0;
	$.each(MatrixPosicionesIniciales, function(index, value) 
	{
		if(value.zona == identificadorAccesoMatrix)
		{
			return anchoEncontrado = value.AnchoIni;
		}
	});		
	return anchoEncontrado;
}

function controlAlto(identificadorAccesoMatrix)
{
	var anchoEncontrado =0;
	$.each(MatrixPosicionesIniciales, function(index, value) 
	{
		if(value.zona == identificadorAccesoMatrix)
		{
			return altoEncontrado = value.AltoIni;
		}
	});		
	return altoEncontrado;
}

// function mostrarMiPosicion(objetoId)
// {
//    var posX=$("#"+objetoId.id).position().left;
//    var posY=$("#"+objetoId.id).position().top;
//    var ancho=$("#"+objetoId.id).width();
//    var alto=$("#"+objetoId.id).height();
   

//    alert('posx= '+ posX+' posY= '+posY + ' ancho: '+ ancho+ ' alto:' +alto);
// }
function cargaInicialPosiciones(){
// necesito coonocer las posiciones iniciales y cuanto moverme desde esa posicion
	if( MatrixPosicionesIniciales.length == 0)
	{
		//alert('La matriz aun no esta cargada, asi que a laburar!');
	
	$.each(JugadoresEnCanchados, function(index, value) 
	{
		for(zona=1;zona<=6;zona++)
		{	
			unionValores = value+zona;

			// DONDE SE ENCUENTRA EN ESTE MOMENTO EL BLOQUE "unionValores"
			// OrigenX = $("#cancha"+unionValores).offset().left;	//position().left;//	offset().left ;
			// OrigenY = $("#cancha"+unionValores).offset().top ;  //.position().top; //	offset().top ;
			OrigenX = $("#cancha"+unionValores).position().left;	//position().left;//	offset().left ;
			OrigenY = $("#cancha"+unionValores).position().top ;  //.position().top; //	offset().top ;
			var anchoPosActual = $("#cancha"+unionValores).width();
			var altoPosActual = $("#cancha"+unionValores).height();	



			MatrixPosicionesIniciales.push(
			{
				"zona":unionValores,
				"PosX":OrigenX,
				"PosY":OrigenY,
				"AnchoIni":anchoPosActual,
				"AltoIni":altoPosActual
			});		
		}
	});
	var unionValores=destinoDet="";
	var diferenciaX=diferenciaY=0;
	// voy a calcular las distancias a mover cada una
	for(i=0;i< MatrixPosicionesIniciales.length;i++ )
		{
			unionValores=MatrixPosicionesIniciales[i]['zona'];	
			// OrigenX = $("#cancha"+unionValores).offset().left ; //.position().left; //	offset().left ;
			// OrigenY = $("#cancha"+unionValores).offset().top ; //.position().top;  //	offset().top ;		

			OrigenX = $("#cancha"+unionValores).position().left ; //.position().left; //	offset().left ;
			OrigenY = $("#cancha"+unionValores).position().top ; //.position().top;  //	offset().top ;		

				if(unionValores['0'] == 'a')
					destinoDet = CorrespondenciasL['0'][unionValores];
				else
					destinoDet = CorrespondenciasV['0'][unionValores];
				//console.log(destinoDet);

			// DestinoX = $("#cancha"+destinoDet).offset().left ; //	position().left	//offset().left ;
			// DestinoY = $("#cancha"+destinoDet).offset().top ; //	position().top	//offset().top ;	

			DestinoX = $("#cancha"+destinoDet).position().left ; //	position().left	//offset().left ;
			DestinoY = $("#cancha"+destinoDet).position().top ; //	position().top	//offset().top ;	

			// if(unionValores[0] == 'a' )  //sacar esta linea
				// console.log('para ' + unionValores + ' origen('+OrigenX+','+OrigenY+') y destino ' + destinoDet + '('+DestinoX+','+DestinoY+')');


			diferenciaX = DestinoX - OrigenX; // left - left
		 	diferenciaY = DestinoY - OrigenY; //top - top
			// if(unionValores[0] == 'a' )  //sacar esta linea
				// console.log('para ' + unionValores + ' la distancia inicial hacia ' + destinoDet + ' es de: X= '+ diferenciaX + 'y de Y= '+ diferenciaY );
							 
			switch(unionValores) 
			 {
				case 'b1': //abajo
					MatrixPosicionesIniciales[i]['top']=diferenciaY;
					break;
				case 'b2': //derecha
					MatrixPosicionesIniciales[i]['left']=diferenciaX;
					break;
				case 'b3'://arriba,Y
					MatrixPosicionesIniciales[i]['top']=diferenciaY;
					break;
				case 'b4'://arriba
					MatrixPosicionesIniciales[i]['top']=diferenciaY;
					break;
				case 'b5'://izquierda,X
					MatrixPosicionesIniciales[i]['left']=diferenciaX;
					break;
				case 'b6'://abajo,Y
					MatrixPosicionesIniciales[i]['top']=diferenciaY;
					break;
				case 'a1'://arriba,y
					MatrixPosicionesIniciales[i]['top']=diferenciaY;
					break;
				case 'a2'://izquierda,x		
					MatrixPosicionesIniciales[i]['left']=diferenciaX;
					break;
				case 'a3'://abajo,Y
					MatrixPosicionesIniciales[i]['top']=diferenciaY;
					break;
				case 'a4'://abajo,Y
					MatrixPosicionesIniciales[i]['top']=diferenciaY;
					break;
				case 'a5'://derecha,X
					MatrixPosicionesIniciales[i]['left']=diferenciaX;
					break;
					case 'a6'://arriba,y
					MatrixPosicionesIniciales[i]['top']=diferenciaY;
					break;
				default:
						break;
				}	
		}				
		}
	else
	{
		//alert('La matriz ya esta cargada, y me acuerdo!');
	}	

	// console.log(' Movimientos hacia la posicion inicial de cada bloque, ciclo inicial, pre 0:');
	// $.each(MatrixPosicionesIniciales, function(index, value) 
	// {
	// 		console.log('zona: '+ value.zona + ' Dif al siguiente en Y/top:' + value.top + ' Dif al siguiente en X/left:' + value.left);
	// 		console.log('X: '+value.PosX+ ' Y: ' + value.PosY );

	// });	

}								
	function ResetRotacion()
	{
		$.each(MatrixPosicionesIniciales, function(index, value) 
		{
			var unionValores=value['zona'];	
				// CAMBIAR ESTO:
				//correspondenciasL y V en posicion 0 tiene que ir aca
				 $("#cancha"+unionValores).css('top', value['PosY'] + 'px');
				 $("#cancha"+unionValores).css('left',value['PosX'] + 'px'); 
		});	
	}

	function animarRotacion(avance)
	{
	// consigo las coordenadas antes de cambiar de cada elemento.
	// Obtén las coordenadas del segundo elemento

	//			var MatrixPosicionesActuales = new Array();
	//			var indicePosiciones=0;
	//			var TotalItems = $("#contadorItemsVer").text();
	// recorro todas las posicines existentes:a1->a6 y b1 -> b6
	// y segun en que ciclo de la rotacion me encuentre, uno para cada equipo
	// es a donde dirijo cada DIV
	var topCargado=leftCargado=0;
	//console.log('avanzar sobre top: ' + avance);
	$.each(JugadoresEnCanchados, function(index, value) 
		{
			for(zona=1;zona<=6;zona++)
			{	
				unionValores = value+zona;
				// ubico el destino al que tiene que ir el bloque "unionValores"
				// pero necesito ubicarlo desde DONDE ME ENCUENTRO AHORA...
				// SI ES A1, EN LA ROTACION INICIAL, SE VA A ENCONTRAR EN A1. ANTES DE ROTAR, EN "START"
				// SI ES A1, EN ROTACION=0, SE ENCONTRARÁ EN A1 Y TIENE QUE IR A A6.
				// SI ES A1, EN ROTACION=1, SE ENCONTRARÁ EN A6(ROTACION=0) Y TIENE QUE IR A A5. !!!
				// el indice de Correspondencias va de 0 a 5.
				if(value == 'a')
				{	
						if(indiceRotacionLocal == 0 )
							destinoDet = CorrespondenciasL[5][unionValores];
						else	
							destinoDet = CorrespondenciasL[(indiceRotacionLocal-1)][unionValores];
				}
						//destinoDet deberia ser un vector asociado de unionValores con (x,y,destino, distancia)
				else
				{
						if(indiceRotacionLocal == 0 )
							destinoDet = CorrespondenciasV[5][unionValores];
						else
							destinoDet = CorrespondenciasV[(indiceRotacionVisita-1)][unionValores];
				}
						//	activo la posibilidad de movimiento		
					$("#cancha"+unionValores).css({'position': 'relative'});
				
				$.each(MatrixPosicionesIniciales, function(index, value) 
				{
					//  if(unionValores == 'a1')
					//  {
						// al obtener el lugar  en donde me encuentro (destinoDet), puedo saber en forma correcta a donde ir...
					if(value.zona == destinoDet)
					{
						// console.log(' indice de rotacion: ' + indiceRotacionLocal);
						// console.log(' a: ' + unionValores + ' le toca moverse a:'+ destinoDet + ' ' + ' px');

							if( value.hasOwnProperty('top'))
							{
								// console.log(' moverlo por top : ' + value.top + ' px');
							//topCargado =avance;//	 value.PosY+value.top;
							if(avance == 0)
								topCargado = value.top;
							else
							topCargado = avance;
							// 'width': value.AnchoIni + 'px',
							// 	'height': value.AltoIni + 'px'
							altoDestino 	    = controlAlto(destinoDet); //donde estoy, se esta yendo a :
							anchoDestino        = controlAncho(destinoDet);   // aca. 		
								anchoDefinitivo = anchoDestino;
								altoDefinitivo  = altoDestino;

							// if(anchoOrigen < anchoDestino)
							// 	anchoDefinitivo = anchoDestino;
							// else
							// 	anchoDefinitivo = 0;		
							$("#cancha"+unionValores).animate({
								'top': '+=' + topCargado + 'px',
								 'width': anchoDefinitivo + 'px',
								 'height': altoDefinitivo + 'px'

							},
								 1000); // 1000 es la duración en milisegundos de la animación						
							DestinoX = $("#cancha"+unionValores).position().left	//offset().left ;
							DestinoY = $("#cancha"+unionValores).position().top		//offset().top ;	
							// console.log('X= ' +DestinoX + ' Y= '+DestinoY);
							}
							else
							{
								// console.log(' moverlo por left : ' + value.left + ' px');
							leftCargado = value.left;	
							// 'width': value.AnchoIni + 'px',
							// 	'height': value.AltoIni + 'px'
							altoDestino 		= controlAlto(destinoDet); //donde estoy, se esta yendo a :
							anchoDestino        = controlAncho(destinoDet);   // aca. 		
								anchoDefinitivo = anchoDestino;
								altoDefinitivo  = altoDestino;
							// if(anchoOrigen < anchoDestino)
							// 	anchoDefinitivo = anchoDestino;
							// else
							// 	anchoDefinitivo = 0;		
							$("#cancha"+unionValores).animate({
								'left'   : '+=' + value.left + 'px',
								'width'  : anchoDefinitivo + 'px',
								 'height': altoDefinitivo + 'px'
							}, 1000); // 1000 es la duración en milisegundos de la animación						
							}
					}
					//  }
				});	

			}
		});		

		indiceRotacionLocal++;
		indiceRotacionVisita++;
		if(indiceRotacionLocal  ==6) indiceRotacionLocal=0;
		if(indiceRotacionVisita ==6) indiceRotacionVisita=0;

	}

	function obtenerLogoCompetencia(idlogocompetencia,imagenlogocompetencia)
	{
		if(imagenlogocompetencia != '')
		{
			imagenlogocompetencia = imagenlogocompetencia.replace(/'/g, "");	//.slice(1).slice(0,-1);
			if(imagenlogocompetencia != "")
				$("#"+idlogocompetencia).html('<img  src="'+"img/competencias/"+imagenlogocompetencia+'" class="imglogocompetencia" id="'+idlogocompetencia+'IMG" name="'+imagenlogocompetencia+'"></img>'); 

		}
		else
			// alert('no hay logo para la competencia...');
				$(".itemTablero1A").hide();

 	}
 		
	function chequeoActualizacionAutomatica(){

		var parametros =
	 {
		"id" : <?php echo($_GET['id']);?>,
		"fechapart"    : <?php echo("'".$_GET['fecha'])."'";?>,
	  };
			
     $.ajax({ 
        url:   './abms/verifica_partido.php',
        type:  'GET',
        data: parametros,
        dataType: 'json',
        beforeSend: function (){},
        done: function(data){},
        success:  function (r){
        	//alert(r['Partido'].estado);
				$("#estadoLocal").val(r['Partido'].estado);
      },
         error: function (xhr, ajaxOptions, thrownError) {
		// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
		}
    	}); // FIN funcion ajax 
      };
//FIN FUNCION CHEQUEO ESTADO partido			

	function calculoTiempoRestante(inicio,fin){
		
	  var resultado='';
	  inicioMinutos = parseInt(inicio.substr(3,2));
	  inicioHoras = parseInt(inicio.substr(0,2));
	  
	  
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


//cronometro dentro del tablero:
function muestraTiempoTranscurrido()
{

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
		
		var tiempoTxt = tiempoTxtHora +':' + tiempoTxtMin +':' + tiempoTxtSeg ;
		var tiempoSinSegs = tiempoTxtHora +':' + tiempoTxtMin;
		var horaDesde = $("#HoraInicial").val();
		TiempoTranscurridoActual = calculoTiempoRestante(horaDesde,tiempoSinSegs);		
		$("#stopwatch").text("Hora Actual: "+ tiempoTxt + " transcurridos: "+TiempoTranscurridoActual);}, 1000); //funcion setinterval..
//cronometro denro del tablero:			
}	


	function buscar(vectorCentrales,idjugadorBuscado,objetoCambio)
	{
		$(vectorCentrales).each(function(j, w)
								{ // indice =j ,0 valor = w
									if (w.idjugador == idjugadorBuscado )
										$(objetoCambio).attr('class', 'gridCancha colorCentral');	

								});	
	}

	function buscarLibero(vectorLiberos,idjugadorBuscado,objetoCambio)
	{
		$(vectorLiberos).each(function(j, w)
								{ // indice =j ,0 valor = w
									if (w.idjugador == idjugadorBuscado )
										$(objetoCambio).attr('class', 'gridCancha libero');	

								});	
	}


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
				//$(idescudoclub).html('');
    		},
            done: function(data){
            	
			},
            success:  function (r){
				var re = JSON.parse(r);
				//console.log(re['escudo']);
				var escudoSpan		 = '';
				var cierreEscudoSpan = '';

				//console.log($("#"+idescudoclub+'IMG') );
				//	console.log('YA ESTABA CARGADO EL ESCUDO');
				//else console.log('PRIMERA VEZ QUE LO CARGABA');	

				
				if(re['escudo'] !='')
				{
									
					$("#"+idescudoclub).html(escudoSpan+'<img  src="'+"img/escudos/"+re['escudo']+'" class="imgjugadorTablero '+claseSaque+'" id="'+idescudoclub+'IMG" name="'+re['clubabr']+'"></img>'+cierreEscudoSpan); 
				}
    			else            	
    				$(idescudoclub).html('<img  src="img/jugadorGen.png" class="imgjugadorTablero" name="GENERICO"></img>'); 
            },
             error: function (xhr, ajaxOptions, thrownError) 
             {
			 }
            });

 	}

	function refrescarTablero(){

		// $.each(MatrixPosicionesIniciales, function(index, value) 
		// {
		// 	$.each(value, function(endex,veley)
		// 	{
		// 		console.log(endex +' '+veley);
		// 	});
		// });	
	
		estadoPartido = $("#estadoLocal").val();

		var cantSets = 0;
		var setNumero =0;
		<?php 
				if(isset($_GET['set']))
					echo("setNumero = ".$_GET['id']).";";
		?>
		var parametros =
	 {
		"id" : <?php echo($_GET['id']);?>,
		"fechapart"    : <?php echo("'".$_GET['fecha'])."'";?>,
		 "setNum"	   : setNumero
		 };
	if(!estadoPartido.includes('FIN'))
	{
     $.ajax({ 
        url:   './abms/obtener_partidos.php',
        type:  'GET',
        data: parametros,
        dataType: 'json',
        beforeSend: function (){},
        done: function(data){},
        success:  function (r){

          $(r['Partido']).each(function(i, v)
            { // indice, valor		
            	//console.log(r);

					var resultadosParciales =   '<section class="xpunto21">'+
												'<div class="" id="setsganadosA">'+
												'</div>'+		
												'</section>';
	 					var ESCUDOA = '<span id="escudoAMarco" class="'+escudoAMarco+'"><img  src="img/jugadorGen.png" class="imgjugadorTablero2" ></img></span>';
	 					var textoClubA ='<div class="grillaIdClub">'+resultadosParciales+'<div class="itmidclub3a" id="escudoA">'+ESCUDOA+'</div><div class="itmidclub1a">'+v.ClubA+'</div></div>';
		 					var ESCUDOB = '<span id="escudoBMarco" class="'+escudoBMarco+'"><img  src="img/jugadorGen.png" class="imgjugadorTablero2" ></img></span>';
						 resultadosParciales =   '<section class="xpunto21">'+
												'<div class="" id="setsganadosB">'+
												'</div>'+		
												'</section>';							
	 					var textoClubB  = '<div class="grillaIdClub"><div class="itmidclub1a">'+v.ClubB+'</div><div class="itmidclub3a" id="escudoB" >'+ESCUDOB+'</div>'+resultadosParciales+'</div>';
	// 					obtenerEscudo(v.idcluba,"escudoA",escudoAMarco) ;
	// 					obtenerEscudo(v.idclubb,"escudoB",escudoBMarco) ;
			
	 					$("#clublocal").empty();
		 				$("#clublocal").append(textoClubA);
	 					$("#clubvisitante").empty();
	 					$("#clubvisitante").append(textoClubB);						

							
				
	            obtenerLogoCompetencia("ilogoCompetencia",v.logocompetencia);	
				var alta='';
				$("#mensajes3").text(v.Fecha);

				cantSets = Number(v.ClubARes,10)+Number(v.ClubBRes,10);
				var escudoAMarco=escudoBMarco="NoBorde";//		"NoBorde";
			    if(v.estado.includes('PROGR')) var img = './img/PartidoONOFFSQR.png';
			    if(v.estado.includes('LLUVI')) var img = './img/rain-icon-png.jpg';
				if(v.estado.includes('FIN'))
				{ 
					var img = './img/PartidoOFFSQR.jpg';
					$("#setActivo").text('Fin del Partido.');
					$("#SetActivoData").text('Se jugaron Sets:');
				}
				else
				{
					muestraTiempoTranscurrido();				
				}
	            
	            if(v.estado.includes('CURSO')) var img = './img/PartidoONSQR.png';
				//no tengo mas la imagen del estado partido
//                $("#imgEstado").prop("src",img);
//                $("#imgEstado").prop("title",v.estado);
                		//$("#fecha").text(v.cnombre+' - Fecha: '+v.Fecha);
                		$("#NombreCompetencia").text(v.cnombre);
                		//$("#cancha").text(v.cancha+'('+v.nombre+')');
                		$("#cancha").text(v.cancha);
               			$("#ciudad").text(v.nombre);
               				
                		$("#fecha").text('Partido Nro ('+r['Partido'].descripcionp+' - '+ v.idPartido +') - Inicio '+v.Inicio);
						//r['saque']
						
						$("#categoriaTwitch").text(v.DescCate);

						
						if(  r.hasOwnProperty('estadoSet') )
						{

							if(r['estadoSet'].includes('CURSO') || r['estadoSet'].includes('CONFIGURACION INICIAL') )
							{
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
							};
						}
			
						//Aca se borra el escudo !!!
						obtenerEscudo(v.idcluba,"escudoA",escudoAMarco) ;
						obtenerEscudo(v.idclubb,"escudoB",escudoBMarco) ;
						
					//console.log(hayEscudos);	
						//alert($("#escudoAMarco").attr("class") );
						//$("#escudoBM+arco").attr("class", "NoBorde"); 

						$("#numSetA").text(v.ClubARes);
						$("#numSetB").text(v.ClubBRes);

			 });

//LOCALES..
			var bloqueJugador = "";
// CHEQUEAR SI VIENE EN FALSE  O VACIO COMPLETAR CON VALOR GENERICO 
// O MENSAJE "NO CARGADO"
			var  colorBase = "";
			var Suplentes =	'';

			$(r['SuplentesA']).each(function(i, v)
         	 { // indice, valor
				//alert(v.puestoxcat);
				var colorFondo = 'style="backGround:#000;"';
						 puestoPosta =v.puestoxcat;	
						 puestoCategoria=v.puestoxcat;
					 colorFondo = 'style="backGround:'+v.ColorPuestoCat+';"';

					 if(v.puestoxcat != v.puesto)
						{
							 puestoPosta = v.puesto;
							 colorFondo = 'style="backGround:'+v.ColorPuestoCancha+';"';
						}

				//CARGAR INDICADOR DE PUESTO ACTUAL 
						botonCentral='';	
						//BOTONES DE COLOR Y NOMBRE DE PUESTO AL LADO EN CARGA INICIAL
						// ES PUNTA
						if(puestoPosta == 4)						
						{
							//contador++;
							//alert(v.nombre+ ' ES UN ARMADOR, POR '+contador+ ' VEZ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="punta" class="itemcjug3VER punta"'+colorFondo+' title="marcar central al jugador" >{P}</button>';
						}
						
						// ES CENTRAL
						if(puestoPosta == 6){
							//alert(v.nombre+ ' ES UN central ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="central" class="itemcjug3VER central"'+colorFondo+' title="marcar central al jugador" >{C}</button>';
						}						
						
						if(puestoPosta == 3)	//ARMADOR..					
						{
							//contador++;
							//alert(v.nombre+ ' ES UN ARMADOR, POR '+contador+ ' VEZ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="armador" class="itemcjug3VER armador"'+colorFondo+' title="marcar armador al jugador" >{a}</button>';							
						}
						if(puestoPosta == 5)	//OPUESTO..
						{
							//alert(v.nombre+ ' ES UN opuesto ' );							
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="opuesto" class="itemcjug3VER opuesto"'+colorFondo+' title="marcar opuesto al jugador" >{o}</button>';
						}					

						if(puestoPosta == 2){	//libero..
							//alert(v.nombre+ ' es un libero ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="libero" class="itemcjug3VER libero"'+colorFondo+' title="marcar opuesto al jugador" >{L}</button>';
						}	
						if(puestoPosta == 8){	//"no importa"
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="libero" class="itemcjug3VER libero"'+colorFondo+' title="marcar opuesto al jugador" >{-}</button>';
						}	
						// por sino tiene posicion asignada..el primer item de la grilla le saco el puesto 
						// para que no se muestre mal 	
						var item1Existe = '	<div class="itemtblju1VER">'+botonCentral+'</div>'; 		
						//if(botonCentral == '') item1Existe = '';

				var textoBuscado = "Arreglo";
				//no muestro aca a los liberos.. puestoPosta != 2
				if(v.nombre.indexOf(textoBuscado) == -1 && puestoPosta != 2)
				{
				//CARGAR INDICADOR DE PUESTO ACTUAL 
				Suplentes += '<div class="itemtbljuVER">'+
								item1Existe+
							'	<div class="itemtblju2VER">'+v.nombre+'</div>'+
							'	<div class="itemtblju3VER">('+v.numero+')</div>'+
							'	<div class="itemtblju4VER"></div>'+
							'	<div class="itemtblju5VER"></div>'+
							'</div>'
				}		
				});

				$("#verSuplentesA").html(Suplentes);
				Suplentes='';
				$(r['SuplentesB']).each(function(i, v)
         	 { // indice, valor
				//alert(v.puestoxcat);
				var colorFondo = 'style="backGround:#000;"';
						 puestoPosta =v.puestoxcat;	
						 puestoCategoria=v.puestoxcat;
					 colorFondo = 'style="backGround:'+v.ColorPuestoCat+';"';

					 if(v.puestoxcat != v.puesto)
						{
							 puestoPosta = v.puesto;
							 colorFondo = 'style="backGround:'+v.ColorPuestoCancha+';"';
						}

				//CARGAR INDICADOR DE PUESTO ACTUAL 
						botonCentral='';	
						//BOTONES DE COLOR Y NOMBRE DE PUESTO AL LADO EN CARGA INICIAL
						// ES PUNTA
						if(puestoPosta == 4)						
						{
							//contador++;
							//alert(v.nombre+ ' ES UN ARMADOR, POR '+contador+ ' VEZ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="punta" class="itemcjug3VER punta"'+colorFondo+' title="marcar central al jugador" >{P}</button>';
						}
						
						// ES CENTRAL
						if(puestoPosta == 6){
							//alert(v.nombre+ ' ES UN central ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="central" class="itemcjug3VER central"'+colorFondo+' title="marcar central al jugador" >{C}</button>';
						}						
						
						if(puestoPosta == 3)	//ARMADOR..					
						{
							//contador++;
							//alert(v.nombre+ ' ES UN ARMADOR, POR '+contador+ ' VEZ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="armador" class="itemcjug3VER armador"'+colorFondo+' title="marcar armador al jugador" >{a}</button>';							
						}
						if(puestoPosta == 5)	//OPUESTO..
						{
							//alert(v.nombre+ ' ES UN opuesto ' );							
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="opuesto" class="itemcjug3VER opuesto"'+colorFondo+' title="marcar opuesto al jugador" >{o}</button>';
						}					

						if(puestoPosta == 2){	//libero..
							//alert(v.nombre+ ' es un libero ' );
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="libero" class="itemcjug3VER libero"'+colorFondo+' title="marcar opuesto al jugador" >{L}</button>';
						}	

						if(puestoPosta == 8){	//"no importa"
							botonCentral='<button id="central_pos_'+v.idjugador+'" name="libero" class="itemcjug3VER libero"'+colorFondo+' title="marcar opuesto al jugador" >{-}</button>';
						}	


				var item1Existe = '	<div class="itemtblju1VER">'+botonCentral+'</div>'; 		
//				if(botonCentral == '') item1Existe = '';

				//CARGAR INDICADOR DE PUESTO ACTUAL
				var textoBuscado = "Arreglo";
				//no muestro aca a los liberos.. puestoPosta != 2
				if(v.nombre.indexOf(textoBuscado) == -1 && puestoPosta != 2)
				{
					Suplentes += '<div class="itemtbljuVER">'+
									item1Existe+
								'	<div class="itemtblju2VER">'+v.nombre+'</div>'+
								'	<div class="itemtblju3VER">('+v.numero+')</div>'+
								'	<div class="itemtblju4VER"></div>'+
								'	<div class="itemtblju5VER"></div>'+
								'</div>'
					}
				});

			   $("#verSuplentesB").html(Suplentes);
			   	
				// TAMBIEN DIVIDIR EL CONTENBIDO DEL POSICION JUGADOR EN POS Y NOMBRE REMERA
				if( !r.hasOwnProperty('pa_1')) 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(I)</div>'+
											'<div class="canchajugitem2">No Cargado</div>'+
										'</div>';
					colorBase = "#00abe3";										
				}
				else 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(I)</div>'+
											'<div class="canchajugitem2">'+r['pa_1'].jugx+'</div>'+
										'</div>';
					colorBase = r['pa_1'].puestoColor;					
				}

				// $("#canchaa1").fadeOut(1000, function() {
			    //   // Actualizar el contenido del div
				// 	  	$("#canchaa1").html(bloqueJugador);
				// 		$('#canchaa1').attr('style', 'backGround:'+colorBase);
      			// // Mostrar el div con fadeIn
				// 	    $("#canchaa1").fadeIn(1000);
			    // });
  				
				$("#canchaa1").html(bloqueJugador); 
				$('#canchaa1').attr('style', 'backGround:'+colorBase);

				if( ! r.hasOwnProperty('pa_2')) 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(II)</div>'+
											'<div class="canchajugitem2">No Cargado</div>'+
										'</div>';
										colorBase = "#00abe3";																				
				}
				else 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(II)</div>'+
											'<div class="canchajugitem2">'+r['pa_2'].jugx+'</div>'+
										'</div>';
					colorBase = r['pa_2'].puestoColor;					

				}
				$("#canchaa2").html(bloqueJugador); 
				$('#canchaa2').attr('style', 'backGround:'+colorBase);

				if( ! r.hasOwnProperty('pa_3')) 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(III)</div>'+
											'<div class="canchajugitem2">No Cargado</div>'+
										'</div>';
										colorBase = "#00abe3";																				
				}
				else 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(III)</div>'+
											'<div class="canchajugitem2">'+r['pa_3'].jugx+'</div>'+
										'</div>';
					colorBase = r['pa_3'].puestoColor;															
				}
				$("#canchaa3").html(bloqueJugador); 
				$('#canchaa3').attr('style', 'backGround:'+colorBase);

				if( ! r.hasOwnProperty('pa_4')) 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(IV)</div>'+
											'<div class="canchajugitem2">No Cargado</div>'+
										'</div>';
					colorBase = "#00abe3";																				
				}
				else 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(IV)</div>'+
											'<div class="canchajugitem2">'+r['pa_4'].jugx+'</div>'+
										'</div>';
						colorBase = r['pa_4'].puestoColor;															
				}
				$("#canchaa4").html(bloqueJugador); 
				$('#canchaa4').attr('style', 'backGround:'+colorBase);

				if( ! r.hasOwnProperty('pa_5')) 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(V)</div>'+
											'<div class="canchajugitem2">No Cargado</div>'+
										'</div>';
					colorBase = "#00abe3";																				
				}
				else 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(V)</div>'+
											'<div class="canchajugitem2">'+r['pa_5'].jugx+'</div>'+
										'</div>';
					colorBase = r['pa_5'].puestoColor;															
				}
				$("#canchaa5").html(bloqueJugador); 
				$('#canchaa5').attr('style', 'backGround:'+colorBase);

				if( ! r.hasOwnProperty('pa_6')) 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(VI)</div>'+
											'<div class="canchajugitem2">No Cargado</div>'+
										'</div>';
					colorBase = "#00abe3";																				
				}
				else 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(VI)</div>'+
											'<div class="canchajugitem2">'+r['pa_6'].jugx+'</div>'+
										'</div>';
					colorBase = r['pa_6'].puestoColor;					
				}	
				$("#canchaa6").html(bloqueJugador); 
				$('#canchaa6').attr('style', 'backGround:'+colorBase);

				// FIN LOCALES..	

//VISITANTE
			 	if( ! r.hasOwnProperty('pb_1')) 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(I)</div>'+
											'<div class="canchajugitem2">No Cargado</div>'+
										'</div>';
					colorBase = "#00abe3";																				
				}
				else 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(I)</div>'+
											'<div class="canchajugitem2">'+r['pb_1'].jugx+'</div>'+
										'</div>';
					colorBase = r['pb_1'].puestoColor;															
				}	
				$("#canchab1").html(bloqueJugador); 
				$('#canchab1').attr('style', 'backGround:'+colorBase);

				if(! r.hasOwnProperty('pb_2')) 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(II)</div>'+
											'<div class="canchajugitem2">No Cargado</div>'+
										'</div>';
					colorBase = "#00abe3";																				
				}
				else 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(II)</div>'+
											'<div class="canchajugitem2">'+r['pb_2'].jugx+'</div>'+
										'</div>';
					colorBase = r['pb_2'].puestoColor;															

				}		
				$("#canchab2").html(bloqueJugador); 
				$('#canchab2').attr('style', 'backGround:'+colorBase);

				if(! r.hasOwnProperty('pb_3')) 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(III)</div>'+
											'<div class="canchajugitem2">No Cargado</div>'+
										'</div>';
					colorBase = "#00abe3";																				
				}
				else 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(III)</div>'+
											'<div class="canchajugitem2">'+r['pb_3'].jugx+'</div>'+
										'</div>';
					colorBase = r['pb_3'].puestoColor;															

				}	
				$("#canchab3").html(bloqueJugador); 
				$('#canchab3').attr('style', 'backGround:'+colorBase);

				if( ! r.hasOwnProperty('pb_4')) 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(IV)</div>'+
											'<div class="canchajugitem2">No Cargado</div>'+
										'</div>';
					colorBase = "#00abe3";																				
				}
				else 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(IV)</div>'+
											'<div class="canchajugitem2">'+r['pb_4'].jugx+'</div>'+
										'</div>';
					colorBase = r['pb_4'].puestoColor;															

				}	
				$("#canchab4").html(bloqueJugador); 
				$('#canchab4').attr('style', 'backGround:'+colorBase);

				if(! r.hasOwnProperty('pb_5')) 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(V)</div>'+
											'<div class="canchajugitem2">No Cargado</div>'+
										'</div>';
					colorBase = "#00abe3";																				
				}
				else 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(V)</div>'+
											'<div class="canchajugitem2">'+r['pb_5'].jugx+'</div>'+
										'</div>';
					colorBase = r['pb_5'].puestoColor;															

				}
				$("#canchab5").html(bloqueJugador); 
				$('#canchab5').attr('style', 'backGround:'+colorBase);

				if( ! r.hasOwnProperty('pb_6')) 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(VI)</div>'+
											'<div class="canchajugitem2">No Cargado</div>'+
										'</div>';
					colorBase = "#00abe3";																				
				}
				else 
				{
					bloqueJugador = '<div class="canchajugadoritem">'+
											'<div class="canchajugitem1">(VI)</div>'+
											'<div class="canchajugitem2">'+r['pb_6'].jugx+'</div>'+
										'</div>';
					colorBase = r['pb_6'].puestoColor;															

				}
				$("#canchab6").html(bloqueJugador); 
				$('#canchab6').attr('style', 'backGround:'+colorBase);


//fin VISITANTES..
					$("#liberosA").html('');
					contlibA='';
					$("#liberosB").html('');
					contlibB='';

					$(r['LiberosA']).each(function(j, w)
						{ // indice =j ,0 valor = w
								//console.log('indice : ' + j + ' valor : ' +w);
								if (! $('#liberosA').find("div[value='" + w.nombre + "']").length){
									contlibA +='<div class="itemL"  value="'+w.nombre +'"   >'+w.nombre +'('+w.numero+')' +'</div>';
								}
						});	
					  $("#liberosA").html(contlibA);	

				   $(r['LiberosB']).each(function(j, w)
								{ // indice =j ,0 valor = w
					//			console.log(w);
									if (! $('#liberosB').find("div[value='" + w.nombre + "']").length){
										contlibB +='<div class="itemL"  value="'+w.nombre +'"   >'+w.nombre +'('+w.numero+')' +'</div>';
									}
								});	
						$("#liberosB").html(contlibB);	

				var puntosFormateado = '';
					puntosFormateado= r['puntoa'] < 9 ? "0"+r['puntoa'] : r['puntoa'];				
				$("#puntosA").text(puntosFormateado);  //r['puntoa'] 
					puntosFormateado= r['puntob'] < 9 ? "0"+r['puntob'] : r['puntob'];				
				$("#puntosB").text(puntosFormateado); //r['puntob']
        	  	
        	  	$("#tiempoTot").text(r['transcurrido']);
        	  	 
        	  	$("#HoraInicial").val(r['horainicio']);
				$("#mensajes").text(r['mensajeSet']);
				
				if(r['mensajeSet']=='Fin del set')
						if( !( r['Partido'].estado.includes('FIN'))   )			
						 					{$("#setActivo").text('Termino Set');}
						else 
						{
						 $("#setActivo").text('Fin del Partido');	
						$("#SetActivoData").text('Se jugaron '+cantSets +' sets');
						}

				else {$("#setActivo").text('SET ACTIVO');}
						
				if(r['tiempoPedidoA'] == 1)
				{
						$("#tiempoA1").css("background","#DC0A89");
				};
						
				if(r['tiempoPedidoA'] == 0)
				{
				   $("#tiempoA1").css("background","#DC0A89");	
				   $("#tiempoA2").css("background","#DC0A89");
				};
				if(r['tiempoPedidoB'] == 1)	
				{
				   $("#tiempoB1").css("background","#DC0A89");
				};
				if(r['tiempoPedidoB'] == 0)
					{
					    $("#tiempoB1").css("background","#DC0A89");	
					    $("#tiempoB2").css("background","#DC0A89");
					};				
				
				
			//$("#mensajes3").text();		
				if(r['Partido'].estado.includes('FIN')) $("#mensajes2").text('.: Partido finalizado :.');			
					
			//http://localhost/volleyAPP/abms/obtener_sets.php?idpartido=1&idfecha=2018-08-25	
			/*********LEVANTAR INFO DE LOS SETS***************************************************/
				// la fecha esta yendo con comillas...
				$("#setsganados").empty();
				var setNumero20 =0;
				<?php 
						if(isset($_GET['set']))
							echo("setNumero20 = ".$_GET['id']).";";
				?>
				
				var parametros =
				{
					"idpartido" : <?php echo($_GET['id']);?>,
					"idfecha"    : <?php echo("'".$_GET['fecha'])."'";?>,
					"setNum"	   : setNumero20
				};
		 
			     $.ajax({ 
			        url:   './abms/obtener_sets_twitch.php',
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
			        	$("#setsganadosA").empty();
						$("#setsganadosB").empty();

						$(".PosicionesInicialesA").empty();
						$(".PosicionesInicialesB").empty();

			            $(r['Sets']).each(function(i, v){ // indice, valor				

							if(v.mensaje=='Fin del set'){
								if(parseInt(v.puntoa,10) >= parseInt(v.puntob,10))
									$("#setsganadosA").append('<div class="parciales"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div>');
								if(parseInt(v.puntoa,10) <= parseInt(v.puntob,10))
									$("#setsganadosB").append('<div class="parciales"><span class="parcial">L:'+v.puntoa+' 	V:'+v.puntob+'</span></div>');
							
							}
							else{
							var jugando='<section class="puntoJugando21">'+
									'<div class="" id="setsjugandosA">'+
										'<div class="parcialesj"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div></div>'+
									 '</section>';
							//$("#categoriaTwitch").append(jugando);
							}
	  			      		
	  			      		if(v.mensaje != 'Fin del set')
	  			      			$("#periodo").text(v.setnumero+" set ");
	  			      		else
	  			      			$("#periodo").text('');
							//POR SET SE REPITE LA MISMA ESTRUCTURA
							var textoPosSets ='<div class="TituloTablaPIiniA">'+
											  '<div>POS.INI. LOCAL SET '+v.setnumero+'</div>'+
											  '</div>';

							$(v.PosicionInicialLocal).each(function(y, z){ // indice, valor
								//valores:"numero":1114,"nombre":"jugador_1114","categoria":19,"idjugador":4,
										//   "posicionini":1,"idclub":88,"posicion":1,"activoSN":null,
										//   "puestoxcat":8,"ColorPuestoCat":"","puesto":"8","ColorPuestoCancha":"",
										//   "secuencia":1,"FechaEgreso":null,"Orden":null
								var nombrePosicion = 'Sup';
								nombrePosicion = detectarIcono(z.puestoxcat,z.puesto) ;
								colorFondo 	   = detectarColor(z.ColorPuestoCat,z.ColorPuestoCancha,z.puestoxcat,z.puesto);
								var numeroOk = (z.numero < 10 ) ? '0'+z.numero: z.numero;
								var ubicacionCancha = (z.posicionini == 7) ? 'Suplente' : ('Pos '+ z.posicionini); 
								
								textoPosSets +=  '<div class="ijugadorEnPos">'+
												'		<div class="itemcjug4VER redondo" '+colorFondo+' id="jugadorubi_'+z.idclub+'_'+z.idjugador+'_'+z.categoria+'_'+z.posicionini+'" name="jugadorubi_'+z.idclub+'_'+z.idjugador+'_'+z.categoria+'_'+z.posicionini+'">'+
													nombrePosicion+'</div>'+
												 '		<span class="itemcjug1VER NumeroJugador">'+numeroOk+'</span>'+
												 '		<span class="itemcjug2VER nombreJugador">'+z.nombre+'</span>'+
												 '<div>'+ ubicacionCancha+'</div>'+
												'</div>';
							});
								textoPosSets += '</div>';
							//$(".PosicionesInicialesA").append(textoPosSets);

							var textoPosSets ='<div class="TituloTablaPIiniA">'+
											  '<div>POS. INI. VISITA SET '+v.setnumero+'</div>'+
											  '</div>';
							$(v.PosicionInicialVisita).each(function(y, z){ // indice, valor
								//valores:"numero":1114,"nombre":"jugador_1114","categoria":19,"idjugador":4,
										//   "posicionini":1,"idclub":88,"posicion":1,"activoSN":null,
										//   "puestoxcat":8,"ColorPuestoCat":"","puesto":"8","ColorPuestoCancha":"",
										//   "secuencia":1,"FechaEgreso":null,"Orden":null
								var nombrePosicion = 'Sup';
								nombrePosicion = detectarIcono(z.puestoxcat,z.puesto);
								colorFondo 	   = detectarColor(z.ColorPuestoCat,z.ColorPuestoCancha,z.puestoxcat,z.puesto);
								var numeroOk = (z.numero < 10 ) ? '0'+z.numero: z.numero;
								var ubicacionCancha = (z.posicionini == 7) ? 'Suplente' : ('Pos '+ z.posicionini); 

								textoPosSets +=  '<div class="ijugadorEnPos">'+
												'		<div class="itemcjug4VER redondo" '+colorFondo+' id="jugadorubi_'+z.idclub+'_'+z.idjugador+'_'+z.categoria+'_'+z.posicionini+'" name="jugadorubi_'+z.idclub+'_'+z.idjugador+'_'+z.categoria+'_'+z.posicionini+'">'+
												 nombrePosicion+'</div>'+								
												 '		<span class="itemcjug1VER NumeroJugador">'+numeroOk+'</span>'+
												 '		<span class="itemcjug2VER nombreJugador">'+z.nombre+'</span>'+
												 '<div>'+ ubicacionCancha+'</div>'+
												'</div>';
							});
							textoPosSets += '</div>';
							//$(".PosicionesInicialesB").append(textoPosSets);

	  			      	}); // INFORMACION SOBRE SETS FINALIZADOS
	  			    },
			         error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					}
			        }); // FIN funcion ajax 			
			
			/*********LEVANTAR INFO DE LOS SETS***************************************************/
			//cargaInicialPosiciones();	
      },
         error: function (xhr, ajaxOptions, thrownError) {
		// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
		}
        }); // FIN funcion ajax 
    		
		}	

      };
function detectarColor(vColorPuestoCat,vColorPuestoCancha,vPuestoxcat,vPuesto){

	var colorFondo = 'style="backGround:'+vColorPuestoCat+';"';

if(vPuestoxcat != vPuesto)
   {
		colorFondo = 'style="backGround:'+vColorPuestoCancha+';"';
   }

   return colorFondo;

}          
function detectarIcono(zPuestoxcat,zPuesto){
	
	var nombrePosicion='Sup';

	puestoPosta =zPuestoxcat;	
	if(zPuestoxcat != zPuesto)
			puestoPosta = zPuesto;
	
	//BOTONES DE COLOR Y NOMBRE DE PUESTO AL LADO EN CARGA INICIAL
	// ES PUNTA
	if(puestoPosta == 4)						
	{
		//contador++;
		//alert(v.nombre+ ' ES UN ARMADOR, POR '+contador+ ' VEZ' );
		nombrePosicion='{P}';
	}
	
	// ES CENTRAL
	if(puestoPosta == 6){
		//alert(v.nombre+ ' ES UN central ' );
		nombrePosicion='{C}';
	}						
	
	if(puestoPosta == 3)	//ARMADOR..					
	{
		nombrePosicion='{A}';
	}
	if(puestoPosta == 5)	//OPUESTO..
	{
		nombrePosicion='{O}';
	}					

	if(puestoPosta == 2){	//libero..
		nombrePosicion='{L}';
	}	

	if(puestoPosta == 7){	//libero..
		nombrePosicion='Sup';
	}	

	//CARGAR INDICADOR DE PUESTO ACTUAL 
return nombrePosicion;
};

//		$(document).ready(function(){
		$(window).on('load', function() 
		{

			var height = $(window).height();
			//$('#div2').height(height);			
			// Obtener las posiciones de los elementos <div> aquí
		//   Si estás experimentando diferencias en las posiciones de los elementos <div> en el DOM después de que se dispare el evento ready de jQuery, es posible que estés enfrentando un problema relacionado con la carga y el procesamiento de los elementos en el DOM.
		//   El evento ready de jQuery se dispara cuando el DOM ha terminado de cargarse completamente, lo que significa que todos los elementos están disponibles para su manipulación. Sin embargo, esto no garantiza que los elementos hayan terminado de renderizarse en la pantalla.
		//   Es importante tener en cuenta que el proceso de renderizado en el navegador puede tomar algo de tiempo y puede estar influenciado por varios factores, como el tamaño y la complejidad de los elementos, el rendimiento del dispositivo, el contenido externo (como imágenes) y las hojas de estilo aplicadas.
		//   Para abordar este problema y asegurarte de obtener las posiciones correctas de los elementos <div> en la pantalla, puedes considerar utilizar el evento load en lugar del evento ready. El evento load se dispara cuando todos los recursos (como imágenes) también se han cargado completamente, lo que indica que el contenido está listo para ser visualizado.
			

		// DESCOMENTAR PARA ACTIVAR TABLERO !!!
			chequeoActualizacionAutomatica();
			estadoPartido = $("#estadoLocal").val();

		 if(! estadoPartido.includes('FIN'))
		 {
		 	var refreshId = setInterval(refrescarTablero, 5000);
   		 	$.ajaxSetup({ cache: false });	
	 		refrescarTablero();	
		}	
		else
			{
				refrescarTablero();	
			}
		

		var setNumero =0;
		var escudoAMarco=escudoBMarco="NoBorde";//		
		/* BUSCO LOS ESCUDOS UNA VEZ, ***/
		<?php 
				if(isset($_GET['set']))
					echo("setNumero = ".$_GET['id']).";";
		?>


	     $("#volver").on("click",function(e){
			//encotnrar quien lo llama...
				parent.history.back();
				return false;
			//			$(location).attr('href','CSets.php?id='+$.urlParam('idpartido')+'&setmax='+$.urlParam('setmax')+'&fecha='+$.urlParam('fecha'));
		});	

		// $("#animarRotado").on("click",function()
		// 	{
		// 		  animarRotacion(0); 
		// 	});


		// $("#ResetRotado").on("click",function()
		// 	{
		// 		  ResetRotacion(); 
		// 	});

		}); // end of DOCUMENT.LOAD 
	
		// $(window).on('load', function() 
		// {
  		// Obtener las posiciones de los elementos <div> aquí
		//   Si estás experimentando diferencias en las posiciones de los elementos <div> en el DOM después de que se dispare el evento ready de jQuery, es posible que estés enfrentando un problema relacionado con la carga y el procesamiento de los elementos en el DOM.
		//   El evento ready de jQuery se dispara cuando el DOM ha terminado de cargarse completamente, lo que significa que todos los elementos están disponibles para su manipulación. Sin embargo, esto no garantiza que los elementos hayan terminado de renderizarse en la pantalla.
		//   Es importante tener en cuenta que el proceso de renderizado en el navegador puede tomar algo de tiempo y puede estar influenciado por varios factores, como el tamaño y la complejidad de los elementos, el rendimiento del dispositivo, el contenido externo (como imágenes) y las hojas de estilo aplicadas.
		//   Para abordar este problema y asegurarte de obtener las posiciones correctas de los elementos <div> en la pantalla, puedes considerar utilizar el evento load en lugar del evento ready. El evento load se dispara cuando todos los recursos (como imágenes) también se han cargado completamente, lo que indica que el contenido está listo para ser visualizado.
				//alert('load');
		// 		cargaInicialPosiciones();	

		// });

	
		</script>
    </head>

    
<body>

	<div class="TableroFondoTwitch" id="tablero">
	<!-- FILA 0-->
	<div class="itemTableroTw1" id="">
			<div class="LogoContenedor">
				<img  class="LogoTwich" alt="VOLLEY.app" src="./img/vAPP23.gif">
			</div>
			<div class="" id="NombreCompetencia">COMPETENCIA:</div>
			<input type="hidden" id="estadoLocal" name="estadoLocal" value="NADA"/>
            <div class="" id="cancha">Cancha</div>
            <div class="" id="ciudad">Ciudad</div>		
			<div class="" id="categoriaTwitch">Categoria</div>
	</div>

	<div class="itemTableroTw2" id="">
				<div class="" id="clublocal">
				<div class="grillaIdClub">
					<div class="itmidclub2"></div>
					<div class="itmidclub1"></div>
				</div>
				</div>
				<div class="Tiempos">
					<div  id="tiempoA1">T1</div>
					<div  id="tiempoA2">T2</div>
				</div>
				<div class="numero" id="puntosA">##</div>
				<div class="Tiempos">
					<div  id="tiempoB1">T1</div>
					<div  id="tiempoB2">T2</div>
				</div>
				<div class="numero" id="puntosB">##</div>
				<div class="" id="clubvisitante">
					<div class="grillaIdClub">
						<div class="itmidclub2"></div>
						<div class="itmidclub1"></div>
					</div>
				</div>
				
	
	</div>  <!--itemTableroTw2 -->

	<div class="Espacioclub4" id="">
		<input id="HoraInicial" name="HoraInicial" value="" type="hidden"/>
		<div class="itclub1" id="setActivo" >SET ACTIVO</div>
		<div class="itclub2" id="periodo" >##</div>
		<div class="itclub3" id="stopwatch" >Duración final</div>
		<div class="itclub4" id="tiempoTot">##:##</div>
		<div class="itclub5" id="SetActivoData">##:##</div>
		<div class="itclub6" id="otro"></div>
	</div>		
	<div class="PosicionesInicialesTodos">
		<div class="PosicionesInicialesA">
		</div>
		<section class="TRANMISIONPRESTADA">
			<!-- <iframe width="920" height="735" src="https://www.youtube.com/embed/oK4SqRu08qY?si=kHk3jFaj1Ac2IjFG&amp;controls=0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>		 -->
		</section>
		<div class="PosicionesInicialesB">
		</div>
	</div>


 </div> <!--class="TableroFondo" id="tablero"-->
</body>
</html>

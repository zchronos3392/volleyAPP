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
		$("#stopwatch").text("Hora Actual: "+ tiempoTxt);
		$("#periodo").text(" T.Transcurrido: "+TiempoTranscurridoActual);
		
		}, 1000); //funcion setinterval..
		
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
        beforeSend: function (){
			// Bloqueamos el SELECT de los cursos
		
	},
        done: function(data){

		},
        success:  function (r){

          $(r['Partido']).each(function(i, v)
            { // indice, valor		
            	//console.log(r);
			//cargaCancha();
            //cargaCancha();	
	            obtenerLogoCompetencia("ilogoCompetencia",v.logocompetencia);	
				var alta='';
				// $("#mensajes3").text(v.Fecha);

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
                		$("#competencia").text(v.cnombre);
                		//$("#cancha").text(v.cancha+'('+v.nombre+')');
                		$("#cancha").text(v.cancha);
               			$("#ciudad").text(v.nombre);
               				
                		$("#fecha").text(r['Partido'].descripcionp+' - '+ v.idPartido+' - '+v.Fecha+' / '+v.Inicio);
						//r['saque']
						
						$("#categoria").text(v.DescCate);

						
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
						//FUNCION REFRESCAR TABLERO, CON SET TIME  INTERVAL
						puntoEspecialLOCAL = '';
						puntoEspecialVisita ='';
						
						$("#setmatchpointA").html('');
						$("#setmatchpointA").removeClass('MATCHPOINT');
						$("#setmatchpointB").html('');
						$("#setmatchpointB").removeClass('MATCHPOINT');
						$("#mensajes2").html('');
						//FUNCION REFRESCAR TABLERO, CON SET TIME  INTERVAL

						if(r["textoSpecialPnt"] != null )
							$("#mensajes2").html('<span class="mensajeSetClass">'+r["textoSpecialPnt"]+'</span>');			

						//setPoint":0,"matchPoint":0
						if(r["ClubA"] == r["setPoint"])
							if(r["setPoint"] != 0 && r["setPoint"])
									$("#setmatchpointA").html('SET POINT');

						if(r["ClubA"] == r["matchPoint"])	
							if(r["matchPoint"] != 0 && r["matchPoint"])
							{
								console.log('matchpoint value: local'+ r["matchPoint"]);
								$("#setmatchpointA").html('MATCH POINT');
								$("#setmatchpointA").addClass('MATCHPOINT');
							}

						if(r["ClubB"] == r["setPoint"])
							if(r["setPoint"] != 0  && r["setPoint"])
								$("#setmatchpointB").html('SET POINT');
							
						if(r["ClubB"] == r["matchPoint"])
								if(r["matchPoint"] != 0 && r["matchPoint"])
								{
									console.log('matchpoint value visita: '+ r["matchPoint"]);
									$("#setmatchpointB").html('MATCH POINT');
									$("#setmatchpointB").addClass('MATCHPOINT');
								}

													
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
				//saque esto para que este todo en el mismo renglon : item1Existe+' '+v.nombre+'('+v.numero+')'
				Suplentes += '<div class="itemtbljuVER">'+
								botonCentral+' <span class="nombreJugador">'+v.nombre+'('+v.numero+')'+'</span>'+
							'	<div class="itemtblju2VER"></div>'+
							'	<div class="itemtblju3VER"></div>'+
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
									botonCentral+' <div class="nombreJugador">'+v.nombre+'('+v.numero+')'+'</div>'+
								'	<div class="itemtblju2VER"></div>'+
								'	<div class="itemtblju3VER"></div>'+
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


        	  	$("#puntosA").text(r['puntoa']); 
        	  	
        	  	$("#tiempoTot").text("T.Total:  "+r['transcurrido']);
        	  	 
        	  	$("#HoraInicial").val(r['horainicio']);
				$("#puntosB").text(r['puntob']);

				if(r['mensajeSet'] != undefined)
						$("#mensajes").html('<span class="mensajeSetClass">'+r['mensajeSet']+'</span>');
				
				if(r['mensajeSet']=='Fin del set')
				{
						if( !( r['Partido'].estado.includes('FIN'))   )			
						 	{$("#setActivo").text('FINAL DEL SET');}
						else 
						{
						 	$("#setActivo").text('Fin del Partido');	
							$("#SetActivoData").text('Se jugaron '+cantSets +' sets');
						};
				}		
				//else				
					//$("#setActivo").text(r['mensajeSet']);

				
				
						
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
				
				if(r['Partido'].estado.includes('FIN')) 
				{
						var textoEstado = r['Partido'].estado ;
						var colorEstado = '';
						// if(textoEstado.includes('SUSPENDIDO')){var img = './img/PartidoSSPND.png'; colorEstado = 'Desactivado';}
						// if(textoEstado.includes('PROGR')) {var img = './img/PartidoONOFFSQR.png';colorEstado = 'Programado';}
						// if(textoEstado.includes('LLUVI')) {var img = './img/rain-icon-png.jpg';colorEstado = 'Desactivado';}
						$("#itemTablero1").removeClass('itemTablero1');
						$("#itemTablero1").addClass('itemTablero1Fin'); //removeClass para quitarla		
						// if(textoEstado.includes('CURSO')) {var img = './img/PartidoONSQR.png';colorEstado ='Cursando' ;}

					$("#mensajes2").html('<span class="mensajeSetClass '+colorEstado+' ">Partido finalizado</span>');			
				}	
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
			        	$("#setsganadosA").empty();
						$("#setsganadosB").empty();

						//console.log(r.nombre);
						//console.log(r); /*Usa esto siempre en fase de desarrollo*/             
						
						if(r['Sets'])
						{
							$(r['Sets']).each(function(i, v)
							{ // indice, valor				

								if(v.mensaje=='Fin del set')
								{
									if(parseInt(v.puntoa,10) >= parseInt(v.puntob,10))
										$("#setsganadosA").append('<div class="parciales"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div>');
									if(parseInt(v.puntoa,10) <= parseInt(v.puntob,10))
										$("#setsganadosB").append('<div class="parciales"><span class="parcial">L:'+v.puntoa+' V:'+v.puntob+'</span></div>');
								
								}
								else
								{
								var jugando='<section class="puntoJugando21">'+
										'<div class="" id="setsjugandosA">'+
											'<div class="parcialesj"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div></div>'+
										'</section>';
								//$("#categoria").append(jugando);
								}
								//$("#periodo").text('');
								if(v.mensaje != 'Fin del set')
								{
									var nombreSet = '';
									// console.log(' numero del set: ' + v.setnumero);
									// EN PRODUCCION SETNUMERO VIENE COMO TEXTO, MIENTRAS QUE EN DESARROLLO COMO NUMERO !!!!
									if(v.setnumero == 1 || v.setnumero == "1" )
												nombreSet='PRIMER SET';
									if(v.setnumero == 2 || v.setnumero == "2" )
										nombreSet='SEGUNDO SET';
									if(v.setnumero == 3 || v.setnumero == "3" )
										nombreSet='TERCER SET';
									if(v.setnumero == 4 || v.setnumero == "4" )
										nombreSet='CUARTO SET';
									if(v.setnumero == 5 || v.setnumero == "5" )
										nombreSet='QUINTO SET';
									$("#setActivo").text(nombreSet);
									//$("#periodo").text(v.setnumero+" set ");
								}
								//else
							});
					    }
						else
						{
							$("#setActivo").text(r.nombre);
							console.log("aun no se cargo nada de un set...");
						}

	  			    },
			         error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						}
			        }); // FIN funcion ajax 			
			
			/*********LEVANTAR INFO DE LOS SETS***************************************************/
			cargaInicialPosiciones();	
      },
         error: function (xhr, ajaxOptions, thrownError) {
		// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
		}
        }); // FIN funcion ajax 
    		
		}	

      };
          

//		$(document).ready(function(){
		$(window).on('load', function() 
		{
			// Obtener las posiciones de los elementos <div> aquí
		//   Si estás experimentando diferencias en las posiciones de los elementos <div> en el DOM después de que se dispare el evento ready de jQuery, es posible que estés enfrentando un problema relacionado con la carga y el procesamiento de los elementos en el DOM.
		//   El evento ready de jQuery se dispara cuando el DOM ha terminado de cargarse completamente, lo que significa que todos los elementos están disponibles para su manipulación. Sin embargo, esto no garantiza que los elementos hayan terminado de renderizarse en la pantalla.
		//   Es importante tener en cuenta que el proceso de renderizado en el navegador puede tomar algo de tiempo y puede estar influenciado por varios factores, como el tamaño y la complejidad de los elementos, el rendimiento del dispositivo, el contenido externo (como imágenes) y las hojas de estilo aplicadas.
		//   Para abordar este problema y asegurarte de obtener las posiciones correctas de los elementos <div> en la pantalla, puedes considerar utilizar el evento load en lugar del evento ready. El evento load se dispara cuando todos los recursos (como imágenes) también se han cargado completamente, lo que indica que el contenido está listo para ser visualizado.
			
		var puntoEspecialLOCAL = '';
    	var puntoEspecialVisita ='';

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
		var parametros =
	 {
		"id" : <?php echo($_GET['id']);?>,
		"fechapart"    : <?php echo("'".$_GET['fecha'])."'";?>,
		 "setNum"	   : setNumero
		 };
			
     $.ajax({ 
        url:   './abms/obtener_partidos.php',
        type:  'GET',
        data: parametros,
        dataType: 'json',
        beforeSend: function (){
			// Bloqueamos el SELECT de los cursos
		
	},
        done: function(data){

		},
        success:  function (r){
        	
          $(r['Partido']).each(function(i, v)
            { // indice, valor		

						puntoEspecialLOCAL = '<div class="itmidclub3a" id="setmatchpointA"></div>';				
						var ESCUDOA = '<span id="escudoAMarco" class="'+escudoAMarco+'"><img  src="img/jugadorGen.png" class="imgjugadorTablero2" ></img></span>';
						var textoClubA ='<div class="grillaIdClubv20">'+puntoEspecialLOCAL+'<div class="itmidclub2a" id="escudoA">'+ESCUDOA+'</div><div class="itmidclub1a">'+v.ClubA+'</div></div>';
						var ESCUDOB = '<span id="escudoBMarco" class="'+escudoBMarco+'"><img  src="img/jugadorGen.png" class="imgjugadorTablero2" ></img></span>';
						puntoEspecialVisita = '<div class="itmidclub3a" id="setmatchpointB"></div>';				
						var textoClubB  = '<div class="grillaIdClubv20">'+puntoEspecialVisita+'<div class="itmidclub2a" id="escudoB" >'+ESCUDOB+'</div><div class="itmidclub1a">'+v.ClubB+'</div></div>';
						obtenerEscudo(v.idcluba,"escudoA",escudoAMarco) ;
						obtenerEscudo(v.idclubb,"escudoB",escudoBMarco) ;
			
						$("#clublocal").empty();
						$("#clublocal").append(textoClubA);						
						$("#clubvisitante").empty();
						$("#clubvisitante").append(textoClubB);						

			
			});
		},
        error: function (xhr, ajaxOptions, thrownError){}
        });	
		/* BUSCO LOS ESCUDOS UNA VEZ, ***/
	


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

<div class="cabezal">
		<Section class="BotoneraTablero">
				<a href="index.php"><span id="medidas">
					<img  class="LogoApp" alt="VOLLEY.app" src="./img/vAPP23.gif">
				</a>
				<div  class="BotoneraTablero">
					<button id="volver" name="altajug" class="altajug" title="agregar registros"><<</button>
				</div>
		</Section>
</div> 

<div class="marcoTablero" id="tableroMarco" >
	<div class="TableroFondo" id="tablero">
	<!-- FILA 0-->
	<div class="itemTablero1" id="itemTablero1">
		<div class="itemTablero1A">
			<span id="ilogoCompetencia"	name="ilogoCompetencia" class="logoCompetencia">LOGO COMPETENCIA</span>
			<input type="hidden" id="estadoLocal" name="estadoLocal" value="NADA"/>
		</div>
		<div class="itemTablero1B">
			<div class="Competencia" id="competencia"  >COMPETENCIA:</div>
			<div class="" id="mensajes3"></div>	
			<div class="" id="fecha">FECHA</div>
			<div class="" id="categoria">Categoria</div>	
			<div class="" id="mensajes">Esperando...</div>		
			<div class="" id="mensajes2"></div>	
		</div>
	</div>
	<div class="itemTablero2" id="">
		<!-- ACA SE MUESTRAN LAS ESTADISTICAS -->
		<div class="Espacioclub" id=""> 
			<input id="HoraInicial" name="HoraInicial" value="" type="hidden"/>
			<div class="itclub1" id="setActivo" >SET ACTIVO</div>
		    <div class="itclub2" id="periodo" >##</div>
			<div class="itclub3" id="stopwatch" >Duración final</div>
			<div class="itclub4" id="otro"></div>
			<div class="itclub5" id="SetActivoData"></div>
			<div class="itclub6" id="tiempoTot"></div>
		</div>		
		<div class="Espacioclub2">
				 <div class="itemEC2_1">
					 <div class="" id="clublocal">
						<div class="grillaIdClub">
						<div class="itmidclub3"></div>	
						<div class="itmidclub2"></div>
							<div class="itmidclub1"></div>
						</div>
					</div>
				</div>
				<div class="itemEC2_2">
						<div class="numero" id="puntosA">##</div>
						<div class="tiempo" id="tiempoA1">Minuto</div>
						<div class="tiempo" id="tiempoA2">Minuto</div>
						
				</div>
				 <div class="itemEC2_3">			
					   <div class="numero" id="puntosB">##</div>
						<div class="tiempo" id="tiempoB1">Minuto</div>
						<div class="tiempo" id="tiempoB2">Minuto</div>
				</div>
				
				 <div class="itemEC2_4">			
					 <div class="" id="clubvisitante">
						<div class="grillaIdClub">
							<div class="itmidclub3"></div>	
							<div class="itmidclub2"></div>
							<div class="itmidclub1"></div>
						</div>
					</div>
				</div>
				<div class="itemEC2_5">
					<section class="xpunto21">
						  <div class="" id="setsganadosA">Sets previos..Local</div>
					</section>	 	 			
				</div>
				<div class="itemEC2_6">
					<section class="xpunto21">
						  <div class="" id="setsganadosB">Sets previos..Local</div>
					</section>	 	 			
				</div>
		</div>
	</div> <!--<div class="itemTablero2" id="">-->
	
	<div class="itemTablero3" id="">
		<div class="" id="cancha">Cancha</div>
		<div class="" id="ciudad">Ciudad</div>
	</div>
  </div> <!--class="TableroFondo" id="tablero"-->
</div> <!--marcoTablero" id="tableroMarco"-->


<section id="cancha" class="canchaversion4 LetrasBlancas">
	<div id="canchaa5" class="canchaversion3item1" >V LOC</div>
	<div id="canchaa4" class="canchaversion3item2"  >IV LOC</div>
	<div id="canchab2" class="canchaversion3item3"  >II VIS</div>
	<div id="canchab1" class="canchaversion3item4"  >SAQ VIS</div>
	<div id="canchaa6" class="canchaversion3item5"  >VI LOC</div>
	<div id="canchaa3" class="canchaversion3item6"  >III LOC</div>
	<div id="canchab3" class="canchaversion3item7"  >III VIS</div>
	<div id="canchab6" class="canchaversion3item8"  >VI VIS</div>
	<div id="canchaa1" class="canchaversion3item9"  >SAQ LOC</div>
	<div id="canchaa2" class="canchaversion3item10"  >II LOC</div>
	<div id="canchab4" class="canchaversion3item11"  >IV VIS</div>
	<div id="canchab5" class="canchaversion3item12"  >V VIS</div>
</section>
<!-- SECTOR DE LA NUEVA VISUALIZACION DE CANCHA -->
 <section class="Jugadores">
	 <section class="local">
		<div class="jugTIT">Liberos Loc.</div>
		<section id="liberosA" class="xControlLiberosTablero"></section>
		<div class="jugTIT">Suplentes Loc.</div>
		<section id="verSuplentesA" class=""></section>
	</section>
	<section class="visita">
	<div class="jugTIT">Liberos Vte.</div>
		<section id="liberosB" class="xControlLiberosTablero"></section>
		<div class="jugTIT">Suplentes Vte.</div>
		<section id="verSuplentesB" class=""></section>
	</section>
</section>	
<!-- <div class="itmtbljugTIT">
	<div class="itmtbljugTIT1">Suplentes Local</div>
	<div class="itmtbljugTIT2"></div>
	<div class="itmtbljugTIT3"></div>
	<div class="itmtbljugTIT4"></div>
	<div class="itmtbljugTIT5"></div>
</div> -->
<!-- <span>Liberos (Vis)</span> -->
<!-- <button id="animarRotado" name="animarRotado">Animar</button> -->

<!-- <section id="liberosB" class="verSuplentes xControlLiberos"></section>	 
<div class="itmtbljugTIT">
<div class="itmtbljugTIT1">Suplentes Visitante</div>
<div class="itmtbljugTIT2"></div>
<div class="itmtbljugTIT3"></div>
<div class="itmtbljugTIT4"></div>
<div class="itmtbljugTIT5"></div>
</div>
<section id="verSuplentesB" class="verSuplentes"></section> -->
<!-- SECTOR DE LA NUEVA VISUALIZACION DE CANCHA -->


<section class="seccionContiene"> 
<?php 	
	include('./abms/obtener_resumenv20.php');
?>
</section>
</body>
</html>

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

	function obtenerLogoCompetencia(idlogocompetencia,imagenlogocompetencia)
	{
		if(imagenlogocompetencia != '')
			$("#"+idlogocompetencia).html('<img  src="'+"img/competencias/"+imagenlogocompetencia+'" class="imglogocompetencia id="'+idlogocompetencia+'IMG" name="'+imagenlogocompetencia+'"></img>'); 
//		else
//		 alert('no hay logo para la competencia...');
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

/*
				$("#canchaa1").attr('class', 'gridCancha');	
				$("#canchaa2").attr('class', 'gridCancha');	
				$("#canchaa3").attr('class', 'gridCancha');	
				$("#canchaa4").attr('class', 'gridCancha');	
				$("#canchaa5").attr('class', 'gridCancha');	
				$("#canchaa6").attr('class', 'gridCancha');	
				$("#canchab1").attr('class', 'gridCancha');	
				$("#canchab2").attr('class', 'gridCancha');	
				$("#canchab3").attr('class', 'gridCancha');	
				$("#canchab4").attr('class', 'gridCancha');	
				$("#canchab5").attr('class', 'gridCancha');	
				$("#canchab6").attr('class', 'gridCancha');	
*/
          $(r['Partido']).each(function(i, v)
            { // indice, valor		
            	//console.log(r);
			//cargaCancha();
            //cargaCancha();	
	            obtenerLogoCompetencia("ilogoCompetencia",v.logocompetencia);	
				var alta='';
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
               				
                		$("#fecha").text('Partido Nro ('+r['Partido'].descripcionp+' - '+ v.idPartido +') - Inicio '+v.Inicio);
						//r['saque']
						
						$("#categoria").text("Categoria " + v.DescCate);

		

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
			
						//Aca se borra el escudo !!!
						obtenerEscudo(v.idcluba,"escudoA",escudoAMarco) ;
						obtenerEscudo(v.idclubb,"escudoB",escudoBMarco) ;
						
					//console.log(hayEscudos);	
						//alert($("#escudoAMarco").attr("class") );
						//$("#escudoBMarco").attr("class", "NoBorde"); 

						$("#numSetA").text(v.ClubARes);
						$("#numSetB").text(v.ClubBRes);

			 });

//LOCALES..


				$("#canchaa1").text('(I)- '+r['pa_1'].jugx); 
				$('#canchaa1').attr('style', 'backGround:'+r['pa_1'].puestoColor+';"');
	

				$("#canchaa2").text('(II) - '+r['pa_2'].jugx);
				$('#canchaa2').attr('style', 'backGround:'+r['pa_2'].puestoColor+';"');	


				$("#canchaa3").text('(III) - '+r['pa_3'].jugx);
				$('#canchaa3').attr('style', 'backGround:'+r['pa_3'].puestoColor+';"');	

	
				$("#canchaa4").text('(IV) - '+r['pa_4'].jugx);
				$('#canchaa4').attr('style', 'backGround:'+r['pa_4'].puestoColor+';"');	

				$("#canchaa5").text('(V) - '+r['pa_5'].jugx);
				$('#canchaa5').attr('style', 'backGround:'+r['pa_5'].puestoColor+';"');	
				
				$("#canchaa6").text('(VI) - '+r['pa_6'].jugx);
				$('#canchaa6').attr('style', 'backGround:'+r['pa_6'].puestoColor+';"');	
// FIN LOCALES..	

//VISITANTE
				$("#canchab1").text('(I) - '+r['pb_1'].jugx);
				$('#canchab1').attr('style', 'backGround:'+r['pb_1'].puestoColor+';"');		
				$("#canchab2").text('(II) - '+r['pb_2'].jugx);
				$('#canchab2').attr('style', 'backGround:'+r['pb_2'].puestoColor+';"');		
				$("#canchab3").text('(III) - '+r['pb_3'].jugx);
				$('#canchab3').attr('style', 'backGround:'+r['pb_3'].puestoColor+';"');		
				$("#canchab4").text('(IV) - '+r['pb_4'].jugx);
				$('#canchab4').attr('style', 'backGround:'+r['pb_4'].puestoColor+';"');		
				$("#canchab5").text('(V) - '+r['pb_5'].jugx);
				$('#canchab5').attr('style', 'backGround:'+r['pb_5'].puestoColor+';"');		
				$("#canchab6").text('(VI) - '+r['pb_6'].jugx);			
				$('#canchab6').attr('style', 'backGround:'+r['pb_6'].puestoColor+';"');	


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
        	  	
        	  	$("#tiempoTot").text(r['transcurrido']);
        	  	 
        	  	$("#HoraInicial").val(r['horainicio']);
				$("#puntosB").text(r['puntob']);
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

			            $(r['Sets']).each(function(i, v){ // indice, valor				

							if(v.mensaje=='Fin del set'){
								if(parseInt(v.puntoa,10) >= parseInt(v.puntob,10))
									$("#setsganadosA").append('<div class="parciales"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div>');
								if(parseInt(v.puntoa,10) <= parseInt(v.puntob,10))
									$("#setsganadosB").append('<div class="parciales"><span class="parcial">L:'+v.puntoa+' V:'+v.puntob+'</span></div>');
							
							}
							else{
							var jugando='<section class="puntoJugando21">'+
									'<div class="" id="setsjugandosA">'+
										'<div class="parcialesj"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div></div>'+
									 '</section>';
							//$("#categoria").append(jugando);
							}
	  			      		
	  			      		if(v.mensaje != 'Fin del set')
	  			      			$("#periodo").text(v.setnumero+" set ");
	  			      		else
	  			      			$("#periodo").text('');
	  			      	});
	  			    },
			         error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						}
			        }); // FIN funcion ajax 			
			
			/*********LEVANTAR INFO DE LOS SETS***************************************************/
      },
         error: function (xhr, ajaxOptions, thrownError) {
		// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
		}
        }); // FIN funcion ajax 
    		
	}	

      };
          

		$(document).ready(function(){
			
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
	
						var ESCUDOA = '<span id="escudoAMarco" class="'+escudoAMarco+'"><img  src="img/jugadorGen.png" class="imgjugadorTablero2" ></img></span>';
						var textoClubA ='<div class="grillaIdClubv20"><div class="itmidclub2a" id="escudoA">'+ESCUDOA+'</div><div class="itmidclub1a">'+v.ClubA+'</div></div>';
						var ESCUDOB = '<span id="escudoBMarco" class="'+escudoBMarco+'"><img  src="img/jugadorGen.png" class="imgjugadorTablero2" ></img></span>';
						var textoClubB  = '<div class="grillaIdClubv20"><div class="itmidclub2a" id="escudoB" >'+ESCUDOB+'</div><div class="itmidclub1a">'+v.ClubB+'</div></div>';
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


		}); // end of DOCUMENT.READY 
	
	
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
	<div class="itemTablero1" id="">
		<div class="itemTablero1A">
			<span id="ilogoCompetencia"	name="ilogoCompetencia" class="logoCompetencia">LOGO COMPETENCIA</span>
			<input type="hidden" id="estadoLocal" name="estadoLocal" value="NADA"/>
		</div>
		<div class="itemTablero1B">
			<div class="" id="competencia">COMPETENCIA:</div>
			<div class="" id="mensajes3"></div>	
			<div class="" id="fecha">FECHA</div>
			<div class="" id="categoria">Categoria</div>	
			<div class="" id="mensajes">Esperando...</div>		
			<div class="" id="mensajes2"></div>	
		</div>
	</div>
	<div class="itemTablero2" id="">
		<div class="Espacioclub" id="">
			<input id="HoraInicial" name="HoraInicial" value="" type="hidden"/>
			<div class="itclub1" id="setActivo" >SET ACTIVO</div>
		    <div class="itclub2" id="periodo" >##</div>
			<div class="itclub3" id="stopwatch" >Duración final</div>
			<div class="itclub4" id="tiempoTot">##:##</div>
			<div class="itclub5" id="SetActivoData">##:##</div>
			<div class="itclub6" id="otro"></div>
		</div>		
		<div class="Espacioclub2">
				 <div class="itemEC2_1">
					 <div class="" id="clublocal">
						<div class="grillaIdClub">
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

<section id="liberosA" class="xControlLiberos"></section>	
<!--<section id="canchaA" class="xcanchaTablero">-->
<section id="canchaA" class="canchaversion2 LetrasBlancas">
	<div id="canchaa5" class="canchaversion2item5" >QUINTA LOCAL</div>
	<div id="canchaa4" class="canchaversion2item4" >CUARTA LOCAL</div>
	<div id="canchaa6" class="canchaversion2item6" >SEXTA LOCAL</div>
	<div id="canchaa3" class="canchaversion2item3" >TERCERA LOCAL</div>
	<div id="canchaa1" class="canchaversion2item1" >SAQUE LOCAL</div>
	<div id="canchaa2" class="canchaversion2item2" >SEGUNDA LOCAL</div>
</section>
<section id="liberosB" class="xControlLiberos"></section>	
<!--<section id="canchaA" class="xcanchaTablero">-->
<section id="canchaA" class="canchaversion2 LetrasBlancas">
	<div id="canchab2" class="canchaversion2item2" >SEGUNDA VISITANTE</div>
	<div id="canchab1" class="canchaversion2item1" >SAQUE VISITANTE</div>
	<div id="canchab3" class="canchaversion2item3" >TERCERA VISITANTE</div>
	<div id="canchab6" class="canchaversion2item6" >SEXTA VISITANTE</div>
	<div id="canchab4" class="canchaversion2item4" >CUARTA VISITANTE</div>
	<div id="canchab5" class="canchaversion2item5" >QUINTA VISITANTE</div>

</section>
<section class="seccionContiene"> 
<?php 	
	include('./abms/obtener_resumenv20.php');
?>
</section>
</body>
</html>

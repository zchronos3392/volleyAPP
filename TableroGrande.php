<?php include('sesioner.php'); ?>
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
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script type="text/javascript">
	var iEscudo='';

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


	function obtenerEscudo(idClub,idescudoclub){
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
				if(re['escudo'] !='')
					$(idescudoclub).html('<img  src="'+"img/escudos/"+re['escudo']+'" class="imgjugadorTablero" id="escudo"></img>'); 
    			else            	
    				$(idescudoclub).html('<img  src="img/jugadorGen.png" class="imgjugadorTablero" ></img>'); 
            },
             error: function (xhr, ajaxOptions, thrownError) 
             {
			 }
            });

 	}

	function refrescarTablero(){
		
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



				$("#canchaa1").text('(I)- '+r['pa_1'].jugx); 
				buscar(r['CentralesA'],r['pa_1'].idjugador,'#canchaa1');
					buscarLibero(r['LiberosA'],r['pa_1'].idjugador,'#canchaa1');
				$("#canchaa2").text('(II) - '+r['pa_2'].jugx);
				buscar(r['CentralesA'],r['pa_2'].idjugador,'#canchaa2');
					buscarLibero(r['LiberosA'],r['pa_2'].idjugador,'#canchaa2');
				$("#canchaa3").text('(III) - '+r['pa_3'].jugx);
				buscar(r['CentralesA'],r['pa_3'].idjugador,'#canchaa3');
					buscarLibero(r['LiberosA'],r['pa_3'].idjugador,'#canchaa3');
				$("#canchaa4").text('(IV) - '+r['pa_4'].jugx);
				buscar(r['CentralesA'],r['pa_4'].idjugador,'#canchaa4');
					buscarLibero(r['LiberosA'],r['pa_4'].idjugador,'#canchaa4');
				$("#canchaa5").text('(V) - '+r['pa_5'].jugx);
				buscar(r['CentralesA'],r['pa_5'].idjugador,'#canchaa5');
					buscarLibero(r['LiberosA'],r['pa_5'].idjugador,'#canchaa5');
				$("#canchaa6").text('(VI) - '+r['pa_6'].jugx);
				buscar(r['CentralesA'],r['pa_6'].idjugador,'#canchaa6');
					buscarLibero(r['LiberosA'],r['pa_6'].idjugador,'#canchaa6');
				$("#canchab1").text('(I) - '+r['pb_1'].jugx);
				buscar(r['CentralesB'],r['pb_1'].idjugador,'#canchab1');
					buscarLibero(r['LiberosB'],r['pb_1'].idjugador,'#canchab1');
				$("#canchab2").text('(II) - '+r['pb_2'].jugx);
				buscar(r['CentralesB'],r['pb_2'].idjugador,'#canchab2');
					buscarLibero(r['LiberosB'],r['pb_2'].idjugador,'#canchab2');
				$("#canchab3").text('(III) - '+r['pb_3'].jugx);
				buscar(r['CentralesB'],r['pb_3'].idjugador,'#canchab3');
					buscarLibero(r['LiberosB'],r['pb_3'].idjugador,'#canchab3');
				$("#canchab4").text('(IV) - '+r['pb_4'].jugx);
				buscar(r['CentralesB'],r['pb_4'].idjugador,'#canchab4');
					buscarLibero(r['LiberosB'],r['pb_4'].idjugador,'#canchab4');
				$("#canchab5").text('(V) - '+r['pb_5'].jugx);
				buscar(r['CentralesB'],r['pb_5'].idjugador,'#canchab5');
					buscarLibero(r['LiberosB'],r['pb_5'].idjugador,'#canchab5');
				$("#canchab6").text('(VI) - '+r['pb_6'].jugx);			
				buscar(r['CentralesB'],r['pb_6'].idjugador,'#canchab6');				
					buscarLibero(r['LiberosB'],r['pb_6'].idjugador,'#canchab6');				


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


            $(r['Partido']).each(function(i, v)
            { // indice, valor		
            	//console.log(r);
			//cargaCancha();
            //cargaCancha();		
				var alta='';
				
			    if(v.estado.includes('PROGR')) var img = './img/PartidoONOFFSQR.png';
			    if(v.estado.includes('LLUVI')) var img = './img/rain-icon-png.jpg';
				if(v.estado.includes('FIN'))  { var img = './img/PartidoOFFSQR.jpg';$("#setActivo").text('Fin del Partido <br> Se jugaron Sets:');}
	            if(v.estado.includes('CURSO')) var img = './img/PartidoONSQR.png';

                $("#imgEstado").prop("src",img);
                $("#imgEstado").prop("title",v.estado);
                		$("#fecha").text(v.cnombre+' - Fecha: '+v.Fecha);
                		$("#cancha").text(v.cancha+'('+v.nombre+')');
                		$("#competencia").text('PARTIDO '+v.idPartido+'- HORA : '+v.Inicio);
						//r['saque']
						
						$("#categoria").text("Categoria " + v.DescCate);
			

						var ESCUDOA = '<img  src="img/jugadorGen.png" class="imgjugadorTablero" ></img>';
						var textoClubA ='<div class="grillaIdClub"><div class="itmidclub1">'+v.ClubA+'</div><div class="itmidclub2" id="escudoA">'+ESCUDOA+'</div></div>';
						var ESCUDOB = '<img  src="img/jugadorGen.png" class="imgjugadorTablero" ></img>';
						var textoClubB  = '<div class="grillaIdClub"><div class="itmidclub1">'+v.ClubB+'</div><div class="itmidclub2" id="escudoB" >'+ESCUDOB+'</div></div>';

						obtenerEscudo(v.idcluba,"#escudoA") ;
						obtenerEscudo(v.idclubb,"#escudoB") ;
						//aca se borra el escudo !!!
						if(r['estadoSet'].includes('CURSO')){
							if(r['saque'] == v.idcluba)
							{ 
								//textoClubA = v.ClubA;
								$("#saque").text('<- saque'); 
							}
							
							if(r['saque'] == v.idclubb)
							{ 
								//textoClubB  = v.ClubB;
								$("#saque").text('saque ->');
							}
						};
						$("#numSetA").text(v.ClubARes);
						$("#numSetB").text(v.ClubBRes);
						$("#clublocal").empty();
//						$("#clublocal").append('<span id="textoClub">'+textoClubA+'</span>');
						$("#clublocal").append(textoClubA);						
						//$("#clublocal").append(' <span class="puntoderecha" id="puntoclublocal">'+v.ClubARes+'</span>');
						$("#clubvisitante").empty();
//						$("#clubvisitante").append('<span id="textoClub">'+textoClubB+'</span>');
						$("#clubvisitante").append(textoClubB);						
						//$("#clubvisitante").append(' <span class="puntoizquierdaA" id="puntoclubvisitante">'+v.ClubBRes+'</span>'+'<span id="textoClub">'+textoClubB+'</span>');

			 });
        	  	$("#puntosA").text(r['puntoa']); 
        	  	
        	  	$("#tiempoTot").text(r['transcurrido']); 
				$("#puntosB").text(r['puntob']);
				$("#mensajes").text(r['mensajeSet']);
				
				if(r['mensajeSet']=='Fin del set')
						if( !( r['Partido'].estado.includes('FIN'))   )			
						 					$("#setActivo").text('Termino Set');
						else $("#setActivo").text('Se jugaron ');
				else $("#setActivo").text('SET ACTIVO');
						
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
				
				
			$("#mensajes3").text(r['Partido'].descripcionp);		
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
								if(v.puntoa >= v.puntob)
									$("#setsganadosA").append('<div class="parciales"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div>');
								if(v.puntoa <= v.puntob)
									$("#setsganadosB").append('<div class="parciales"><span class="parcial">L:'+v.puntoa+' V:'+v.puntob+'</span></div>');
							
							}
							else{
							var jugando='<section class="puntoJugando21">'+
									'<div class="" id="setsjugandosA">'+
										'<div class="parcialesj"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div></div>'+
									 '</section>';
							$("#categoria").append(jugando);
							}
	  			      		
	  			      		$("#periodo").text(v.setnumero);
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
      };
          

		$(document).ready(function(){
		 var refreshId = setInterval(refrescarTablero, 5000);
   		 $.ajaxSetup({ cache: false });	
	 		refrescarTablero();	

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
		<Section class="LogoApp normalizar">
		<a href="index.php"><span id="medidas">
			<!-- <img  class="LogoApp normalizar" alt="VOLLEY.app" src="./img/textovolleyAPP_pequeno.png">	 -->
		</a>
		</Section>
		<button id="volver" name="altajug" class="altajug" title="agregar registros"><<</button>
</div> 

    
<section class="tablero" id="tablero" >
<!-- FILA 0-->
<div class="itemT1" id="mensajes">Esperando...</div>	
<div class="itemT1" id="mensajes2"></div>	
<div class="itemT1" id="mensajes3"></div>	

<div class="itemT1" id="competencia">COMPETENCIA:</div>	
<div class="itemT1" id="fecha">FECHA</div>
<div class="itemT1" id="cancha">Cancha</div>	
<!-- FILA 1-->
<div class="itemT1" id="clublocal">
	<div class="grillaIdClub"><div class="itmidclub1"></div><div class="itmidclub2"></div></div>
</div>	
<div class="itemT1" id="categoria">Categoria</div>
<div class="itemT1" id="clubvisitante">
		<div class="grillaIdClub"><div class="itmidclub1"></div><div class="itmidclub2"></div></div>
</div>	
<!-- FILA 2-->
<div class="itemT1" id="lv">LOCAL</div>	
<div class="itemT1" id="saque">< -saque-  ></div>
<div class="itemT1" id="lv">VISITANTE</div>	
<!-- FILA 3	-->
<div class="itemT2">
	 <section class="punto">
		<div class="numero" id="puntosA">##</div>
		<div class="tiempo" id="tiempoA1">T</div>
		<div class="tiempo" id="tiempoA2">T</div>
	 </section>
	 <section class="punto21">
		<div class="" id="setsganadosA">Sets previos..Local</div>
	 </section>	 	 
 </div>	
<div class="itemT2">
<section class="periodo">
	<div class="periodorenglon" id="setActivo" >SET ACTIVO</div>
	<div class="periodorenglon fuenteGrande" id="periodo" >##</div>
</section>
</div>
<div class="itemT2">
	 <section class="punto">
		<div class="numero" id="puntosB">##</div>
		<div class="tiempo" id="tiempoB1">T</div>
		<div class="tiempo" id="tiempoB2">T</div>
	 </section>
	 <section class="punto21">
		<div class="" id="setsganadosB">Sets previos..Visitante</div>
	 </section>	 
</div>	
<!-- FILA 4-->
<div class="itemT2">
	 <section class="SetNum">
		<div class="snumero" >SETS Ganados Local</div>
		<div class="snumero" id="numSetA">##</div>
	</section>	
</div>
<div class="itemT2">
<section class="periodo">
	<div class="periodorenglon" >TIEMPO</div>
	<div class="periodorenglon fuenteGrande" id="tiempoTot">##:##</div>
</section>
</div>
<div class="itemT2">
	 <section class="SetNum">
		<div class="snumero" >SETS Ganados Visitante</div>
		<div class="snumero" id="numSetB">#</div>
	</section>	
</div>
</section>
<section id="liberosA" class="ControlLiberos TableroPrimerControl"></section>	
<section id="canchaA" class="canchaTablero">
	<div id="canchaa5" class="gridcancha" >EN 5A - REMERA ##</div>
	<div id="canchaa4" class="gridcancha  bordeRight" >JUGADOR EN 4A - REMERA ##</div>
	<div id="canchaa6" class="gridcancha" >JUGADOR EN 6A - REMERA ##</div>
	<div id="canchaa3" class="gridcancha  bordeRight" >JUGADOR EN 3A - REMERA ##</div>
	<div id="canchaa1" class="gridcancha" >JUGADOR EN 1A - REMERA ##</div>
	<div id="canchaa2" class="gridcancha  bordeRight" >JUGADOR EN 2A - REMERA ##</div>
</section>
<section id="liberosB" class="ControlLiberos TableroSegundoControl"></section>	
<section id="canchaBTablero" class="canchaTablero">
	<div id="canchab2" class="gridcancha  bordeLeft" >JUGADOR EN 2B - REMERA ##</div>
	<div id="canchab1" class="gridcancha" >JUGADOR EN 1B - REMERA ##</div>
	<div id="canchab3" class="gridcancha  bordeLeft" >JUGADOR EN 3B - REMERA ##</div>
	<div id="canchab6" class="gridcancha" >JUGADOR EN 6B - REMERA ##</div>
	<div id="canchab4" class="gridcancha  bordeLeft" >JUGADOR EN 4B - REMERA ##</div>
	<div id="canchab5" class="gridcancha" >JUGADOR EN 5B - REMERA ##</div>

</section>
<section class="seccionContiene"> 
<?php 	
	include('./abms/obtener_resumen.php');
?>
</section>
</body>
</html>

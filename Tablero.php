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

	function refrescarTablero(){
		var parametros =
	 {
		"id" : <?php echo($_GET['id']);?>,
		"fechapart"    : <?php echo("'".$_GET['fecha'])."'";?>,
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
            	//console.log(r);
			//cargaCancha();
				$("#canchaa1").text('(I)- '+r['pa_1'].jugx);
				$("#canchaa2").text('(II) - '+r['pa_2'].jugx);
				$("#canchaa3").text('(III) - '+r['pa_3'].jugx);
				$("#canchaa4").text('(IV) - '+r['pa_4'].jugx);
				$("#canchaa5").text('(V) - '+r['pa_5'].jugx);
				$("#canchaa6").text('(VI) - '+r['pa_6'].jugx);
				$("#canchab1").text('(I) - '+r['pb_1'].jugx);
				$("#canchab2").text('(II) - '+r['pb_2'].jugx);
				$("#canchab3").text('(III) - '+r['pb_3'].jugx);
				$("#canchab4").text('(IV) - '+r['pb_4'].jugx);
				$("#canchab5").text('(V) - '+r['pb_5'].jugx);
				$("#canchab6").text('(VI) - '+r['pb_6'].jugx);
            //cargaCancha();
				var alta='';

			    if(v.estado.includes('PROGR')) var img = './img/PartidoONOFFSQR.png';
			    if(v.estado.includes('LLUVI')) var img = './img/rain-icon-png.jpg';
				if(v.estado.includes('FIN'))   var img = './img/PartidoOFFSQR.jpg';
	            if(v.estado.includes('CURSO')) var img = './img/PartidoONSQR.png';

                $("#imgEstado").prop("src",img);
                $("#imgEstado").prop("title",v.estado);
                		$("#titulocab1").text(v.cnombre+' - '+v.DescCate+' - Fecha: '+v.Fecha);
                		$("#icancha").text(v.cancha+'('+v.nombre+')');
                		$("#titulocab2").text('PARTIDO '+v.idPartido+'- HORA : '+v.Inicio);
						//r['saque']
						var textoClubA = v.ClubA;
						var textoClubB  = v.ClubB;
						if(r['estadoSet'].includes('CURSO')){
							if(r['saque'] == v.idcluba){ textoClubA = v.ClubA+'(SAQUE)';}
							if(r['saque'] == v.idclubb){ textoClubB  = v.ClubB+'(SAQUE)';}
						};

						$("#clublocal").empty();
						$("#clublocal").append('<span id="textoClub">'+textoClubA+'</span>');
						$("#clublocal").append(' <span class="puntoderecha" id="puntoclublocal">'+v.ClubARes+'</span>');
						$("#clubvisitante").empty();
						$("#clubvisitante").append(' <span class="puntoizquierdaA" id="puntoclubvisitante">'+v.ClubBRes+'</span>'+'<span id="textoClub">'+textoClubB+'</span>');

			 });
        	  	$("#resultadoA").text(r['puntoa']);

        	  	$("#tiempotranscurrido").text('TRANSCURRIDOS '+r['transcurrido']);
				$("#resultadoB").text(r['puntob']);
				$("#mensajes").text(r['mensajeSet']);

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



				if(r['Partido'].estado.includes('FIN')) $("#mensajes").append('<br>.: Partido finalizado :.');
			//http://localhost/volleyAPP/abms/obtener_sets.php?idpartido=1&idfecha=2018-08-25
			/*********LEVANTAR INFO DE LOS SETS***************************************************/
				// la fecha esta yendo con comillas...
				$("#setsganados").empty();
				var parametros =
				{
					"idpartido" : <?php echo($_GET['id']);?>,
					"idfecha"    : <?php echo("'".$_GET['fecha'])."'";?>,
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
			            $(r['Sets']).each(function(i, v){ // indice, valor
							$("#setsganados").append('<div class="parciales"><span class="parcial">L:'+v.puntoa+'</span><span class="parcial">V:'+v.puntob+'</span></div>');
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
		}); // end of DOCUMENT.READY

/*	function cargaCancha(){
	var params2 =
	 {
		"idpartido" : $("#partidoid").val(),
		"idset"     : $("#numSet").text(),
			"fechas"    : <?php echo("'".$_GET['fecha']."'");?>
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
				if(r['estado'] != "0") {
					$(r['Sets']).each(function(i, v)
					{ // indice,0 valor
						$("#canchaa1").text('En 1- '+v.pa_1['jugx']);
						$("#canchaa2").text('En 2 - '+v.pa_2['jugx']);
						$("#canchaa3").text('En 3 - '+v.pa_3['jugx']);
						$("#canchaa4").text('En 4 - '+v.pa_4['jugx']);
						$("#canchaa5").text('En 5 - '+v.pa_5['jugx']);
						$("#canchaa6").text('En 6 - '+v.pa_6['jugx']);
						$("#canchab1").text('En 1 - '+v.pb_1['jugx']);
						$("#canchab2").text('En 2 - '+v.pb_2['jugx']);
						$("#canchab3").text('En 3 - '+v.pb_3['jugx']);
						$("#canchab4").text('En 4 - '+v.pb_4['jugx']);
						$("#canchab5").text('En 5 - '+v.pb_5['jugx']);
						$("#canchab6").text('En 6 - '+v.pb_6['jugx']);
					});
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
*/
		</script>
 </head>
    <body class="full">
   	<header>
   			<Section class="LogoApp normalizar">
			<a href="index.php"><span id="medidas">
			<!-- <img  class="LogoApp normalizar" alt="VOLLEY.app" src="./img/textovolleyAPP_pequeno.png" /> -->
			</a>
		</Section>

   </header>
<section><!-- class="full"-->
<section class="seccionMedio360">
<?php

	if(isset($_GET["id"])) $partidoid = (int) $_GET["id"];
	if(isset($_GET["fecha"])) $fechapartido = $_GET["fecha"];
?>
	<input type="hidden" id="idpartido" name="idpartido" value="<?php echo($partidoid);?>"/>
	<input type="hidden" id="fechapartido" name="fechapartido" value="<?php echo($fechapartido);?>"/>
	<div class="itablero">
<!--		<div id="mensajes" class="itabrenglon1">volleiAPP
			<img id="imgEstado"	src="" class="imgEstadoTablero derecha2" title=""></img>
		</div>-->
	 <div class="itabrenglon1">
			<div id="mensajes" class="itabrenglon1"></div>
			<img id="imgEstado"	src="" class="imgEstadoTablero derecha2" title=""></img>
	</div>
		<div class="itabrenglon1" id="titulocab1"> -  - FECHA: </div>
		<div class="itabrenglon1 irenglon12">
			<div class="irenglon11" id="icancha"></div>
			<div class="irenglon12" id="titulocab2">PARTIDO - HORA : </div>
		</div>
		<div class="itabrenglon1">
			<div class="irenglon11" id="clublocal"></div>
			<div class="irenglon11" id="clubvisitante"></div>
		</div>
		<div class="itabrenglon15">
			<div class="irenglon11 irenglon110" id="resultadoA"></div>
			<div class="irenglon11 irenglon110" id="resultadoB"></div>
		</div>
		<div class="itabrenglon1">
			<div class="irenglon11">
				<span class="puntoizquierda">L</span>
				<span id="tiempoA1" class="puntoizquierda">1T</span>
				<span id="tiempoA2"  class="puntoizquierda">2T</span>
			</div>
			<div class="irenglon11">
				<span class="puntoizquierda">V</span>
				<span id="tiempoB1" class="puntoizquierda">1T</span>
				<span id="tiempoB2" class="puntoizquierda">2T</span>
			</div>
		</div>
		<div id="tiempotranscurrido" class="itabrenglon1">TRANSCURRIDOS 00:00:00</div>
		<div id="setsganados" class="itabrenglon1"></div>
		<div class="itabrenglon1 mensajes">
    <section id="canchaA" class="canchaTablero">
    <div id="canchaa5" class="gridcancha" >EN 5A - REMERA ##</div>
    <div id="canchaa4" class="gridcancha  bordeRight" >JUGADOR EN 4A - REMERA ##</div>
    <div id="canchaa6" class="gridcancha" >JUGADOR EN 6A - REMERA ##</div>
    <div id="canchaa3" class="gridcancha  bordeRight" >JUGADOR EN 3A - REMERA ##</div>
    <div id="canchaa1" class="gridcancha" >JUGADOR EN 1A - REMERA ##</div>
    <div id="canchaa2" class="gridcancha  bordeRight" >JUGADOR EN 2A - REMERA ##</div>
    </section>
    <section id="canchaBTablero" class="canchaTablero">
    <div id="canchab4" class="gridcancha  bordeLeft" >JUGADOR EN 4B - REMERA ##</div>
    <div id="canchab5" class="gridcancha" >JUGADOR EN 5B - REMERA ##</div>
    <div id="canchab3" class="gridcancha  bordeLeft" >JUGADOR EN 3B - REMERA ##</div>
    <div id="canchab6" class="gridcancha" >JUGADOR EN 6B - REMERA ##</div>
    <div id="canchab2" class="gridcancha  bordeLeft" >JUGADOR EN 2B - REMERA ##</div>
    <div id="canchab1" class="gridcancha" >JUGADOR EN 1B - REMERA ##</div>
    </section>
  </div>
 </div>
</section>
</section>

<section class="seccionContiene">
<?php
	include('./abms/obtener_resumen.php');
?>
</section>
</body>
</html>
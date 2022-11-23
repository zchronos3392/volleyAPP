<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>ver info set</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <style>
		#lineaCSetJug button {
			width:7em;
			height:4em;
			border-radius:20%;
			background:#ce1ee1;
			outline:none;
			color:#000;
			font-size:14px;
			box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
			transition:.3s;  
		}
		
		.tablaBotones {
			display: grid;
			grid-template-columns: 90% 90% 89% 73%;
			grid-template-rows: 80%;
			/*background: #00bfff;*/
		}
		.tablaBotones div {
				border:1px solid green;
		}
		
	   </style>
	   
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript">

		
		$(document).ready(function(){
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
//para tener el año actual, para las cargas de jugadores

			iclubA = 0;
			iclubB = 0;
			SetsMAXIMOS = 0;	
			ResultadoA = 0;
			ResultadoB = 0;	
		// antes de cargar todo , verifico que el partido no haya que cerrarlo !!	
			var parametros =
			    {
				 "fechapart"   : <?php echo("'".$_GET['fecha']."'"); ?>,
				 "id" : <?php echo($_GET['id']); ?>	
				};

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
								iclubA = v.idcluba;
								iclubB = v.idclubb ;
								SetsMax = v.setsnmax;	
								ResultadoA = v.ClubARes;
								ResultadoB = v.ClubBRes;
								
								// agregado para guardar el id partido y tenerlo disponible..
								$("#idclubA").val(iclubA);
								$("#idclubB").val(iclubB);
								
								// agregado para guardar el id partido y tenerlo disponible..
								$("#clubANombre").val(v.ClubA);
								$("#clubBNombre").val(v.ClubB);
								
										idclubuno = iclubA;
										idclubdos = iclubB;
								var paremetros =
								    {
									"puntosa" : ResultadoA ,
									"puntosb" : ResultadoB ,
									"equipoa" : iclubA,
									"equipob" : iclubB,
									"setmax"  : SetsMax
									};

									$.ajax({ 
											url:   './finpartido.php',
											type:  'GET',
											data: paremetros,
											dataType: 'text json',
											// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
											beforeSend: function (){
												
											},
											done: function(data){
													
											},
											success:  function (r){
//												console.log(r['ganador']);
												
										    },
											error: function (xhr, ajaxOptions, thrownError) {
													// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
													console.log(thrownError);
													console.log(xhr.responseText);
													}
											}); // FIN funcion ajax obtener_partido
									});
						},
						 error: function (xhr, ajaxOptions, thrownError) {
						// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
						console.log(thrownError);
						console.log(xhr.responseText);
						}
				}); // FIN funcion ajax obtener_partido
			
			
		// antes de cargar todo , verifico que el partido no haya que cerrarlo !!			
			var setmax = <?php echo($_GET['setmax']); ?>;
			var fechapartido = <?php echo("'".$_GET['fecha']."'"); ?>;
			
			$("#nuevoset").prop('disabled', true); 
			$("#nuevoset").css("background","#A9AAC5");
       		
       		var parametros =
    		 {
    			"idpartido" : <?php echo($_GET['id']); ?>,
				"idfecha" : <?php echo("'".$_GET['fecha'])."'"; ?>
			 }	
    		var verComp = 0;		
         $.ajax({ 
            url:   './abms/obtener_setinicial.php',
            type:  'GET',
            data: parametros,
            dataType: 'json',
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    		},
            done: function(data){
			
			},
            success:  function (r){
				// aca agregamos la logica para pegar los botones de trabajo con SET
				console.log(r);
                $(r['Sets']).each(function(i, v)
                { // indice, valor
				var accion='';
				var altajugadorea='';
				var altajugadoreb='';
				var cargaPosicionA='';
				var cargaPosicionB='';
				var eliminarSet = '';

				var nombrelocal = v.NombreClubA;
				var nombrevisitante = v.NombreClubB;
				altajugadorea = '<div>'+'<a href="CargarJugadores.php?idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubA+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'" >';
				altajugadorea += '<button id="jugadoresA" name="jugadoresA" title="cargar jugadores equipo A" class="btnPop2" >Jugadores '+nombrelocal+'</button></a></div>';
				//console.log(altajugadorea);
				altajugadoreb = '<div>'+'<a href="CargarJugadores.php?idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubB+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'" >';
				altajugadoreb += '<button id="jugadoresB" name="jugadoresB" title="cargar jugadores equipo B" class="btnPop2">Jugadores '+nombrevisitante+'</button></a></div>';
				cargaPosicionA = '<div>'+'<a href="CargarPosiciones.php?idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubA+'&set='+v.setnumero+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>+'&ver=s" >';
				cargaPosicionA += '<button id="posicionesA" name="posicionesA" title="cargar posiciones equipo A" class="btnPop2">Pos.Ini. '+nombrelocal+'</button></a></div>';
				cargaPosicionB = '<div>'+'<a href="CargarPosiciones.php?idpartido='+v.idpartido+'&setmax='+<?php echo($_GET['setmax']); ?>+'&idclub='+v.ClubB+'&set='+v.setnumero+'&fecha='+<?php echo("'".$_GET['fecha']."'");?>+'&ver=s" >';
                cargaPosicionB += '<button id="posicionesB" name="posicionesB" title="cargar posiciones equipo B" class="btnPop2">Pos.Ini. '+nombrevisitante+'</button></a></div>';
				//console.log(cargaPosicionB);
				if(v.DescEstado.includes('PROGR')) {var img = './img/PartidoONOFF.png';}
                if(v.DescEstado.includes('FIN'))
                {
                		var img = './img/PartidoOFF.png';
						accion ='<a href="Tablero.php?id='+v.idpartido+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'"><input type="button" id="verset" name="verset"';
						accion +=' class="btnVerSet" value="(ver)" title="Re-veer set"></input></a>';
						altajugadorea='';
						altajugadoreb='';
						//cargaPosicionA='';
						//cargaPosicionB='';
				}
                if(v.DescEstado.includes('CURSO'))
                {
                		var img = './img/PartidoON.png';
					    accion='<a href="NovedadesSet.php?id='+v.idpartido+'&setid='+v.setnumero;
					    accion +='&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&continuar=1">';

					    accion='<a href="NovedadesSet.php?id='+v.idpartido+'&setid='+v.setnumero;
					    accion +='&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&continuar=1">';						
					    accion +='<input type="button" id="verset" name="verset" class="btnVerSet btnCeleste" value="(Continuar)" title="Continuar set(redux)"></input></a>';                		
                }

                if(v.DescEstado.includes('INICIAL'))
                {
                		var img = './img/PartidoONOFF.png';
					    accion='<a href="NovedadesSet.php?id='+v.idpartido+'&setid='+v.setnumero;
					    accion +='&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&continuar=1">';

					    accion='<a href="NovedadesSet.php?id='+v.idpartido+'&setid='+v.setnumero;
					    accion +='&setmax='+<?php echo($_GET['setmax']);?>+'&fecha='+<?php echo("'".$_GET['fecha'])."'"; ?>+'&continuar=1">';						
					    accion +='<input type="button" id="verset" name="verset" class="btnVerSet btnCeleste" value="(Continuar)" title="Continuar set(redux)"></input></a>';                		
                }

				
				
             verComp++;
             if(verComp == 1)$("#comptext").append(v.cnombre);
             		
			$("#grid-CSets").append('<div class="ilp2 margen"><section class="grid-LPRSet" id="grid-LPRSet">'+
			  '<div class="ilp22" >'+'Set'+v.setnumero+'</div>'+'<div class="ilp22">'+v.puntoa+'</div>'+'<div class="ilp22">'+v.puntob+'</div>'+'<div class="imgdiv ilp22"><img src="'+img+'" class="imgEstado" title="'+v.DescEstado+'"></img>'+eliminarSet+'</div>'+
			  '<div class="ilp22">'+accion+'</div><section id="tablaBotones" class="tablaBotones">'+altajugadorea+cargaPosicionA+altajugadoreb+cargaPosicionB+'</section><div class="ilp22"></div>'+
			  '</section></div><div class="ilp11">'+
			  '</div>');		
			});
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			}
            }); // FIN funcion ajax CLUBES
		}); 	

		$("#jugadoresA").click(function(){
//			var clubaid = $("#idcluba").val();
		});
		
		$("#jugadoresB").click(function(){
			// var clubbid = $("#idclubb").val();
		});

		$("#posicionesA").click(function(){
			// var clubaid = $("#idcluba").val();
		});
		
		$("#posicionesB").click(function(){
			// var clubbid = $("#idclubb").val();
		});

		
		</script>
    </head>
    <body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
		<?php 
			////include('includes/menuConfig.php');; 
			require_once('abms/Set.php'); 
			$idpartido = (int) $_GET['id'];
			$partidofecha = "'".$_GET['fecha']."'";
	 
	//		 $newset = Sett::ultSetNum($idpartido);
			 $newset = Sett::ultSetNum($idpartido,$partidofecha);
				$idnewset =(int) $newset['setnumero']; 
				if(!$idnewset)$idnewset=1;
					else $idnewset++; 
		?>	
    </header>
  <input type="hidden" value="ingresa valor"/>
  <input type="hidden" id="idclubA" value="ingresa valor"/>
  <input type="hidden" id="idclubB" value="ingresa valor"/>
  <input type="hidden" id="clubANombre" value="ingresa valor"/>
  <input type="hidden" id="clubBNombre" value="ingresa valor"/>  
  <input type="hidden" id="numerosetNuevo" value="nuevo set"/>
  <div ><span id="stopwatch" style="display: none;"></span></div>
  <section id="grid-CSets"	class="grid-CSets">
  <div class="ilp1"><h3>Sets</h3>
		 <select id="ianio" name="ianio" class="ianio">
			<option value="9999">Seleccionar año...</option>
		</select>
    </div>
  <div class="ilp1">
  	<a href="AdministrarAPP.php"><input type="button" id="volver" title="volver a partidos" name="volver" class="btnSet" value="<<"></input></a>
  </div>
  <div class="ilp11">
					<!--<a href="NovedadesSet20.php?id=<?php echo $idpartido; ?>&setid=<?php echo $idnewset;?>&setmax=<?php echo($_GET['setmax']); ?>&fecha=<?php echo($_GET['fecha']);?>&continuar=0"><input type="button" id="nuevoset" title="Agregar Set" name="nuevoset" class="btnSet btnAzulFrancia" value="Set(+)"></input></a>-->
					<a href="NovedadesSet.php?id=<?php echo $idpartido; ?>&setid=<?php echo $idnewset;?>&setmax=<?php echo($_GET['setmax']); ?>&fecha=<?php echo($_GET['fecha']);?>&continuar=0"><input type="button" id="nuevoset" title="Agregar Set" name="nuevoset" class="btnSet btnRojoCereza" value="Set(++)"></input></a>
</div>
  <div class="ilp1" id="comptext">Competencia : </div>
  <div class="ilp1"></div>
  <!--
  href="NovedadesSet20.php?id=<?php echo $idpartido; ?>&setid=<?php echo $idnewset;?>&setmax=<?php echo($_GET['setmax']); ?>&fecha=<?php echo($_GET['fecha']);?>&continuar=0"
  -->
  <div class="ilp11"></div>
</section> 
</body>
</html>


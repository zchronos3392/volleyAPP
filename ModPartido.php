<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C2//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>VOLLEY.APP:: modificar partido</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <link rel="stylesheet" href="./css/tableroControl_style.css">

	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
<!--SCRIPTS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<!-- <script type="text/javascript" src="./scripts/partido_script.js"></script>  -->
<!--SCRIPTS-->
	   <script type="text/javascript">
		// cuando PRESIONO CLICK , LO ACTUALIZO

//+++++++++++++++ 01 CREAMOS LOS VECTORES GLOBALES DESDE DONDE RE CARGAREMOS INFINITAMENTE LOS COMBOS..
var vCategorias = new Array();
		var vEquipos = new Array();
		var vCanchas = new Array();
		var vSedes   = new Array();
		var vCiudades = new Array();
		var vCompetencias = new Array();
// +++++++++++++++++ FUNCIONES EXTRA ++++++++++++++++++++++++++++++++++++++
		
// +++++++++++++++++ FUNCIONES START DE VECTORES  ++++++++++++++++++++++++++++++++++++++
// TRAIGO UNA VEZ VECTOR DE CATEGORIAS, EQUIPOS PARA LOCA Y VISITANTE,CANCHAS Y CIUDADES			
function cargarCategoriasStart(){
	// EdadFin: "22"
	// EdadInicio: "16"
	// categoriaActiva: "1"
	// descripcion: "SUB 21[CAB]"
	// idcategoria: "20"
	// setMax: "5"	
	iCategorias = new Array();
	$.ajax({ 
		 url:   './abms/obtener_categorias.php',
		 type:  'GET',
		 dataType: 'json',
		 async:false,
		 // EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
		 beforeSend: function (){},
		 done: function(data){},
		 success:  function (r){
			iCategorias = Object.values(r['Categorias']);
			 //console.log(iPosiciones);
		  },
		  error: function (xhr, ajaxOptions, thrownError) {}
		 }); // FIN funcion ajax	
 // TRAIGO UNA VEZ VECTOR DE PUESTOS			
 //PROBANDO LA CARGA UNICA DE LAS POSICIONES
 //alert(iPosiciones);	
  return iCategorias;				
}


function cargarEqupoStart(){
// clubabr:"77FC"
// escudo: ""
// idciudad: "0"
// idclub: "2"
// nombre: "77 FUTBOL CLUB"	
	iEquipos = new Array();
	$.ajax({ 
		 url:   './abms/obtener_clubes.php',
		 type:  'GET',
		 dataType: 'json',
		 async:false,
		 // EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
		 beforeSend: function (){},
		 done: function(data){},
		 success:  function (r){
			iEquipos = Object.values(r['Clubes']);
			 //console.log(iPosiciones);
		  },
		  error: function (xhr, ajaxOptions, thrownError) {}
		 }); // FIN funcion ajax	
 // TRAIGO UNA VEZ VECTOR DE PUESTOS			
 //PROBANDO LA CARGA UNICA DE LAS POSICIONES
 //alert(iPosiciones);	
  return iEquipos;			
}

function cargarSedesStart(){
	// NO FUNCIONABA PORQUE NO LA COPIÉ TAL CUAL LAS OTRAS 
	// QUE TIENEN QUE TENER SI O SI EL 		 async:false,
	// SINO NO VAN A ESTAR CARGADAS PARA CUANDO SE NECESITEN !!!!
	iSedes = new Array();
	$.ajax({ 
            url:   './abms/obtener_sedes.php',
            type:  'GET',
            dataType: 'json',
			async:false,
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){},
            done: function(data){},
            success:  function (r){
               // $(r['Sedes']).each(function(i, v)
			   iSedes = Object.values(r['Sedes']);

			},
             error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax SEDES
			iSedes.sort(function(a, b)
			{
				return a.idclub - b.idclub;
			});

return iSedes;	
}	

function cargarCanchasStart(){
	// 	clubabr:"B.VISTA"
	// dimensiones:"Ok"
	// extras:"BELLA VISTA"
	// foto:null
	// idcancha:"12"
	// idclub:"20"
	// idsede:"1"
	// nombre:"Gimnasio Central"
	// ubicacion "ENTRE RIOS 854"	
	iCanchas = new Array();
	$.ajax({ 
		 url:   './abms/obtener_canchas.php',
		 type:  'GET',
		 dataType: 'json',
		 async:false,
		 // EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
		 beforeSend: function (){},
		 done: function(data){},
		 success:  function (r){
			iCanchas = Object.values(r['Canchas']);
			 //console.log(iPosiciones);
		  },
		  error: function (xhr, ajaxOptions, thrownError) {}
		 }); // FIN funcion ajax	
 // TRAIGO UNA VEZ VECTOR DE PUESTOS			
 //PROBANDO LA CARGA UNICA DE LAS POSICIONES
 //alert(iPosiciones);	
  return iCanchas;		
}

function cargarCompetenciasStart()
{
	iCompetencias = new Array();
	$.ajax({ 
		url:   './abms/obtener_comps.php',
		 type:  'GET',
		 dataType: 'json',
		 async:false,
		 // EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
		 beforeSend: function (){},
		 done: function(data){},
		 success:  function (r){
			iCompetencias = Object.values(r['Competencias']);
			 //console.log(iPosiciones);
		  },
		  error: function (xhr, ajaxOptions, thrownError) {}
		 }); // FIN funcion ajax	
 // TRAIGO UNA VEZ VECTOR DE PUESTOS			
 //PROBANDO LA CARGA UNICA DE LAS POSICIONES
 return iCompetencias;	
}

function cargarCiudadesStart(){

iCiudades = new Array();
$.ajax({ 
	 url:   './abms/obtener_ciudades.php',
	 type:  'GET',
	 dataType: 'json',
	 async:false,
	 // EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
	 beforeSend: function (){},
	 done: function(data){},
	 success:  function (r){
		iCiudades = Object.values(r['Ciudades']);
		 //console.log(iPosiciones);
	  },
	  error: function (xhr, ajaxOptions, thrownError) {}
	 }); // FIN funcion ajax	
// TRAIGO UNA VEZ VECTOR DE PUESTOS			
//PROBANDO LA CARGA UNICA DE LAS POSICIONES
//alert(iPosiciones);	
return iCiudades;	
}

// +++++++++++++++++ FUNCIONES START DE VECTORES  ++++++++++++++++++++++++++++++++++++++


// +++++++++++++++++ FUNCIONES CREAR COMBOS SEGUN VECTORES EN MEMORIA  ++++++++++++++++++++++++++++++++++++++
function creaCategoriasx(nombreObj){
	// console.log('crear Categoria para : ' + "#"+nombreObj+"_"+idpartido );
	var selectCats = "";
			// esto arreglo el tema del alta triplle..

		$(vCategorias).each(function(i, v)
		{ // indice, valor
				// console.log('Datos categoria: '+v.descripcion);
				$("#"+nombreObj).append('<option value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
		});		
	
	return 	selectCats ;
	};

function buscarCiudadClub(clubOrigen)
{
	var selectEquipoCiudad = 0;
	$(vEquipos).each(function(i, v)
		{ // indice, valor
			if( v.idclub == clubOrigen)
				selectEquipoCiudad = v.idciudad;
		});		
	
	return 	selectEquipoCiudad ;

}

	function creaEquiposx(nombreObj){
	//	creaspuestosx(v.idjugador,puestoCategoria,'sjugadorp');
	//	console.log('jugador : ' + idjugador +' puesto : ' +puesto+ ' cargar: ' + nombreObj);
	var selectEquipos = "";
			// esto arreglo el tema del alta triplle..
		$(vEquipos).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj).append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
		});		
	
	return 	selectEquipos ;
	};

	function creaCanchasx(nombreObj){
	//	creaspuestosx(v.idjugador,puestoCategoria,'sjugadorp');
	//	console.log('jugador : ' + idjugador +' puesto : ' +puesto+ ' cargar: ' + nombreObj);
	var selectCanchas = "";
			// esto arreglo el tema del alta triplle..
		$(vCanchas).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj).append('<option value="' + v.idcancha + '">' +v.clubabr+' - '+ v.extras+' - '+ v.nombre + '</option>');
		});		
	
	return 	selectCanchas ;
	};

	function creasCompetenciasx(nombreObj)
{
	var selectCompetencia = "";
			// esto arreglo el tema del alta triplle..
		$(vCompetencias).each(function(i, v)
		{ // indice, valor
			if(v.competenciaActiva == 1)
				$("#"+nombreObj).append('<option value="' + v.idcomp + '">' + v.cnombre + '</option>');

		});		
		
	return 	selectCompetencia ;
}

function creasCiudadesx(nombreObj){
	//	creaspuestosx(v.idjugador,puestoCategoria,'sjugadorp');
	//	console.log('jugador : ' + idjugador +' puesto : ' +puesto+ ' cargar: ' + nombreObj);
	// Nombre:"Banfield"
	// idCiudad:"13"
	// provincia:"Buenos Aires"	
		var selectCiudad  = "";
			// esto arreglo el tema del alta triplle..
		$(vCiudades).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj).append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
			//alert(selectPuesto);
		});		
		
	return 	selectCiudad ;
};

function creasSedesx(nombreObj)
{
	var selectSede = "";
	var clubNombreAbr = "";

	// esto arreglo el tema del alta triplle..
		$(vSedes).each(function(i, v)
		{ // indice, valor

				$(vEquipos).each(function(u, w)
				{ // indice, valor
					 if (v.idclub == w.idclub) clubNombreAbr =  w.clubabr;
				});		
				// guardo la clave doble en el option value : v.idclub+"_"v.idsede	
				$("#"+nombreObj).append('<option value="' + v.idclub+"_"+v.idsede + '"> ( ' + clubNombreAbr+' )'+ v.direccion + '-'+v.extras +'</option>');
			//alert(selectPuesto);
		});		
		
	return 	selectSede ;

}
// +++++++++++++++++ FUNCIONES CREAR COMBOS SEGUN VECTORES EN MEMORIA  ++++++++++++++++++++++++++++++++++++++


// +++++++++++++++++++++++ FUNCIONES EN GENERAL +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
function SeleccionaClubLocal(objetoClubID)
{
	var clubOrigen = $("#"+objetoClubID).val();
	//console.log(vSedes);
	// borro objeto Cancha 
	// recorro objeto cancha, si encontré alguna, le asigno el valor de la primera que encuentro
	// necesito recorrer las sedes !!!!
	$(vSedes).each(function(i, v)
	{
		// la forma de llegar a la cancha, es atraves de la sede
		if (v.idclub == clubOrigen )
		{
			$(vCanchas).each(function(j, w)
			{ // indice, valor
				if( ( w.idclub == v.idclub ) && (w.idsede == v.idsede) )
				{
					//alert('encontre una cancha del club, me ubico ahi..club: '+ v.idclub +' cancha id ' +w.idcancha+ ' sede: '+w.idsede);
					$("#isede").val(v.idclub+"_"+v.idsede);
					//$("#icancha").val(w.idcancha);
					//asignar la ciudad tambien..
					ciudadCancha = buscarCiudadClub(clubOrigen);
					$("#icity").val(ciudadCancha);	
					//asignar la ciudad tambien..
					return true; //	solo lo hace una vez
					// return true; SIGUE CORRIENDO
				}
			});
		}
	}); 
}	
// +++++++++++++++++++++++ FUNCIONES EN GENERAL +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

function buscarClub(origen,destinoId){
	
	var parametros = {
    	"llamador" : "CPartidos",
    	"funcion" : "buscarclub",			
    	"filtro" : $("#"+origen).val(),
		};		         
		
         $.ajax({ 
            url:   './abms/obtener_varios.php',
            type:  'GET',
            data: parametros,
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
				$("#"+destinoId).empty();
    		},
            done: function(data){
			},
            success:  function (r){
 					
                $(r['Clubes']).each(function(i, v)
                { // indice, valor
              	if (! $("#"+destinoId).find("option[value='" + v.idclub + "']").length)
                	{
						$("#"+destinoId).append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
					}		
                });
             },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			 console.log(xhr);
			 console.log(thrownError);
			}
            }); // FIN funcion ajax CANCIONES todas:
};
//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 
function buscarCanchasClub(clubOrigen,destinoId){
	
	var parametros = {
    	"llamador" : "CPartidos",
    	"funcion" : "buscarcancha",			
    	"filtro" : clubOrigen,
		};		         
		
         $.ajax({ 
            url:   './abms/obtener_varios.php',
            type:  'GET',
            data: parametros,
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
				$("#"+destinoId).empty();
    		},
            done: function(data){
			},
            success:  function (r){
 				
 				if($(r['estado'])!= 99){
                $(r['Canchas']).each(function(i, v)
                { // indice, valor
						$("#"+destinoId).append('<option value="' + v.idcancha + '">' +v.clubabr+' - '+ v.extras+' - '+ v.nombre + '</option>');
				if(v.idciudad != 0)		
	                $("#icity").val(v.idciudad);
	            else
	            {
              	if (! $("#icity").find("option[value='0']").length)
                {
		             $("#icity").append('<option value="0">Club sin ciudad asignada aun..</option>');
					 $("#icity").val(v.idciudad);
				 } 
				}
                });
 				}	
 				else
 					$("#"+destinoId).append('<option value="' + r['estado'] + '">' +r['Canchas'] + '</option>');
             },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			 console.log(xhr);
			 console.log(thrownError);
			}
            }); // FIN funcion ajax CANCIONES todas:
};

	var parametros = {"CPartido" : "S"};		         

	<?php 
			if(isset($_GET["id"])) $partidoid = (int) $_GET["id"];
			else $partidoid = (int) $_POST["id"];
			
			$esNovedades=0;
						if(isset($_GET["novedad"])) $esNovedades = (int) $_GET["novedad"];
						else if(isset($_POST["novedad"])) $esNovedades = (int) $_POST["novedad"];
						
			$fecpartido="''";// sera string 
			if(isset($_GET["fechapart"])) $fecpartido = "'".$_GET["fechapart"]."'";
			else $fecpartido = "'".$_POST["fechapart"]."'";
			
	?>	
		var partidoID =0;
		var fechaPartido='';
		partidoID    = <?php echo $partidoid ?>;
		fechaPartido = <?php echo $fecpartido ?>;
		$("#fechap").val(fechaPartido);
		var vieneDeNovedad = 0;
		vieneDeNovedad = <?php echo $esNovedades; ?>;
    
	function modificar(){
    //QUE SE RECARGUE CUANDO PRESIONO CLICK..
    	//alert('Submit activado');
        // Guardamos el select de cursos
        //data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
		var parametros = {
			"idpartido":partidoID ,
        	"fechap" : $("#fechap").val(),
        	"icate" : $("#icate").val(),
        	"iclub" : $("#iclub").val(),
        	"iclubb" : $("#iclubb").val(),
        	"icancha" : $("#icancha").val(),
			"isede" : $("#isede").val(),
        	"icomp" : $("#icomp").val(),
        	"icity" : $("#icity").val(),
        	"horai" : $("#horai").val(),
        	"SetMaxCat" : $("#SetMaxCat").val(),
        	"SetMaxComp" : $("#SetMaxComp").val(),
			"valtbset":$("#valtbset").val(),
			"valfinset":$("#valfinset").val(),
			"ResA":$("#valRESULTADOA").val(),
			"ResB":$("#valRESULTADOB").val(),
			"descripcionp":$("#dscp").val()
	};		         
         $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/modificar_partido.php',
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
    			//$("mensaje").append('Partido ingresado');
					// console.log(r);
    				// if(vieneDeNovedad == 1){
					// 	window.location='NovedadesSet.php?'+'id='+partidoID+'&setid='+
					// 		<?php 
					// 			$setID=0;
					// 		    if(isset($_GET['setid'])) $setID = (int) $_GET['setid'];
					// 			echo($setID );
					// 		?>+'&setmax='+
					// 	<?php 
					// 		$setMAX =0;
					// 		if(isset($_GET['setmax'])) $setMAX = (int) $_GET['setmax'];
					// 		echo($setMAX);
					// 	?>+'&fecha='+<?php echo("'".$_GET['fechapart'])."'"; ?>+'&continuar=0';	
					// }
					// else
    				// {
					// 	window.location='AdministrarAPP.php';
					// };
            },
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				//$("#isede").append('<option value="9998">' + 'SUBMIT:: Error en el servidor Tabla Sedes..</option>');
            	//console.log("errorrrr");
            }
            }); // FIN funcion ajax		
	};
	

// //**************** PARTIDO: CABECERA *********************************************/
		$(document).ready(function(){
	
		
		 $("#fechap").val(fechaPartido);
		 
		 $("#FormPartidosMulti").submit(function(e){e.preventDefault();});			

		 vCategorias = cargarCategoriasStart();
		 vEquipos = cargarEqupoStart();
		 vCanchas = cargarCanchasStart();
		 vSedes   = cargarSedesStart();
		 vCiudades = cargarCiudadesStart();
		 vCompetencias = cargarCompetenciasStart();

		//CREAMOS LOS COMBOS EN BASE A LOS VECTORES..		
		 	creasCompetenciasx("icomp");
			creaCategoriasx('icate');
			creaEquiposx("iclub");
			creaEquiposx("iclubb");
		    creaCanchasx('icancha');
		    creasCiudadesx('icity');
			creasSedesx('isede');		


			var parametros = 
			{
	        	"id" : partidoID,				
	        	"fechapart" : fechaPartido
			};		  

		         $.ajax({ 
		            url:   './abms/obtener_partidoCab.php',
		            type:  'GET',
		            dataType: 'json',
		            data: parametros,
		            beforeSend: function (){
						// Bloqueamos el SELECT de los cursos
		    		},
		            done: function(data){
						
					},
		            success:  function (r){
		                $(r['Partido']).each(function(i, v)
		                { // indice, valor	
							$("#fechap").prop('disabled', true);
							$("#horai").prop('disabled', true);

							$("#valfinset").val(v.valFinSet);
							$("#valtbset").val(v.valTBSet);
							$("#icate").val(v.idcat);	
							$("#SetMaxCat").val(v.CatSetMax);
							$("#dscp").val(v.descripcionp);	
								$("#horai").val(v.Inicio);

							$("#valRESULTADOA").val(v.ClubARes); // x
							$("#valRESULTADOB").val(v.ClubBRes); // x
							
							$("#icomp").val(v.competencia);	
								$("#SetMaxComp").val(v.setsnmax);
							$("#iclubb").val(v.idclubb);
							$("#iclub").val(v.idcluba);
							$("#icancha").val(v.CanchaId);
							$("#isede").val(v.idcluba+"_"+v.idsede);
							$("#icity").val(v.ciudad);	
						});},
		             error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					}
		            }); // FIN funcion ajax CLUBES					

					$("#volver").click(function()
					{
						refe='';
							if(vieneDeNovedad == 1){
									window.location='NovedadesSet.php?'+'id='+partidoID+'&setid='+
									<?php 
									$setID=0;
									if(isset($_GET['setid'])) $setID = (int) $_GET['setid'];
									echo($setID );
									?>+'&setmax='+
									<?php 
									$setMAX =0;
									if(isset($_GET['setmax'])) $setMAX = (int) $_GET['setmax'];
									echo($setMAX);
									?>+'&fecha='+<?php echo("'".$_GET['fechapart'])."'"; ?>+'&continuar=0';	
							}
							else
									{window.location='AdministrarAPP.php';};
						
					});
						

					
		}); // parentesis del READY

		</script>
    </head>
<body>
  		<?php include('includes/newmenu.php'); ?>
  
	<section class="FormCargaPartidos">
		<form action="" method="post" name="FormPartidosMulti" id="FormPartidosMulti" enctype="multipart/form-data" class="PartidoCab"  onSubmit="modificar();">
				<input id="id" type="hidden" val="<?php 
							$partidoCLAVEACCESO = 0;
							if(isset($_GET["id"])) $partidoCLAVEACCESO = (int) $_GET["id"];
							else $partidoCLAVEACCESO = (int) $_POST["id"];
							echo $partidoCLAVEACCESO;
					?>" />
				
				
				<input id="fechapart" type="hidden" val="<?php
								$fecpartidoCLAVE="''";// sera string 
								if(isset($_GET["fechapart"])) $fecpartidoCLAVE = "'".$_GET["fechapart"]."'";
								else $fecpartidoCLAVE = "'".$_POST["fechapart"]."'";
								echo $fecpartidoCLAVE;
				?>" />
		<section class="Botonera">
				<span>Alta Partidos</span>
				<button class="btnCabecera" id="altap" name="altap" value="altap">(A+)</button>
						<input type="button" id="volver" title="volver a partidos" name="volver" class="btnNoCabecera" value="<<"></input>
			</section>
			<section class="Cabecera">
				<div>Competencia</div>
				<select id="icomp" name="icomp">
					<option value="9999">Seleccione una competencia</option>
				</select>
				<div class="SetMaximosGrid">
					<label>Sets</label>
					<input type="text" id="SetMaxComp" name="SetMaxComp" class="inputSets" disabled="">
				</div>	
			</section>

			<div class="DatosPartido">	
				<section class="DatosPartidoDetalle" id="DatosPartidoDetalle" name="DatosPartidoDetalle">
					<section id="DatosPartido_item" class="itemDatosPartidoDetalle">
						<div class="fechapartido">
						<label for="fechap">FECHA X</label>
						<input type="date" id="fechap" name="fechap"></div>
						<div class="renglonHoraCat">
							<div class="renHC1">
								<label for="dscp">CODIGO </label>
							</div>
							<div class="renHC2">
								<input type="text" id="dscp" name="dscp">
							</div>
							<div class="renHC3">
								<label for="horai">Hora inicio</label>
							</div>
							<div class="renHC4">
								<input type="time" id="horai" name="horai"></div>
							<div class="renHC5">
								<label for="icate">Categoria</label>
							</div>
							<div class="renHC6">
									<select name="icate" id="icate">
												<option value="9999">Seleccione una categoria</option>
									</select>
							</div>
							<div class="renHC7">
								<label>Sets </label>
							</div>
							<div class="renHC8">
								<input type="text" id="SetMaxCat" name="SetMaxCat" class="inputSets" disabled="">
							</div>
							<div class="renHC9">
								<label>Ptos Fin TBreak</label>
							</div>
							<div class="renHC91">
								<input type="text" id="valtbset" name="valtbset" class="inputSets" value="15">
							</div>
							<div class="renHC10">
								<label>Ptos Fin Set</label>
							</div>
							<div class="renHC101">
								<input type="text" id="valfinset" name="valfinset" class="inputSets" value="25">
							</div>

							<div class="renHC11">
								<label>Resultado Local</label>
							</div>
							<div class="renHC12">
								<input type="text" id="valRESULTADOA" name="valRESULTADOA" class="inputSets" value="">
							</div>

							<div class="renHC13">
								<label>Resultado Visitante</label>
							</div>
							<div class="renHC14">
								<input type="text" id="valRESULTADOB" name="valRESULTADOB" class="inputSets" value="">
							</div>

						</div>
						<div class="renglonEquipos">
							<div class="renEQ1">
								<label for="iclub">Local</label>
							</div>
							<div class="renEQ2">
								<input type="text" id="itextA" name="itextA" class="inputSearch" onkeyup="buscarClub(this.id,'iclub');">
							</div>
							<div class="renEQ3">
								<select name="iclub" id="iclub">
									<option value="9999">Seleccione un Club...</option>
								</select>
							</div>
							<div class="renEQ4">
									<label for="iclubb">Visitante</label>
							</div>
							<div class="renEQ5">
									<input type="text" id="itextB" name="itextB" class="inputSearch" onkeyup="buscarClub(this.id,'iclubb');">
							</div>
							<div class="renEQ6">
									<select name="iclubb" id="iclubb">
											<option value="9999">Seleccione un Club...</option>
									</select>
							</div>																		
						</div>
						<div class="renglonUbicacion">
								<div class="renUB10">
										<label for="icancha">Sedes</label>
								</div>
								<div class="renUB11">
								<select id="isede" name="isede" class="SelList">
												<option value="9999" selected="">Seleccione una sede</option>
										</select>
								</div>
								<div class="renUB1">
										<label for="icancha">Canchas</label>
								</div>
								<div class="renUB2">
										<select id="icancha" name="icancha" class="SelList">
												<option value="9999" selected="">Seleccione una cancha</option>
										</select>
								</div>
								<div class="renUB3">
										<label for="icity">Ciudades cargadas</label>
								</div>
								<div class="renUB4">
										<select id="icity" name="icity" class="SelList">
												<option value="9999">Seleccione una ciudad</option>
										</select>
								</div>
						</div>
					</section>
				</section> <!-- fin del item datos partido-->											
			</div>
		</form>
	 </section>	
</body>
</html>


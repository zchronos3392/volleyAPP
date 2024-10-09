<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>VOLLEY.APP:: Configurar sedes</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <style>
			.XSModales {
				height: -webkit-fill-available;
			}
			DIALOG {
				inset-inline-start: 0px;
				inset-inline-end: 0px;
				width: 100%;
			}
		</style>
	   <!--SCRIPTS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		 <!-- <script type="text/javascript" src="./scripts/nsanz_script.js"></script>  -->
<!--SCRIPTS-->
	   <script type="text/javascript">

		var vClubes = new Array();
		var vCiudades = new Array();
		var vSedes   = new Array();
		var vCanchas = new Array();

		function creaEquiposx(nombreObj){
		var selectEquipos = "";
				// esto arreglo el tema del alta triplle..
			$(vClubes).each(function(i, v)
			{ // indice, valor
					$("#"+nombreObj).append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
			});
		return 	selectEquipos ;
		};

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

function getClubDato(club,datoBusqueda){
//'escudo','clubabr'
	var  respuesta ='';
	$(vClubes).each(function(i, v)
	{ // indice, valor
			//$("#"+nombreObj).append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
			if(v.idclub == club){		
				
				if(datoBusqueda == 'escudo')
					return respuesta =v.escudo; 
				if(datoBusqueda == 'clubabr')
					return respuesta =v.clubabr;	

			}
	});
	return respuesta ;


}

function sedeUI(parametroBusqueda){
		//id="iclub",id="sedenom",id="direxsede"
		// $(vEquipos).each(function(u, w)
		// 		{ // indice, valor
		// 			 if (v.idclub == w.idclub) clubNombreAbr =  w.clubabr;
		// 		});		
		// 			// guardo la clave doble en el option value : v.idclub+"_"v.idsede	
		// 			$("#"+nombreObj+"_"+idpartido).append('<option value="' + v.idclub+"_"+v.idsede + '"> ( ' + clubNombreAbr+' )'+ v.direccion + '-'+v.extras +'</option>');

		$(".ContieneGrillaTabla").html('<div class="DetalleGrillaTabla barraCancha">'+
											'<div><span class="icon-upload" onclick="abreDialogo(\'ALTA\',0,0,\'\',\'\',\'\');"></span></div>'+
											'<div></div>'+
											'<div></div>'+
											'<div>CLUB LOGO</div>'+
											'<div>ID CLUB</div>'+
											'<div>CLUB NOMBRE</div>'+
											'<div>ID SEDE</div>'+
											'<div>SEDE NOMBRE</div>'+
											'<div>DIRECCION</div>'+
											'</div>');

			var conteoUI = 0;
			var renglonCancha = '';
			if(parametroBusqueda != -1)
			{
				$(vSedes).each(function(i, v)
				{ // indice, valor
						logoClub   = getClubDato(v.idclub,'escudo');
						var escudoSpan = '';	
						if(logoClub !='')
							escudoSpan = '<span><img  src="'+"img/escudos/"+logoClub+'" style="width:2em;height:2em;"></img><span>'; 
						else            	
							escudoSpan = '<span><img  src="img/jugadorGen.png" class="imgjugadorTablero" name="GENERICO" style="width:2em;height:2em;"></img></span>'; 

						clubnombre = getClubDato(v.idclub,'clubabr');

						if(parametroBusqueda == 0 || parametroBusqueda == 9999)
							{	
								//Logo,cnombre,competenciaActiva,idcomp,setnmax
								renglonCancha = '<div class="DetalleGrillaTabla">'+
												'<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idclub+','+v.idsede+',\''+v.extras+'\''+',\''+v.direccion+'\',\''+logoClub+'\');"></span></div>'+
												'<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idclub+','+v.idsede+',\''+v.extras+'\''+',\''+v.direccion+'\',\''+logoClub+'\');"></span></div>'+
												'<div>'+escudoSpan+'</div>'+
												'<div>'+v.idclub+'</div>'+
												'<div>'+clubnombre+'</div>'+
												'<div>'+v.idsede+'</div>'+
												'<div>'+v.extras+'</div>'+
												'<div>'+v.direccion+'</div>';
								$(".ContieneGrillaTabla").append(renglonCancha);
								conteoUI++;
						}			

						if(parametroBusqueda != 0)
						{
							if(v.idclub == parametroBusqueda)
							{	
								//Logo,cnombre,competenciaActiva,idcomp,setnmax
								renglonCancha = '<div class="DetalleGrillaTabla">'+
												'<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idclub+','+v.idsede+',\''+v.extras+'\''+',\''+v.direccion+'\',\''+logoClub+'\');"></span></div>'+
												'<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idclub+','+v.idsede+',\''+v.extras+'\''+',\''+v.direccion+'\',\''+logoClub+'\');"></span></div>'+
												'<div>'+escudoSpan+'</div>'+
												'<div>'+v.idclub+'</div>'+
												'<div>'+clubnombre+'</div>'+
												'<div>'+v.idsede+'</div>'+
												'<div>'+v.extras+'</div>'+
												'<div>'+v.direccion+'</div>';
								$(".ContieneGrillaTabla").append(renglonCancha);
								conteoUI++;
							} 	
						}			
				});
				$("#isedesLista").val(conteoUI);
			} // no es -1
}

	function abreDialogo(modo,clubID,sedeID,nombreSede,direccionSede,imgLogoClub){
	// ALTA, BAJA,MODIFICA
	//  \','+v.idclub+','+v.idsede+',\''+v.extras+'\',\''+clubnombre+'\',\''+v.direccion+'\',\''+logoClub+'\');"></span>	
	const modalForm =
		document.querySelector("#formularioAcciones");

	 $("#iclub").val(clubID);
	 $("#isede").val(sedeID);
	 $("#direxsede").val(direccionSede);	
	 $("#sedenom").val(nombreSede);	
	 
	modalForm.showModal();
	
	}	

		// cuando PRESIONO CLICK , LO ACTUALIZO
		$(document).ready(function(){


			vClubes = cargarEqupoStart();
			creaEquiposx('iclubFiltro');
			creaEquiposx('iclub');
			vSedes   = cargarSedesStart();
				sedeUI(0);

//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	
$("#itextbuscarFiltro").keyup(function()
		{   
			var filtro = $("#itextbuscarFiltro").val();
			$("#iclubFiltro").empty();
			//$("#iclubFiltro").append('<option value="9999">Seleccionar Club...</option>');
			var cargado = 0;
			var clubElegible =0;
			$(vClubes).each(function(i, v)				
			{ // indice, valor

				if(( v.clubabr.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 ) || ( v.nombre.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 )) 
				{
					$("#iclubFiltro").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
					clubElegible = v.idclub;
					cargado++;

				}
			});
			if(filtro == '') sedeUI(0);
				if(cargado == 1 ) sedeUI(clubElegible);
		});

		    // AJAX DE CARGA POR ID DE CATEGORIAS
			$("#iclubFiltro").on("click change",function()
				{
					var parametroBusqueda =  $("#iclubFiltro").val();	
					//$("#isede2").empty();
						sedeUI(parametroBusqueda);
				});//change del ICATEGORIA

		//**************** busqueda clubes con jquery *********************************************/      
		$("#CerrarDiagX").click(function(){
			const modalForm =
						document.querySelector("#formularioAcciones");

			modalForm.close();
		});
				

		$("#btnAddSede").click(function(){
			if( ($("#sedenom").val() != '') &&  ($("#direxsede").val() != '')  )
	        {
				var parametros = {
					"sedenom" : $("#sedenom").val(),
					"direxsede" : $("#direxsede").val(),
					"iclub" : $("#iclub").val()
				};		         
				
				$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
					url:   './abms/insertar_sede.php',
					type:  'POST',
					data: parametros,
					beforeSend: function (){},
					
					success:  function (r){
						location.reload();
					},
					//error: function() {
					error: function (xhr, ajaxOptions, thrownError) {}
					}); // FIN funcion ajax
			} // else THIS.VAL <> ''
	        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
			{
			}


		});

		$("#btnDelSede").click(function(){
			var parametros = {"isede2" : $("#isede").val()}
            $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/borrar_sede.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){},
            
            success:  function (r){location.reload();},
            //error: function() {
			error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax
           			
		});

		$("#btnModSede").click(function(){
			var parametros = {
				 "idsede" : $("#isede").val(),
				 "idclub" : $("#iclub").val(),
				  "snom" : $("#sedenom").val(),
				  "direccion" : $("#direxsede").val()
				 };	
			 $.ajax({ 
				url:   './abms/actualiza_sede.php',
				type:  'POST',
				data: parametros ,
				datatype:   'text json',
				beforeSend: function (){},
				done: function(data){},
				success:  function (r){location.reload();},
				error: function (xhr, ajaxOptions, thrownError){console.log(thrownError);}
				});			
		});			

            
		}); // parentesis del READY

		</script>		
    </head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
    </header>
	<dialog id="formularioAcciones"	class="XSModales">
		<h3>Ingreso de Ciudades</h3>
		<section id="Acciones" name="Acciones" class="Acciones">	
			<button id="btnAddSede" name="btnAddSede" class="butSquareEqBluFull" >ADD</button>
			<button id="btnDelSede" name="btnDelSede" class="butSquareEqRedRackam">DEL</button>
			<button id="btnModSede" name="btnModSede" class="butSquareEqOrang">MOD</button>
			<button id="CerrarDiagX" name="CerrarDiagX" class="butSquareEqGreen">X</button>
		</section>	
	<h3>Ingreso de Sedes</h3>	
   <form id="formConfig" name="formsedes"  class="formSedes">
		<label for="iclub">Club</label>
		<input id="isede" name="isede" type="hidden"></input>
		<select id="iclub" class="SelList"> 
        <option value="1" selected>Seleccione un CLUB</option>
    	</select>
		<!-- el POST SOLO VE LO QUE TIENE NAME, sino no lo ve.-->
		<label for="sedenom">Nombre sede</label>
		<input id="sedenom" name="sedenom" type="text">
		<label for="direxsede">direccion</label>
		<input id="direxsede"	name="direxsede" "text">
	</form>
	</dialog>
<!-- visualizacion de carga -->	
<div class="ContieneGrillaBusqueda">
	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">buscar Club</div>
			<div><input type="text" id="itextbuscarFiltro" name="itextbuscarFiltro" class="inputSearch"/></div>
	</div>

	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">Clubes</div>
	<div><select id="iclubFiltro" name="iclubFiltro" class="SelList"> 
			<option value="9999" selected>Seleccione un club</option>
			</select> 
	</div>
	</div>
	<div class="DetalleGrillaBusqueda">
			<!-- contador de registros listados -->
			<div>Sedes</div>
			<div><input type="number" id="isedesLista" name="icompsLista" disabled /></div>
	</div>		

</div>


<div class="ContieneGrillaTabla">
	<div class="DetalleGrillaTabla barraCancha">
			<div><span class="icon-upload" onclick="abreDialogo('ALTA',0,0,'','','');"></span></div>
			<div></div>
			<div></div>
			<div>CLUB LOGO</div>
			<div>ID CLUB</div>
			<div>CLUB NOMBRE</div>
			<div>ID SEDE</div>
			<div>SEDE NOMBRE</div>
			<div>DIRECCION</div>
			</div>	
</div>
<!-- visualizacion de carga -->		
</body>
</html>


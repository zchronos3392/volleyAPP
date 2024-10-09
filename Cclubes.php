<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			VOLLEY.APP::Configurar Clubes
		</title>
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
		<script type="text/javascript">

		var vEquipos = new Array();
		var vCiudades = new Array();


		function creaEquiposx(nombreObj){
		var selectEquipos = "";
				// esto arreglo el tema del triplle..
			$(vEquipos).each(function(i, v)
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
		//CanchasRegistradas:"1"
		// SedesRegistradas: "1"
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

	function creasCiudadesx(nombreObj){
	//	creaspuestosx(v.idjugador,puestoCategoria,'sjugadorp');
	//	console.log('jugador : ' + idjugador +' puesto : ' +puesto+ ' cargar: ' + nombreObj);
	// Nombre:"Banfield"
	// idCiudad:"13"
	// provincia:"Buenos Aires"	
		var selectCiudad = "";
			// esto arreglo el tema del alta triplle..
		$(vCiudades).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj).append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
			//alert(selectPuesto);
		});		
		
	return 	selectCiudad ;
	};		
	function obtenerCiudad(idciudad){

	var ciudadNombre = 'Sin ciudad';	
		$(vCiudades).each(function(i, v)
		{ // indice, valor
				if(v.idCiudad == idciudad){
						//alert(v.Nombre+'-'+v.provincia);
						return ciudadNombre = v.Nombre+'-'+v.provincia;
				}		
			//alert(selectPuesto);
		});		
	    return ciudadNombre;
	}

	function clubesUI(parametroBusqueda){

		var verSinCiudad = 0;
		if ($("#sinciudad").is(":checked")) {
					verSinCiudad = 1; // it is checked
		};

		var verSinEscudo = 0;
		if ($("#sinescudo").is(":checked")) {
				verSinEscudo = 1; // it is checked
		};

		var verSinSedes = 0;
		if ($("#sinsedes").is(":checked")) {
				verSinSedes = 1; // it is checked
		};

		var verSinCancha = 0;
		if ($("#sincancha").is(":checked")) {
			verSinCancha = 1; // it is checked
		};


		$(".ContieneGrillaTabla").html('<div class="DetalleGrillaTabla barraCancha">'+
												'<div><span class="icon-upload" onclick="abreDialogo(\'ALTA\',0,\'\',\'\',\'\');"></span></div>'+
												'<div></div>'+
												'<div></div>'+
												'<div>Escudo</div>'+
												'<div>Id</div>'+
												'<div>Abreviado</div>'+
												'<div>Nombre</div>'+
												'<div>Ciudad</div>'+
												'<div></div>'+
												'</div>');

				var conteoUI = 0;
				var renglonCancha = '';
				if(parametroBusqueda != -1)
				{
					$(vEquipos).each(function(i, v)
					{ // indice, valor
						var escudoSpan = '';	
						if(v.escudo !='' && v.escudo != '9999')
							escudoSpan = '<span><img  src="'+"img/escudos/"+v.escudo+'" style="width:2em;height:2em;"></img><span>'; 
						else            	
							escudoSpan = '<span><img  src="img/jugadorGen.png" class="imgjugadorTablero" name="GENERICO" style="width:2em;height:2em;"></img></span>'; 
							var nombreCiudad = obtenerCiudad(v.idciudad);
							var claseActivada = 'class="barraActiva"';
							if(v.idciudad != 0)
								claseActivada = ' ';

							//CanchasRegistradas:"1"
							// SedesRegistradas: "1"	
							//verSinSedes ,verSinCancha = 0;

							if(parametroBusqueda == 0 || parametroBusqueda == 9999)
							 {	
								if( ((verSinCiudad == 1 && v.idciudad == 0) || (verSinCiudad == 0 ))
									 && ((verSinEscudo ==1 && v.escudo == '') || (verSinEscudo == 0))
									 && ((verSinSedes == 1 && v.SedesRegistradas == 0) || (verSinSedes == 0))
									 && ((verSinCancha == 1 && v.CanchasRegistradas == 0) || (verSinCancha == 0))
									) 
									{								
									//BUSCO UN CLUB ESPECIFICO, PERO SIN ESTAN LOS CHECKS TILDADOS Y NO CUMPLE, NO LO MUESTRO								
										renglonCancha = '<div class="DetalleGrillaTabla">'+
														'<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idclub+',\''+v.escudo+'\',\''+v.clubabr+'\',\''+v.nombre+'\','+v.idciudad+');"></span></div>'+
														'<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idclub+',\''+v.escudo+'\',\''+v.clubabr+'\',\''+v.nombre+'\','+v.idciudad+');"></span></div>'+
														'<div>'+escudoSpan+'</div>'+
														'<div>'+v.idclub+'</div>'+
														'<div>'+v.clubabr+'</div>'+
														'<div>'+v.nombre+'</div>'+
														'<div '+claseActivada+'>'+nombreCiudad+'</div>'+
														'<div></div>';
										$(".ContieneGrillaTabla").append(renglonCancha);
										conteoUI++;
									}

							}			

							if(parametroBusqueda != 0)
							{
								if(v.idclub == parametroBusqueda)
								{	
								  if( ((verSinCiudad == 1 && v.idciudad == 0) || (verSinCiudad == 0 ))
									 && ((verSinEscudo ==1 && v.escudo == '') || (verSinEscudo == 0))
									 && ((verSinSedes == 1 && v.SedesRegistradas == 0) || (verSinSedes == 0))
									 && ((verSinCancha == 1 && v.CanchasRegistradas == 0) || (verSinCancha == 0))									
									) 
									{								
								  //BUSCO UN CLUB ESPECIFICO, PERO SIN ESTAN LOS CHECKS TILDADOS Y NO CUMPLE, NO LO MUESTRO									
									renglonCancha = '<div class="DetalleGrillaTabla">'+
													'<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idclub+',\''+v.escudo+'\',\''+v.clubabr+'\',\''+v.nombre+'\','+v.idciudad+');"></span></div>'+
													'<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idclub+',\''+v.escudo+'\',\''+v.clubabr+'\',\''+v.nombre+'\','+v.idciudad+');"></span></div>'+
													'<div>'+escudoSpan+'</div>'+
													'<div>'+v.idclub+'</div>'+
													'<div>'+v.clubabr+'</div>'+
													'<div>'+v.nombre+'</div>'+
													'<div>'+nombreCiudad+'</div>'+
													'<div></div>';
									$(".ContieneGrillaTabla").append(renglonCancha);
									conteoUI++;
									}
								} 	
							}			
					});
					$("#iclubLista").val(conteoUI);
				} // no es -1
		}

		function abreDialogo(modo,clubID,escudo,clubAbreviatura,clubNombre,clubCiudad){
			// ALTA, BAJA,MODIFICA
		const modalForm =
				document.querySelector("#formularioAcciones");
		// if(modo == 'BAJA' || modo == 'MODIFICA')
		// {
			$("#escudo").attr("src","img/escudos/"+escudo);
			$("#idcluboculto").val(clubID);
			$("#nombre").val(clubNombre);
			$("#iciudadclub").val(clubCiudad); 
			$("#clubabr").val(clubAbreviatura);
			$("#iescudosclub").val(escudo); // Es un select/array que debe cargarse
		// }		
		modalForm.showModal();

	}	

			$(document).ready(function() {
				// Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
				<?php
				require_once('./abms/SesionTabla.php');
				$ingreso='';
				$graboSesion = SesionTabla::getsession("'".$_SERVER['REMOTE_ADDR']."'");
				if ((int)$graboSesion["sesid"] !=0) {
					echo('var sesion =1;');
					$_SESSION['INGRESO'] ="SI";
				} else {

					$_SESSION['INGRESO'] ="";
					echo('var sesion =0;');
				}
				?>

				if (sesion == 0 )
					location.href='index.php';
				// stopwatchjquery
			vEquipos = cargarEqupoStart();
			creaEquiposx('iclub');
			creaEquiposx('iclubFiltro');
			vCiudades = cargarCiudadesStart();
			creasCiudadesx('iciudadclub');			
					clubesUI(0);


		    // AJAX DE CARGA POR ID DE CATEGORIAS
			$("#iclubFiltro").on("click change",function()
				{
					var parametroBusqueda =  $("#iclubFiltro").val();	
					//$("#isede2").empty();
						clubesUI(parametroBusqueda);
				});//change del ICATEGORIA

				$("#sinciudad").on("click change",function(){
					if($("#iclubFiltro").length == 1 )
						clubesUI($("#iclubFiltro").val());
					else
						clubesUI(0);
				}); // SIN CIUDAD

				$("#sinescudo").on("click change",function(){
					if($("#iclubFiltro").length == 1 )
						clubesUI($("#iclubFiltro").val());
					else
						clubesUI(0);

				}); // SIN ESCUDO AUN...			

				$("#sinsedes").on("click change",function(){
					if($("#iclubFiltro").length == 1 )
						clubesUI($("#iclubFiltro").val());
					else
						clubesUI(0);
				}); // SIN SEDES

				$("#sincancha").on("click change",function(){
					if($("#iclubFiltro").length == 1 )
						clubesUI($("#iclubFiltro").val());
					else
						clubesUI(0);

				}); // SIN CANCHAS			


//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	
		$("#itextbuscarFiltro").keyup(function()
		{   
			var filtro = $("#itextbuscarFiltro").val();
			$("#iclubFiltro").empty();
			//$("#iclubFiltro").append('<option value="9999">Seleccionar Club...</option>');
			var cargado = 0;
			var clubElegible =0;
			$(vEquipos).each(function(i, v)				
			{ // indice, valor

				if(( v.clubabr.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 ) || ( v.nombre.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 )) 
				{
					$("#iclubFiltro").append('<option value="' + v.idclub + '">' +v.clubabr+' - ' + v.nombre + '</option>');
					clubElegible = v.idclub;
					cargado++;

				}
			});
			if(filtro == '') clubesUI(0);
				if(cargado == 1 ) clubesUI(clubElegible);
		});
//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	
		$("#CerrarDiagX").click(function(){
			const modalForm =
						document.querySelector("#formularioAcciones");

			modalForm.close();
		});
				

		$("#btnAddClub").click(function(){
			//INGRESO DE NUEVO CLUB.
			//QUE SE RECARGUE CUANDO PRESIONO CLICK..
				//alert('Submit activado');
				// Guardamos el select de cursos
				if( ($("#nombre").val() != '') &&  ($("#clubabr").val() != '') )
				{
				// el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
				//data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
				var parametros = {
					"nombre" : $("#nombre").val(),
					"ciudad" : $("#iciudadclub").val(),
					"clubabr" : $("#clubabr").val(),
					"escudo"  : $("#iescudosclub").val()
			};		         
				
				$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
					url:   './abms/insertar_club.php',
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

		$("#btnDelClub").click(function(){
			var parametros = {
					"iclub" : $("#idcluboculto").val()
				};		         
				$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
					url:   './abms/borrar_club.php',
					type:  'POST',
					data: parametros,
					beforeSend: function (){},
					
					success:  function (r){
						location.reload();
					},
					//error: function() {
					error: function (xhr, ajaxOptions, thrownError) {}
					}); // FIN funcion ajax

		});

		$("#btnModClub").click(function(){

			var parametros = {
					"idClub" : $("#idcluboculto").val(),
					"nombre" : $("#nombre").val(),
					"ciudad" : $("#iciudadclub").val(),
					"clubabr" : $("#clubabr").val(),
					"escudo"  : $("#iescudosclub").val()
			};		         

			$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
					url:   './abms/actualiza_club.php',
					type:  'POST',
					data: parametros,
					beforeSend: function (){},
					
					success:  function (r){
						location.reload();
					},
					//error: function() {
					error: function (xhr, ajaxOptions, thrownError) {}
					}); // FIN funcion ajax

		});

		
			$("#iescudosclub").on("change click",function(){
				if($("#iescudosclub").val() == '9999')
					$("#escudo").attr("src","img/jugadorGen.png");
				else
					$("#escudo").attr("src","img/escudos/"+$("#iescudosclub").val());
				});

			
			}); // parentesis del READY		
		
		</script>
		
		
    </head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
    </header>
<!-- <section class="gridControl">
  <div class="icc1"></div>
  <div class="icc2"> -->
  <dialog id="formularioAcciones"	class="XSModales">
  <h3>Ingreso de clubes</h3>	
	<section id="Acciones" name="Acciones" class="Acciones">	
			<button id="btnAddClub" name="btnAddClub" class="butSquareEqBluFull" >ADD</button>
			<button id="btnDelClub" name="btnDelClub" class="butSquareEqRedRackam">DEL</button>
			<button id="btnModClub" name="btnModClub" class="butSquareEqOrang">MOD</button>
			<button id="CerrarDiagX" name="CerrarDiagX" class="butSquareEqGreen">X</button>
	</section>	

	<form id="formConfig" name="formClubes"  class="formClubes ">
	 <div class="ffclubes">
			<div class="ffclubes1"><label for="escudo">Escudo</label></div>
			<div class="ffclubes2">
					<select id="iescudosclub" name="iescudosclub">
					<option value="9999">Seleccionar escudo</option>
					<?php 
						$imagenEncontrada = scandir('./img/escudos/');
						echo "<option value=''>Escudo vacío</option>";
						foreach($imagenEncontrada as $indice => $valor)
							if($valor != "." && $valor != ".." && $valor != "" )
						  			echo "<option value='$valor'>$valor</option>";
					?>
				</select>
			</div>	
			<div class="ffclubes3">
				<img  src="img/jugadorGen.png" class="imgjugador" id="escudo"></img>
		    </div>		
		<div class="ffclubes4">
			<label for="nombre">Nombre club</label>
		</div>	
		<div class="ffclubes5">
			<input id="idcluboculto" name="idcluboculto" type="hidden"></input>
			<input id="nombre" name="nombre" type="text"></input>
		</div>
		<div class="ffclubes51">
			<label for="iciudadclub">ciudad</label>
		</div>
		<div class="ffclubes52">
			<select id="iciudadclub" name="iciudadclub"  class="SelList"></select>
		</div>				
		<div class="ffclubes6"><label for="clubabr">abreviatura</label></div>
		<div class="ffclubes7"><input id="clubabr"	name="clubabr" type="text"></input></div>
		<div class="ffclubes8">
			<!-- <button id="btnIngreso"   name="btnIngreso" value="+" class="btnIngreso">+</button> -->
		</div>
	 </div>	
	</form>
</dialog>
	<!-- visualizacion de carga -->		
	<div class="ContieneGrillaBusqueda">
	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">buscar CLUB</div>
			<div><input type="text" id="itextbuscarFiltro" name="itextbuscarFiltro" class="inputSearch"/></div>
	</div>
	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">Clubes</div>
	<div><select id="iclubFiltro" name="iclubFiltro" class="SelList"> 
			<option value="9999" selected>Seleccione una club</option>
			</select> 
	</div>
	</div>
	<div class="DetalleGrillaBusqueda">	
		<div class="barraFiltrosCancha">Sin Ciudad</div>
		<div><input id="sinciudad"  class="CheckActivar" name="sinciudad" type="checkbox"></div>
		<div class="barraFiltrosCancha">Sin Escudo</div>
		<div><input id="sinescudo"  class="CheckActivar" name="sinescudo" type="checkbox"></div>
	</div>	
	<div class="DetalleGrillaBusqueda">			
		<div class="barraFiltrosCancha">Sin Sedes</div>
		<div><input id="sinsedes"  class="CheckActivar" name="sinsedes" type="checkbox"></div>
		<div class="barraFiltrosCancha">Sin Canchas</div>
		<div><input id="sincancha"  class="CheckActivar" name="sincancha" type="checkbox"></div>		
	</div>
	</div>

	<div class="DetalleGrillaBusqueda">
			<div>Clubes</div>
			<div><input type="number" id="iclubLista" name="iclubLista" disabled /></div>
	</div>		

</div>


<div class="ContieneGrillaTabla">
	<div class="DetalleGrillaTabla barraCancha">
			<div><span class="icon-upload" onclick="abreDialogo('ALTA',0,0,0,'','','',0);"></span></div>
			<div></div>
			<div></div>
			<div>Escudo</div>
			<div>Abreviatura</div>
			<div>Nombre</div>
			<div>Ciudad</div>
			<div>Sets máximos jugables</div>
			<div></div>
			</div>	
</div>
</body>
</html>


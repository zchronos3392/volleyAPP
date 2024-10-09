<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			VOLLEY.APP::Configurar Competencia
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

		var vCompetencias = new Array();			

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


		function comptenciaUI(parametroBusqueda){
		//Logo,cnombre,competenciaActiva,idcomp,setnmax
		$(".ContieneGrillaTabla").html('<div class="DetalleGrillaTabla barraCancha">'+
											'<div><span class="icon-upload" onclick="abreDialogo(\'ALTA\',0,\'\',0,0,\'\',\'\',\'\');"></span></div>'+
											'<div></div>'+
											'<div></div>'+
											'<div>ID</div>'+
											'<div>Max Cant Sets</div>'+
											'<div>Nombre</div>'+
											'<div>Logo</div>'+
											'<div>Fecha Inicio</div>'+
											'<div>Fecha Fin</div>'+
											'</div>');

			var conteoUI = 0;
			var renglonCancha = '';
			if(parametroBusqueda != -1)
			{
				$(vCompetencias).each(function(i, v)
				{ // indice, valor
						var logoNombre= "";
						if(v.Logo != "''")
							logoNombre= "\'"+v.Logo+"\'";

						if(parametroBusqueda == 0 || parametroBusqueda == 9999)
							{	
								//Logo,cnombre,competenciaActiva,idcomp,setnmax
								//v.Logo SIEMPRE TIENE QUE VENIR CON LOS '' SINO TIENE LOGO...
								imagenlogocompetencia = "";
								if( logoNombre != ''){
									var LogoCompetenciaArchivo = v.Logo.replace("'","");
										LogoCompetenciaArchivo = v.Logo.replace("\'","");
									if(LogoCompetenciaArchivo != '')	
										imagenlogocompetencia = '<img src="img/competencias/'+LogoCompetenciaArchivo+'" class="imglogocompetenciaVer" id="miLogo3" name="miLogo3" >';
								}




								renglonCancha = '<div class="DetalleGrillaTabla">'+
												'<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idcomp+',\''+v.cnombre+'\','+v.setnmax+','+v.competenciaActiva+','+logoNombre+',\''+v.FechaInicioComp+'\',\''+v.FechaFinComp+'\');"></span></div>'+
												'<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idcomp+',\''+v.cnombre+'\','+v.setnmax+','+v.competenciaActiva+','+logoNombre+',\''+v.FechaInicioComp+'\',\''+v.FechaFinComp+'\');"></span></div>'+
												'<div>'+v.idcomp+'</div>'+
												'<div>'+v.setnmax+'</div>'+
												'<div>'+v.cnombre+'</div>'+
												'<div>'+imagenlogocompetencia+'</div>'+
												'<div>'+v.FechaInicioComp+'</div>'+
												'<div>'+v.FechaFinComp+'</div>';
								$(".ContieneGrillaTabla").append(renglonCancha);
								conteoUI++;
						}			

						if(parametroBusqueda != 0)
						{
							if(v.idcomp == parametroBusqueda)
							{	
								//Logo,cnombre,competenciaActiva,idcomp,setnmax

								renglonCancha = '<div class="DetalleGrillaTabla">'+
												'<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idcomp+',\''+v.cnombre+'\','+v.setnmax+','+v.competenciaActiva+','+logoNombre+',\''+v.FechaInicioComp+'\',\''+v.FechaFinComp+'\');"></span></div>'+
												'<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idcomp+',\''+v.cnombre+'\','+v.setnmax+','+v.competenciaActiva+','+logoNombre+',\''+v.FechaInicioComp+'\',\''+v.FechaFinComp+'\');"></span></div>'+
												'<div>'+v.idcomp+'</div>'+
												'<div>'+v.setnmax+'</div>'+
												'<div>'+v.cnombre+'</div>'+
												'<div>'+imagenlogocompetencia+'</div>'+
												'<div>'+v.FechaInicioComp+'</div>'+
												'<div>'+v.FechaFinComp+'</div>';
								$(".ContieneGrillaTabla").append(renglonCancha);
								conteoUI++;
							} 	
						}			
				});
				$("#icompsLista").val(conteoUI);
			} // no es -1
		}

	function abreDialogo(modo,competenciaID,cnombre,MaxCanSet,activada,LogoSrc,FechaInicio,FechaFin){
	// ALTA, BAJA,MODIFICA
	//Logo,cnombre,competenciaActiva,idcomp,setnmax	
	const modalForm =
		document.querySelector("#formularioAcciones");
	 $("#idcompetencia").val(competenciaID);
	 $("#nombre").val(cnombre);
	 $("#SetMaxCate").val(MaxCanSet); 

	 if(modo == 'MODIFICA')
	 	$("#accion").val('UPD');
	else
		if(modo == 'BAJA')
	 		$("#accion").val('DEL');	

	 if(activada == 1)
		{
			$("#SetActivo").attr('checked', true);
			//POR SINO FUNCIONA EL ANTERIOR
			$("#SetActivo").prop('checked',true);
		}	
		imagenlogocompetencia = 'img/competencias/'+LogoSrc;	//.replace(/'/g, "");	//.slice(1).slice(0,-1);
		if(LogoSrc != undefined && LogoSrc != '')
			{
				$('#miLogo2').attr('src',imagenlogocompetencia);
				$('#miLogo2').show();
				//css("display", "block");
			}			
		else
			$('#miLogo2').hide();

		var f=new Date();
					var Listadias = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
								,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
								,"27","28","29","30","31");
		var meses = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
		var fechaDefectoCompetencia = (f.getFullYear()) + "-" + meses[f.getMonth()] + "-" +Listadias[(0)] ;
					
		if(modo == 'ALTA')
			$("#FechaInicioComp").val(fechaDefectoCompetencia);
		else
			$("#FechaInicioComp").val(FechaInicio);

		if(modo == 'ALTA')		
			$("#FechaFinComp").val(fechaDefectoCompetencia);
		else
			$("#FechaFinComp").val(FechaFin);



	modalForm.showModal();
	
	}			

		/**************************************************************/
		$(document).ready(function(){
			// Hacemos la lógica que cuando nuestro SELECT cambia de valor haga algo
			$('#miLogo2').css("display", "none");

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
			

			vCompetencias = cargarCompetenciasStart();
				creasCompetenciasx("icompetenciaFiltro");
				comptenciaUI(0);



		    // AJAX DE CARGA POR ID DE CATEGORIAS
	$("#icompetenciaFiltro").on("click change",function()
		{
			var parametroBusqueda =  $("#icompetenciaFiltro").val();	
			comptenciaUI(parametroBusqueda);
		});//change del ICATEGORIA

//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	
		$("#itextbuscarFiltro").keyup(function()
		{   
			var filtro = $("#itextbuscarFiltro").val();
			$("#icompetenciaFiltro").empty();
			var cargado = 0;
			var compElegible =0;
			$(vCompetencias).each(function(i, v)				
			{ // indice, valor

				if(( v.cnombre.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 )) 
				{
						$("#icompetenciaFiltro").append('<option value="' + v.idcomp + '">' + v.cnombre + '</option>');
					compElegible = v.idcomp;
					cargado++;

				}
			});
			if(filtro == '') comptenciaUI(0);
				if(cargado == 1 ) comptenciaUI(compElegible);
		});

		$("#CerrarDiagX").click(function(){
			const modalForm =
						document.querySelector("#formularioAcciones");

			modalForm.close();
		});
				

		$("#btnAddComp").on("click",function(){
//		$("#formConfigComp").on('submit', function(e){
			//e.preventDefault();
			const FormularioElegido = document.getElementById('formCompetencia');
			$.ajax({ //el signo de pregunta apunta a la 
				url:   './abms/insertar_competencia.php',
				type:  'POST',
	            data: new FormData(FormularioElegido),
	             contentType: false,
	             cache: false,
	             processData:false,
				beforeSend: function (){},
				success:  function (r){
					// event.stopPropagation();
					//alert(r);
						location.reload();
				},
				error: function (xhr, ajaxOptions, thrownError) {
						//alert(xhr);
				}
			}); // FIN funcion ajax					
		});

		$("#btnDelComp").click(function(){
			var parametros =  $("#formCompetencia").serialize();
			$.ajax({ //el signo de pregunta apunta a la 
         			//direccion url base que es donde corre equipos.php
            url:   './abms/actualiza_competencia.php',
            type:  'POST',
	            data: parametros,
	            // contentType: false,
	            // cache: false,
	            // processData:false,
            beforeSend: function (){},
            success:  function (r){
				//event.stopPropagation();
					location.reload();
			},
			error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax		

		});

		$("#btnModComp").click(function(){
			//var parametros =  $("#formCompetencia").serialize();
			const FormularioElegido = document.getElementById('formCompetencia');
			$.ajax({ //el signo de pregunta apunta a la 
         			//direccion url base que es donde corre equipos.php
            url:   './abms/actualiza_competencia.php',
            type:  'POST',
	            data: new FormData(FormularioElegido),
	             contentType: false,
	             cache: false,
	             processData:false,
            beforeSend: function (){},
            success:  function (r){
				//event.stopPropagation();
					location.reload();
			},
			error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax			
		});			
		// PARA CARGAR LA IMAGEN LUEGO DE SELECCIONARLA
		const imagenACargar = document.getElementById('miLogo2');//control IMG
		const imagenSeleccionada = document.getElementById('ControlelegirLogo'); //control file
		imagenSeleccionada.addEventListener('change', e => {
			console.log( e.target.files[0] );
			if(e.target.files[0]) // si existe ,osea no fue cancelada la carga
			{
				const reader = new FileReader(); //objeto de js para leer archivos..ES ASINCRONICO
				reader.onload = function ( e ){
					$('#miLogo2').attr('src',e.target.result);
					$('#miLogo2').show();
				}
				reader.readAsDataURL(e.target.files[0]) // lo conviente a dataBase64, para poder entenderlo.
			}

		})
		$("#ControlelegirLogo").hide();

     });	// FINAL DEL READY
			
		</script>

		
    </head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
    </header>
	<dialog id="formularioAcciones"	class="XSModales">
		<form id="formCompetencia" name="formCompetencia" class="formCategoria" enctype='multipart/form-data'>
		<h3>Ingreso de Competencias</h3>
		<section id="Acciones" name="Acciones" class="Acciones">	
			<button id="btnAddComp" name="btnAddComp" class="butSquareEqBluFull" type="button" >ADD</button>
			<button id="btnDelComp" name="btnDelComp" class="butSquareEqRedRackam">DEL</button>
			<button id="btnModComp" name="btnModComp" class="butSquareEqOrang" type="button" >MOD</button>
			<button id="CerrarDiagX" name="CerrarDiagX" class="butSquareEqGreen">X</button>
		</section>	
    	<label for="nombre"  class="">Nombre</label>
    	<input id="nombre"  name="nombre" type="text">
		<input id="accion"  name="accion" type="hidden">
		<input id="idcompetencia"  name="idcompetencia" type="hidden">
    	 <p>
    	 <div class="GridConfigCompes">
	    	 <div class="gridcCompesIt1">
		    	 Max Cant. Sets
	    	 </div>	
	    	<div class="gridcCompesIt2">
	    		<input type="text" id="SetMaxCate" name="SetMaxCate" class="inputSets" />
	        </div>
	        <div class="gridcCompesIt3">
	    	 	Activo
	    	 </div>
	        <div class="gridcCompesIt4">
	    	 	<input type="checkbox" id="SetActivo" name="SetActivo" class="inputSets" />
	    	 </div>

			 <div class="gridcCompesIt411">
	    	 	<label for="FechaInicioComp">Fecha Fin</label>
	    	 </div>
			 <div class="gridcCompesIt412">
	    	 	<input type="date" id="FechaInicioComp" name="FechaInicioComp" class="inputSets" />
	    	 </div>

			 <div class="gridcCompesIt421">
	    	 	<label for="FechaFinComp">Fecha Inicio</label>
	    	 </div>
			 <div class="gridcCompesIt422">
	    	 	<input type="date" id="FechaFinComp" name="FechaFinComp" class="inputSets" />
	    	 </div>

	        <div class="gridcCompesIt5">

			<div class="grillaFormularioHojas">
				<div  class="itemform1" name="miLogo" id="miLogo"></div>					
				<div  class="itemform2">
					<img  src="" class="imglogocompetenciaVer" id="miLogo2" name="miLogo2"></img>
					<input type="file" value="" name="ControlelegirLogo" id="ControlelegirLogo"/>
					<label for="ControlelegirLogo"  class="itemform2">Seleccionar logo</label>
				</div>
			</div>
	    	 </div>
    	 </div>
    	 </p>
	</form>
	</dialog>

<!-- visualizacion de carga -->		
<div class="ContieneGrillaBusqueda">
	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">buscar COMPETENCIA</div>
			<div><input type="text" id="itextbuscarFiltro" name="itextbuscarFiltro" class="inputSearch"/></div>
	</div>

	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">Competencias</div>
	<div><select id="icompetenciaFiltro" name="icompetenciaFiltro" class="SelList"> 
			<option value="9999" selected>Seleccione una competencia</option>
			</select> 
	</div>
	</div>
	<div class="DetalleGrillaBusqueda">
			<div>Competencias</div>
			<div><input type="number" id="icompsLista" name="icompsLista" disabled /></div>
	</div>		

</div>


<div class="ContieneGrillaTabla">
	<div class="DetalleGrillaTabla barraCancha">
			<div><span class="icon-upload" onclick="abreDialogo('ALTA',0,'',0,0,'','','');"></span></div>
			<div></div>
			<div></div>
			<div>ID</div>
			<div>Nombre competencia</div>
			<div>Sets Maximos</div>
			<div>Partidos</div>
			<div></div>
			<div></div>
			</div>	
</div>

</body>
</html>


<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Ciudades</title>
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

		var vCiudades = new Array();

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
			return iCiudades;	
			}

	function creasCiudadesx(nombreObj){
	// Nombre:"Banfield"
	// idCiudad:"13"
	// provincia:"Buenos Aires"	
		var selectCiudad = "";
		$(vCiudades).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj).append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
		});		
		
	return 	selectCiudad ;
	};		

function buscarCiudad(origen,destinoId){
	
	var parametros = {
    	"llamador" : "Cciudades",
    	"funcion" : "buscarciudad",			
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
 				if(r['estado'] != 99){
	                $(r['Ciudades']).each(function(i, v)
	                { // indice, valor
	                    if (! $("#"+destinoId).find("option[value='" + v.idCiudad + "']").length)
	                	{		
	                    	$("#"+destinoId).append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
						}
	                });
 				}	
 				else
 					$("#"+destinoId).append('<option value="' + r['estado'] + '">' + r['Ciudades'] + '</option>');

             },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			 console.log(xhr);
			 console.log(thrownError);
			}
            }); // FIN funcion ajax CANCIONES todas:
};
//**************** FUNCION DE BUSQUEDA DE CIUDADES MODERNA *********************************************/ 		

function ciudadUI(parametroBusqueda){

 var buscaProvincia = $("#itextbuscarProvincia").val();
// 			verSinCiudad = 1; // it is checked
// };

// var verSinEscudo = 0;
// if ($("#sinescudo").is(":checked")) {
// 		verSinEscudo = 1; // it is checked
// };
//$("#icity").append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
$(".ContieneGrillaTabla").html('<div class="DetalleGrillaTabla barraCancha">'+
										'<div><span class="icon-upload" onclick="abreDialogo(\'ALTA\',0,\'\',\'\');"></span></div>'+
										'<div></div>'+
										'<div></div>'+
										'<div>ID</div>'+
										'<div>NOMBRE</div>'+
										'<div>PROVINCIA</div>'+
										'<div></div>'+
										'<div></div>'+
										'<div></div>'+
										'</div>');

		var conteoUI = 0;
		var renglonCancha = '';
		if(parametroBusqueda != -1)
		{
			$(vCiudades).each(function(i, v)
			{ // indice, valor
					if(parametroBusqueda == 0 || parametroBusqueda == 9999)
					 {	
						if(( v.provincia.toLowerCase().indexOf(buscaProvincia.toLowerCase()) !== -1 ) || buscaProvincia == '' ) 						
						{
							//BUSCO UN CLUB ESPECIFICO, PERO SIN ESTAN LOS CHECKS TILDADOS Y NO CUMPLE, NO LO MUESTRO								
								renglonCancha = '<div class="DetalleGrillaTabla">'+
												'<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idCiudad+',\''+v.Nombre+'\',\''+v.provincia+'\');"></span></div>'+
												'<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idCiudad+',\''+v.Nombre+'\',\''+v.provincia+'\');"></span></div>'+
												'<div>'+v.idCiudad+'</div>'+
												'<div>'+v.Nombre+'</div>'+
												'<div>'+v.provincia+'</div>'+
												'<div></div>'+
												'<div></div>'+
												'<div></div>';
								$(".ContieneGrillaTabla").append(renglonCancha);
								conteoUI++;
							}	
					}			

					if(parametroBusqueda != 0)
					{
						if(v.idCiudad == parametroBusqueda)
						{	
						  //BUSCO UN CLUB ESPECIFICO, PERO SIN ESTAN LOS CHECKS TILDADOS Y NO CUMPLE, NO LO MUESTRO									
							  renglonCancha = '<div class="DetalleGrillaTabla">'+
												'<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idCiudad+',\''+v.Nombre+'\',\''+v.provincia+'\');"></span></div>'+
												'<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idCiudad+',\''+v.Nombre+'\',\''+v.provincia+'\');"></span></div>'+
												'<div>'+v.idCiudad+'</div>'+
												'<div>'+v.Nombre+'</div>'+
												'<div>'+v.provincia+'</div>'+
												'<div></div>'+
												'<div></div>'+
												'<div></div>';
								$(".ContieneGrillaTabla").append(renglonCancha);
								conteoUI++;

						} 	
					}			
			});
			$("#iciudadLista").val(conteoUI);
		} // no es -1
}

function abreDialogo(modo,ciudadID,nombre,provincia){
	// ALTA, BAJA,MODIFICA
const modalForm =
		document.querySelector("#formularioAcciones");
	$("#ciudadID").val(ciudadID);
	$("#ciudad").val(nombre);
	$("#provCity").val(provincia); 

modalForm.showModal();

}	

		/**************************************************************/
		$(document).ready(function(){

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

			//**************** busqueda clubes con jquery *********************************************/      
			vCiudades = cargarCiudadesStart();
			creasCiudadesx('iciudadFiltro');			
					ciudadUI(0);

		    // AJAX DE CARGA POR ID DE CATEGORIAS
			$("#iciudadFiltro").on("click change",function()
				{
					var parametroBusqueda =  $("#iciudadFiltro").val();	
					ciudadUI(parametroBusqueda);
				});//change del ICATEGORIA

//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	
		$("#itextbuscarFiltro").keyup(function()
		{   
			var filtro = $("#itextbuscarFiltro").val();
			$("#iciudadFiltro").empty();
			var cargado = 0;
			var ciudadElegible =0;
			$(vCiudades).each(function(i, v)				
			{ // indice, valor

				if(( v.Nombre.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 ) || ( v.provincia.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 )) 
				{
					$("#iciudadFiltro").append('<option value="' + v.idCiudad + '">' + v.Nombre + '</option>');
					ciudadElegible = v.idCiudad;
					cargado++;

				}
			});
			if(filtro == '') ciudadUI(0);
				if(cargado == 1 ) ciudadUI(ciudadElegible);
		});

		$("#itextbuscarProvincia").keyup(function()
		{   
			ciudadUI(0);
		});		
//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	
		$("#CerrarDiagX").click(function(){
			const modalForm =
						document.querySelector("#formularioAcciones");

			modalForm.close();
		});
				

		$("#btnAddCiudad").click(function(){
			 if( ($("#ciudad").val() != '') &&  ($("#provCity").val() != '') )
			{
			// el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
			//data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
				var parametros = {
					"ciudad" : $("#ciudad").val(),
					"provincia" : $("#provCity").val()
					};		         
			
				$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
					url:   './abms/insertar_ciudad.php',
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

			
		});

		$("#btnDelCiudad").click(function(){
				var parametros = {"icity" : $("#ciudadID").val()}
			
				$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
				url:   './abms/borrar_ciudad.php',
				type:  'POST',
				data: parametros,
				beforeSend: function (){},
				
				success:  function (r){
					location.reload();
				},
				error: function (xhr, ajaxOptions, thrownError) {}
				}); // FIN funcion ajax			
		});

		$("#btnModCiudad").click(function(){

	
			var parametros = {
				   "idciudad" : $("#ciudadID").val(),
					"ciudadnom" : $("#ciudad").val(),
					"provnom" : $("#provCity").val()
				 };	
			 $.ajax({ 
				url:   './abms/actualiza_ciudad.php',
				type:  'POST',
				data: parametros ,
				datatype:   'text json',
				beforeSend: function (){},
				done: function(data){},
				success:  function (r){location.reload();},
				error: function (xhr, ajaxOptions, thrownError){console.log(thrownError);}
				});

		});


			//**************** PARTIDPS *********************************************/ 
	     });	
			
		</script>
    </head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
    </header>
	<dialog id="formularioAcciones"	class="XSModales">
		<h3>Ingreso de Ciudades</h3>
		<section id="Acciones" name="Acciones" class="Acciones">	
			<button id="btnAddCiudad" name="btnAddCiudad" class="butSquareEqBluFull" >ADD</button>
			<button id="btnDelCiudad" name="btnDelCiudad" class="butSquareEqRedRackam">DEL</button>
			<button id="btnModCiudad" name="btnModCiudad" class="butSquareEqOrang">MOD</button>
			<button id="CerrarDiagX" name="CerrarDiagX" class="butSquareEqGreen">X</button>
		</section>	

		<form id="formConfig" name="formCiudad" class="formCiudad">
		<!-- <button id="AltaCiudad" name="AltaCiudad" >+</button> -->
		
		<label for="ciudadID"  class="">ID Ciudad</label>
			<input id="ciudadID"  name="ciudadID" type="number" disabled>

		<label for="ciudad"  class="">Ciudad</label>
			<input id="ciudad"  name="ciudad" type="text">
		<label for="provCity" class="">Provincia</label>
			<input id="provCity" name="provCity" type="text">
			<!--<select name="provCity" class="SelListC"><option value="000">Sel provincia</option></select>-->
		</form>
	 </dialog>

	<!-- visualizacion de carga -->		
<!--  
	<form id="formConfig" name="formCiudad">
		<section id="busque" name="busque" class="busque">
		 	<div><label for="itext">Buscar</label></div>	
		 	<div><input type="text" id="itext" name="itext" class="inputSearch" onkeyup="buscarCiudad(this.id,'icity');"/></div>
		 	<div></div>
	 	</section>	 	
		<label for="icity">Ciudades cargadas</label>
            <select id="icity" class="SelList"> 
                <option value="999" selected>Seleccione una Ciudad</option>
            </select>
        </form> 
-->
<div class="ContieneGrillaBusqueda">
	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">buscar CIUDAD</div>
			<div><input type="text" id="itextbuscarFiltro" name="itextbuscarFiltro" class="inputSearch"/></div>
	</div>
	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">buscar PROVINCIA</div>
			<div><input type="text" id="itextbuscarProvincia" name="itextbuscarProvincia" class="inputSearch"/></div>
	</div>
	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">Ciudades</div>
	<div><select id="iciudadFiltro" name="iciudadFiltro" class="SelList"> 
			<option value="9999" selected>Seleccione una ciudad</option>
			</select> 
	</div>
	</div>
	<div class="DetalleGrillaBusqueda">
			<div>Ciudades</div>
			<div><input type="number" id="iciudadLista" name="iciudadLista" disabled /></div>
	</div>		

</div>


<div class="ContieneGrillaTabla">
	<div class="DetalleGrillaTabla barraCancha">
			<div><span class="icon-upload" onclick="abreDialogo('ALTA',0,'','');"></span></div>
			<div></div>
			<div></div>
			<div>ID</div>
			<div>Nombre ciudad</div>
			<div>Provincia</div>
			<div></div>
			<div></div>
			<div></div>
			</div>	
</div>
<!-- visualizacion de carga -->		



</body>
</html>


<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			VOLLEY.APP::Configurar Categorias
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
		<script type="text/javascript" src="./scripts/delupd.js"></script> 
		<script type="text/javascript">
		
		var vCategorias = new Array();

		
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

function categoriaUI(parametroBusqueda){

	$(".ContieneGrillaTabla").html('<div class="DetalleGrillaTabla barraCancha">'+
										'<div><span class="icon-upload" onclick="abreDialogo(\'ALTA\',0,\'\',0,0,0,0);"></span></div>'+
										'<div></div>'+
										'<div></div>'+
										'<div>Id</div>'+
										'<div>Nombre</div>'+
										'<div>Edad Ini</div>'+
										'<div>Edad Fin</div>'+
										'<div>Sets Cant. Max.</div>'+
										'<div></div>'+
										'</div>');

		var conteoUI = 0;
		var renglonCancha = '';
		if(parametroBusqueda != -1)
		{
			$(vCategorias).each(function(i, v)
			{ // indice, valor
					if(parametroBusqueda == 0 || parametroBusqueda == 9999)
					{	
						var claseActivada = 'barraActiva';
						if(v.categoriaActiva == 0)
								claseActivada = ' ';

						renglonCancha = '<div class="DetalleGrillaTabla '+claseActivada+'">'+
										'<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idcategoria+',\''+v.descripcion+'\','+v.EdadInicio+','+v.EdadFin+','+v.categoriaActiva+','+v.setMax+');"></span></div>'+
										'<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idcategoria+',\''+v.descripcion+'\','+v.EdadInicio+','+v.EdadFin+','+v.categoriaActiva+','+v.setMax+');"></span></div>'+
										'<div>'+v.idcategoria+'</div>'+
										'<div>'+v.descripcion+'</div>'+
										'<div>'+v.EdadInicio+'</div>'+
										'<div>'+v.EdadFin+'</div>'+
										'<div>'+v.setMax+'</div>'+
										'</div>';

								$(".ContieneGrillaTabla").append(renglonCancha);
								conteoUI++;
					}			

					if(parametroBusqueda != 0)
					{
						if(v.idcategoria == parametroBusqueda)
						{	
						renglonCancha = '<div class="DetalleGrillaTabla">'+
										'<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idcategoria+',\''+v.descripcion+'\','+v.EdadInicio+','+v.EdadFin+','+v.categoriaActiva+','+v.setMax+');"></span></div>'+
										'<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idcategoria+',\''+v.descripcion+'\','+v.EdadInicio+','+v.EdadFin+','+v.categoriaActiva+','+v.setMax+');"></span></div>'+
										'<div>'+v.idcategoria+'</div>'+
										'<div>'+v.descripcion+'</div>'+
										'<div>'+v.EdadInicio+'</div>'+
										'<div>'+v.EdadFin+'</div>'+
										'<div>'+v.setMax+'</div>'+
										'</div>';


								$(".ContieneGrillaTabla").append(renglonCancha);
								conteoUI++;
						} 	
					}			
			});
			$("#icategoriasLista").val(conteoUI);
		} // no es -1


}			
			
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

		function abreDialogo(modo,categoriaID,descriptor,edadinicio,edadfin,esActiva,setsmaximos){
			// ALTA, BAJA,MODIFICA
			// v.idclub,v.idsede,v.idcancha,v.nombre,v.ubicacion,v.dimensiones
		const modalForm =
				document.querySelector("#formularioAcciones");
		// if(modo == 'BAJA' || modo == 'MODIFICA')
		// {
			$("#categoriaID").val(categoriaID);
			$("#categoria").val(descriptor);
			$("#edadi").val(edadinicio); // v.idclub+"_"+v.idsede
			$("#edadf").val(edadfin);
			$("#setM").val(setsmaximos);
			if(esActiva == 1)
			{
				$("#activar").attr('checked', true);
				//POR SINO FUNCIONA EL ANTERIOR
				$("#activar").prop('checked',true);
			}	

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
					
					vCategorias = cargarCategoriasStart();
					creaCategoriasx('icate');
					creaCategoriasx('icateFiltro');
					categoriaUI(0);


		    // AJAX DE CARGA POR ID DE CATEGORIAS
			$("#icateFiltro").on("click change",function()
				{
					var parametroBusqueda =  $("#icateFiltro").val();	
					//$("#isede2").empty();
						categoriaUI(parametroBusqueda);
			});//change del ICATEGORIA

//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	
		$("#itextbuscarFiltro").keyup(function()
		{   
			// 	var parametros = {
			//     	"llamador" : "CONTROLAPP",
			//     	"funcion" : "buscarclub",			
			var filtro = $("#itextbuscarFiltro").val();
					// };		         
			$("#icateFiltro").empty();
			$("#icateFiltro").append('<option value="9999">Seleccionar Categoria...</option>');
			var cargado = 0;
			var categoriaElegible =0;
			$(vCategorias).each(function(i, v)				
			{ // indice, valor
				if( v.descripcion.toLowerCase().indexOf(filtro.toLowerCase()) !== -1 ) 
				{
					$("#icateFiltro").append('<option value="' + v.idcategoria + '">' + v.descripcion+' - ' + v.EdadInicio+' / ' + v.EdadFin + '</option>');
					categoriaElegible = v.idcategoria;
					cargado++;

				}
			});
			if(filtro == '') categoriaUI(0);
			 if(cargado == 1 ) categoriaUI(categoriaElegible);


		});
//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	
		$("#CerrarDiagX").click(function(){
			const modalForm =
						document.querySelector("#formularioAcciones");

			modalForm.close();
		});

		$("#btnAddCategoria").click(function(){
			const modalForm =
						document.querySelector("#formularioAcciones");
        if( ($("#categoria").val() != '') &&  ($("#edadi").val() != '') &&  ($("#edadf").val() != '') )
			{
			// el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
			//data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
				var activar =0;
				if ($("#activar").is(":checked")) {
					// it is checked
					activar = 1;
				};

				var parametros = {
					"categoria" : $("#categoria").val(),
					"edadi" : $("#edadi").val(),
					"edadf" : $("#edadf").val(),
					"setM"  : $("#setM").val(),
					"activas" : activar
				};		         
			
				$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
					url:   './abms/insertar_categoria.php',
					type:  'POST',
					data: parametros,
					beforeSend: function (){},
					success:  function (r){
							location.reload();
					},
					//error: function() {
					error: function (xhr, ajaxOptions, thrownError) {
					// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
					}
					}); // FIN funcion ajax
			} // else THIS.VAL <> ''
        else // SI EL VAL ES EMPTY, CARGO UN MENSAJE EN EL SELECT:
			{
			}
		});

		$("#btnDelCat").click(function()
		{
			//**************** ELIMINO categoria con jquery *********************************************/      
			var parametros = {"icate" : $("#categoriaID").val()}
           
            $.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
            url:   './abms/borrar_categ.php',
            type:  'POST',
            data: parametros,
            beforeSend: function (){},
            success:  function (r){
    			location.reload();
            },
			error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax
           
		});
		//**************** ELIMINO categoria con jquery *********************************************/ 
		
		//**************** MODIFICO categoria con jquery *********************************************/      
		$("#btnModcategoria").click(function()
		{
			if( ($("#categoria").val() != '') &&  ($("#edadi").val() != '') &&  ($("#edadf").val() != '') )
			{
			// el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
			//data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
				var activar =0;
				if ($("#activar").is(":checked")) {
					// it is checked
					activar = 1;
				};

				var parametros = {
					"categoriaID" :$("#categoriaID").val(),
					"categoria" : $("#categoria").val(),
					"edadi" : $("#edadi").val(),
					"edadf" : $("#edadf").val(),
					"setM"  : $("#setM").val(),
					"activas" : activar
				};		         

				$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
				url:   './abms/activar_categoria.php',
				type:  'POST',
				data: parametros,
				beforeSend: function (){},
				success:  function (r){
					location.reload();
				},
				//error: function() {
				error: function (xhr, ajaxOptions, thrownError) {}
				}); // FIN funcion ajax
	   	    }		
		});

			}); // parentesis del READY		
		
		</script> 		
    </head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
    </header>

<dialog id="formularioAcciones"	class="XSModales">
	<div class="itemCat21_1"><h3>Ingreso de Categorias</h3></div>
	<section id="Acciones" name="Acciones" class="Acciones">	
		<button id="btnAddCategoria" name="btnAddCategoria" class="butSquareEqBluFull" >ADD</button>
		<button id="btnDelCat" name="btnDelCat" class="butSquareEqRedRackam">DEL</button>
		<button id="btnModcategoria" name="btnModcategoria" class="butSquareEqOrang">MOD</button>
		<button id="CerrarDiagX" name="CerrarDiagX" class="butSquareEqGreen">X</button>
   </section>	

   	<form id="formConfig21" name="formCategoria" class="formCategoria">
	  	<div class="grillaCat21">
		    <div class="itemCat21_1"><input type="number" id="categoriaID" name="categoriaID"  disabled /></div>				
			<div class="itemCat21_2">Categoria Nombre</div>
			<div class="itemCat21_3"><input id="categoria"  name="categoria" type="text"></div>
			<div class="itemCat21_4">
				<div class="gridEdad">
					<div class="itmGridEdad1">Edad Inicio</div>
					<div class="itmGridEdad2"><input id="edadi"  name="edadi" type="number"></div>
					<div class="itmGridEdad3">Edad Fin</div>
					<div class="itmGridEdad4"><input id="edadf"  name="edadf" type="number"></div>
				</div>
			</div>
			<div class="itemCat21_5">MaxNro Sets</div>
			<div class="itemCat21_6">
				<select id="setM"  name="setM" >
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
				</select>
			</div>
			<div class="itemCat21X1">
				<div class="itemCat21_7">Activar</div>
				<div class="itemCat21_8"><input id="activar"  class="CheckActivar" name="activar" type="checkbox"></div>
				<div class="itemCat21_9"></div>
				</div>	
			</div>
	</form>
	</dialog>	
<!-- visualizacion de carga -->
<div class="ContieneGrillaBusqueda">
	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">buscar CATEGORIA</div>
			<div><input type="text" id="itextbuscarFiltro" name="itextbuscarFiltro" class="inputSearch"/></div>
	</div>
	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">Categorias</div>
			<div><select id="icateFiltro" name="icateFiltro" class="SelList"> 
					<option value="9999" selected>Seleccione una categoria</option>
				 </select> 
			</div>
	</div>
	<div class="DetalleGrillaBusqueda">
			<div>Categorias</div>
			<div><input type="number" id="icategoriasLista" name="icategoriasLista" disabled /></div>
	</div>		

</div>


<div class="ContieneGrillaTabla">
	<div class="DetalleGrillaTabla barraCancha">
			<div><span class="icon-upload" onclick="abreDialogo('ALTA',0,0,0,'','','');"></span></div>
			<div></div>
			<div></div>
			<div>ID</div>
			<div>Descripcion</div>
			<div>Edad Inicio</div>
			<div>Edad Fin</div>
			<div>Sets máximos jugables</div>
			<div></div>
			</div>	
</div>

</body>
</html>


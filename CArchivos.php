<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>gestion archivos</title>
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

		var vArchivos = new Array();

		function cargarArchivosStart(){
			iarchivos = new Array();
            var carpetaFiltro =  $("#icarpetaFiltro").val(); 
            var parametro = {
                "carpetaFiltro" :carpetaFiltro
            }
			$.ajax({ 
				url:   './abms/obtener_archivos_directorio.php',
				type:  'GET',
				dataType: 'json',
                data:parametro,
				async:false,
				// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
				beforeSend: function (){},
				done: function(data){},
				success:  function (r){
					iarchivos = Object.values(r['archivos']);
					//console.log(iPosiciones);
				},
				error: function (xhr, ajaxOptions, thrownError) {}
				}); // FIN funcion ajax	
			// TRAIGO UNA VEZ VECTOR DE PUESTOS			
			//PROBANDO LA CARGA UNICA DE LAS POSICIONES
			return iarchivos;	
			}



//**************** FUNCION DE BUSQUEDA DE CIUDADES MODERNA *********************************************/ 		

function archivosUI(vectorResultado){

    //vectorResultado
 var buscaTipo = $("#iTipoArchivoFiltro").val();

 $(".ContieneGrillaTabla").html('<div class="DetalleGrillaTabla barraCancha">'+
										'<div><span class="icon-upload" onclick="abreDialogo(\'ALTA\',\'\');"></span></div>'+
										'<div></div>'+
										'<div></div>'+
                                        '<div>Ubicacion</div>'+
                            			'<div>Nombre</div>'+
			                            '<div>Extension</div>'+
										'<div></div>'+
										'<div></div>'+
										'<div></div>'+
										'</div>');

		var conteoUI = 0;
		var renglonCancha = '';
			$(vArchivos).each(function(i, v)
			{ // indice, valor
    			//  if( v.hasOwnProperty('SubDir') )
				// 	  {	
                          var vExtension = v['1'].split('.')[1];
                          var imagenEscudo=carpetaImagen='';
                          if(! vExtension) vExtension = 'Sin extension';
                          else{
                              carpetaImagen = v['0'].replace('..','');
                              imagenEscudo = '<img src=".'+carpetaImagen+'/'+v['1']+'" class="imglogocompetenciaVer" id="miLogo3" name="miLogo3" >';
                            }

                          //if($("#icarpetaFiltro").val() == '../img/escudos')

                          //console.log( $("#iTipoArchivoFiltro  option:selected").text().toLowerCase()+' == '+ vExtension.toLowerCase() );
                            if(( ($("#iTipoArchivoFiltro  option:selected").text().toLowerCase() == vExtension.toLowerCase() ) && vExtension != 'Sin extension') || $("#iTipoArchivoFiltro").val() == 9999 )
                            {
                                //   console.log('extension del archivo a cargar: '+ vExtension);  
                                //   console.log('extension a filtrar: '+ $("#iTipoArchivoFiltro").val());
                                //BUSCO UN CLUB ESPECIFICO, PERO SIN ESTAN LOS CHECKS TILDADOS Y NO CUMPLE, NO LO MUESTRO								
								renglonCancha = '<div class="DetalleGrillaTabla">'+
                                '<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\',\''+v['1']+'\');"></span></div>'+
                                '<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\',\''+v['1']+'\');"></span></div>'+
                                '<div></div>'+
                                '<div>'+v['0']+'</div>'+
                                '<div>'+v['1'].split('.')[0]+'</div>'+
                                '<div>'+vExtension+'</div>'+
                                '<div>'+imagenEscudo+'</div>'+
                                '<div></div>';
								$(".ContieneGrillaTabla").append(renglonCancha);
								conteoUI++;
                            }
                            // $(v.SubDir).each(function(u, SubdirectorioArchivos){
                            //         var vExtension = v.1.split('.')[1];
                            //         if(! vExtension) vExtension = 'Sin extension';
                            //         //console.log( $("#iTipoArchivoFiltro  option:selected").text().toLowerCase()+' == '+ vExtension.toLowerCase() );
                            //             if(( ($("#iTipoArchivoFiltro  option:selected").text().toLowerCase() == vExtension.toLowerCase() ) && vExtension != 'Sin extension') || $("#iTipoArchivoFiltro").val() == 9999 )
                            //             {
                            //                 //   console.log('extension del archivo a cargar: '+ vExtension);  
                            //                 //   console.log('extension a filtrar: '+ $("#iTipoArchivoFiltro").val());
                            //                 //BUSCO UN CLUB ESPECIFICO, PERO SIN ESTAN LOS CHECKS TILDADOS Y NO CUMPLE, NO LO MUESTRO								
                            //                 renglonCancha = '<div class="DetalleGrillaTabla">'+
                            //                 '<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\',\''+v.1+'\');"></span></div>'+
                            //                 '<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\',\''+v.1+'\');"></span></div>'+
                            //                 '<div></div>'+
                            //                 '<div>'+v.0+'</div>'+
                            //                 '<div>'+v.1.split('.')[0]+'</div>'+
                            //                 '<div>'+vExtension+'</div>'+
                            //                 '<div></div>'+
                            //                 '<div></div>';
                            //                 $(".ContieneGrillaTabla").append(renglonCancha);
                            //                 conteoUI++;
                            //             }
                            // });
						// }	TIENE LA PROPIEDAD SUBDIR
					// }			
			}); //$(vArchivos).each
			$("#iarchivoLista").val(conteoUI);
		// } // no es -1
}

function abreDialogo(modo,nombre){
	// ALTA, BAJA,MODIFICA
const modalForm =
		document.querySelector("#formularioAcciones");

        $("#NombreArchivo").val(nombre);
        $("#UbicacionArchivo").val($("#icarpetaFiltro").val());

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

                    //./img/escudos/
                vArchivos = cargarArchivosStart();
                //creaCarpetas(vArchivos);
                archivosUI(vArchivos);


//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	
		$("#CerrarDiagX").click(function(){
			const modalForm =
						document.querySelector("#formularioAcciones");

			modalForm.close();
		});
				
        $("#icarpetaFiltro").on("change click",function(){
                vArchivos = cargarArchivosStart();
                archivosUI(vArchivos);
        });

        
        $("#iTipoArchivoFiltro").on("change click",function(){
                //vArchivos = cargarArchivosStart();
                archivosUI(vArchivos);
        });

		$("#btnAddArchivo").click(function(){

			
		});

		$("#btnDelArchivo").click(function(){
		});

		$("#btnModArchivo").click(function(){


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

	     });	// FIN DEL READY
			
		</script>
    </head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
    </header>
	<dialog id="formularioAcciones"	class="XSModales">
		<h3>Ingreso de Archivos</h3>
		<section id="Acciones" name="Acciones" class="Acciones">	
			<button id="btnAddArchivo" name="btnAddArchivo" class="butSquareEqBluFull" >ADD</button>
			<button id="btnDelArchivo" name="btnDelArchivo" class="butSquareEqRedRackam">DEL</button>
			<button id="btnModArchivo" name="btnModArchivo" class="butSquareEqOrang">MOD</button>
			<button id="CerrarDiagX" name="CerrarDiagX" class="butSquareEqGreen">X</button>
		</section>	

		<form id="formConfig" name="formCiudad" class="formCiudad">
		<label for="NombreArchivo"  class="">Archivo</label>
			<input id="NombreArchivo"  name="NombreArchivo" type="text">

		<label for="UbicacionArchivo"  class="">Ubicacion</label>
			<input id="UbicacionArchivo"  name="UbicacionArchivo" type="text">

		<div  class="itemform2">
			<img  src="" class="imglogocompetenciaVer" id="miLogo2" name="miLogo2"></img>
			<input type="file" value="" name="ControlelegirLogo" id="ControlelegirLogo"/>
			<label for="ControlelegirLogo"  class="itemform2">Seleccionar logo</label>
			<button value="Limpiar" name="ControlLimpiarArchivo" id="ControlLimpiarArchivo" onclick="document.getElementById('ControlelegirLogo').reset();" ></button>
		</div>
			
		</form>
	 </dialog>

<div class="ContieneGrillaBusqueda">
	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">Tipo Archivo</div>
			<div>
            <select id="iTipoArchivoFiltro" name="iTipoArchivoFiltro" class="SelList"> 
			    <option value="9999" selected>Seleccione un tipo</option>
                <option value="*.jpeg" selected>JPEG</option>
                <option value="*.png" selected>PNG</option>
                <option value="*.bmp" selected>BMP</option>
                <option value="*.jpg" selected>JPG</option>

			</select>                
            </div>
	</div>
	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">Carpetas</div>
	<div><select id="icarpetaFiltro" name="icarpetaFiltro" class="SelList"> 
			<option value="" selected>Seleccione una carpeta</option>
            <option value="../img" selected>Imagenes</option>
            <option value="../img/escudos" selected>Escudos</option>
            <option value="../img/competencias" selected>Competencias</option>
            <option value="../img/partidos" selected>Partidos</option>
			</select> 
	</div>
	</div>
	<div class="DetalleGrillaBusqueda">
			<div>Archivos</div>
			<div><input type="number" id="iarchivoLista" name="iarchivoLista" disabled /></div>
	</div>		

</div>


<div class="ContieneGrillaTabla">
	<div class="DetalleGrillaTabla barraCancha">
			<div><span class="icon-upload" onclick="abreDialogo('ALTA','');"></span></div>
			<div></div>
			<div></div>
			<div>Ubicacion</div>
			<div>Nombre</div>
			<div>Extension</div>
			<div></div>
			<div></div>
			<div></div>
			</div>	
</div>
<!-- visualizacion de carga -->		



</body>
</html>


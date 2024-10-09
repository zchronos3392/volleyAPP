<?php include('sesioner.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>
			VOLLEY.APP::Configurar Estados
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
		<!--<script type="text/javascript" src="./css/delupd.js"></script> -->
		<script type="text/javascript">		

	var vEstados    = new Array();

	function cargarEstadosStart()
    {
//------------------------------
// ESTADOS DEL PARTIDO
//------------------------------
    var  iEstados = new Array();
        // esto arreglo el tema del alta triplle..
        $.ajax({ 
            url:   './abms/obtener_estados.php',
            type:  'GET',
            dataType: 'json',
            async:false,            
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){},
            done: function(data){},
            success:  function (r){
                    iEstados = Object.values(r['Estados']);
            },
             error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax ESTADOS    

            return iEstados;				
    }	

	function creaEstadosX(nombreObj)
    {
	// console.log('crear Categoria para : ' + "#"+nombreObj+"_"+idpartido );
	var selectEstados = "";
			// esto arreglo el tema del alta triplle..

		$(vEstados).each(function(i, v)
		{ // indice, valor
				$("#"+nombreObj).append('<option value="' + v.idestado + '" label="'+v.descripcion+'">' + v.descripcion + '</option>');
        });
	
	    return 	selectEstados ;
	};    


	function estadoUI(parametroBusqueda){

var buscaEstado = $("#itextbuscarFiltro").val();
// 			verSinCiudad = 1; // it is checked
// };
indiceEstados = 0;
$(vEstados).each(function(i, v){indiceEstados = i;});
nuevoIDSugerido = (indiceEstados)+1;
$(".ContieneGrillaTabla").html('<div class="DetalleGrillaTabla barraCancha">'+
									   '<div><span class="icon-upload" onclick="abreDialogo(\'ALTA\','+nuevoIDSugerido+',\'\',\'\',\'\');"></span></div>'+
									   '<div></div>'+
									   '<div></div>'+
									   '<div>ID</div>'+
									   '<div>Descripcion ST</div>'+
									   '<div>Color ST</div>'+
									   '<div></div>'+
									   '<div></div>'+
									   '<div></div>'+
									   '</div>');

	   var conteoUI = 0;
	   var renglonCancha = '';
	   if(parametroBusqueda != -1)
	   {
		   $(vEstados).each(function(i, v)
		   { // indice, valor
					if(v.colorData == '') colorTexto= '#000000';
					else colorTexto = v.colorData;

					var colorEstado ='<input id="colorEstado" name="colorEstado" type="color" value="'+colorTexto+'" disabled>';

				   if(parametroBusqueda == 0 || parametroBusqueda == 9999)
					{	
					   if(( v.descripcion.toLowerCase().indexOf(buscaEstado.toLowerCase()) !== -1 ) || buscaEstado == '' ) 						
					   {
						   //BUSCO UN CLUB ESPECIFICO, PERO SIN ESTAN LOS CHECKS TILDADOS Y NO CUMPLE, NO LO MUESTRO		
						    // descripcion: "Sin Estado"
							// idestado: 0
							// imagen: ""				

							   renglonCancha = '<div class="DetalleGrillaTabla">'+
											   '<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idestado+',\''+v.descripcion+'\',\''+v.imagen+'\',\''+v.colorData+'\');"></span></div>'+
											   '<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idestado+',\''+v.descripcion+'\',\''+v.imagen+'\',\''+v.colorData+'\');"></span></div>'+
											   '<div>'+v.idestado+'</div>'+
											   '<div>'+v.descripcion+'</div>'+
											   '<div>'+v.imagen+'</div>'+
											   '<div>'+colorEstado+'</div>'+
											   '<div></div>';
							   $(".ContieneGrillaTabla").append(renglonCancha);
							   conteoUI++;
						   }	
				   }			

				   if(parametroBusqueda != 0)
				   {
					   if(v.idestado == parametroBusqueda)
					   {	
						 //BUSCO UN CLUB ESPECIFICO, PERO SIN ESTAN LOS CHECKS TILDADOS Y NO CUMPLE, NO LO MUESTRO									
							 renglonCancha = '<div class="DetalleGrillaTabla">'+
											   '<div><span class="icon-cross" onclick="abreDialogo(\'BAJA\','+v.idestado+',\''+v.descripcion+'\',\''+v.imagen+'\',\''+v.colorData+'\');"></span></div>'+
											   '<div><span class="icon-pie-chart" onclick="abreDialogo(\'MODIFICA\','+v.idestado+',\''+v.descripcion+'\',\''+v.imagen+'\',\''+v.colorData+'\');"></span></div>'+
											   '<div>'+v.idestado+'</div>'+
											   '<div>'+v.descripcion+'</div>'+
											   '<div>'+v.imagen+'</div>'+
											   '<div>'+colorEstado+'</div>'+
											   '<div></div>'+
											   '<div></div>';
							   $(".ContieneGrillaTabla").append(renglonCancha);
							   conteoUI++;

					   } 	
				   }			
		   });
		   $("#iestadosLista").val(conteoUI);
	   } // no es -1
}

function abreDialogo(modo,estadoID,descripcion,imagenEstado,pseudoColor){
   // ALTA, BAJA,MODIFICA
//   abreDialogo(\'BAJA\','+v.idestado+',\''+v.descripcion+'\',\''+v.imagen+'\');"></span>
const modalForm =
	   document.querySelector("#formularioAcciones");

   $("#estadoID").val(estadoID);
   $("#estadoDescripcion").val(descripcion);
   $("#imagenStat").val(imagenEstado);
   $("#colorEstado").val(pseudoColor);
    

modalForm.showModal();

}		

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
		// stopwatchjquery
		vEstados = cargarEstadosStart();
		creaEstadosX('ietats');			
		estadoUI(0);
		
	//**************** FUNCION DE BUSQUEDA DE CLUBES MODERNA *********************************************/ 	
		$("#CerrarDiagX").click(function(){
			const modalForm =
						document.querySelector("#formularioAcciones");

			modalForm.close();
		});
				

		$("#btnAddEstado").click(function(){
			// el otro, activado en CLICK, envia a otro script el valor de los campos cargados.. 	
			//data: { id : ESTE ES EL SELECT DESDE DONDE TOMAMOS EL ID PARA EL QUERY : alumnos.val() }
				var parametros = {
					"estadoID" : $("#estadoID").val(),
					"estadoDescripcion" : $("#estadoDescripcion").val(),
					 "colorEstado" : $("#colorEstado").val(),
					 "imagenEstado" : $("#imagenEstado").val()
					};		         
			

				$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
					 url:   './abms/insertar_estado.php',
					type:  'GET',
					data: parametros,
					beforeSend: function (){},
					
					success:  function (r){
							location.reload();
					},
					//error: function() {
					error: function (xhr, ajaxOptions, thrownError) {}
					}); // FIN funcion ajax
		});

		$("#btnDelEstado").click(function(){
				
			    var parametros = {"estadoID" : $("#estadoID").val()}
			
				$.ajax({ //el signo de pregunta apunta a la direccion url base que es donde corre equipos.php
				 url:   './abms/elimina_estado.php',
				type:  'GET',
				data: parametros,
				beforeSend: function (){},
				
				success:  function (r){location.reload();},
				error: function (xhr, ajaxOptions, thrownError) {}
				}); // FIN funcion ajax			
		});

		$("#btnModEstado").click(function(){

	
			var parametros = {
					 "estadoID" : $("#estadoID").val(),
					 "estadoDescripcion" : $("#estadoDescripcion").val(),
					 "colorEstado" : $("#colorEstado").val(),
					 "imagenEstado" : $("#imagenEstado").val()
					};		         

			 $.ajax({ 
				 url:   './abms/modifica_estado.php',
				type:  'GET',
				data: parametros ,
				datatype:   'text json',
				beforeSend: function (){},
				done: function(data){},
				success:  function (r){location.reload();},
				error: function (xhr, ajaxOptions, thrownError){console.log(thrownError);}
				});

		});
	

		$("#itextbuscarFiltro").keyup(function()
		{   
			estadoUI(0);
		});		

	
		$("#ietats").on("click change",function()
		{
			var parametroBusqueda =  $("#ietats").val();	
			estadoUI(parametroBusqueda);
		});//change del ICATEGORIA

	
	
	
	}); // parentesis del READY

	
		</script>		
</head>
<body>
   	<header>
		<?php include('includes/newmenu.php'); ?>
    </header>
	
	<dialog id="formularioAcciones"	class="XSModales">
			<h3>Gestión de Estados</h3>
			<section id="Acciones" name="Acciones" class="Acciones">	
				<button id="btnAddEstado" name="btnAddEstado" class="butSquareEqBluFull" >ADD</button>
				<button id="btnDelEstado" name="btnDelEstado" class="butSquareEqRedRackam">DEL</button>
				<button id="btnModEstado" name="btnModEstado" class="butSquareEqOrang">MOD</button>
				<button id="CerrarDiagX" name="CerrarDiagX" class="butSquareEqGreen">X</button>
			</section>	

		<!-- visualizacion de carga -->
		<form id="formConfig" name="formCiudad">
			<label for="estadoID"  class="">ID Estado</label>
				<input id="estadoID"  name="estadoID" type="number" >

			<label for="estadoDescripcion"  class="">Estado Desc</label>
				<input id="estadoDescripcion"  name="estadoDescripcion" type="text">
			<label for="colorEstado" class="">Color</label>
				<input id="colorEstado" name="colorEstado" type="color">
		</form>
	</dialog>

	<div class="ContieneGrillaBusqueda">
	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">buscar Estado</div>
			<div><input type="text" id="itextbuscarFiltro" name="itextbuscarFiltro" class="inputSearch"/></div>
	</div>

	<div class="DetalleGrillaBusqueda">
	<div class="barraFiltrosCancha">Estados</div>
	<div><select id="ietats" name="ietats" class="SelList"> 
			<option value="9999" selected>Seleccione un estado</option>
			</select> 
	</div>
	</div>

	<div class="DetalleGrillaBusqueda">
			<div>Estados hallados</div>
			<div><input type="number" id="iestadosLista" name="iestadosLista" disabled /></div>
	</div>		
	

</div>


<div class="ContieneGrillaTabla">
	<div class="DetalleGrillaTabla barraCancha">
			<div><span class="icon-upload" onclick="abreDialogo('ALTA',0,'','','');"></span></div>
			<div></div>
			<div></div>
			<div>ID</div>
			<div>Descripcion ST</div>
			<div>Color ST</div>
			<div></div>
			<div></div>
			<div></div>
			</div>	
</div>
<!-- visualizacion de carga -->		

<!-- visualizacion de carga -->	

</body>
</html>


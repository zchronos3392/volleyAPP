<?php include('sesioner.php'); ?>	

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>Administrar volleyAPP</title>
        <meta name="Administrar app" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<style>
		#imgEstadoAdmin:hover {opacity: 0.7;}
		.TituloPop{
			text-align: center;
		}	

		.modal {
			display: none; 
			position: fixed; 
			z-index: 1; 
			padding-top: 100px; 
			left: 0;
			top: 0;
			width: 100%; 
			height: 100%; 
			overflow: auto; 
			background-color:#E8CC79; 
		}

		.modal-content {
			margin: auto;
			display: block;
			width: 80%;
			max-width: 700px;
		}

		#caption {
			margin: auto;
			display: block;
			width: 80%;
			max-width: 700px;
			text-align: center;
			color: #ccc;
			padding: 10px 0;
			height: 150px;
		}

		.modal-content, #caption { 
			animation-name: zoom;
			animation-duration: 0.6s;
		}

		@keyframes zoom {
			from {transform:scale(0)} 
			to {transform:scale(1)}
		}

		.close {
			position: absolute;
			top: 120px;
			right: 200px;
			color: #f1f1f1;
			font-size: 40px;
			font-weight: bold;
			transition: 0.3s;
		}

		.close:hover,
		.close:focus {
			color: #bbb;
			text-decoration: none;
			cursor: pointer;
		}

	  .modal-content {
				width: 100%;
	   }
		@media (min-width:451px) and (max-width: 768px){
						.TituloPop{
							text-align: center;
						}	
						.modal {
							display: none; 
							position: fixed; 
							z-index: 1; 
							padding-top: 300px; 
							left: 0;
							top: 0;
							width: 100%; 
							height: 100%; 
							overflow: auto; 
							background-color:#E8CC79; 
						}

						.modal-content {
							margin: auto;
							display: block;
							width: 80%;
							max-width: 700px;
						}

						#caption {
							margin: auto;
							display: block;
							width: 80%;
							max-width: 700px;
							text-align: center;
							color: #ccc;
							padding: 10px 0;
							height: 150px;
						}

						.modal-content, #caption { 
							animation-name: zoom;
							animation-duration: 0.6s;
						}

						@keyframes zoom {
							from {transform:scale(0)} 
							to {transform:scale(1)}
						}

						.close {
							position: absolute;
							top: 290px;
							right: 200px;
							color: #f1f1f1;
							font-size: 40px;
							font-weight: bold;
							transition: 0.3s;
						}

						.close:hover,
						.close:focus {
							color: #bbb;
							text-decoration: none;
							cursor: pointer;
						}
			}

		@media only screen and (max-width: 450px){
						.TituloPop{
							text-align: center;
						}	

						.modal {
							display: none; 
							position: fixed; 
							z-index: 1; 
							padding-top: 100px; 
							left: 0;
							top: 0;
							width: 100%; 
							height: 100%; 
							overflow: auto; 
							background-color:#E8CC79; 
						}

						.modal-content {
							margin: auto;
							display: block;
							width: 80%;
							max-width: 700px;
						}

						#caption {
							margin: auto;
							display: block;
							width: 80%;
							max-width: 700px;
							text-align: center;
							color: #ccc;
							padding: 10px 0;
							height: 150px;
						}

						.modal-content, #caption { 
							animation-name: zoom;
							animation-duration: 0.6s;
						}

						@keyframes zoom {
							from {transform:scale(0)} 
							to {transform:scale(1)}
						}

						.close {
							position: absolute;
							top: 70px;
							right: 35px;
							color: #f1f1f1;
							font-size: 40px;
							font-weight: bold;
							transition: 0.3s;
						}

						.close:hover,
						.close:focus {
							color: #bbb;
							text-decoration: none;
							cursor: pointer;
						}
			}
											
		
		
		
		
		
		
		
		.btnCambioEstado{
			 background: steelblue;
			 display: table;
			 margin: auto;
			 color: #fff;
			 line-height: 3;
			 width: 50%;
			 text-transform: uppercase;
			 cursor: pointer;
		}
		</style>
		
		<script type="text/javascript">


		function filtrar(){

			
			var fechadesdeorden =0;
			if ($("#fecDdeAscDsc2").is(":checked")) {
				// it is checked
				fechadesdeorden = 1;
			};

			var todos= 9999;			
			var sinfiltros=0;
			var parametros = 
			{
	        	"icomp" : todos,
	        	"icate" : sinfiltros,
				"icity" : sinfiltros,
				"icity2" : sinfiltros,
				"icate" : sinfiltros,
				"iclub" : sinfiltros,
					"fdesde" : $("#fecDde").val(),
					"fdesdeOrden" : fechadesdeorden,
					"fhasta" : $("#fecHta").val(),
					"estado" : $("#ietats2").val()
			};		  
		/* agrego filtros como en INDEX */		
		
		// COIGO PARA ANIMAR LA HAMBURGUESA
			
         $.ajax({ 
            url:   './abms/obtener_partidos.php',
            type:  'GET',
            dataType: 'json',
            data: parametros,
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    		},
            done: function(data){
				
			},
            success:  function (r){
				$("#grid-ListaPart21").empty();
                $(r['Partidos']).each(function(i, v)
                { // indice, valor				
				
                if (! $('#grid-ListaPart21').find("[name='PARTIDO"+v.Fecha+v.idPartido+"']").length)
				{
					
				//var Tablero ='<a href="TableroGrande.php?id='+v.idPartido+'&fecha='+v.Fecha+'">';
				var Tablero ='<a href="TableroGrandev20.php?id='+v.idPartido+'&fecha='+v.Fecha+'">';
					Tablero +='<input type="button" id="verset" name="verset" class="btnVerSet_21  Verder Pequenio" value="(ver)" title="Ver Tablero"></input></a>';
						
				var verCSets ='<a href="CSets2.php?id='+v.idPartido+'&setmax='+v.setsnmax+'&fecha='+v.Fecha;
					 verCSets += '"><input type="button" id="nuevoset" name="nuevoset" class="btnVerSet_21 Insta Pequenio" value="(+" title="Nuevo set"></input></a>';
					
					var alta='<input type="button" id="volver" title="Cerrar partido" name="volver"'+
						 	 ' class="btnVerSet_21 azulMa Pequenio" '+
							 'value="X" onclick="cerrarPartido('+v.idPartido+',\''+v.Fecha+'\');"></input>';
							 
					var borrar='<input type="button" id="eliminar" title="Eliminar Partido" name="eliminar"'+
						 	 ' class="btnVerSet_21 Manzana Pequenio" '+
							 'value="X" onclick="BorrarPartido('+v.idPartido+',\''+v.Fecha+'\');"></input>';
							 							 
					var modifica ='<a href="ModPartido.php?id='+v.idPartido+'&fechapart='+v.Fecha+'">'+
									'<input type="button" id="modifica" title="modifica partido" name="modifica"'+
						 	 ' class="btnVerSet_21 turquE Pequenio" '+
							 'value="(*)"></input></a>';

			        if(v.descripcion.includes('PROGR')) var img = './img/PartidoONOFFSQR.png';
					if(v.descripcion.includes('SUSPENDIDO')) var img = './img/PartidoSSPND.png';

			        if(v.descripcion.includes('LLUVI')){ 
			        	var img = './img/rain-icon-png.jpg';
	                		verCSets = '';
	                		alta='<a href="VerCSets.php?id='+v.idPartido+'&setmax='+v.setsnmax+'&fecha='+v.Fecha;
					  		alta+='"><input type="button" id="nuevoset" name="nuevoset" class="btnVerSet_21 Naranja Pequenio" value="(0/)" title="Revisar valores del Set"></input></a>';
					  	modifica='';		                
	                }		
	                if(v.descripcion.includes('FIN')){ 
	                		var img = './img/PartidoOFFSQR.jpg';
	                		verCSets = '';
	                		alta='<a href="VerCSets.php?id='+v.idPartido+'&setmax='+v.setsnmax+'&fecha='+v.Fecha;
					  		alta+='"><input type="button" id="nuevoset" name="nuevoset" class="btnVerSet_21 Naranja Pequenio" value="(0/)" title="Revisar valores del Set"></input></a>';
					  		modifica='';
					}		
	                if(v.descripcion.includes('CURSO')) var img = './img/PartidoONSQR.png';
					$("#grid-ListaPart21").append(
					'<section class="agrid-LPReg21 ADMIN" id="grid-LPReg21">'+
				  					  '<div class="ilp211 ADMIN" >'+v.ClubA+'</div>'+
									  '<div class="ilp212 ADMIN">'+v.ClubARes+'</div>'+
									  '<div class="ilp213 ADMIN">'+v.ClubB+'</div>'+
									  '<div class="ilp214 ADMIN">'+v.ClubBRes+'</div>'+
					  				  '<div class="imgdiv ilp215 ADMIN">'+
					  					  '<img src="'+img+'" class="imgEstadoIndex_21" title="'+v.descripcion+'" onClick="levantarPopUp(this.title,'+v.idPartido+','+"'"+v.Fecha+"'"+');"></img>'+
					  				  '</div>'+
					  				 '<div class="ilp216 ADMIN Pequenio">'+borrar+alta+modifica+Tablero+verCSets+'</div>'+ 
								  		'<input type="hidden" name="PARTIDO'+v.Fecha+v.idPartido+'" />'+
										 '<input type="hidden" id="fechaxpartido" value="'+v.Fecha+'" />'+
										 '<input type="hidden" id="idxpartido" value="'+v.idPartido+'" />'+
								 	 '</div>'+
									  '<div class="ilp217 ADMIN">Competencia: '+v.cnombre+'</div>'+
									  '<div class="ilp218 ADMIN">'+v.CatDesc+'</div>'+
									  '<div class="ilp219 ADMIN">'+v.Fecha+'</div>'+
									  '<div class="ilp2110 ADMIN">'+v.Inicio+'</div>'+
								   '</section>'+
							   '</section>');
				};
			  });
            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			}
            }); // FIN funcion ajax CLUBES
          } //fin funcion FILTRAR  
          



		function cambioEstadoPartido(){

		
		    var parametros =
		    {
			 "fecha"   : $("#fechaxpartidoSelec").val(),
			 "partido" : $("#idxpartidoSelec").val(),
			 "estadoNuevo" : $("#ietats").val()
			};

		    $.ajax({ 
            url:   './abms/cambiar_estado_partido.php',
            type:  'POST',
            data:  parametros,
            dataType: 'json',
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    		},
            done: function(data){
						
			},
            success:  function (r){
					//console.log(r);
					filtrar();
			},
			error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
				console.log(xhr);
				console.log(thrownError);
			}
            }); // FIN funcion ajax CLUBES			
			
			
			
		};
		
		function levantarPopUp(estado,idpartido,Fecha){
//			$("#imgEstado").on("click", function(){
				//alert("Hey ! " + estado);
			   var valor = 0;
			   //recorrer todos los option del select y guardarlo..
			   //recorrer todos los option del select y guardarlo..
			   $("#ietats option").each(function(){
						//alert('opcion '+$(this).text()+' valor '+ $(this).attr('value'));	
						//alert(estado);	
						var cadena = $(this).text();
							
						if(cadena.includes(estado)){
							//alert('IN opcion '+$(this).text()+' valor '+ $(this).attr('value'));	
							valor = $(this).attr('value');
						}
				});
				
				if(valor != 0){
					$("#ietats").val(valor);							
					$("#ietats").change();
					$("#fechaxpartidoSelec").val("'"+Fecha+"'");
					$("#idxpartidoSelec").val(idpartido);
					
					$("#popUp").show();
				};			 

		};
		
		function cerrarPartido(idpartido,fecha)
        {
		    var parametros =
		    {
			 "fecha"   : "'"+fecha+"'",
			 "partido" : idpartido	
			};

		    //alert($("#fechaxpartido").val());
		    //alert($("#idxpartido").val());
		     
		    $.ajax({ 
            url:   './abms/cerrar_partido.php',
            type:  'POST',
            data:  parametros,
            dataType: 'json',
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos
    		},
            done: function(data){},
            success:  function (r){filtrar();},
			error: function (xhr, ajaxOptions, thrownError) {}
            }); // FIN funcion ajax CLUBES
		};  

		function BorrarPartido(idpartido,fechapartido)
        {
		    var parametros =
		    {
			 "fecha"   : "'"+fechapartido+"'",
			 "partido" : idpartido	

			};

		    
		    $.ajax({ 
            url:   './abms/borrar_partido.php',
            type:  'POST',
            data:  parametros,
            dataType: 'json',
            beforeSend: function (){},
            done: function(data){filtrar();},
            success:  function (r){filtrar();},
			error: function (xhr, ajaxOptions, thrownError) {filtrar();}
            }); // FIN funcion ajax CLUBES
		};  

		
		$(document).ready(function(){
		
		$("#fecDdeAscDsc2").on("change click",function() {filtrar();});				

		$("#ietats2").on("change click",function()
		{
			if($("#ietats2:contains('CURSO')"))
			{
			 var f=new Date();
			 var dias = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
			 				,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
			 				,"27","28","29","30","31");
			 var meses = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
			 var fechapartidoDESDE = (f.getFullYear()) + "-" + meses['0'] + "-" +dias['0'];
			 $("#fecDde").val(fechapartidoDESDE);
			};	
			filtrar();
		});				

		$("#fecDde").on("change click",function() {filtrar();});				
		$("#fecHta").on("change click",function() {filtrar();});				



		
//**************** COMBO ESTADOS *********************************************/  			
         $("#ietats").empty();
        // esto arreglo el tema del alta triplle..
         $.ajax({ 
            url:   './abms/obtener_estados.php',
            type:  'GET',
            dataType: 'json',
			// EVENTOS QUE PODRIAN OCURRIR CUANDO ESTEMOS PROCESANDO EL AJAX		            
            beforeSend: function (){
				// Bloqueamos el SELECT de los cursos

       		},
            done: function(data){
            	
			},
            success:  function (r){
            	// SI LA TABLA ESTA VACIA, NO ENTRA ACA.
               	// DESBloqueamos el SELECT de los cursos
				// Limpiamos el select
				// FORMA CORRECTA DE LEER EL VECTOR:r["estado"] y r["Clubes"] 
				$("#ietats").append('<option value="0" label="Estados...">Estados...</option>');

                $(r['Estados']).each(function(i, v)
                { // indice, valor
                		//TUVE QUE AGREGARLE, QUE NO EXISTA EL ELEMENTO, PORQUE SE ESTA
                		// TRIPLICANDO UN EVENTO QUE NO PUDE ENCONTRAR Y CARGABA TODOS LOS DATOS TRES VECESSS
                	if (! $('#ietats').find("option[value='" + v.idestado + "']").length)
                	{
						$("#ietats").append('<option value="' + v.idestado + '" label="'+v.descripcion+'">' + v.descripcion + '</option>');
					}		
                	if (! $('#ietats2').find("option[value='" + v.idestado + "']").length)
                	{
						$("#ietats2").append('<option value="' + v.idestado + '" label="'+v.descripcion+'">' + v.descripcion + '</option>');
					}		

                });
                $("#ietats").val(1); // PROGRAMADO

            },
             error: function (xhr, ajaxOptions, thrownError) {
			// LA TABLA VACIA, ES UN ERROR PORQUE NO DEVUELVE NADA
			$("#ietats").append('<option value="' + '9999' + '">' + 'JQERY:Tabla vacia' + '</option>');
			$("#ietats").val('9999');
			}
            }); // FIN funcion ajax ESTADOS
//**************** COMBO ESTADOS *********************************************/  

		 var f=new Date();
		 var dias = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
		 				,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
		 				,"27","28","29","30","31");
		 var meses = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
		 var fechapartidoDESDE = (f.getFullYear()) + "-" + meses[f.getMonth()] + "-" +dias['0'] ;
		  $("#fecDde").val(fechapartidoDESDE);
		 var f2=new Date();
		 var dias2 = new Array ("01","02","03","04","05","06","07","08","09","10","11","12"
		 				,"13","14","15","16","17","18","19","20","21","22","23","24","25","26"
		 				,"27","28","29","30","31");
		 var meses2 = new Array ("01","02","03","04","05","06","07","08","09","10","11","12");
		 var fechapartidoHASTA = (f2.getFullYear()) + "-" + meses['11'] + "-" +dias['30'] ;
			$("#fecHta").val(fechapartidoHASTA);
		
		
		$("#stspgm").prop('checked', true);
			$("#ietats2").prop('disabled', true);		
		<?php
			require_once('./abms/SesionTabla.php');
			$ingreso='';
			$graboSesion = SesionTabla::getsession("'".$_SERVER['REMOTE_ADDR']."'");
            if(isset($graboSesion["sesid"]))
	            if ((int)$graboSesion["sesid"] !=0) {
						echo('var sesion =1;');
						$_SESSION['INGRESO'] ="SI";
				} else
				{
					$_SESSION['INGRESO'] ="";
					echo('var sesion =0;');
				}
			else
				 echo('var sesion =0;');
		?>		

			if (sesion == 0 )
				location.href='index.php'; 
		
			$(".close").on("click" , function() { 
			   $("#popUp").hide();
			});
			


			/* agrego filtros */
			fechadesdeorden=0;
		$("#stspgm").on("click",function()
						{
							if ($("#stspgm").is(":checked")) 
							{								
							// it is checked
									$("#ietats2").prop('disabled', true);
											$("#ietats2").val(1); // PROGRAMADO
											 var f=new Date();
											 var dias = new Array ("01","02","03","04","05","06",
											 "07","08","09","10","11","12","13","14","15","16",
											 "17","18","19","20","21","22","23","24","25","26",
											 "27","28","29","30","31");
											 var meses = new Array ("01","02","03","04","05","06",
											 "07","08","09","10","11","12");
											 var fechapartidoDESDE = (f.getFullYear()) + "-" +
											 	  meses[f.getMonth()] + "-" +dias['0'] ;
											  $("#fecDde").val(fechapartidoDESDE);
											 filtrar(); 
							}
							else{		
									$("#ietats2").prop('disabled', false);
									$("#ietats2").append('<option value="" label="Estados..">Estados..</option>');
									$("#ietats2").val(0);
									filtrar();							
								}	
							
			});	
	
			filtrar();

		}); // end of DOCUMENT.READY 	
		</script>
    </head>
    <body>
		<?php 
			require_once('abms/SesionTabla.php');
			$graboSesion = SesionTabla::getsession("'".$_SERVER['REMOTE_ADDR']."'");
			if (isset($graboSesion))
				if ($graboSesion !=0)
						include('includes/newmenu.php');
			else
				echo("no trae sesion...");	
	 	?>
    
<!--normal: 1070,<768:3288  -->
		<div id="formbuscar" name="formbuscar" class="formbuscarv20"><!--normal 1077,<768:3295 -->

		<div class="itemBusc1v20">
	    	<div id="frmbuscardate" name="frmbuscardate" class="frmbuscardatev20"><!--normal 1088,<768:3306 -->
				<div class="itemBusDate1v20">Desde</div> 
				<div class="itemBusDate2v20"><input type="date" id="fecDde" class="fecha"/></div>
				<div class="itemBusDate3v20">Hasta</div> 
				<div class="itemBusDate4v20"><input type="date" id="fecHta" class="fecha"/></div>
				<div class="itemBusDate5v20">Orden Asc/Desc<input type="checkbox" id="fecDdeAscDsc2" class="fecDdeAscDsc2v20"  /></div>
			</div>  
		</div>
		<div class="itemBusc2v20">Estado Programado<input type="checkbox" id="stspgm" class="stspgmv20"  /></div>

		<div class="itemBusc3v20">
			<select id="ietats2" class="SelList"><option value="1" selected>PROGRAMADO</option></select>
		</div>
		
	 </div>     
 
<div class="grid-ListaPartTit21 Administrar" id="grid-ListaPartTit">
  <!-- ENCABEZADOS DE LA GRIILLA-->
<div id="grid-LPReg" class="grid-Titulos21">
	  <div class="itt1">Carga Partidos</div>
	  <div class="itt2">
	  </div>
		<div class="itt3"  ></div>
		<div class="itt4"  ></div>
		<div class="itt5"  ></div>
		<div class="itt6"  ></div>
		<div class="itt7"  ></div>
		<div class="itt8"  ></div>
		<div class="itt9"  >
			<A href="Cpartidos.php">
	  			<button id="nuevop" name="nuevop" class="btnVerSet_21 Insta" title="Nuevo partido">+</button>
	  		</A>
		</div>
		<div class="itt10" ></div>	
</div>
<div class="grid-ListaPart21" id="grid-ListaPart21"></div> 
<div id="popUp" class="modal">
	<span class="close">X</span>
<div class="modal-content">
		<label class="TituloPop" for="modal-content">ESTADOS CARGADOS
         <p><select id="ietats" class="SelList">
		<option value="9999" selected>Seleccione un Estado</option>
		<input type="hidden" id="fechaxpartidoSelec" value="" />
		<input type="hidden" id="idxpartidoSelec" value="" />
	</select>
	</p>
	<p>
	<input type="button" id="Cambio" title="Cambiar Estado partido" name="cestado" class="btnCambioEstado"	value="Cambiar estado" onclick="cambioEstadoPartido();"></input>
	</p></label>
</div>
</div>
</div>
</body>
</html>
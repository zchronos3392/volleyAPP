
<html lang="es"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
        <title>ingreso admin</title>
        <meta name="title" content="volley all app, partido.">
        <meta name="ROBOTS" content="INDEX,FOLLOW">
        <meta http-equiv="Content-Language" content="es">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">	   
	   <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<!--SCRIPTS PRIMERO HAY QUE VINCULAR LA LIBERIA JQUERY PARA QUE RECONOZCA EL $-->
<!--SCRIPTS-->
	   <script type="text/javascript">
		// cuando PRESIONO CLICK , LO ACTUALIZO
		$(document).ready(function()
		{
		// ACTUALIZACION DE TABLAS..	
		
		 $("#accesor").on("change keyup", function()
		 {
			 var parametros = {
				 "TEXTOCLAVE" : $("#usuario").val() 
				 };	

			 $.ajax({ 
				url:   './abms/obtener_numeros.php',
				type:  'GET',
				data: parametros ,
				datatype:   'text json',
				beforeSend: function (){},
				done: function(data){},
				success:  function (r){
				// como el resultado volvia en JSON ,hay que convertirlo a string
				// o vector..o lo que sea leible..
					vector = $.parseJSON(r);
					if (vector.ultnumero == $("#accesor").val())
					{
						 $("#acceder").show() ;
						 //$("#accederclub").show() ;
					}	 
				     //else alert('tristeza =(');
				},
				error: function (xhr, ajaxOptions, thrownError){console.log(thrownError);}
				});
		  				
		  });//accesor, control final.
		  
		  $("#acceder").on("click",function(){
		  	
			  var parametros = {
				  "TEXTOCLAVE" : $("#usuario").val() ,
				  "origenrequest" :	<?php echo("'".$_SERVER['REMOTE_ADDR']."'"); ?>
			  };

			  $.ajax({
				  url:   './abms/grabarsesion.php',
				  type:  'GET',
				  data: parametros ,
				  datatype:   'text json',
				  beforeSend: function () {},
				  done: function(data) {},
				  success:  function (r) {
				  	window.location.href = 'controlVoleyApp.php'; 
				  },
				  error: function (xhr, ajaxOptions, thrownError) {console.log(thrownError);}
				  		  	
		  });// falta el seleccion de la cancha, para cargar los campos..		  
   		});//acceder CLICK
   		
//			$("#accederclub").on("click",function() {
//						window.location.href = './ingresar/ingresar.php';
//			});// falta el seleccion de la cancha, para cargar los campos..
   		
		});//document ready
		</script>    
<style>
			/* afecta al logo del formualrio */
			#page-wrapper{
				height: 100%;
				display: flex;
				margin-top: 15%;
				padding-left:15%;
				padding-right: 15%;
				flex-direction: column;
					background:url('./img/voleyplaya.jpg');
					background-size: cover;/*cubre todo bien*/

			}
			#page{
				flex: 1 0 auto;
				display: flex;
				flex-direction: column

			}
			#page-content{
				flex: 1 0 auto
			}
			/* afecta al logo del formualrio */

			/* afecta al fondo azul del formualrio */
			#page-login-index  #page-login-index  {
				background-color: white;
				border-radius: 0 0 4px 4px;
			}
			/* afecta al fondo azul del formualrio */

			/* afecta al tamaño de los inputs del formulario */
			.card-body{
				flex: 1 1 auto;
				padding: 2.25rem;
				background-color: rgba(45,103,162);
			}

			/*afecta a la cabecera del formulario, lo empuja hacia abajo*/
			.card-header {
				padding: .75rem 1.25rem;
				margin-bottom: 0;
				background-color: rgba(0,0,0,.03);
				border-bottom: 1px solid rgba(0,0,0,.125);
			}

			h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
				margin-bottom: .5rem;
				font-family: inherit;
				font-weight: 300;
				line-height: 1.2;
				color: inherit;
			}

			/* modifica el ancho del formulario en general */
			#region-main {
				overflow-x: auto;
				overflow-y: visible;
				-webkit-box-shadow: rgba(0,0,0,.05) 0 1px 0, rgba(0,0,0,.05) 0 2px 6px, rgba(0,0,0,.05) 0 10px 20px;
				box-shadow: rgba(0,0,0,.05) 0 1px 0, rgba(0,0,0,.05) 0 2px 6px, rgba(0,0,0,.05) 0 10px 20px;
				padding: 1.25rem;
				background-color: #fff;
			}
			/* modifica el ancho del formulario en general */


			/*FORMULARIO*/
			/*FORMULARIO: separacion de los inputs 2*/
			.form-group, .form-buttons, .path-admin .buttons, .fp-content-center form + div, div.backup-section + form {
				margin-bottom: 3rem;
			}

			/* tamaño y controles generales del formulario*/
			.form-control {
				display: block;
				width: 100%;
				padding: .375rem .75rem;
				font-size: .9375rem;
				line-height: 1.5;
				color: #495057;
				background-color: #fff;
				-webkit-background-clip: padding-box;
				background-clip: padding-box;
				border: 1px solid #ced4da;
				border-radius: 0;
				-webkit-transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
				-o-transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
				transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
			}

			/* acomoda la letra del boton login*/
			input, button, select, optgroup, textarea {
				margin: 0;
				font-family: inherit;
				font-size: inherit;
				line-height: inherit;
			}

			/* acomoda el boton del login al medio*/
			.form-login-loginbtn {
				text-align: center;
			}

			/* tamaño y forma del boton */
			.login-form>.form-login-loginbtn>#loginbtn {
				border-radius: 4px;
				background: gold;
				padding: 10px 30px 10px 30px;
				font-weight: 100;
				font-size: 15px;
				color: black;
			}

			.parrafoLogin {
				font-size: 1.3em;
				text-align: center;
				color: #ffffff;
				margin-top: 25px;
			}
			/*FORMULARIO*/
									

@media	(max-width:450px){
/* afecta al logo del formualrio */	
#page-wrapper{ 
		height: 100%;
		display: flex;
		margin-top: -2em;
		padding-left:0%;
		padding-right: 0%;
		flex-direction: column
		
		
}
#page{
	flex: 1 0 auto;
	display: flex;
	flex-direction: column

}
#page-content{
	flex: 1 0 auto
}
/* afecta al logo del formualrio */

/* afecta al fondo azul del formualrio */
#page-login-index  #page-login-index  {
	background-color: white;
	border-radius: 0 0 4px 4px;
}
/* afecta al fondo azul del formualrio */

/* afecta al tamaño de los inputs del formulario */
.card-body{
	flex: 1 1 auto;
	padding: 0.5rem;
	padding-bottom: 2em;
	background-color: rgba(45,103,162);
}

/*afecta a la cabecera del formulario, lo empuja hacia abajo*/
.card-header {
	padding: .75rem 1.25rem;
	margin-bottom: 0;
	background-color: rgba(0,0,0,.03);
	border-bottom: 1px solid rgba(0,0,0,.125);
}

h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6 {
	margin-bottom: .5rem;
	font-family: inherit;
	font-weight: 300;
	line-height: 1.2;
	color: inherit;
}

/* modifica el ancho del formulario en general */
#region-main {
	overflow-x: auto;
	overflow-y: visible;
	-webkit-box-shadow: rgba(0,0,0,.05) 0 1px 0, rgba(0,0,0,.05) 0 2px 6px, rgba(0,0,0,.05) 0 10px 20px;
	box-shadow: rgba(0,0,0,.05) 0 1px 0, rgba(0,0,0,.05) 0 2px 6px, rgba(0,0,0,.05) 0 10px 20px;
	padding: 1.25rem;
	background-color: #fff;
}
/* modifica el ancho del formulario en general */

			
/*FORMULARIO*/
/*FORMULARIO: separacion de los inputs 2*/			
.form-group, .form-buttons, .path-admin .buttons, .fp-content-center form + div, div.backup-section + form {
	margin-bottom: 3rem;
}

/* tamaño y controles generales del formulario*/
.form-control {
	display: block;
	width: 100%;
	padding: .375rem .75rem;
	font-size: .9375rem;
	line-height: 1.5;
	color: #495057;
	background-color: #fff;
	-webkit-background-clip: padding-box;
	background-clip: padding-box;
	border: 1px solid #ced4da;
	border-radius: 0;
	-webkit-transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	-o-transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
	transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}

/* acomoda la letra del boton login*/
input, button, select, optgroup, textarea {
	margin: 0;
	font-family: inherit;
	font-size: inherit;
	line-height: inherit;
}

/* acomoda el boton del login al medio*/
.form-login-loginbtn {
	text-align: center;
}

/* tamaño y forma del boton */			
.login-form>.form-login-loginbtn>#loginbtn {
	border-radius: 4px;
	background: gold;
	padding: 10px 30px 10px 30px;
	font-weight: 100;
	font-size: 15px;
	color: black;
}

.parrafoLogin {
	font-size: 1.3em;
	text-align: center;
	color: #ffffff;
	margin-top: 6px;
}
/*FORMULARIO*/						
}
	
	
	
</style>    
    </head>
<body id="page-login-index" >

<!--
<header class="headerIngreso">
	<section class="LogoApp" style="z-index: 0;">
		<a href="index.php"><img  class="LogoApp" alt="VOLLEY.app" src="./img/textovolleyAPP_pequeno.png" /></a>
	</section>	

</header>
-->
	<div id="page-wrapper">
		<div id="page">
			<div id="page-content" class="row">
				<section id="region-main" class="col-12" aria-label="Contenido">
					<div class="card-block">
										<h2 class="card-header text-center">
										<!-- <img src="./img/textovolleyAPP_pequeno.png" class="img-fluid" title="volleyAPP Ingreso" alt="ingresar a volley APP" style="height: 10%;width: 100%"> -->
										</h2>
										<div class="card-body">
											<p class="parrafoLogin">Ingreso interno::volleyAPP</p>
												<div class="row justify-content-md-center">
													<div class="col-md-8">
															<div class="gridAcceso" id="gridAcceso">
															  <div class="lettera">INGRESE CLAVE DE ACCESO
																	<input type="text" name="usuario" id="usuario" class="accesor" value="" placeholder="Nombre de usuario" autocomplete="username">
																	<input class="accesor" id="accesor" type="password"
																				placeholder="Clave de acceso" autocomplete="password"></input>
																			<?php	echo("<input class='accesor' id='conectadoFrom' type='hidden'
																			placeholder='conectadoFrom' autocomplete='conectado From' val='".$_SERVER['REMOTE_ADDR']."'></input>"); ?>
															  </div>
															  <!-- SI LA CLAVE ES LA CORRECTA APARECE EL BOTON ACCEDER-->
																<div id="contieneBotones"  name="contieneBotones"  class="contieneBotones">
																		<button id="acceder" class="btnacceder">
																  				<a>Acceso autorizado</a></button>
																		<!-- 
																		<button id="accederclub" class="btnacceder">
																			<a>Acceso Invitados Club</a>
																		</button>
																		-->
																 </div>
															  <!-- BOTON ACCEDER: LLEVA A LA PAGINA DE ADMINISTRACION-->  
															<!-- -->
															</div> 

									
								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>


</body></html>
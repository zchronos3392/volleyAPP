	<link  rel="icon"   href="./img/favicons/favicon.ico" type="image/png" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="./css/menunuevo/stylemenu.css" /> <!-- nuevas tipografias para el menu -->
	<link rel="stylesheet" href="./css/nsanz_style.css" /> <!-- nuevas tipografias para el menu -->
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />

<script type="text/javascript">
			$(document).ready(main);



			var contador = 1;

			function main(){

			$(window).on('resize', function()
			{
					var win = $(this); //this = window
					$("#medidas").text('RESPONSIVE DATA:W: ' + win.width()+' - H: '+ win.height());
			});				
				
				
			$('.menu_bar').click(function(){
					// $('nav').toggle(); 

					if(contador == 1){
						$('.MENUNUEVO').animate({
							left: '0'
						});
						contador = 0;
					} else {
						contador = 1;
						$('.MENUNUEVO').animate({
							left: '-100%'
						});
					}

				});

			};			

</script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
 <!-- MENUCONFIG.PHP -> DESPLEGABLE -->
		<script type="text/javascript">
			
		$(document).ready(function(){

			$("#salirsesionv").click(function() {
				var parametros =
				{
					"TEXTOCLAVE"   : <?php echo("'".$_SERVER['REMOTE_ADDR']."'"); ?>,
				};
				$.ajax({
					url:   './abms/salirsesion.php',
					type:  'GET',
					data:  parametros,
					dataType: 'json',
					beforeSend: function () {
						// Bloqueamos el SELECT de los cursos
					},
					done: function(data) {

					},
					success:  function (r) {
						//window.location.href='index.php';
						location.reload(true);
						},
					error: function (xhr, ajaxOptions, thrownError) {console.log(xhr);}
				}); // FIN funcion ajax CLUBES
			});

			});
		</script>

<body>
<div id="headerMenu" class="headerMenu">
		<div class="menu_bar">
			<a href="#" class="bt-menu"><span class="icon-list2"></span></a>
		</div>

		<nav class="MENUNUEVO">
			<ul>
					<!-- MENU CONFIG GRDIMENUAPPS V MODAL -->
					<li><a href="AdministrarAPP.php" title="administracion general"><img src="./img/menuapps/administrar.jpg" class="eConoapp" ><span>Partidos</span></a></li>
					
					<li><a href="Cpartidos.php" title="partidos"><img src="./img/menuapps/escudo_base_blancogrey_partidos.jpg" class="eConoapp"><span>Crear Partido</span></a></li>
				
					<li><a href="controlVoleyApp.php" title="tablero control anual"><img src="./img/menuapps/tableroControl.jpg" class="eConoapp" ><span>Tablero Anual</span></a></li>
				
					<li><a href="EstadisticasClub.php" title="estadisticas"><img src="./img/menuapps/escudo_base_blancogrey_estadisticas.jpg" class="eConoapp" /><span>Estadisticas</span></a></li>		

					<li><a href="CCategorias.php" title="categorias"><img src="./img/menuapps/escudo_base_blancogrey_categorias.jpg" class="eConoapp"><span>Categorias</span></a></li>
				
					<li><a href="Cclubes.php" title="alta clubes"><img src="./img/menuapps/escudo_base_blancogrey.jpg" class="eConoapp"><span>Clubes</span></a></li>
				
					<li><a href="Cciudades.php" title="ciudades"><img src="./img/menuapps/escudo_base_blancogrey_ciudad.jpg" class="eConoapp"><span>Ciudades</span></a></li>
				
					<li><a href="Ccompetencia.php" title="competencias"><img src="./img/menuapps/escudo_base_blancogrey_competencia.jpg" class="eConoapp"><span>Comps.</span></a></li>
				
					<li><a href="Ccanchas.php" title="canchas"><img src="./img/menuapps/escudo_base_blancogrey_cancha.jpg" class="eConoapp"><span>Canchas</span></a></li>
				
					<li><a href="Cjugadores.php" title="jugadores"><img src="./img/menuapps/escudo_base_blancogrey_jugadores_equipo.jpg" class="eConoapp"><span>Jugadores</span></a></li>

					<li><a href="Csedes.php" title="sedes"><img src="./img/menuapps/escudo_base_blancogrey_sedes.jpg" class="eConoapp"><span>Sedes</span></a></li>
				
					<li><a href="CEstados.php" title="estados"><img src="./img/menuapps/escudo_base_blancogrey_estados.jpg" class="eConoapp"><span>Estados</span></a></li>
				
					<li><a href="CNumeros.php" title="numeros"><img src="./img/menuapps/escudo_base_blancogrey_usuarios.jpg" class="eConoapp" /><span>Numeros</span></a></li>

					<li><a href="CPuestos.php" title="puestos"><img src="./img/menuapps/escudo_base_blancogrey_posiciones.png" class="eConoapp"/><span>Puestos</span></a></li>

					<li><a href="CEstrategias.php" title="estrategias libero"><img src="./img/menuapps/escudo_base_blancogrey_strats1.png" class="eConoapp"/><span>Estrategia Lib.</span></a></li>


					<li><a href="CDELUPD.php" title="abms delUpd"><img src="./img/menuapps/escudo_base_blancogrey_abms.jpg" class="eConoapp"><span>ABMS generales</span></a></li>
				
				
					<li><a href="#" id="ad" name="salirsesionv" ><img src="./img/menuapps/boton salir.jpg" class="eConoapp" ><span>Salir</span></a></li>
			</ul>
		</nav>
</div>

</body>



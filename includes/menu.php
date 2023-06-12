<?php ini_set('display_errors', '1'); ?>
	<link  rel="icon"   href="./img/favicons/favicon.ico" type="image/png" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<script type="text/javascript">
			$(document).ready(function(){
		// COIGO PARA ANIMAR LA HAMBURGUESA
			$(window).on('resize', function(){
						var win = $(this); //this = window
						//$("#medidas").text('RESPONSIVE DATA:W: ' + win.width()+' - H: '+ win.height());
				});				
			});
		</script>
<nav id="barra-navegacion" class="tope-fijo" name="barra-navegacion">

<a href="index.php">
	<Section class="ContenedorLogo">
	 <img  class="LogoApp" alt="VOLLEY.app" src="./img/vAPP23.gif" /> 
	</Section>
</a>
	
<!--*************** newmenu.php ******************* -->
<Section id="headerbar" name="headerbar" class="headerbar">
	<?php	
			require_once('./abms/SesionTabla.php');
		   $ingreso='';
		   $usuario = '';
		   if(isset($_SERVER['REMOTE_ADDR']))
				   $usuario = SesionTabla::getusuariocon("'".$_SERVER['REMOTE_ADDR']."'");
		   if(isset($_SERVER['REMOTE_ADDR']))	
		   		$ingreso= SesionTabla::getsession("'".$_SERVER['REMOTE_ADDR']."'");
		  
		  if(isset($ingreso)) 
			  if ((int)$ingreso["sesid"] !=0)
			  {	
				  include('includes/menuconapp.php'); 
		  		  //include('includes/menuConfig.php');;
					$_SESSION[$usuario["sesusuario"]]="SI";
		 	   }
		  	  else
			  {
				  $_SESSION[$usuario["sesusuario"]]="";	
				  echo "<button class='botonMenu'><a href='ingreso.php'><img class='contener' src='./includes/contrasenia.svg'></img></a></button>";
			  }	
		?>
</section>	
</nav>

 
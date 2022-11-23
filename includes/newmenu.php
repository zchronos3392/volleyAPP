<?php ini_set('display_errors', '1'); ?>

<nav id="barra-navegacion" class="tope-fijo" name="barra-navegacion">
<Section class="ContenedorLogo">
	<a href="index.php"><img  class="LogoApp" alt="VOLLEY.app" src="./img/textovolleyAPP_pequeno.png" /></a>
</Section>	
<!--*************** MENU.PHP ******************* -->
<Section id="headerbar" name="headerbar" class="headerbar">
	<?php	
			require_once('./abms/SesionTabla.php');
		   $ingreso='';
		   $usuario = '';
		   if(isset($_SERVER['REMOTE_ADDR']))
				   $usuario = SesionTabla::getusuariocon("'".$_SERVER['REMOTE_ADDR']."'");
		   if(isset($_SERVER['REMOTE_ADDR']))	
		   		$ingreso= SesionTabla::getsession("'".$_SERVER['REMOTE_ADDR']."'");
		  //echo "variable INGRESO :  $ingreso  ";
			if (isset($ingreso["sesid"]))
			  {	
			    if((int)$ingreso["sesid"] !=0 )
			    {
				  //include('includes/menuconapp.php'); 
		  		  include('includes/menuApps.php');
				  $_SESSION[$usuario["sesusuario"]]="SI";					
				}
				else
				{
				  $_SESSION[$usuario["sesusuario"]]="";	
				  echo "<button class='botonMenu'><a href='ingreso.php'><img class='contener' src='./includes/contrasenia.svg'></img></a></button>";
				}
		 	   }
		  	  else
			  {
			  	if(isset($usuario["sesusuario"]))
				  	$_SESSION[$usuario["sesusuario"]]="";	
				  echo "<button class='botonMenu'><a href='ingreso.php'><img class='contener' src='./includes/contrasenia.svg'></img></a></button>";
			  }	
		?>
</section>	
</nav>

 
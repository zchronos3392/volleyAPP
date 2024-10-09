<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax
require_once('SesionTabla.php');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {

	// "TEXTOCLAVE" : $("#usuario").val() ,
	// "origenrequest" :	<?php echo("'".$_SERVER['REMOTE_ADDR']."'"); 

		$clave ="";
		if(isset($_GET['TEXTOCLAVE']))	
			$clave = "'".$_GET['TEXTOCLAVE']."'";
		$valor = "";
		if(isset($_GET['origenrequest']))
			$valor =	"'".$_GET['origenrequest']."'";
//		$valor = "'".$_GET['CLAVEVALOR']."'";

		if(isset($_GET['datos']))
		{
			$filtroX =	$_GET['datos'];
			$icomp=$filtroX['0']['icomp'];
			$icate=$filtroX['1']['icate'];
			$iclub=$filtroX['2']['iclub'];
			$ietats=$filtroX['3']['ietats'];
			$icity2=$filtroX['4']['icity2'];
			$fecDde=$filtroX['5']['fecDde'];
			$fecHta=$filtroX['6']['fecHta'];
			//si viene definida DATOS, ES PORQUE GUARDE FILTROS, NO USUARIO.
			$parametrosGuardados=["icomp" => $icomp,
								  "icate" => $icate,
								  "iclub" => $iclub,
								  "ietats" => $ietats,
								  "icity2" => $icity2,
								  "fecDde" => $fecDde,
								  "fecHta" => $fecHta];
			SesionTabla::deletesessionfiltros($clave);	
			SesionTabla::setsessionfiltros($clave,"'".implode(" ",$parametrosGuardados)."'");

		}
		  if(isset($_GET['origenrequest']))
		  {
			// cuando viene de cualquier otra pantalla del sitio que no sea index
				SesionTabla::deletesessionfiltros($clave);	//<-- sino la recuerda siempre
					SesionTabla::setsession($clave,$valor);
		  }
			
	}

?>

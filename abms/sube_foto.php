<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/abms/Fotos.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	//LE PONGO NOMBRE DEL PARTIDO, FECHA E ID DE NUEVA FOTO
	$idpartido = 	$_POST['partidoid'];
	$fecha	   =	"'".$_POST["fechapart"]."'"; 
	$fechaComun =$_POST["fechapart"];
	$carpeta   = 	$_POST['icarpetas'];
	$mensajes = "<br> Partido : ".$idpartido." y fecha ".$fecha." , y carpeta: ".$carpeta." <br>";
//	$mensajes .= $_FILES['fotoPartido'];
	$mensajes .= "error que vino con el file: ".$_FILES['fotoPartido']['error'];
	if( isset($_FILES['fotoPartido']) and !$_FILES['fotoPartido']['error'] )
	{
			$mensajes .= "<br> Llego un archivo sin errores.";
			//$nombreTemporal = $_FILES['file']['tmp_name'];
			//$nombreArchivo  = $_FILES['file']['name'];				
		    $uploadedFile = '';
		    if(!empty($_FILES["fotoPartido"]["type"]))
		    {
		    	$ultimoIdCargado = 0;
		    	$mensajes .= "<br> cargando archivo en variable ";
					$fotosPartido = fotos::getLast($idpartido,$fecha);
					if($fotosPartido != "") $ultimoIdCargado = (int)$fotosPartido['idfoto'];
					if($ultimoIdCargado == 0)
							$ultimoIdCargado = 1;
					else
							$ultimoIdCargado++;	
							
		        $nombreArchivo = $ultimoIdCargado."_IDPARTIDO_".$idpartido."_FECHA_".$fechaComun."_".'_'.$_FILES['fotoPartido']['name'];
		        $valid_extensions = array("jpeg", "jpg", "png");
		        $temporal = explode(".", $_FILES["fotoPartido"]["name"]);
		        $file_extension = end($temporal);
		        if((($_FILES["fotoPartido"]["type"] == "image/png") || ($_FILES["fotoPartido"]["type"] == "image/jpg") || ($_FILES["fotoPartido"]["type"] == "image/jpeg")) && in_array($file_extension, $valid_extensions))
		        {
		        	$mensajes .= "<br> reconociendo extension correcta ";
		            $nombreTemporal = $_FILES['fotoPartido']['tmp_name'];
//						One of my typical example is:
	//						define('__ROOT__', dirname(dirname(__FILE__)));
	//						require_once(__ROOT__.'/config.php');
//						instead of:
//						<?php require_once('/var/www/public_html/config.php'); 
//						After this, if you copy paste your codes to another servers, it will still run, without requiring any further re-configurations.
						$PATHINICIAL = __ROOT__.'/img/partidos/';
			            $targetPath = $PATHINICIAL.$carpeta."/".$nombreArchivo;
		            if(move_uploaded_file($nombreTemporal,$targetPath))
		            {
		            	$mensajes .= "<br> archivo copiado al FS ";
		                $uploadedFile = "'".$nombreArchivo."'";
		                $fechaTabla = $fecha;
		                $retorno = fotos::insert($idpartido,$fechaTabla,$uploadedFile,"'".$file_extension."'","'".$carpeta."'");
		            	$mensajes .= "<br> retorno del insert: ".$retorno."<br>"; 
		            }
		        }
				$mensajes .= "<br> llego algo...temporal : ".$nombreTemporal."<br>  y Posta: ".$nombreArchivo."<br>  y final ".$targetPath;
		     }
	}
	else
	{
		$mensajes .= "<br> No llego un archivo.";
	}
	echo "$mensajes";
   }// cierre del POST
ELSE
	{
		//LE PONGO NOMBRE DEL PARTIDO, FECHA E ID DE NUEVA FOTO
		$archivo   = 	$_GET['fotoPartido'];
		$idpartido = 	$_GET['partidoid'];
		$fecha	   =	"'".$_GET["fechapart"]."'"; 

		echo($archivo);
	}   

?>

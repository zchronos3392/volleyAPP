<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require ('Competencia.php');

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/abms/Fotos.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Decodificando formato Json
 	//	"categoria" ,"edadi" ,"edadf"   
	$nombre = $_POST['nombre'];
	$setnmax = $_POST['SetMaxCate'];
	$activarCompetencia =0;
	$competenciaActivar = $_POST['SetActivo'];
		if($competenciaActivar == 'on') $activarCompetencia = 1;
	
	$archivoLogo ="''";
	$archivoLogo = procesarLogoCompetencia();
	//$archivoLogo        = $_POST['archivoLogo'];
    // Insertar ciudad
    $retorno = Competencia::insert($nombre,$setnmax,$activarCompetencia,$archivoLogo);

    if ($retorno) {
        // Código de éxito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creación exitosa')));
    } else {
        // Código de falla
        echo(json_encode($retorno));
    }
}

function procesarLogoCompetencia()
{
	$archivoLogo="''";
	$archivo = $_FILES['miLogo'];
	$uploadedFile='';
	if( isset($_FILES['miLogo']) and !$_FILES['miLogo']['error'] )
	{
		    $uploadedFile = '';
		    if(!empty($_FILES["miLogo"]["type"]))
		    {
		        $nombreArchivo = $_FILES['miLogo']['name'];
		        $temporal = explode(".", $_FILES["miLogo"]["name"]);
		        $file_extension = end($temporal);
		        $nombreTemporal = $_FILES['miLogo']['tmp_name'];
				$PATHINICIAL = __ROOT__.'/img/competencias/';
	            $targetPath = $PATHINICIAL.$nombreArchivo;
	            if(move_uploaded_file($nombreTemporal,$targetPath))
	            {
	                $archivoLogo = "'".$nombreArchivo."'";
	            }
		     }
	}
return $archivoLogo;
}

?>
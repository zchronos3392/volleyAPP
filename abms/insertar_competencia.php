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
	$nombre = "'".$_POST['nombre']."'";
	$setnmax = $_POST['SetMaxCate'];
	$activarCompetencia =0;
	$competenciaActivar = $_POST['SetActivo'];
		if($competenciaActivar == 'on') $activarCompetencia = 1;
	
	$fechaIniciaComp = $_POST['FechaInicioComp'];
	$fechaFinComp	 = $_POST['FechaFinComp'];


	$archivoLogo ="''";
	$archivoLogo = procesarLogoCompetencia();
	//$archivoLogo        = $_POST['archivoLogo'];
    // Insertar ciudad
    $retorno = Competencia::insert($nombre,$setnmax,$activarCompetencia,$archivoLogo,$fechaIniciaComp,$fechaFinComp);



    if ($retorno) {
        // C�digo de �xito
        echo(json_encode(array('estado' => '1','mensaje' => 'Creaci�n exitosa')));
    } else {
        // C�digo de falla
        echo(json_encode($retorno));
    }
}

function procesarLogoCompetencia()
{
	$archivoLogo="''";
	$archivo = $_FILES['ControlelegirLogo'];
	$uploadedFile='';
	if( isset($_FILES['ControlelegirLogo']) and !$_FILES['ControlelegirLogo']['error'] )
	{
		    $uploadedFile = '';
		    if(!empty($_FILES["ControlelegirLogo"]["type"]))
		    {
		        $nombreArchivo = $_FILES['ControlelegirLogo']['name'];
		        $temporal = explode(".", $_FILES["ControlelegirLogo"]["name"]);
		        $file_extension = end($temporal);
		        $nombreTemporal = $_FILES['ControlelegirLogo']['tmp_name'];
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
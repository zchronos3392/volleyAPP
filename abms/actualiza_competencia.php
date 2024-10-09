<?php
/**
 * Insertar una nueva Club en la base de datos
 */
//el return sirve para cuando lo llamas desde ANSROID !!!
require ('Competencia.php');

define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/abms/Fotos.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// <input id="cnombre"  name="cnombre" type="text">
	// <input type="text" id="SetMaxCate" name="SetMaxCate" class="inputSets" />
	// <input type="checkbox" id="SetActivo" name="SetActivo" class="inputSets" />
	// <input type="file" value="" name="ControlelegirLogo" id="ControlelegirLogo"/>
	$idcompetencia = 0;
	if(isset($_POST['idcompetencia']))
		$idcompetencia = $_POST['idcompetencia'];
	
	if($idcompetencia != 0)
	{
		$competenciaModificar = Competencia::getById($idcompetencia);

		//print_r($competenciaModificar);

		$nombre = '';
		if(isset($_POST['nombre']))
			$nombre = $_POST['nombre'];
		else
			$nombre = $competenciaModificar['cnombre'];
		$setnmax = 0;
			if(isset($_POST['SetMaxCate']))
			$setnmax = $_POST['SetMaxCate'];
		else
			$setnmax = $competenciaModificar['SetMaxCate'];
		
		$competenciaActivar ='';
		$ActivaDesactiva = 0;
		$competenciaActivar = '';
		if(isset($_POST['SetActivo'] )) 
				$competenciaActivar = $_POST['SetActivo'];
		else
				$competenciaActivar = $competenciaModificar['SetActivo'];

		if($competenciaActivar == 'on') $ActivaDesactiva = 1;
		

		$accion ="";
		if(isset($_POST['accion'])) $accion = $_POST['accion'];

		$fechaIniciaComp = $_POST['FechaInicioComp'];
		$fechaFinComp	 = $_POST['FechaFinComp'];
	
		if($accion == 'UPD')
		{
		if($idcompetencia != 0)
		{
			$competenciaModificar = Competencia::getById($idcompetencia);
			$archivoLogo ="''";
			$archivoLogo = procesarLogoCompetencia();
			if($archivoLogo == '')
					$archivoLogo = "'".$competenciaModificar['Logo']."'";
			//																cnombre,setnmax,competenciaActiva,Logo	
			$retorno = Competencia::ActualizaCompetencia($idcompetencia,$nombre,$setnmax,$ActivaDesactiva,$archivoLogo,$fechaIniciaComp,$fechaFinComp);
		}	
		}
		else
			if($accion == 'DEL')
				$retorno = Competencia::delete($idcompetencia);


		if ($retorno) {
			// C�digo de �xito
			echo(json_encode(array('estado' => '1','mensaje' => 'Creacion exitosa')));
		} else {
			// C�digo de falla
			echo(json_encode($retorno));
		}
	}
	else
		echo(json_encode(array('estado' => '0','mensaje' => 'No se modificó nada')));

}

function procesarLogoCompetencia()
{
	$archivoLogo="''";
	$archivo = $_FILES['ControlelegirLogo'];
	// echo "<br> llego :  <br>";
	// print_r($archivo);
	$uploadedFile='';
	if($archivo['size'] != 0){
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
	}
	else
	   echo "<br> no hay cambios en el archico del logo <br>";

return $archivoLogo;
}

?>
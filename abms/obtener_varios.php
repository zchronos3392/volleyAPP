<?php
/**
 * Obtiene todas carpetas de fotos del año qe llego por parametro
 */

define('__ROOT__', dirname(dirname(__FILE__)));
//require_once(__ROOT__.'/abms/Fotos.php');
require_once(__ROOT__.'/abms/Club.php');
require_once (__ROOT__.'/abms/Cancha.php');
require_once (__ROOT__.'/abms/Ciudad.php');
require_once (__ROOT__.'/abms/Competencia.php');


if($_SERVER['REQUEST_METHOD'] == 'GET') {

	$llamador ="";
     if(isset($_GET['llamador']))  $llamador = $_GET['llamador'];
     if(isset($_POST['llamador']))  $llamador = $_POST['llamador'];

	 $funcion=""; // en cero no hace nada, en 1 achica la lista
     if(isset($_GET['funcion']))  $funcion = $_GET['funcion'];
     if(isset($_POST['funcion']))  $funcion = $_POST['funcion'];

	 $ianio = 0; // en cero no hace nada, en 1 achica la lista
     if(isset($_GET['ianio']))  $ianio = $_GET['ianio'];
     if(isset($_POST['ianio']))  $ianio = $_POST['ianio'];
     	


	$filtro='';
	if(isset($_GET['filtro']))  $filtro = $_GET['filtro'];
	if(isset($_POST['filtro']))  $filtro = $_POST['filtro'];


switch($funcion){
		case "CarDirectorios": 
		//"llamador":'controlador'
		//Si es un directorio
		$carpeta = __ROOT__.'/img/partidos/'.$ianio;
		//echo $carpeta."<br>";
		if(is_dir($carpeta)) 
		{
				//Escaneamos el directorio
				//echo "El directorio fue detectado como Directorio";
				$algo = @scandir($carpeta);
				
				If($algo != ""){
					//Miramos si existen archivos
					if (count($algo) > 2){
						//echo// 'El directorio tiene archivos..mostrando:<br>';
							$padre="/";
							$nivel=-1;
							$archivos=array();
							$archivos_V2=array();
							//listadoSubDirectoriov2($carpeta,$padre,$nivel, $archivos_V2);

							$datos["estado"] = 1;
							$datos["Carpetas"] = "Existe el directorio para fotos";//es un array
								print json_encode($datos);

					}else
					{
					}
				}
				else
				{
						$datos["estado"] = 22;
						$datos["Carpetas"] = "<br>El directorio $carpeta está vacío";//es un array
							print json_encode($datos); 	
				}
		}
		else 
		{
			$datos["estado"] = 3;
			$datos["Carpetas"] = "No existe el directorio para fotos";//es un array
				print json_encode($datos);
		}	
		break;
	case "buscarclub": 
					$clubesEncontrados = Club::getAllconFiltro($filtro);
					//print_r($clubes); // viene un vector
					if(count($clubesEncontrados) > 0)
					{
						//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
						$datos["estado"] = 1;
						$datos["Clubes"] = $clubesEncontrados;//es un array
						print json_encode($datos);
					}		
						//el print lo puedo usar para cuando lo llamo desde android
		break;
	case "buscarcancha": 
					$canchasEncontradas = Cancha::getAllFiltro($filtro);
				
					//print_r($clubes); // viene un vector
					if(count($canchasEncontradas) > 0)
					{
						//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
						$datos["estado"] = 1;
						$datos["Canchas"] = $canchasEncontradas;//es un array
						print json_encode($datos);
					}	
					else
					{
						//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
						$datos["estado"] = 99;
						$datos["Canchas"] = "Sin canchas cargadas";//es un array
						print json_encode($datos);
					}		
							
						//el print lo puedo usar para cuando lo llamo desde android
						
		break;

	case "buscarciudad":
					$ciudades = Ciudad::getAllFiltro($filtro);

					if(count($ciudades) > 0)
					{
						//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
						$datos["estado"] = 1;
						$datos["Ciudades"] = $ciudades;//es un array
						print json_encode($datos);
					}	
					else
					{
						//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
						$datos["estado"] = 99;
						$datos["Ciudades"] = "Sin ciudades que coincidan";//es un array
						print json_encode($datos);
					}		
							
						//el print lo puedo usar para cuando lo llamo desde android
						
		break;
		
	case "buscarclubStats":
			 $todxs=0; // en cero no hace nada, en 1 achica la lista
		     if(isset($_GET['todxs']))  $todxs = $_GET['todxs'];

			 $ianio = 0;
		     if(isset($_GET['ianio']))  $ianio = (int)$_GET['ianio'];

			if($todxs == 1) $clubesEncontrados = Club::getAllConJugadoresFiltro($ianio,$filtro);
			else $clubesEncontrados = Club::getAllconFiltro($filtro);

					if(count($clubesEncontrados) > 0)
				{
					//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
					$datos["estado"] = 1;
					$datos["Clubes"] = $clubesEncontrados;//es un array
					print json_encode($datos);
				}		

						
		break;
		
	case "buscarcompetencia":

				$COMPETENCIASEncontradas = Competencia::getAllFiltro($filtro);

					if(count($COMPETENCIASEncontradas) > 0)
				{
					//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
					$datos["estado"] = 1;
					$datos["Competencias"] = $COMPETENCIASEncontradas;//es un array
					print json_encode($datos);
				}		
						
		break;		
	} // fin del  switch	
	

}


function listadoSubDirectoriov2($directorio,$padre,$nivel, &$archivos = [])
{
	$nivel++;
	echo "<br> analizando $directorio <br>";
    $dir = opendir($directorio);//dir es un VECTOR CON LOS ARCHIVOS DENTRO
    while (false !== ($current = readdir($dir)))
     { //leer directorio
        $ruta_completa = $directorio . "/" . $current;
		if(is_dir($ruta_completa))
		{
        if ($current !== "." && $current !== ".." ) 
         {
         	echo "<br>	encontre $current en nivel : $nivel<br>";
			echo "<br>	y es un directorio<br>";
			
			$HijosCarpeta = array_diff(scandir($ruta_completa), array('..', '.'));
			//LIMPIO LAS IMAGENES DEL DIRECTORIO QUE NO ME SIRVEN
			echo "			contenido  en nivel : $nivel<br> ";
			print_r($HijosCarpeta);
			echo "<br> 			******************* <br> ";
			$hijostemporal=array();
			$valid_extensions = array("jpeg", "jpg", "png");
			$hojasEnCarpeta=0;
			foreach($HijosCarpeta as $clave=>$value)
			{
			  $extensionFile = explode(".", $value);
			  $file_extension = end($extensionFile);
			  if(! in_array($file_extension, $valid_extensions))
				{
					$hijostemporal[]=$HijosCarpeta[$clave];
				}
				else $hojasEnCarpeta++;	
			}
			$HijosCarpeta=$hijostemporal;
			
			if (count($HijosCarpeta) > 0)
			{
				echo "<br>				sigo escarbando dentro de el, desde el nivel : $nivel<br>";
				listadoSubDirectoriov2($ruta_completa . '/',$padre."/".$current,$nivel,  $archivos);
			}	
			else
			{ //no tiene hijos...
			echo "<br>					+++++++  agregando Directorio : $directorio  en nivel : $nivel<br>";
	        $archivos[] = [
	  			  'path'       => $ruta_completa,
	  			  'directorio' => $ruta_completa."(con ".$hojasEnCarpeta." hojas)"
			];
			}
      	}
       }
      }
    
	closedir($dir);
  return $archivos;			

}

?>

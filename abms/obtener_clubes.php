<?php
/**
 * Obtiene todas las Clubs de la base de datos
 */
// el RETURN FUNCIONA OK
// pero como habia agregado el REQUIRE DE ESTA PAGINA EN LA PAGINA DE DESTINO, 
// EL ECHO ME IMPRIMIA LO MISMO QUE DEVOLVIA EL ECHO !!!!! FUUCCKK
// solo que hay que saber que se esta recibiendo del lado del ajax
require ('Club.php');
require_once ('Categoria.php');

//echo($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Manejar petici�n GET
     if(isset($_GET['CPartido']))  $opcion = $_GET['CPartido'];
     else $opcion = "N";
	
	 $todxs=0; // en cero no hace nada, en 1 achica la lista
     if(isset($_GET['todxs']))  $todxs = $_GET['todxs'];

	 $ianio = 0;
     if(isset($_GET['ianio']))  $ianio = (int)$_GET['ianio'];

	 
	 $catsX = 0;
     if(isset($_GET['CategoriasXargadas']))  $catsX = (int)$_GET['CategoriasXargadas'];

	 $icompetencia = 0; //PORQUE SE LO LLAMA DESDE CONTROLVOLEYAPP
     if(isset($_GET['icompetencia']))  $icompetencia = (int)$_GET['icompetencia'];

	 //"todxs":1,"CategoriasXargadas":1
    $registros = Club::contar();
    // ESTA VOLVIENDO UN VECTOR DE VECTORES
    	//print_r ($registros["0"]["count(*)"]);
    if($registros["0"]["count(*)"] > "0")
     {
		if($todxs == 1) {
			if($icompetencia == 0)
				$clubes = Club::getAllConJugadores($ianio);
			else
				$clubes = Club::getAllConJugadoresComp($ianio,$icompetencia);
		}	
		else $clubes = Club::getAll();
	    	//print_r($clubes); // viene un vector
	    if ($clubes) {
			//Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
	        //$datos["estado"] = 1;
			if($catsX == 1)
			{
				$categoriasClub=array();
				$i=0;
				foreach($clubes as $clave => $valor)
				{
					//echo " id ".$valor['idclub']." nombre ".$valor['clubabr']."<br>";	
					$categorias = Categoria::getAllConJugadores($ianio,$valor['idclub']);
					//print_r($categorias);
					
					foreach($categorias as $catIndex => $valorCat){
						//echo " ".$valor['idclub']." ".$valorCat['descripcion']." ".$valorCat['ConJugadores']." <br>";
						 //= array_push();
						 $categoriasClub[$i]['idclub'] = $valor['idclub'];
						 $categoriasClub[$i]['descripcion'] = $valorCat['descripcion'];
						 $categoriasClub[$i]['ConJugadores'] = $valorCat['ConJugadores'];
						 $i++;
						}	 
					}

			}
	        if($opcion == 'S')
	        {
	        		$datos["estado"] = 11;
	        		$datos["Clubes"] = $clubes;//es un array
					if($catsX == 1) $datos["Categorias"] = $categoriasClub;//es un array
	        }
	        else{
					$datos["estado"] = 1;	        
	        	    $datos["Clubes"] = $clubes;//es un array
					if($catsX == 1) $datos["Categorias"] = $categoriasClub;//es un array
				}		        	    
	        print json_encode($datos);
	        //el print lo puedo usar para cuando lo llamo desde android
	    }
	    else {
	    		print json_encode(array("id" => 2,"nombre" => "Sin clubes aun"));
	    }
	}
	else
			print json_encode(array("id" => 3,"nombre" => "Tabla vacia, conteo 0"));
}
?>

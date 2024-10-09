<?php 

if($_SERVER['REQUEST_METHOD'] == 'GET') {

    $carpeta = $_GET['carpetaFiltro'];
    $data = array();
    $count = 0;
    $data=listar_directorios_ruta($carpeta);
    

	// $tipoArchivo = $_POST['Tipofiltro'];
    //./img/escudos/
        // // // opendir() - Abre un gestor de directorio
        // // // readdir() - Lee una entrada desde un gestor de directorio
        // // // glob() - Buscar coincidencias de nombres de ruta con un patrón
        // // // is_dir() - Indica si el nombre de archivo es un directorio
        // // // sort() - Ordena un array    
        // $respuesta = Array();
        // $imagenEncontrada = scandir($carpeta);
        // $indiceVector =0;
        // for($indiceVector=0; $indiceVector < count($imagenEncontrada); $indiceVector++){
        //     if(is_dir($imagenEncontrada[$indiceVector])){
        //         $SubDirectorio = scandir($imagenEncontrada[$indiceVector]);
        //         $SubDirectorio['carpeta'] = $valor;
        //     }
        //     else{
        //         $respuesta[$indiceVector]['archivo'] = $imagenEncontrada[$indiceVector];
        //         $respuesta[$indiceVector]['carpeta'] = $carpeta;
        //     }
        // }   
        if ($data) {
            //Array ( [0] => Array ( [idclub] => 4 [nombre] => BOCAb [clubabr] => BJR ) )
            $datos["estado"] = 1;
            $datos["archivos"] = $data;//es un array
            print json_encode($datos);
            //el print lo puedo usar para cuando lo llamo desde android
        }
        else {
            print json_encode(array("id" => -1,"nombre" => "Carpeta sin archivos aun"));
        }
        
    }

    function listar_directorios_ruta($ruta){ 
        $data=array();
        // abrir un directorio y listarlo recursivo 
        if (is_dir($ruta)) { 
            if ($dh = opendir($ruta)) {
                $count=0;
            while (($file = readdir($dh)) !== false) { 
                if (is_dir($ruta . $file) && $file!="." && $file!=".."){ 
                    //solo si el archivo es un directorio, distinto que "." y ".." 
                    //echo "<br>Directorio: $ruta$file";
                    $data['SubDir']["$ruta$file"]=listar_directorios_ruta($ruta.$file . "/"); 
                }elseif($file!="." && $file!=".."){
                    $data[$count]=array($ruta,$file);
                    //$data[$count]['ruta']=$ruta;
                }
                $count++;
            } 
            closedir($dh); 
            } 
        }
        return $data;
    }

?>

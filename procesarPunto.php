 <?php 
 // para PHP solo sirve el name
$boton_presionado = 0 ;
if($_POST['boton+'] == 1) {$boton_presionado = 1; echo("SumarPunto"); }
elseif($_POST['boton-'] == 1) {$boton_presionado = 2; echo("RestarPunto"); }  
 
// if (count($_POST)>0) //Solo se ejecutará si ha enviado los datos por formulario, dar click en el boton ENVIAR
//    {
//        echo "<pre>";
        //print_r($_POST); //Imprime el contenido de $_POST
//        print_r($_POST['boton+']); 
  //      print_r(gettype($_POST['boton+']));
//        echo "</pre>";
//    }
//	echo("ud presionó el boton " . $boton_presionado); funciono el 02 feb 2018 2036
 
 
?>
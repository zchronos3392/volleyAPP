<?php


/* Provee las constantes */

define("HOSTNAME", "localhost:3307");// Nombre del host agregar 3309 para localhost
//define("HOSTNAME", "localhost:3306");// Nombre del host agregar 3309 para localhost
define("DATABASE", "nicolass__voleyap"); // Nombre de la base de datos
define("USERNAME", "c0990415_voleyap"); // Nombre del usuario
//define("USERNAME", "nicolass_voleyap"); // Nombre del usuario
define("PASSWORD", "kefaKA24fu"); // Nombre de la constrase�a appvolley
//	define("PASSWORD", "nomelaacuerdo01"); // Nombre de la constrase�a appvolley
// /* Provee las constantes */

$connection = @mysqli_connect(HOSTNAME, USERNAME, PASSWORD, DATABASE) or 
			     die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());


?>


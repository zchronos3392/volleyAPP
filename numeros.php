 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="es">
    <head>
		<link href="favicon.ico" rel="icon" type="image/png">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>VOLLEY.APP</title>
        <meta name="title" content="volley all app, partido."/>
        <meta name="ROBOTS" content="INDEX,FOLLOW"/>
        <meta http-equiv="Content-Language" content="es"/>
        <meta name="keywords" content=""/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- ESTILOS -->
	   <link rel="stylesheet" href="./css/nsanz_style.css">
	   <link rel="stylesheet" href="./css/bootstrap.css">
	   <!--SCRIPTS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script>
		</script>
		
</head> 
<body>
   	<header>
    </header>
	
<?php

require_once('./abms/Cancha.php');
$ultimacancha =  Cancha::ultID();
print_r($ultimacancha);

  	$idcancha = 1;
	if( !empty($ultimacancha) ) $idcancha = (int) $ultimacancha[0]["idcancha"];
    if($idcancha == 0) $idcancha = 1;
    else $idcancha++;

	echo($idcancha);


if(isset($_GET['puntosa'])) $ClubARes 	= $_GET['puntosa'];
if(isset($_GET['puntosb'])) $ClubBRes 	= $_GET['puntosb'];
if(isset($_GET['equipoa'])) $ClubA 		= $_GET['equipoa'];
if(isset($_GET['equipob'])) $ClubB 		= $_GET['equipob'];
if(isset($_GET['setmax'])) $setsnmax 	= $_GET['setmax'];
if(isset($_GET['puntosa']) && isset($_GET['puntosb']) && isset($_GET['equipoa']) && isset($_GET['equipob']) && isset($_GET['setmax']))
{
	echo "METODO DE CARGA DEL FORMULARIO OK (GET) <BR>";
	// mayor  
	 $puntos = array('mayor' => -1 , 'menor' => -1 ,'equipoMayor' => 0 , 'equipoMenor' => 0);
	// menor 
	echo "vector cargado : <BR>";
	print_r($puntos);
	
	$ganador =0;
	if($ClubARes > $ClubBRes)
	{
	 $puntos['mayor'] = $ClubARes;
	 $puntos['equipoMayor'] = $ClubA;

	 $puntos['menor'] = $ClubBRes;
	 $puntos['equipoMenor'] = $ClubB;
	}
	else if($ClubBRes > $ClubARes)
	{
		 $puntos['mayor'] = $ClubBRes;
		 $puntos['equipoMayor'] = $ClubB;

		 $puntos['menor'] = $ClubARes;
		 $puntos['equipoMenor'] = $ClubA;
	};

	echo " <BR>vector con datos ordenados: <BR> ";
	print_r($puntos);
	
	
	
	$setsJugados = $ClubARes + $ClubBRes;
	$DifSetMax_Jug = $setsnmax - $setsJugados;
		if($DifSetMax_Jug < 0) $DifSetMax_Jug *= -1; // por si queda negativo..
	
	echo " <BR>sets jugados totales: ".$setsJugados;
	echo " <BR>diferencia de Sets: ".$DifSetMax_Jug;
		
	// Si son iguales no se hace nada...esto se verifica chequeando que ninguno de los dos tenga valor 0
	if($puntos['mayor']!=-1 && $puntos['menor']!=-1)
	{
	  echo " <BR>ambos puntajes estan cargados en el vector, porque no son iguales..";
	  
	  $difpuntos = (int)$puntos['mayor'] - (int)$puntos['menor'];

		if($setsnmax == 3) // compentecias con 3 sets maximos
		{
			echo " <BR> set cantidad maxima: 3";
		 //diferencia entre setsmaximos y setsjugados
		   if($DifSetMax_Jug == 1 || $DifSetMax_Jug == 0)
			{
			 echo " <BR> diferencia por sets jugados: ".$DifSetMax_Jug;
			 if($difpuntos == 2 || $difpuntos == 1){$ganador=$puntos['equipoMayor'];};
			}	
		}
		else // competencias con 5 sets maximo
		{
			echo " <BR> set cantidad maxima 5";
		 //diferencia entre setsmaximos y setsjugados
		   if($DifSetMax_Jug == 2 || $DifSetMax_Jug == 1 || $DifSetMax_Jug == 0)
			{
			 echo " <BR>diferencia por sets jugados: ".$DifSetMax_Jug;
			 if($difpuntos == 3 || $difpuntos == 2 || $difpuntos == 1){$ganador=$puntos['equipoMayor'];};
			}	
		}
	}
	
};

if($ganador != '') echo " <BR>GANADOR ES: ".$ganador;
else echo " <BR>AUN NO HAY GANADOR";

?>
<form action="numeros.php" style="width:50%;">
  <label for="puntosa">PUNTOS A</label>
  <input type="text" name="puntosa" id="puntosa" value="<?php if(isset($_GET['puntosa'])) echo $_GET['puntosb']; ?>"><br>
  
  <label for="equipoa">EQUIPO A</label>
  <input type="text" name="equipoa" id="equipoa" value="<?php if(isset($_GET['equipoa'])) echo $_GET['equipoa']; ?>"><br>

  <label for="puntosb">PUNTOS B</label>
  <input type="text" name="puntosb" id="puntosb" value="<?php if(isset($_GET['puntosb'])) echo $_GET['puntosb']; ?>"><br>
  
  <label for="equipob">EQUIPO B</label>
  <input type="text" name="equipob" id="equipob" value="<?php if(isset($_GET['equipob'])) echo $_GET['equipob']; ?>"><br>

  <label for="setmax">SET MAXIMOS</label>
  <input type="text" name="setmax" id="setmax" value="<?php if(isset($_GET['setmax'] )) echo $_GET['setmax']; ?>"><br>
  
  <input type="submit" value="Submit">
</form>	

</body>
</html>

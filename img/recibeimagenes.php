<?php 
//https://stackoverflow.com/questions/50210228/how-to-send-blob-appended-in-formdata-to-php
 // $res = file_get_contents("php://input");
 // echo "data:image/jpg;base64,".base64_encode($res);
			//var_dump($_FILES);
/*array(1) {
  ["file"]=>
  array(5) {
    ["name"]=>
    string(9) "12oct.png"
    ["type"]=>
    string(9) "image/png"
    ["tmp_name"]=>
    string(45) "C:\Users\zeroC\AppData\Local\Temp\php327E.tmp"
    ["error"]=>
    int(0)
    ["size"]=>
    int(104397)
  }
}*/	



if(isset($_FILES['file']) and !$_FILES['file']['error'])
			move_uploaded_file($_FILES['file']['tmp_name'], "./escudos/" . $_FILES['file']['name']);	


  //  $file = fopen("./escudos/" .$nombrearchivo, 'w');
  //  fwrite($file, $data);
  //  fclose($file);




?>



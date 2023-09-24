<?php
include("autoloader.php");
// definisco una variabile con il percorso alla cartella
// in cui sono archiviati i file




$db= new DB();
$cl=new Clear();




echo  $db->getCampo("admin", "utenza_estera", array('id'=>1341));

  

?>

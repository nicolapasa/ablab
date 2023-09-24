<?php
include("autoloader.php");
$db= new DB();



$oggetto=$_POST['oggetto'];
echo $testo=$_POST['testo'];


echo $t= str_replace('kcfinder/', 'http://srlsolutions.it/ablab/kcfinder/', $testo);

Utility::inviaMail('nicola.pasa@gmail.com', $oggetto, $t);


?>
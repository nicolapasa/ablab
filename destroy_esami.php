<?php
include("autoloader.php");

//routine che controlla gli esami e li cancella dopo 3 mesi
//include('/destroy_esami.php'); prima facciamo un backup

include('backup.php');

$s=new Scheda();



$s->pulisciDb();


header("Location: index.php");

?>
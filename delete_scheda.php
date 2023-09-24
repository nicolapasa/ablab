<?php
include("autoloader.php");


$s= new Scheda();
$id = $_POST['id'];


$s->delete_scheda($id);//cancello clinica
//cancello esami e altri dati




?>

<?php
include("autoloader.php");


$db= new DB();
$id = $_POST['id'];


$db->delete('error', $id);//cancello clinica
//cancello esami e altri dati




?>

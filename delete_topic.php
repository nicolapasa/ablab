<?php 
include("autoloader.php");


$db= new DB();
$id = $_POST['id'];


$db->delete('for_topic',$id);


?>
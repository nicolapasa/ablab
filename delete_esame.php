<?php 
include("autoloader.php");


$db=new DB();
$id = $_POST['id'];


$db->update('esami_cat', array('eliminato'=>'S'), $id);



?>
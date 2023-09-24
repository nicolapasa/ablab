<?php 
include("autoloader.php");


$db= new db();


$id=$_POST['id'];


$db->deleteP('tabelle_data', array('id_tab'=>$id));
$db->delete('tabelle', $id);
?>
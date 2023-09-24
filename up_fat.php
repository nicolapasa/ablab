<?php
session_start();
include("autoloader.php");

$db= new DB();





echo $id=$_POST['id'];
echo $value=$_POST['value'];


$db->update('fatture', array('pagata'=>$value), $id);

?>
<?php


include("autoloader.php");
$u= new DB();



echo $u->checkRecJson('admin', array('piva'=>$_GET['piva']));


$u->close();


?>

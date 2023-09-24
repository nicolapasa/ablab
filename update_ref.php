<?php
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
header("Pragma: no-cache"); // HTTP 1.0.
header("Expires: 0"); // Proxies
session_start();
include("autoloader.php");

$db= new DB();



	$campo=$_POST['campo'];
 $id=$_POST['id'];

 $value=$_POST['value'];
//echo $value=htmlentities(str_replace('&nbsp;', '', $_POST['value']));


$id_data=$db->getCampo('referti_data', 'id', array('id_tref'=>$id));	
	
$db->update('referti_data', array($campo=>$value), $id_data);


?>
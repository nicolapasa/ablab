<?php 
session_start();
include("autoloader.php");

$db= new DB();


$id=$_SESSION['loggato'];


$val=$db->getCampo('log', 'value', array('id_struttura'=>$id));
$letto=$db->getCampo('log', 'letto', array('id_struttura'=>$id));
$id_log=$db->getCampo('log', 'id', array('id_struttura'=>$id));
if($val<=5 and $letto<$val){
	$db->update('log', array('letto'=>$val), $id_log); 
	echo 'ok';
	
}
	

	
?>
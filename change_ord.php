<?php
session_start();
include("autoloader.php");

$db= new DB();


$id=$_POST['id'];
$ord=$_POST['ord'];



$db->updateP('esami_ordine', array('ord'=>$ord), array('id_esame'=>$id));//aggiorno



?>

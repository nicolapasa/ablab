<?php
session_start();
include("autoloader.php");


$db= new DB();
$not=new Notifiche();
$id=$_GET['id'];

$not->getLetta($_SESSION['loggato'], $id, 'doc');

$file=$db->getCampo('doc', 'file', array('id'=>$id));
$url=DIR_UPLOAD.$file;

header("Location: $url");
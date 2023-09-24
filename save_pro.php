<?php
session_start();
include("autoloader.php");

$db= new DB();
$cl=new Clear();


$_POST=$cl->pulisci($_POST);

//print_r($_POST);

$id=$_POST['id'];
	unset($_POST['id']);
//update anche del proprietario
$db->update('proprietari', $_POST, $id);

header("Location: index.php?req=mod_pro&subreq=mod_dati_pro&id=&id=$id&mess=ok");
?>
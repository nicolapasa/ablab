<?php
error_reporting(0);
session_start();
include("./autoloader.php");


$id=$_POST['id'];

$t=$_POST['tabella'];



$u =new DB();



if($t=='newsletter'){
	
	//cancello anche mailing list 
	$u->deleteP('mailing_list', array('id_news'=>$id, 'tipo'=>'newsletter' ));	
	
}

$u->delete($t, $id);	
	



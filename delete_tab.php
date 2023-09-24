<?php
error_reporting(0);
session_start();
include("./autoloader.php");


$id=$_POST['id'];

$t=$_POST['tabella'];



$u =new DB();


$u->delete($t, $id);	
	



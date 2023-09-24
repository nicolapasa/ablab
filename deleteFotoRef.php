<?php
session_start();
include("./autoloader.php");
$id=$_POST['id'];

$u =new DB();

//update
$u->updateP('referti_data', array('foto'=>''), array('id_tref'=>$id));	
<?php
header("content-type: application/json"); 
include("autoloader.php");
error_reporting(0);
$db= new DB();


$req=$_POST['name'];

if($req=="referti"){

   echo count($db->selectAll('refertimancanti_v', array('anno'=>ANNO_CORE)));


}
if($req=="cliniche"){

    echo count($db->selectAll('admin', array('livello'=>'struttura')));
 
 
 }
 if($req=="province"){

    echo count($db->sqlquery("select * from admin where livello='struttura' group by provincia"));
 
 
 }
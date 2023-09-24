<?php

include('autoloader.php');

$db=new DB();
$ut=new Utility();
//retrieve content post 
$id=$_POST['id'];


    $db->delete('referti_assegnati',$id);




header("Location: index.php?req=ref");
?>

<?php
session_start();
include("autoloader.php");

$db= new DB();


$idref=$_POST['idref'];
$anno=ANNO_CORE;

//FIXED: check a seconda dell'anno //

$sql="select * from refertimancanti_v where id_referto = '$idref' and SUBSTRING(dataArrivo,7,4)='$anno'  ";
/*echo $sql;
echo $conta;*/
$conta=count($db->sqlquery($sql));

if($conta>0){

	echo 's';
}
?>

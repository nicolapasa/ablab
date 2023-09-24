<?php 
include("./autoloader.php");

$db= new DB();



$sql="select *  from animale ";



$row=$db->sqlquery($sql);
$cont=0;
foreach($row as $r){
	
     if($db->getCampo('schede', 'completa', array('id'=>$r['id_scheda']))=='s'){
       $cont++;
    

        $db->update('animale', array('razza'=>$db->getCampo('razza', 'nome', array('id'=>$r['razza'])), 'organo'=>$db->getCampo('organo', 'nome', array('id'=>$r['organo']))), $r['id']);

     }


}




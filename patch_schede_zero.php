<?php 
include("./autoloader.php");

$db= new DB();



$sql="select *  from fatture_n  
where anno='2020' and totale=0 and completa='s'";



$row=$db->sqlquery($sql);

foreach($row as $r){
	
	
	 $id=$r['id'];
   echo  $num=$r['num'];
    echo '<br>';
    echo $tipo=$r['tipo'];
    echo '<br>';
    echo $p=$db->getCampo('esami_cat', 'prezzo', array('id'=>$tipo));
    echo '<br>';
    $db->update('schede', array('totale'=>$p), $id);

}

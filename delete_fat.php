<?php 
session_start();


include("autoloader.php");
$db= new Auth();


$id=$_GET['id'];


	$sql="select * from fatturate_v 
where  id='$id' ";
	

$row=$db->sqlquery($sql);


foreach($row as $r){
	$num=$r['num'];
	$anno=$r['anno'];
	
$esami=explode('-', $r['esami']);
}
//print_r($esami);

foreach($esami as $e){

  $id_scheda= $e;

   
   
	$db->update('schede', array('fatturato'=>'', 'num_fatt'=>0), $id_scheda);


}
$db->delete('fatture', $id);
$db->deleteP('num_fatt', array('num'=>$num, 'anno'=>$anno));

header("Location: index.php?req=fatture");


?>
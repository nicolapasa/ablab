<?php

$utenza=explode(',', $utenza);



$utenza=array_filter($utenza, 'strlen');
foreach($utenza as $ut) {
	if($ut=='tutti' or $ut=='struttura' or $ut=='service'){
		$utenza=$ut;
	}
	
}


switch ($utenza){

case 'service':
	$sql="select * from admin where id > $id_last and livello = 'service' order by id asc limit 100";
include('send_to.php');
	break;
case 'struttura':
	$sql="select * from admin where id > $id_last and livello = 'struttura' order by id asc limit 100";
	include('send_to.php');
break;
case 'tutti':
	$sql="select * from admin where id > $id_last  order by id asc limit 100";
	include('send_to.php');
	break;
default: //casi selezionati 
include('send_to_one.php');
break;
}

?>
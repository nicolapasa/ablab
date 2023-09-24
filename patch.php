<?php
include("./autoloader.php");

$db= new DB();

$id=1292;

$row=$db->selectAll('notifiche');

foreach($row as $r){


	if($r['utenti'] !=''){
	if ($r['contesto']!='referti')
	    {
				$utenti=$r['utenti'].','.$id;
				$db->update('notifiche', array('utenti'=>$utenti), $r['id']);
			}
	}

	//faccio update


}

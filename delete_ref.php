<?php
session_start();
include("./autoloader.php");


$id=$_POST['id'];





$u =new DB();

    $id_scheda=$_POST['id_scheda'];

	$u->delete('referti', $id);	
	$u->deleteP('referti_data', array('id_tref'=>$id ));	
	
	//cancello eventuali tabelle
	//prima le cerco 
	foreach($u->selectAll('tabelle', array('id_ref'=>$id)) as $t){
		
		$id_tab=$t['id'];
		$u->delete('tabelle', $id_tab );
			$u->deleteP('tabelle_data', array('id_tab'=>$id_tab ));
	}
	
	

	
//update arrivato in scheda
$u->update('schede', array('arrivato'=>'n'), $id_scheda);	


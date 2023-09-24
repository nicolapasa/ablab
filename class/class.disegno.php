<?php
/*
 * classe per gestire razze e specie
 * @author npasa
 */
define('__ROOT__', dirname(dirname(__FILE__)));
Class Disegno extends DB
{


   
	/**
	 * Metodo che cancella il disegno dal db e il file dalla cartella
	 *
	 */
public function delete($table, $id){
	
	if($table=='disegno'){
	$u=parent::selectAll('disegno', array('id_scheda'=>$id));
	foreach($u as $r){
		$id_disegno=$r['id'];
		
	}
    $path=__ROOT__."/upload/disegno".$id.".png";
	unlink($path);
	}
	$q = "delete from " . $table . " where id_scheda= '$id'";
	mysql_query($q);
	return true;
	
	
	
}

	
}	
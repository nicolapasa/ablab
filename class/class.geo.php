<?php
/*
 * class per autenticare l'utente
 * @author npasa
 */

Class Geo extends Auth
{


   
	/**
	 * Metodo che torna il nome della provincia o del comune in base all'id
	 *
	 */
	public function getProv($id)
	{
		
	
	$u=$this->db->selectAll('province', array('id'=>$id));

	
	foreach($u as $r){
	
	$nome=utf8_encode($r['nomeprovincia']);
	}

	 return $nome;
	}
/**
	 * Metodo che torna il nome della provincia o del comune in base all'id
	 *
	 */
	public function getCom($id)
	{
		
	
	
	$u=$this->db->selectAll('comuni', array('id'=>$id));
	
	foreach($u as $r){
	
	$nome=$r['nomecomune'];
	}

	 return $nome;
	}
	
}	
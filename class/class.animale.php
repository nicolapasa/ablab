<?php
/*
 * classe per gestire razze e specie
 * @author npasa
 */

Class Animale extends Auth
{


   
	/**
	 * Metodo che torna il nome della specie o della razza in base all'id
	 *
	 */
	public function getAnimal($id, $t)
	{
		
	$nome='';
	$u=$this->db->selectAll($t, array('id'=>$id));

	if (count($u)>0) {
	foreach($u as $r){
	
	$nome=utf8_encode($r['nome']);
	}
	}
	 return $nome;
	
	}

	
}	
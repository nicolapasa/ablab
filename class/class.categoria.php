<?php

/*
 * classe per db
 * 
 */
 
class Categoria extends DB {
 	

public $campo;
public $value;	
public $id_cat;	
private $db; //istanza del db

   
public function __construct($campo=null, $value=null){
	
	$this->db=new DB();
	$this->campo=$campo;
	$this->value=$value;
	$this->get();
}
	
public function get(){


$c=$this->db->selectAll('categorie', array($this->campo=>$this->value));

foreach($c as $row){


$this->id_cat= $row['id'];

}

}

}



<?php

/*
 * classe per db
 * 
 */
 
class Pagina extends DB {
 	

public $nome_pagina;
public $tipo_pagina;	
public $descr_pagina;	
public $contenuto_pagina;	
public $id;
private $db; //istanza del db

   
public function __construct($id=null){
	
	$this->db=new DB();
	$this->id=$id;
	$this->getPag();
}
	
public function getPag(){


$c=$this->db->selectAll('pagine', array('id'=>$this->id));

foreach($c as $row){


$this->nome_pagina= stripslashes($row['nome_pagina']);
$this->tipo_pagina= stripslashes($row['tipo_pagina']);
$this->descr_pagina= stripslashes($row['descr_pagina']);
$this->contenuto_pagina= stripslashes($row['contenuto_pagina']);
}

}

}



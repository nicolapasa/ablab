<?php
/*
 * class per autenticare l'utente
 * @author npasa
 */

Class Config extends DB
{


private $db; //istanza del db

   
public function __construct(){
	
	$this->db=new DB();
}
	
}	
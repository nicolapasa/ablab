<?php

$aut = new User();

if (! ($aut->login ())) {
	header ( "location: ./entra.php" );
}
$row = $aut->selectAll ( 'utenti', array (
		'username' => Utility::rc4decrypt ( $_COOKIE [ID_cookie] ) 
) );

foreach ( $row as $r ) {
	
	$id_loggata = $r ['id'];
    $ruolo= $aut->getCampo('ruoli', 'value', array('id'=>$r['ruolo_id']));
    $nome_loggato=$r['nome_account'];
 
}



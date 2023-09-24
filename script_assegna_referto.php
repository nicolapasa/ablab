<?php

include('autoloader.php');

$db=new DB();
$ut=new Utility();
//retrieve content post 
$array_id=unserialize(urldecode($_GET['id']));
$id_refertatore=$_GET['id_refertatore'];
//dati referto


$email=$db->getCampo('admin', 'email', array('id'=>$id_refertatore));


foreach($array_id as $id){
    $db->add('referti_assegnati', array( 'id_referto'=>$id, 'id_refertatore'=>$id_refertatore, 'data_assegnazione'=>CURRENT_DATE));


    $num=$db->getCampo('referti', 'id_referto', array('id'=>$id));
}



$nome_esame=$db->getCampo('esami_cat', 'abbr', array('id'=> $db->getCampo('schede', 'tipo', array('id'=>$db->getCampo('referti', 'id_scheda', array('id'=>$id))))));

$oggetto='Nuovi referti assegnati';

include('head_template.php');
$body=$p;

include('email_referto_assegnato_tmpl.php');
$body.=$e;
//notifica email 
Utility::inviaMail($email, $oggetto, $body);




header("Location: index.php?req=ref");
?>

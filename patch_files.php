<?php 
include("./autoloader.php");

$db= new DB();


//timeArr va in save_ref
$row=$db->selectAll('fatture', null, ' id asc ');

foreach($row as $r){
	$id=$r['id'];
   $id_cliente=$r['id_cliente'];
    $num_fatt=$r['num'];
    $anno=$r['anno'];
    $dest=$r['dest'];

    if($dest!='p'){
        //dati clinica
  
     
        $row2 = $db->selectAll('admin', array('id'=>$id_cliente));
    
    foreach($row2 as $r2){
               
        $nome = Utility::iniziali($r2['nome']);
        //$nome = Utility::maiu($r['nome']);
        $nome_cliente=$nome;

    }
}else{

	$row2 = $db->selectAll('proprietari', array('id'=>$id_cliente));

    foreach($row2 as $r2){
	
	$nome_proprietario = Utility::iniziali($r2['nome_proprietario']);
	$cognome_proprietario = Utility::iniziali($r2['cognome_proprietario']);
	
	$nome_cliente=$cognome_proprietario.' '.$nome_proprietario;

    }
}  

    $intesta=Utility::pulisciNome($nome_cliente);
    $fn=$anno.'-'.$num_fatt.'-'.$intesta.'.pdf';
    $fn2='';
	if($dest!='p'){

        $fn2=$anno.'-'.$num_fatt.'-'.$intesta.'-allegato.pdf';

    } 
    
    
    $db->update('fatture', array('nome_file'=>$fn, 'nome_alle'=>$fn2), $id);
	 
}
//echo phpinfo();



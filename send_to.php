<?php 
$row=$db->sqlquery($sql);

 $tot=count($row);

$cont=0;
$email='';
if($attached!=''){
	$pdf=__ROOT__.'/upload/'.$attached;
}
else{
	$pdf='';
}
foreach($row as $r){

$id=$r['id'];

if($sel_email=='' or $sel_email=='ref'){

 $email=array_unique(explode(';',$r['email']));
}
else{

	 $email=array_unique(explode(';',$r['email_fatt']));
}

//print_r($email);


foreach($email as $e){

//check se già inviata
if(!$db->checkAlreadySend($e, $id_m)){

	$db->add('error', array('time'=>time(),  'contesto'=>'newsletter',
	'tipo'=>$id_m,  'info'=>$e));


if($file!=''){
	
Utility::inviaMailH(trim($e), $oggetto, $body, $pdf);

}else{
Utility::inviaMail(trim($e), $oggetto, $body, $pdf);

}
$cont++;

}


}
$email='';


}
//devo vedere se l'ultima id corrisponde all'ultima id di admin
if($utenza=="service" or $utenza=="strutture") {

	$po=$db->selectAll('admin', array('livello'=>$utenza), ' id desc ', ' limit 1 ');
}
else
{
	$po=$db->selectAll('admin',null, ' id desc ', ' limit 1 ');
}
foreach($po as $p){

 $last=$p['id'];
}
$flag='n';

if($id==$last){

	$flag='s';
}


//faccio update di mailing list
$db->update('mailing_list', array('completa'=>$flag, 'id_last'=>$id), $id_m);
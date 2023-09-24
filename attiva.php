<?php
session_start();
include("./autoloader.php");
//classe autenticazione
$db= new DB();

$id = $_GET['id_admin'];
$req= $_GET['req'];

if($req== 'att'){
$db->update('admin', array('attivo'=>'v'), $id);


//recupero dati utente

$row = $db->selectAll('admin', array('id'=>$id));

foreach($row as $r){

	$nome = $r['nome'];
	$username = $r['username'];
	$password = $r['password'];

 $email=explode(';',$r['email']);
}
//mail attivazione
include('head_template.php');
	$body=$p;

	include('email_attiva_tmpl.php');
	$body.=$e;


	$body.='
</body>
</html>';

$oggetto ="Attivazione Gestionale Ablab";

foreach($email as $e){


Utility::inviaMail(trim($e), $oggetto, $body);



}



}

//notifica
$not=new Notifiche();

//trovo le due utenze admin

$row = $db->selectAll('admin', array('livello'=>'administrator'));
foreach($row as $r){

	$not->getLetta($r['id'], $id, 'admin');
}


Header("Location:  ./index.php?req=admin");
?>

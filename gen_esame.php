<?php
session_start();


include("autoloader.php");
$db= new DB();
$tot_comple=0;



$totale=0;
$tot_scheda=0;

if(isset($_SESSION['scheda'])) {

$id_scheda=$_SESSION['scheda'];

//stampo le schede
$row = $db->selectAll('schede', array('id'=>$id_scheda));
// print_r($row);
foreach($row as $r){
$id_scheda=$r['id'];
$num=$r['num'];
 $id_struttura = $r['id_struttura'];
$livello_str= $db->getCampo('admin', 'livello', array('id'=>$id_struttura));
$id_proprietario = $r['id_proprietario'];

$tipo =(int) $r['tipo'];
$id_cat=$db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo));
$urgente = $r['urgente'];
$margini = $r['margini'];

$punti= $r['punti'];
$note = $r['note'];
$allegati = $r['allegati'];
$data= Utility::getTime($r['time']).' - '.Utility::getTime2($r['time']);
$destinatario = $r['destinatario'];
//if($id_cat==10 or $id_cat==11) $destinatario ='clinica';
$anno=$r['anno'];
$seconda_refertazione=$r['seconda_refertazione'];
$qta=$r['qta'];
}
//qui si gestiscono i prezzi dinamici
//ooo

$p=0;
$tot_scheda=0;
//sui margini forse devo fare come prima cioè aggiungere 4 euro??? se sì basta modificare il prezzo nella tabella
/*if ($margini=='s' and $urgente  !='s' and $seconda_refertazione !='s'){

	$p=$db->getCampo('esami_cat', 'prezzo', array('id'=>90));
	if($destinatario=='proprietario') $p=$db->getCampo('esami_cat', 'prezzo_pro', array('id'=>90));

	//if($livello_str=='service') $p=$db->getCampo('esami_cat', 'prezzo_service', array('id'=>90));
	$tot_scheda=$tot_scheda+$p;
	if ($tipo== '11') $tot_scheda=$tot_scheda+$p;
	if ($tipo== '12') $tot_scheda=$tot_scheda+$p*2;

}*/

if($seconda_refertazione =='s' and $urgente  !='s') {
	$p=$db->getCampo('esami_cat', 'prezzo', array('id'=>91));
	if($destinatario=='proprietario') $p=$db->getCampo('esami_cat', 'prezzo_pro', array('id'=>91));
	//if($livello_str=='service') $p=$db->getCampo('esami_cat', 'prezzo_service', array('id'=>91));
	$tot_scheda=$tot_scheda+$p;
	if ($tipo== '11') $tot_scheda=$tot_scheda+$p;
	if ($tipo== '12') $tot_scheda=$tot_scheda+$p*2;

}

if($urgente=='s' ){

	$p=$db->getCampo('esami_cat', 'prezzo', array('id'=>89));
	if($destinatario=='proprietario') $p=$db->getCampo('esami_cat', 'prezzo_pro', array('id'=>89));
//	if($livello_str=='service') $p=$db->getCampo('esami_cat', 'prezzo_service', array('id'=>89));

	$tot_scheda=$tot_scheda+$p;
	if ($tipo== '11') $tot_scheda=$tot_scheda+$p;
	if ($tipo== '12') $tot_scheda=$tot_scheda+$p*2;

}





//se istologica devo tenere conto degli esami speciali
if($id_cat==2 and $urgente!='s' and $seconda_refertazione!='s'  ){

	$p=$db->getCampo('esami_cat', 'prezzo', array('id'=>$tipo));
	if($destinatario=='proprietario') $p=$db->getCampo('esami_cat', 'prezzo_pro', array('id'=>$tipo));
//	if($livello_str=='service') $p=$db->getCampo('esami_cat', 'prezzo_service', array('id'=>$tipo));

$tot_scheda=$tot_scheda+$p;
}
if($id_cat !=2){

	$p=$db->getCampo('esami_cat', 'prezzo', array('id'=>$tipo));
		if($destinatario=='proprietario') $p=$db->getCampo('esami_cat', 'prezzo_pro', array('id'=>$tipo));


	  if(($tipo>=39 and $tipo <=41) or ($id_cat==10) )
    {
      $p= $p*$qta;
      $db->update('schede', array('destinatario'=>'clinica'), $id_scheda);
    }
	$tot_scheda=$tot_scheda+$p;
}




$pr= new geo();
$row = $db->selectAll('admin', array('id'=>$id_struttura));

foreach($row as $r){

$nome = $r['nome'];
$indirizzo = $r['indirizzo'];
$email = $r['email'];
$piva = $r['piva'];
$attivo =$r['attivo'];
if(is_numeric($r['comune']))  $comune =  $pr->getCom($r['comune']);
if(is_numeric($r['provincia'])) $provincia = $pr->getProv($r['provincia']);
$foto= $r['foto'];
$referente= $r['referente'];
}

$row = $db->selectAll('proprietari', array('id'=>$id_proprietario));

if(count($row)>0)
foreach($row as $r){
    $medico_ref=$r['medico_ref'];
	$nome_proprietario = $r['nome_proprietario'];
	$cognome_proprietario = $r['cognome_proprietario'];
	$indirizzo_pro = $r['indirizzo_pro'];
	$email_pro = $r['email_pro'];
	$cod_pro = $r['cod_pro'];
	$tel_pro=$r['tel_pro'];

}

//qui devo mandare la mail con note e allegati (formato download)

$row = $db->selectAll('allegati', array('id_scheda'=>$id_scheda));


if(count($row) > 0){


	$testo_mail="La clinica $nome ha caricato degli allegati $note ";

	$oggetto =$id_scheda."-".$nome."-".$nome_proprietario." ".$cognome_proprietario;

$row2=$db->selectAll('mail_inviate', array('id_scheda'=>$id_scheda));
//interrogo la tabella mail inviate per vedere se esiste già invio
/*if(count($row2)==0){
  Utility::inviaMail(MAIL_ADMIN, $oggetto, $testo_mail);
  $db->add('mail_inviate', array('id_scheda'=>$id_scheda, 'testo'=>$oggetto));
}*/
  Utility::inviaMail(MAIL_ADMIN, $oggetto, $testo_mail);

}





//qui devo mandare la mail per alcuni esami
/*
 *
 *  copia vetrini, immunoistochimica  biologia molecolare e fornitura
 */

$id_animale=$db->getCampo('animale', 'id', array('id_scheda'=>$id_scheda));
$nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$id_cat));
if($id_cat==6 or $id_cat==7 or $id_cat==8  or $id_cat==10){



		$testo_mail="La clinica $nome ha inserito l'esame $nome_cat  ";

		$oggetto =$id_scheda."-".$nome."-".$nome_proprietario." ".$cognome_proprietario;

		Utility::inviaMail(MAIL_ADMIN, $oggetto, $testo_mail);


}


$totale=$tot_scheda;

//TODO:  impostare anno nuovo //

$sc= new Scheda();

$num_scheda = $sc->getIdNext();

$alle=(int) count($db->selectAll('allegati', array('id_scheda'=>$id_scheda)));

$db->update('schede', array('totale'=>$totale, 'ritenuta'=>0, 'id_animale'=>$id_animale, 'allegati'=>$alle,  'completa'=>'s', 'num'=>$num_scheda), $id_scheda);



$comp= $db->getCampo('schede', 'completa', array('id'=>$id_scheda));


if($id_scheda!=''  and $comp=='s' ) {
header("Location: index.php?req=print_esame");
}
else{
	header("Location: index.php?req=error");

}



}else{

		header("Location: index.php?req=error");

}

<?php
session_start();


include("autoloader.php");


$db= new DB();
$cl=new Clear();
$ut=new Utility();

$_POST=$cl->pulisci($_POST);

    $id=$_POST['id'];
	$urgente=$_POST['urgente'];
//	$margini=$_POST['margini'];
	$punti=$_POST['punti'];
	$seconda_refertazione=$_POST['seconda_refertazione'];
	$id_animale=$_POST['id_animale'];
    $qta=$_POST['qta'];
$tipo=$_POST['tipo'];

$id_cat=$db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo));
$totale=$ut->decimalComma($_POST['totale']);
$destinatario=$_POST['destinatario'];
//verifico cambio prezzo
$anamnesi= $_POST['anamnesi'];
$totale_old=$db->getCampo('schede', 'totale', array('id'=>$id));
if($totale== $totale_old){
include('gest_prezzo.php');
  $sconto_applicato='n';
}
else{
  $sconto_applicato='s';
}


$scheda=array( 'id_struttura'=>$_POST['id_struttura'], 'urgente'=>$urgente,
     'punti'=>$punti, 'seconda_refertazione'=>$seconda_refertazione,
		'tipo'=>$tipo, 'qta'=>$_POST['qta'], 'totale'=>$totale,
		 'destinatario'=>$_POST['destinatario'], 'id_proprietario'=>$_POST['id_proprietario'],
		 'num_referto'=>$_POST['num_referto'], 'sconto_applicato'=>$sconto_applicato
		 );

	$db->update('schede', $scheda, $id);

$db->update('proprietari', array('id_struttura'=>$_POST['id_struttura'], 'medico_ref'=>$_POST['medico_ref']), $_POST['id_proprietario']);

$ani=array( 'specie'=>$_POST['specie'], 'razza'=>$_POST['razza'],
		'organo'=>$_POST['organo'],	'sesso'=>$_POST['sesso'],	'integrita'=>$_POST['integrita'],

		'eta'=>$_POST['eta'], 'nome'=>$_POST['nome_animale'], 'anamnesi'=>$_POST['anamnesi'],
		'id_scheda'=>$id

);



	$db->update('animale', $ani, $id_animale);



$db->close();
header("Location: index.php?req=ric");
?>

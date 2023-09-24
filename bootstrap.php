<?php
session_start();
include("./autoloader.php");
ini_set("memory_limit","512M");


//classe autenticazione
$db= new DB();
$not=new Notifiche();


//version update del js cod
$versionUpdate=Utility::getDataxml();

//need password
if(isset($_COOKIE['superadmin'])) {
	$superadmin='s';
}
else {
		$superadmin='n';
}

$aut =new Auth();

if (!($aut->login()))
{
	header("location: ./entra.php");

}
$row=$db->selectAll('admin', array('username'=>$_COOKIE['user']));

foreach($row as $r){

	$id_loggata = $r['id'];
	$livello = $r['livello'];
	$nome_loggato = $r['nome'];
	$fotoprofilo=$r['foto'];
  //$superadmin=$r['superadmin'];
	$pec_admin=$r['pec'];
	$cod_admin=$r['cod'];
}
$_SESSION['loggato']=$id_loggata;
//sito offline
$off=$db->getCampo('opzioni', 'value', array('nome'=>'offline'));
if($livello!= 'administrator' and $off=='s') header("location: ./offline.php");
if($livello!= 'administrator')  $_SESSION['struttura']=$id_loggata;
//controllo profilo



if (isset ( $_GET ['req'] )) {
	$req = $_GET ['req'];
	$subreq = $_GET ['subreq'];
} else if (isset ( $_POST ['req'] )) {
	$req = $_POST ['req'];
	$subreq = $_POST ['subreq'];
}
if( $livello=='referti' and !isset ( $_GET ['req'] ))  $req='ref';


include('check_aut.php');


?>

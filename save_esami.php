<?php
session_start();


include("autoloader.php");


$db= new DB();
$cl=new Clear();
$lg=new Log();
$ut=new Utility();
$action = $_POST['action'];
unset($_POST['action']);

$_POST=$cl->pulisci($_POST);

//print_r($_POST);
switch ($action)  {



case "step1":
	$id_cat=(int) $db->getCampo('esami_cat', 'id_cat', array('id'=>$_POST['tipo']));
//print_r($_POST);
//verifico che tipo sia stato valorizzato
if($_POST['struttura']==''){
$_SESSION['step']=1;
	header("Location: index.php?req=fat&err=ko3");

}
else if(!isset($_POST['tipo'])) {
	$_SESSION['step']=1;
	header("Location: index.php?req=fat&err=ko");
}
else if(
(( $_POST['tipo']>38 and  $_POST['tipo'] <42 ) and $_POST['qta']=='')
   or ( $id_cat==10  and $_POST['qta3']=='' )
)  {
	$_POST['tipo'];
	$_SESSION['step']=1;
	header("Location: index.php?req=fat&err=ko2");

}else
{

 $qta=$_POST['qta'];

if($_POST['qta3']!='')  $qta=$_POST['qta3'];


if($id_cat==2) {
	$urgente=$_POST['urgente'];
	
	$seconda_refertazione=$_POST['seconda_refertazione'];
}

$_SESSION['tipo']=$_POST['tipo'];
//se scheda non gi� presente
$tipo=$_POST['tipo'];
if (!isset($_SESSION['scheda'])){

$_SESSION['struttura']=$_POST['struttura'];


$scheda=array( 'id_struttura'=>$_POST['struttura'], 'urgente'=>$urgente,
      'seconda_refertazione'=>$seconda_refertazione,
		'anno'=>ANNO_CORE, 'tipo'=>$tipo, 'time'=>CURRENT_DATE, 'qta'=>$qta);
$id_scheda=$db->add('schede', $scheda);

$_SESSION['scheda']=$id_scheda;

}
else{
$scheda=array('urgente'=>$urgente, 
      'seconda_refertazione'=>$seconda_refertazione,
		'anno'=>ANNO_CORE, 'tipo'=>$tipo, 'time'=>CURRENT_DATE, 'qta'=>$qta);
	$db->update('schede', $scheda, $_SESSION['scheda']);
}

//devo trovare prima la categoria



switch($id_cat){

	case 10:
	//forniture e processazione
header("Location: gen_esame.php");

	break;
	case 3:
	if($tipo>38 and  $tipo <42){

		$_SESSION['step']=5;
	header("Location: index.php?req=fat");
	}
	else{

		$_SESSION['step']=3;
	header("Location: index.php?req=fat");
	}


	break;

	default:

	$_SESSION['step']=3;
	header("Location: index.php?req=fat");

}


}

break;


case "step3":
//print_r($_POST);
//se copia vetrini va a gen esame gli altri passano allo step4


	 $_SESSION['dest']=$_POST['destinatario'];
/*	 if($_POST['selpro']!='s' ){

	$_SESSION['pro']=$_POST['proprietario'];

}
if($_POST['selpro']=='s' ){

	$_SESSION['pro']='';
}*/
	$scheda=array(
		 'destinatario'=>$_POST['destinatario']);
$db->update('schede', $scheda, $_SESSION['scheda']);

	$tipo=$db->getCampo('schede', 'tipo', array('id'=>$_SESSION['scheda']));

	$id_cat=(int) $db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo));

	if($id_cat==8) 	header("Location: gen_esame.php");

	$_SESSION['step']=4;

header("Location: index.php?req=fat");

break;
case "step4":


	$id_struttura=$_SESSION['struttura'];

	//problema sovrascrittura proprietari

//echo $id_struttura;
if($_SESSION['dest']=='proprietario') {
$prop=array('medico_ref'=>$_POST['medico_ref'],
'tel_pro'=>$_POST['tel_pro'],
 'nome_proprietario'=>$_POST['nome_proprietario'],
 'cognome_proprietario'=>$_POST['cognome_proprietario'],
		'indirizzo_pro'=>$_POST['indirizzo_pro'],
		'cod_pro'=>$_POST['cod_pro'],
		'email_pro'=>$_POST['email_pro'],
          'pec_pro'=>$_POST['pec_pro'],
		'provincia_pro'=>$_POST['provincia_pro'],
		'comune_pro'=>$_POST['comune_pro'],
		'cap_pro'=>$_POST['cap_pro'],
		 'id_struttura'=>$id_struttura

);
}
else {
	$prop=array('nome_proprietario'=>$_POST['nome_proprietario'], 'cognome_proprietario'=>$_POST['cognome_proprietario'],
		'medico_ref'=>$_POST['medico_ref'],
		 'id_struttura'=>$id_struttura

);

	}


include('custom.php');


$ani=array( 'specie'=>$_POST['specie'], 'razza'=>$_POST['razza'],
		'organo'=>$_POST['organo'],	'sesso'=>$_POST['sesso'],	'integrita'=>$_POST['integrita'],

		'anamnesi'=>$_POST['anamnesi'],'eta'=>$_POST['eta'], 'nome'=>$_POST['nome'],
		'id_scheda'=>$_SESSION['scheda']

);

//qui devo verificare i dati se già inseriti li  cancello e poi li aggiungo

    $id_proprietario=$db->getCampo('schede', 'id_proprietario',  array('id' =>  $_SESSION['scheda']));
		if($id_proprietario >0 ){
			$db->update('proprietari', $prop, $id_proprietario);
		}
 else{
$id_proprietario=$db->add('proprietari', $prop);
 }
   $id_animale=$db->getCampo('animale', 'id',  array('id_scheda' =>  $_SESSION['scheda']));

if($id_animale!=''){

$db->update('animale', $ani, $id_animale);
}else{
	
	$db->add('animale', $ani);
}

$scheda=array( 'id_proprietario'=>$id_proprietario,
		'anno'=>ANNO_CORE, 'time'=>CURRENT_DATE);

$db->update('schede', $scheda, $_SESSION['scheda']);
//gestione razze specie organi









	$_SESSION['step']=5;

header("Location: index.php?req=fat");

break;

case "step5":

//conto gli allegati

$conto_alle=count($db->selectAll('allegati', array('id_scheda'=>$_SESSION['scheda'])));
//devo vedere se ci sono esami che puntano allo step 3 o vanno subito al 4
$scheda=array( 'allegati'=>$conto_alle,'note'=>$_POST['note'],
		  'num_referto'=>$_POST['num_referto']);

$db->update('schede', $scheda, $_SESSION['scheda']);



header("Location: gen_esame.php");

	break;

}

$db->close();
?>

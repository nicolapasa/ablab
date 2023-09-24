 <?php
//ricevo il referto




 	$id=(int) $_GET['id']; //nota questo id non è l'ide referto ma l'id che identifica tutto il referto compreso id referto


    //devo vedere se è assegnato 
$assegnato='n';
if((int)$db->getCampo('referti_assegnati', 'id', array('id_referto'=>$id)) !=0){
	$assegnato='s';
     $id_admin_refertatore=$db->getCampo('referti_assegnati', 'id_refertatore', array('id_referto'=>$id));           
}


 		$step=$_GET['subreq'];
	if(!(isset($_GET['subreq']))) $step=1;

		$row = $db->selectAll('refertimancanti_v', array('id'=>$id));
 	$a=new Animale();
 	foreach($row as $r){


$stato=$db->getCampo('stato_referti', 'value', array('id'=>  $r['stato']));
 	$id_referto=$r['id_referto'];
$id_scheda=$r['id_scheda'];
$id_proprietario=$r['id_proprietario'];
$id_struttura=$r['id_struttura'];
$arrivato=$r['arrivato'];
$dataArrivo=$r['dataArrivo'];
$dataRefertazione=$r['dataRefertazione'];
$stato=$r['stato'];
$stato_d=$db->getCampo('stato_referti', 'value', array('id'=>$stato));

$struttura=$db->getCampo('admin', 'nome', array('id'=>$id_struttura));
$nome_proprietario=$db->getCampo('proprietari', 'nome_proprietario', array('id'=>$id_proprietario));
$cognome_proprietario=$db->getCampo('proprietari', 'cognome_proprietario', array('id'=>$id_proprietario));
$medico_ref=$db->getCampo('proprietari', 'medico_ref', array('id'=>$id_proprietario));
$num=$r['num'];
$tipo=$r['tipo'];
$nomeEsame= $db->getCampo('esami_cat', 'nome', array('id'=>$tipo));



$id_cat=$r['id_cat'];
$ref_prec=$r['ref_prec'];
$id_animale=(int)$r['id_animale'];
$tipoEsame=$db->getCampo('categorie', 'nome', array('id'=>$id_cat));
//vedere allegati
$seconda_refertazione=$r['seconda_refertazione'];
$urgente=$r['urgente'];
 	}

$row = $db->selectAll('animale', array('id_scheda'=>$id_scheda));

 foreach($row as $r){



$specie=$r['specie'];
$nomeSpecie=$a->getAnimal($specie, 'specie');
$razza=$r['razza'];
$nomeRazza=$r['razza'];
$organo=$r['organo'];
$nomeOrgano=$r['organo'];
$sesso=$r['sesso'];
$integrita=$r['integrita'];
$anamnesi=trim(ucfirst(strip_tags($r['anamnesi'])));
$anamnesi=$r['anamnesi'];
$eta=$r['eta'];
$nome_a=$r['nome'];

 }

  	$row = $db->selectAll('referti_data', array('id_tref'=>$id));

 	foreach($row as $r){


		$file=$r['foto'];
		$annotazioni=$r['annotazioni'];
		$descr_macro=Utility::pulisci($r['descr_macro']);
		$descr_micro=Utility::pulisci($r['descr_micro']);
		$diagn_morf=Utility::pulisci($r['diagn_morf']);
		$commento=Utility::pulisci($r['commento']);
		$commento2=Utility::pulisci($r['commento2']);
		$id_firma=$r['id_firma'];
		$id_firma2=$r['id_firma2'];
		if($livello=='administrator' and $assegnato=='n'){
			$nome_firma=$db->getCampo('firme', 'value', array('id'=>$id_firma));
			$id_firma2=$r['id_firma2'];
		$nome_firma2=$db->getCampo('firme', 'value', array('id'=>$id_firma2));
		}
	    else{
			$nome_firma=$id_firma;
			$nome_firma2=$id_firma2;
		}
		$esito_esame=Utility::pulisci($r['esito_esame']);
		$esito_esame2=Utility::pulisci($r['esito_esame2']);
		$nome_esame1=$r['nome_esame1'];
$nome_esame2=$r['nome_esame2'];
	}


switch($step){

case 1:
//parte comune
include('form_ref1.php');

break;

case 2:
//parte con testi
include('form_ref2.php');

break;

case 3:
//parte con tabelle
include('form_ref3.php');
break;
case 4:

//parte con stato e pubblicazione
include('form_ref4.php');
break;
}





 //devo vedere anche se ci sono allegati
?>

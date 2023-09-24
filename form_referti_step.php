 <?php 
//ricevo il referto 



 	$id=(int) $_GET['id']; //nota questo id non è l'ide referto ma l'id che identifica tutto il referto compreso id referto
 		$step=$_GET['subreq'];
	if(!(isset($_GET['subreq']))) $step=1;

		$row = $db->selectAll('referti_v', array('id'=>$id));
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
$nomeEsame=$r['nomeEsame'];
$struttura=$r['struttura'];
$nome_proprietario=$r['nome_proprietario'];
$cognome_proprietario=$r['cognome_proprietario'];
$num=$r['num'];
$tipo=$r['tipo'];
$specie=$r['specie'];
$nomeSpecie=$a->getAnimal($specie, 'specie');
$razza=$r['razza'];
$nomeRazza=$a->getAnimal($razza, 'razza');
$organo=$r['organo'];
$nomeOrgano=$a->getAnimal($organo, 'organo');
$sesso=$r['sesso'];
$integrita=$r['integrita'];
$anamnesi=$r['anamnesi'];
$eta=$r['eta'];
$nome_a=$r['nome_a'];
$id_cat=$r['id_cat'];
$ref_prec=$r['ref_prec'];

$tipoEsame=$db->getCampo('categorie', 'nome', array('id'=>$id_cat));
 	}
 
  	$row = $db->selectAll('referti_data', array('id_tref'=>$id));
 	
 	foreach($row as $r){
		
		
		$file=$r['foto'];
		$annotazioni=$r['annotazioni'];
		$descr_macro=$r['descr_macro'];
		$descr_micro=$r['descr_micro'];
		$diagn_morf=$r['diagn_morf'];
		$commento=$r['commento'];
		$id_firma=$r['id_firma'];
		$nome_firma=$db->getCampo('firme', 'value', array('id'=>$id_firma));
		$esito_esame=$r['esito_esame'];
	}
 
 $rowt=$db->selectAll('tabelle', array('id_ref'=>$id), ' tipo asc ');
 
 //print_r($rowt);
 foreach($rowt as $rt){
	 
	 if($rt['tipo']==1) {
	 $id_tab1=$rt['id'];
    $firma1=$rt['firma'];
	$tipo1=$rt['tipo'];
	 }
	  if($rt['tipo']==2) {
	 $id_tab2=$rt['id'];
    $firma2=$rt['firma'];
	$tipo2=$rt['tipo'];
	 }
	  if($rt['tipo']==3) {
	 $id_tab3=$rt['id'];
    $firma3=$rt['firma'];
$tipo3=$rt['tipo'];
	}
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

case 4:

//parte con stato e pubblicazione
include('form_ref4.php');

}	
	
	
 
 
 
 //devo vedere anche se ci sono allegati
?> 
	
	

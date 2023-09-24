<?php

$p=0;
$tot_scheda=0;


if($seconda_refertazione =='s' and $urge  !='s') {
	$p=$db->getCampo('esami_cat', 'prezzo', array('id'=>91));
	if($dest=='proprietario') $p=$db->getCampo('esami_cat', 'prezzo_pro', array('id'=>91));
	//if($livello_str=='service') $p=$db->getCampo('esami_cat', 'prezzo_service', array('id'=>91));
	$tot_scheda=$tot_scheda+$p;
	if ($tipo== '11') $tot_scheda=$tot_scheda+$p;
	if ($tipo== '12') $tot_scheda=$tot_scheda+$p*2;

}

if($urge=='s' ){
	
	$p=$db->getCampo('esami_cat', 'prezzo', array('id'=>89));
	if($dest=='proprietario') $p=$db->getCampo('esami_cat', 'prezzo_pro', array('id'=>89));
	//if($livello_str=='service') $p=$db->getCampo('esami_cat', 'prezzo_service', array('id'=>89));

	$tot_scheda=$tot_scheda+$p;
	if ($tipo== '11') $tot_scheda=$tot_scheda+$p;
	if ($tipo== '12') $tot_scheda=$tot_scheda+$p*2;
 
}





if($id_cat==2 and $urg!='s' and $seconda_refertazione!='s'  ){
//se istologica devo tenere conto degli esami speciali
//if(($tipo>=9 and $tipo <=17) and $urge!='s' and $seconda_refertazione!='s' and $marg!='s' ){
	
	$p=$db->getCampo('esami_cat', 'prezzo', array('id'=>$tipo));
	if($dest=='proprietario') $p=$db->getCampo('esami_cat', 'prezzo_pro', array('id'=>$tipo));
//	if($livello_str=='service') $p=$db->getCampo('esami_cat', 'prezzo_service', array('id'=>$tipo));
	
$tot_scheda=$tot_scheda+$p;
}
if($id_cat !=2){
	
	$p=$db->getCampo('esami_cat', 'prezzo', array('id'=>$tipo));
		if($dest=='proprietario') $p=$db->getCampo('esami_cat', 'prezzo_pro', array('id'=>$tipo));
//	if($livello_str=='service') $p=$db->getCampo('esami_cat', 'prezzo_service', array('id'=>$tipo));
	
if(($tipo>=39 and $tipo <=41) or ($id_cat==10) )
{
  $p= $p*$qta;
  $db->update('schede', array('destinatario'=>'clinica'), $id_scheda);
}
	$tot_scheda=$tot_scheda+$p;
}

$totale=$tot_scheda;
?>
<?php

$p=0;
$tot_scheda=0;
//sui margini forse devo fare come prima cioè aggiungere 4 euro??? se sì basta modificare il prezzo nella tabella


if($seconda_refertazione =='s' and $urgente  !='s') {
	$p=$db->getCampo('esami_cat', 'prezzo', array('id'=>91));
	if($destinatario=='proprietario') $p=$db->getCampo('esami_cat', 'prezzo_pro', array('id'=>91));
	//if($livello=='service') $p=$db->getCampo('esami_cat', 'prezzo_service', array('id'=>91));
	$tot_scheda=$tot_scheda+$p;
	if ($tipo== '11') $tot_scheda=$tot_scheda+$p;
	if ($tipo== '12') $tot_scheda=$tot_scheda+$p*2;

}

if($urgente=='s' ){
	
	$p=$db->getCampo('esami_cat', 'prezzo', array('id'=>89));
	if($destinatario=='proprietario') $p=$db->getCampo('esami_cat', 'prezzo_pro', array('id'=>89));
	//if($livello=='service') $p=$db->getCampo('esami_cat', 'prezzo_service', array('id'=>89));

	$tot_scheda=$tot_scheda+$p;
	if ($tipo== '11') $tot_scheda=$tot_scheda+$p;
	if ($tipo== '12') $tot_scheda=$tot_scheda+$p*2;
 
}





//se istologica devo tenere conto degli esami speciali
if($id_cat==2 and $urgente!='s' and $seconda_refertazione!='s'  ){
	
	$p=$db->getCampo('esami_cat', 'prezzo', array('id'=>$tipo));
	if($destinatario=='proprietario') $p=$db->getCampo('esami_cat', 'prezzo_pro', array('id'=>$tipo));
	//if($livello=='service') $p=$db->getCampo('esami_cat', 'prezzo_service', array('id'=>$tipo));
	
$tot_scheda=$tot_scheda+$p;
}
if($id_cat !=2){
	
	$p=$db->getCampo('esami_cat', 'prezzo', array('id'=>$tipo));
		if($destinatario=='proprietario') $p=$db->getCampo('esami_cat', 'prezzo_pro', array('id'=>$tipo));
	//if($livello=='service') $p=$db->getCampo('esami_cat', 'prezzo_service', array('id'=>$tipo));
	

	if(($tipo>=39 and $tipo <=41) or ($id_cat==10) )
    {
      $p= $p*$qta;
      $db->update('schede', array('destinatario'=>'clinica'), $id_scheda);
    }
	$tot_scheda=$tot_scheda+$p;
}

$totale=$tot_scheda;
?>
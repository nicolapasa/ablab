<?php
session_start();
include("autoloader.php");

$db= new DB();
$cl=new Clear();

$step=$_POST['step'];
$_POST=$cl->pulisci($_POST);

	$id=$_POST['id'];

switch($step){

	case 1:
	//salvo i dati comuni e poi reindirizzo a step2

	//salvo dati animale
	if($_POST['id_animale']>0){


	$db->update('animale', array('specie'=> $_POST['specie'],'razza'=> $_POST['razza'],
	'organo'=> $_POST['organo'],'sesso'=> $_POST['sesso'],'integrita'=> $_POST['integrita'],
	'eta'=> $_POST['eta'],'nome'=> $_POST['nome_a']), $_POST['id_animale']);
	}
	//data arrivo


	//devo stabilire se il tipo è cambiato e quindi in questo caso cambio anche il prezzo
	$tipo_old=$db->getCampo('refertimancanti_v', 'tipo', array('id'=>$id));
	$totale=$db->getCampo('refertimancanti_v', 'totale', array('id'=>$id));
	if($tipo_old != $_POST['tipo']){

	$tipo=$_POST['tipo'];
		//vedo margini

	$urgente=	$db->getCampo('refertimancanti_v', 'urgente', array('id'=>$id));
	$seconda_refertazione=	$db->getCampo('refertimancanti_v', 'seconda_refertazione', array('id'=>$id));
	//gestione cambio prezzo
		include('gest_prezzo.php');
	}
    $db->update('proprietari', array('medico_ref'=>$_POST['medico_ref']),$_POST['id_proprietario']);

	$db->update('referti', array('time'=>CURRENT_DATE, 'id_referto'=>$_POST['id_referto'], 'timeArr'=>Utility::getData($_POST['dataArrivo']), 'dataArrivo'=>$_POST['dataArrivo']), $id);

	$db->update('schede', array('urgente'=>$_POST['urgente'], 'seconda_refertazione'=>$_POST['seconda_refertazione'],
	'id_struttura'=>$_POST['id_struttura'],'id_proprietario'=>$_POST['id_proprietario'],
'tipo'=>$_POST['tipo'], 'totale'=>$totale
), $_POST['id_scheda']);

    $data_ref=array( 'annotazioni'=>$_POST['annotazioni']
  );
$db->updateP('referti_data', $data_ref, array('id_tref'=>$id));

   //trovo id_cat attuale
  $id_cat=$db->getCampo('esami_cat', 'id_cat', array('id'=>$_POST['tipo']));

    $sub=2;
    if($id_cat==3 or $id_cat==4) $sub=3;


	header("Location: index.php?req=referta&subreq=$sub&id=$id");

	break;
	case 2:
	$id_cat=$_POST['id_cat'];
	//salvo i testi e poi reindirizzo a step3
	///print_r($_POST);
	$data_ref=array(  'descr_macro'=>$_POST['descr_macro'], 'nome_esame1'=>$_POST['nome_esame1'],
'descr_micro'=>$_POST['descr_micro'], 'diagn_morf'=>$_POST['diagn_morf'],
'commento'=>$_POST['commento'], 'id_firma'=>$_POST['firma'], 'esito_esame'=>$_POST['esito_esame']
  );


	$up=new Upload('foto');
if(isset($_POST['foto']))	Utility::array_push_associative($data_ref, array('foto'=>$_POST['foto']));

	//per tabella referti e data referti faccio sempre update


$db->updateP('referti_data', $data_ref, array('id_tref'=>$id));
		$db->update('referti', array('time'=>CURRENT_DATE), $id);
	    $sub=4;
		if($id_cat==3 or $id_cat==4 or $id_cat==5 )	$sub=3;



		header("Location: index.php?req=referta&subreq=$sub&id=$id");
	break;
	case 3:
	
		$data_ref=array('id_firma2'=>$_POST['firma2'], 'commento2'=>$_POST['commento2'], 'nome_esame2'=>$_POST['nome_esame2'],
		'esito_esame2'=>$_POST['esito_esame2']
  );
  $up=new Upload('foto');
  if(isset($_POST['foto']))	Utility::array_push_associative($data_ref, array('foto'=>$_POST['foto']));
  
	$db->updateP('referti_data', $data_ref, array('id_tref'=>$id));
	$db->update('referti', array('time'=>CURRENT_DATE), $id);
	 $row=	$db->selectAll('tabelle', array('id_ref'=>$id));

	foreach($row as $r){

		$id_tab=$r['id'];
		$nomet='nome_'.$id_tab;

		$db->update('tabelle', array( 'nome'=>$_POST[$nomet]), $id_tab);

	$db->deleteP('tabelle_data', array('id_tab'=>$id_tab));

		$campo='campo_t_'.$id_tab;
		$sigla='sigla_t_'.$id_tab;
		foreach($_POST[$campo] as $k=>$v){


   $db->add('tabelle_data', array('id_tab'=>$id_tab, 'id_campo'=>$v, 'sigla'=>$_POST[$sigla][$k]));

          }

	}





		header("Location: index.php?req=referta&subreq=4&id=$id");
	break;
	case 4:
	  //salvo data refertazione e stato
	if($_POST['stato']==3 or $_POST['stato']==2 ) $time=CURRENT_DATE;
	if($_POST['dataRefertazione']=='') {
		$_POST['dataRefertazione']=Utility::getTime();
		$timeRef=CURRENT_DATE;
	}
	else{
		$timeRef=Utility::getData($_POST['dataRefertazione']);
	}
	$db->update('referti', array('time'=>$time,
	'stato'=>$_POST['stato'], 'timeRef'=>$timeRef, 'dataRefertazione'=>$_POST['dataRefertazione'] ), $id);



	if($_POST['stato']==3 or $_POST['stato']==2) {


		  $num_ref=$db->getCampo('refertimancanti_v', 'id_referto', array('id'=>$id));
	  $nome_esame= $db->getCampo('esami_cat', 'abbr',
	  array('id'=> $db->getCampo('refertimancanti_v', 'tipo', array('id'=>$id))));

	  $proprietario=$db->getCampo('proprietari', 'cognome_proprietario',
	  array('id'=> $db->getCampo('refertimancanti_v', 'id_proprietario', array('id'=>$id)))).' '.
	  $db->getCampo('proprietari', 'nome_proprietario',
	  array('id'=> $db->getCampo('refertimancanti_v', 'id_proprietario', array('id'=>$id))));
	$medico_ref=$db->getCampo('proprietari', 'medico_ref',
	array('id'=> $db->getCampo('refertimancanti_v', 'id_proprietario', array('id'=>$id))));
		//gestione mail da inviare agli utenti e notifica
		//la notifica è personale
			//testo da template
				$url=URL_GEN."print_referto.php?id=".$id;
	include('head_template.php');
	$body.=$p;
	$pre='';
	if($_POST['stato']==2)  $pre='preliminare';
	
	
	if($_POST['stato']==3) {

       //se sono referti assegnati devo marcarli come completati 

	   $row=	$db->selectAll('referti_assegnati', array('id_referto'=>$id));
       if (count($row)>0){
	   foreach($row as $r){
      
            $id_refertatore=$r['id_refertatore'];

			$id_assegnato=$r['id'];
        //update tabella assegnato
             $db->update('referti_assegnati', array('completato'=>'s', 'data_completato'=>CURRENT_DATE), $id_assegnato);
	   }

        

	}
     
}
	
	include('email_referti_tmpl.php');
	$body.=$e;


	$body.='
</body>
</html>';
//oggetto Referto RICHIESTA COPIA VETRINI – 47 – Ricci Gino
//SE PRESENTE METTO medico curante 
if ($medico_ref!='') {
	$oggetto='Referto '.$nome_esame.' - '.$num_ref.' - '.$medico_ref.' - '.$proprietario.'  ';
}
else{
	$oggetto='Referto '.$nome_esame.' - '.$num_ref.' - '.$proprietario.'  ';
}
	
	
			//Utility::inviaMail('nicola.pasa@gmail.com', $oggetto, $body);


		$mail_struttura=$db->getCampo('admin', 'email', array('id'=>$_POST['id_struttura']));

		$email=explode(';',$mail_struttura);



            foreach($email as $e){


		//Utility::inviaMail('nicola.pasa@gmail.com', $oggetto, $body);
		Utility::inviaMail(trim($e), $oggetto, $body);
			}

		//dovrò aggiornare notifica in base al cambiamento di stato
			$db->deleteP('notifiche', array('contesto'=>'referti','id_post'=>$id));
		$db->add('notifiche', array('contesto'=>'referti','id_post'=>$id, 'tipo'=>'referto',
		'id_struttura'=>$_POST['id_struttura']));

	}
		header("Location: index.php?req=ref");
	break;



}

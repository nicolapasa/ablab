<?php
session_start();
include("autoloader.php");

$db= new DB();
$cl=new Clear();



	$id=$_GET['id'];




		  $num_ref=$db->getCampo('refertimancanti_v', 'id_referto', array('id'=>$id));
	  $nome_esame= $db->getCampo('esami_cat', 'abbr',
	  array('id'=> $db->getCampo('refertimancanti_v', 'tipo', array('id'=>$id))));

	  $proprietario=$db->getCampo('proprietari', 'cognome_proprietario',
	  array('id'=> $db->getCampo('refertimancanti_v', 'id_proprietario', array('id'=>$id)))).' '.
	  $db->getCampo('proprietari', 'nome_proprietario',
	  array('id'=> $db->getCampo('refertimancanti_v', 'id_proprietario', array('id'=>$id))));
      $id_struttura=  $db->getCampo('refertimancanti_v', 'id_struttura', array('id'=>$id));
	  $medico_ref=$db->getCampo('proprietari', 'medico_ref',
	  array('id'=> $db->getCampo('refertimancanti_v', 'id_proprietario', array('id'=>$id))));
		//gestione mail da inviare agli utenti e notifica
		//la notifica è personale
			//testo da template
				$url=URL_GEN."print_referto.php?id=".$id;
	include('head_template.php');

	
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
		$oggetto='Referto '.$nome_esame.' - '.$num_ref.' - '.$proprietario.'  ';
			//Utility::inviaMail('nicola.pasa@gmail.com', $oggetto, $body);


		$mail_struttura=$db->getCampo('admin', 'email', array('id'=>$id_struttura));

		$email=explode(';',$mail_struttura);



            foreach($email as $e){


		//Utility::inviaMail('nicola.pasa@gmail.com', $oggetto, $body);
		Utility::inviaMail(trim($e), $oggetto, $body);
			}


            //segno come inviata
            if($id_oggetto=$db->getCampo( 'notifiche_invio_email','id', array('id_oggetto'=>$id))){
               $db->updateP('notifiche_invio_email', array( 'data'=>time()), $id_oggetto);
            }
            else{
                $db->add('notifiche_invio_email', array('tipo'=>'referto', 'id_oggetto'=>$id, 'data'=>time()));
            }
            
	
		header("Location: index.php?req=ref");






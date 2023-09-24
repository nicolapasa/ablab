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

	case 'template':
		$id=$_POST['id'];
		unset($_POST['id']);

	if($id>0){

				$db->update('template', $_POST, $id);
			}
			else{



			$id=	$db->add('template', $_POST);
			}

	header("Location: index.php?req=admin&subreq=template&id=$id");

	break;

	    case 'add_tab':

		$id=$_POST['id'];
		unset($_POST['id']);
		$_POST['id_ref']=$id;

			$db->add('tabelle', $_POST);

		header("Location: index.php?req=referta&subreq=3&id=$id");

		break;

		case "mod_tab":
		$id = $_POST['id'];
		$tab=$_POST['tab'];

			unset($_POST['id']);
		$value = $_POST['value'];

//print_r($_POST);

			switch ($tab){
		case 'province':
			$campo='nomeprovincia';
			$sigla=$_POST['sigla'];
			 $dati=array($campo=>$value, 'siglaprovincia'=>$sigla);
		break;
			case 'comuni':

				$campo='nomecomune';
				$id_prov=$_POST['id_prov'];
		    $dati=array($campo=>$value, 'idprovincia'=>$id_prov);
		break;
			case 'razza':
				$campo='nome';
				$id_specie=$_POST['id_specie'];
			$dati=array($campo=>$value, 'id_specie'=>$id_specie);

			break;
		case 'firme':

			$campo='value';
			$dati=array($campo=>$value);
		break;
		case 'tabelle_campi':
			$campo='value';
			$dati=array($campo=>$value);
		break;
		case 'tabella_legende':
			$campo='testo';
			$dati=array($campo=>$value, 'tipo'=>$_POST['tipo']);
		break;
		default:
			$campo='nome';
			$dati=array($campo=>$value);

	}



        	if($id>0){

				$db->update($tab, $dati, $id);
			}
			else{


				//creo record di lettura
			$id=	$db->add($tab, $dati);
			}

	header("Location: index.php?req=mod_tabelle&subreq=add_tab&tab=$tab&id=$id");

		break;

	case "offline":

		$value = $_POST['value'];


			$db->updateP('opzioni', array('value'=>$value), array('nome'=>$_POST['nome']));


/*@todo mandare una mail alle strutture per avvisare il ritorno online
 *
 */

		header("Location: index.php?req=admin&subreq=offline");

		break;
		case "mod_post":

			$id = $_POST['id'];

			$id_topic=$_POST['id_topic'];
			unset($_POST['id']);

			$_POST['data']=CURRENT_DATE;

			if($id>0){

				$db->update('for_post', $_POST, $id);
			}
			else{

				$id=$db->add('for_post', $_POST);

				include('send_news_post.php');
				//creo record di lettura
				$db->add('notifiche', array('id_post'=>$id, 'contesto'=>'forum', 'tipo'=>'post'));
				$db->add('for_letture', array('id_post'=>$id,  'tipo'=>'post'));
			}




	header("Location: index.php?req=forum&subreq=view_topic&id=$id_topic");
			break;
		case "mod_topic":

			$id = $_POST['id'];
		//print_r($_POST);

			unset($_POST['id']);
		    $_POST['data']=CURRENT_DATE;


			if($id>0){

				$post=array('id_admin'=>$_POST['id_admin'], 'data'=>$_POST['data'], 'titolo'=>$_POST['titolo'],
						'testo'=>$_POST['testo']
				);
				$db->update('for_topic', $post, $id);
			}
			else{

				$id=$db->add('for_topic', $_POST);

				//invio newsletter

	//include('send_news.php');
			$db->add('mailing_list', array('id_news'=>$id, 'completa'=>'n', 'id_last'=>0, 'tipo'=>'forum'));
				//creo record di lettura
				$db->add('notifiche', array('id_post'=>$id, 'contesto'=>'forum', 'tipo'=>'topic'));
				$db->add('for_letture', array('id_post'=>$id,  'tipo'=>'topic'));
			}






			header("Location: index.php?req=forum&subreq=view_topic&id=$id");

			break;
			case "mod_doc":

				$id = $_POST['id'];

				$up=new Upload('file');
				unset($_POST['id']);



				if($id>0){

						$db->update('doc', $_POST, $id);
				}
				else{

					$id=$db->add('doc', $_POST);
						//creo record di lettura
				$db->add('notifiche', array('contesto'=>'doc','id_post'=>$id, 'tipo'=>'documento'));
				}



				header("Location: index.php?req=doc");
				break;
				case "mod_esa":

					$id = $_POST['id'];




					$esa=array('prezzo'=>$ut->decimalComma($_POST['prezzo']),
					'prezzo_service'=>$ut->decimalComma($_POST['prezzo_s']),
					'prezzo_pro'=>$ut->decimalComma($_POST['prezzo_pro']),
					'nome'=>$_POST['nome'], 'abbr'=>$_POST['abbr'],
					'id_cat'=>$_POST['id_cat'], 'eliminato'=>$_POST['eliminato']);


					if($id>0){

						$db->update('esami_cat', $esa, $id);

					}
					else{

						$id=$db->add('esami_cat', $esa);

						//anche tabella ordine
						$ord_last=$db->getCampo('esami_ordinati_v', 'ord', array('id_cat'=>$_POST['id_cat']), ' ord desc', 'limit 1');
						$ord_last++;
            $db->add('esami_ordine', array('id_esame'=>$id, 'ord'=>$ord_last));
					}



					header("Location: index.php?req=mod_esami");
					break;
case "mod_utente":

$id = $_POST['id_admin'];

$up=new Upload('foto');
unset($_POST['id_admin']);


if($_POST['nazione']=='Italia'){
	$_POST['utenza_estera']='n';
} 
else{
	$_POST['utenza_estera']='s';
	$_POST['provincia']=$_POST['provincia_txt'];
	$_POST['comune']=$_POST['comune_txt'];
}
unset($_POST['comune_txt']);
unset($_POST['provincia_txt']);



if($id>0){

	if(strtolower($_POST['username'])==strtolower($db->getCampo('admin', 'username', array('id'=>$id)))) unset($_POST['username']);


	//notificare a mail amministrazione i campi modificati fare funzione che fa il check del campo old e mette un flag a true se modificato

$up=new Update();

$updated=$up->check_update("admin", $id);

//mail ad amministrazione con elenco campi modificati se updated non è vuoto 
if(count($updated)>0){


$nome=$_POST['nome'];

$e='';
foreach($updated as $update){

$e.=$update.'<br>';

}

include("email_profilo_mod_tmpl.php");


$oggetto ="una clinica ha modificato il profilo";




Utility::inviaMail(MAIL_ADMIN, $oggetto, $t_up);


}
$db->update('admin', $_POST, $id);
}
else{


	//nuova reg
	//invio mail con avvenuta registrazione
	$_POST['dataIscrizione']=time();
	$nome=$_POST['nome'];

 $email=explode(';',$_POST['email']);
$telefono= $_POST['telefono'];
$referente=$_POST['referente'];
$username=$_POST['username'];
$password=$_POST['password'];

$nazione =  $_POST['nazione'];
$testo_mail="
La struttura $nome

situata in $nazione

nel comune di $comune in provincia di $provincia 

si è registrata al sito ablab.eu/software ed è in attesa di attivazione


Referente $referente

Recapiti: Email";
foreach($email as $em){

	$testo_mail.="


 $e

";

}
$testo_mail.="
Telefono $telefono
";
$oggetto ="Nuova utenza registrata in Ablab";




Utility::inviaMail(MAIL_ADMIN, $oggetto, $testo_mail);
//mail all'utente



$oggetto ="Registrazione ad Ablab";


include('head_template.php');
	$body=$p;

	include('email_reg_tmpl.php');
	$body.=$e;


	$body.='
</body>
</html>';
foreach($email as $em){


Utility::inviaMail(trim($em), $oggetto, $body);



}

	$id=$db->add('admin', $_POST);
	//notifica
	$db->add('notifiche', array('id_post'=>$id, 'contesto'=>'admin',
	'tipo'=>'registrazione'));
}



header("Location: index.php?req=admin&subreq=modifica&id_admin=$id&res=ok");
break;




case "mod_news":

				$id = $_POST['id'];
			unset($_POST['id']);
			$_POST['data']=Utility::getTime();
				$up=new Upload('file');

				if($id>0){

						$db->update('news', $_POST, $id);
				}
				else{

					$id=$db->add('news', $_POST);
						//creo record di lettura
				$db->add('notifiche', array('contesto'=>'news','id_post'=>$id, 'tipo'=>'news'));
				}



				header("Location: index.php?req=news&subreq=mod_news&id=$id");
				break;


}

$db->close();
?>

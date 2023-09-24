<?php
include("autoloader.php");

$db= new Auth();

$p= new geo();
$f= new Filter();
if($_POST['nazione']=='Italia'){
	$_POST['utenza_estera']='n';
   
$comune =  $_POST['comune'];
$provincia = $_POST['provincia'];
} 
else{
	$_POST['utenza_estera']='s';
	
$comune =  $_POST['comune_txt'];
$provincia = $_POST['provincia_txt'];
}
unset($_POST['comune_txt']);
unset($_POST['provincia_txt']);

if($f->filter_empty($_POST) and $db->checkUser($_POST['username'])=='true'){

$up=new Upload('foto');
$_POST['nome']= mb_strtolower($_POST['nome'], 'UTF-8');
$_POST['nome_ref']= mb_strtolower($_POST['nome_ref'], 'UTF-8');
$_POST['mod_pag']='bonifico';

$_POST['dataIscrizione']=time();




$id=$db->add('admin', $_POST);


$nome=$_POST['nome'];

 $email=explode(';',$_POST['email']);
$telefono= $_POST['telefono'];
$referente=$_POST['referente'];
$username=$_POST['username'];
$password=$_POST['password'];

$nazione =  $_POST['nazione'];





//notifica
		$db->add('notifiche', array('id_post'=>$id, 'contesto'=>'admin',
		'tipo'=>'registrazione'));
//invio mail con avvenuta registrazione
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
//Utility::inviaMail('nicola.pasa@gmail.com', $oggetto, $body);
foreach($email as $em){


Utility::inviaMail(trim($em), $oggetto, $body);



}



header("Location: ./entra.php?reg=ok");

}
else{
//print_r($_POST);
header("Location: ./registrazione.php?reg=ko");
}

?>

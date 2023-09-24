<?php
include("autoloader.php");
$db= new DB();



$oggetto=$_POST['oggetto'];
$testo=$_POST['testo'];
$testo= str_replace('kcfinder/', URL_GEN.'kcfinder/', $testo);
$id=(int)$_POST['id'];
$livello=$_POST['livello'];
$utenti='';
foreach($livello as $liv){
	$utenti.=$liv.',';
}

$anteprima=$_POST['anteprima'];
$sel_email=$_POST['sel_email'];
$up=new Upload('file');
$up2=new Upload('attached');
$file=$_POST['file'];
$attached=$_POST['attached'];
$dati=	array('oggetto'=>$oggetto,'file'=>$file, 'attached'=>$attached, 'testo'=>$testo, 'data'=>time());

if($anteprima!='s'){
	
	if($file!=''){
		
		
		
	$body=DIR_UPLOAD.$file;	
	
		
	}
	else{
	
	include('head_template.php');
	$body=$p;
	include('email_newsletter_tmpl.php');
	$body.=$e;
	$body.='
</body>
</html>';
	}


if(!$db->checkRec('newsletter', array('id'=>$id)))
{
$id=$db->add('newsletter', $dati);
}
else{
$db->update('newsletter', $dati, $id);	
}


	if($file!='' ){
	Utility::inviaMailH(MAIL_ADMIN, $oggetto, $body, __ROOT__.'/upload/'.$attached);	

	}else{
Utility::inviaMail(MAIL_ADMIN, $oggetto, $body, __ROOT__.'/upload/'.$attached);

}
header("Location: ./index.php?req=admin&subreq=mail&respo=ante&id_n=$id");
}else{



if(!$db->checkRec('newsletter', array('id'=>$id))){
$id=$db->add('newsletter', $dati);
}
else{
$db->update('newsletter', $dati,  $id);	
}
//salvo nella tabella che evade le richieste del task
if(!$db->checkRec('mailing_list', array('id_news'=>$id,'tipo'=>'newsletter')))
$db->add('mailing_list', array('sel_email'=>$sel_email, 'utenza'=>$utenti, 'id_news'=>$id, 'completa'=>'n', 'id_last'=>0, 'tipo'=>'newsletter'));

header("Location: ./index.php?req=admin&subreq=mail&respo=ok");
}



?>
<?php
include("autoloader.php");
$db= new DB();



$oggetto=$_POST['oggetto'];
$testo=$_POST['testo'];
$testo= str_replace('kcfinder/', URL_GEN.'kcfinder/', $testo);
$id=(int)$_POST['id'];
$livello=$_POST['livello'];
$anteprima=$_POST['anteprima'];
$up=new Upload('file');

$file=$_POST['file'];

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
$id=$db->add('newsletter', array('oggetto'=>$oggetto,'file'=>$file, 'testo'=>$testo, 'data'=>time()));
}
else{
$db->update('newsletter', array('oggetto'=>$oggetto,'file'=>$file, 'testo'=>$testo, 'data'=>time()), $id);	
}


	if($file!=''){
	Utility::inviaMailH(MAIL_ADMIN, $oggetto, $body);	
	//Utility::inviaMailH('info@ablab.eu', $oggetto, $body);
	}else{
Utility::inviaMail(MAIL_ADMIN, $oggetto, $body);
//Utility::inviaMail('info@ablab.eu', $oggetto, $body);
}
header("Location: ./index.php?req=admin&subreq=mail&respo=ok&id_n=$id");
}else{



if(!$db->checkRec('newsletter', array('id'=>$id))){
$id=$db->add('newsletter', array('oggetto'=>$oggetto, 'file'=>$file,'testo'=>$testo, 'data'=>time()));
}
else{
$db->update('newsletter', array('oggetto'=>$oggetto,'file'=>$file, 'testo'=>$testo, 'data'=>time()), $id);	
}
//salvo nella tabella che evade le richieste del task
if(!$db->checkRec('mailing_list', array('id_news'=>$id,'tipo'=>'newsletter')))
$db->add('mailing_list', array('utenza'=>$livello, 'id_news'=>$id, 'completa'=>'n', 'id_last'=>0, 'tipo'=>'newsletter'));

header("Location: ./index.php?req=admin&subreq=mail&respo=ok");
}



?>
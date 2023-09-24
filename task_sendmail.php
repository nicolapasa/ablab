<?php
include("autoloader.php");


$db = new Auth();

$row= $db->selectAll('mailing_list', array('completa'=>'n'), ' id desc ', ' limit 1 ');
//tabella mailing_list spedisce di 200 in 200 ogni ora


if(count($row)>0){ //significa che devo evadere email

foreach($row as $r){

	$id_m=$r['id'];
	$id_post=$r['id_news'];
	$id_last=$r['id_last'];
	$tipo=$r['tipo'];
	$utenza=$r['utenza'];
	$sel_email=$r['sel_email'];
}

$row= $db->selectAll('for_topic', array('id'=>$id_post));
foreach($row as $r){


	$titolo=$r['titolo'];


}

$url=URL_GEN."index.php?req=forum&subreq=view_topic&id=".$id_post;

switch($tipo) {
	case 'forum'://forum

	include('head_template.php');
	$body=$p;

	include('email_forum_tmpl.php');
	$body.=$e;


	$body.='
</body>
</html>';

$oggetto='nuova discussione nel forum';

		include('send_all.php');
	break;
	case 'forum_r'://forum reply
	$oggetto='nuovo post nel forum';
$body="C'è una nuova risposta in una discussione aperta nel forum AbLab,
	può leggerla qui:<br>
	<br>

	Titolo:  <b>$titolo</b>		<br>

Indirizzo:  <br><a href='$url' >Leggi</a>
		<br><br>
		<b>AbLab</b>
		";

		include('send_all.php');
	break;

	case 'newsletter'://newsletter
	foreach($db->selectAll('newsletter', array('id'=>$id_post)) as $n){

		$oggetto=$n['oggetto'];
		$testo=$n['testo'];
		$file=$n['file'];
        $attached=$n['attached'];
		
	}

	if($file!=''){

	$body=DIR_UPLOAD.$file;

	}else{
	//testo da template
	include('head_template.php');
	$body=$p;
	$body.=$testo;

	$body.='<p>
Cordiali saluti,<br><br>
AbLab <br>
Laboratorio di analisi veterinarie <br>
Tel. 0187 626259<br> E-mail: info@ablab.eu
</p>
</body>
</html>';
	}
	include('send_all.php');
	break;



}

}
else{

	foreach($db->selectAll('backup', null,  ' id desc ', ' limit 1 ')    as $r){

	 $data=$r['data'];

    }

if( Utility::datediff("G",  $data, Utility::getTime())>30)
{
	$db_back = new Backup();

// To backup DB
	$db_back ->backup ();
$filename='backup_'.time();



$db->add('backup', array('nomefile'=>$filename, 'data'=>Utility::getTime(), 'dataint'=>time()));
}

}

<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-cache");

include("autoloader.php");
require_once('./TCPDF-master/tcpdf.php');
// definisco una variabile con il percorso alla cartella
// in cui sono archiviati i file
$dir = './fatture/';
$id=$_GET['id'];
$db=new DB();
$num=$db->getCampo('fatture', 'num', array('id'=>$id));
$anno=$db->getCampo('fatture', 'anno', array('id'=>$id));

 $nominativo=Utility::pulisciNome(Utility::iniziali($db->getCampo('fatturate2_v', 'nominativo', array('id'=>$id))));
// Recupero il nome del file dalla querystring
// e lo accodo al percorso della cartella del download
$fn=$db->getCampo('fatture', 'nome_file', array('id'=>$id));
//lo prendo dalla tabella
//$fn=$anno.'-'.$num.'-'.$nominativo.'.pdf';








 $file_name = $dir . $fn;

if(is_file($file_name)) {


	if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off');	}


	switch(strtolower(substr(strrchr($file_name, '.'), 1))) {
		case 'pdf': $mime = 'application/pdf'; break;
		case 'zip': $mime = 'application/zip'; break;
		case 'jpeg':
		case 'jpg': $mime = 'image/jpg'; break;
		default: $mime = 'application/force-download';
	}
	header('Pragma: public'); 	// required
	header('Expires: 0');		// no cache
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($file_name)).' GMT');
	header('Cache-Control: private',false);
	header('Content-Type: '.$mime);
	header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: '.filesize($file_name));
	header('Connection: close');
	readfile($file_name);
	exit();

}
/*
else{

	include('download_fat.php');
	$file_name = $dir . $fn;
		if(ini_get('zlib.output_compression')) { ini_set('zlib.output_compression', 'Off');	}


	switch(strtolower(substr(strrchr($file_name, '.'), 1))) {
		case 'pdf': $mime = 'application/pdf'; break;
		case 'zip': $mime = 'application/zip'; break;
		case 'jpeg':
		case 'jpg': $mime = 'image/jpg'; break;
		default: $mime = 'application/force-download';
	}
	header('Pragma: public'); 	// required
	header('Expires: 0');		// no cache
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($file_name)).' GMT');
	header('Cache-Control: private',false);
	header('Content-Type: '.$mime);
	header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: '.filesize($file_name));	// provide file size
	header('Connection: close');
	readfile($file_name);		// push it out
	exit();

}
*/
?>

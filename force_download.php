<?php
include("autoloader.php");

// definisco una variabile con il percorso alla cartella
// in cui sono archiviati i file

$id=$_GET['id'];
$db=new DB();



//flaggo tabella invio

$flag_xml=$db->getCampo('invio', 'xml', array('id_fat'=>$id));
if($flag_xml!='' and ($flag_xml==0 or $flag_xml==1))
{

 $id_invio=$db->getCampo('invio', 'id', array('id_fat'=>$id));
 $db->update('invio', array('xml' =>1  ), $id_invio);

}
else{

   $db->add('invio', array('xml' =>1, 'id_fat'=>$id  ));
}



$numFatt=$db->getCampo('fatture', 'num', array('id'=>$id));
$anno=$db->getCampo('fatture', 'anno', array('id'=>$id));
$dir = './XML/'.$anno.'/';
// Recupero il nome del file dalla querystring
// e lo accodo al percorso della cartella del download
$num_file=Utility::mettiZero(5, $numFatt);
 $fn = 'SM03473_'.$num_file.'.xml';


 $file_name = $dir . $fn;

if(is_file($file_name)) {

	// get the file mime type using the file extension
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
	header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime($file_name)).' GMT');
	header('Cache-Control: private',false);
	header('Content-Type: '.$mime);
	header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
	header('Content-Transfer-Encoding: binary');
	header('Content-Length: '.filesize($file_name));	// provide file size
	header('Connection: close');
	readfile($file_name);		// push it out
	exit();

}

?>

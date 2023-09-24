<?php
session_start();
include("autoloader.php");

$db= new DB();


 $dest=$_POST['dest'];


 $id=$_POST['id'];



if($dest=='c'){


//ricalcolo sconto 
 $totale=$_POST['imponibile'];

if($_POST['spe_tra']!='' and $_POST['spe_tra']>0) $totale=$totale+$_POST['spe_tra'];
if((int)$_POST['sconto']>0){
	$totale=$totale-($totale/100*$_POST['sconto']);
}

//iva 22

$iva=round($totale/100*22,2);
$importo=round($totale+$iva,2);
$spe_tra=$_POST['spe_tra'];	
$sconto=$_POST['sconto'];
$imponibile=$_POST['imponibile'];
//iva 22
}
else{
	
	 $totale=$_POST['imponibile'];
	if($_POST['spe_tra']!='' and $_POST['spe_tra']>0) $totale=$totale+$_POST['spe_tra'];	
		if((int)$_POST['sconto']>0){
			$totale=$totale-($totale/100*$_POST['sconto']);
		}
$iva=round($totale/100*22,2);
$importo=round($totale+$iva,2);
$spe_tra=$_POST['spe_tra'];	
$sconto=$_POST['sconto'];
$imponibile=$_POST['imponibile'];
}





$db->update('fatture_temp', array('iva'=>$iva, 'spe_tra'=>$spe_tra,
 'sconto'=>$sconto,  'importo'=>$importo,  'imponibile'=>$imponibile), $id);

?>
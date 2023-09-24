<?php
session_start();
include("autoloader.php");

$db= new Auth();
$cl=new Clear();


$_POST=$cl->pulisci($_POST);



$id_temp=$_POST['id_temp'];
	unset($_POST['id_temp']);
		unset($_POST['cab']);
	unset($_POST['abi']);
$_POST['data']=Utility::getData($_POST['data']);

//update anche del proprietario
$row=$db->selectAll('fatture_temp', array('id'=>$id_temp));

foreach($row as $r){

$esami=$r['esami'];



$id_cliente= $r['id_cliente'];



$anno=$r['anno'];


}
$_POST['anno']=$anno;
$_POST['esami']=$esami;
$_POST['num']=$db->getNumFatt();
$_POST['id_cliente']=$id_cliente;

$utenza_estera=$db->getCampo('admin', 'utenza_estera', array('id'=>$id_cliente));	

$esami=explode('-', $esami);
foreach($esami as $e){

 $id_scheda= $e;



	$db->update('schede', array('fatturato'=>'s', 'num_fatt'=>$_POST['num']), $id_scheda);


}
//print_r($_POST);

//update se dati abi e cab cambiano in struttura
if($_POST['dest']!='p'){

	if ($utenza_estera=='n'){
//ricalcolo sconto
 $totale=$_POST['imponibile'];
if($_POST['spe_tra']!='' and $_POST['spe_tra']>0) $totale=$totale+$_POST['spe_tra'];
if((int)$_POST['sconto']>0){
	$totale=$totale-($totale/100*$_POST['sconto']);
}


$_POST['iva']=round($totale/100*22,2);
$_POST['importo']=round($totale+$_POST['iva'],2);
	}
	else{
		$totale=$_POST['imponibile'];
		if($_POST['spe_tra']!='' and $_POST['spe_tra']>0) $totale=$totale+$_POST['spe_tra'];
		if((int)$_POST['sconto']>0){
			$totale=$totale-($totale/100*$_POST['sconto']);
		}
		
		
		$_POST['iva']=round($totale/100*0,2);
		$_POST['importo']=round($totale,2);

	}



}
else{


		$totale=$_POST['imponibile'];
 	if($_POST['spe_tra']!='' and $_POST['spe_tra']>0) $totale=$totale+$_POST['spe_tra'];
 		if((int)$_POST['sconto']>0){
 			$totale=$totale-($totale/100*$_POST['sconto']);
 		}

if($totale != $_POST['imponibile'])		{
$_POST['iva']=round($totale/100*22,2);
 	$_POST['importo']=round($totale+$_POST['iva'],2);
}
else{

$_POST['iva']=	$_POST['importo']-	$_POST['imponibile'];
}

//print_r($_POST);


}


$id=$db->add('fatture', $_POST);

include('download_fat.php');
if($dest!='p'){
	include('download_alle.php');
}


 if($id_cliente==90 and $dest!='p')
 {
header("Location: index.php?req=fatturazione");

 }else{


header("Location: print_xml.php?id=$id");
}
?>

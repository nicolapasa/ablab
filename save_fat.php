<?php
session_start();
include("autoloader.php");

$db= new DB();
$cl=new Clear();


$_POST=$cl->pulisci($_POST);

//print_r($_POST);
if(!isset($_POST['pagata'])) $_POST['pagata']='n';
$id=$_POST['id'];
$id_cliente=$db->getCampo('fatture', 'id_cliente', array('id'=>$id));

$utenza_estera=$db->getCampo('admin', 'utenza_estera', array('id'=>$id_cliente));	
	unset($_POST['id']);
		unset($_POST['cab']);
	unset($_POST['abi']);
$_POST['data']=Utility::getData($_POST['data']);
	
//update anche del proprietario
//gestire utenza estera
//update se dati abi e cab cambiano in struttura
if($_POST['dest']!='p'){

	if ($utenza_estera=='n'){
//ricalcolo sconto 
 $totale=$_POST['imponibile'];
if($_POST['spe_tra']!='' and $_POST['spe_tra']>0) $totale=$totale+$_POST['spe_tra'];
if((int)$_POST['sconto']>0){
	$totale=$totale-($totale/100*$_POST['sconto']);
}

//iva 22

$_POST['iva']=round($totale/100*22,2);
$_POST['importo']=round($totale+$_POST['iva'],2);
	}
	else{
//ricalcolo sconto 
$totale=$_POST['imponibile'];
if($_POST['spe_tra']!='' and $_POST['spe_tra']>0) $totale=$totale+$_POST['spe_tra'];
if((int)$_POST['sconto']>0){
	$totale=$totale-($totale/100*$_POST['sconto']);
}

//iva 22

$_POST['iva']=0;
$_POST['importo']=round($totale,2);

	}
//iva 22
}
else{
	
	 $totale=$_POST['imponibile'];
	if($_POST['spe_tra']!='' and $_POST['spe_tra']>0) $totale=$totale+$_POST['spe_tra'];	
		if((int)$_POST['sconto']>0){
			$totale=$totale-($totale/100*$_POST['sconto']);
		}
	$_POST['iva']=round(($totale/100*22),2);
$_POST['importo']=round($totale+$_POST['iva'],2);
	
}


$db->update('fatture', $_POST, $id);

$id_cliente=$db->getCampo('fatture', 'id_cliente', array('id'=>$id));


//genero file pdf fattura 
include('download_fat.php');
if($_POST['dest']!='p'){
include('download_alle.php');
}

 if($id_cliente==90 and $_POST['dest']=='c')
 {
header("Location: index.php?req=fatture");

 }else{	


header("Location: print_xml.php?id=$id"); 
 }
?>
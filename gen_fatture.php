<?php
session_start();


include("autoloader.php");
$db= new Auth();

$dest=$_GET['dest'];
$id=$_GET['id_dest'];
$utenza_estera=$db->getCampo('admin', 'utenza_estera', array('id'=>$id));	
//$data_ini=$_GET['data_ini'];
$data_fine=$_GET['data_fine'];
$data_fatt=$_GET['data_fatt'];
//le date data ini deve partire dalle 000 del giorno data fine dalle 23 del giorno

//TODO:  impostare anno nuovo in modo dinamico //
 $range ="  timeArr<= '$data_fine' ";
 $row2=$db->selectAll('fatture', array('anno'=>ANNO_CORE), '  id desc ',' limit 1 ');
if(count($row2)>0){
foreach($row2 as $r2){

$num_fatt = $r2['num']+1;
}
}
else{

	$num_fatt=1;
}

if($dest!='proprietario'){
	$sql="select * from fatturazione_v
where  (destinatario !='proprietario' )  and  id_struttura='$id' and
completa='s' and (".$range.")  ";

}
else if($dest=='proprietario'){
	$sql="select * from fatturazione_v
where  destinatario='proprietario'  and  id_proprietario='$id' and (".$range.") ";

}



$row=$db->sqlquery($sql);
$totale=0;
$schede='';
$num_esami=count($row);


foreach($row as $r){

   $id_scheda= $r['id'];
   $totale = $totale+$r['totale'];
   $schede.=$id_scheda.'-';




}

if($dest!='proprietario'){

//@todo gestire utenza estera 
if ($utenza_estera=='n'){
//iva 22
$sconto=0;
$imponibile=$totale;
if($totale>=500 and $totale<=1000) $sconto=10;
if($totale>1000) $sconto=20;
if($sconto>0) $totale=$imponibile-(round($imponibile/100*$sconto,2));

//iva 22
$iva=round($totale/100*22, 2);
$totale=round($totale+$iva, 2);
/*arrotondamento
Il valore €123,432 si arrotonda a 123,43.
Il valore €321,238 si arrotonda a 321,24
Il valore €569,355 si arrotonda a 569,36
*/
$imponibile=round($imponibile, 2);
}
else{
	$sconto=0;
$imponibile=$totale;
if($totale>=500 and $totale<=1000) $sconto=10;
if($totale>1000) $sconto=20;
if($sconto>0) $totale=$imponibile-(round($imponibile/100*$sconto,2));

//iva 22
$iva=round($totale/100*0, 2);
$totale=round($totale+0, 2);
/*arrotondamento
Il valore €123,432 si arrotonda a 123,43.
Il valore €321,238 si arrotonda a 321,24
Il valore €569,355 si arrotonda a 569,36
*/
$imponibile=round($imponibile, 2);
   
}
}
else{
	//proprietario è già ivato
	//dal totale tolgo il 22% per trovare imponibile
	//(100*importo)/122
	$imponibile=round(((100*$totale)/122),2);
	if($totale>=500 and $totale<=1000) $sconto=10;
if($totale>1000) $sconto=20;
if($sconto>0) $totale=$imponibile-(round($imponibile/100*$sconto, 2));
	$iva=round(($totale-$imponibile),2);
}
/*
echo $totale;
echo $iva;
echo $imponibile;*/
//totale devo applicare sconto
$id_fatt=$db->add( 'fatture_temp', array('iva'=>$iva, 'anno'=>ANNO_CORE, 'sconto'=>$sconto, 'num'=>$num_fatt, 'esami'=>$schede, 'data'=>$data_fatt,   'id_cliente'=>$id,
 'dest'=>$dest, 'importo'=>$totale, 'pagata'=>'n', 'imponibile'=>$imponibile));


header("Location: index.php?req=pre_fat&id=$id_fatt");


?>

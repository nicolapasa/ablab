<?php 
include("./autoloader.php");

$db= new DB();

$sql="select * from schede  where  anno = '2020' and completa='s' and tipo>9 and tipo<13";
$row=$db->sqlquery($sql);
//echo count($row);
foreach($row as $r)
{
	$id=$r['id'];
	echo $tipo=$r['tipo'];
	echo '<br>';
	$dest=$r['destinatario'];
	echo $dest;
	echo '<br>';

    $totale=31;
	if($tipo==11)
	{

		 $totale=$totale*2;
	
	}
	else if($tipo==12){
		$totale=$totale*3;
		

	}
	if($r['urgente']=='s') $totale=50;
	if($dest=='proprietario') $totale=$totale*2;
	
		echo '<br>';
		echo $totale;
	
	 
	 $db->update('schede', array('totale'=>$totale), $id);
	 
}
//echo phpinfo();



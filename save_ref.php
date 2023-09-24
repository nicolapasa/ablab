<?php
session_start();
include("autoloader.php");

$db= new DB();
$cl=new Clear();
//TODO: controllo se referto già inserito



$_POST=$cl->pulisci($_POST);


$categoria=$_POST['id_cat'];
$tipo=$_POST['tipo'];

//print_r($_POST);

if($_POST['data']=='') $_POST['data']=Utility::getTime();
//se id scheda esiste in referti allora gestire update
if(count($db->selectAll('referti', array('id_scheda'=>$_POST['id_scheda'])))>0){



	$idref=$db->getCampo('referti', 'id', array('id_scheda'=>$_POST['id_scheda']));
	//update
	$id_stato=1;
if(($categoria==10) or $tipo==88){

	$id_stato=3;
	$ref=array('arrivato'=>'s',  'stato'=>$id_stato,  'id_scheda'=>$_POST['id_scheda'],
'id_referto'=>$_POST['idref'], 'dataArrivo'=>$_POST['data'],
'timeRef'=>Utility::getData($_POST['data']), 'dataRefertazione'=>$_POST['data'],
 'timeArr'=>Utility::getData($_POST['data']));

}
else{
	$ref=array('arrivato'=>'s',  'stato'=>$id_stato,  'id_scheda'=>$_POST['id_scheda'],
'id_referto'=>$_POST['idref'], 'dataArrivo'=>$_POST['data'], 'timeArr'=>Utility::getData($_POST['data']));


}

$db->update('schede', array('arrivato'=>'s'
), $_POST['id_scheda']);

$db->update('referti', $ref, $idref);

echo $idref;

}else{
	//nuovo
//per i dati relativi alle schede faccio update in schede
$idref=$_POST['idref'];
$anno=ANNO_CORE;
//check se esiste già il referto
$sql="select * from referti_v where id_referto = '$idref' and SUBSTRING(dataArrivo,7,4)='$anno'  ";



if(count($db->sqlquery($sql))>0){
    echo 'referto n. '.$idref. ' non inserito perché già esistente ';

}
else{



	$id_stato=1;

	if(($categoria==10) or $tipo==88){

			$id_stato=3;
			$ref=array('arrivato'=>'s',  'stato'=>$id_stato,  'id_scheda'=>$_POST['id_scheda'],
		'id_referto'=>$_POST['idref'], 'dataArrivo'=>$_POST['data'],
		'timeRef'=>Utility::getData($_POST['data']), 'dataRefertazione'=>$_POST['data'],
		'timeArr'=>Utility::getData($_POST['data']));

	}
	else{
			$ref=array('arrivato'=>'s',  'stato'=>$id_stato,  'id_scheda'=>$_POST['id_scheda'],
		'id_referto'=>$_POST['idref'], 'dataArrivo'=>$_POST['data'], 'timeArr'=>Utility::getData($_POST['data']));


	}

	$db->update('schede', array('arrivato'=>'s'
), $_POST['id_scheda']);

		echo $id=$db->add('referti', $ref);

		$db->add('referti_data', array('id_tref'=>$id));

	}
}
?>

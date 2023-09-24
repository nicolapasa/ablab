<?php
session_start();
include("autoloader.php");


$db= new DB();
$action = $_GET['action'];
$id=$_SESSION['scheda'];

$tipo=$db->getCampo('schede', 'tipo', array('id'=>$id));

$id_cat=(int) $db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo));




switch ($action)  {
	

		
	case 'step3':

			$_SESSION['step']=1;
	
	break;

	case 'step4':
		$_SESSION['step']=3;
	break;	
	
		case 'step5':
		$_SESSION['step']=4;
	break;	
	
}

header("Location: index.php?req=fat");
<?php 
session_start();

include("autoloader.php");

//print_r($_POST);
$db= new DB();

$id_scheda=$_SESSION['scheda'];


foreach ($_FILES['allegati']['name'] as $k=>$f){
			
			
				if($f!=''){
					$up=new Upload_multi('allegati', $k);
					if($_POST['allegati']!='')	$db->add('allegati', array('id_scheda'=>$id_scheda, 'file'=>$_POST['allegati']));
						
				}
			}
			
	 echo strtoupper("file caricati con successo");		
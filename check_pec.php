<?
include("autoloader.php");
$u= new Auth();

//$mail=$_GET['email'];
//$username='admin';
foreach($_GET as $r){
	
	$mail=$r;
}

if ($u->checkCampo('admin', $mail, 'pec')=='true'){
	
	
	
	echo 'true';
}
else{
	
	echo 'false';
}



?>
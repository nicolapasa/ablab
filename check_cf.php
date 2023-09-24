<?


$cf=$_GET['cf'];


if (strlen($cf) == 16 ){
	
	
	
	echo 'true';
}
else if (is_numeric($cf)){
	echo 'true';
}else{
	
	echo 'false';
}


?>
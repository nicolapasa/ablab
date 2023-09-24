<?php

if (!isset($_SESSION['step']))	{
	$step=1; 
}
else{ 
	$step=$_SESSION['step'];
}





?>

<?php  switch ($step){
case 1:	
	include('sezione1.php');
	break;

case 3: //scelta fatturazione
	include('sezione3.php');
break;
case 4: //dati proprietario e anamnesi

	include('sezione4.php');
break;
case 5: //allegati e numero referto

	include('sezione5.php');
break;

}
?>




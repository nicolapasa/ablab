<?php

if (!isset($_SESSION['step']))	{
	$step=0; 
}
else{ 
	$step=$_SESSION['step'];
}





?>

<?php  switch ($step){
case 0:	
	include('sezione0.php');
	break;
case 1:
	include('sezione1.php');	
break;
case 2:
	include('sezione2.php');
break;
case 3: //sezione 3
 $tipo=$_SESSION['tipo'];

 //$tipo=substr($tipo, 0, 1);
 //stabilire la categoria 
 $cat=(int)$db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo));
 
 //cat può andare da 1 a 8 

switch($cat){

case 1:	
	include('scheda_a.php');
break;
case 2:
	if($tipo<13 and $tipo>8) include('scheda_b.php');
	if($tipo==13 ) include('scheda_c.php');
	if($tipo==14 ) include('scheda_d.php');
	if($tipo==15 ) include('scheda_e.php');
break;
default:
	include('scheda_f.php');
	break;
}

break;
case 4: //sezione 4
   include('sezione4.php');	
break;
/*
case 5: //sezione 5
	include('sezione5.php');
break;
*/
}
?>




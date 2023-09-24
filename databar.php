<?php
include("autoloader.php");
$db= new DB();

$req=$_GET['req'];




switch($req){
	case 'mensili':
	
	$da=Utility::getData('10/08/2018');
 $mese_da= date('n', $da);
$a=Utility::getData('12/11/2018');
$mese_a= date('n', $a);
$mesi= (int)Utility::datediff('M', '10/08/2018', '12/11/2018');
$c=$mese_da;
$stat=array();

while($mese_a >= $c){

		 Utility::array_push_associative($stat, array(Utility::getMese($c-1)=>0));
		 $c++;
}

//valorizzo array mese 


$query="select *
	 FROM
       schede
    where time < $a and time > $da 
	order by id asc 
	";
	$row=$db->sqlquery($query);
	$c=0;
foreach	($row as $r){
	$time=$r['time'];
	$mese_corr=  Utility::getMese(date('n', $time)-1);
	
	if(array_key_exists($mese_corr, $stat)){
	
	$num=	$stat[$mese_corr];
	$num++;
	$stat[$mese_corr]=$num;
	}
	
}
		
	
	foreach($stat as $k=>$v){
		
		print $k.",".$v."\n";
	}
		
		
	break;
	


}

$contenuto= ob_get_contents();
//Pulisce il Buffer di Output
ob_end_clean();
 

header("Content-Type: application/text");
header("Content-Disposition: attachment; filename=$req.csv");
print $contenuto;

?>
<?php
header("content-type: application/json"); 
include("autoloader.php");
error_reporting(0);
$db= new DB();

$req=$_GET['req'];

switch($req){
	

	
	
	case 'gen':

foreach($db->selectAll('v_uominidonne') as $r){
	
$nd=$r['totale']-($r['uomini']+$r['donne']);
$tot=$r['totale'];
$perc_d=$r['donne']/$tot*100;
$perc_u=$r['uomini']/$tot*100;
$perc_nd=$nd/$tot*100;
$array[] = array('name'=>'uomini', 'y'=>(int)number_format($perc_u, 0, '.', '.' ));
$array[]= array( 'name'=>'donne', 'y'=>(int)number_format($perc_d, 0, '.', '.' ));
$array[]= array( 'name'=>'N/D', 'y'=> (int)number_format($perc_nd, 0, '.', '.' ) );

$serie[] = array('name' => 'serie 1', 'data' => $array);
echo  json_encode($serie);

}
break;
case 'reg':

$num_regola=count($db->selectAll('v_sociregola'));
$num_tot=count($db->selectAll('v_socitutti'));
$num_morosi=$num_tot-$num_regola;
$perc_r=$num_regola/$num_tot*100;
$perc_m=$num_morosi/$num_tot*100;
$array[]= array( 'name'=>'In regola', 'y'=>(int)number_format($perc_r, 0, '.', '.' ));
$array[]= array( 'name'=>'Morosi', 'y'=> (int)number_format($perc_m, 0, '.', '.' ) );

$serie[] = array('name' => 'serie 1', 'data' => $array);
echo  json_encode($serie);

break;

}

?>
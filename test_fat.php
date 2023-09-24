<?php
session_start();
include("./autoloader.php");
//id_post è id fatturazione


$db= new DB();

$mese='01';
for ($i=0; $i <12 ; $i++) { 
  
$mese=$i+1;
if($mese<10) $mese='0'.$mese;

$anno=2021;
//patch resti forniture mese 
$time_ini=Utility::getDataPre('01/'.$mese.'/'.$anno, 0, 0);
$day=date('t', $time_ini);
$time_fine=Utility::getDataPre($day.'/'.$mese.'/'.$anno, 23, 59);

  $sql=" select count(*)as tot_casi, id_struttura as id_cli from conta_esami_v
where  timeArr >= '$time_ini' and timeArr<='$time_fine' group by id_struttura";
echo $sql;

$row=$db->sqlquery($sql);

foreach ($row as $r) {
 
  $id_cli=$r['id_cli'];
	$tot_mese=$r['tot_casi'];
  if($mese!='01'){
    $mese_prec=$mese-1;
    $res=(int)$db->getCampo('forniture_inviate', 'res', array('id_cli'=>$id_cli, 'anno'=>$anno , 'mese'=>$mese_prec));

 
  }
  else{
    $res=0;
  }

  $tot_mese_30=$tot_mese+$res;
  $casi=30;

 $f= (int) ($tot_mese_30 / $casi);

 if($tot_mese_30<$casi) $res=$tot_mese_30;
 while($tot_mese_30 >=$casi){

   $tot_mese_30=$tot_mese_30-$casi;
   $res=$tot_mese_30;

 }


  $db->add('forniture_inviate', array( 'inviate'=>$f,'res'=>$res,'id_cli'=>$id_cli, 'anno'=>$anno, 'mese'=>$mese));



}
}
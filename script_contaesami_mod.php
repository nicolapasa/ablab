<!-- heading -->
<h4 class="bold">Contatore esami per mese</h4>



<?php
//ini_set('MAX_EXECUTION_TIME', '-1');
//gestire poi cambio anno

//$anno=Utility::getCurr(null, 'Y');
//prima devo gestire il conteggio nella tabella forniture
if(isset($_GET['mese'])) {
    $mese=$_GET['mese'];
    if($mese<10 and strlen($mese)==1) $mese='0'.$mese;
}
else{
    $mese=Utility::getCurr(null, 'm');
}

$time_ini=Utility::getDataPre('01/'.$mese.'/'.$anno, 0, 0);
$day=date('t', $time_ini);
$time_fine=Utility::getDataPre($day.'/'.$mese.'/'.$anno, 23, 59);

$sql=" select count(*)as tot_casi, id_struttura as id_cli from conta_esami_v
where  timeArr >= '$time_ini' and timeArr<='$time_fine'  ";


Utility::getEscape($_GET);

if($_GET['struttura']!=''){

	$struttura=$_GET['struttura'];
	 $sql.=" and LOWER(nome) like LOWER('%$struttura%') ";
	 Utility::array_push_associative($search, array('struttura'=>$_GET['struttura']));
}
$ord =" order by ";
if ($_GET['ord_esa']!='' ){
     $ord_esa=$_GET['ord_esa'];
      if($ord_esa=='crescente'){
		 $ord .='  tot_casi  asc ';
      }else{
		 $ord .=' tot_casi desc ';
	  }


	Utility::array_push_associative($search, array('ord_esa'=>$_GET['ord_esa']));

}
if ($_GET['ord_alfa']!='' ){
  if ($_GET['ord_esa']!='' )   $ord .='  , ';
  $ord_alfa=$_GET['ord_alfa'];
   if($ord_alfa=='crescente'){
  $ord .='  nome  asc ';
   }else{
  $ord .=' nome desc ';
 }


Utility::array_push_associative($search, array('ord_alfa'=>$_GET['ord_alfa']));

}
if ($_GET['ord_alfa']=='' and  $_GET['ord_esa']==''){
  $ord .=' tot_casi  desc ';

}


$sql.=" group by id_struttura $ord ";

include('search_contaesami.php');



?>
<h4 class="bold">Anno <?php echo $anno.' ';   
if($mese<10){
    echo Utility::getMese(substr($mese-1, -1));
} 
else{
	echo Utility::getMese($mese-1);
 }


?></h4>

<?php
$itemsPerPage = 500;

$row = $db->paginaSql($sql, $itemsPerPage);

$totalItems = $db->tot_records;

$currentPage = $db->current_page;


$urlPattern = './index.php?req=stat&anno='.$anno.'&subreq=conta_esami&page=(:num)'.$param.'';
$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
?>
<div class="row">
<div class="col-md-6">
<?php
$first=($currentPage*$itemsPerPage)-($itemsPerPage-1);
$last=$first+$itemsPerPage-1;
echo 'visualizza da '.$first.'  a '.$last.'  di '.$totalItems.'  risultati ';
?>
</div>
<div class="col-md-6">
<?php

    echo $paginator;
?></div>
</div>

	 <table class=" table">
    <thead>
    <tr>
	 <th>
Clinica
    </th>
<th>
Mese Corrente
</th>
<th>
30 casi
</th>

    </tr>
   </thead>
   <tbody>
<?php

  

	foreach($row as $r)

	{

	$id_cli=$r['id_cli'];
	$tot_casi=$r['tot_casi'];
  //  $mese=$r['mese'];
	$nome_cli=Utility::iniziali($db->getCampo('admin' , 'nome', array('id'=>$id_cli)));
?>

<tr>
 <td>
 <?php echo $nome_cli;?>
 </td>

 <?php

//prendo i resti del mese precedente
   if($mese!='01'){

        $mese_prec=$mese-1;
        $res=(int)$db->getCampo('forniture_inviate', 'res', array('id_cli'=>$id_cli, 'anno'=>$anno , 'mese'=>$mese_prec));
    
     
      }
      else{
        $res=0;
      }
   

   $tot_mese_30=$tot_casi+$res;
   $casi=30;

  $f= (int) ($tot_mese_30 / $casi);


  if($tot_mese_30<$casi) $res=$tot_mese_30;
  while($tot_mese_30 >=$casi){

	  $tot_mese_30=$tot_mese_30-$casi;
	  $res=$tot_mese_30;

  }

 //update di res 
$conta=(int)$db->selectAll('forniture_inviate', array('id_cli'=>$id_cli, 'anno'=>$anno, 'mese'=>$mese)) ;

if($conta>0){
    $db->updateP('forniture_inviate', array( 'inviate'=>$f,'res'=>$res), array('id_cli'=>$id_cli, 'anno'=>$anno, 'mese'=>$mese));
 
}
else{
    $db->add('forniture_inviate', array( 'inviate'=>$f,'res'=>$res,'id_cli'=>$id_cli, 'anno'=>$anno, 'mese'=>$mese));

}


$class='';
  if($f>0) $class='fat';

 ?>


    <td>


<?php

 echo $tot_casi;



?>

</td>
<td class="<?php echo $class;?>">
<?php
if($f>0)  echo $f.' forniture omaggio';

?>

</td>

    <?php

$c++;


?>
</tr>
<?php

	}
?>
</tbody>
</table>

<?php

  echo $paginator;
?>

<!-- heading -->
<h4 class="bold">Contatore esami per mese</h4>



<?php
ini_set('MAX_EXECUTION_TIME', '-1');
//gestire poi cambio anno

//$anno=Utility::getCurr(null, 'Y');
//prima devo gestire il conteggio nella tabella forniture

$sql=" select count(*)as tot_casi, id_struttura as id_cli from conta_esami_v
where anno='$anno' ";


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
<h4 class="bold">Anno <?php echo $anno;?></h4>

<?php
$itemsPerPage = 50;
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
Casi totali fatturati
    </th>
<th>
Gen
</th>
<th>
30 casi
</th>
<th>
Feb
</th>
<th>
30 casi
</th>
<th>
Mar
</th>
<th>
30 casi
</th>
<th>
Apr
</th>
<th>
30 casi
</th>
<th>
Mag
</th>
<th>
30 casi
</th>
<th>
Giu
</th>
<th>
30 casi
</th>
<th>
Lug
</th>
<th>
30 casi
</th>
<th>
Ago
</th>
<th>
30 casi
</th>
<th>
Set
</th>
<th>
30 casi
</th>
<th>
Ott
</th>
<th>
30 casi
</th>
<th>
Nov
</th>
<th>
30 casi
</th>
<th>
Dic
</th>
<th>
30 casi
</th>
    </tr>
   </thead>
   <tbody>
<?php
   $tot_mesi=array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0,
   9=>0, 10=>0, 11=>0, 12=>0);

	foreach($row as $r)

	{

	$id_cli=$r['id_cli'];
	$tot_casi=$r['tot_casi'];

	$nome_cli=Utility::iniziali($db->getCampo('admin' , 'nome', array('id'=>$id_cli)));
?>

<tr>
 <td>
 <?php echo $nome_cli;?>
 </td>
 <td>
  <?php echo $tot_casi;?>
 </td>
 <?php
$c=1;
$res=0;
while($c<13){

//t  numero giorni

if($c<10) {
$mese='0'.$c;
}
else{
$mese=$c;
}

$time_ini=Utility::getDataPre('01/'.$mese.'/'.$anno, 0, 0);
$day=date('t', $time_ini);
$time_fine=Utility::getDataPre($day.'/'.$mese.'/'.$anno, 23, 59);


$sql=" select count(id ) as tot from esami_fatturati_v where
 id_struttura='$id_cli'
and timeArr >= '$time_ini' and timeArr<='$time_fine'
";

$row1=$db->sqlquery($sql);

//print_r($row);
foreach($row1 as $r1){
  $tot_mese=$r1['tot'];
//gestisco forniture

   $tot_mese_30=$tot_mese+$res;
   $casi=30;

  $f= (int) ($tot_mese_30 / $casi);

  if($tot_mese_30<$casi) $res=$tot_mese_30;
  while($tot_mese_30 >=$casi){

	  $tot_mese_30=$tot_mese_30-$casi;
	  $res=$tot_mese_30;

  }

$class='';
  if($f>0) $class='fat';

 ?>


    <td>


<?php

 echo $tot_mese;



?>

</td>
<td class="<?php echo $class;?>">
<?php
if($f>0)  echo $f.' forniture omaggio';

?>

</td>

    <?php

$c++;
}
}
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

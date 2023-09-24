<?php
//gestire poi cambio anno



$tot_mesi=array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0,
   9=>0, 10=>0, 11=>0, 12=>0);
$tot_gen=0;
ini_set('max_execution_time', 0);
//$time_start = microtime(true);



$sql=" select * from andamentoesamicli_v where anno='$anno'  ";

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
		 $ord .='  num  asc ';
      }else{
		 $ord .=' num desc ';
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
  $ord .=' num  desc ';

}


$sql.="  $ord ";


include('search_andamentoesamicli.php');
$itemsPerPage = 10;
$row = $db->paginaSql($sql, $itemsPerPage);
?>
<!-- heading -->
<h4 class="bold">Andamento Esami Cliniche per mese</h4>

<h4 class="bold">Anno <?php echo $anno;?></h4>




	 <table class=" table">
    <thead>
    <tr>
	 <th>
Clinica
    </th>
  <th>
Totali Esami
    </th>
<th>
Gen
</th>
<th>
Feb
</th>
<th>
Mar
</th>
<th>
Apr
</th>
<th>
Mag
</th>
<th>
Giu
</th>
<th>
Lug
</th>
<th>
Ago
</th>
<th>
Set
</th>
<th>
Ott
</th>
<th>
Nov
</th>
<th>
Dic
</th>
    </tr>
   </thead>
   <tbody>
<?php




 $totalItems = $db->tot_records;

 $currentPage = $db->current_page;


$urlPattern = './index.php?req=stat&anno='.$anno.'&subreq=andamento_utenze&page=(:num)';
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

<?php


    foreach($row as $r){
 // print_r($row1);

   $nome=$r['nome'];
   $id_struttura=$r['id_struttura'];
   $tot=$r['num'];
// array_push($arr_cat, array('cat'=>$id_cat));
//anche l'anno



 ?>

<tr class="gradeA">

 <td>
 <?php echo $nome;?>
 </td>
 <td>
  <?php echo $tot;?>
 </td>
 <?php
$c=1;

while($c<13){

//t  numero giorni

if($c<10) {
$mese='0'.$c;
}
else{
$mese=$c;
}




	  $tot_esame=$db->getCampo('andamentoesamiclimese_v', 'num', array('anno'=>$anno, 'id_struttura'=>$id_struttura, 'mese'=>$mese));


//$tot_mesi[$c]=$tot_mesi[$c]+ $tot_esame;




?>


    <td>


<?php echo $tot_esame;?>

</td>


    <?php

$c++;
}

?>
  </tr>
  <?php
  }




//calcolo totali assoluti
foreach($db->sqlquery("select sum(num) as Tot from andamentoesamiclimese_v where anno='$anno' ") as $rec){

  $tot_gen=$rec['Tot'];
}



?>
<tr>

<td>
<strong>Totali </strong>
</td>
<td>
<strong><?php echo $tot_gen;?></strong>
</td>

<?php
$c=1;
while($c<13){

  if($c<10) {
    $mese='0'.$c;
    }
    else{
    $mese=$c;
    }

  foreach($db->sqlquery("select sum(num) as Tot from andamentoesamiclimese_v where anno='$anno' and mese='$mese' ") as $rec){

    $tot_mese=$rec['Tot'];
  }
?>
<td>
<strong><?php echo $tot_mese;?></strong>
</td>

<?php



$c++;
}
?>

</tr>

</tbody>
</table>
<?php

  echo $paginator;
  //$time_end = microtime(true);

//dividing with 60 will give the execution time in minutes otherwise seconds
//$execution_time = ($time_end - $time_start)/60;

//execution time of the script
//echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';
?>

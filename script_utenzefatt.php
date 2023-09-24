<?php 
//gestire poi cambio anno

//$anno=Utility::getCurr(null, 'Y');

$tot_mesi=array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 
   9=>0, 10=>0, 11=>0, 12=>0); 
$tot_gen=0;
ini_set('max_execution_time', 0);




$sql=" select * from fatturecli_v where anno='$anno'  ";

Utility::getEscape($_GET);

if($_GET['struttura']!=''){
	
	$struttura=$_GET['struttura'];
	 $sql.=" and LOWER(nominativo) like LOWER('%$struttura%') ";
	 Utility::array_push_associative($search, array('struttura'=>$_GET['struttura']));
}
$ord =" order by ";	
if ($_GET['ord_esa']!='' ){
     $ord_esa=$_GET['ord_esa'];
      if($ord_esa=='crescente'){
		 $ord .='  tot  asc ';
      }else{
		 $ord .=' tot desc ';
	  }
	

	Utility::array_push_associative($search, array('ord_esa'=>$_GET['ord_esa']));
	
}
if ($_GET['ord_alfa']!='' ){
  if ($_GET['ord_esa']!='' )   $ord .='  , ';
  $ord_alfa=$_GET['ord_alfa'];
   if($ord_alfa=='crescente'){
  $ord .='  nominativo asc ';
   }else{
  $ord .=' nominativo desc ';
 }


Utility::array_push_associative($search, array('ord_alfa'=>$_GET['ord_alfa']));

}
if ($_GET['ord_alfa']=='' and  $_GET['ord_esa']==''){
  $ord .=' tot  desc ';

}


$sql.="  $ord ";


include('search_andamentofattcli.php');
$itemsPerPage = 10;
$row = $db->paginaSql($sql, $itemsPerPage);
?>	
<!-- heading -->
<h4 class="bold">Andamento Fatturazione Cliniche per mese</h4>

<h4 class="bold">Anno <?php echo $anno;?></h4>




	 <table class=" table">
    <thead>
    <tr>
	 <th>
Clinica
    </th>
  <th>
Totale Fatturato
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


$urlPattern = './index.php?req=stat&anno='.$anno.'&subreq=andamento_utenzef&page=(:num)';
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

  
   $id_struttura=$r['id_cli'];
   $nome=$db->getCampo('admin', 'nome', array('id'=>$id_struttura));
   $tot=number_format($r['tot'], 2, ',', '.');
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


	  
	 
	  $tot_esame=$db->getCampo('fatturemesecli_v', 'tot', array('anno'=>$anno, 'id_cli'=>$id_struttura, 'mese'=>$mese));
	 

//$tot_mesi[$c]=$tot_mesi[$c]+ $tot_esame;
	
$tot_esame=number_format($tot_esame, 2, ',', '.');
		

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
foreach($db->sqlquery("select sum(tot) as Tot from fatturecli_v where anno='$anno' ") as $rec){

  $tot_gen=$rec['Tot'];
}



?>
<tr>

<td>
<strong>Totali </strong>
</td>
<td>
<strong><?php echo number_format($tot_gen, 2, ',', '.');?></strong>
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

  foreach($db->sqlquery("select sum(tot) as Tot from fatturemesecli_v where anno='$anno' and mese='$mese' ") as $rec){

    $tot_mese=$rec['Tot'];
  }
?>
<td>
<strong><?php echo  number_format($tot_mese, 2, ',', '.');?></strong>
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
?>
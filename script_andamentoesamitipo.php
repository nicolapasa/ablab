
<!-- heading -->
<h4 class="bold">Andamento esami specifici per mese</h4>
<?php

if($_GET['mese']!=''){

	$mese=$_GET['mese'];

	 Utility::array_push_associative($search, array('mese'=>$_GET['mese']));
}
else
{


 echo  $mese=date('m', CURRENT_DATE);
}
?>
<div class="portlet-body form">
 <form class="horizontal-form" action="index.php" method="get" enctype="multipart/form-data">
 <div class="form-body">

     <div class="row">


<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Seleziona il mese:</label>
<div class="col-md-8">
<select  name="mese"  class="form-control">
 <option value="<?php echo $mese;?>" selected><?php echo Utility::getMese(abs($mese)-1);?></option>
 <option value="01" >Gennaio</option>
  <option value="02" >Febbraio</option>
  <option value="03" >Marzo</option>
  <option value="04" >Aprile</option>
  <option value="05" >Maggio</option>
  <option value="06" >Giugno</option>
  <option value="07" >Luglio</option>
  <option value="08" >Agosto</option>
  <option value="09" >Settembre</option>
  <option value="10" >Ottobre</option>
  <option value="11" >Novembre</option>
  <option value="12" >Dicembre</option>
</select>

</div>
</div>
</div>

</div><!--end row-->





<input type="hidden" name="req" value="stat" />
<input type="hidden" name="subreq" value="andamento_tipi" />
<input type="hidden" name="anno" value="<?php echo $anno;?>" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
								  <a href="index.php?req=stat&subreq=andamento_tipi"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>

<h4 class="bold">Anno <?php echo $anno;?> / Mese <?php echo Utility::getMese(abs($mese)-1);?></h4>

<a href="esp_stat.php?anno=<?php echo $anno;?>&mese=<?php echo $mese;?>" class=" btn btn-primary  ">Esporta Statistica </a>



	 <table class=" table">
    <thead>
    <tr>
    <th>
Categoria
    </th>
	 <th>
Esame
    </th>
  <th>
Totali Esami
    </th>

    </tr>
   </thead>
   <tbody>
<?php

$tot_gen=0;
$tot_mese=0;
ini_set('max_execution_time', 0);

$sql=" select * from esami3_v where anno='$anno' and mese='$mese'  order by num desc, tipo asc ";

$itemsPerPage = 60;
$row = $db->paginaSql($sql, $itemsPerPage);



 $totalItems = $db->tot_records;

 $currentPage = $db->current_page;


$urlPattern = './index.php?req=stat&anno='.$anno.'&mese='.$mese.'&subreq=andamento_tipi&page=(:num)';
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
   $tipo=$r['tipo'];
   $nome=$db->getCampo('esami_cat', 'nome', array('id'=>$tipo));
   $tot=$r['num'];
   $tipologia=$db->getCampo('categorie', 'nome', array('id'=>$db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo))));
// array_push($arr_cat, array('cat'=>$id_cat));
//anche l'anno

$tot_mese=$tot_mese+$tot;

 ?>

<tr class="gradeA">
<td>
 <?php echo $tipologia;?>
 </td>
 <td>
 <?php echo $nome;?>
 </td>
 <td>
  <?php echo $tot;?>
 </td>



  </tr>
  <?php
  }




//calcolo totali assoluti
foreach($db->sqlquery("select sum(num) as Tot from esami3_v where anno='$anno' ") as $rec){

  $tot_gen=$rec['Tot'];
}



?>
<tr>

<td>
<strong>Totali mensili</strong>
</td>
<td>
<strong><?php echo $tot_mese;?></strong>
</td>
</tr>
<tr>

<td>
<strong>Totali annuali</strong>
</td>
<td>
<strong><?php echo $tot_gen;?></strong>
</td>


</tr>

</tbody>
</table>
<?php

  echo $paginator;
?>

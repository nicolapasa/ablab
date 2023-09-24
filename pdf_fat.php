<?php
if($livello !='administrator' ) header("Location: index.php?req=accesso_negato");
($_GET['anno']!='') ?    $anno_core=$_GET['anno']:    $anno_core=ANNO_CORE;
?>
<div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Elenco PDF Fatture</h3>
                                        </div>
                                        <div class="panel-body">
<!-- heading -->
<?php
   $rw=   $db->sqlquery('select distinct(anno) from fatture  ');
   foreach($rw as $r){
     if($r['anno']< $anno_core){
      echo '<a  class="btn btn-primary " href="index.php?req=pdf_fat&anno='.$r['anno'].'"  >Fatture Anno' .$r['anno'].'</a>';

     }

   }
   echo '<a class="btn btn-primary " href="index.php?req=pdf_fat&anno='.ANNO_CORE.'"  >Fatture  Anno' .ANNO_CORE.'</a>';


?>
<br>
 <a class="btn btn-primary " href="index.php?req=fatture" >Torna a Fatture</a>

 <div class="portlet-body form">
 <form class="horizontal-form" action="force_multidownload_fat_pdf.php" method="get" enctype="multipart/form-data">
 <div class="form-body">

  <div class="row">
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-6 col-form-label bold">Scarica per Data fattura:</label>
<div class="col-md-6">
<?php
if(!isset($_GET['data_fatt'])) $_GET['data_fatt']=Utility::getTime();

?>
<input data-date-format="dd/mm/yyyy"  type="text" class="form-control date-picker" value="<?php echo $_GET['data_fatt'];?>"   name="data_fatt"   />
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-6 col-form-label bold">Scarica da N°:</label>
<div class="col-md-6">
<input   type="text" class="form-control " value="<?php echo $_GET['numfatt_da'];?>"   name="numfatt_da"   />
</div>
</div>
</div>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-6 col-form-label bold">a N°:</label>
<div class="col-md-6">
<input   type="text" class="form-control " value="<?php echo $_GET['numfatt_a'];?>"   name="numfatt_a"   />
</div>
</div>
</div>
</div>
<input type="hidden" name="anno_core" value="<?php echo $anno_core;?>" >
	<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>SCARICA
								</button>
					 <a href="index.php?req=pdf_fat"  class="btn default">RESET</a>
							</div>


	</div>
</form>
</div>


<?php



	$sql="select * from fatturate_v where anno='$anno_core'  order by  num desc, anno desc ";




$param=Utility::getSearch($_GET);
$param2=Utility::getSearch2($_GET);
$itemsPerPage = 20;
$row = $db->paginaSql($sql, $itemsPerPage);



$totalItems = $db->tot_records;

$currentPage = $db->current_page;


$urlPattern = './index.php?req=pdf_fat&page=(:num)'.$param.'';
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
NumFattura
    </th>
		 <th>
Cliente
    </th>
	 <th>
Data Fattura
    </th>
     <th>
 PDF fattura
  </th>
     <th>
 PDF allegato
  </th>

    </tr>
   </thead>
   <tbody>
<?php

$cl=new Clear();


foreach($row as $r){

	$nominativo=$r['nominativo'];
$id_fat= $r['id'];

	$num= $r['num'];
		$anno=$r['anno'];



				$dataFatt=Utility::getTime($r['data']);


?>
<tr class="gradeA">
    <td>
  <?php echo $num.'/'.$anno;?>
  </td>
    <td>
  <?php echo $nominativo;?>
  </td>
       <td >
  <?php echo $dataFatt; ?>
    </td>
         <td>


<a  class="btn btn-primary" href="force_download_fat_pdf.php?id=<?php echo $id_fat;?>">
			<span>scarica</span></a>


	</td>
	    <td>


<a  class="btn btn-primary" href="force_download_alle_pdf.php?id=<?php echo $id_fat;?>">
			<span>allegato</span></a>


	</td>
   </tr>
    <?php

}

?>
</tbody>
</table>
<?php

  echo $paginator;
?>
</div>
</div>
<?php



?>

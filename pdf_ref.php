<?php
if($livello !='administrator' ) header("Location: index.php?req=accesso_negato");
?>
<div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Elenco PDF Referti</h3>
                                        </div>
                                        <div class="panel-body"> 
<!-- heading -->
 <a class="btn btn-primary " href="index.php?req=referti" >Torna a Referti</a>  
 
 <div class="portlet-body form">
 <form class="horizontal-form" action="force_multidownload_pdf.php" method="get" enctype="multipart/form-data">
 <div class="form-body">

  <div class="row">
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-6 col-form-label bold">Scarica per Data referto:</label>    
<div class="col-md-6">
<?php 
if(!isset($_GET['dataRef'])) $_GET['dataRef']=Utility::getTime(); 

?>
<input data-date-format="dd/mm/yyyy"  type="text" class="form-control date-picker" value="<?php echo $_GET['dataRef'];?>"   name="dataRef"   />
</div>
</div>
</div>
</div>
	<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>SCARICA
								</button>
					 <a href="index.php?req=xml"  class="btn default">RESET</a>
							</div>	
 
 
	</div>
</form>
</div>
 
 
<?php 


	
	$sql="select * from referti_v where stato=3 and tipo<92 order by  id_referto desc, anno desc ";

    


$param=Utility::getSearch($_GET);	
$param2=Utility::getSearch2($_GET);
$itemsPerPage = 20;
$row = $db->paginaSql($sql, $itemsPerPage);



$totalItems = $db->tot_records;

$currentPage = $db->current_page;


$urlPattern = './index.php?req=pdf&page=(:num)'.$param.'';
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
NumReferto
    </th>  
		 <th>
Clinica
    </th>  
	 <th>
Nome Esame
    </th> 
	 <th>
Data Referto
    </th> 	
     <th>
 Scarica
  </th>


    </tr>
   </thead>
   <tbody>   
<?php

$cl=new Clear();

   
foreach($row as $r){
	
	$nominativo=$r['nome'];
$id_ref= $r['id'];

	$id_referto= $r['id_referto'];
			
				
		$nome_esame=$db->getCampo('esami_cat', 'abbr', array('id'=>$r['tipo']));
         		
				$dataRefertazione=$r['dataRefertazione'];


?>
<tr class="gradeA">
    <td>
  <?php echo $id_referto;?>  
  </td>
    <td>
  <?php echo $nominativo;?>  
  </td>
    <td >
  <?php echo $nome_esame; ?>
    </td>
       <td >
  <?php echo $dataRefertazione; ?>
    </td>
         <td>

   
<a  class="btn btn-primary" href="force_download_pdf.php?id=<?php echo $id_ref;?>">
			<span>scarica</span></a>

	
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

<!-- heading -->
 <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-blue-hoki"></i>
                                                  
												  <span class="caption-subject font-blue-hoki bold uppercase">
												  Fatture</span>
                                     
                                                </div>
                                        
                                            </div> 
<?php 

	$sql="select * from fatturate_v where id_cliente='$id_loggata' or id_cli='$id_loggata' order by id desc  ";








$itemsPerPage = 20;



$row = $db->paginaSql($sql, $itemsPerPage);

$p= new geo();

$totalItems = $db->tot_records;

$currentPage = $db->current_page;


$urlPattern = './index.php?req=fatture_cli&page=(:num)'.$param.'';
$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

//echo $db->printPagina(0,'fat', $search);
?>	
</div>  

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
      <div class=" flip-scroll">
 <table class="table table-bordered table-striped table-condensed flip-content" >
        <thead class="flip-content">
    <tr>
	  <th>
   Anno
    </th>
	 <th>
  NumFatt
    </th>
   <th>
  Data Fattura
    </th>
	<th>
	Importo ivato
	</th>

	 <th>
     Pagata
    </th>
    <th>
    PDF
    </th>
        <th>
    PDF
    </th>
    </tr>
   </thead>
   <tbody>
<?php

$cl=new Clear();
$valid=true;
   
foreach($row as $r){
	$r=$cl->pulisci($r);
$id_fatt= $r['id'];


$num=$r['num'];
$id_cliente= $r['id_cliente'];
$importo = $r['importo'];
 $dest=$r['dest'];
$data = Utility::getTime($r['data']);
$anno=$r['anno'];
$pagata=$r['pagata'];
$sconto=$r['sconto'];

$email='';
$classTr='';
//calcolo importo in base a destinatario
if($pagata=='n') $classTr='nonpagate'; 

if($dest!='p'){
	//dati clinica
$row2 = $db->selectAll('admin', array('id'=>$id_cliente));

foreach($row2 as $r2){
	
	$nome = $r2['nome'];
    if(is_numeric($r2['provincia']))
	$provincia = $p->getProv($r2['provincia']);
    $comune=$p->getCom($r2['comune']);
	if($r2['email_fatt']!=''){
	$email1=array_unique(explode(';', $r2['email_fatt']));
	
	
	}
	else{
		$email1=array_unique(explode(';', $r2['email']));
	}
	foreach($email1 as $e){
      	
	    $email.=$e.' ';
	}
	
}	
}
elseif($dest=='p'){
	//dati propr
	$row2 = $db->selectAll('proprietari', array('id'=>$id_cliente));

foreach($row2 as $r2){
	$email=$r2['email_pro'];
	$nome_proprietario = $r2['nome_proprietario'];
	$cognome_proprietario = $r2['cognome_proprietario'];
	$provincia_pro=$p->getProv($r2['provincia_pro']);
    $id_struttura=$r2['id_struttura'];
$nome=$db->getCampo('admin', 'nome', array('id'=>$id_struttura));
$provincia = $p->getProv($db->getCampo('admin', 'provincia', array('id'=>$id_struttura)));
}
}



?>
<tr class="<?php echo $classTr;?>">
    <td>
  <?php echo $anno;?>  
  </td>
   <td >
  <? echo $num; ?>
    </td>
   <td >
  <? echo $data; ?>
    </td>
 


    <td >
	
    <? echo $importo; ?>
    </td> 
   
	<td>
	  <?php  
	 echo $pagata;
	 
?>
	</td>
	

    <td >
<a target="_new" class="btn btn-primary" href="force_download_fat_pdf.php?id=<?php echo $id_fatt;?>">
<i class='fa fa-print'>Fattura</i></a>
    </td>
    <td>
     
    <?php
if($dest!='p'){
	?>
	<a target="_new" class="btn btn-primary" href="force_download_alle_pdf.php?id=<?php echo $id_fatt;?>">
<i class='fa fa-print'>Allegato</i></a>
<?php 	
	
}
	
	?>
	</td>
	<?php
	
}

$row=$db->sqlquery($sql);

foreach($row as $r){
	
	$totale_imp=$totale_imp+$r['importo'];

}


?>
<tr class="bold">

<td colspan="3">
TOTALE
</td>
<td>
<?php echo '€ '.number_format($totale_imp, 2, ',', '.');?>
</td>
<td colspan="2">

</td>
<td>
</td>
</tr>
</tbody>
</table>

<?php 

  echo $paginator; 
?>
</div>

<!-- heading -->
 <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-blue-hoki"></i>
                                                  
												  <span class="caption-subject font-blue-hoki bold uppercase">
												  Richieste Inserite</span>
                                     
                                                </div>
                                           
                                            </div>

<?php 
if(($livello == 'administrator')){
	
	
	include('search.php');


	
	$sql="select * from fatture_n where completa='s' and attivo ='v'";

    

}else{
	include('search_cli.php');
	$sql="select * from fatture_n where id_struttura='$id_loggata' and completa='s' and attivo ='v'";

} 
 Utility::getEscape($_GET);

if($_GET['struttura']!=''){
	
	$struttura=$_GET['struttura'];
	 $sql.=" and LOWER(nome) like LOWER('%$struttura%') ";
	 Utility::array_push_associative($search, array('struttura'=>$_GET['struttura']));
}
if($_GET['num']!=''){
	
	$num=$_GET['num'];
	 $sql.=" and num = '$num' ";
	 Utility::array_push_associative($search, array('num'=>$_GET['num']));
}
 if($_GET['proprietario']!=''){
	
	$proprietario=$_GET['proprietario'];
	 $sql.=" and LOWER(cognome_proprietario) like LOWER('%$proprietario%') ";
	 Utility::array_push_associative($search, array('proprietario'=>$_GET['proprietario']));
}

if($_GET['urgente']!=''){
	
	$urgente=$_GET['urgente'];
	 $sql.=" and urgente = 's' ";
	 Utility::array_push_associative($search, array('urgente'=>$_GET['urgente']));
}
if($_GET['margini']!=''){
	
	$margini=$_GET['margini'];
	 $sql.=" and (margini = 's' or  margini2 ='s'  ) ";
	 Utility::array_push_associative($search, array('margini'=>$_GET['margini']));
}
if($_GET['seconda_refertazione']!=''){


	$sql.=" and seconda_refertazione = 's' ";
	Utility::array_push_associative($search, array('seconda_refertazione'=>$_GET['seconda_refertazione']));
}

if ($_GET['tipo']!='' ){
	$tipo_cat=$_GET['tipo'];
	 $sql.=" and id_cat = '$tipo_cat' ";
	 
	Utility::array_push_associative($search, array('tipo'=>$_GET['tipo']));
	
}
if ($_GET['allegati']!='' ){

	 $sql.=" and allegati > 0 ";
	 
	Utility::array_push_associative($search, array('allegati'=>$_GET['allegati']));
	
}
$sql.=" order by num desc, anno desc ";
$param=Utility::getSearch($_GET);	
$param2=Utility::getSearch2($_GET);
$itemsPerPage = 20;
$row = $db->paginaSql($sql, $itemsPerPage);

$p= new geo();

$totalItems = $db->tot_records;

$currentPage = $db->current_page;


$urlPattern = './index.php?req=ric&page=(:num)'.$param.'';
$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

//echo $db->printPagina(0,'fat', $search);
?>	
</div>  
<div class="alert alert-default">
<strong>Legenda:</strong>
<br> richieste arrivate <span class="badge badge-lilla badge-roundless"> </span>
<br> richieste non arrivate <span class="badge badge-white badge-roundless"> </span>
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
   Scheda
    </th>
   <th>
   Anno
    </th>
    <th>
  Proprietario
    </th>
	  <?php  if($livello == 'administrator'){?>
    <th>
   Struttura
    </th>
	  <?php }?>

	<th>
	Tipo
	</th>
	<th>
	U
	</th>

	<th>
	Fatt
	</th>
	     <?php    if($livello != 'service') {?>
	<th>
   Totale
    </th>
    <?php }?>
	 <th>
   Data Inserimento
    </th>
    <th>
    PDF
    </th>
 
  <th>
  File 
  </th>
     <?php if($livello == 'administrator') {?>
    <th>
Modifica
  </th>
      <th>
  Elimina
  </th>
  <?php }?>
    </tr>
   </thead>
   <tbody>
<?php

$cl=new Clear();
$valid=true;
   
foreach($row as $r){
	$r=$cl->pulisci($r);
$id_scheda= $r['id'];


$fatturata='';

if($db->checkRec('esami_fatturati_v', array('id_scheda'=>$id_scheda))){
	$fatturata='s';
	
}

//se  presente nei referti coloro di viola la riga
$classTr='';
if( count($db->selectAll('referti', array('id_scheda'=>$id_scheda)))>0) $classTr='check'; 

$num=$r['num'];
$id_struttura= $r['id_struttura'];
$totale = $r['totale'];
$tipo=$r['tipo'];
$nome_tipo=$db->getCampo('esami_cat', 'nome', array('id'=>$tipo));
$data = Utility::getTime($r['time']);
$anno=$r['anno'];
$urgente=$r['urgente'];
$margini=$r['margini'];
$nome_proprietario = $r['nome_proprietario'];
$cognome_proprietario = $r['cognome_proprietario'];

$row2 = $db->selectAll('admin', array('id'=>$id_struttura));

foreach($row2 as $r2){
	$r2=$cl->pulisci($r2);
	$nome = $r2['nome'];
  $provincia = $r2['provincia'];
    if(is_numeric($r2['provincia']))
	$provincia = $p->getProv($r2['provincia']);

}

 $allegati= count($db->selectAll('allegati', array('id_scheda'=>$id_scheda)));







?>
<tr class="<?php echo $classTr;?>">
   <td >
  <? echo $num; ?>
    </td>
    <td>
  <?php echo $anno;?>  
  </td>
    <td >
  <? echo $nome_proprietario . ' '.$cognome_proprietario; ?>
    </td>
	  <?php  if($livello == 'administrator'){?>
    <td >
	
    <? echo $nome .' '. $provincia; ?>
    </td>  <?php } ?>
	<td>
	<?php echo $nome_tipo;?>
	</td>
		<td>
	<?php echo $urgente;?>
	</td>
	
		<td>
	<?php echo $fatturata;?>

	</td>
 <?php    if($livello != 'service') {?>
	  <td >
    <? echo $totale . ' euro'; ?>
    </td>
	
    <?php }?>

	  <td >
    <? echo $data; ?>
    </td>
    <td >
<a target="_new" class="btn btn-primary" href="print.php?id_scheda=<?php echo $id_scheda;?>&anno=<?php echo $anno;?>">
<i class='fa fa-print'></i></a>
    </td>
   
       <td>
<? 
if($allegati>0){
?>
<a class="btn btn-primary" href="index.php?req=file&id_scheda=<?php echo $id_scheda;?>&anno=<?php echo $anno;?>">
<i class='fa fa-file'></i></a>
<?php 
  }
  else{
  echo 'no allegati';}?>  </td>
   <?php if($livello == 'administrator') {?>
   <td>
<a class="btn btn-primary" href="index.php?req=mod_scheda&id=<?php echo $id_scheda;?>">
<i class='fa fa-edit'></i></a>

   </td>
   
        <td>
<a class="btn btn-primary delete_esa" id="<?php echo $id_scheda;?>">
			<i class='fa fa-trash'></i></a>
    </td>
    <?php }?>
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
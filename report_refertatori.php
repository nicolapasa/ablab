<!-- heading -->
<h4 class="innerAll margin-none bg-white">Report Refertatori</h4>

<?php
 Utility::getEscape($_GET);


	if($_GET['anno']!=''){
		$anno_core=$_GET['anno'];
		Utility::array_push_associative($search, array('anno'=>$anno_core));
	}
	else
	{
		$anno_core=ANNO_CORE;
	}
	$sql="select * from report_refertatori_v where anno ='$anno_core' ";

    if($_GET['num']!=''){

        $num=$_GET['num'];
         $sql.=" and num = '$num' ";
         Utility::array_push_associative($search, array('num'=>$_GET['num']));
    }
    if($_GET['mese']!=''){
        $mese=explode("/" , $_GET['mese'])[1];
       
         $sql.=" and FROM_UNIXTIME( data_completato,'%m') = '$mese' ";
         Utility::array_push_associative($search, array('mese'=>$_GET['mese']));
    }
    if($_GET['mese_assegnato']!=''){
        $mese=explode("/" , $_GET['mese_assegnato'])[1];
       
         $sql.=" and FROM_UNIXTIME( data_assegnazione,'%m') = '$mese' ";
         Utility::array_push_associative($search, array('mese_assegnato'=>$_GET['mese_assegnato']));
    }

    if($_GET['nome']!=''){

        $nome=addslashes($_GET['nome']);
         $sql.=" and LOWER(nome) like LOWER('%$nome%') ";
         Utility::array_push_associative($search, array('nome'=>$_GET['nome']));
    }

    if($_GET['completato']!=''){

        $completato=$_GET['completato'];
         $sql.=" and completato = 's' ";
         Utility::array_push_associative($search, array('completato'=>$_GET['completato']));
    }

include('search_report_refertatori.php');


$sql.=" order by id desc ";


$param=Utility::getSearch($_GET);
$param2=Utility::getSearch2($_GET);
$itemsPerPage = 200;
$row = $db->paginaSql($sql, $itemsPerPage);

$p= new geo();

$totalItems = $db->tot_records;

$currentPage = $db->current_page;


$urlPattern = './index.php?req='.$req.'&page=(:num)'.$param.'';
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



	   <div class=" flip-scroll">
 <table class="table table-bordered table-striped table-condensed flip-content" >
        <thead class="flip-content">
    <thead>
    <tr>
    	 <th >
    Id
    </th>
	 <th >
    nome
    </th>
    <th>
    E-mail
    </th>
    <th >
   num referto
    </th>
	   <th>
    Completato
    </th>
    <th>
	 data assegnazione
	 </th>
		<th>
	 data refertazione
	 </th>
  
    </tr>
   </thead>
   <tbody>
<?php


//contatori 

$tot_referti_assegnati=0;
$tot_referti_completati=0;

foreach($row as $r){

$id = $r['id'];

$nome = stripslashes($r['nome']);

$email = $r['email'];
$num_referto=$r['num'];
$data_refertazione=$r['dataRefertazione'];
$completato=$r['completato'];
if($completato=='s') $tot_referti_completati++;

if($r['data_assegnazione'] !=0)    $data_assegnazione=Utility::getTime($r['data_assegnazione']);
if($r['data_completamento'] !=0)    $data_completamento=Utility::getTime($r['data_completamento']);

?>
<tr class="gradeA">
  <td>
  <?php echo $id; ?>
    </td>
   <td>
  <?php echo $nome; ?>
    </td>
    <td class="min">
   <a href="mailto:<?php echo $email; ?>"><?php
	echo $email; ?></a>		
    </td>
    <td>
  <?php echo $num_referto; ?>
    </td>
    <td class="min">
		<?php echo $completato; ?>
	</td>
		<td class="min">
		 <?php echo $data_assegnazione; ?>
	 </td>
     <td class="min">
		 <?php echo $data_refertazione; ?>
	 </td>


   </tr>
    <?php

}


$tot_referti_assegnati=count($row);



?>
<tr class="bold">
<td colspan="2">
TOTALE ASSEGNATI
</td>
<td>
    <?php echo $tot_referti_assegnati;?>
</td>
<td colspan="2">
TOTALE COMPLETATI
</td>
<td>
<?php echo $tot_referti_completati;?>
</td>
</tr>
</tbody>


</table>
<?php

  echo $paginator;
?>
</div>

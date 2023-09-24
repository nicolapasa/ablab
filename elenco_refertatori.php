<!-- heading -->

<h4 class="innerAll margin-none bg-white">Elenco Refertatori</h4>
<a class="btn btn-primary " href="index.php?req=report_refertatori">Report refertatori </a>
<a class="btn btn-primary " href="index.php?req=report_firma">Report per firma </a>
<?php

$ut=new Utility();
 $ut->getEscape($_GET);


	if($_GET['anno']!=''){
		$anno_core=$_GET['anno'];
		$ut->array_push_associative($search, array('anno'=>$anno_core));
	}
	else
	{
		$anno_core=ANNO_CORE;
	}
	$sql="select * from admin where livello ='referti' ";

  

$sql.=" order by id desc ";


$param=$ut->getSearch($_GET);
$param2=$ut->getSearch2($_GET);
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
<a class="btn btn-primary" href="index.php?req=admin&subreq=modifica&id_admin=">Nuova utenza</a>	
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
    <th >
    username
    </th>
   <th>
    password
    </th>
     <th>
    E-mail
    </th>
    <th >
		firma
		 </th>

       <th >

</th>
<th >

</th>
<th >

</th>
    </tr>
   </thead>
   <tbody>
<?php



foreach($row as $r){


$id_admin = $r['id'];
$livello_u = $r['livello'];
$user = $r['username'];
$pass = $r['password'];
$nome = stripslashes($r['nome_ref']);
$attivo=$r['attivo'];
$email = $r['email'];
$firma=$r['firma'];
?>
<tr class="gradeA">
  <td>
  <?php echo $id_admin; ?>
    </td>
   <td>
  <?php echo $nome; ?>
    </td>
    <td>
  <?php echo $user; ?>
    </td>
   <td class="min">
  <?php echo $pass; ?>
    </td>
    <td class="min">
   <a href="mailto:<?php echo $email; ?>"><?php
	echo $email; ?></a>		
    </td>
    <td>
  <?php echo $firma; ?>
    </td>
    <td class="min3">

<a  class="btn btn-primary" href="index.php?req=admin&subreq=modifica&id_admin=<?php echo $id_admin;?>">
<i class='fa fa-edit'></i></a>
    </td>
	    <td class="min3">
	  <?php  if ($attivo == 'f') {

?>
<a  class="btn btn-primary" href="attiva.php?id_admin=<?php echo $id_admin;?>&req=att">
<i class="fa fa-check"></i></a>
<?php

?> <?php }
else{

echo '<i class="fa fa-check-circle"></i>';
//echo "<a href='attiva.php?id_admin=$id_admin&req=att'>";echo "disattiva utente</a>";

}
?>
    </td>
    <td>

<a  class="btn btn-primary delete_utente"  id="<?php echo $id_admin;?>">
<i class='fa fa-trash'></i></a>
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

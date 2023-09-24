
<!-- heading -->
 <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-blue-hoki"></i>

												  <span class="caption-subject font-blue-hoki bold uppercase">
												  Fatturazione</span><br>
												  Esami da Fatturare

                                                </div>

                                            </div>
<a class="btn btn-primary " href="./destroy.php?req=fatture" >Fatture</a>
  <a class="btn btn-primary " href="index.php?req=xml" >Fatture elettroniche</a>
<?php
	if(isset($_GET) and Utility::getKey($_GET) ){
		Utility::delSessione($_GET);
		Utility::getSessione($_GET);

			//print_r($_SESSION['search']);
	}
else if(isset($_SESSION['search'])){

		//print_r($_SESSION['search']);
		Utility::putSessione($_SESSION['search']);

	}


	Utility::getEscape($_GET);
	$cond1='';
	$cond2='';
if($_GET['cli']!=''){

	$cli=$_GET['cli'];
	 $cond1=" and LOWER(nome) like LOWER('%$cli%') ";
	 Utility::array_push_associative($search, array('cli'=>$_GET['cli']));
}
if($_GET['riba']!=''){

	$riba=$_GET['riba'];
if($riba=='n') {
	$cond1=" and mod_pag='bonifico' ";
}else  {
	 $cond1=" and mod_pag='riba' ";
}
	 Utility::array_push_associative($search, array('riba'=>$_GET['riba']));
}
if($_GET['pro']!=''){

	$pro=$_GET['pro'];
	 $cond2=" and LOWER(cognome_proprietario) like LOWER('%$pro%') ";
	 Utility::array_push_associative($search, array('pro'=>$_GET['pro']));
}
if($_GET['data_fatt']!=''){

	 $time_fatt=Utility::getDataPre($_GET['data_fatt'], 23, 59);

	 Utility::array_push_associative($search, array('data_fatt'=>$_GET['data_fatt']));

}
else{

	$time_fatt=Utility::getDataPre(Utility::getTime(), 23, 59);

    $data_fatt=Utility::getTime($time_fatt);
}
if($_GET['data_fine']!=''){

	 $time_fine=Utility::getDataPre($_GET['data_fine'], 23, 59);
	 $range =" timeArr<= '$time_fine' ";
	 Utility::array_push_associative($search, array('data_fine'=>$_GET['data_fine']));
}
else{

	$time_fine=Utility::getDataPre(Utility::getTime(), 23, 59);
    $range =" timeArr<= '$time_fine' ";
    $data_fine=Utility::getTime($time_fine);
}
if($_GET['dest']!=''){

	$dest=$_GET['dest'];
	 Utility::array_push_associative($search, array('dest'=>$_GET['dest']));
}
if ($_GET['perpage']!='' ){

	 $perpage=$_GET['perpage'];

	Utility::array_push_associative($search, array('perpage'=>$_GET['perpage']));

}
$ord =" order by ";
if ($_GET['ord_esa']!='' ){
     $ord_esa=$_GET['ord_esa'];
      if($ord_esa=='crescente'){
		 $ord .='  t1  asc, ';
      }else{
		 $ord .=' t1 desc, ';
	  }


	Utility::array_push_associative($search, array('ord_esa'=>$_GET['ord_esa']));

}
if ($_GET['ord_imp']!='' ){
   echo  $ord_imp=trim($_GET['ord_imp']);
      if($ord_imp =='crescente') {
		  $ord .='  t  asc ,';
	  }else
            {
		   $ord.=' t desc ,';
		   }

	Utility::array_push_associative($search, array('ord_imp'=>$_GET['ord_imp']));

}

	include('search_dafat.php');


$sql='';
if($cond2=='' and $dest!='p') {

	$sql="select id_struttura as id_dest, lower(nome) as nominativo, destinatario, sum(totale) as t, count(*) as t1
	from fatturazione_v
where ( destinatario!='proprietario' ) and (".$range.") ".$cond1."  group by id_struttura ";
}
if($cond2 =='' and $cond1=='' and $dest==''){
$sql.=
"
union ";
}
if($cond1=='' and $dest!='c') {
$sql.= "select id_proprietario as id_dest, CONCAT_WS(' ',    lower(cognome_proprietario),
         lower(nome_proprietario)) as nominativo, destinatario, sum(totale) as t, count(*) as t1
		 from fatturazione_v
where destinatario='proprietario'   and (".$range.") ".$cond2."   group by id_proprietario

";
}
$ord.= ' lower(nominativo) asc ';
$sql.= $ord;
//echo $sql;
$param=Utility::getSearch($_GET);
$param2=Utility::getSearch2($_GET);

if($perpage!=''){
	$itemsPerPage=$perpage;
}
else{
$itemsPerPage = 20;
}
$row = $db->paginaSql($sql, $itemsPerPage);

$p= new geo();

$totalItems = $db->tot_records;

$currentPage = $db->current_page;


$urlPattern = './index.php?req=fatturazione&page=(:num)'.$param.'';
$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
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
  ID
    </th>
  <th>
   Struttura/Proprietario
    </th>
	<th>
	Clinica Ref
	</th>

	    <th>
    Fattura a
    </th>
	    <th>
   PEC
    </th>
	   <th>
   SDI
    </th>

		<th>
   Esame old
    </th>
		<th>
   Esame rec
    </th>
	 	<th>
   Esami
    </th>
	<th>
   Totale
    </th>
    <th>
   Genera
    </th>
    </tr>
   </thead>
   <tbody>
<?php

$cl=new Clear();
$p= new geo();

foreach($row as $r){




$id_dest= $r['id_dest'];
$destinatario=$r['destinatario'];
$totale=$r['t'];
$tot_esami=$r['t1'];
 $nome=Utility::iniziali($r['nominativo']);


if($destinatario!='proprietario'){
$row1=$db->sqlquery("select min(timeArr) as data_old from fatturazione_v where
id_struttura='$id_dest'
and  destinatario !='proprietario'

");
}else
{
$row1=$db->sqlquery("select min(timeArr) as data_old from fatturazione_v where
 id_proprietario='$id_dest'
 and destinatario='proprietario'
 and timeArr<= '$time_fine'
 ");
}
foreach($row1 as $r1){
	$dataold=Utility::getTime($r1['data_old']);
}
if($destinatario=='clinica'){
$row1=$db->sqlquery("select max(timeArr) as data_rec from fatturazione_v
where id_struttura='$id_dest'
and destinatario !='proprietario'
and timeArr<= '$time_fine' ");
}else
{
$row1=$db->sqlquery("select max(timeArr) as data_rec from fatturazione_v
where id_proprietario='$id_dest'
and destinatario='proprietario'
and timeArr<= '$time_fine'");
}
foreach($row1 as $r1){
	$datarec=Utility::getTime($r1['data_rec']);
}
if($destinatario!='proprietario'){
	//dati clinica
$row2 = $db->selectAll('admin', array('id'=>$id_dest));

foreach($row2 as $r2){

//	$nome = $r2['nome'];
   $provincia = $r2['provincia'];
    if(is_numeric($r2['provincia']))
	$provincia = $p->getProv($r2['provincia']);
    $comune=$r2['comune'];
	$pec=$r2['pec'];
		$coduni=$r2['cod'];
		$nome_cli='';
}
}
else if($destinatario=='proprietario'){
	//dati propr
	$row2 = $db->selectAll('proprietari', array('id'=>$id_dest));

foreach($row2 as $r2){
          $id_struttura=$r2['id_struttura'];
		  $email_pro=$r2['email_pro'];
$nome_cli=$db->getCampo('admin', 'nome', array('id'=>$id_struttura));
	$provincia=$p->getProv($r2['provincia_pro']);
$comune=$p->getCom($r2['comune_pro']);
$pec=$r2['pec_pro'];
}
}



?>
<tr>
   <td >
  <? echo $id_dest; ?>
    </td>
	  <td >

    <? echo $nome; ?>
    </td>
	<td>
	<? echo $nome_cli; ?>
	</td>

	    <td >
  <? if($destinatario!='proprietario') {

	  echo 'clinica';
  }	else{
  echo  'proprietario';
  }  ?>
    </td>
	  <td >

    <? echo $pec; ?>
    </td>
	  <td >

    <?
	if($destinatario=='proprietario'){
		echo $email_pro;

	}else{
		echo $coduni;
	}
	?>
    </td>
  <td >

    <? echo $dataold; ?>
    </td>
  <td >

    <? echo $datarec; ?>
    </td>


		<td>
    <? echo $tot_esami; ?>
    </td>
	<td>
    <? echo number_format($totale, 2, ',', '.') . ' euro'; ?>
    </td>

    <td>
<a  class="btn btn-primary" href="gen_fatture.php?id_dest=<?php echo $id_dest;?>&dest=<?php echo $destinatario;?>&data_fatt=<?php echo $time_fatt;?>&data_fine=<?php echo $time_fine;?>">
<i class='fa fa-euro'>Fattura</i></a>
    </td>



   </tr>
    <?php

}

?>
</tbody>
<?php
//calcolo importo

//eventuale group by id_struttura

$sql='';
if($cond2=='' and $dest!='p') {

	$sql="select  sum(totale) as t, count(*) as t1
	from fatturazione_v
where  destinatario='clinica'   and (".$range.") ".$cond1."  ";
}
if($cond2 =='' and $cond1=='' and $dest==''){
$sql.=
"
union ";
}
if($cond1=='' and $dest!='c') {
$sql.= "select  sum(totale) as t, count(*) as t1
		 from fatturazione_v
where destinatario='proprietario'    and (".$range.") ".$cond2."

";
}

$row=$db->sqlquery($sql);

foreach($row as $r){

	$totale_imp=$totale_imp+$r['t'];
	$totale_num=$totale_num+$r['t1'];
}

?>


<tr class="bold">
<td colspan="6">

</td>
<td colspan="2">
TOTALI
</td>
<td>
<?php echo $totale_num;?>
</td>
<td colspan="2">
<?php echo '€ '.number_format($totale_imp, 2, ',', '.');?>
</td>
<td>
</td>
</tr>

</table>
<?php

  echo $paginator;
?>
</div>

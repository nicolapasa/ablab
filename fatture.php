
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
if(($livello == 'administrator')){




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

	if($_GET['anno']!=''){
		$anno_core=$_GET['anno'];
		Utility::array_push_associative($search, array('anno'=>$anno_core));
	}
	else
	{
		$anno_core=ANNO_CORE;
	}
	$sql="select * from fatturate_v where id>0 and anno  ='$anno_core'";
	 if($_GET['data_da']!=''){

	$data_da=Utility::getDataPre($_GET['data_da'], 0, 0);
	 $sql.=" and data >= '$data_da' ";
	 Utility::array_push_associative($search, array('data_da'=>$_GET['data_da']));
}


?>

<a class="btn btn-primary " href="index.php?req=fatturazione">Da Fatturare</a>
   <a class="btn btn-primary " href="index.php?req=pdf_fat" >Fatture PDF</a>
  <a class="btn btn-primary " href="index.php?req=xml" >Fatture elettroniche</a>
    <a target="_blank" class="btn btn-primary " href="esp_fatt.php?anno=<?php echo $anno_core;?>" >Esporta Fatture</a>
<?php
if($_GET['data_a']!=''){

	$data_a=Utility::getDataPre($_GET['data_a'], 23, 59);
	 $sql.=" and data <= '$data_a' ";
	 Utility::array_push_associative($search, array('data_a'=>$_GET['data_a']));
}

	if($_GET['struttura']!=''){

	$struttura=addslashes($_GET['struttura']);
	 $sql.=" and LOWER(nominativo) like LOWER('%$struttura%') ";
	 Utility::array_push_associative($search, array('struttura'=>$_GET['struttura']));
}
if($_GET['num']!=''){

	$num=$_GET['num'];
	 $sql.=" and num = '$num' ";
	 Utility::array_push_associative($search, array('num'=>$_GET['num']));
}
if($_GET['dest']!=''){

	$dest=$_GET['dest'];
	if($dest=='c'){

		$sql.=" and (dest = '$dest' or dest='')  ";
	}
	else
	{
		$sql.=" and dest = '$dest'  ";
	}

	 Utility::array_push_associative($search, array('dest'=>$_GET['dest']));
}

if($_GET['pagata']!=''){

	$pagata=$_GET['pagata'];
	if($pagata=='pagata') {
	 $sql.=" and pagata = 's' ";
	}
	else{
		 $sql.=" and pagata != 's'  ";
	}
	 Utility::array_push_associative($search, array('pagata'=>$_GET['pagata']));
}
if ($_GET['filtro_imp']!='' ){
     $filtro_imp=trim($_GET['filtro_imp']);

		  $sql .=" and importo  =  '$filtro_imp' ";


	Utility::array_push_associative($search, array('filtro_imp'=>$_GET['filtro_imp']));

}
 if($_GET['proprietario']!=''){

	$proprietario=addslashes($_GET['proprietario']);
	 $sql.=" and LOWER(nominativo) like LOWER('%$proprietario%') ";
	 Utility::array_push_associative($search, array('proprietario'=>$_GET['proprietario']));
}
$ord =" order by ";
if ($_GET['ord_num']!='' ){
     $ord_num=$_GET['ord_num'];
      if($ord_num=='crescente'){
		 $ord .='  num  asc, ';
      }else{
		 $ord .=' num desc, ';
	  }


	Utility::array_push_associative($search, array('ord_num'=>$_GET['ord_num']));

}


if ($_GET['ord_imp']!='' ){
     $ord_imp=trim($_GET['ord_imp']);
      if($ord_imp =='crescente') {
		  $ord .='  cast(imponibile as signed) asc ,';
	  }else
            {
		   $ord.=' cast(imponibile as signed) desc ,';
		   }

	Utility::array_push_associative($search, array('ord_imp'=>$_GET['ord_imp']));

}
if ($_GET['ord_alfa']!='' ){
    $ord_alfa=$_GET['ord_alfa'];
      if($ord_alfa=='crescente') {
		  $ord .="  LOWER(nominativo) asc ,";
	  }
       else{
		  $ord .="  LOWER(nominativo) desc ,";

	   }

	Utility::array_push_associative($search, array('ord_alfa'=>$_GET['ord_alfa']));

}
$ord.=' id desc ';
//perpage
if ($_GET['perpage']!='' ){

	 $perpage=$_GET['perpage'];

	Utility::array_push_associative($search, array('perpage'=>$_GET['perpage']));

}
	$sql .=$ord;

   include('filtro_fatt.php');

}
else{

	//accesso negato
}
 Utility::getEscape($_GET);





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


$urlPattern = './index.php?req=fatture&page=(:num)'.$param.'';
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
	  <?php  if($livello == 'administrator'){?>
    <th>
   Struttura/Proprietario
    </th>
	  <?php }?>

	<th>
	Fattura a
	</th>
	<th>
	Importo ivato
	</th>
	<th>
	Città clinica/ clinica prop
	</th>
		<th>
	Provincia
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
     <?php if($livello == 'administrator') {?>
	   <th>
  E-mail
  </th>
  	   <th>
     XML
  </th>
	     <th>
  Modifica
  </th>
    <th>
  Invia
  </th>
     <th>
  Sollecita
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
$id_fatt= $r['id'];


$ultima='n';

//stabilire se è l'ultima
$id_ultima=$db->getMax('fatture');
if($id_fatt==$id_ultima) $ultima='s';

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
if($pagata!='s') $classTr='nonpagate';

if($dest!='p'){
	//dati clinica
$row2 = $db->selectAll('admin', array('id'=>$id_cliente));

foreach($row2 as $r2){

	$nome = Utility::iniziali($r2['nome']);
	$provincia = $r2['provincia'];
    if(is_numeric($r2['provincia']))
	$provincia = $p->getProv($r2['provincia']);
    $comune=$r2['comune'];
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
	$nome_proprietario = Utility::iniziali($r2['nome_proprietario']);
	$cognome_proprietario = Utility::iniziali($r2['cognome_proprietario']);
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
  <?php  if($livello == 'administrator'){?>
    <td >
  <?php
if($dest=='p'){

  echo $nome_proprietario. ' '.$cognome_proprietario;

}else{

	echo $nome;
}
  ?>
    </td>
	<td>
	<?
	if($dest=='p'){

echo 'proprietario';
	}else{
   echo 'clinica';
	}?>
	</td>
  <?php }?>
    <td >

    <? echo $importo; ?>
    </td>
    <td>
	<?
	if($dest=='p'){
     echo $nome .' '. $provincia;

	}else{
		  echo $comune;

	}?>
	</td>
	<td>
		<?
	if($dest=='p'){
     echo $provincia_pro;

	}else{
		  echo $provincia;

	}?>
	</td>

	<td>
	  <?php  if($livello == 'administrator'){

		  $ck='';
if($pagata=='s') $ck='checked=checked';?>
	<input class="pagata" value="<?php echo $pagata;?>" id="<?php echo $id_fatt;?>" type="checkbox" name="pagata" <?php echo $ck;?> >

		<?php

	  }
	  else{
	 echo $pagata;

}?>
	</td>


    <td >
<a target="_new" class="btn btn-primary" href="force_download_fat_pdf.php?id=<?php echo $id_fatt;?>">
<i class='fa fa-print'>Fattura</i></a>
    </td>
	    <td >
			<?
	if($dest!='p'){
		?>
<a target="_new" class="btn btn-primary" href="force_download_alle_pdf.php?id=<?php echo $id_fatt;?>">
<i class='fa fa-print'>Allegato</i></a>
	<?php }?>
    </td>
    <?php if($livello == 'administrator') {?>
	   <td class="small">
<?php echo $email;?>
  </td>
     <td>
<?php
$class="btn-primary";
if($db->getCampo('invio', 'xml', array('id_fat'=>$id_fatt))) $class="btn-danger";
?>
<a  class="btn <?php echo $class;?> xml" href="force_download.php?id=<?php echo $id_fatt;?>">
<i class='fa fa-xml'>XML</i></a>
  </td>
	     <td>
<a class="btn btn-primary" href="index.php?req=mod_fat&id=<?php echo $id_fatt;?>">
<i class='fa fa-edit'></i></a>
  </td>
    <td>
      <?php
      $class="btn-primary";
      if($db->getCampo('invio', 'fattura', array('id_fat'=>$id_fatt))) $class="btn-danger";
      ?>
<a class="btn <?php echo $class;?>" href="send_fat.php?t=f&id=<?php echo $id_fatt;?>">
<i class='fa fa-mail'></i>Invia</a>
  </td>
     <td>
       <?php
       $class="btn-primary";
       //check se passati 15 giorni

       if($db->getCampo('invio', 'sollecito', array('id_fat'=>$id_fatt))){
        $data_sollecito=$db->getCampo('invio', 'data', array('id_fat'=>$id_fatt));

        if($data_sollecito >0 and Utility::datediff(1, Utility::getTime($data_sollecito), Utility::getTime())>15){
           $class="btn-primary";
          $db->updateP('invio', array('sollecito' =>0, 'data'=>time()  ), array('id_fat'=>$id_fatt));
        }
        else{
          $class="btn-danger";
        }


       }
       ?>
<a class="btn <?php echo $class;?>" href="send_fat.php?t=s&id=<?php echo $id_fatt;?>">
<i class='fa fa-mail'></i>Sollecita</a>
  </td>
       <td>
<?php if($ultima=='s') {?>
<a class="btn btn-primary" href="delete_fat.php?id=<?php echo $id_fatt;?>">
<i class='fa fa-trash'></i>Elimina</a>
<?php }?>
  </td>


  <?php }?>

    <?php

}

$row=$db->sqlquery($sql);

foreach($row as $r){

	$totale_imp=$totale_imp+$r['importo'];

}


?>
<tr class="bold">
<td colspan="3">

</td>
<td colspan="2">
TOTALE
</td>
<td>
<?php echo '€ '.number_format($totale_imp, 2, ',', '.');?>
</td>
<td colspan="9">

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

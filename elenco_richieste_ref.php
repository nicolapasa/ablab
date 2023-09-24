
<?php
  ($_GET['anno']!='') ?    $anno_core=$_GET['anno']:    $anno_core=ANNO_CORE;
  ?>
 <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-blue-hoki"></i>

												  <span class="caption-subject font-blue-hoki bold uppercase">
												  Richieste Inserite da refertare</span>

                                                </div>

                                            </div>

<?php

	$sql="select * from accettazione where completa='s' and attivo ='v' and anno='$anno_core' ";



 Utility::getEscape($_GET);



	include('search_ric.php');
echo "<a class='btn btn-lg blue' href='index.php?req=ref'>";echo "<i class='fa fa-list'></i>Referti";?></a>
 <?php

if($_GET['anno']!=''){
	Utility::array_push_associative($search, array('anno'=>$anno_core));
}


if($_GET['struttura']!=''){

	$struttura=$_GET['struttura'];
	 $sql.=" and LOWER(nome_ref) like LOWER('%$struttura%') ";
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

if($_GET['seconda_refertazione']!=''){


	$sql.=" and seconda_refertazione = 's' ";
	Utility::array_push_associative($search, array('seconda_refertazione'=>$_GET['seconda_refertazione']));
}

if ($_GET['tipo']!='' ){
	$tipo_cat=$_GET['tipo'];
	 $sql.=" and id_cat = '$tipo_cat' ";

	Utility::array_push_associative($search, array('tipo'=>$_GET['tipo']));

}

 if($_GET['dataArrivo']!=''){

	$dataArrivo=$_GET['dataArrivo'];
	 $sql.=" and dataArrivo = '$dataArrivo' ";
	 Utility::array_push_associative($search, array('dataArrivo'=>$_GET['dataArrivo']));
}

if ($_GET['arrivato']!='' ){
	$arrivato=$_GET['arrivato'];
	if($arrivato!='all'){
	 $sql.=" and arrivato = '$arrivato' ";

	Utility::array_push_associative($search, array('arrivato'=>$arrivato));
	}
}
else if($arrivato =='' and $_GET['dataArrivo']!=''){

	 $sql.=" and arrivato != 'n' ";
}
else

{
	 $sql.=" and arrivato = 'n' ";
}


if ($_GET['allegati']!='' ){

	 $sql.=" and allegati > 0 ";

	Utility::array_push_associative($search, array('allegati'=>$_GET['allegati']));

}
//perpage
if ($_GET['perpage']!='' ){

	 $perpage=$_GET['perpage'];

	Utility::array_push_associative($search, array('perpage'=>$_GET['perpage']));

}
$sql.=" order by num desc, anno desc ";
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


$urlPattern = './index.php?req=refertazione&page=(:num)'.$param.'';
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
<div style="display:none;" id="ANNO_CORE"><?php echo $anno_core;?></div>
<button class="up btn btn-lg blue"><i class='fa fa-check'>AGGIORNA</i></button>
 <div class="table-responsive">
 <table class="table table-striped table-bordered table-hover table-header-fixed" id="ref">
    <thead>
    <tr>
		 <th>
   Arrivato
    </th>
	 <th>
   Scheda
    </th>
   <th>
  Num
  Protocollo
    </th>
	<th>
	Data
	Arrivo
	</th>
	  <th>
  Clinica
    </th>
    <th>
  Prop
    </th>

	 <th>
   Esame
    </th>
    <th>
  Tipo
    </th>
    <th>
  Animale
    </th>
   <th>
 Prezzo
  </th>
     <th>
 Quantità
  </th>
    <th>
 Dest
  </th>
  <th>
  DataIns
  </th>
    <th>
  Fatt
  </th>
    <th>
  NumF
  </th>
      <th>
 Stampa
  </th>

    <th>
  Elimina
  </th>
    </tr>
   </thead>
   <tbody>
<?php

$cl=new Clear();


foreach($row as $r){
	$r=$cl->pulisci($r);
$id_scheda= $r['id'];
$num=$r['num'];
$anno=$r['anno'];
$id_struttura= $r['id_struttura'];
$totale = $r['totale'];
$tipo=$r['tipo'];
$nome_tipo=$db->getCampo('esami_cat', 'abbr', array('id'=>$tipo));
$tipo_cat=$db->getCampo('categorie', 'nome', array('id'=>$db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo))));
$id_cat=$db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo));
$data = Utility::getTime($r['time']);
$urgente=$r['urgente'];
$nome_animale=$db->getCampo('animale', 'nome', array('id'=>$r['id_animale']));
$destinatario=$r['destinatario'];
$id_pro=$db->getCampo('schede', 'id_proprietario', array('id'=>$id_scheda));
$qta=$r['qta'];

//devo vedere se risulta fatturato
$fatturato=$r['fatturato'];
$num_fatt='';
if($fatturato=='s') $num_fatt=$r['num_fatt'];

$arrivato=$r['arrivato'];
//se già inserito cerco dati su referti
$dataArrivo=$id_referto='';
if($arrivato=='s'){
$dataArrivo=$db->getCampo('referti', 'dataArrivo', array('id_scheda'=>$id_scheda));
$id_referto=$db->getCampo('referti', 'id_referto', array('id_scheda'=>$id_scheda));
}

$nome_proprietario = $r['nome_proprietario'];
$cognome_proprietario = $r['cognome_proprietario'];

$row2 = $db->selectAll('admin', array('id'=>$id_struttura));

foreach($row2 as $r2){
	$r2=$cl->pulisci($r2);
	$nome_struttura = $r2['nome_ref'];


}






//se arrivati allora tolgo il disable


?>
<tr class="gradeA">
   <td >
<!-- arrivato compilabile-->
<input type="hidden" name="id_<?php echo $id_scheda;?>" value="<?php echo $id_scheda;?>">
<input type="hidden" id="tipo_<?php echo $id_scheda;?>" value="<?php echo $tipo;?>">
<input type="hidden" id="id_cat_<?php echo $id_scheda;?>" value="<?php echo $id_cat;?>">
<?php ($arrivato=='s')? $check='checked=checked': $check='';?>
<input id="<?php echo $id_scheda;?>" class="check" type="checkbox" name="arrivato[]"  >

    </td>
    <td>
  <?php echo $num;?>
  </td>
      <td>
<?php
$disabled='disabled="disabled"';

?>
<input value="<?php echo $id_referto;?>" id="idref_<?php echo $id_scheda;?>" type="text"  class="form-control prot"	name="referto_<?php echo $id_scheda;?>"  <?php echo $disabled;?>>
<!-- id referto compilabile-->
  </td>
    <td>
	<?php
$disabled='disabled="disabled"';

?>
<!-- data arrivo compilabile-->
<input value="<?php echo $dataArrivo;?>" id="da_<?php echo $id_scheda;?>"  type="text" data-date-format="dd/mm/yyyy"   class="form-control date-picker" 	name="dataArrivo_<?php echo $id_scheda;?>" <?php echo $disabled;?> >
  </td>
     <td>

 <?php echo $nome_struttura; ?>

    </td>
    <td>
  <?php echo $nome_proprietario.' '.$cognome_proprietario; ?>
    </td>

	<td>
 <?php echo $nome_tipo; ?>
	</td>
	<td>
<?php echo $tipo_cat; ?>
	</td>
  <td>
<?php echo $nome_animale; ?>
  </td>

	  <td >
<?php echo $totale;?>
    </td>
		  <td>
<?php echo $qta;?>
    </td>
		  <td >

  <?php echo $destinatario; ?>
    </td>
	<td class="large_td">
<?php echo $data;?>
	</td>
	<td>
	<?php echo $fatturato;?>
	</td>
	  <td >
<?php echo $num_fatt;?>

    </td>
    <td >
<a target="_new" class="btn btn-primary" href="print.php?id_scheda=<?php echo $id_scheda;?>&anno=<?php echo $anno;?>">
<i class='fa fa-print'></i></a>
    </td>

   

        <td>
<a class="btn btn-primary delete_esa" id="<?php echo $id_scheda;?>">
			<i class='fa fa-trash'></i></a>
    </td>

   </tr>
    <?php

}

?>
</tbody>
</table>
</div>
<?php

  echo $paginator;
?>


<!-- heading -->
 <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-equalizer font-blue-hoki"></i>

												  <span class="caption-subject font-blue-hoki bold uppercase">
												  Elenco Referti

												  </span>

                                                </div>

                                            </div>

<?php
if(($livello == 'administrator')){
	//print_r($_SESSION);
//	print_r($_GET);
	if(isset($_GET) and Utility::getKey($_GET) ){
		Utility::delSessione($_GET);
		Utility::getSessione($_GET);

			//print_r($_SESSION['search']);
	}
else if(isset($_SESSION['search'])){

		//print_r($_SESSION['search']);
		Utility::putSessione($_SESSION['search']);

	}


	if($_GET['anno']!=''){
		$anno_core=$_GET['anno'];
		Utility::array_push_associative($search, array('anno'=>$anno_core));
	}
	else
	{
		$anno_core=ANNO_CORE;
	}
$tab='refertimancanti_v';
//@todo aggiungere filtro non assegnati
if($_GET['id_specie']!='' or $_GET['id_razza']!='' or $_GET['animale']!='' or $_GET['medico_ref']!=''  or $_GET['id_refertatore'] !=''   or $_GET['assegnati'] !='' )  {

	$tab='elencoreferti_v';

}  

	$sql="select * from ".$tab." where arrivato ='s' and anno = '$anno_core' ";


	

	
 if($_GET['id_specie']!=''){

	$id_specie=$_GET['id_specie'];
	 $sql.=" and specie = '$id_specie' ";
	 Utility::array_push_associative($search, array('id_specie'=>$_GET['id_specie']));
}
if($_GET['razza']!=''){

 $razza=$_GET['razza'];
  $sql.=" and razza = '$razza' ";
  Utility::array_push_associative($search, array('razza'=>$_GET['razza']));
}


 if($_GET['num']!=''){

	$num=$_GET['num'];
	 $sql.=" and num = '$num' ";
	 Utility::array_push_associative($search, array('num'=>$_GET['num']));
}
 if($_GET['stato']!=''){

	$stato=$_GET['stato'];
	 $sql.=" and stato = '$stato' ";
	 Utility::array_push_associative($search, array('stato'=>$_GET['stato']));
}
 if($_GET['id_cat']!=''){

	$id_cat=$_GET['id_cat'];
	 $sql.=" and id_cat = '$id_cat' ";
	 Utility::array_push_associative($search, array('id_cat'=>$_GET['id_cat']));
}
if($_GET['id_esa']!=''){

 $id_esa=$_GET['id_esa'];
  $sql.=" and tipo = '$id_esa' ";
  Utility::array_push_associative($search, array('id_esa'=>$_GET['id_esa']));
}
 if($_GET['dataArrivoDa']!=''){

	$dataArrivoDa=Utility::getData($_GET['dataArrivoDa']);
	 $sql.=" and timeArr >= '$dataArrivoDa' ";
	 Utility::array_push_associative($search, array('dataArrivoDa'=>$_GET['dataArrivoDa']));
}
 if($_GET['dataArrivoA']!=''){

	$dataArrivoA=Utility::getData($_GET['dataArrivoA']);
	 $sql.=" and timeArr <= '$dataArrivoA' ";
	 Utility::array_push_associative($search, array('dataArrivoA'=>$_GET['dataArrivoA']));
}
  if($_GET['id_referto_da']!=''){

	$id_referto_da=$_GET['id_referto_da'];
	 $sql.=" and id_referto >= '$id_referto_da' ";
	 Utility::array_push_associative($search, array('id_referto_da'=>$_GET['id_referto_da']));
}
  if($_GET['id_referto_a']!=''){

	$id_referto_a=$_GET['id_referto_a'];
	 $sql.=" and id_referto <= '$id_referto_a' ";
	 Utility::array_push_associative($search, array('id_referto_a'=>$_GET['id_referto_a']));
}

if($_GET['urgente']!=''){

	$urgente=$_GET['urgente'];
	 $sql.=" and urgente = 's' ";
	 Utility::array_push_associative($search, array('urgente'=>$_GET['urgente']));
}

if($_GET['animale']!=''){

	$animale=addslashes($_GET['animale']);
	 $sql.=" and LOWER(animale) like LOWER('%$animale%') ";
	 Utility::array_push_associative($search, array('animale'=>$_GET['animale']));
}
if($_GET['medico_ref']!=''){

	$medico_ref=addslashes($_GET['medico_ref']);
	 $sql.=" and LOWER(medico_ref) like LOWER('%$medico_ref%') ";
	 Utility::array_push_associative($search, array('medico_ref'=>$_GET['medico_ref']));
}
if($_GET['id_refertatore']!=''){

	$id_refertatore=addslashes($_GET['id_refertatore']);
	 $sql.=" and id_refertatore = '$id_refertatore' ";
	 Utility::array_push_associative($search, array('id_refertatore'=>$_GET['id_refertatore']));
}
if($_GET['assegnati']!=''){

     $assegnati=$_GET['assegnati'];

     if($assegnati=='n'){
		$sql.=" and id_refertatore IS NULL ";
	 }
	 else{
		$sql.=" and id_refertatore IS NOT NULL";
	 }
	
	 Utility::array_push_associative($search, array('assegnati'=>$_GET['assegnati']));
}

if($_GET['struttura']!=''){

	$struttura=addslashes($_GET['struttura']);
	 $sql.=" and LOWER(nome_ref) like LOWER('%$struttura%') ";
	 Utility::array_push_associative($search, array('struttura'=>$_GET['struttura']));
}

 if($_GET['proprietario']!=''){

	$proprietario=addslashes($_GET['proprietario']);
	 $sql.=" and LOWER(cognome_proprietario) like LOWER('%$proprietario%') ";
	 Utility::array_push_associative($search, array('proprietario'=>$_GET['proprietario']));
}

 if( trim($_GET['testo']!='') and strlen(trim($_GET['testo'])) >0 ){


/*echo strlen(trim($_GET['testo']));
echo ctype_space($_GET['testo']);*/
	$testo=addslashes($_GET['testo']);
	 $tipo_t=$_GET['tipo_t'];
//echo urldecode($tipo_t);
 $cont=	count($tipo_t);

if($cont>0)	$sql.=" and (";

$c=0;
	foreach($tipo_t as $k){

		$c++;
		if($k=='all')
		{
			$sql.=" esito_esame like '%$testo%' or
			esito_esame2 like '%$testo%'
			or commento like '%$testo%' or commento2 like '%$testo%' or
            descr_macro like '%$testo%'	or 	descr_micro like '%$testo%'	or
			diagn_morf like '%$testo%'
			";
		}
		else if($k=='esito_esame'){
		 $sql.=" esito_esame like '%$testo%' or
			esito_esame2 like '%$testo%'   ";

		}else if($k=='commento'){

			$sql.=" commento like '%$testo%' or commento2 like '%$testo%'  ";

		}else{
				 $sql.=" $k like '%$testo%'  ";
		}
		 if($c<$cont)  $sql.=" or  ";

	}

	// $sql.=" and  like LOWER('%$testo%') ";
if($cont>0)		 $sql.=" )  ";
  // echo serialize($tipo_t);
	  Utility::array_push_associative($search, array('tipo_t'=>$tipo_t));
	 Utility::array_push_associative($search, array('testo'=>$testo));
}
if ($_GET['allegati']!='' ){

	 $sql.=" and allegati > 0 ";

	Utility::array_push_associative($search, array('allegati'=>$_GET['allegati']));

}
if ($_GET['ord']!='' ){

	 $ord="  time desc,  ";

	Utility::array_push_associative($search, array('ord'=>$_GET['ord']));

}
  if($_GET['id_referto']!=''){

	$id_referto=$_GET['id_referto'];
	 $sql.=" and id_referto = '$id_referto' ";
	 Utility::array_push_associative($search, array('id_referto'=>$_GET['id_referto']));
}
//perpage
if ($_GET['perpage']!='' ){

	 $perpage=$_GET['perpage'];

	Utility::array_push_associative($search, array('perpage'=>$_GET['perpage']));

}

include('search_ref.php');

}
else if($livello=='struttura' or $livello =='service'){
	//parte clinica
	if($_GET['anno']!=''){
		$anno_core=$_GET['anno'];
		Utility::array_push_associative($search, array('anno'=>$anno_core));
	}
	else
	{
		$anno_core=ANNO_CORE;
	}

		$sql="select * from refertimancanti_v where id_struttura='$id_loggata'  and anno = '$anno_core'";
Utility::getEscape($_GET);

     if($_GET['num']!=''){

	$num=$_GET['num'];
	 $sql.=" and num = '$num' ";
	 Utility::array_push_associative($search, array('num'=>$_GET['num']));
}
  if($_GET['id_referto']!=''){

	$id_referto=$_GET['id_referto'];
	 $sql.=" and id_referto = '$id_referto' ";
	 Utility::array_push_associative($search, array('id_referto'=>$_GET['id_referto']));
}




 if($_GET['proprietario']!=''){

	$proprietario=$_GET['proprietario'];
	 $sql.=" and LOWER(cognome_proprietario) like LOWER('%$proprietario%') ";
	 Utility::array_push_associative($search, array('proprietario'=>$_GET['proprietario']));
}
	include('search_ref_cli.php');
}
else{

include('filtri_refertatori.php');

	


}


if($livello!='referti')
{
	$sql.=" order by $ord stato desc, id_referto desc ";
}




$param=Utility::getSearch($_GET);
$param2=Utility::getSearch2($_GET);
//print_r($param);
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


$urlPattern = './index.php?req=ref&page=(:num)'.$param.'';
$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

//echo $db->printPagina(0,'fat', $search);
?>
</div>
<div class="alert alert-default">
<strong>Legenda:</strong>
<br> Referti completi<span class="badge badge-lilla badge-roundless"> </span>
<br> Referti preliminari<span class="badge badge-info badge-roundless"> </span>
<br> Referti in lavorazione <span class="badge badge-white badge-roundless"> </span>
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
<?php
	if(($livello == 'administrator')){
	?>		
<button class="assegna_referto btn btn-lg blue"><i class='fa fa-check'>ASSEGNA</i></button>
<?php } ?>
 
<div class="table-responsive">
 <table class="table table-striped table-bordered table-hover table-header-fixed" >
    <thead>
    <tr>
	<?php
	if(($livello == 'administrator')){
	?>		
	<th>
   Assegna
    </th>
	<?php }?>
	 <th>
 NumProtocollo
    </th>
   <th>
  NumScheda
    </th>
	<?php
	if(($livello == 'administrator')){
	?>
	   <th>
  Clinica
    </th>
	<?php }?>
    <th>
  Proprietario
    </th>
    <th>
  Animale
    </th>
    <th>
   TipoEsame
    </th>
	<th>
	U
	</th>

	<?php
	if(($livello == 'administrator')){
	?>
		<th>
	Allegati
	</th>
	<? }?>
	<th>
	DataArrivo
	</th>
	<th>
  Stato
    </th>
    <th>
    Stampa
    </th>
	<?php
	if(($livello == 'administrator')){
	?>
	<th>
Assegnato
</th>
<?php } ?>
<?php 	if(($livello == 'administrator' or $livello=='referti' )){
	?>
<th>
Referta
</th>
<?php } ?>
<?php 	if(($livello == 'administrator' )){
	?>
	<th>
Invia
</th>
<th>
Elimina
</th>
<th>
Data Referto
</th>
	<?php } ?>
    </tr>
   </thead>
   <tbody>
<?php

$cl=new Clear();


foreach($row as $r){
	$r=$cl->pulisci($r);
	$id=$r['id'];
$id_scheda= $r['id_scheda'];
$id_referto=$r['id_referto'];
$num=$r['num'];
$id_struttura= $r['id_struttura'];
$nome_cli=$db->getCampo('admin', 'nome_ref', array('id'=>$id_struttura));
$tipo=$r['tipo'];
$id_cat=$r['id_cat'];
$urgente=$r['urgente'];
$margini=$r['margini'];
$nome_tipo=$db->getCampo('categorie', 'nome', array('id'=>$id_cat));
if($id_cat==3 or $id_cat==4 or $id_cat==5 or $id_cat==10)
$nome_tipo=$db->getCampo('esami_cat', 'nome', array('id'=>$tipo));
$data = $r['dataArrivo'];
$id_proprietario=$r['id_proprietario'];
$dataRefertazione=$r['dataRefertazione'];
$stato=$db->getCampo('stato_referti', 'value', array('id'=>  $r['stato']));
$nome_animale=Utility::iniziali($db->getCampo('animale', 'nome', array('id'=>  $r['id_animale'])));

$classTr='';
if($id_cat==10) {

	$dataRefertazione=$data;
	$stato='spedito';
	$classTr='check';
	}
if($tipo==88) {


	$classTr='check';
}
if($stato=='finale') $classTr='check';
if($stato=='preliminare') $classTr='prel';


	$allegati='';
if(count($db->selectAll('allegati', array('id_scheda'=>$id_scheda)))>0) $allegati='S';
$nome_proprietario=$db->getCampo('proprietari', 'nome_proprietario', array('id'=>$id_proprietario));
$cognome_proprietario=$db->getCampo('proprietari', 'cognome_proprietario', array('id'=>$id_proprietario));
$assegnato='n';
$nome_refertatore= '';
if((int)$db->getCampo('referti_assegnati', 'id', array('id_referto'=>$id)) !=0){
	$assegnato='s';
	$nome_refertatore=  $db->getCampo('admin', 'nome_ref', array('id'=>$db->getCampo('referti_assegnati', 'id_refertatore', array('id_referto'=>$id))));   
	$id_referto_assegnato=   $db->getCampo('referti_assegnati', 'id', array('id_referto'=>$id));                 
}



?>
<tr class="<?php echo $classTr;?>">
<?php
	if(($livello == 'administrator')){
	?>		
<td>
<!-- assegnabile-->
<!-- se assegnato basta spuntare per rendere riassegnabile-->

<?php
if($stato=='in lavorazione'){
if($assegnato=='s'){
	?>
	<button id="<?php echo $id_referto_assegnato;?>" class="delete_assegna_referto btn btn-sm blue"><i class='fa fa-lock'></i></button>
	<?php
} else{?>
<input id="<?php echo $id;?>" class="check" type="checkbox" name="assegnato[]"  >
<?php } }?>
	</td>
	<?php }?>

   <td >
  <?php echo $id_referto; ?>
    </td>
   <td >
  <?php echo $num; ?>
    </td>
		<?php
		if(($livello == 'administrator')) {
			?>
	   <td >
  <?php echo $nome_cli; ?>
    </td>
	<?php
		}
			?>
    <td >
  <?php echo $nome_proprietario . ' '.$cognome_proprietario; ?>
    </td>
    <td>
<?php echo $nome_animale;?>
    </td>
	<td>
	<?php echo $nome_tipo;?>
	</td>
	<td>
	<?php echo $urgente;?>
	</td>

		<?php
	if(($livello == 'administrator')){
	?>
		<td>
	<?php echo $allegati;?>
	</td>
	<?php }?>
	  <td >
    <?php  echo $data; ?>
    </td>
		  <td>
    <?php


	echo $stato; ?>
    </td>
    <td >
	<?php
		if(($livello == 'administrator' or $livello=='referti')) {
			$tipo_u='admin';
		if($id_cat!=10) {
		?>
<a target="_new" class="btn btn-primary" href="print_referto.php?id=<?php echo $id;?>&tipo=<?php echo $tipo_u;?>&livello=<?php echo $livello;?>">
<i class='fa fa-print'></i></a>


<?php
		}
}
else if($stato != 'in lavorazione'){
		if($id_cat!=10) {
	?>
<a target="_new" class="btn btn-primary" href="print_referto.php?id=<?php echo $id;?>">
<i class='fa fa-print'></i></a>
<?php
		}
}
?>
    </td>
 <?php
	if(($livello == 'administrator' )){
	?>
<td>
<?php


if($assegnato=='n'){
echo 'da assegnare';
?>
<?php }
else if( (int)$db->getCampo('referti_assegnati', 'id', array('id_referto'=>$id)) !=0)  {

//assegnato a qualcuno riassegna
echo $nome_refertatore;
}
else{
	echo 'non assegnato';

}
?>
</td>
<?php

}
 ?>

<td>
<?php
	if(($livello == 'administrator' or $livello=='referti' )){
	if($id_cat!=10) {
	?>
<a class="btn btn-primary" href="index.php?req=referta&id=<?php echo $id;?>">
<span>referta</span></a>
<?php
			}
?>
</td>
<?php

	}
	if(($livello == 'administrator'  )){
	 ?>
<td>
<?php


if( $stato == 'finale'){


	$class="btn-primary";
	if($db->getCampo( 'notifiche_invio_email','id', array('id_oggetto'=>$id))) $class="btn-danger";



?>
<a class="btn <?php echo $class;?>" href="send_referto.php?id=<?php echo $id;?>">
<i class='fa fa-mail'></i>Invia</a>
<?php } ?>
	</td>

<td>
<input type="hidden" value="<?php echo $id_scheda;?>">
<a class="btn btn-primary delete_ref" id="<?php echo $id;?>">
			<i class='fa fa-trash'></i></a>

</td>

<td>
<?php echo $dataRefertazione;?>
</td>
	<?php

	}
	 ?>
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



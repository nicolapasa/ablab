<?php
if($livello !='administrator' ) header("Location: index.php?req=accesso_negato");
switch ($subreq){
	case 'mod_dati_pro':


		$id= (int)$_GET['id'];


		$row= $db->selectAll('proprietari', array('id'=>$id));

	  	$p= new geo();
		if(count($row)>0){

			foreach($row as $r){

	       $id_struttura=$r['id_struttura'];
		   $nome_struttura=$db->getCampo('admin', 'nome', array('id'=>$id_struttura));
			$nome_proprietario = $r['nome_proprietario'];
 		$cognome_proprietario = $r['cognome_proprietario'];
 		$indirizzo_pro = $r['indirizzo_pro'];
 		$id_prov_pro=$r['provincia_pro'];
 		$id_com_pro=$r['comune_pro'];
 		if(isset($r['provincia_pro']))
 		$provincia_pro = $p->getProv($r['provincia_pro']);
 		if(isset($r['comune_pro']))
 		$comune_pro =  $p->getCom($r['comune_pro']);
 		$cap_pro = $r['cap_pro'];
 		$email_pro = $r['email_pro'];
 		$cod_pro = $r['cod_pro'];
		$pec_pro=$r['pec_pro'];
		   $medico_ref=$r['medico_ref'];
		$tel_pro=$r['tel_pro'];


			}
		}


		?>
	<form class="form-horizontal" id="form-nm"
					enctype='multipart/form-data' action="save_pro.php" method="post"
					autocomplete="off">

		<div class="portlet light bordered lilla">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-red-sunglo"></i>
                                        <span class="caption-subject bold uppercase">
										Modifica dati proprietario</span>
                                    </div>

                                </div><!--title-->
                                <div class="portlet-body form">

		<?php
if($_GET['mess']=='ok'){

	?>

	<div class="alert alert-info">
	Dati salvati correttamente
	</div>

	<?php
}

	?>

					<div class="form-group row">



<label class="col-md-3 col-form-label bold">Nome medico referente:</label>
   <div class="col-md-6">
<input type="text"   class="form-control " name="medico_ref" placeholder="medico referente" value="<?php echo $medico_ref;?>" />
</div>
</div>

<div class="form-group row">
<label class="col-md-3 col-form-label bold">Cognome Proprietario: *</label>
<div class="col-md-6">
<input type="text"  class="form-control"  name="cognome_proprietario" placeholder="cognome proprietario" value="<?php echo $cognome_proprietario;?>" />
</div>
</div>

<div class="form-group row"><label class="col-md-3 col-form-label bold">Nome Proprietario: *</label>
<div class="col-md-6"><input type="text" class="form-control"  name="nome_proprietario" placeholder="nome proprietario" value="<?php echo $nome_proprietario;?>" /> <br />
</div>
</div>

<div class="form-group row"><label class="col-md-3 col-form-label bold">Provincia proprietario *</label>
<div class="col-md-6">
<select  name="provincia_pro" class="form-control provincia_pro">
<option value="<?php echo $id_prov_pro;?>" selected="selected"><?php echo $provincia_pro;?></option>
<?php
$row= $db->selectAll('province', null, ' nomeprovincia asc ');

foreach($row as $r){

$idprovincia=$r['id'];
$nomeprovincia=$r['nomeprovincia'];

?><option value="<?php echo $idprovincia;?>" ><?php echo $nomeprovincia;?></option>
<?php
 }
?>
</select>
</div>
</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">Comune proprietario *</label>
<div class="col-md-6">
<select name="comune_pro" class="comune_pro form-control">
<option value="<?php echo $id_com_pro;?>" selected="selected"><?php echo $comune_pro;?></option>
</select>
</div>
</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">Indirizzo Proprietario: *</label>
<div class="col-md-6"><input class="form-control" type="text"  name="indirizzo_pro" placeholder="indirizzo proprietario" value="<?php echo $indirizzo_pro;?>" />
</div>
</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">Cap Proprietario: *</label>
<div class="col-md-6"><input class="form-control" type="text"  name="cap_pro" placeholder="cap proprietario" value="<?php echo $cap_pro;?>" />
</div>
</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">E-mail Proprietario: *</label>
<div class="col-md-6"><input class="form-control" type="text"  name="email_pro"  value="<?php echo $email_pro;?>" />
</div>
</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">PEC Proprietario: *</label>
<div class="col-md-6"><input class="form-control" type="text"  name="pec_pro"  value="<?php echo $pec_pro;?>" />
</div>
</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">Codice Fiscale Proprietario: *</label>
<div class="col-md-6"><input class="form-control" type="text"  name="cod_pro" placeholder="codice fiscale" value="<?php echo $cod_pro;?>" />
</div>
</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">Telefono Proprietario: *</label>
<div class="col-md-6"><input  class="form-control" type="text"  name="tel_pro" placeholder="telefono" value="<?php echo $tel_pro;?>" />
</div>
</div>




	<input type="hidden" value="<? echo $id;  ?>"  name="id" />


	<!-- Form actions -->
								<div class="form-actions">
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-check-circle"></i> Salva
									</button>
									<a  class="btn btn-default" href="index.php?req=mod_pro" >
								<i class="fa fa-arrow-left"></i>TORNA A ELENCO PROPRIETARI
								</a>
								</div>
								<!-- // Form actions END -->


						</div>
						<!-- // Widget END -->
					</div>
				</form>
				<!-- // Form END -->

	<?php
	break;

default:

$sql="select * from fatture_n where nome_proprietario != 'null' and cognome_proprietario !='null'  and num >0";

 Utility::getEscape($_GET);

if ($_GET['id_struttura']!='' ){
$id_struttura=$_GET['id_struttura'];
 $sql.=" and id_struttura = '$id_struttura' ";

Utility::array_push_associative($search, array('id_struttura'=>$_GET['id_struttura']));

}
if($_GET['proprietario']!=''){

$proprietario=$_GET['proprietario'];
 $sql.=" and LOWER(cognome_proprietario) like LOWER('%$proprietario%') ";
 Utility::array_push_associative($search, array('proprietario'=>$_GET['proprietario']));
}
if ($_GET['num_scheda']!='' ){
$num_scheda=$_GET['num_scheda'];
 $sql.=" and num = '$num_scheda' ";

Utility::array_push_associative($search, array('num_scheda'=>$_GET['num_scheda']));

}
$sql.=" order by cognome_proprietario asc ";
?>

<!-- heading -->
<h4 class="innerAll margin-none bg-white">Elenco proprietari</h4>
<div class="portlet-body form">
 <form class="horizontal-form" action="index.php" method="get" enctype="multipart/form-data">
 <div class="form-body">

 <div class="form-group row">
<label class="col-md-4 col-form-label bold">Proprietario:</label>
<div class="col-md-8">
   <input type="text" name="proprietario" class="form-control" >

</div>
</div>
 <div class="form-group row">
<label class="col-md-4 col-form-label bold">Clinica:</label>
<div class="col-md-8">
   <select name="id_struttura" class="bs-select form-control struttura" data-live-search="true" data-size="8">
<option value="<?php echo $id_struttura;?>" selected><?php echo $nome_struttura;?></option>
<?php
$row= $db->selectAll('admin', null, ' nome asc ');
$p= new geo();
foreach($row as $r){

$idstruttura=$r['id'];
$nomestruttura=$r['nome'];
$nomeprovincia = $r['provincia'];

?><option value="<?php echo $idstruttura;?>" ><?php echo $nomestruttura . ' ' . $nomeprovincia;?></option>
<?php
 }
?>
</select>
</div>
</div>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Numero Scheda:</label>
<div class="col-md-8">
	<input type="text" name="num_scheda" class="form-control" >

</div>
</div>
<input type="hidden" name="req" value="mod_pro" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
								  <a href="index.php?req=mod_pro"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>


<?php






$param=Utility::getSearch($_GET);
$param2=Utility::getSearch2($_GET);
$itemsPerPage = 20;
$row = $db->paginaSql($sql, $itemsPerPage);



$totalItems = $db->tot_records;

$currentPage = $db->current_page;


$urlPattern = './index.php?req=mod_pro&page=(:num)'.$param.'';
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
    <tr>
	 <th>
Proprietario
    </th>

    	 <th>
Clinica
    </th>
		<th>
Num Scheda
 </th>

     <th>
  Modifica
  </th>


    </tr>
   </thead>
   <tbody>
<?php

$cl=new Clear();


foreach($row as $r){



	$id_pro= $r['id_proprietario'];
  $id_struttura=$r['id_struttura'];
		   $nome_struttura=$db->getCampo('admin', 'nome', array('id'=>$id_struttura));
		   	$nome_proprietario = $r['nome_proprietario'];
 		$cognome_proprietario = $r['cognome_proprietario'];


      $anno_s=$r['anno'];
			$num_scheda=$r['num'];

?>
<tr class="gradeA">

    <td>
  <?php echo $cognome_proprietario.' '.$nome_proprietario;?>
  </td>
      <td>
  <?php echo $nome_struttura;?>
  </td>
	<td>
<?php echo $num_scheda.'/'.$anno_s;?>
</td>
         <td>


<a class="btn btn-primary" href="index.php?req=mod_pro&subreq=mod_dati_pro&id=<?php echo $id_pro;?>" >
			<span><i class="fa fa-edit"></i></span></a>


        </td>
   </tr>
    <?php

}

?>
</tbody>
</table>
<?php

  echo $paginator;

}
?>
</div>

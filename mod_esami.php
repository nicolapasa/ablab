<?php
if($livello !='administrator' ) header("Location: index.php?req=accesso_negato");
switch ($subreq){
	case 'mod_esa':


		$id= (int)$_GET['id'];


		$row= $db->selectAll('esami_cat', array('id'=>$id));


		if(count($row)>0){

			foreach($row as $r){



				$id_cat=$r['id_cat'];

	$nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$id_cat));
				$prezzo=$r['prezzo'];
				$prezzo_s=$r['prezzo_service'];
				$prezzo_pro=$r['prezzo_pro'];
				$nome_=$r['nome'];
				$abbr=$r['abbr'];
				$eliminato=$r['eliminato'];


			}
		}


		?>
	<form class="form-horizontal" id="form-nm"
					enctype='multipart/form-data' action="save.php" method="post"
					autocomplete="off">

		<div class="portlet light bordered lilla">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-red-sunglo"></i>
                                        <span class="caption-subject bold uppercase">
										Modifica di un esame</span>
                                    </div>

                                </div><!--title-->
                                <div class="portlet-body form">





	<div class="form-group"><label class="col-md-4 control-label">Nome dell'esame completo (come appare nel software)</label>
		<div class="col-md-8">
		<textarea class="form-control" name="nome"><?php echo $nome_;?></textarea>
		</div></div>
		<div class="form-group"><label class="col-md-4 control-label">Nome abbreviato (come appare in esportazione e scheda)</label>
		<div class="col-md-8">
		<textarea  class="form-control" name="abbr"><?php echo $abbr;?></textarea>
		</div></div>
			<div class="form-group"><label class="col-md-4 control-label">Prezzo per clinica (solo numeri, se decimali mettere . al posto della virgola)</label>
		<div class="col-md-8">
		<input class="form-control" name="prezzo" value="<?php echo $prezzo;?>" />
		</div></div>
		<div class="form-group"><label class="col-md-4 control-label">Prezzo per proprietari (solo numeri, se decimali mettere . al posto della virgola)</label>
		<div class="col-md-8">
		<input class="form-control" name="prezzo_pro" value="<?php echo $prezzo_pro;?>" />
		</div></div>
			<div class="form-group"><label class="col-md-4 control-label">Prezzo per service (solo numeri, se decimali mettere . al posto della virgola)</label>
		<div class="col-md-8">
		<input class="form-control" name="prezzo_s" value="<?php echo $prezzo_s;?>" />
		</div></div>
		<div class="form-group"><label class="col-md-4 control-label">Macrocategoria associata:</label>
<div class="col-md-8">
<select class="form-control" name="id_cat" >
<option value="<?php echo $id_cat;?>" selected><?php echo $nome_cat;?></option>
<?php
$row= $db->selectAll('categorie', null, ' id asc ');
foreach($row as $r){

	echo '<option value="'.$r['id'].'" >'.$r['nome'].' </>';

}
?>
</select>

</div>
</div>
<div class="form-group">
<label class="col-md-4 control-label">Esame eliminato:</label>
<div class="col-md-8">
<select class="form-control" name="eliminato" >
<option value="<?php echo $eliminato;?>" selected><?php echo $eliminato;?></option>

<option value="S" >SI</option>

<option value="" >NO</option>
</select>

</div>
</div>
	<!--
	<div class="form-group"><label class="col-md-4 control-label">Primo Esame del Profilo (per i profili diagnostici completi)</label>
		<div class="col-md-8">

		<select name="esame1" class="form-control">
<option value="<?php echo $esame1;?>" selected><?php echo $nome_esame1;?></option>
<?php
$row= $db->selectAll('esami_cat', null, ' id asc ');
foreach($row as $r){

	echo '<option value="'.$r['id'].'" >'.$r['abbr'].' </>';

}
?>
</select>
		</div></div>

	<div class="form-group"><label class="col-md-4 control-label">Secondo Esame del Profilo (per i profili diagnostici completi)</label>
		<div class="col-md-8">

		<select name="esame2" class="form-control">
<option value="<?php echo $esame2;?>" selected><?php echo $nome_esame2;?></option>
<?php
$row= $db->selectAll('esami_cat', null, ' id asc ');
foreach($row as $r){

	echo '<option value="'.$r['id'].'" >'.$r['abbr'].' </>';

}
?>
</select>
		</div></div>

-->

	<input type="hidden" value="<? echo $id;  ?>"  name="id" />
<input type="hidden" value="<? echo $id_s;  ?>"  name="id_s" />
	<input type="hidden" value="mod_esa"  name="action" />
	<!-- Form actions -->
								<div class="form-actions">
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-check-circle"></i> Salva
									</button>
									<button type="button" class="btn btn-default">
										<i class="fa fa-times"></i> Cancel
									</button>
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
?>

<!-- heading -->
<h4 class="innerAll margin-none bg-white">Elenco macrocategorie ed esami</h4>
<div class="portlet-body form">
 <form class="horizontal-form" action="index.php" method="get" enctype="multipart/form-data">
 <div class="form-body">
 <div class="form-group row">
<label class="col-md-4 col-form-label bold">Categoria:</label>
<div class="col-md-8"><select  name="tipo"  class="form-control">
 <option value="" selected></option>
 <?php
 $sql="select * from categorie  order by id asc ";
 $row = $db->sqlquery($sql);

 foreach($row as $r){

 ?>
   <option value="<?php echo $r['id']; ?>" ><?php echo $r['nome'];?></option>

   <?php }?>
</select>
</div></div>
<input type="hidden" name="req" value="mod_esami" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
								  <a href="index.php?req=mod_esami"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>

<a class="btn btn-primary" href="index.php?req=mod_esami&subreq=mod_esa">nuovo esame </a>

<?php



	$sql="select * from esami_ordinati_v  ";

   Utility::getEscape($_GET);
$itemsPerPage = 20;
$disabled='disabled';
if ($_GET['tipo']!='' ){
	$tipo_cat=$_GET['tipo'];
	 $sql.=" where id_cat = '$tipo_cat' ";
$itemsPerPage = 100;
	Utility::array_push_associative($search, array('tipo'=>$_GET['tipo']));
$disabled='';
}

$sql.=" order by id_cat, ord asc ";
$param=Utility::getSearch($_GET);
$param2=Utility::getSearch2($_GET);

$row = $db->paginaSql($sql, $itemsPerPage);



$totalItems = $db->tot_records;

$currentPage = $db->current_page;


$urlPattern = './index.php?req=mod_esami&page=(:num)'.$param.'';
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
<button <?php echo $disabled;?> class="update_ordine_esami btn btn-lg blue"><i class='fa fa-check'>AGGIORNA</i></button>
 <table class="table table-bordered table-striped table-condensed flip-content" >
        <thead class="flip-content">
    <tr>


<th>
Posizione
</th>
	 <th>
Nome macrocategoria
    </th>
    	 <th>
Nome esame
    </th>
    	 <th>
Abbreviazione
    </th>
	 <th>
Prezzo Clinica
    </th>
  	 <th>
Prezzo Proprietario
    </th>
    	 <th>
Prezzo Service
    </th>
	<th>
Eliminato
	</th>
	<th>
 Elimina
  </th>
     <th>
  Modifica
  </th>


    </tr>
   </thead>
   <tbody>
<?php

$cl=new Clear();
$contaEsami=0;

foreach($row as $r){
	$r=$cl->pulisci($r);
$contaEsami++;

	$id_es= $r['id'];

				$id_cat=$r['id_cat'];
        $ord=$r['ord'];
	$nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$id_cat));
				$prezzo=$r['prezzo'];
				$eliminato=$r['eliminato'];

				$nome=$r['nome'];
				$abbr=$r['abbr'];
				$prezzo_s=$r['prezzo_service'];
				$prezzo_pro=$r['prezzo_pro'];
?>
<tr class="gradeA">

<td>

<input name=ord id="<?php echo $id_es;?>" class="form-control ordine_esami" value="<?php echo $ord;?>" <?php echo $disabled;?>>

</td>
    <td>
  <?php echo $nome_cat;?>
  </td>
      <td>
  <?php echo $nome;?>
  </td>
        <td>
  <?php echo $abbr;?>
  </td>
    <td >
  <? echo $prezzo; ?>
    </td>
	  <td >
  <? echo $prezzo_pro; ?>
    </td>
      <td >
  <? echo $prezzo_s; ?>
    </td>
	<td >
  <? echo $eliminato; ?>
    </td>
	<td>
	<a class="btn btn-primary elimina_mod_esame" id="<?php echo $id_es;?>">
			<span><i class="fa fa-trash"></i></span></a>

 </td>
<td>
<a class="btn btn-primary" href="index.php?req=mod_esami&subreq=mod_esa&id=<?php echo $id_es;?>" >
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
<input type="hidden" id="contaEsami" value="<?php echo $contaEsami;?>" />
</div>

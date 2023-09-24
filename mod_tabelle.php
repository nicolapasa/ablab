<?php
if($livello !='administrator' ) header("Location: index.php?req=accesso_negato");
switch ($subreq){

		case 'add_tab':

		$tab=$_GET['tab'];
		$id=$_GET['id'];

		$row=$db->selectAll($tab, array('id'=>$id));


		foreach($row as $r){

			switch ($tab){
		case 'province':
			$value=$r['nomeprovincia'];
			$sigla=$r['siglaprovincia'];
		break;
			case 'comuni':
			$value=$r['nomecomune'];
			$id_prov=$r['idprovincia'];
			$nome_prov=$db->getCampo('province', 'nomeprovincia', array('id'=>$id_prov));
		break;
			case 'razza':
				$value=$r['nome'];
					$id_specie=$r['id_specie'];
			$nome_specie=$db->getCampo('specie', 'nome', array('id'=>$id_specie));
				break;
		case 'firme':
		$value=$r['value'];
		break;
		case 'tabelle_campi':
		$value=$r['value'];
		break;
		case 'tabella_legende':
		$tipo=$r['tipo'];
		$value=$r['testo'];
		break;
		default:
		$value=$r['nome'];

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
									Aggiungi/modifica campo in tabella <?php echo $tab;?></span>
                                    </div>

                                </div><!--title-->







                         <div class="portlet-body form">
	<?php
     if($tab=='razza'){
	?>

	<div class="form-group">
			<label class="col-md-4 control-label"> Specie</label>
		<div class="col-md-8">
		<select name="id_specie" class="form-control">
		<option value="<?php echo $id_specie;?>" selected="selected"><?php echo $nome_specie;?></option>
<?php
$row= $db->selectAll('specie', null, ' nome asc ');

foreach($row as $r){



?><option value="<?php echo $r['id'];?>" ><?php echo $r['nome'];?></option>
<?php
 }
?>
</select>
		</div></div>
	 <?php }


     if($tab=='comuni'){
	?>

	<div class="form-group">
			<label class="col-md-4 control-label"> Provincia</label>
		<div class="col-md-8">
		<select name="id_prov" class="form-control">
		<option value="<?php echo $id_prov;?>" selected="selected"><?php echo $nome_prov;?></option>
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
		</div></div>
	 <?php }?>
	 <?php
      if($tab=='tabella_legende'){
 	?>

 	<div class="form-group">
 			<label class="col-md-4 control-label"> Tipo </label>
 		<div class="col-md-8">
 		<select name="tipo" class="form-control">
 		<option value="<?php echo $tipo;?>" selected="selected"><?php echo $tipo;?></option>
<option value="ANTIBIOGRAMMA" >ANTIBIOGRAMMA</option>
<option value="ANTIMICOGRAMMA" >ANTIMICOGRAMMA</option>
<option value="MIC" >MIC</option>
 </select>
 		</div></div>
 	 <?php }
	 ?>



			<div class="form-group">
			<label class="col-md-4 control-label">Valore</label>
		<div class="col-md-8">
		<textarea class="form-control"  name="value" ><?php echo $value;?></textarea
		</div></div>
	<?php

if($tab=='province'){
	?>

	<div class="form-group">
			<label class="col-md-4 control-label">Sigla Provincia</label>
		<div class="col-md-8">
		<input class="form-control"  name="sigla" value="<?php echo $sigla;?>" />
		</div></div>








	<?php


}


?>




	<input type="hidden" value="<? echo $id;  ?>"  name="id" />
<input type="hidden" value="<? echo $tab;  ?>"  name="tab" />
	<input type="hidden" value="mod_tab"  name="action" />
	<!-- Form actions -->
								<div class="form-actions">
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-check-circle"></i> Salva
									</button>
									<a href="index.php?req=mod_tabelle&tab=<?php echo $tab;?>" class="btn btn-default">
										<i class="fa fa-times"></i> Torna indietro
									</a>
								</div>


							</div>
						</div>

				</form>
				<!-- // Form END -->

<?php



		break;

default:

	$tab=$_GET['tab'];
	if($tab=='') $tab='specie';

	?>
<!-- heading -->
<h4 class="innerAll margin-none bg-white">Gestione tabelle <?php echo $tab;?></h4>
<a class="btn btn-default" href="index.php?req=mod_tabelle&tab=specie">Specie/Animale </a>
<a class="btn btn-default" href="index.php?req=mod_tabelle&tab=razza">Razze </a>
<a class="btn btn-default" href="index.php?req=mod_tabelle&tab=organo">Organi </a>
<a class="btn btn-default" href="index.php?req=mod_tabelle&tab=province">Province </a>
<a class="btn btn-default" href="index.php?req=mod_tabelle&tab=comuni">Comuni</a>
<a class="btn btn-default" href="index.php?req=mod_tabelle&tab=firme">Firme </a>
<a class="btn btn-default" href="index.php?req=mod_tabelle&tab=tabelle_campi">Antibiogramma/Antimicrogramma/MIC </a>
<a class="btn btn-default" href="index.php?req=mod_tabelle&tab=tabella_legende">Legende Tabelle  </a>
<div class="portlet-body form">
 <form class="horizontal-form" action="index.php" method="get" enctype="multipart/form-data">
 <div class="form-body">
<!--
se tab comuni select provincia
altrimenti ricerca per nome
se tab razza ricerca per specie
-->
<?php
if($tab=='razza'){

	?>
<div class="form-group row"><label class="col-md-3 col-form-label bold">Cerca per Animale</label>
<div class="col-md-6">
<select  name="specie" class="form-control ">
<option value="<?php echo $idspecie;?>" selected="selected"><?php echo $nomespecie;?></option>
<?php
$row= $db->selectAll('specie', null, ' nome asc ');

foreach($row as $r){
	//$r=$cl->pulisci($r);
$idspecie=$r['id'];
$nomespecie=utf8_encode($r['nome']);

?><option value="<?php echo $idspecie;?>" ><?php echo $nomespecie;?></option>
<?php
 }
?>
</select>
</div>
</div>


	<?php


}
if($tab=='comuni'){
?>
<div class="form-group row"><label class="col-md-3 col-form-label bold">Cerca per provincia</label>
<div class="col-md-6">
<select  name="provincia" class="form-control">
<option value="" selected="selected"></option>
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



<?php


}

	?>

	<div class="form-group row">
<label class="col-md-4 col-form-label bold">Ricerca con testo :</label>
<div class="col-md-8"><input type="text" class="form-control"  name="testo" placeholder="cerca..."  />
</div>
</div>


<input type="hidden" name="req" value="mod_tabelle" />
<input type="hidden" name="subreq" value="mod_tab" />
<input type="hidden" name="tab" value="<?php echo $tab;?>" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
								  <a href="index.php?req=mod_tabelle&subreq=mod_tab&tab=<?php echo $tab;?>"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>

<br><br>
<a class="btn btn-primary" href="index.php?req=mod_tabelle&subreq=add_tab&tab=<?php echo $tab;?>">nuova voce </a>
<br>
<?php



	$sql="select * from $tab where id !=''  ";

   Utility::getEscape($_GET);

if ($_GET['specie']!='' ){
	$id_specie=$_GET['specie'];
	 $sql.=" and id_specie = '$id_specie' ";

	Utility::array_push_associative($search, array('specie'=>$_GET['specie']));

}
if ($_GET['provincia']!='' ){
	$provincia=$_GET['provincia'];
	 $sql.=" and idprovincia = '$provincia' ";

	Utility::array_push_associative($search, array('provincia'=>$_GET['provincia']));

}
if ($_GET['testo']!='' ){
	$testo=$_GET['testo'];
		switch ($tab){
		case 'province':

				 $sql.=" and LOWER(nomeprovincia) like LOWER('%$testo%') ";
		break;
			case 'comuni':

			 $sql.=" and LOWER(nomecomune) like LOWER('%$testo%') ";
		break;

		case 'firme':
 $sql.=" and LOWER(value) like LOWER('%$testo%') ";
		break;
		case 'tabelle_campi':
 $sql.=" and LOWER(value) like LOWER('%$testo%') ";
		break;
		default:
 $sql.=" and LOWER(nome) like LOWER('%$testo%') ";

	}



	Utility::array_push_associative($search, array('testo'=>$_GET['testo']));

}

switch ($tab){
		case 'province':
			$sql.=" order by nomeprovincia asc ";

		break;
			case 'comuni':

			 $sql.=" order by nomecomune asc ";
		break;

		case 'firme':

 $sql.=" order by value asc ";
		break;
		case 'tabelle_campi':

  $sql.=" order by value asc ";
		break;
		case 'tabella_legende':

	$sql.=" order by tipo asc ";
		break;
		default:

  $sql.=" order by nome asc ";

	}

$param=Utility::getSearch($_GET);
$param2=Utility::getSearch2($_GET);
$itemsPerPage = 20;
$row = $db->paginaSql($sql, $itemsPerPage);



$totalItems = $db->tot_records;

$currentPage = $db->current_page;


$urlPattern = './index.php?req=mod_tabelle&page=(:num)'.$param.'';
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
Nome voce
    </th>

     <th>
  Modifica
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


	$id_es= $r['id'];
	switch ($tab){
		case 'province':
			$value=$r['nomeprovincia'];
		break;
			case 'comuni':
			$value=$r['nomecomune'];
		break;

		case 'firme':
		$value=$r['value'];
		break;
		case 'tabelle_campi':
		$value=$r['value'];
		break;
		case 'tabella_legende':
		$value=$r['tipo'];
		break;
		default:
		$value=$r['nome'];

	}


?>
<tr class="gradeA">

    <td>
  <?php echo $value;?>
  </td>

         <td>


<a class="btn btn-primary" href="index.php?req=mod_tabelle&subreq=add_tab&tab=<?php echo $tab;?>&id=<?php echo $id_es;?>" >
			<i class="fa fa-edit"></i></a>


        </td>
		    <td>

   <input type="hidden" value="<?php echo $tab;?>" >
 <input type="hidden" value="<?php echo $id_es;?>" >
<a class="btn btn-primary delete_tab"  >
			<i class="fa fa-trash"></i></a>


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
<?php

	break;

 }

?>

<?php
$p= new geo();
$id=$_GET['id'];

$row=$db->selectAll('fatture_n', array('id'=>$id));

foreach($row as $r){


$id_struttura = $r['id_struttura'];
	$id_proprietario = $r['id_proprietario'];
	$id_animale = $r['id_animale'];
	$tipo = $r['tipo'];
	$nome_tipo= $db->getCampo('esami_cat', 'nome', array('id'=>$tipo));
	$id_cat=$db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo));
	$num=$r['num'];
	$urgente = $r['urgente'];
	//$margini = $r['margini'];
	$totale=$r['totale'];
    $seconda_refertazione=$r['seconda_refertazione'];
	$punti=  $r['punti'];
	$note=  $r['note'];
 $allegati=(int) count($db->selectAll('allegati', array('id_scheda'=>$id)));

	$data = Utility::getTime($r['time']);
	$destinatario = $r['destinatario'];
    $num_referto=$r['num_referto'];

	$qta=$r['qta'];

}
$row = $db->selectAll('admin', array('id'=>$id_struttura));

foreach($row as $r){

	$nome = $r['nome'];

}

$row = $db->selectAll('proprietari', array('id'=>$id_proprietario));


foreach($row as $r){

	  $nome_proprietario = $r['nome_proprietario'];
 		$cognome_proprietario = $r['cognome_proprietario'];
   	$medico_ref=$r['medico_ref'];

}

$row = $db->selectAll('animale', array('id_scheda'=>$id));

$a=new Animale();

foreach($row as $r){

	$idrazza = $r['razza'];
 		$razza=$r['razza'];
 		$idspecie = $r['specie'];
 		$specie=($a->getAnimal($idspecie, 'specie'));
 		$idorgano = $r['organo'];
 		$organo=$r['organo'];
	$sesso = $r['sesso'];
	$integrita = $r['integrita'];

	$anamnesi = trim(ucfirst(strip_tags($r['anamnesi'])));
	$anamnesi=$r['anamnesi'];
	//$anamnesi= str_replace(array("\n","\r"), "", $anamnesi);
	$eta=$r['eta'];
	$nome_animale=$r['nome'];

}
?>

<form
				enctype='multipart/form-data' action="save_esame.php" method="post"
				autocomplete="off">


  <div class="portlet light bordered lilla">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-cross font-blue-hoki"></i>
                                                    <span class="caption-subject  bold uppercase">

													Modifica Scheda <?php echo $num;?></span>

                                                </div>

                                            </div>

 <div class="portlet-body form">

	<div class="row">

		<div class="col-md-6">


			 <div class="form-group row">
						<label class="col-md-3 col-form-label bold">Esame: </label>
                 <div class="col-md-9">


		<select name="tipo" class="form-control bs-select" data-live-search="true"  >
 <option value="<?php echo $tipo;?>" selected=selected>  <?php echo $nome_tipo; ?></option>

<?php
foreach($db->selectAll('esami_cat', null, ' id asc ') as $r1){

	echo '<option value="'.$r1['id'].'" >'.$r1['abbr'].'</option>';

}

?>
 </select>
		</div>
		</div>


		</div>
	<div class="col-md-6">


			 <div class="form-group row">
						<label class="col-md-3 col-form-label bold">Destinatario: </label>
                 <div class="col-md-9">


		<select name="destinatario" class="form-control"  >
 <option value="<?php echo $destinatario;?>" selected=selected>  <?php echo $destinatario; ?></option>

 <option value="clinica">clinica</option>
 <option value="proprietario">proprietario</option>
 </select>
		</div>
		</div>


		</div>
		</div><!--fine row-->
			<div class="row">
<div class="col-md-6">
			 <div class="form-group row">
						<label class="col-md-4 col-form-label bold">Struttura: </label>
                 <div class="col-md-8">

			 <select  name="id_struttura" class="form-control bs-select" data-live-search="true" >
 <option value="<?php echo $id_struttura;?>" selected=selected>  <?php echo $nome; ?></option>

<?php
foreach($db->selectAll('admin', array('livello'=>'struttura'), ' nome asc ') as $r1){

	echo '<option value="'.$r1['id'].'" >'.$r1['nome'].'</option>';

}

?>
 </select>

		</div>
		</div>
				</div>
		<div class="col-md-6">
			 <div class="form-group row">
						<label class="col-md-4 col-form-label bold "> Proprietario: </label>
                 <div class="col-md-8">


		<select  name="id_proprietario" class="form-control   bs-select" data-live-search="true"  >
 <option value="<?php echo $id_proprietario;?>" selected=selected>  <?php echo mb_strtolower($nome_proprietario).' '.mb_strtolower($cognome_proprietario); ?></option>

<?php
foreach($db->selectAll('proprietari', null, ' cognome_proprietario, nome_proprietario asc ') as $r1){

	echo '<option value="'.$r1['id'].'" >'.mb_strtolower($r1['nome_proprietario']).' '.mb_strtolower($r1['cognome_proprietario']).'</option>';

}

?>
 </select>
		</div>
		</div>
				</div>


		</div><!--fine row-->
	<div class="row">
		<div class="col-md-3">
				 <div class="form-group row">
							<label class="col-md-4 col-form-label">Medico referente: </label>
	                 <div class="col-md-4">
	                    <input type="text" name="medico_ref" value="<?php echo $medico_ref;?>" >

					 </div>
					 </div>
	    </div>
	<div class="col-md-3">
			 <div class="form-group row">
						<label class="col-md-4 col-form-label bold">Prezzo: </label>
                 <div class="col-md-4">
                    <input type="text" name="totale" value="<?php echo $totale;?>" >

				 </div>
				 </div>
    </div>
    <div class="col-md-3">
			 <div class="form-group row">
			 <?php ($urgente=="s")? $check="checked" : $check=""; ?>
						<label class="col-md-4 col-form-label bold">Urgente: </label>
                 <div class="col-md-4">
                    <input type="checkbox" name="urgente" value="s" <?php echo $check;?>>

				 </div>
				 </div>
    </div>

	  <div class="col-md-3">
			 <div class="form-group row">
			 <?php ($seconda_refertazione=="s")? $check="checked" : $check=""; ?>
						<label class="col-md-4 col-form-label bold">Seconda refertazione: </label>
                 <div class="col-md-4">
                    <input type="checkbox" name="seconda_refertazione" value="s" <?php echo $check;?>>

				 </div>
				 </div>
    </div>
</div><!--fine row-->



			<div class="row">
		<div class="col-md-4">
			 <div class="form-group row">
						<label class="col-md-4 col-form-label bold">Specie: </label>
                 <div class="col-md-8">
				<select id="specie" name="specie" class="form-control specie">
<option value="<?php echo $idspecie;?>" selected="selected"><?php echo $specie;?></option>
<?php
$row= $db->selectAll('specie', null, ' id asc ');

foreach($row as $r){
	//$r=$cl->pulisci($r);
$id_specie=$r['id'];
$nomespecie=utf8_encode($r['nome']);

?><option value="<?php echo $id_specie;?>" ><?php echo $nomespecie;?></option>
<?php
 }
?>
</select>
		</div>
		</div>
			</div>
		<div class="col-md-4">
			 <div class="form-group row">
						<label class="col-md-4 col-form-label bold">Razza: </label>
                 <div class="col-md-8">
		<select id="razza" name="razza" class="razza form-control">
<option value="<?php echo $razza;?>" selected="selected"><?php echo $razza;?></option>
</select>
		</div>
		</div>
			</div>
		<div class="col-md-4">
			 <div class="form-group row">
						<label class="col-md-4 col-form-label bold">Organo: </label>
                 <div class="col-md-8">
		<select name="organo" class="form-control organo">
<option value="<?php echo $organo;?>" selected="selected"><?php echo $organo;?></option>
<?php
$row= $db->selectAll('organo', null, ' nome asc ');
if(count($row)>0){
foreach($row as $r){

$idorgano=$r['id'];
$nomeorgano=utf8_encode($r['nome']);

?><option value="<?php echo $nomeorgano;?>" ><?php echo $nomeorgano;?></option>
<?php
 }
}else{
	?><option value="" ></option><?php

}
?>
</select>
		</div>
		</div>
				</div>
		</div><!--fine row-->
			<div class="row">

		<div class="col-md-4">
			 <div class="form-group row">
						<label class="col-md-3 col-form-label bold">Sesso: </label>
                 <div class="col-md-9">
				<select  name="sesso" class="form-control">
<option value="<?php echo $sesso;?>" selected="selected"><?php echo $sesso;?></option>
<option value="Maschio">Maschio</option>
<option value="Femmina">Femmina</option>
<option value="Non applicabile">Non applicabile</option>
</select>

		        </div>
		     </div>
		</div>
		<div class="col-md-4">
			 <div class="form-group row">

                 <div class="col-md-4">
						<?php ($integrita=="intero")? $check="checked" : $check=""; ?>
						<label >
						<input  type="radio" name="integrita" value="intero"  <?php echo $check;?>  />I</label>
						<?php ($integrita=="castrato")? $check="checked" : $check=""; ?>
                        </div>
	              <div class="col-md-4">
					<label>
						<input  type="radio" name="integrita"  value="castrato"  <?php echo $check;?>  />C/S</label>
						</div>
		</div>
		</div>

		<div class="col-md-4">
		 <div class="form-group row">
						<label class="col-md-6 col-form-label bold">Età: </label>
                 <div class="col-md-6">
						<input  type="text" name="eta" class="form-control  "  value="<?php echo $eta; ?>"  id="" />
		</div>
		</div>
		</div>
		</div><!--fine row-->

					<div class="row">

		<div class="col-md-4">
			 <div class="form-group row">
						<label class="col-md-6 col-form-label bold">Nome Animale: </label>
                 <div class="col-md-6">
						<input  type="text" name="nome_animale" class="form-control  "  value="<?php echo $nome_animale; ?>"  id="" />
		</div>
		</div>
		</div>


<div class="col-md-4">
<div class="form-group row">
<label class="col-md-6 col-form-label bold">Numero referto precedente:</label>
<div class="col-md-6">
<input  class="form-control" name="num_referto" value="<?php  echo $num_referto;?>" />
</div>
</div>

			</div>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-6 col-form-label bold">Qta richiesta:</label>
<div class="col-md-6">
<input  class="form-control" name="qta" value="<?php  echo $qta;?>" />
</div>
</div>

			</div>
		</div>

		<div>
			 <div class="form-group row">
						<label class="col-md-3 col-form-label bold">Anamnesi: </label>
                 <div class="col-md-9">
						<textarea   name="anamnesi" class="form-control " ><?php echo $anamnesi; ?></textarea>
		</div>
		</div>

	</div>




<input type="hidden" value="<?php echo $id_animale;?>"  name="id_animale" />
<input type="hidden" value="<?php echo $id;?>"  name="id" />

<!-- Form actions -->
							<div class="form-actions">
								<button type="submit"  class="btn green-meadow">
									<i class="fa fa-save"></i>AGGIORNA
								</button>
                <a href="index.php?req=ric" class="btn btn-lg blue">
								<i class='fa fa-list'></i>Torna a Elenco Richieste
							</a>

							</div>
							<!-- // Form actions END -->


					</div>
					<!-- // Widget END -->
				</div>
			</form>

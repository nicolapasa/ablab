<form id="referto"
				enctype='multipart/form-data' action="save_referta.php" method="post"
				autocomplete="off">


  <div class="portlet light bordered lilla">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-cross font-blue-hoki"></i>
                                                    <span class="caption-subject  bold uppercase">

													Refertazione - Dati Comuni</span>

                                                </div>

                                            </div>

 <div class="portlet-body form">

<!-- parte intestazione -->
<div class="row">
<div class="col-md-3">
<div class="form-group row">
						<label class="col-md-6 col-form-label bold">Referto: </label>
                 <div class="col-md-6">
						<input  type="text" name="id_referto" class="form-control  "  value="<?php echo $id_referto; ?>"  id="" />
		</div>
		</div>

		</div>
		<div class="col-md-3">
			 <div class="form-group row">
						<label class="col-md-6 col-form-label bold">Data Arrivo: </label>
                 <div class="col-md-6">
						<input data-date-format="dd/mm/yyyy"  type="text" name="dataArrivo" class="form-control date-picker"  value="<?php echo $dataArrivo; ?>"   />
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

		<div class="col-md-6">


			 <div class="form-group row">
						<label class="col-md-3 col-form-label bold">Esame: </label>
                 <div class="col-md-9">


		<select name="tipo" class="form-control"  >
 <option value="<?php echo $tipo;?>" selected=selected>  <?php echo $nomeEsame; ?></option>

<?php
foreach($db->selectAll('esami_cat', null, ' id asc ') as $r1){

	echo '<option value="'.$r1['id'].'" >'.$r1['abbr'].'</option>';

}

?>
 </select>
		</div>
		</div>


		</div>
		<?php if ($livello=='administrator') { ?>
		<div class="col-md-6">
		<div class="form-group row">
				<label class="col-md-3 col-form-label bold">Veterinario referente:</label>
               <div class="col-md-9">
			   <input  type="text" name="medico_ref" class="form-control  "  value="<?php echo $medico_ref; ?>"  />
	
			   </div>
        </div>
</div>
<?php } else{

?>

<input  type="hidden" name="medico_ref" class="form-control  "  value="<?php echo $medico_ref; ?>"  />
<input  type="hidden" name="id_struttura" class="form-control  "  value="<?php echo $id_struttura;; ?>"  />
<?php

} ?>		


		</div><!--fine row-->
			<div class="row">

<?php if ($livello=='administrator') { ?>

<div class="col-md-6">
			 <div class="form-group row">
						<label class="col-md-4 col-form-label bold">Struttura: </label>
                 <div class="col-md-8">

			 <select  name="id_struttura" class="form-control" >
 <option value="<?php echo $id_struttura;?>" selected=selected>  <?php echo $struttura; ?></option>

<?php
foreach($db->selectAll('admin', array('livello'=>'struttura'), ' nome asc ') as $r1){

	echo '<option value="'.$r1['id'].'" >'.$r1['nome'].'</option>';

}

?>
 </select>

		</div>
		</div>
				</div>
				<?php }  ?>			
		<div class="col-md-6">
			 <div class="form-group row">
						<label class="col-md-4 col-form-label bold "> Proprietario: </label>
                 <div class="col-md-8">


		<select  name="id_proprietario" class="form-control  "  >
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
		<div class="col-md-4">
			 <div class="form-group row">
						<label class="col-md-3 col-form-label bold">Specie: </label>
                 <div class="col-md-9">
				<select id="specie" name="specie" class="form-control specie">
<option value="<?php echo $specie;?>" selected="selected"><?php echo $nomeSpecie;?></option>
<?php
$row= $db->selectAll('specie', null, ' id asc ');

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
			</div>
		<div class="col-md-4">
			 <div class="form-group row">
						<label class="col-md-3 col-form-label bold">Razza: </label>
                 <div class="col-md-9">
		<select id="razza" name="razza" class="razza form-control">
<option value="<?php echo $nomeRazza;?>" selected="selected"><?php echo $nomeRazza;?></option>
</select>
		</div>
		</div>
			</div>
		<div class="col-md-4">
			 <div class="form-group row">
						<label class="col-md-6 col-form-label bold">Organo: </label>
                 <div class="col-md-6">
		<select name="organo" class="form-control organo">
<option value="<?php echo $nomeOrgano;?>" selected="selected"><?php echo $nomeOrgano;?></option>
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
						<input  type="text" name="nome_a" class="form-control  "  value="<?php echo $nome_a; ?>"  id="" />
		</div>
		</div>
		</div>

<?php
if($id_cat==6 or $id_cat ==7 or $id_cat==8 or $tipo==22 or $tipo==17 or $tipo==34){

?>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-6 col-form-label bold">Numero referto precedente:</label>
<div class="col-md-6">
<input  class="form-control" name="ref_prec" value="<?php  echo $ref_prec;?>" />
</div>
</div>

			</div>
<?php  }?>
		</div><!--fine row-->

			 <div class="form-group row">
						<label class="col-md-3 col-form-label bold">Anamnesi: </label>
                 <div class="col-md-9">
						<textarea  style="text-align:left" name="anamnesi" class="form-control " rows="5" id="anamnesi"  disabled=disabled ><?php echo $anamnesi; ?></textarea>
		</div>
		</div>
		<?php
	//allegati
	$row= $db->selectAll('allegati', array('id_scheda'=>$id_scheda));
if(count($row)>0) {
   ?>
   		<div class="row">
<div class="col-md-3 bold">Sono presenti allegati:</div>
	<div class="col-md-9">

   <?php


foreach($row as $r){


$file = './upload/'.$r['file'];
?>
<a target="_blank" class="btn btn-primary" href="<?php echo $file;?>">
<span>Apri allegato</span></a>
<?php
}
?>

   		</div>

   		</div>
 <br>
<?php


}
   ?>

		<div class="form-group row">
<label class="col-md-3 col-form-label bold">Annotazioni:</label>
	<div class="col-md-9">
	<textarea  name="annotazioni" class="form-control"  rows="10"><?php echo $annotazioni;?></textarea>

	</div>


	</div>






		<input type="hidden" value="<?php echo $id_animale;?>"  name="id_animale" />
	<input type="hidden" value="<?php echo $id_scheda;?>"  name="id_scheda" />
<!-- l'id non è idreferto ma id della riga sulla tabella referti -->
<input type="hidden" value="<?php echo $id;?>"  name="id" />
<input type="hidden" value="<?php echo $step;?>"  name="step" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit"  class="btn green-meadow">
									<i class="fa fa-arrow-right"></i>SALVA E AVANTI
								</button>
								<a target="_blank" class="btn btn-default" href="print_referto.php?id=<?php echo $id;?>&tipo=admin&livello=<?php echo $livello;?>" >
								<i class="fa fa-print"></i>ANTEPRIMA STAMPA
								</a>
							<a  class="btn btn-default" href="index.php?req=ref" >
								<i class="fa fa-list"></i>TORNA A ELENCO REFERTI
								</a>
							</div>
							<!-- // Form actions END -->


					</div>
					<!-- // Widget END -->
				</div>
			</form>

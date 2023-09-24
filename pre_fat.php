<?php
$p= new geo();
$id=$_GET['id'];

$row=$db->selectAll('fatture_temp', array('id'=>$id));

foreach($row as $r){




$num=$r['num'];
$id_cliente= $r['id_cliente'];
$importo = $r['importo'];
$totale=$r['totale'];
$imponibile=$r['imponibile'];
$dest=$r['dest'];

$data = Utility::getTime($r['data']);
$anno=$r['anno'];
$pagata=$r['pagata'];
$sconto=$r['sconto'];
$spe_tra=$r['spe_tra'];
$imponibileT=$r['imponibile']+$spe_tra;
if($dest!='p'){
	//dati clinica
$row2 = $db->selectAll('admin', array('id'=>$id_cliente));

foreach($row2 as $r2){


	$mod_pag=$r2['mod_pag'];
	$iban=trim($r2['iban']);
		$pec=$r2['pec'];
		$coduni=$r2['cod'];
$abi=trim($r2['abi']);
$cab=trim($r2['cab']);
	$nome = $r2['nome'];
	$nominativo=$nome;
	$provincia = $r2['provincia'];
    $comune=$r2['comune'];
	if($r2['email_fatt']!=''){
	$email1=explode(';', $r2['email_fatt']);


	}
	else{
		$email1=explode(';', $r2['email']);
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
	$nome_proprietario = $r2['nome_proprietario'];
	$cognome_proprietario = $r2['cognome_proprietario'];
	$nominativo=$cognome_proprietario.' '.$nome_proprietario;
	$provincia_pro=$p->getProv($r2['provincia_pro']);
    $id_struttura=$r2['id_struttura'];
	$pec=$r2['pec_pro']; //controllo se email valida
$nome=$db->getCampo('admin', 'nome', array('id'=>$id_struttura));
$provincia = $p->getProv($db->getCampo('admin', 'provincia', array('id'=>$id_struttura)));
}
}
}



?>

<form
				enctype='multipart/form-data' action="save_fatture.php" method="post"
				autocomplete="off">


  <div class="portlet light bordered lilla">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-cross font-blue-hoki"></i>
                                                    <span class="caption-subject  bold uppercase">

													Anteprima Fattura <?php echo $num.'/'.$anno;?></span>

                                                </div>

                                            </div>

 <div class="portlet-body form">


 <?php
 //controllo se manca cod o pec
 if($dest=='proprietario' and $pec==''){

	 ?>
	 <div class="alert alert-red">
	 Attenzione PEC mancante. La Fattura Elettronica verrà inoltrata
al sistema senza la PEC del proprietario.
	 </div>

	 <?php


 }

  if($dest!='proprietario' and ($pec=='' and $coduni=='')){

	?>
	 <div class="alert alert-danger">
	 Attenzione PEC e CODICE UNIVOCO mancanti. La Fattura Elettronica verrà inoltrata
al sistema senza la PEC e il CODICE UNIVOCO.
	 </div>

	 <?php





  }
 ?>

		<div class="row">
	<div class="col-md-4">
			 <div class="form-group row">
						<label class="col-md-6 col-form-label bold">Fattura a: </label>
                 <div class="col-md-6">
                   <?php
               if($dest=='p') echo 'PROPRIETARIO';
			       if($dest!='p') echo 'CLINICA';
				  ?>

				 </div>
				 </div>
    </div>
		<div class="col-md-4">
			 <div class="form-group row">
						<label class="col-md-6 col-form-label bold">Clinica/proprietario: </label>
                 <div class="col-md-6">
                   <?php echo $nominativo;?>

				 </div>
				 </div>
    </div>
	<?php if($dest=='p'){
		?>
		<div class="col-md-4">
			 <div class="form-group row">
						<label class="col-md-6 col-form-label bold">Clinica referente: </label>
                 <div class="col-md-6">
                   <?php echo $nome;?>

				 </div>
				 </div>
    </div>
		<?php

	}?>

	</div>
	<div class="row">
	<div class="col-md-3">
			 <div class="form-group row">
						<label class="col-md-4 col-form-label bold">Totale (ivato): </label>
                 <div class="col-md-4">
                    <input type="text" name="importo" value="<?php echo $importo;?>"  disabled>

				 </div>
				 </div>
    </div>
	<div class="col-md-3">
			 <div class="form-group row">
						<label class="col-md-4 col-form-label bold">Imponibile: </label>
                 <div class="col-md-4">
                    <input type="text" name="imponibile" value="<?php echo $imponibile;?>" disabled>

				 </div>
				 </div>
    </div>



</div><!--fine row-->





					<div class="row">
<div class="col-md-3">
			 <div class="form-group row">
						<label class="col-md-4 col-form-label bold">Sconto applicato: </label>
                 <div class="col-md-4">
                    <input type="text" name="sconto" class="form-control val_temp" value="<?php echo $sconto;?>" id="sconto_tmp">

				 </div>
				 </div>
    </div>
		<div class="col-md-4">
			 <div class="form-group row">
						<label class="col-md-6 col-form-label bold">Spese trasporto: </label>
                 <div class="col-md-6">
						<input  type="text" name="spe_tra" class="form-control val_temp"  value="<?php echo $spe_tra;?>"  id="spe_tra_tmp" />
		</div>
		</div>
		</div>

	<div class="col-md-4">
			 <div class="form-group row">
						<label class="col-md-6 col-form-label bold">Data fattura: </label>
                 <div class="col-md-6">
						<input  type="text" name="data"  data-date-format="dd/mm/yyyy" class="form-control  date-picker"  value="<?php echo Utility::getTime($data_fatt); ?>"   />
		</div>
		</div>
		</div>


		</div>

	<?php

	if($mod_pag=='riba'){

		?>
							<div class="row">
<div class="col-md-3">
			 <div class="form-group row">
						<label class="col-md-4 col-form-label bold">Abi: </label>
                 <div class="col-md-4">
                    <input type="text" name="abi" value="<?php echo $abi;?>" disabled>

				 </div>
				 </div>
    </div>
	<div class="col-md-3">
			 <div class="form-group row">
						<label class="col-md-4 col-form-label bold">Cab: </label>
                 <div class="col-md-4">
                    <input type="text" name="cab" value="<?php echo $cab;?>" disabled>

				 </div>
				 </div>
    </div>

		</div>
		<?php



	}


	?>

 <input type="hidden" value="<?php echo $dest;?>"  name="dest" id="dest_temp" />
<input type="hidden" id="id_tmp" value="<?php echo $id;?>"  name="id_temp" />

<input type="hidden" value="<?php echo $imponibile;?>"  name="imponibile" id="impo_temp" />
<input type="hidden" value="<?php echo $importo;?>"  name="importo" id="importo_temp" /> 
<!-- Form actions -->
							   <div class="form-actions">
									<button type="submit"  class="btn green-meadow">
									<i class="fa fa-save"></i>SALVA
								</button>

								<a target="_new" class="btn btn-primary" href="view_fat.php?id=<?php echo $id;?>">
								<i class="fa fa-print"></i>ANTEPRIMA STAMPA
								</a>

									<a  class="btn btn-default" href="index.php?req=fatturazione" >
								<i class="fa fa-arrow-left"></i>TORNA A FATTURAZIONE
								</a>

							</div>
							<!-- // Form actions END -->


					</div>
					<!-- // Widget END -->
				</div>
			</form>

 <?php
//ricevo la scheda

 if (isset($_SESSION['scheda'])){


 	$row = $db->selectAll('schede', array('id'=>$_SESSION['scheda']));

 	foreach($row as $r){

 	 	$tipo = $r['tipo'];

 	    $note= $r['note'];
        $num_referto=$r['num_referto'];
		$allegati=$r['allegati'];
		$id_cat=(int) $db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo));


		 $id_struttura=$r['id_struttura'];
 		$nome_struttura= $db->getCampo('admin', 'nome', array('id'=>$id_struttura));

 	}
 }
?>


	<form id="sec2"
				enctype='multipart/form-data' action="save_esami.php" method="post"
				autocomplete="off">


  <div class="portlet light bordered lilla">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-cross font-blue-hoki"></i>
                                                    <span class="caption-subject  bold uppercase">

												 Allegati</span>

                                                </div>

                                            </div>

 <div class="portlet-body form">

<div class="form-group">

<input name="allegati[]" id="pci" type="file" multiple=""/>

 </div>
 <span class="label label-info ">Allegati (puoi selezionare più files insieme, tieni premuto il tasto CTRL mentre selezioni)
 </span>
	<!-- Alert -->
	<div id="msg" class="alert alert-danger">

	</div>


<div class="progress">
                                        <div class="progress-bar progress-bar-success"
										role="progressbar" aria-valuenow="0" aria-valuemin="0"
										aria-valuemax="100" style="width: 0%">
                                           <div id="status">0 %</div>
                                        </div>
                                    </div>
 </div>
<div class="alert alert-custom">

	<strong>Nota bene:</strong><br>	Non caricare file grandi e non superare il numero di 3 allegati
	ad esame attendere il caricamento prima di proseguire nell'inserimento dell'esame.
	Quando la barra qui sopra sarà interamente riempita allora il caricamento sarà completo.<br>
  	<strong>Nota bene:</strong>Premi una sola volta il tasto SALVA.
</div>
<?php

//solo per microbiologia ambientale
if($tipo>38 and  $tipo <42){
?>
<div class="form-group row">
<label class="col-md-4 control-label">Note</label>
	<div class="col-md-8">
	<textarea class="form-control" name="note" rows="3" ><?php echo $note;?></textarea>
	</div></div>
	 <div class="alert alert-custom">
Indicate la sede di prelievo dei campioni ambientali inviati</div>
<!-- // Alert END -->

<?php
}
//solo esami speciali
//IMMUNOISTOCHIMICA (tutti i tipi) BIOLOGIA MOLECOLARE (tutti i tipi) RICHIESTA COPIA VETRINI (tutti i tipi)
//E degli esami di microbiologia ANTIMICOGRAMMA, ANTIBIOGRAMMA EXTRA E MIC AEROBI E MIC ANAEROBI

if($id_cat==6 or $id_cat==7 or $id_cat==8 or $tipo==28 or $tipo==20 or $tipo==23 or $tipo==24){

?>



<div class="form-group row">
<label class="col-md-4 control-label">Numero referto</label>
<div class="col-md-8">	<input type="text" name="num_referto" value="<?php  echo $num_referto;?>" >
</div>
</div>
 <div class="alert alert-custom">

	<strong>Nota bene:</strong><br>	E' necessario aver già eseguito un'indagine in precedenza per poter
	inserire questa richiesta aggiuntiva.
Indicare il numero di referto ricevuto in precedenza correlato alla richiesta aggiuntiva che state inserendo.
</div>
<?php
}
?>



<input type="hidden" value="step5"  name="action" />

<!-- Form actions -->
							<div class="form-actions">
								<button type="submit"  class="btn green-meadow salva" onclick="submitForm(this);">
									<i class="fa fa-check-circle"></i>SALVA E AVANTI
								</button>
								<a  class="btn btn-danger" href="back.php?action=step5">
									<i class="fa fa-times"></i>INDIETRO
								</a>
							</div>
							<!-- // Form actions END -->


					</div>
					<!-- // Widget END -->
				</div>
			</form>

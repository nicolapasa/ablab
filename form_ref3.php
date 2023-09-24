<form id="referto"
				enctype='multipart/form-data' action="save_referta.php" method="post"
				autocomplete="off">
			
   
  <div class="portlet light bordered lilla">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-cross font-blue-hoki"></i>
                                                    <span class="caption-subject  bold uppercase">
													
													Refertazione - Sez 3</span>
                                     <br>
                                     <b>Num Ref.</b> <?php echo $id_referto; ?>
									 <?php if($livello=='admnistrator') { ?>
												<b>	Clinica</b> <?php echo $struttura; ?>
												<?php } ?>	
												<b>	Prop.</b> <?php echo $nome_proprietario.' '.$cognome_proprietario; ?>
                                              
                                                </div>
                                           
                                            </div>
 
 <div class="portlet-body form">
  <?php 
if($id_cat==5){
	?>
<div class="form-group row">
						<label class="col-md-6 col-form-label bold">Nome esame 2: </label> 
                 <div class="col-md-6">
				 <input type="hidden" value="<?php echo $id;?>" >
						<input   type="text" id="nome_esame2" name="nome_esame2" class="form-control"  value="<?php echo $nome_esame2; ?>"   />
		</div>
		</div>
<?php 
}
if( $id_cat==5 or $id_cat==3 or $id_cat==4){
		?>
	<div class="form-group row">
<label class="col-md-3 col-form-label bold">Esito:</label>
	<div class="col-md-9">
		<input type="hidden" value="<?php echo $id;?>" >
	<textarea  name="esito_esame2"  id="esito_esame2"  class="form-control editor"  >
	<?php echo $esito_esame2;?></textarea> 
	
	
	</div>
	</div>

		<div class="form-group row">
<label class="col-md-3 col-form-label bold">Commento:</label>
	<div class="col-md-9">
		<input type="hidden" value="<?php echo $id;?>" >
	<textarea  name="commento2"  id="commento2"  class="form-control editor"  >
	<?php echo $commento2;?></textarea> 
	
	
	</div>
	
	
	</div>
<?php }

	
	$rowt=$db->selectAll('tabelle', array('id_ref'=>$id), ' tipo asc ');
 
 //print_r($rowt);

		
		//gestione tabelle-->
// la firma in caso deve essere obbligatoria-->
?>
 <div class="alert alert-custom">
 <strong>Attenzione! Dopo aver aggiunto una tabella potete aggiungere i campi col pulsante add record,
 quando avete finito, PRIMA di aggiungere un'altra tabella SALVATE i dati o li perderete</strong>
 
 </div>
 
<a class="btn btn-primary" href="index.php?req=add_tab&id=<?php echo $id;?>"><i class="fa fa-plus"></i>Aggiungi tabella</a> 
<br>
<br>
<?php 		
 foreach($rowt as $rt){
	 

	 $id_tab=$rt['id'];
    $firma_t=$rt['firma'];
	$nome_firma_t=$db->getCampo('firme', 'value', array('id'=>$firma_t));
	$tipo_t=$rt['tipo'];
	$nome_t=$rt['nome'];
	if($nome_t=='')  $nome_t=$db->getCampo('tipo_tabella', 'value', array('id'=>$tipo_t));
	
	include('tab1.php');
	
 }
 if( $id_cat==3 ){
	?>
<div class="form-group row">
<label class="col-md-4 control-label"  for="author">Foto:</label>
<div class="col-md-8">
<div class="fileupload fileupload-new margin-none" data-provides="fileupload">
  <span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span>
  <span class="fileupload-exists">Change</span>
  <input name="foto" type="file" class="margin-none" /></span>
<?php if($file!=''){ ?>  	<span class="fileupload-preview"><a class="btn btn-primary" target="_blank"
href="<?php echo DIR_UPLOAD.$file;?>"  >
<?php 	if(preg_match('/(JPG|jpg|gif|png|gif|bmp)$/',Utility::getExt(DIR_UPLOAD.$file))){?>
<img src="<?php echo DIR_UPLOAD.$file;?>"  width="100"/>
	  <!-- pulsante elimina foto -->
	  <input type="hidden" value="<?php echo $id;?> ">
	  <button  class="deleteFoto btn btn-danger">
	  Elimina Foto </button>
<?php }else{echo "scarica";}?></a></span><?php }?>
  <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>
</div>
</div>
</div> 
<?php 
}
		//gestione firma admin
		if($livello=='administrator' and  $assegnato=='n' ){		
//qua sempre giorgia matteucci di default
			if($id_firma2=='' or $id_firma2==0){
				
				$id_firma2=3;
				$nome_firma2=$db->getCampo('firme', 'value', array('id'=>$id_firma2));
				
			}		


	
?>		
<div class="form-group row">
						<label class="col-md-4 col-form-label bold">Firma: </label> 
                 <div class="col-md-8">
						<select name="firma2" class="form-control "  >
						<option value="<?php echo $id_firma2; ?>" selected><?php echo $nome_firma2;?></option>
						<?php 
						foreach($db->selectAll('firme', null, ' id asc ') as $r){
							
							echo '<option value="'.$r['id'].'" >'.$r['value'].'</option>';
							
						}
						
						?>
						</select>
		</div>
		</div>
		<?php } 



		else{

//firme refertatori 
if($nome_firma2===0) $nome_firma2='';
?>
	<div class="form-group row">
						<label class="col-md-4 col-form-label bold">Firma: </label> 
                 <div class="col-md-8">
						<select name="firma2" class="form-control "  >
						<option value="<?php echo $nome_firma2; ?>" selected><?php echo $nome_firma2;?></option>
						<?php 
                        	foreach($db->selectAll('firme', null, ' id asc ') as $r){
							
								echo '<option value="'.$r['id'].'" >'.$r['value'].'</option>';
								
							}

						foreach($db->selectAll('admin', array('id'=>$id_admin_refertatore), ' id asc ') as $r){
							$firme=explode(";",$r['firma']);
							
							
							
						}
                    foreach($firme as $firma ){
						echo '<option value="'.$firma.'" >'.$firma.'</option>';
					}
						
						
						?>
						</select>
		</div>
		</div>
		<?php

		}			
		?>

<!-- l'id non è idreferto ma id della riga sulla tabella referti -->
<input type="hidden" value="<?php echo $id;?>"  name="id" />
<input type="hidden" value="<?php echo $step;?>"  name="step" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit"  class="btn green-meadow">
									<i class="fa fa-save"></i>SALVA E AVANTI
								</button>
							<!--<a  class="btn btn-default" href="index.php?req=referta&subreq=4&id=<?php echo $id;?>" >
							<i class="fa fa-arrow-right"></i>AVANTI
								</a>-->
								<?php
									$sub=2;
								if(  $id_cat==3 or $id_cat==4)	$sub=1;
									
								
								?>
								
								<a  class="btn btn-default" href="index.php?req=referta&subreq=<?php echo $sub;?>&id=<?php echo $id;?>" >
								<i class="fa fa-arrow-left"></i>TORNA INDIETRO
								</a>
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
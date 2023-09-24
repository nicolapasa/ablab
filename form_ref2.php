<form id="referto"
				enctype='multipart/form-data' action="save_referta.php" method="post"
				autocomplete="off">
			
   
  <div class="portlet light bordered lilla">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-cross font-blue-hoki"></i>
                                                    <span class="caption-subject  bold uppercase">
													
													Refertazione - Sez 2  
													
													
													</span><br>
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
						<label class="col-md-6 col-form-label bold">Nome esame 1: </label> 
                 <div class="col-md-6">
						<input   type="text" name="nome_esame1" class="form-control"  value="<?php echo $nome_esame1; ?>"   />
		</div>
		</div>



<?php 

}
if($id_cat==1 or $id_cat ==2 or $id_cat==5){



?>
<div class="form-group row">
<label class="col-md-3 col-form-label bold">Descrizione Macroscopica:</label>
	<div class="col-md-9">
	<input type="hidden" value="<?php echo $id;?>" >
	<textarea  name="descr_macro" id="descr_macro" class="form-control editor"  >
	<?php echo $descr_macro;?></textarea> 
	
	
	</div>
	
	
	</div>
	<div class="form-group row">
<label class="col-md-3 col-form-label bold">Descrizione Microscopica:</label>
	<div class="col-md-9">	
	<input type="hidden" value="<?php echo $id;?>" >
	<textarea  name="descr_micro" id="descr_micro" class="form-control editor"  >
	<?php echo $descr_micro;?></textarea> 
	
	
	</div>
	
	
	</div>
	<div class="form-group row">
<label class="col-md-3 col-form-label bold">Diagnosi Morfologica:</label>
	<div class="col-md-9">
	<input type="hidden" value="<?php echo $id;?>" >
	<textarea  name="diagn_morf" id="diagn_morf" class="form-control editor"  >
	<?php echo $diagn_morf;?></textarea> 
	

	</div>
	</div>
	<?php  }
	
	if($id_cat==6 or $id_cat ==7  ){
		?>
	<div class="form-group row">
<label class="col-md-3 col-form-label bold">Esito Esame:</label>
	<div class="col-md-9">
	<input type="hidden" value="<?php echo $id;?>" >
	<textarea  name="esito_esame" id="esito_esame" class="form-control editor"  >
	<?php echo $esito_esame;?></textarea> 
	
	
	</div>
	</div>
	<?php }
		if($id_cat==6 or $id_cat ==7 or $id_cat==1 or $id_cat==2
		 or $id_cat==5
		){
			?>
		<div class="form-group row">
<label class="col-md-3 col-form-label bold">Commento:</label>
	<div class="col-md-9">
	<input type="hidden" value="<?php echo $id;?>" >
	<textarea  name="commento" class="form-control editor"  >
	<?php echo $commento;?></textarea> 
	
	
	</div>
	
	
	</div>
<?php }
		if($id_cat==6  or $id_cat==1 or $id_cat==2  or $id_cat==5 ){
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
		
/*		ESAME ISTOLOGICO: DIANA BINANTI 2
ESAME CITOLOGICO: DIANA BINANTI 1
ESAME IMMUNOISTOCHIMICO: DIANA BINANTI 6
ESAME DI BIOLOGIA MOLECOLARE: DIANA BINANTI 7
ESAME MICROBIOLOGICO: GIORGIA MATTEUCCI
ESAMI URINARI E COPROLOGICI: GIORGIA MATTEUCCI
PROFILI: PRIMA DIANA E POI GIORGIA. DIANA NELLA PARTE DI CITOLOGIA E ISTOLOGIA E GIORGIA NELLA PARTE DI MICRO. 
	*/	
		
		
		if($id_cat==5 or $id_cat==6 or $id_cat==7 or $id_cat==1 or $id_cat==2){
			


	//gestione firma admin se non  è assegnato 
	if($livello=='administrator' and $assegnato=='n'){	
			//qua sempre diana binanti di default
			if($id_firma=='' or $id_firma==0){
				
				$id_firma=1;
				$nome_firma=$db->getCampo('firme', 'value', array('id'=>$id_firma));
				
			}
	?>
	<div class="form-group row">
						<label class="col-md-4 col-form-label bold">Firma: </label> 
                 <div class="col-md-8">
						<select name="firma" class="form-control "  >
						<option value="<?php echo $id_firma; ?>" selected><?php echo $nome_firma;?></option>
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
			if($nome_firma===0) $nome_firma='';
//firme refertatori 
?>
	<div class="form-group row">
						<label class="col-md-4 col-form-label bold">Firma: </label> 
                 <div class="col-md-8">
						<select name="firma" class="form-control "  >
						<option value="<?php echo $nome_firma; ?>" selected><?php echo $nome_firma;?></option>
						<?php 
                     

						foreach($db->selectAll('admin', array('id'=> $id_admin_refertatore), ' id asc ') as $r){
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
	}	
		?>
			<input type="hidden" value="<?php echo $id_scheda;?>"  name="id_scheda" />	
<input type="hidden" value="<?php echo $id_cat;?>"  name="id_cat" />		
<!-- l'id non è idreferto ma id della riga sulla tabella referti -->
<input type="hidden" value="<?php echo $id;?>"  name="id" />
<input type="hidden" value="<?php echo $step;?>"  name="step" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit"  class="btn green-meadow">
									<i class="fa fa-arrow-right"></i>SALVA E AVANTI
								</button>
										<?php 
								$sub=4;
		if($id_cat==3 or $id_cat==4 or $id_cat==5 )	$sub=3;
		?>	                    
			                     
								
								<a class="btn btn-default" href="index.php?req=referta&subreq=1&id=<?php echo $id;?>" >
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
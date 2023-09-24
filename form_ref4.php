<form id="referto"
				enctype='multipart/form-data' action="save_referta.php" method="post"
				autocomplete="off">
			
   
  <div class="portlet light bordered lilla">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-cross font-blue-hoki"></i>
                                                    <span class="caption-subject  bold uppercase">
													
													Refertazione - Pubblicazione</span>
                                     <br>
                                     <b>Num Ref.</b> <?php echo $id_referto; ?>
									 <?php if($livello=='admnistrator') { ?>
												<b>	Clinica</b> <?php echo $struttura; ?>
												<?php } ?>	
												<b>	Prop.</b> <?php echo $nome_proprietario.' '.$cognome_proprietario; ?>
                                              
                                                </div>
                                           
                                            </div>
 
 <div class="portlet-body form">
  <div class="form-group row">
						<label class="col-md-6 col-form-label bold">Data Refertazione: </label> 
                 <div class="col-md-6">
						<input data-date-format="dd/mm/yyyy"  type="text" name="dataRefertazione" class="form-control date-picker"  value="<?php echo $dataRefertazione; ?>"   />
		</div>
		</div>
 <div class="form-group row">
						<label class="col-md-4 col-form-label bold">Stato referto: </label> 
                 <div class="col-md-8">
						<select name="stato" class="form-control "  id="stato" >
						<option value="<?php echo $stato; ?>" selected><?php echo $stato_d;?></option>
						<?php 
						foreach($db->selectAll('stato_referti', null, ' id asc ') as $r){
							
							echo '<option value="'.$r['id'].'" >'.$r['value'].'</option>';
							
						}
						
						?>
						</select>
		</div>
		</div>
		



	
		
<!-- l'id non è idreferto ma id della riga sulla tabella referti -->
<input type="hidden" value="<?php echo $id_struttura;?>"  name="id_struttura" />
<input type="hidden" value="<?php echo $id;?>"  name="id" />
<input type="hidden" value="<?php echo $step;?>"  name="step" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit"  class="btn green-meadow">
									<i class="fa fa-save"></i>SALVA
								</button>
								<?php 
								$sub=2;
		if($id_cat==3 or $id_cat==4 or $id_cat==5 )	$sub=3;
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
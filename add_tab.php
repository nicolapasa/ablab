<?php 

$id=$_GET['id']; //id referto 

?>

<form id="referto"
				enctype='multipart/form-data' action="save.php" method="post"
				autocomplete="off">
			
   
  <div class="portlet light bordered lilla">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-cross font-blue-hoki"></i>
                                                    <span class="caption-subject  bold uppercase">
													
													Aggiungi Tabella</span>
                                     
                                                </div>
                                           
                                            </div>
 
 <div class="portlet-body form">
  <div class="form-group row">
						<label class="col-md-6 col-form-label bold">Nome: </label> 
                 <div class="col-md-6">
						<input   type="text" name="nome" class="form-control"   />
		</div>
		</div>
 <div class="form-group row">
						<label class="col-md-4 col-form-label bold">Tipo Tabella: </label> 
                 <div class="col-md-8">
						<select name="tipo" class="form-control "  >
						<?php 
						foreach($db->selectAll('tipo_tabella', null, ' id asc ') as $r){
							
							echo '<option value="'.$r['id'].'" >'.$r['value'].'</option>';
							
						}
						
						?>
						</select>
		</div>
		</div>
			</div>


<input type="hidden" value="add_tab"  name="action" />	
		
<!-- l'id non è idreferto ma id della riga sulla tabella referti -->
<input type="hidden" value="<?php echo $id;?>"  name="id" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit"  class="btn green-meadow">
									<i class="fa fa-check-circle"></i>SALVA
								</button>
								
		
								<a  class="btn btn-default" href="index.php?req=referta&subreq=3&id=<?php echo $id;?>" >
								<i class="fa fa-reply"></i>TORNA INDIETRO
								</a>
						
							
							</div>
							<!-- // Form actions END -->
			
					
					</div>
					<!-- // Widget END -->
				</div>
			</form>		
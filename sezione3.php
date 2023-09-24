  <?php 
  
  //gestione dati già salvati

//ricevo la scheda 

 if (isset($_SESSION['scheda'])){
 	
 	
 	$row = $db->selectAll('schede', array('id'=>$_SESSION['scheda']));
 	
 	foreach($row as $r){
 	
 	 	$tipo = $r['tipo'];
 	 
 	   
		$id_cat=(int) $db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo));
        
 	     $id_proprietario=$r['id_proprietario'];
		 $id_struttura=$r['id_struttura'];
 		$nome_struttura= $db->getCampo('admin', 'nome', array('id'=>$id_struttura));
       $dest=$r['destinatario'];
 	}
 }
?> 
  
  


  
  <div class="portlet light bordered lilla">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-cross font-blue-hoki"></i>
                                                    <span class="caption-subject  bold uppercase">
													
													Scelta Fatturazione</span>
                                     
                                                </div>
                                           
                                            </div>
 
 <div class="portlet-body form">


<form class="form-horizontal" id="form-3"
				enctype='multipart/form-data' action="save_esami.php" method="post"
				autocomplete="off">
		
		<!--
					<div class="row">
					
            <div class="alert alert-info bold">
			Scegliere un proprietario dall'elenco o inserirne uno nuovo</div>
            <div class="separator"></div>

			
<div class="form-group"><label class="col-md-4 control-label">Nuovo proprietario</label>
<div class="col-md-8"><input type="checkbox" name="selpro" id="selpro" value="s" checked="checked">
</div></div>		
<div class="form-group"><label class="col-md-4 control-label">Proprietario esistente</label>
<div class="col-md-8"><select name="proprietario" class="prop" >
<option value="" selected></option>
<?php
$param=null;
//recupero dati proprietario
 $param=array('id_struttura'=>$_SESSION['struttura']);

$row = $db->selectAll('proprietari', $param, '  cognome_proprietario asc ');




foreach($row as $r){

	$id_pro=$r['id'];
	$nome_proprietario = ucfirst($r['nome_proprietario']);
	$cognome_proprietario = ucfirst($r['cognome_proprietario']);



?><option value="<?php echo $id_pro;?>" ><?php echo $cognome_proprietario . ' ' . $nome_proprietario;?></option>
<?php
 }

?>
</select>
</div>
</div>
--> 


<div class="separator"></div>
<div class=" alert alert-info bold">Scegliere fatturazione</div>
<div class="form-group">
<label class="col-md-4 control-label">
<?php 
$check="checked";
 if($dest=='proprietario') $check="";
  ?>
<input type="radio" name="destinatario"   value="clinica" <?php echo $check;?>>
Fatturo a clinica</label>
<label class="col-md-4 control-label">
<?php
$check="";
 if($dest=='proprietario') $check="checked"; ?>
<input type="radio" name="destinatario" value="proprietario" <?php echo $check;?>>
Fatturo a proprietario</label>
</div>


<input type="hidden" value="step3"  name="action" />

<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn green-meadow">
									<i class="fa fa-check-circle"></i> SALVA E AVANTI
								</button>
								<a  class="btn btn-danger" href="back.php?action=step3">
									<i class="fa fa-times"></i>INDIETRO
								</a>
							</div>
	</div>
	
			</form>
									<!-- // Form actions END -->
			</div>
</div>
	
<div class="portlet-body form">
 
 <form class="horizontal-form" action="index.php" method="get" enctype="multipart/form-data">
 <div class="form-body">
 <div class="row">
      <div class="col-md-12">
              <div class="form-group row">
              <label class="col-md-4 col-form-label bold">Anno:</label>  
                <select  name="anno"  class="form-control">
                    <option value="<?php echo $anno_core;?>" selected><strong><?php echo $anno_core;?></strong></option>
                    <?php
                       /*determino gli anni presenti in base alle annualità presenti nella tabella 
                          schede */

                    $rw=   $db->sqlquery('select distinct(anno) from referti_v  '); 
                    foreach($rw as $r){
             

                        ?>
                        <option value="<?php echo $r['anno'];?>" ><?php echo $r['anno'];?></option>
                   
                        <?php 
                      }

                    
                 
                    ?>

                  
                </select>
              </div>
      </div>
 </div>
     <div class="row">
	 
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Scheda:</label>    
<div class="col-md-8"><input type="text" class="form-control"  name="num" placeholder="cerca..."  />
</div>
</div>
</div>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Referto:</label>    
<div class="col-md-8"><input type="text" class="form-control"   name="id_referto" placeholder="cerca..."  />
</div>
</div>
</div>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Cognome  proprietario:</label>    
<div class="col-md-8"><input type="text" class="form-control"   name="proprietario" placeholder="cerca..."  />
</div></div>
</div>

</div><!--end row-->

     

     

<input type="hidden" name="req" value="ref" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
								  <a href="index.php?req=ref"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>
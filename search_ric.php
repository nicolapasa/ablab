<div class="portlet-body form">
 <form class="horizontal-form" action="index.php" method="get" enctype="multipart/form-data">
 <div class="form-body">

     <div class="row">
	 
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Nome clinica:</label>    
<div class="col-md-8"><input type="text" class="form-control"  name="struttura" placeholder="cerca..."  />
</div>
</div>
</div>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Numero scheda:</label>    
<div class="col-md-8"><input type="text" class="form-control"   name="num" placeholder="cerca..."  />
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
<div class="row">

<div class="col-md-6">
<div class="form-group row ">
<label class="col-md-4 col-form-label bold">Data arrivo</label>    
<div class="col-md-6">
<input type="text" data-date-format="dd/mm/yyyy"   class="form-control date-picker" name="dataArrivo" value="" />
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Arrivato:</label>    
<div class="col-md-8"><select  name="arrivato"  class="form-control">
 <option value="" selected></option>

   <option value="s" >SI</option>
  <option value="n" >NO</option>
   <option value="all" >TUTTI</option>
</select>
</div></div>
</div>

</div><!--end row-->

     <div class="row">
	 
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Tipo scheda:</label>    
<div class="col-md-8"><select  name="tipo"  class="form-control">
 <option value="" selected></option>
 <?php 
 $sql_="select * from categorie where id >9 or id < 9 order by id asc ";
 $row = $db->sqlquery($sql_);

 foreach($row as $r){
 	
 ?>
   <option value="<?php echo $r['id']; ?>" ><?php echo $r['nome'];?></option>

   <?php }?>
</select>
</div></div>
</div>


</div><!-- end row-->






     <div class="row">
	 
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Elementi per pagina:</label>    
<div class="col-md-8">
<select  name="perpage"  class="form-control">
 <option value="<?php echo $perpage;?>" selected><?php echo $perpage;?></option>

   <option value="5" >5</option>
 <option value="10" >10</option>
  <option value="20" >20</option>
</select>
</div>
</div>
</div>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Seleziona Anno:</label>    
<div class="col-md-8">
<select  name="anno"  class="form-control">
 <option value="<?php echo $anno_core;?>" selected><?php echo $anno_core;?></option>
  <?php
                       /*determino gli anni presenti in base alle annualità presenti nella tabella 
                          schede */

                    $rw=   $db->sqlquery('select distinct(anno) from fatture_n  '); 
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


</div>

<input type="hidden" name="req" value="refertazione" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
								  <a href="index.php?req=refertazione"  class="btn default">RESET</a>
								  <a target="_blank"  href="index.php?req=stat&subreq=ref_noesami"  class="btn default">PROTOCOLLI MANCANTI</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>
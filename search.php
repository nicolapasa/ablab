<div class="portlet-body form">
 <form class="horizontal-form" action="index.php" method="get" enctype="multipart/form-data">
 <div class="form-body">

     <div class="row">
       <div class="col-md-2">
       <div class="form-group row ">
       <label class="col-md-4 col-form-label bold">Anno:</label>
                       <select  name="anno"  class="form-control">
                           <option value="<?php echo $anno_core;?>" selected><strong><?php echo $anno_core;?></strong></option>
                           <?php
                              /*determino gli anni presenti in base alle annualità presenti nella tabella
                                 schede */

                           $rw=   $db->sqlquery('select distinct(anno) from schede where completa="s" ');
                           foreach($rw as $r){
                                 ?>
                             <option value="<?php echo $r['anno'];?>" ><?php echo $r['anno'];?></option>

                             <?php

                           }
                       if($r['anno'] <  ANNO_CORE){


       ?><option value="<?php echo ANNO_CORE;?>"><?php echo ANNO_CORE;?></option>
       <?php
                                  }

                           ?>


                       </select>


       </div>
       </div>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Nome clinica:</label>
<div class="col-md-8"><input type="text" class="form-control"  name="struttura" placeholder="cerca..."  />
</div>
</div>
</div>
<div class="col-md-2">
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

<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Tipo scheda:</label>
<div class="col-md-8"><select  name="tipo"  class="form-control">
 <option value="" selected></option>
 <?php
 $sql="select * from categorie where id >9 or id < 9 order by id asc ";
 $row = $db->sqlquery($sql);

 foreach($row as $r){

 ?>
   <option value="<?php echo $r['id']; ?>" ><?php echo $r['nome'];?></option>

   <?php }?>
</select>
</div></div>
</div>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Esame:</label>
<div class="col-md-8"><select  name="tipo_esame"  class="form-control">
 <option value="" selected></option>
 <?php
 $sql="select * from esami_cat order by id asc ";
 $row = $db->sqlquery($sql);

 foreach($row as $r){

 ?>
   <option value="<?php echo $r['id']; ?>" ><?php echo $r['nome'];?></option>

   <?php }?>
</select>
</div></div>
</div>
<div class="col-md-4">
<div class="form-group row ">
<label class="col-md-4 col-form-label bold">Urgente?</label>
<div class="col-md-6">
<label>
<input type="radio"   name="urgente" value="s" />
</label>
</div>
</div>
</div>


</div><!-- end row-->

     <div class="row">

<div class="col-md-4">

<div class="form-group row">
<label class="col-md-4 col-form-label bold">Allegati?</label>
<div class="col-md-8"><input type="radio"  name="allegati" value="s" />
</div></div>
</div>
<div class="col-md-4">
<div class="form-group row ">
<label class="col-md-4 col-form-label bold">Valutazione margini?</label>
<div class="col-md-8"><input type="radio"  name="margini" value="s" />
</div></div>
</div>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Seconda opinione?</label>
<div class="col-md-8">
<input type="radio"  name="seconda_refertazione" value="s" />
</div>
</div>
</div>

</div>

<input type="hidden" name="req" value="ric" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
                   <a href="destroy.php?req=ric"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>

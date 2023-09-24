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
<label class="col-md-4 col-form-label bold">Ordina per numero esami:</label>    
<div class="col-md-8">
<select  name="ord_esa"  class="form-control">
 <option value="<?php echo $ord_esa;?>" selected><?php echo $ord_esa;?></option>
 <option value="crescente" >crescente</option>
  <option value="descrescente" >descrescente</option>
</select>

</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Ordine alfabetico:</label>    
<div class="col-md-8">
<select  name="ord_alfa"  class="form-control">
 <option value="<?php echo $ord_alfa;?>" selected><?php echo $ord_alfa;?></option>
 <option value="crescente" >crescente</option>
  <option value="descrescente" >descrescente</option>
</select>

</div>
</div>
</div>
</div><!--end row-->

    

     

<input type="hidden" name="req" value="stat" />
<input type="hidden" name="subreq" value="andamento_utenze" />
<input type="hidden" name="anno" value="<?php echo $anno;?>" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
								  <a href="index.php?req=stat&subreq=andamento_utenze"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>
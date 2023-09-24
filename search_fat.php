<div class="portlet-body form">
 <form class="horizontal-form" action="index.php" method="get" enctype="multipart/form-data">
 <div class="form-body">
 
     <div class="row">
	 
<div class="col-md-8">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Clinica:</label>    
<div class="col-md-8">
 <select  name="id_struttura">
 <option value="" selected=selected> </option>
 
<?php 
foreach($db->selectAll('admin', array('livello'=>'struttura'), ' nome asc ') as $r1){
	
	echo '<option value="'.$r1['id'].'" >'.$r1['nome'].'</option>';
	
}

?>
 </select>
</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Numero fattura:</label>    
<div class="col-md-8"><input type="text" class="form-control"    name="num"   />
</div>
</div>
</div>
</div>
  <div class="row">
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Anno:</label>    
<div class="col-md-8"><input type="text" class="form-control date-picker" data-date-format="yyyy"    name="anno"   />
</div>
</div>
</div>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Mese:</label>    
<div class="col-md-8"><input type="text" data-date-format="m" class="form-control date-picker-mese"   name="mese"  />
</div></div>
</div>

</div><!--end row-->


   

<input type="hidden" name="req" value="fatture" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
								  <a href="index.php?req=fatture"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>
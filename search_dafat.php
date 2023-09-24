<div class="portlet-body form">
 <form class="horizontal-form" action="index.php" method="get" enctype="multipart/form-data">
 <div class="form-body">

  <div class="row">
 <div class="col-md-2">
 <label class="col-md-8 col-form-label bold">N° Fattura</label> 
 <div class="col-md-4">
 <span><?php 
 $row=$db->selectAll('fatture', array('anno'=>ANNO_CORE), '  id desc ',' limit 1 ');
if(count($row)>0){
foreach($row as $r){
	
$numFatt = $r['num']+1;
}
}
else{
	
	$numFatt=1;
}
 //trovo l'ultima fattura e la incremento
 echo $numFatt.' / '.ANNO_CORE;
 ?></span>
 </div>
 </div>
  
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-6 col-form-label bold">Fattura fino a data:</label>    
<div class="col-md-6">
<?php 
if($_GET['data_fine']!='') $data_fine=$_GET['data_fine'];

?>
<input data-date-format="dd/mm/yyyy"  type="text" class="form-control date-picker" value="<?php echo $data_fine;?>"   name="data_fine"   />
</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-6 col-form-label bold">Data di fatturazione:</label>    
<div class="col-md-6">
<?php 
if($_GET['data_fatt']!='') $data_fatt=$_GET['data_fatt'];

?>
<input type="text" data-date-format="dd/mm/yyyy" class="form-control date-picker"  value="<?php echo $data_fatt;?>" name="data_fatt"  />
</div></div>
</div>
<div class="col-md-3">
 <label class="col-md-6 col-form-label bold">Data ultima fattura</label> 
 <div class="col-md-6">
 <span><?php 
 $row=$db->selectAll('fatture', array('anno'=>date(Y)), '  data desc ',' limit 1 ');
if(count($row)>0){
foreach($row as $r){
	
$dataLastFatt = Utility::getTime($r['data']);
}
}

 //trovo l'ultima fattura e la incremento
 echo $dataLastFatt;
 ?></span>
 </div>
 </div>

</div><!--end row-->
<div class="row">
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Clinica:</label>    
<div class="col-md-6">
<input  type="text" class="form-control" value="<?php echo $_GET['cli'];?>"   name="cli"   />
</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Proprietari:</label>    
<div class="col-md-6">
<input  type="text" class="form-control" value="<?php echo $_GET['pro'];?>"   name="pro"   />
</div>
</div>
</div>
 <div class="col-md-3">
<div class="form-group row ">
<label class="col-md-4 col-form-label bold">Con Riba?</label>    
<div class="col-md-6">
<select name="riba" class="form-control">
 <option value="<?php echo $_GET['riba'];?>" selected><?php echo $_GET['riba'];?></option>
   <option value="SI" >SI</option>
      <option value="n" >NO</option>
 <option value="" >tutte</option>
</select>
</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Destinatari</label>    
<div class="col-md-6">
<select  name="dest"  class="form-control">
 <option value="<?php echo $_GET['dest'];?>" selected><?php 
 if($_GET['dest']=='c') {
	 echo 'clinica';
 }

 if($_GET['dest']=='p'){ 
  echo 'proprietario';
 }
?></option>

   <option value="c" >clinica</option>
 <option value="p" >proprietario</option>
  <option value="" >tutti</option>
</select>
</div>
</div>
</div>


</div><!--end row-->
   
   
   <div class="row">
   
   <div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Ordina per importo:</label>    
<div class="col-md-8">
<select  name="ord_imp"  class="form-control">
 <option value="<?php echo $ord_imp;?>" selected><?php echo $ord_imp;?></option>
 <option value="crescente" >crescente</option>
  <option value="descrescente" >descrescente</option>
</select>

</div>
</div>
</div>
      <div class="col-md-3">
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
   
   </div><!--end row-->

<input type="hidden" name="req" value="fatturazione" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
								  <a href="destroy.php?req=fatturazione"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>
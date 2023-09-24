<div class="portlet-body form">

 <form class="horizontal-form" action="index.php" method="get" enctype="multipart/form-data">
 <div class="form-body">
 
     <div class="row">
     <div class="col-md-4">
<div class="form-group row ">
<label class="col-md-4 col-form-label bold">Anno Fatturazione:</label>  
                <select  name="anno"  class="form-control">
                    <option value="<?php echo $anno_core;?>" selected><strong><?php echo $anno_core;?></strong></option>
                    <?php
                       /*determino gli anni presenti in base alle annualità presenti nella tabella 
                          schede */

                    $rw=   $db->sqlquery('select distinct(anno) from fatture  '); 
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
</div>
<div class="row">
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Nome clinica:</label>    
<div class="col-md-8"><input type="text" class="form-control"  name="struttura" value="<?php echo stripcslashes($struttura);?>"  />
</div>
</div>
</div>

<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Cognome  proprietario:</label>    
<div class="col-md-8"><input type="text" class="form-control"   name="proprietario" value="<?php echo stripcslashes($proprietario);?>"  />
</div></div>
</div>
<div class="col-md-4">
<div class="form-group row ">
<label class="col-md-4 col-form-label bold">Numero fattura</label>    
<div class="col-md-6">
<input type="text"    class="form-control" name="num" value="<?php echo $num;?>" />
</div>
</div>
</div>
</div><!--end row-->

    
<div class="row">
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Fattura a:</label>    
<div class="col-md-8"><select  name="dest"  class="form-control">
 <option value="<?php echo $_GET['dest'];?>" selected>
 
 <?php 
 if($_GET['dest']=='c') {
	 echo 'clinica';
 }

 if($_GET['dest']=='p'){ 
  echo 'proprietario';
 }
?>
 </option>

   <option value="c" >clinica</option>
 <option value="p" >proprietario</option>
</select>
</div></div>
</div>


<div class="col-md-3">
<div class="form-group row ">
<label class="col-md-4 col-form-label bold">Data da</label>    
<div class="col-md-6">
<input type="text" data-date-format="dd/mm/yyyy"   class="form-control date-picker" name="data_da" value="<?php echo $_GET['data_da'];?>" />
</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group row ">
<label class="col-md-4 col-form-label bold">Data  a</label>    
<div class="col-md-6">
<input type="text" data-date-format="dd/mm/yyyy"   class="form-control date-picker" name="data_a" value="<?php echo $_GET['data_a'];?>" />
</div>
</div>
</div>

</div><!--end row-->
     <div class="row">
	
<div class="col-md-3">

<div class="form-group row">
<label class="col-md-3 col-form-label bold">Pagata</label>    
<div class="col-md-8">
<select  name="pagata"  class="form-control">
 <option value="<?php echo $pagata;?>" selected><?php echo $pagata;?></option>
 <option value="pagata" >pagata</option>
  <option value="non pagata" >non pagata</option>
     <option value="" >tutte</option>
</select>
</div>
</div>
</div>


 
	 
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Ordina per numero:</label>    
<div class="col-md-8">
<select  name="ord_num"  class="form-control">
 <option value="<?php echo $ord_num;?>" selected><?php echo $ord_num;?></option>
 <option value="crescente" >crescente</option>
  <option value="descrescente" >descrescente</option>
</select>

</div>
</div>
</div>
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
</div>
     <div class="row">
<!-- numero di elementi-->
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Elementi per pagina:</label>    
<div class="col-md-8"><select  name="perpage"  class="form-control">
 <option value="<?php echo $perpage;?>" selected><?php echo $perpage;?></option>

   <option value="5" >5</option>
 <option value="10" >10</option>
  <option value="20" >20</option>
</select>
</div></div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Filtra per importo:</label>    
<div class="col-md-8">
<input type="text" name="filtro_imp" value="<?php echo $filtro_imp;?>" class="form-control">

</div></div>
</div>
</div>
     

<input type="hidden" name="req" value="fatture" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
								  <a href="destroy.php?req=fatture"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>
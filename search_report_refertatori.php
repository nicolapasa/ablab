<div class="portlet-body form">
 
 <form class="horizontal-form" action="index.php" method="get" enctype="multipart/form-data">
 <div class="form-body">
 <div class="row">
      <div class="col-md-4">
              <div class="form-group row">
              <label class="col-md-4 col-form-label bold">Anno:</label>
              <div class="col-md-8">  <select  name="anno"  class="form-control">
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


                </select></div>
              </div>
      </div>

<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Filtra per Nome:</label>
<div class="col-md-8"><input type="text" class="form-control"  name="nome" value="<?php echo stripcslashes($nome);?>"  />
</div>
</div>
</div>

<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Filtra per  mese completato:</label>
<div class="col-md-8"><input type="text" class="form-control date-picker"  data-date-format="dd/mm/yyyy"  name="mese" value=""  />
</div></div>
</div>
</div><!--end row-->
<div class="row">
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Filtra per  mese assegnato:</label>
<div class="col-md-8"><input type="text" class="form-control date-picker"  data-date-format="dd/mm/yyyy"  name="mese_assegnato" value=""  />
</div></div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Filtra per Referto:</label>
<div class="col-md-8"><input type="text" class="form-control"   name="num" value="<?php echo $num;?>"   />
</div>
</div>
</div>
<div class="col-md-3">

<div class="form-group row">
<label class="col-md-3 col-form-label bold">Completati</label>
<div class="col-md-8">
<?php
$check='';
if($_GET['completato']=='s') $check='checked';
?>
<input type="checkbox"  name="completato" value="s"  <?php echo $check;?>  />
</div>
</div>
</div>
</div><!--end row-->

    

<input type="hidden" name="req" value="report_refertatori" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
                             <a href="index.php?req=report_refertatori"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>

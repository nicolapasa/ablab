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
<label class="col-md-4 col-form-label bold">Nome refertazione:</label>
<div class="col-md-8"><input type="text" class="form-control"  name="nome_ref" placeholder="cerca..."  />
</div>
</div>
</div>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">E-mail:</label>
<div class="col-md-8"><input type="text" class="form-control"   name="email" placeholder="cerca..."  />
</div>
</div>
</div>
</div><!--end row-->
  <div class="row">
  <div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Provincia:</label>
<div class="col-md-8"><select  name="provincia"  class="form-control">

 <option value="<?php echo $provincia; ?>" selected><?php echo $provincia; ?></option>
 <?php
 $sql1="select * from province  order by nomeprovincia asc ";
 $row = $db->sqlquery($sql1);

 foreach($row as $r){

 ?>
   <option value="<?php echo $r['nomeprovincia']; ?>" ><?php echo $r['nomeprovincia'];?></option>

   <?php }?>
</select>
</div></div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Livello:</label>
<div class="col-md-8"><select  name="livello"  class="form-control">
 <option value="" selected></option>

 <option value="struttura" >struttura</option>
<option value="service" >service</option>


</select>
</div></div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Non attivi:</label>
<div class="col-md-8">
<label>
<?php
$check="";

if($attivo=='f' or isset($_GET['attivo'])) $check="checked=checked";
?>
<input type="checkbox"   name="attivo" value="f" <?php echo $check;?> />
</label>

</div></div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Cerca cliniche con SDI:</label>
<div class="col-md-8">
<select  name="codice"  class="form-control">
 <option value="" selected></option>
 <option value="s" >con SDI</option>
 <option value="n" >senza SDI</option>
</select>
</div></div>
</div>

<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Partita IVA:</label>
<div class="col-md-8"><input type="text" class="form-control"  name="piva" placeholder="cerca..."  />
</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">con RIBA:</label>
<div class="col-md-8">
<label>
<?php
$check="";

if($mod_pag=='riba') $check="checked=checked";
?>
<input type="checkbox"   name="mod_pag" value="riba" <?php echo $check;?> />
</label>

</div></div>
</div>

</div><!--end row-->



<input type="hidden" name="req" value="admin" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
								  <a href="index.php?req=admin"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>

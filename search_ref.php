<div class="portlet-body form">
<?php if(($livello == 'administrator')){?>

  <? echo "<a class='btn btn-lg blue' href='index.php?req=refertazione'>";echo "<i class='fa fa-plus'></i>Accettazione";?></a>
 <a class="btn btn-primary btn-lg" href="index.php?req=pdf" ><i class="fa fa-list"></i>PDF Referti</a>
 <?php }?>
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
     <?php if(($livello == 'administrator')){?>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Nome clinica:</label>
<div class="col-md-8"><input type="text" class="form-control"  name="struttura" value="<?php echo stripcslashes($struttura);?>"  />
</div>
</div>
</div>
<?php }?>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Cognome  proprietario:</label>
<div class="col-md-8"><input type="text" class="form-control"   name="proprietario" value="<?php echo stripcslashes($proprietario);?>"  />
</div></div>
</div>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Referto:</label>
<div class="col-md-8"><input type="text" class="form-control"   name="id_referto" value="<?php echo $id_referto;?>"   />
</div>
</div>
</div>
</div><!--end row-->

     <div class="row">

<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Stato:</label>
<div class="col-md-8"><select  name="stato"  class="form-control">
<?php
if($stato!='') $nome_stato=$db->getCampo('stato_referti', 'value', array('id'=>$stato));
?>
 <option value="<?php echo $stato;?>" selected><?php echo $nome_stato;?></option>
 <?php
 $sql1="select * from stato_referti  ";
 $row = $db->sqlquery($sql1);

 foreach($row as $r){

 ?>
   <option value="<?php echo $r['id']; ?>" ><?php echo $r['value'];?></option>

   <?php }?>
</select>
</div></div>
</div>
<?php

if($_GET['id_cat']!='') $nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$_GET['id_cat']));
?>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Tipo scheda:</label>
<div class="col-md-8"><select  name="id_cat"  class="form-control">
 <option value="<?php echo $id_cat;?>" selected><?php echo $nome_cat;?></option>
 <?php
 $sql3="select * from categorie where id >9 or id < 9 order by id asc ";
 $row3 = $db->sqlquery($sql3);

 foreach($row3 as $r){

 ?>
   <option value="<?php echo $r['id']; ?>" ><?php echo $r['nome'];?></option>

   <?php }?>
</select>
</div></div>
</div>
<?php

if($_GET['id_esa']!='') $nome_esa=$db->getCampo('esami_cat', 'abbr', array('id'=>$_GET['id_esa']));
?>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Nome esame:</label>
<div class="col-md-8"><select  name="id_esa"  class="form-control">
 <option value="<?php echo $id_esa;?>" selected><?php echo $nome_esa;?></option>
 <?php
 $sql3="select * from esami_cat  order by abbr asc ";
 $row3 = $db->sqlquery($sql3);

 foreach($row3 as $r){

 ?>
   <option value="<?php echo $r['id']; ?>" ><?php echo $r['abbr'];?></option>

   <?php }?>
</select>
</div></div>
</div>
</div><!-- end row-->
<div class="row">
<div class="col-md-3">
<div class="form-group row ">
<label class="col-md-4 col-form-label bold">Data arrivo da</label>
<div class="col-md-6">
<input type="text" data-date-format="dd/mm/yyyy"   class="form-control date-picker" name="dataArrivoDa" value="<?php echo $_GET['dataArrivoDa'];?>" />
</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group row ">
<label class="col-md-4 col-form-label bold">Data arrivo a</label>
<div class="col-md-6">
<input type="text" data-date-format="dd/mm/yyyy"   class="form-control date-picker" name="dataArrivoA" value="<?php echo $_GET['dataArrivoA'];?>" />
</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Referto da:</label>
<div class="col-md-8"><input type="text" class="form-control"   name="id_referto_da" value="<?php echo $id_referto_da;?>"   />
</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Referto a:</label>
<div class="col-md-8"><input type="text" class="form-control"   name="id_referto_a" value="<?php echo $id_referto_a;?>"   />
</div>
</div>
</div>
</div><!--end row-->
     <div class="row">
       <div class="col-md-3">
       <div class="form-group row ">
       <label class="col-md-4 col-form-label bold">Numero Scheda</label>
       <div class="col-md-6">
       <input type="text"    class="form-control" name="num" value="<?php echo $num;?>" />
       </div>
       </div>
       </div>
<div class="col-md-3">

<div class="form-group row">
<label class="col-md-3 col-form-label bold">Allegati?</label>
<div class="col-md-8">
<?php
$check='';
if($_GET['allegati']=='s') $check='checked';
?>
<input type="checkbox"  name="allegati" value="s"  <?php echo $check;?>  />
</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group row ">
<label class="col-md-4 col-form-label bold">Urgente?</label>
<div class="col-md-6">
<label>
<?php
$check='';
if($urgente=='s') $check='checked';
?>
<input type="checkbox"   name="urgente" value="s" <?php echo $check;?>  />
</label>
</div>
</div>
</div>

</div>
 <div class="row">
<?php

if($_GET['id_specie']!='') $nome_specie=$db->getCampo('specie', 'nome', array('id'=>$_GET['id_specie']));
?>
<div class="col-md-2">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Specie:</label>
<div class="col-md-8"><select  name="id_specie"  class="form-control">
 <option value="<?php echo $id_specie;?>" selected><?php echo $nome_specie;?></option>
 <?php
 $sql3="select * from specie  order by nome asc ";
 $row3 = $db->sqlquery($sql3);

 foreach($row3 as $r){

 ?>
   <option value="<?php echo $r['id']; ?>" ><?php echo $r['nome'];?></option>

   <?php }?>
</select>
</div></div>
</div>
<?php

if($_GET['razza']!='') $nome_razza=$_GET['razza'];
?>
<div class="col-md-2">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Razza:</label>
<div class="col-md-8"><select  name="id_razza"  class="form-control">
 <option value="<?php echo $nome_razza;?>" selected><?php echo $nome_razza;?></option>
 <?php
 $sql3="select * from razza  order by nome asc ";
 $row3 = $db->sqlquery($sql3);

 foreach($row3 as $r){

 ?>
   <option value="<?php echo $r['nome']; ?>" ><?php echo $r['nome'];?></option>

   <?php }?>
</select>
</div></div>
</div>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Nome animale:</label>
<div class="col-md-8"><input type="text" class="form-control"  name="animale" value="<?php echo stripcslashes($animale);?>"  />
</div>
</div>
</div>


</div>
 <div class="row">

<div class="col-md-8">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Cerca in:</label>
<div class="col-md-8">
<label>
<?php
$check='';

if(in_array('all', $tipo_t)) $check='checked';
?>
<input type="checkbox"  name="tipo_t[]" value="all"  <?php echo $check;?>  />Tutti
</label>
<label>
<?php
$check='';

if(in_array('esito_esame', $tipo_t)) $check='checked';
?>
<input type="checkbox"   name="tipo_t[]" value="esito_esame"  <?php echo $check;?>  />Esito
</label>
<label>
<?php
$check='';

if(in_array('commento', $tipo_t)) $check='checked';
?>
<input type="checkbox" name="tipo_t[]" value="commento"  <?php echo $check;?>  />Commento
</label>
<label>
<?php
$check='';

if(in_array('descr_macro', $tipo_t)) $check='checked';
?>
<input type="checkbox"  name="tipo_t[]" value="descr_macro" <?php echo $check;?>   />Descr Macro
</label>
<label>
<?php
$check='';

if(in_array('descr_micro', $tipo_t)) $check='checked';
?>
<input type="checkbox" name="tipo_t[]" value="descr_micro" <?php echo $check;?>   />Descr Micro
</label>
<label>
<?php
$check='';

if(in_array('diagn_morf', $tipo_t)) $check='checked';
?>
<input type="checkbox"  name="tipo_t[]" value="diagn_morf"  <?php echo $check;?>  />Diagnosi Morfo
</label>
</div>
</div>
</div>
<div class="col-md-4">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Testo:</label>
<div class="col-md-8">
<textarea  class="form-control"  name="testo"><?php echo stripcslashes($testo);?></textarea>
</div>
</div>
</div>
</div><!-- end row-->
<div class="row">

<div class="col-md-2">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Ordina:</label>
<div class="col-md-8">
<label>
<?php
$check='';
if($_GET['ord']=='s') $check='checked';
?>
<input type="checkbox"  name="ord" value="s" <?php echo $check;?> />Più recente
</label>

</div>
</div>
</div>

<!-- numero di elementi-->
<div class="col-md-2">
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

<?php if(($livello == 'administrator')){?>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Medico referente:</label>
<div class="col-md-8"><input type="text" class="form-control"  name="medico_ref" value="<?php echo stripcslashes($medico_ref);?>"  />
</div>
</div>
</div>
<?php }?>
<?php if(($livello == 'administrator')){?>
<div class="col-md-3">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Medico Refertatore:</label>
<div class="col-md-8">
  <select class="form-control"  name="id_refertatore"   >
    <?php
   if($_GET['id_refertatore']!='') {
      $nome_ref=$db->getCampo('admin', 'nome_ref', array('id'=>$_GET['id_refertatore']));
   }
     echo ' <option value="'.$_GET['id_refertatore'].'" selected >'.$nome_ref.'</option>';
      foreach ($db->selectAll('admin', array('livello'=>'referti')) as $r) {
        echo ' <option value="'.$r['id'].'" >'.$r['nome_ref'].'</option>';
      } 
    ?>
    
  </select>
</div>
</div>
</div>
<div class="col-md-2">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Assegnati:</label>
<div class="col-md-8">
<select class="form-control"  name="assegnati"   >
<option value="" selected>tutti</option>
<option value="n" >non assegnati</option>
 <option value="s" >assegnati</option>   
  </select>
</div>
</div>
</div>
<?php }?>

</div>


<input type="hidden" name="req" value="ref" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
								  <a href="destroy.php?req=ref"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>

 <?php
 //se id scheda gi� in sessione recupero dati e li ripresento nel form
 if (isset($_SESSION['scheda'])){


 	$row = $db->selectAll('schede', array('id'=>$_SESSION['scheda']));

 	foreach($row as $r){

 	 	$tipo = $r['tipo'];

 	 	$urgente = $r['urgente'];
 	 	$margini = $r['margini'];

 	 	$punti= $r['punti'];
 	 	$seconda_refertazione=$r['seconda_refertazione'];

		$id_cat=(int) $db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo));
		$nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$id_cat));

		if($tipo>38 and  $tipo <42)  $qta=$r['qta'];

         if($tipo>91 and $tipo<102)  $qta3=$r['qta'];

		 $id_struttura=$r['id_struttura'];
 		$nome_struttura= $db->getCampo('admin', 'nome', array('id'=>$id_struttura));


 	}
 }

 $err=$_GET['err'];
 ?>
  <div class="portlet light bordered lilla">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="icon-cross font-blue-hoki"></i>
                                                    <span class="caption-subject  bold uppercase">Selezione esame</span>

                                                </div>

                                            </div>

 <div class="portlet-body form">
  <form class="form-horizontal" id="sez1"
				enctype='multipart/form-data' action="save_esami.php" method="post"
				autocomplete="off">


						<!-- Row -->
						<div class="row innerLR">

<?php


if($livello=='administrator'){
?>


<div class="form-group">
<label class="col-md-4 control-label">Scegli una struttura esistente</label>
<div class="col-md-8">
   <select name="struttura" class="bs-select form-control struttura" data-live-search="true" data-size="8">
<option value="<?php echo $id_struttura;?>" selected><?php echo $nome_struttura;?></option>
<?php
$row= $db->selectAll('admin', null, ' nome asc ');
$p= new geo();
foreach($row as $r){

$idstruttura=$r['id'];
$nomestruttura=$r['nome'];
$nomeprovincia = $p->getProv($r['provincia']);

?><option value="<?php echo $idstruttura;?>" ><?php echo $nomestruttura . ' ' . $nomeprovincia;?></option>
<?php
 }
?>
</select>
</div>
</div>


<?php

}else{
?>
<input type="hidden" value="<?php echo $_SESSION['struttura'];?>" name="struttura" />

<?php
}
 if($err=='ko3'){?>
<!-- Alert -->
<div class="alert alert-custom">

	<strong>Attenzione!</strong>Non hai selezionato la clinica
</div>
<!-- // Alert END -->

<?php }


 if($err=='ko'){?>
<!-- Alert -->
<div class="alert alert-custom">

	<strong>Attenzione!</strong>Occorre selezionare almeno un esame
</div>
<!-- // Alert END -->

<?php }

 if($err=='ko2'){?>
<!-- Alert -->
<div class="alert alert-custom">

	<strong>Attenzione!</strong>Hai selezionato un servizio senza indicare la quantità
</div>
<!-- // Alert END -->

<?php }?>
<div class="panel-group accordion" id="accordion"><!-- inizio accordion -->

<!-- inizio pannello -->
<div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#cola">
ESAME CITOLOGICO</a>
 </h4>
    </div>
	<?php
    $class='';
	if($nome_cat=='ESAME CITOLOGICO') $class='in';?>
    <div id="cola" class="panel-collapse collapse <?php echo $class;?>">
      <div class="panel-body">

 <?php
$id_cat=$db->getCampo('categorie', 'id', array('nome'=>'ESAME CITOLOGICO'));

$row = $db->selectAll('esami_ordinati_v', array('id_cat'=>$id_cat, 'eliminato'=>''), ' ord asc ');

foreach($row as $r){
	$nome_=$r['nome'];
	$id_=$r['id'];
	($tipo == $id_)? $chk='checked=checked':$chk='';
 ?>
<div class="form-group">
  <div class="col-md-12">


<label class="m-radio-inline ">
  	  <input type="radio" class="esame"  name="tipo"  id="<?php echo $id_;?>" value="<?php echo $id_;?>" <?php  echo $chk;?>>
<strong class="ms-1"><?php echo $nome_;?></strong>
 </label>
</div>



</div>

<?php
}
?>



</div>
    </div>
  </div>
  <!-- fine pannello -->
    <!--inizio pannello -->
  <div class="panel panel-default">
    <div class="panel-heading">

       <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#colb">

ESAME ISTOLOGICO</a>
</h4>
    </div>
		<?php
    $class='';
	if($nome_cat=='ESAME ISTOLOGICO') $class='in';?>
    <div id="colb" class="panel-collapse collapse <?php echo $class;?>">
      <div class="panel-body">
 <?php
 $id_cat=$db->getCampo('categorie', 'id', array('nome'=>'ESAME ISTOLOGICO'));

$row = $db->selectAll('esami_ordinati_v', array('id_cat'=>$id_cat, 'eliminato'=>''), ' ord asc ');

foreach($row as $r){
	$nome_=$r['nome'];
	$id_=$r['id'];
	($tipo == $id_)? $chk='checked=checked':$chk='';
 ?>
<div class="form-group">

<div class="col-md-2">
   <label>

	  <input type="radio" class="esame"  name="tipo"  id="<?php echo $id_;?>" value="<?php echo $id_;?>" <?php  echo $chk;?>>


	  </label>
</div>
<label class="col-md-10 control-label"><?php echo $nome_;?>
</label>
</div>
<br>
<?php
}


	($urgente == 's')? $chk='checked=checked':$chk='';
	?>


<div class="form-group">

<div class="col-md-4"><input type="checkbox" name="urgente" id="opt3"  value="s" <?php  echo $chk;?> >
</div>
<label class="col-md-8 control-label viola">	Refertazione urgente (24-48 ore)
</label>
</div>
	<?php
	($margini == 's')? $chk='checked=checked':$chk='';
	?>

<!--
<div class="form-group"><label class="col-md-8 control-label viola">	Valutazione margini
 </label>
<div class="col-md-4"><input type="checkbox" name="margini" id="opt4"  value="s" <?php  echo $chk;?> >
</div></div>
	-->


<!--<div class="form-group" id="punti"><label class="col-md-4 control-label">indicare i punti di riferimento</label>
<div class="col-md-8"><textarea  name="punti" class="form-control" rows="3"><?php  echo $punti;?></textarea>
</div></div>-->

	<?php
	($seconda_refertazione!= '')? $chk='checked=checked':$chk='';
	?>


<div class="form-group">
<div class="col-md-4"><input type="checkbox" name="seconda_refertazione" id="opt6"  value="s" <?php  echo $chk;?> >
</div>
<label class="col-md-8 control-label viola">		Seconda opinione
 </label>

</div>

</div>
    </div>
  </div>
  <!-- fine pannello -->
    <!--inizio pannello -->
  <div class="panel panel-default">
    <div class="panel-heading" >
    <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#colc">

MICROBIOLOGIA</a>
</h4>
    </div>
		<?php
    $class='';
	if($nome_cat=='MICROBIOLOGIA') $class='in';?>
    <div id="colc" class="panel-collapse collapse <?php echo $class;?>">
      <div class="panel-body">

 <?php
 $id_cat=$db->getCampo('categorie', 'id', array('nome'=>'MICROBIOLOGIA'));

$row = $db->selectAll('esami_ordinati_v', array('id_cat'=>$id_cat, 'eliminato'=>''), ' ord asc ');

foreach($row as $r){
		$nome_=$r['nome'];
	$id_=$r['id'];
	($tipo == $id_)? $chk='checked=checked':$chk='';

 ?>
<div class="form-group">

<div class="col-md-2">
   <label>

	  <input type="radio" class="esame"  name="tipo"  id="<?php echo $id_;?>" value="<?php echo $id_;?>" <?php  echo $chk;?>>


	  </label>
</div>
<label class="col-md-10 control-label"><?php echo $nome_;?>
</label>
</div>

<?php
}
?>
<?php
$hide='hide';
if($qta!='') $hide="";?>
<div id="hide" class="form-group <?php echo $hide;?>">


  <div class="col-md-4">
	  <input  type="text" name="qta" value="<?php echo $qta;?>" />
	</div>
    <label class="col-md-8  control-label viola">Indicare numero di tamponi</label>
</div>

    </div>
  </div>
    </div>
  <!-- fine pannello -->
    <!--inizio pannello -->
  <div class="panel panel-default">
    <div class="panel-heading" >
    <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#cold" >

ESAMI URINARI E COPROLOGICI</a>
</h4>
    </div>
		<?php
    $class='';
	if($nome_cat=='ESAMI URINARI E COPROLOGICI') $class='in';?>
    <div id="cold" class="panel-collapse collapse <?php echo $class;?>">
      <div class="panel-body">

 <?php

 $id_cat=$db->getCampo('categorie', 'id', array('nome'=>'ESAMI URINARI E COPROLOGICI'));
$row = $db->selectAll('esami_ordinati_v', array('id_cat'=>$id_cat, 'eliminato'=>''), ' ord asc ');

foreach($row as $r){
		$nome_=$r['nome'];
	$id_=$r['id'];
	($tipo == $id_)? $chk='checked=checked':$chk='';
 ?>
<div class="form-group">

<div class="col-md-2">
   <label>

	  <input type="radio" class="esame"  name="tipo"  id="<?php echo $id_;?>" value="<?php echo $id_;?>" <?php  echo $chk;?>>


	  </label>
</div>
<label class="col-md-10 control-label"><?php echo $nome_;?>
</label>
</div>

<?php
}
?>

</div>
    </div>
  </div>
  <!--inizio pannello -->
  <div class="panel panel-default">
    <div class="panel-heading">
     <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse"data-parent="#accordion" href="#cole" >

PROFILI DIAGNOSTICI COMPLETI
</a>
</h4>
    </div>
		<?php
    $class='';
	if($nome_cat=='PROFILI DIAGNOSTICI COMPLETI') $class='in';?>
    <div id="cole" class="panel-collapse collapse <?php echo $class;?>">
      <div class="panel-body">

 <?php

 $id_cat=$db->getCampo('categorie', 'id', array('nome'=>'PROFILI DIAGNOSTICI COMPLETI'));
$row = $db->selectAll('esami_ordinati_v', array('id_cat'=>$id_cat, 'eliminato'=>''), ' ord asc ');

foreach($row as $r){
	$nome_=$r['nome'];
	$id_=$r['id'];
	($tipo == $id_)? $chk='checked=checked':$chk='';
 ?>
<div class="form-group">

<div class="col-md-2">
   <label>

	  <input type="radio" class="esame"  name="tipo"  id="<?php echo $id_;?>" value="<?php echo $id_;?>" <?php  echo $chk;?>>


	  </label>
</div>
<label class="col-md-10 control-label"><?php echo $nome_;?>
</label>
</div>

<?php
}
?>

</div>
    </div>
  </div>
<!--inizio pannello -->
  <div class="panel panel-default">
    <div class="panel-heading">
     <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse"data-parent="#accordion" href="#colf">

ESAME IMMUNOISTOCHIMICO

</a>
</h4>
    </div>
		<?php
    $class='';
	if($nome_cat=='ESAME IMMUNOISTOCHIMICO') $class='in';?>
    <div id="colf" class="panel-collapse collapse <?php echo $class;?>">
      <div class="panel-body">

 <?php

 $id_cat=$db->getCampo('categorie', 'id', array('nome'=>'ESAME IMMUNOISTOCHIMICO'));
$row = $db->selectAll('esami_ordinati_v', array('id_cat'=>$id_cat, 'eliminato'=>''), ' ord asc ');

foreach($row as $r){
	$nome_=$r['nome'];
	$id_=$r['id'];
	($tipo == $id_)? $chk='checked=checked':$chk='';
 ?>
<div class="form-group">

<div class="col-md-2">
   <label>

	  <input type="radio" class="esame"  name="tipo"  id="<?php echo $id_;?>" value="<?php echo $id_;?>" <?php  echo $chk;?>>


	  </label>
</div>
<label class="col-md-10 control-label"><?php echo $nome_;?>
</label>
</div>

<?php
}
?>

</div>
    </div>
  </div>
  <!--inizio pannello -->
  <div class="panel panel-default">
    <div class="panel-heading">
   <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-toggle="collapse" data-parent="#accordion" href="#colg" >

BIOLOGIA MOLECOLARE

</a>
</h4>
    </div>
		<?php
    $class='';
	if($nome_cat=='BIOLOGIA MOLECOLARE') $class='in';?>
    <div id="colg" class="panel-collapse collapse <?php echo $class;?>">
      <div class="panel-body">

 <?php
 $id_cat=$db->getCampo('categorie', 'id', array('nome'=>'BIOLOGIA MOLECOLARE'));

$row = $db->selectAll('esami_ordinati_v', array('id_cat'=>$id_cat, 'eliminato'=>''), ' ord asc ');

foreach($row as $r){
	$nome_=$r['nome'];
	$id_=$r['id'];
	($tipo == $id_)? $chk='checked=checked':$chk='';
 ?>
<div class="form-group">

<div class="col-md-2">
   <label>

	  <input type="radio" class="esame"  name="tipo"  id="<?php echo $id_;?>" value="<?php echo $id_;?>" <?php  echo $chk;?>>


	  </label>
</div>
<label class="col-md-10 control-label"><?php echo $nome_;?>
</label>
</div>

<?php
}
?>

</div>
    </div>
  </div>


   <!--inizio pannello -->
  <div class="panel panel-default">
    <div class="panel-heading">
     <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#coll" >

RICHIESTA COPIA VETRINI


</a>
</h4>
    </div>
	<?php
    $class='';
	if($nome_cat=='RICHIESTA COPIA VETRINI') $class='in';?>
    <div id="coll" class="panel-collapse collapse <?php echo $class;?>">
      <div class="panel-body">

 <?php

 $id_cat=$db->getCampo('categorie', 'id', array('nome'=>'RICHIESTA COPIA VETRINI'));
$row = $db->selectAll('esami_ordinati_v', array('id_cat'=>$id_cat, 'eliminato'=>''), ' ord asc ');

foreach($row as $r){
	$nome_=$r['nome'];
	$id_=$r['id'];
	($tipo == $id_)? $chk='checked=checked':$chk='';
 ?>
<div class="form-group">

<div class="col-md-2">
   <label>
	  <input type="radio" class="esame"  name="tipo"  id="<?php echo $id_;?>" value="<?php echo $id_;?>" <?php  echo $chk;?>>

	  </label>
</div>
<label class="col-md-10 control-label"><?php echo $nome_;?>
</label>
</div>

<?php
}
?>

</div>
    </div>
  </div>

   <!--inizio pannello -->
  <div class="panel panel-default">
    <div class="panel-heading">
     <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#colv" >

SERVIZI EXTRA


</a>
</h4>
    </div>
	<?php
    $class='';
	if($nome_cat=='SERVIZI EXTRA') $class='in';?>
    <div id="colv" class="panel-collapse collapse <?php echo $class;?>">
      <div class="panel-body">

 <?php

 $id_cat=$db->getCampo('categorie', 'id', array('nome'=>'SERVIZI EXTRA'));
$row = $db->selectAll('esami_ordinati_v', array('id_cat'=>$id_cat, 'eliminato'=>''), ' ord asc ');

foreach($row as $r){
	$nome_=$r['nome'];
	$id_=$r['id'];
	($tipo == $id_)? $chk='checked=checked':$chk='';
 ?>
<div class="form-group">

<div class="col-md-2">
   <label>

	  <input type="radio" class="esame"  name="tipo"  id="<?php echo $id_;?>" value="<?php echo $id_;?>" <?php  echo $chk;?>>


	  </label>
</div>
<label class="col-md-10 control-label"><?php echo $nome_;?>
</label>
</div>

<?php
}
?>
<div class="form-group">

<div class="col-md-4">
	  <input type="text"  name="qta3"   value="<?php echo $qta3;?>" >
</div>
<label class="col-md-8 control-label viola">Quantità
 </label>
</div>

    </div>
  </div>
    </div>
</div><!-- fine accordion -->
<input type="hidden" value="step1"  name="action" />

<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn green-meadow" >
									<i class="fa fa-check-circle"></i>salva e avanti
								</button>
							</div>
							<!-- // Form actions END -->


			</form>
			<!-- // Form END -->
</div>
</div>

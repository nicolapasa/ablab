 <?php

 //se vengo dallo step 0 vedo se c'� in sessione il proprietario esistente
 if (isset($_SESSION['pro'])){

 	$param=array('id_struttura'=>$_SESSION['struttura'],  'id'=>$_SESSION['pro']);
 	//recupero dati proprietario
 	if($livello=='administrator') $param=array('id'=>$_SESSION['pro']);
 	$row = $db->selectAll('proprietari', $param);

 	$p= new geo();
	if($row)
 	foreach($row as $r){

 	  $id_proprietario= $_SESSION['pro'];
 		$nome_proprietario = $r['nome_proprietario'];
 		$cognome_proprietario = $r['cognome_proprietario'];
 		$indirizzo_pro = $r['indirizzo_pro'];
 		$id_prov_pro=$r['provincia_pro'];
 		$id_com_pro=$r['comune_pro'];
 		if(isset($r['provincia_pro']))
 		$provincia_pro = $p->getProv($r['provincia_pro']);
 		if(isset($r['comune_pro']))
 		$comune_pro =  $p->getCom($r['comune_pro']);
 		$cap_pro = $r['cap_pro'];
 		$email_pro = $r['email_pro'];
 		$cod_pro = $r['cod_pro'];
		$pec_pro=$r['pec_pro'];
		   $medico_ref=$r['medico_ref'];


 }

 }

 //se id scheda gi� in sessione recupero dati e li ripresento nel form
 if (isset($_SESSION['scheda'])){


 	$row = $db->selectAll('schede', array('id'=>$_SESSION['scheda'], 'anno'=>date(Y)));
 	if($row)
 	foreach($row as $r){


 		$id_proprietario = $r['id_proprietario'];

 		$destinatario = $r['destinatario'];

		$tipo=$r['tipo'];
		$id_cat=(int) $db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo));
 	}


 	//recupero dati proprietario

 	$row = $db->selectAll('proprietari', array('id'=>$id_proprietario));

 	$p= new geo();
	if($row)
 	foreach($row as $r){

 		$nome_proprietario = $r['nome_proprietario'];
 		$cognome_proprietario = $r['cognome_proprietario'];
 		$indirizzo_pro = $r['indirizzo_pro'];
 		$id_prov_pro=$r['provincia_pro'];
 		$id_com_pro=$r['comune_pro'];
 		if(isset($r['provincia_pro']))
 		$provincia_pro = $p->getProv($r['provincia_pro']);
 		if(isset($r['comune_pro']))
 		$comune_pro =  $p->getCom($r['comune_pro']);
 		$cap_pro = $r['cap_pro'];
 		$email_pro = $r['email_pro'];
 		$cod_pro = $r['cod_pro'];
		$tel_pro=$r['tel_pro'];
 	    $medico_ref=$r['medico_ref'];
		$pec_pro=$r['pec_pro'];
 	}

 	//recupero dati animale


 	$row = $db->selectAll('animale', array('id_scheda'=>$_SESSION['scheda']));
 	$a= new Animale();
 	if($row)
 	foreach($row as $r){

 		$idrazza = $r['razza'];
 		$nomerazza=$r['razza'];
 		$idspecie = $r['specie'];
 		$nomespecie=($a->getAnimal($idspecie, 'specie'));
 		$idorgano = $r['organo'];
 		$nomeorgano=$r['organo'];
 		$sesso = $r['sesso'];
 		$integrita = $r['integrita'];
 		$anamnesi = $r['anamnesi'];
 		$eta=$r['eta'];
 		$nomeani=$r['nome'];
 	}
 }


 ?>

 <form class="form-bordered form" id="sec4"
				enctype='multipart/form-data' action="save_esami.php" method="post"
				autocomplete="off">

<div class="portlet light bordered lilla">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-red-sunglo"></i>
                                        <span class="caption-subject bold uppercase">Anamnesi</span>
                                    </div>

                                </div><!--title-->
                                <div class="portlet-body form">





 <?php


 if (isset($_SESSION['struttura'])){
$id_struttura=$_SESSION['struttura'];

$row= $db->selectAll('admin', array('id'=>$id_struttura));
$p= new geo();
foreach($row as $r){

	$idstruttura=$r['id'];
	$nomestruttura=$r['nome'];


}
?>

 <?php if($livello=='administrator'){?>
<div class="alert alert-info bold">Struttura selezionata: <?php echo $nomestruttura;  ?></div>
 <?php } ?>
<input type="hidden" name="struttura" value="<?php echo $idstruttura; ?>">
<!-- Alert -->
<div class="alert alert-danger  bold">

	I campi indicati con * sono obbligatori, il sistema non salva finché non sono stati compilati.
</div>
<!-- // Alert END -->

<?php

}
if ($_SESSION['dest']=='clinica'){?>

<div class="alert alert-info bold">Dati proprietario</div>

<div class="form-group row">
<label class="col-md-3 col-form-label bold">Medico Referente:</label>
   <div class="col-md-6">
<input type="text"   class="form-control " name="medico_ref" placeholder="medico referente" value="<?php echo $medico_ref;?>" />
</div>
</div>
<br>
<div class="form-group row">
<label class="col-md-3 col-form-label bold">Cognome Proprietario:</label>
<div class="col-md-6">
<input type="text" class="form-control" name="cognome_proprietario" placeholder="cognome proprietario" value="<?php echo $cognome_proprietario;?>" /> <br />
</div>
</div>
<div class="form-group row">
<label class="col-md-3 col-form-label bold">Nome Proprietario:</label>
<div class="col-md-6">
  <input type="text"  class="form-control" name="nome_proprietario" placeholder="nome proprietario" value="<?php echo $nome_proprietario;?>" /> <br />
</div>
</div>




<?php
}else{
?>
<div class="alert alert-info bold">Dati proprietario</div>

<div class="form-group row">
<label class="col-md-3 col-form-label bold">Nome medico referente:</label>
   <div class="col-md-6">
<input type="text"   class="form-control " name="medico_ref" placeholder="medico referente" value="<?php echo $medico_ref;?>" />
</div>
</div>

<div class="form-group row">
<label class="col-md-3 col-form-label bold">Cognome Proprietario: *</label>
<div class="col-md-6">
<input type="text"  class="form-control"  name="cognome_proprietario" placeholder="cognome proprietario" value="<?php echo $cognome_proprietario;?>" />
</div>
</div>

<div class="form-group row"><label class="col-md-3 col-form-label bold">Nome Proprietario: *</label>
<div class="col-md-6"><input type="text" class="form-control"  name="nome_proprietario" placeholder="nome proprietario" value="<?php echo $nome_proprietario;?>" /> <br />
</div>
</div>

<div class="form-group row"><label class="col-md-3 col-form-label bold">Provincia proprietario *</label>
<div class="col-md-6">
<select  name="provincia_pro" class="form-control provincia_pro">
<option value="<?php echo $id_prov_pro;?>" selected="selected"><?php echo $provincia_pro;?></option>
<?php
$row= $db->selectAll('province', null, ' nomeprovincia asc ');

foreach($row as $r){

$idprovincia=$r['id'];
$nomeprovincia=$r['nomeprovincia'];

?><option value="<?php echo $idprovincia;?>" ><?php echo $nomeprovincia;?></option>
<?php
 }
?>
</select>
</div>
</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">Comune proprietario *</label>
<div class="col-md-6">
<select name="comune_pro" class="comune_pro form-control">
<option value="<?php echo $id_com_pro;?>" selected="selected"><?php echo $comune_pro;?></option>
</select>
</div>
</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">Indirizzo Proprietario: *</label>
<div class="col-md-6"><input class="form-control" type="text"  name="indirizzo_pro" placeholder="indirizzo proprietario" value="<?php echo $indirizzo_pro;?>" />
</div>
</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">Cap Proprietario: *</label>
<div class="col-md-6"><input class="form-control" type="text"  name="cap_pro" placeholder="cap proprietario" value="<?php echo $cap_pro;?>" />
</div>
</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">E-mail Proprietario: *</label>
<div class="col-md-6"><input class="form-control" type="text"  name="email_pro" placeholder="e-mail proprietario" value="<?php echo $email_pro;?>" />
</div>
</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">PEC Proprietario(inserire solo qualora il proprietario abbia una mail PEC personale): </label>
<div class="col-md-6"><input class="form-control" type="text"  name="pec_pro"  value="<?php echo $pec_pro;?>" />
</div>
</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">Codice Fiscale Proprietario: *</label>
<div class="col-md-6"><input class="form-control" type="text"  name="cod_pro" placeholder="codice fiscale" value="<?php echo $cod_pro;?>" />
</div>
</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">Telefono Proprietario: *</label>
<div class="col-md-6"><input  class="form-control" type="text"  name="tel_pro" placeholder="telefono" value="<?php echo $tel_pro;?>" />
</div>
</div>

<?php }?>
<?php if($tipo!=88){


?>
<div class="alert alert-info bold">Dati animale</div>
<div class="form-group row"><label class="col-md-3 col-form-label bold">Animale *</label>
<div class="col-md-6">
<select id="specie" name="specie" class="form-control specie">
<option value="<?php echo $idspecie;?>" selected="selected"><?php echo $nomespecie;?></option>
<?php
$row= $db->selectAll('specie', null, ' id asc ');

foreach($row as $r){
	//$r=$cl->pulisci($r);
$idspecie=$r['id'];
$nomespecie=utf8_encode($r['nome']);

?><option value="<?php echo $idspecie;?>" ><?php echo $nomespecie;?></option>
<?php
 }
?>
</select>
</div>
</div>


<div class="form-group row"><label class="col-md-3 col-form-label bold">Specie/razza *</label>
<div class="col-md-6">
<select id="razza" name="razza" class="razza form-control">
<option value="<?php echo $nomerazza;?>" selected="selected"><?php echo $nomerazza;?></option>
</select>
</div>
</div>


<div class="form-group row"><label class="col-md-3 col-form-label bold">Campione *</label>
<div class="col-md-6">
<select name="organo" class="form-control organo">
<option value="<?php echo $nomeorgano;?>" selected="selected"><?php echo $nomeorgano;?></option>
<?php
$row= $db->selectAll('organo', null, ' nome asc ');
if(count($row)>0){
foreach($row as $r){

$idorgano=$r['id'];
$nomeorgano=utf8_encode($r['nome']);

?><option value="<?php echo $nomeorgano;?>" ><?php echo $nomeorgano;?></option>
<?php
 }
}else{
	?><option value="" ></option><?php

}
?>
<option value="0">Altro</option>
</select>
</div>
</div>


<div class="form-group row">
<label class="col-md-3 col-form-label bold">Sesso *</label>
<div class="col-md-6">
<select id="sesso" name="sesso" class="form-control sesso">
<option value="<?php echo $sesso;?>" selected="selected"><?php echo $sesso;?></option>
<option value="Maschio">Maschio</option>
<option value="Femmina">Femmina</option>
<option value="Non applicabile">Non applicabile</option>
</select>
</div>
</div>
  <?php
$int1='';
$int2='';


if($integrita == 'intero') $int1='checked';
if($integrita == 'castrato') $int2='checked';

 ?>
  <div class="form-group row int">

<label class="col-md-3 col-form-label bold">intero *
 </label>

<div class="col-md-4">

        <label>
<input type="radio" name="integrita" id="int1"  value="intero" <?php  echo $int1;?>>
</label>
</div>
</div>
 <div class="form-group row int">

 <label class="col-md-3 col-form-label bold">castrato/sterilizzato
 </label>

<div class="col-md-4">

        <label>
<input type="radio" name="integrita" id="int2" value="castrato" <?php  echo $int2;?>>
</label>
</div>
</div>


 <div class="form-group row"><label class="col-md-3 col-form-label bold">Età animale: *</label>
<div class="col-md-6"><input type="text"  name="eta"  value="<?php echo $eta;?>" />
</div>
</div>
 <div class="form-group row"><label class="col-md-3 col-form-label bold">Nome animale:</label>
<div class="col-md-6"><input type="text"  name="nome" value="<?php echo $nomeani;?>" />
</div>
</div>
<?php //solo per determinati esami
if(($id_cat != 6 and $id_cat != 7) or ($id_cat==3 and ($tipo != 23 and $tipo != 17 and $tipo != 34)) ) {


?>
<!-- Alert -->
<div class="alert alert-custom">

	<strong>ATTENZIONE!</strong> In anamnesi è importante indicare con precisione la sede di
prelievo
	per una refertazione completa ed indicativa.
	<br>

In caso di indagini citologiche e istologiche,
indicate sede di prelievo precisa, tipo di prelievo,
dimensioni della massa, tempo di insorgenza ed eventuale coinvolgimento
di altre strutture (anche linfonodale).
</div>
<!-- // Alert END -->
 <div class="form-group row"><label class="col-md-3 col-form-label bold">Anamnesi:</label>
<div class="col-md-9">
<textarea class="form-control" name="anamnesi"  rows="5"><?php echo $anamnesi;?></textarea>
</div>
</div>

<?php
}
}
?>
<input type="hidden" value="step4"  name="action" />

<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn green-meadow">
									<i class="fa fa-check-circle"></i>
									SALVA E AVANTI
								</button>
									<a  class="btn btn-danger" href="back.php?action=step4">
									<i class="fa fa-times"></i>INDIETRO
								</a>
							</div>
							<!-- // Form actions END -->
					</div>
					<!-- // Widget END -->
				</div>

			</form>

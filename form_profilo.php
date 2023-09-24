<?php

$id_admin = (int)$_GET['id_admin'];

$cl=new Clear();

$row= $db->selectAll('admin', array('id'=>$id_admin));

$p= new geo();
if(count($row)>0){

foreach($row as $r){
	$r=$cl->pulisci($r);
	$r=$cl->htmlspecialchars_array($r);
$id_admin = $r['id'];
$livello_u = $r['livello'];
$user = $r['username'];
$pass = $r['password'];
$nomes = $r['nome'];
$nome_ref=$r['nome_ref'];
$indirizzo = $r['indirizzo'];
$email = $r['email'];
$email_fatt = $r['email_fatt'];
$nazione=$r['nazione'];
$orario=$r['orario'];

$utenza_estera=$r['utenza_estera'];

$piva = $r['piva'];
if(is_numeric($r['comune'])){
	$comune =  $p->getCom($r['comune']);
}
else{
	$comune =  $r['comune'];
}

$idcomune=$r['comune'];
$medici=$r['medici'];
if(is_numeric($r['provincia'])){
	$provincia = $p->getProv($r['provincia']);
}
else{
	$provincia = $r['provincia'];
}

$foto= $r['foto'];
$referente= $r['referente'];
$telefono= $r['telefono'];
$cap= $r['cap'];
$cf = $r['cf'];
$telefono = $r['telefono'];
$cell = $r['cell'];
$fax = $r['fax'];
$pec=$r['pec'];
$cod_uni=$r['cod'];
$ind_spe=$r['ind_spe'];
//gestione riba
$mod_pag=$r['mod_pag'];
$iban=trim($r['iban']);
$abi=trim($r['abi']);
$cab=trim($r['cab']);
$firma=$r['firma'];

   }
}

?>
<form class="form-horizontal" id="profilo"
				enctype='multipart/form-data' action="save.php" method="post"
				autocomplete="off">
				<!-- Widget -->
		<div class="portlet light bordered lilla">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-red-sunglo"></i>
                                        <span class="caption-subject bold uppercase">Profilo Utente</span>
                                    </div>

                                </div><!--title-->
                                <div class="portlet-body form">


<?php
if($_GET['res']=='ok'){

	?>

	<div class="alert alert-info">
	Dati salvati correttamente
	</div>

	<?php
}

	?>
	<?php
if($_GET['mess']=='pec' or ($pec=='' and $cod_uni=='') ){

	?>

	<div class="alert alert-info">
	Per continuare inserisci la tua PEC oppure il Codice univoco
	</div>

	<?php
}

	?>

<?php if($livello== 'administrator'){ ?>

<div class="form-group row ref">
<label class="col-md-4 col-form-label bold">Livello:</label>
<div class="col-md-8">
<select class="form-control livello ref" name="livello" >
<option value="<?php echo $livello_u;?>"><?php echo $livello_u; ?></option>
<option value="administrator" >administrator</option>
<option value="struttura" >struttura</option>
<option value="service" >service</option>
<option value="referti" >referti</option>
</select></div></div>
<?php }else{
?>
<input type="hidden" value="<?php echo $livello;?>"  name="livello" />
<?php

}	?>
	<div class="form-group row ref">
	<label class="col-md-4 col-form-label bold">Nome struttura (dicitura che apparirà in referti):</label>
	<div class="col-md-8">
	<input type="text" class="form-control ref" name="nome_ref" value="<?php echo $nome_ref;  ?>"  />
	</div>
	</div>

	<?php if($livello_u!= 'referti'){ ?>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Referente:</label>
<div class="col-md-8">
<input type="text" class="form-control"  name="referente" value="<?php echo $referente;  ?>"  />
</div>
</div>
<?php }?>
<div class="form-group row ref">
<label class="col-md-4 col-form-label bold">Username:</label>
<div class="col-md-8">
<input type="text" class="form-control ref"  name="username" value="<?php echo $user;  ?>"  />
</div>
</div>

<div class="form-group row ref">
<label class="col-md-4 col-form-label bold">Password:</label>
 <div class="col-md-8">
<input type="text" class="form-control ref"  name="password" value="<?php echo $pass;  ?>"  />
</div>
</div>
<div class="form-group row ref">
<label class="col-md-4 col-form-label bold">Cellulare:</label>
<div class="col-md-8">
<input type="text"  name="cell"  class="form-control"  value="<?php echo $cell;  ?>"  />
</div>
</div>
<?php if($livello_u!= 'referti'){ ?>


<div class="form-group row">
<label class="col-md-4 col-form-label bold">Telefono:</label>
	<div class="col-md-8">
<input type="text"  name="telefono"  class="form-control"   value="<?php echo $telefono;  ?>" />
</div>
</div>



<div class="form-group row">
<label class="col-md-4 col-form-label bold">Fax:</label>
<div class="col-md-8">
<input type="text"  name="fax"  class="form-control"  value="<?php echo $fax;  ?>" />
</div>
</div>

<div class="form-group row ref">
<label class="col-md-4 col-form-label bold">Email refertazione (se volete inserire più email separatele con il punto e virgola o non riceverete comunicazioni
e aggiornamenti):</label>
<div class="col-md-8">
<input type="text"  name="email"  class="form-control ref"  value="<?php echo $email;  ?>"  />

</div>
</div>
<?php }?>
<div class="form-group row ref">
<label class="col-md-4 col-form-label bold">Indirizzo di spedizione:</label>
<div class="col-md-8">
<input type="text"  class="form-control ref"  name="ind_spe" value="<?php echo $ind_spe;  ?>"  />
</div></div>
<?php if($livello== 'referti' or $livello=='administrator' and $livello_u=='referti' ){ ?>

<div class="form-group row ref">
<label class="col-md-4 col-form-label bold">Firma referto:</label>
<div class="col-md-8">
<textarea class="form-control ref"  name="firma" ><?php echo $firma;  ?> </textarea>
</div></div>


<?php }?>	

<?php if($livello_u!= 'referti'){ ?>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Orari di apertura:</label>
<div class="col-md-8">
<textarea class="form-control"  name="orario" ><?php echo $orario;  ?> </textarea>
</div></div>
<fieldset class="fieldset fatt">
<h3 class="fatt">Dati Fatturazione</h3>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Ragione sociale (dicitura che apparirà in fattura):</label>
<div class="col-md-8">
<input type="text" class="form-control" name="nome" value="<?php echo $nomes;  ?>"  />
</div>
</div>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Partita Iva:</label>
<div class="col-md-8">
<input type="text" class="form-control" name="piva" value="<?php echo $piva;  ?>"  />
</div></div>

<div class="form-group row">
<label class="col-md-4 col-form-label bold">Codice Fiscale:</label>
	<div class="col-md-8">
<input class="form-control" type="text"  name="cf"  value="<?php echo $cf;  ?>"  />
</div>
</div>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Nazione:</label>
<div class="col-md-8">
<select name="nazione" class="form-control nazione">
<?php if($nazione==''){
	?>
<option value="Italia" selected="selected">Italia</option>
<?php
}	else {


?>
<option value="<?php echo $nazione;?>" selected="selected"><?php echo $nazione;?></option>
<?php
}
$row= $db->selectAll('nazioni', null, '  nome asc ');

foreach($row as $r){


$nomenazione=$r['nome'];

?><option value="<?php echo $nomenazione;?>" ><?php echo $nomenazione;?></option>
<?php
 }
?>
</select>
</div>
</div>
<?php
 if($nazione=='Italia' or $nazione==''){

$class_input="hide_input";
$class_select="";
 }
 else{
	$class_select="hide_select";
	$class_input="";
 }
?>
<div class="<?php echo $class_select;?>" id="select_localita">
<div class="form-group row ">
<label class="col-md-4 col-form-label bold">Provincia:</label>
<div class="col-md-8">
<select name="provincia" class="form-control provincia">
<option value="<?php echo $provincia;?>" selected="selected"><?php echo $provincia;?></option>
<?php
$row= $db->selectAll('province', null, '  nomeprovincia asc ');

foreach($row as $r){

$idprovincia=$r['id'];
$nomeprovincia=$r['nomeprovincia'];

?><option value="<?php echo $nomeprovincia;?>" ><?php echo $nomeprovincia;?></option>
<?php
 }
?>
</select>
</div>
</div>

<div class="form-group row">
<label class="col-md-4 col-form-label bold">Comune:</label>
<div class="col-md-8">
<select name="comune" class="form-control comune">
<option value="<?php echo $comune;?>" selected="selected"><?php echo $comune;?></option>
</select>
</div>
</div>

</div>
<div class="<?php echo $class_input;?>" id="text_localita">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Provincia:</label>
<div class="col-md-8">
<input type="text" name="provincia_txt" class="form-control" value="<?php echo $provincia;?>">
</div>
</div>

<div class="form-group row">
<label class="col-md-4 col-form-label bold">Comune:</label>
<div class="col-md-8">
<input type="text" name="comune_txt" class="form-control" value="<?php echo $comune;?>">
</div>
</div>
</div>

<div class="form-group row">
<label class="col-md-4 col-form-label bold">Indirizzo:</label>
<div class="col-md-8">
<input type="text"  class="form-control"  name="indirizzo" value="<?php echo $indirizzo;  ?>"  />
</div></div>


<div class="form-group row">
<label class="col-md-4 col-form-label bold">Cap:</label>
	<div class="col-md-8">
<input type="text"  name="cap"   class="form-control"   value="<?php echo $cap;  ?>" />
</div>
</div>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Codice univoco:</label>
<div class="col-md-8">
<input type="text" id="cod" name="cod"  class="form-control"  value="<?php echo $cod_uni;  ?>"  />

</div>
</div>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Email PEC:</label>
<div class="col-md-8">
<input type="text" id="pec" name="pec"  class="form-control"  value="<?php echo $pec;  ?>"  />

</div>
</div>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Email fatturazione non PEC:</label>
<div class="col-md-8">
<input type="text" class="form-control" name="email_fatt" value="<?php echo $email_fatt;  ?>"  />
</div>
</div>
</fieldset>

<?php }?>


<?php if($livello== 'administrator' and $livello_u !='referti'){ ?>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Modalità di pagamento:</label>
<div class="col-md-8">
<select class="form-control" id="mod_pag" name="mod_pag" >
<option value="<?php echo $mod_pag;?>"><?php echo $mod_pag; ?></option>
<option value="riba" >riba</option>
<option value="bonifico" >bonifico</option>
</select></div></div>

<?php

if($mod_pag=='riba'){

	//campi iban abi e cab
?>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">IBAN:</label>
	<div class="col-md-8">
<input class="form-control" type="text" id="iban" name="iban"  value="<?php echo $iban;  ?>"  />
</div>
</div>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">ABI:</label>
	<div class="col-md-8">
<input class="form-control" type="text" id="abi"  name="abi"  value="<?php echo $abi;  ?>"  />
</div>
</div>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">CAB:</label>
	<div class="col-md-8">
<input class="form-control" type="text" id="cab" name="cab"  value="<?php echo $cab;  ?>"  />
</div>
</div>

<?php


}


}
?>




<?php if($livello_u!= 'referti'){ ?>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Carica foto profilo</label>
<div class="col-md-8">
<div class="fileupload fileupload-new margin-none" data-provides="fileupload">
  	<span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span>
  	<span class="fileupload-exists">Change</span><input class="form-control" name="foto" type="file" class="margin-none" /></span>
  <?php if($foto!=''){?>	<span class="fileupload-preview"><a class="btn btn-primary" target="_blank" href="<?php echo DIR_UPLOAD.$foto;?>"  >
  <?php 	if(preg_match('/(JPG|jpg|gif|png|gif|bmp)$/',Utility::getExt(DIR_UPLOAD.$foto))){?>
  <img src="<?php echo DIR_UPLOAD.$foto;?>"  width="100"/><?php }else{echo "scarica";}?></a></span><?php }?>
  	<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>
</div>
</div>
</div>
<?php }?>

<input type="hidden" value="<?php echo $id_admin;  ?>"  name="id_admin" id="id_admin" />
<input type="hidden" value="mod_utente"  name="action" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary salva"  onclick="submitForm(this);">
									<i class="fa fa-check-circle"></i> Salva
								</button>
								<?php if($livello== 'administrator'){ ?>
								<a  class="btn btn-default" href="index.php?req=admin" >
								<i class="fa fa-list"></i>TORNA A ELENCO UTENZE
								</a>
								<?php }?>
							</div>
							<!-- // Form actions END -->

						</div>
					</div>
					<!-- // Widget END -->

			</form>
			<!-- // Form END -->

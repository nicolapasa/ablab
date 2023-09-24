<?php
switch ($subreq){
	case 'offline':

		$offline= $db->getCampo('opzioni','value', array('nome'=>'offline'));
		?>
		<form class="form-horizontal" id="form-nm"
					enctype='multipart/form-data' action="save.php" method="post"
					autocomplete="off">
					<!-- Widget -->
					<div class="widget">

						<!-- Widget heading -->
						<div class="widget-head">
							<h4 class="heading">Amministrazione gestione online/offline</h4>
						</div>
						<!-- // Widget heading END -->
				<div class="widget-body innerAll inner-2x colorLilla">

							<!-- Row -->
							<div class="row innerLR">


	<?php  if ($offline=='n'){

	?>

	<div class="alert alert-info">

Il software è regolarmente online.
</div><div class="separator"></div>
	<?php

	}
		?>
		<?php  if ($offline=='s'){

	?>
		<div class="alert alert-danger">
	<strong>Attenzione!</strong>Il sito è  offline per manutenzione.

</div><div class="separator"></div>
	<?php

	}
		?>



	<div class="form-group"><label class="col-md-4 control-label">Metti online/offline</label>
	<div class="col-md-8">
		<select  name="value"  >
		<option value="<?php echo $offline;?>" selected="selected"><?php echo $offline;?></option>
		<option value="s">s</option>
		<option value="n">n</option>
		</select>
		</div></div>
		<div class="separator"></div>
	   <input type="hidden" value="offline"  name="action" />
       <input type="hidden" value="offline"  name="nome" />

	<!-- Form actions -->
								<div class="form-actions">
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-check-circle"></i> Invia
									</button>

								</div>
								<!-- // Form actions END -->

							</div>
						</div>
						<!-- // Widget END -->
					</div>
				</form>
				<!-- // Form END -->
	<?php

	break;
case 'template':

$id=(int)$_GET['id'];

$nome_templ= $db->getCampo('template','nome', array('id'=>$id));
$html_templ= $db->getCampo('template','template', array('id'=>$id));

	if($id>0){
	?>
	<a class="btn btn-primary" href="index.php?req=admin&subreq=mail&id=<?php echo $id;?>" >
			<span><i class="fa fa-check">Imposta per la Newsletter</i></span></a>
	<?php }?>
	<form class="form-horizontal" id="form-nm"
				enctype='multipart/form-data' action="save.php" method="post"
				autocomplete="off">
				<!-- Widget -->
				<div class="widget">

					<!-- Widget heading -->
					<div class="widget-head">
						<h4 class="heading">Salvataggio/modifica Template Newsletter</h4>
					</div>
					<!-- // Widget heading END -->
			<div class="widget-body innerAll inner-2x colorLilla">

						<!-- Row -->
						<div class="row innerLR">




<div class="form-group"><label class="col-md-3 control-label">Nome:</label>
<div class="col-md-9">
	<input type="text" class="form-control" name="nome" value="<?php echo $nome_templ;?>"  /></div></div>


<div class="form-group"><label class="col-md-3 control-label">Template:</label>
<div class="col-md-9">
     <textarea class="form-control editor2" name="template" >
	<?php echo $html_templ;?>

	 </textarea>
     </div></div>

      <input type="hidden" value="template" name="action" />

      <input type="hidden" value="<?php echo $id;?>" name="id" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i> Invia
								</button>
								<button type="button" class="btn btn-default">
									<i class="fa fa-times"></i> Cancel
								</button>
							</div>
							<!-- // Form actions END -->

						</div>
					</div>
					<!-- // Widget END -->
				</div>
			</form>
			<!-- // Form END -->
<?php

break;

case 'mail':

//scelta template


$id_n=(int)$_GET['id_n'];

foreach($db->selectAll('newsletter', array('id'=>$id_n))   as $r){

	$template=$r['testo'];
	$oggetto=$r['oggetto'];
	$file=$r['file'];
	$attached=$r['attached'];

}

	?>
	<form class="form-horizontal" id="form-nm"
				enctype='multipart/form-data' action="send_mail.php" method="post"
				autocomplete="off">
				<!-- Widget -->
				<div class="widget">

					<!-- Widget heading -->
					<div class="widget-head">
						<h4 class="heading">Amministrazione Mailing list</h4>
					</div>
					<!-- // Widget heading END -->
			<div class="widget-body innerAll inner-2x colorLilla">

						<!-- Row -->
						<div class="row innerLR">



<?php  if ($_GET['respo']=='ok'){

?><div class="alert alert-success">
La Newsletter è stata inviata. </div><?php

}
	?>
<?php  if ($_GET['respo']=='ante'){

?><div class="alert alert-success">
L'anteprima è stata inviata. Per inviarla a tutti spunta la casella INVIA.</div><?php

}
	?>
<div class="form-group">
<label class="col-md-9 control-label">Invia: (se la newsletter è pronta inviala al task per spedirla alle cliniche)</label>
<div class="col-md-3">

	<input type="checkbox"  name="anteprima"  value="s" />


	</div></div>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Invia a:</label>
<div class="col-md-8">
	<select  name="livello[]"  class="bs-select form-control" data-live-search="true" multiple>
 <option value="" selected></option>
	<option value="tutti" >tutti</option>
 <option value="struttura" >struttura</option>
<option value="service" >service</option>
<?php
$row= $db->selectAll('admin', null, ' nome_ref asc ');
$p= new geo();
foreach($row as $r){

$idstruttura=$r['id'];
$nomestruttura=$r['nome_ref'];
$nomeprovincia = $r['provincia'];

?><option value="<?php echo $idstruttura;?>" ><?php echo $nomestruttura . ' ' . $nomeprovincia;?></option>
<?php
 }
?>


</select>
</div></div>
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Email a cui inviare(default email di refertazione):</label>
<div class="col-md-8"><select  name="sel_email"  class="form-control">
 <option value="" selected></option>
 <option value="ref" >refertazione</option>
<option value="fat" >amministrazione</option>
</select>
</div></div>
<div class="form-group"><label class="col-md-3 control-label">Oggetto:</label>
<div class="col-md-9">
	<input type="text" class="form-control" name="oggetto" value="<?php echo $oggetto;?>" /></div></div>

<div class="form-group">
	<label class="col-md-4 control-label"  for="author">Carica Newsletter</label>
	<div class="col-md-8">
	<div class="fileupload fileupload-new margin-none" data-provides="fileupload">
	  	<span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span>
	  	<span class="fileupload-exists">Change</span>
	  	<input name="file"  type="file" class="margin-none"  /></span>
		<?php if($file!=''){?>
		<input type="hidden" name="file" value="<?php echo $file;?>">
	  	<span class="fileupload-preview"><a class="btn btn-primary" target="_blank" href="<?php echo DIR_UPLOAD.$file;?>"  >
	  <?php 	if(preg_match('/(JPG|jpg|gif|png|gif|bmp)$/',Utility::getExt(DIR_UPLOAD.$file))){?>
	  <img src="<?php echo DIR_UPLOAD.$file;?>"  width="100"/><?php }else{echo $file;}?></a></span>
		<?php }?>
	  	<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>
	</div>
	</div>
	</div>
	<div class="form-group">
	<label class="col-md-4 control-label"  for="author">Allega un file</label>
	<div class="col-md-8">
	<div class="fileupload fileupload-new margin-none" data-provides="fileupload">
	  	<span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span>
	  	<span class="fileupload-exists">Change</span>
	  	<input name="attached"  type="file" class="margin-none"  /></span>
		<?php if($attached!=''){?>
		<input type="hidden" name="attached" value="<?php echo $attached;?>">
	  	<span class="fileupload-preview"><a class="btn btn-primary" target="_blank" href="<?php echo DIR_UPLOAD.$attached;?>"  >
	  <?php 	if(preg_match('/(JPG|jpg|gif|png|gif|bmp|pdf|xsl|xslx|doc|docx|txt)$/',Utility::getExt(DIR_UPLOAD.$attached))) { echo $attached; } ?></a></span>
		<?php } ?>
	  	<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>
	</div>
	</div>
	</div>
<div class="form-group"><label class="col-md-3 control-label">Testo:</label>
<div class="col-md-9">
     <textarea class="form-control editor2" name="testo" >
	 <?php echo $template;?>

	 </textarea>
     </div></div>



       <input type="hidden" value="<?php echo $id_n;?>" name="id" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary" onclick="submitForm(this);">
									<i class="fa fa-check-circle"></i> Invia
								</button>
								<button type="button" class="btn btn-default">
									<i class="fa fa-times"></i> Cancel
								</button>
							</div>
							<!-- // Form actions END -->

						</div>
					</div>
					<!-- // Widget END -->
				</div>
			</form>






<br>
<br>
<div class="alert alert-info">
Newsletter inviate o in attesa di essere inviate
</div>
<div class="table-responsive">
 <table class="table table-striped table-bordered table-hover table-header-fixed" >
    <thead>
<tr>
	 <th>
Titolo
    </th>
    <th>
	Data
	</th>
     <th>
  Modifica
  </th>
     <th>
 Elimina
  </th>
  <th>
Inviata
  </th>

    </tr>
   </thead>
   <tbody>
<?php
$row= $db->selectAll('newsletter', null, ' id desc ');




			foreach($row as $r){


				$data=Utility::getTime($r['data']);
				$oggetto=$r['oggetto'];
				$id_news=$r['id'];

				foreach($db->selectAll('mailing_list', array('id_news'=>$id_news, 'tipo'=>'newsletter')) as $r2){


					$completa=$r2['completa'];


				}

				?>
				<tr>
				<td>
				<?php echo $oggetto;?>
				</td>
					<td>
				<?php echo $data;?>
				</td>
				         <td>


<a class="btn btn-primary" href="index.php?req=admin&subreq=mail&id_n=<?php echo $id_news;?>" >
			<span><i class="fa fa-edit"></i></span></a>
</td>
			  <td>
<input type="hidden" value="newsletter" >
<a class="btn btn-primary delete" id="<?php echo $id_news;?>">
			<span><i class="fa fa-trash"></i> </span></a>


        </td>
		<td>
		<?php echo $completa;?>

		</td>
		</tr>
				<?php

			}

?>
</tbody>
</table>
<!--

<a class="btn btn-primary" href="index.php?req=admin&subreq=template" >
			<span><i class="fa fa-plus"></i>Nuovo Template</span></a>
<div class=" flip-scroll">
 <table class="table table-bordered table-striped table-condensed flip-content" >
        <thead class="flip-content">
    <tr>
	 <th>
Nome Template
    </th>

     <th>
  Modifica
  </th>
     <th>
 Elimina
  </th>
  <th>
  Imposta
  </th>

    </tr>
   </thead>
   <tbody>
<?php
$row= $db->selectAll('template');




			foreach($row as $r){


				$id_tmpl= $r['id'];

				$nome_tmpl=$r['nome'];




?>
<tr>
<td>
<?php echo $nome_tmpl;?>
</td>
         <td>


<a class="btn btn-primary" href="index.php?req=admin&subreq=template&id=<?php echo $id_tmpl;?>" >
			<span><i class="fa fa-edit"></i></span></a>
</td>
			  <td>
<input type="hidden" value="template" >
<a class="btn btn-primary delete" id="<?php echo $id_tmpl;?>">
			<span><i class="fa fa-trash"></i> </span></a>


        </td>
<td>


<a class="btn btn-primary" href="index.php?req=admin&subreq=mail&id=<?php echo $id_tmpl;?>" >
			<span><i class="fa fa-check"></i></span></a>
</td>
</tr>



<?php



			}


?>
</tbody>
</table>
-->

			<!-- // Form END -->
<?php

break;

case 'report_refertatori':


	include('report_refertatori.php');
	
	
break;



case 'modifica':


include('form_profilo.php');


break;
case 'check_inattivi':


include('check_inattivi.php');


break;

case 'check_mai':
	include('check_mai.php');

break;
default:
?>
<!-- heading -->
<h4 class="innerAll margin-none bg-white">Amministrazione Ricerca struttura</h4>

<a class="btn btn-primary " href="index.php?req=admin&subreq=check_inattivi">Cliniche inattive</a>

<a class="btn btn-primary " href="index.php?req=admin&subreq=check_mai">Cliniche che non hanno mai inviato </a>

<a class="btn btn-primary " href="index.php?req=report_refertatori">Report refertatori </a>
<a class="btn btn-primary " href="index.php?req=elenco_refertatori">Elenco refertatori </a>
<?php
 Utility::getEscape($_GET);

	$sql="select * from admin where username != ''  and livello !='referti' ";

if($_GET['struttura']!=''){

	$struttura=$_GET['struttura'];
	 $sql.=" and LOWER(nome) like LOWER('%$struttura%') ";
	 Utility::array_push_associative($search, array('struttura'=>$_GET['struttura']));
}
if($_GET['nome_ref']!=''){

	$nome_ref=$_GET['nome_ref'];
	 $sql.=" and LOWER(nome_ref) like LOWER('%$nome_ref%') ";
	 Utility::array_push_associative($search, array('nome_ref'=>$_GET['nome_ref']));
}

if($_GET['email']!=''){

	$email=$_GET['email'];
	 $sql.=" and LOWER(email) like LOWER('%$email%') ";
	 Utility::array_push_associative($search, array('email'=>$_GET['email']));
}
if($_GET['provincia']!=''){

	$provincia=$_GET['provincia'];
	 $sql.=" and provincia =  '$provincia' ";
	 Utility::array_push_associative($search, array('provincia'=>$_GET['provincia']));
}
if($_GET['livello']!=''){

	$livello=$_GET['livello'];
	 $sql.=" and livello =  '$livello' ";
	 Utility::array_push_associative($search, array('livello'=>$_GET['livello']));
}
if($_GET['attivo']!=''){

	$attivo=$_GET['attivo'];
	 $sql.=" and attivo =  '$attivo' ";
	 Utility::array_push_associative($search, array('attivo'=>$_GET['attivo']));
}
if($_GET['codice']!=''){

	$codice=$_GET['codice'];
	if($codice=='s')  $sql.=" and cod !=  '' ";
		if($codice=='n')  $sql.=" and cod =  '' ";
	 Utility::array_push_associative($search, array('codice'=>$_GET['codice']));
}

if($_GET['piva']!=''){

	$piva=$_GET['piva'];
	$sql.=" and piva =  '$piva' ";
	 Utility::array_push_associative($search, array('piva'=>$_GET['piva']));
}
if($_GET['mod_pag']!=''){

	$mod_pag=$_GET['mod_pag'];
	$sql.=" and mod_pag =  '$mod_pag' ";
	 Utility::array_push_associative($search, array('mod_pag'=>$_GET['mod_pag']));
}
include('search_admin.php');



$sql.=" order by id desc ";
$param=Utility::getSearch($_GET);
$param2=Utility::getSearch2($_GET);
$itemsPerPage = 20;
$row = $db->paginaSql($sql, $itemsPerPage);

$p= new geo();

$totalItems = $db->tot_records;

$currentPage = $db->current_page;


$urlPattern = './index.php?req='.$req.'&page=(:num)'.$param.'';
$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);

?>

<div class="row">
<div class="col-md-6">
<?php
$first=($currentPage*$itemsPerPage)-($itemsPerPage-1);
$last=$first+$itemsPerPage-1;
echo 'visualizza da '.$first.'  a '.$last.'  di '.$totalItems.'  risultati ';
?>
</div>
<div class="col-md-6">
<a class="btn btn-primary" href="index.php?req=admin&subreq=modifica&id_admin=">Nuova utenza</a>	
<?php

    echo $paginator;
?></div>
</div>



	   <div class=" flip-scroll">
 <table class="table table-bordered table-striped table-condensed flip-content" >
        <thead class="flip-content">
    <thead>
    <tr>
    	 <th >
    Id
    </th>
        	 <th >
    Tipo
    </th>
	 <th >
    nome
    </th>
		<th >
		 nome ref
		 </th>
    <th >
    username
    </th>
   <th>
    password
    </th>
    <th >
    provincia
    </th>
     <th>
    E-mail
    </th>
	   <th>
    SDI
    </th>
    <th>
    cf
    </th>
     <th>
    piva
    </th>
		<th>
	 data iscrizione
	 </th>
	 <th>
ultimo esame
	</th>
    <th >

    </th>
	<th >

    </th>
    <th >

    </th>
    </tr>
   </thead>
   <tbody>
<?php





foreach($row as $r){

$id_admin = $r['id'];
$livello_u = $r['livello'];
$user = $r['username'];
$pass = $r['password'];
$nome = stripslashes($r['nome']);
$nome_ref = stripslashes($r['nome_ref']);
$indirizzo = stripslashes($r['indirizzo']);
$email = $r['email'];
$cf=$r['cf'];
$piva=$r['piva'];
$attivo=$r['attivo'];
$cod_uni=$r['cod'];
$comune='';
$provincia='';

$dataIscrizione='';
$lastEsame='';
//funzione ultimo esame
$lastEsame=$db->getCampo("fatture_n", "time", array('id_struttura'=>$id_admin, 'completa'=>'s'), ' id desc', ' limit 1');
if ($lastEsame==0) {
$lastEsame='MAI';
}
else {

	$lastEsame=Utility::getTime($lastEsame);
}

if($r['dataIscrizione'] !=0)    $dataIscrizione=Utility::getTime($r['dataIscrizione']);
if ($r['comune']!='')
$comune =  stripslashes($r['comune']);
if ($r['provincia']!='')
$provincia = stripslashes($r['provincia']);
?>
<tr class="gradeA">
  <td>
  <?php echo $id_admin; ?>
    </td>
       <td>
  <? echo $livello_u; ?>
    </td>
   <td>
  <?php echo $nome; ?>
    </td>
		<td>
	 <?php echo $nome_ref; ?>
		 </td>
    <td>
  <?php echo $user; ?>
    </td>
   <td class="min">
  <?php echo $pass; ?>
    </td>
    <td>
    <? echo $provincia; ?>
    </td>
    <td class="min">
   <a href="mailto:<?php echo $email; ?>"><?php
	echo $email; ?></a>		
    </td>
	 <td class="min">
    <?php echo $cod_uni; ?>
    </td>
    <td class="min">
      <?php echo $cf; ?>
    </td>
     <td class="min">
      <?php echo $piva; ?>
    </td>
		<td class="min">
		 <?php echo $dataIscrizione; ?>
	 </td>
	 <td class="min">
		<?php echo $lastEsame; ?>
	</td>
    <td class="min3">

<a  class="btn btn-primary" href="index.php?req=admin&subreq=modifica&id_admin=<?php echo $id_admin;?>">
<i class='fa fa-edit'></i></a>
    </td>
	    <td class="min3">
	  <?php  if ($attivo == 'f') {

?>
<a  class="btn btn-primary" href="attiva.php?id_admin=<?php echo $id_admin;?>&req=att">
<i class="fa fa-check"></i></a>
<?php

?> <?php }
else{

echo '<i class="fa fa-check-circle"></i>';
//echo "<a href='attiva.php?id_admin=$id_admin&req=att'>";echo "disattiva utente</a>";

}
?>
    </td>
    <td>

<a  class="btn btn-primary delete_utente"  id="<?php echo $id_admin;?>">
<i class='fa fa-trash'></i></a>
    </td>
   </tr>
    <?php

}

?>
</tbody>
</table>
<?php

  echo $paginator;
?>
</div>
<?php }?>

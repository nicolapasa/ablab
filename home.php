<div class="panel panel-default">

                                        <div class="panel-body home">

<?php
if($pec_admin=='' and $cod_admin==''  and ($livello =='struttura' or $livello=='service')){

	?>
	<div id="dialog" class="modal fade" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>

                                                </div>
                                                <div class="modal-body">
                                                    <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">

                                                                <h4>Devi inserire la tua EMAIL PEC oppure il CODICE UNIVOCO per proseguire, vai al tuo profilo utente cliccando su questo link:</h4>

                                                           	<p>
<br>	<br>
	<a href="./index.php?req=admin&subreq=modifica&id_admin=<?php echo $id_loggata;?>&mess=pec" class=" btn btn-primary  ">vai al Profilo </a>

                                                           </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" data-dismiss="modal" class="btn dark btn-outline">Close</button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>



	<?php



}

?>

<?php
 
 if($livello != 'referti'){

 ?>

<div class="row">
   <div class="col-md-12">
<div class="note note-success ">

<h1 class="block text-center"><i class="fa fa-medkit"></i>Esami</h1>

<p class="text-center">

<a href="destroy.php" class=" btn btn-primary  btn-lg ">Nuova Richiesta </a>

<a href="./destroy.php?req=ric" class=" btn btn-primary btn-lg ">Richieste Inserite </a>



<?php if($livello =='administrator') {?>
<a class=" btn btn-primary btn-lg " href="index.php?req=refertazione">Accettazione</a>

<?php }?>
<a href="index.php?req=ref" class=" btn btn-primary btn-lg ">
<?php if($livello !='administrator') {?>
<span class="badge badge-danger"> <?php echo $not->getNonLetteS($id_loggata, 'referti'); ?> </span>
<?php }?>
Referti </a>
</p>
</div>
	</div>

		</div>
 

	<div class="row">
	<div class="col-md-12">
<div class="note note-success">

<h1 class="block"><i class="fa fa-eur"></i>Amministrazione</h1>

<p class="text-left">
<a href="index.php?req=admin&subreq=modifica&id_admin=<?php echo $id_loggata;?>" class=" btn btn-primary">Profilo </a>
 <?php if($livello!='administrator'){ ?>

 <a href="index.php?req=fatture_cli" class=" btn btn-primary">Fatture</a>

 <?php } ?>
<?php if($livello=='administrator'){ ?>

<?php
//qui devo vedere se ha il super admin

if ($superadmin=='s'){
?>
<a href="index.php?req=fatture" class=" btn btn-primary">Fatture</a>

<a href="destroy_fat.php" class=" btn btn-primary">Fatturazione</a>
<?php }
else {
?>
<a href="index.php?req=form_superadmin" class=" btn btn-primary">Login per Fatture </a>
<?php
}
 ?>
<a href="index.php?req=mod_tabelle" class=" btn btn-primary">Gestione Tabelle </a>
<a href="index.php?req=mod_esami" class=" btn btn-primary">Gestione Esami  </a>
<a href="index.php?req=mod_pro" class=" btn btn-primary">Gestione Proprietari </a>
 <a href="index.php?req=admin"  class=" btn btn-primary">
 <span class="badge badge-danger"> <?php echo $not->getNonLette($id_loggata, 'admin'); ?> </span>
 Utenze  </a>
 <a class="btn btn-primary " href="index.php?req=elenco_refertatori">Elenco refertatori </a>
 <a href="esp_cli.php"  class=" btn btn-primary">Esporta Clienti</a>
<a href="index.php?req=admin&subreq=mail"  class=" btn btn-primary">Mailing list</a>
<a href="index.php?req=stat&subreq=ref_noesami" class=" btn btn-primary  ">Protocolli mancanti </a>
<a href="index.php?req=stat"  class=" btn btn-primary">Statistiche</a>
<!--<a href="index.php?req=doc" class=" btn btn-primary">
Gestione Documenti</a>-->
<?php } ?>
</p>
</div>
	</div>


		</div>


	<div class="row">
   <div class="col-md-6">
<div class="note note-success">
<h1 class="block"><i class="fa fa-sticky-note"></i>News</h1>
<p class="text-left">
<?php if($livello =='administrator') {?>
<a href="index.php?req=news" class=" btn btn-primary">Gestione News</a>
<?php } ?>
<a href="index.php?req=blog" class=" btn btn-primary">
<span class="badge badge-danger"> <?php echo $not->getNonLetteS($id_loggata, 'news'); ?> </span>
News</a>
</p>
  <h3 class="block">Ultima News
                    </h3>
 <div class="blog-page blog-content-1">
 <?php
	$sql="select * from news order by id desc limit 1 ";


$row = $db->sqlquery($sql);

 foreach($row as $r){


				$id_news= $r['id'];

				$titolo=$r['titolo'];


				$data=$r['data'];
				$testo=Utility::troncaTesto2(strip_tags($r['testo']), 300);
				$file=$r['file'];


?>
                                <div class="blog-post-lg bordered blog-container">

                                    <div class="blog-post-content">
                                        <h2 class="blog-title blog-post-title">
                                            <a href="index.php?req=blog-post&id=<?php echo $id_news;?>"><?php echo $titolo;?></a>
                                        </h2>
                                        <p class="blog-post-desc">
										<?php echo $testo;?>
										</p>
                                        <div class="blog-post-foot">
                                              <a class="btn btn-info" href="index.php?req=blog-post&id=<?php echo $id_news;?>">
											  <i class="fa fa-book"></i>
											  Leggi</a>

                                            <div class="blog-post-meta">
                                                <i class="icon-calendar font-blue"></i>
                                                <a href="javascript:;"><?php echo $data;?></a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
			<?php } ?>

 </div>
</div>

	</div>
  <?php


if($livello!='service'){


?>


	<div class="col-md-6">
<div class="note note-success">
<h1 class="block"><i class="fa fa-commenting-o"></i>Forum</h1>

<p class="text-left">
<a href="index.php?req=forum" class=" btn btn-primary">
<span class="badge badge-danger"> <?php echo $not->getNonLette($id_loggata, 'forum'); ?> </span>Apri</a>
   <?php if($livello== 'administrator'){ ?>


<a  class=" btn btn-primary" href="index.php?req=forum&subreq=view_letture">Vedi letture </a>
			    <?php }?>
</p>
  <h3 class="block">Ultima Discussione</h3>
 <div class="blog-page blog-content-1">
<?php //ultimo id
$sql="select * from for_topic  order by id desc limit 1 ";
$row = $db->sqlquery($sql);
//NUOVA CARTA DEI SERVIZI, TANTE NOVITAâ€™ ED UN OMAGGIO NATALIZIO PER TUTTI VOI!

$cl=new Clear();


foreach($row as $r){
	$r=$cl->pulisci($r);
$id_topic= $r['id'];

$id_autore= $r['id_admin'];

$data = Utility::getTime($r['data']);
$titolo=ucfirst(strtolower(Utility::troncaTesto($r['titolo'], 200)));
$letto=$r['letto'];
$testo=Utility::troncaTesto2(strip_tags($r['testo']), 300);
$risposte=count($db->selectAll('for_post', array('id_topic'=>$id_topic)));
$autore=$db->getCampo('admin', 'nome', array('id'=>$id_autore));
//funzione che restituisce l'ultimo messaggio
$last=$db->getLast($id_topic);

?>



   <div class="blog-post-lg bordered blog-container">

                                    <div class="blog-post-content">
                                        <h2 class="blog-title blog-post-title">
                                             <a  href="index.php?req=forum&subreq=view_topic&id=<?php echo $id_topic;?>">
											 <?php echo $titolo;?>
											 </a>
                                        </h2>
                                        <p class="blog-post-desc">
										<?php echo $testo;?>
										</p>
                                        <div class="blog-post-foot">
                                              <a class="btn btn-info" href="index.php?req=forum&subreq=view_topic&id=<?php echo $id_topic;?>">
											  <i class="fa fa-book"></i>
											  Leggi</a>

                                            <div class="blog-post-meta">
                                                <i class="icon-calendar font-blue"></i>
                                                <a href="javascript:;"><?php echo $data;?></a>
                                            </div>

                                        </div>
                                    </div>
                                </div>
<?php

}

?>

	</div>
<?php }

?>


	</div>
</div>
<?php }?>
<!-- Alert -->
	
<div class="alert alert-custom">
	

Emettiamo fatture cumulative mensili. Attendete sempre la fattura prima di provvedere al pagamento.<br>
<strong>Nota bene: </strong>controllate che nella stampa del referto siano presenti i dati essenziali come il nome 
della struttura veterinaria
	
</div>
<!-- // Alert END -->	
<a href="destroy.php" class=" btn btn-primary  btn-lg ">Nuova Richiesta </a> 
<br>
<?php 

$cl=new Clear();
$p= new geo();
	
$id_scheda=$_SESSION['scheda'];//array delle schede

session_destroy();
if(isset($_SESSION['scheda'])) {
//stampo le schede
$row = $db->selectAll('schede', array('id'=>$id_scheda));
 
foreach($row as $r){
$id_scheda=$r['id'];
$num=$r['num'];
$id_struttura = $r['id_struttura'];
$id_proprietario = $r['id_proprietario'];
$id_animale=$r['id_animale'];
$tipo = $r['tipo'];
$urgente = $r['urgente'];
$margini = $r['margini'];
$seconda_refertazione=$r['seconda_refertazione'];
$data= Utility::getTime($r['time']).' - '.Utility::getTime2($r['time']);
$destinatario = $r['destinatario'];
$totale=$r['totale'];

$anno=$r['anno'];
$row2 = $db->selectAll('admin', array('id'=>$id_struttura));
foreach($row2 as $r2){
	$r2=$cl->pulisci($r2);
	$nome = $r2['nome'];
	$referente= $r2['referente'];
	$livello_str=$r2['livello'];
	if(is_numeric($r2['provincia']))
		$provincia = $p->getProv($r2['provincia']);

}


$id_cat=$db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo));
$nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$id_cat));
//estrapolo il titolo -categoria + nome esame
$tipo_s = $nome_cat;
$tipo_s .= ' - '.$db->getCampo('esami_cat', 'abbr', array('id'=>$tipo));

if($urgente =='s') $tipo_b=' URGENTE';

if($seconda_refertazione =='s') $tipo_d='SECONDA OPINIONE';


}

$row = $db->selectAll('proprietari', array('id'=>$id_proprietario));

if(count($row)>0)
	foreach($row as $r){

		$nome_proprietario = $r['nome_proprietario'];
		$cognome_proprietario = $r['cognome_proprietario'];
		$indirizzo_pro = $r['indirizzo_pro'];
		$email_pro = $r['email_pro'];
		$cod_pro = $r['cod_pro'];

}


?>
<div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Richiesta Generata</h3>
                                        </div>
                                        <div class="panel-body"> 
					
			<div class="note note-success">
<h1 class="block"><i class="fa fa-book"></i>Richiesta <?php  echo $num. ' - '.$data;?></h1>
<h3>Struttura veterinaria: <strong><?php echo ucfirst($nome) . ' ' . $provincia; ?></strong> </h3>
<div class="row">
<div class="col-md-3">
<strong>Referente: </strong>
</div>
<div class="col-md-9">
<strong><?php echo $referente; ?></strong>
</div>
</div>
<div class="row">
<div class="col-md-3">
<strong>
Scheda:  </strong>
</div>
<div class="col-md-9">
<strong><?php  echo $tipo_s.$tipo_b.$tipo_c.$tipo_d;?></strong>
</div>
</div>
<?php if($destinatario=='proprietario'){?>
<div class="row">
<div class="col-md-3">
<strong>Fatturazione:  </strong>
</div>
<div class="col-md-9">
<strong><?php echo $destinatario; ?></strong>
</div>
</div>
<?php 
}
if($livello_str !='service'){?>
<div class="row">
<div class="col-md-3">
<strong>Totale: </strong>
</div>
<div class="col-md-3">
<strong><?php echo $totale; ?> euro</strong>
</div>
</div>
<?php }?>
<p class="text-left">
<?php 
echo "<a class='btn btn-primary' target='_new' href='print.php?id_scheda=$id_scheda&anno=$anno'>";echo "<span>stampa</span></a>";
?>
</p>
</div>
</div>
</div>
<?php 
}
else{
?> 
<div class="alert alert-custom">
	
Sessione scaduta se vuoi stampare la scheda clicca qui
<a href="index.php?req=ric" class=" btn btn-primary btn-lg ">Richieste Inserite </a>
	
</div>
<?php

}
?>
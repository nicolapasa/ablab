<?php

$pdf->AddPage('L', 'A4');
   $pdf->SetFont('helvetica', '', 9);




$scheda ='
<h4>Allegato fattura n° '.$num_fatt.'/'.$anno.' del '.$data.'  Dettaglio esami fatturati</h4>

';


$scheda .='
<table  style=\"width:300px;border:none\">
<tr >
<td style=\"width: 5%;\">
ID
</td>
<td style=\"width: 25%;\">
Nome
</td>
<td style=\"width: 25%;\">
Tipo
</td>

<td style=\"width: 10%;\">
DataEsame
</td>
<td style=\"width: 5%;\">
U
</td>
<td style=\"width: 5%;\">
M
</td>
<td style=\"width: 15%;\">
Proprietario
</td>
<td style=\"width: 10%;\">
Importo
</td>
</tr>


';
asort($esami);
$esami=array_filter($esami);

foreach($esami as $r){
	  $id_scheda=$r;



$sql="select *
 from fatture_n where id='$id_scheda'  order by id_cat ";

//scorro le schede in base al mese corrente
$row = $db->sqlquery($sql);

$tot_imp=0;
$tot_iva=0;
$tot=0;

foreach($row as $r){


	$id_cat=$r['id_cat'];
	$nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$id_cat));
    $totale='€ '.number_format($r['totale'], 2, ',', '.');
	$nome_proprietario = $r['nome_proprietario'];
    $cognome_proprietario =  ucwords($r['cognome_proprietario']);

	$num_ref=$db->getCampo('referti', 'id_referto', array('id_scheda'=>$id_scheda));
	$tipo = $r['tipo'];
  $nome_animale=$db->getCampo('animale', 'nome', array('id'=>$r['id_animale']));
	$num=$r['num'];
	$urgenza = $r['urgente'];
	$margini = $r['margini'];
	$src='./img/uncheck.png';
if ($urgenza=='s')  $src='./img/full.png';
$src1='./img/uncheck.png';
if ($margini=='s')  $src1='./img/full.png';

	$data = $db->getCampo('referti', 'dataArrivo', array('id_scheda'=>$id_scheda));
$nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$id_cat));

$nome_esame=$db->getCampo('esami_cat', 'abbr', array('id'=>$tipo));

	$scheda.='
<tr >
<td style=\"width: 5%;\">
'.$num_ref.'
</td>
<td style=\"width: 25%;\">
'.$nome_cat.'
</td>
<td style=\"width: 25%;\">
'.$nome_esame.'
</td>

<td style=\"width:10%;\">
'.$data.'
</td>
<td style=\"width: 5%;\">
<img width="5" src="'.$src.'" >
</td>
<td style=\"width: 5%;\">
<img width="5" src="'.$src1.'" >
</td>
<td style=\"width: 15%;\">
'.$cognome_proprietario.'
</td>
<td style=\"width: 10%;\">
'.$totale.'
</td>
</tr>
';


}
}
	$scheda.='
</table>


';
$pdf->writeHTML($scheda, true, 0, true, 0);

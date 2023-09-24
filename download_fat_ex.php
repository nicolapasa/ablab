<?php
$id=$_GET['id'];
/*
creazione fattura usata solo in casi eccezionali

*/
include("./autoloader.php");

header("Cache-Control: no-cache");



require_once('./TCPDF-master/tcpdf.php');

class MYPDF extends TCPDF {


    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
		//se riba testo diverso
			if($this->PageNo()==1){
		global $mod_pag;
		$text='* Modalità di pagamento: Rimessa diretta/Bonifico Bancario FINE MESE.';
		if( $mod_pag =='riba') $text='* Modalità di pagamento: RIBA FINE MESE.';
		//o   Modalità di pagamento: Rimessa diretta/Bonifico Bancario FINE MESE.
//o   Per quelle cliniche che hanno la RIBA invece in calce: Modalità di pagamento: RIBA FINE MESE.
		//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
	    //$this->Cell(0, 10, 'AbLab', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
		$this->Cell(0, 10, $text, 0, false, 'L', 0, '', 0, false, 'T', 'M');
      //  $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().' di '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
			}
	}
}


$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetFont('helvetica','',10);
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
// set font

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("ablab");
$pdf->SetTitle("Fattura AbLab");


$pdf->setPrintHeader(false);
$pdf->setPrintFooter(true);
//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set cell padding
$pdf->setCellPaddings(1,1, 1, 1);

// set cell margins
$pdf->setCellMargins(0, 0, 0, 0);

$pdf->AddPage();



$cl=new Clear();
$p= new geo();
$db= new DB();

$row = $db->selectAll('fatture', array('id'=>$id));

foreach($row as $r){

$num_fatt=$r['num'];
$id_cliente= $r['id_cliente'];
$importo = $r['importo'];
$dest=$r['dest'];
$data = Utility::getTime($r['data']);
$anno=$r['anno'];
$pagata=$r['pagata'];
$esami=explode('-', $r['esami']);
$spe_tra=$r['spe_tra'];
$sconto=$r['sconto'];
$imponibile=$r['imponibile'];

}
if($dest!='p'){
	//dati clinica
$id_struttura=$id_cliente;

	$row2 = $db->selectAll('admin', array('id'=>$id_cliente));

foreach($row2 as $r2){
	$nome = Utility::iniziali($r2['nome']);
	//$nome = Utility::maiu($r['nome']);
	$nome_cliente=$nome;
	$indirizzo = Utility::iniziali($r2['indirizzo']);
	$email = $r2['email'];
	$piva = $r2['piva'];
	$cf=$r2['cf'];
	if(is_numeric($r2['comune']))
	$comune =  Utility::iniziali($p->getCom($r2['comune']));
	$idcomune=$r2['comune'];
	if(is_numeric($r2['provincia']))
	$provincia = Utility::iniziali($p->getProv($r2['provincia']));
	$cap=$r2['cap'];
$cf=$r2['cf'];
    $mod_pag=$r2['mod_pag'];
}
}
else if($dest=='p'){
	//dati propr
	$row2 = $db->selectAll('proprietari', array('id'=>$id_cliente));

foreach($row2 as $r2){
	$email=$r2['email_pro'];
		$indirizzo = Utility::iniziali($r2['indirizzo_pro']);
	$nome_proprietario = Utility::iniziali($r2['nome_proprietario']);
	$cognome_proprietario = Utility::iniziali($r2['cognome_proprietario']);
	$cf=$r2['cod_pro'];
	$cap=$r2['cap_pro'];
	$nome_cliente=$cognome_proprietario.' '.$nome_proprietario;
	$provincia=Utility::iniziali($p->getProv($r2['provincia_pro']));
$comune =  Utility::iniziali($p->getCom($r2['comune_pro']));
}
}




$intesta=Utility::pulisciNome($nome_cliente);








//logo ablab

$logo ='<div style="text-align:center;">
<img src="./img/logo-bianco.jpg" height="auto" width="40px" />
<br>
<span style="font-size:15px">AbLab Srls</span><br>
<span style="font-style:italic;font-size:11px">
Via Privata Massa Neri 13 -
19038 Sarzana (SP)
<br>
PI: 01409720115
</span>
</div>
';
// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

$pdf->MultiCell(100,0, $logo, 0, 'C', 0, 1, 50, '', true, 0, true);

//IBAN:

$text='<h4>Spett.le</h4>    ';
$pdf->MultiCell(145, 5, $text, 0, 'L', 0, 1, 100, '', true, 0, true);

$text='<b>Fattura di cortesia n°</b>';
$pdf->MultiCell(40, 5, $text, 0, 'L', 0, 0, '', '', true, 0, true);
$text=$num_fatt.'/'.$anno;
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, 47, '', true, 0, true);

if($dest=='p') $text='<b>Sig. </b>';
if($dest!='p') $text='<b>Rag. Soc. </b>';
$pdf->MultiCell(20, 5, $text, 0, 'L', 0, 0, 100, '', true, 0, true);
$text=$nome_cliente;
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 1, 120, '', true, 0, true);

$text='<b>Data</b>';
$pdf->MultiCell(40, 5, $text, 0, 'L', 0, 0, '', '', true, 0, true);
$text=$data;
$pdf->MultiCell(25, 5, $text, 0, 'L', 0, 0, 47, '', true, 0, true);



$text='<b>Indirizzo </b>    ';
$pdf->MultiCell(20, 5, $text, 0, 'L', 0, 0, 100, '', true, 0, true);
$text=$indirizzo;
$pdf->MultiCell(180, 5, $text, 0, 'L', 0, 1, 120, '', true, 0, true);



$text='<b>CREDIT AGRICOLE ITALIA</b>';
$pdf->MultiCell(100, 5, $text, 0, 'L', 0, 0, '', '', true, 0, true);

$text='<b>Cap </b>';
$pdf->MultiCell(20, 5, $text, 0, 'L', 0, 0, 100, '', true, 0, true);
$text=$cap;
$pdf->MultiCell(50, 5, $text, 0, 'L', 0, 1, 120, '', true, 0, true);

$text='<b>IBAN: IT49T0623049841000043964722</b>';
$pdf->MultiCell(100, 5, $text, 0, 'L', 0, 0, '', '', true, 0, true);

$text='<b>Citt&agrave;</b>';
$pdf->MultiCell(20, 5, $text, 0, 'L', 0, 0, 100, '', true, 0, true);
$text=$comune;
$pdf->MultiCell(180, 5, $text, 0, 'L', 0, 1, 120, '', true, 0, true);

$text='<b>Provincia</b>';
$pdf->MultiCell(20, 5, $text, 0, 'L', 0, 0, 100, '', true, 0, true);
$text=$provincia;
$pdf->MultiCell(180, 5, $text, 0, 'L', 0, 1, 120, '', true, 0, true);


if($dest!='p'){
$text='<b>P.iva</b>    ';
$pdf->MultiCell(20, 5, $text, 0, 'L', 0, 0, 100, '', true, 0, true);
$text=$piva;
$pdf->MultiCell(100, 5, $text, 0, 'L', 0, 1, 120, '', true, 0, true);
}
$text='<b>Cod.fisc.</b>    ';
$pdf->MultiCell(20, 5, $text, 0, 'L', 0, 0, 100, '', true, 0, true);
$text=strtoupper($cf);
$pdf->MultiCell(50, 5, $text, 0, 'L', 0, 1, 120, '', true, 0, true);


$text='<br><br>';
$pdf->MultiCell(185, 0, $text, 0, 'C', 0, 1, '', '', true, 0, true);

 $text='<b>Tipo Esame</b>';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, '', '', true, 0, true);
 $text='<b>Num Esami</b>';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, 100, '', true, 0, true);
 $text='<b>Imponibile</b>';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 1, 180, '', true, 0, true);

$text='<hr>';
$pdf->MultiCell(190, 0, $text, 0, 'L', 0, 1, '', '', true, 0, true);




$tot_imp=0;

 $num_esami=0;
$sql="select sum(totale) as impo, id_cat, count(*) as num from fatture_n
where id=0 ";
foreach($esami as $r){
	  $id_scheda=$r;

	  $sql.=" or id = '$id_scheda'";

}
$sql.=" group by id_cat ";

$row=$db->sqlquery($sql);



//
if($dest!='p'){

foreach($row as $r){

   // $id_scheda=$r;
	//$id_cat=$db->getCampo('fatture_n', 'id_cat', array('id'=>$id_scheda));
	$nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$r['id_cat']));
  //  $totale=$db->getCampo('fatture_n', 'totale', array('id'=>$id_scheda));;
    $totale=$r['impo'];

	$n=$r['num'];
	//$iva=$totale/100*22;

	$tot_imp=$tot_imp+$totale;
	//$tot_iva=$tot_iva+$iva;
    $num_esami=$num_esami+$n;
$text=$nome_cat;
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, '', '', true, 0, true);
$text=$n;
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, 100, '', true, 0, true);
$text='€';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, 175, '', true, 0, true);
$text=number_format ( $totale , 2 , ',', '.');
$pdf->MultiCell(0, 5, $text, 0, 'R', 0, 1, 175, '', true, 0, true);



}
}

else{
	foreach($row as $r){

   // $id_scheda=$r;
	//$id_cat=$db->getCampo('fatture_n', 'id_cat', array('id'=>$id_scheda));
	$nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$r['id_cat']));
  //  $totale=$db->getCampo('fatture_n', 'totale', array('id'=>$id_scheda));;
    $totale=round(((100*$r['impo'])/122),2);

	$n=$r['num'];
	//$iva=$totale/100*22;

	$tot_imp=$tot_imp+$totale;

	//$tot_iva=$tot_iva+$iva;
    $num_esami=$num_esami+$n;
$text=$nome_cat;
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, '', '', true, 0, true);
$text=$n;
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, 100, '', true, 0, true);
$text='€';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, 175, '', true, 0, true);
$text=number_format ( $totale , 2 , ',', '.');
$pdf->MultiCell(0, 5, $text, 0, 'R', 0, 1, 175, '', true, 0, true);

$flag=false;

}


}


$text='<hr>';

$pdf->MultiCell(190, 0, $text, 0, 'C', 0, 1, '', '', true, 0, true);
/*
$text='<b>Esami di laboratorio</b>';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, '', '', true, 0, true);
$text='€';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, 175, '', true, 0, true);
$text=number_format ( $tot_imp , 2 , ',', '.');
$pdf->MultiCell(0, 5, $text, 0, 'R', 0, 1, 175, '', true, 0, true);
$text='<hr>';

$pdf->MultiCell(190, 0, $text, 0, 'C', 0, 1, '', '', true, 0, true);
*/
//spese di trasporto?
if($spe_tra!='' and $spe_tra>0){
$flag=true;
 $text='<b>Spese di trasporto</b>';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, '', '', true, 0, true);
$text='€';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, 175, '', true, 0, true);
$text=number_format ( $spe_tra , 2 , ',', '.');
$pdf->MultiCell(0, 5, $text, 0, 'R', 0, 1, 175, '', true, 0, true);
 $text='<hr>';
 $pdf->MultiCell(190, 0, $text, 0, 'C', 0, 1, '', '', true, 0, true);
 $tot_imp=$tot_imp+$spe_tra;
}

$text='<b>Totale imponibile</b>';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, '', '', true, 0, true);
$text='€';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, 175, '', true, 0, true);
$text=number_format ($tot_imp , 2 , ',', '.');
$pdf->MultiCell(0, 5, $text, 0, 'R', 0, 1, 175, '', true, 0, true);
$text='<hr>';
$pdf->MultiCell(190, 0, $text, 0, 'C', 0, 1, '', '', true, 0, true);
if($sconto!=0 and $sconto!=''){
$flag=true;
	if($sconto==10) 	$dicitura='(10%  su importi superiori a 500 euro)';
	if($sconto==20) 	$dicitura='(20%  su importi superiori a 1000 euro)';
	if($imponibile<300 or ( $sconto!=10 and $sconto !=20)) $dicitura='(sconto particolare del '.$sconto.'% )';

	$tot_imp=$tot_imp-($tot_imp/100*$sconto);

	$text='<b>Totale scontato '.$dicitura.' </b>';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, '', '', true, 0, true);
$text='€';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, 175, '', true, 0, true);
$text=number_format ($tot_imp , 2 , ',', '.');
$pdf->MultiCell(0, 5, $text, 0, 'R', 0, 1, 175, '', true, 0, true);
$text='<hr>';
$pdf->MultiCell(190, 0, $text, 0, 'C', 0, 1, '', '', true, 0, true);
}
$iva=$tot_imp/100*22;
if ($dest=='p' and !$flag){
$iva=$importo-$tot_imp;
}

 $text='<b>Totale Iva 22%</b>';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, '', '', true, 0, true);
$text='€';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, 175, '', true, 0, true);
$text=number_format ($iva , 2 , ',', '.');
$pdf->MultiCell(0, 5, $text, 0, 'R', 0, 1, 175, '', true, 0, true);
 $text='<hr>';
$pdf->MultiCell(190, 0, $text, 0, 'C', 0, 1, '', '', true, 0, true);
$tot=$tot_imp+$iva;
if ($dest=='p' and !$flag){
$tot=$importo;
}


 $text='<b>Totale Documento</b>';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, '', '', true, 0, true);
$text='€';
$pdf->MultiCell(0, 5, $text, 0, 'L', 0, 0, 175, '', true, 0, true);
$text=number_format ($tot , 2 , ',', '.');
$pdf->MultiCell(0, 5, $text, 0, 'R', 0, 1, 175, '', true, 0, true);
$text='<hr>';
$pdf->MultiCell(190, 0, $text, 0, 'C', 0, 1, '', '', true, 0, true);


// ---------------------------------------------------------
ob_clean();
//$fn='Fattura_'.$num_fatt.'-'.$anno.'.pdf';
$fn=$anno.'-'.$num_fatt.'-'.$intesta.'.pdf';

//inserisco in tabella fatture
$db->update('fatture', array('nome_file'=>$fn), $id);

//Close and output PDF document
$pdf->Output(__ROOT__.'/fatture/'.$fn, 'F');

//============================================================+
// END OF FILE
//============================================================+

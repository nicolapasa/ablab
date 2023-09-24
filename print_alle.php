<?php
header("Cache-Control: no-cache"); 

include("./autoloader.php");

$db= new DB();
$id=$_GET['id'];





$row = $db->selectAll('fatture', array('id'=>$id));

foreach($row as $r){

$num_fatt=$r['num'];
$id_cliente= $r['id_cliente'];
$importo = $r['importo'];
$dest=$r['dest'];
$data = Utility::getTime($r['data']);
$anno=$r['anno'];
$pagata=$r['pagata'];



}
require_once('./TCPDF-master/tcpdf.php');

class MYPDF extends TCPDF {

    
    public function Header() {
        // Position at 15 mm from bottom
  global $num_fatt;
	global $anno;
	global $data;
        // Set font
        $this->SetFont('helvetica', '', 9);
        // Page number
$scheda ='
<h4>Allegato fattura n° '.$num_fatt.'/'.$anno.' del '.$data.'  Dettaglio esami fatturati

Pag. '.$this->getAliasNumPage().' di '.$this->getAliasNbPages().'</h4>';
$this->MultiCell(190, 0, $scheda, 0, 'L', 0, 1, '', '', true, 0, true);

  
$scheda ='
<b>ID</b>
';
$this->MultiCell(20, 0, $scheda, 0, 'L', 0, 0, '', '', true, 0, true);
$scheda ='
<b>Proprietario</b>

';
$this->MultiCell(40, 0, $scheda, 0, 'L', 0, 0, 30, '', true, 0, true);
$scheda ='
<b>Nome</b>
';
$this->MultiCell(70, 0, $scheda, 0, 'L', 0, 0, 70, '', true, 0, true);
$scheda ='
<b>Tipo</b>
';
$this->MultiCell(70, 0, $scheda, 0, 'L', 0, 0, 150, '', true, 0, true);
$scheda ='
<b>DataEsame</b>
';
$this->MultiCell(30, 0, $scheda, 0, 'L', 0, 0, 220, '', true, 0, true);
$scheda ='
<b>U</b>
';
$this->MultiCell(5, 0, $scheda, 0, 'L', 0, 0, 250, '', true, 0, true);
$scheda ='
<b>M</b>
';
$this->MultiCell(5, 0, $scheda, 0, 'L', 0, 0, 260, '', true, 0, true);

$scheda ='
<b>Importo</b>
';
$this->MultiCell(50, 0, $scheda, 0, 'L', 0, 1, 270, '', true, 0, true);
		
		}
	
}


$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

$pdf->SetFont('helvetica','',9);
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
// set document information
// set font

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("ablab");
$pdf->SetTitle("Allegato Fattura AbLab");


$pdf->setPrintHeader(true);
$pdf->setPrintFooter(false);
  $pdf->SetMargins(PDF_MARGIN_LEFT, 13, PDF_MARGIN_RIGHT);
 $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_TOP);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set cell padding
$pdf->setCellPaddings(1,1, 1, 1);

// set cell margins
$pdf->setCellMargins(0, 0, 0, 0);

$pdf->AddPage();









$sql="select *
 from esami2_v where num='$num_fatt'  and anno='$anno' ";

//scorro le schede in base al mese corrente
$row = $db->sqlquery($sql);




foreach($row as $r){
	

	$id_cat=$r['id_cat'];
	$nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$id_cat));
    $totale='€ '.number_format($r['totale'], 2, ',', '.');

    $cognome_proprietario =  Utility::iniziali($r['cognome_proprietario']);
    
	$num_ref=$r['id_referto'];
	$tipo = $r['tipo'];

	$urgente = $r['urgente'];
	$margini = $r['margini'];


	$dataE = Utility::getTime($r['timeArr']);
$nome_cat=Utility::iniziali($db->getCampo('categorie', 'nome', array('id'=>$id_cat)));

$nome_esame=Utility::iniziali($db->getCampo('esami_cat', 'abbr', array('id'=>$tipo)));
	


$scheda =$num_ref;
$pdf->MultiCell(20, 0, $scheda, 0, 'L', 0, 0, '', '', true, 0, true);
$scheda =$cognome_proprietario;
	
$pdf->MultiCell(40, 0, $scheda, 0, 'L', 0, 0, 30, '', true, 0, true);
$scheda =$nome_cat;
$pdf->MultiCell(70, 0, $scheda, 0, 'L', 0, 0, 70, '', true, 0, true);
$scheda =$nome_esame;
$pdf->MultiCell(70, 0, $scheda, 0, 'L', 0, 0, 150, '', true, 0, true);
$scheda =$dataE;
$pdf->MultiCell(30, 0, $scheda, 0, 'L', 0, 0, 220, '', true, 0, true);
$scheda =$urgente;
$pdf->MultiCell(5, 0, $scheda, 0, 'L', 0, 0, 250, '', true, 0, true);
$scheda =$margini;
$pdf->MultiCell(5, 0, $scheda, 0, 'L', 0, 0, 260, '', true, 0, true);

$scheda =$totale;
$pdf->MultiCell(50, 0, $scheda, 0, 'L', 0, 1, 270, '', true, 0, true);
	
	
	
}


ob_clean();
$nome_file='Allegato_'.$num_fatt.'-'.$anno.'.pdf';
//Close and output PDF document
$pdf->Output($nome_file, "I", "I");


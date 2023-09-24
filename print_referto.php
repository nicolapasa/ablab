<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-cache");


include("./autoloader.php");


require_once('./TCPDF-master/tcpdf.php');

class MYPDF extends TCPDF {
 public function Header() {
        // Position at 15 mm from bottom

        // Set font
        $this->SetFont('opensans', '', 9);
        // Page number
		if($this->PageNo()>1){

			$this->MultiCell(180,0, '', 0, 'L', 0, 1, '', '', true, 0, true);
		}else{
	 $image_file = './img/logo-stampa.jpg';
	 // Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', $ismask=false, $imgmask=false, $border=0, $fitbox=false, $hidden=false, $fitonpage=false)

        $this->Image($image_file, 99, 8, 13, '', 'JPG', '', 'C', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('opensans', '', 9);
        // Title
	//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
$this->MultiCell(180,0, '<span style="font-size:13px">AbLab</span><br>
<span style="font-size:11px">Laboratorio di analisi veterinarie</span>', 'B', 'C', 0, 1, '', 23, true, 0, true);

		}
		}

    // Page footer
	
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-20);
        // Set font
        $this->SetFont('opensans', '', 8);
        // Page number
		//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
	    $this->Cell(0, 10, 'AbLab', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
		  $this->SetFont('opensansi', 'I', 8);
		$this->Cell(140, 10, 'Tel. 0187 626259 E-mail: info@ablab.eu', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(50, 10, 'Pagina '.$this->getAliasNumPage().' di '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'R');
    }
}


$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$fontname2='opensansb';
$fontname='opensans';
//$fontname2='helvetica';

//$pdf->SetFont($fontname,'',10, '', true);
$pdf->SetFont($fontname,'',9, '', true);



$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("ablab");
$pdf->SetTitle("REFERTO AbLab");


//$pdf->setPrintHeader(true);
//$pdf->setPrintFooter(true);
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);


$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
//set auto page breaks
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
// set cell padding
$pdf->setCellPaddings(0,1, 0, 0);

// set cell margins
$pdf->setCellMargins(0, 0, 0, 0);

$pdf->AddPage();

$start_y = $pdf->GetY();
$db= new DB();
$id=$_GET['id'];
$tipo=$_GET['tipo'];

$livello=$_GET['livello'];

$cl=new Clear();

//check se è un referto assegnato 
$referto_assegnato=false;
$row = $db->selectAll('referti_assegnati', array('id_referto'=>$id));
if($row>0) {

	foreach($row as $r){

      $id_refertatore=$r['id_refertatore'];
	  $referto_assegnato=true;
	}

	$firma_refertatore =$db->getCampo('admin', 'firma', array('id'=>$id_refertatore));

}	

//segno come letto

if($tipo!='admin') 	$db->deleteP('notifiche', array('contesto'=>'referti','id_post'=>$id));

$stato=$db->getCampo('referti', 'stato', array('id'=>$id));
//controllo se stato del referto è corretto e se utenza non è admin, se stato inferiore a 2 allora non visualizzo
if($stato <2 and $tipo!='admin') {

echo "nulla da visualizzare";

}
else{
//stampo le schede
$row = $db->selectAll('refertimancanti_v', array('id'=>$id));
if($row>0) {
foreach($row as $r){
	$r=$cl->pulisci($r);
	$id_scheda=$r['id_scheda'];
	$id_struttura = $r['id_struttura'];
	$id_proprietario = $r['id_proprietario'];
	$id_animale = $r['id_animale'];
	$tipo = $r['tipo'];
    $id_cat=$db->getCampo('esami_cat', 'id_cat', array('id'=>$tipo));
	$id_referto=$r['id_referto'];
	$dataRefertazione=$r['dataRefertazione'];
	$dataArrivo=$r['dataArrivo'];
	$anno2=substr($r['anno'], 2, 2);
	$num_pro=$id_referto.'-'.$anno2;




		switch($id_cat){

			case 1:
			$nomeEsame='Esame Citologico';
			break;
			case 2:
			$nomeEsame='Esame Istologico';
			break;
			case 6:
			$nomeEsame='Esame Immunoistochimico';
			break;
			case 7:
			$nomeEsame='Biologia Molecolare';
			break;


			default:
			$nomeEsame= $db->getCampo('esami_cat', 'abbr', array('id'=>$tipo));

		}


}
$p= new geo();
$row = $db->selectAll('admin', array('id'=>$id_struttura));

foreach($row as $r){

//	$nome = ucwords($r['nome']);
  	$nome = ucwords($r['nome_ref']);
	$indirizzo = $r['indirizzo'];
	$email = $r['email'];
	$piva = $r['piva'];
	$comune =  $r['comune'];
	$idcomune=$r['comune'];
	$provincia = $r['provincia'];
	$foto= $r['foto'];
	$referente= $r['referente'];
}

$row = $db->selectAll('proprietari', array('id'=>$id_proprietario));

if(count($row)>0)
foreach($row as $r){

	    $nome_proprietario = ucfirst($r['nome_proprietario']);
 		$cognome_proprietario = ucfirst($r['cognome_proprietario']);
 	  $medico_ref=ucfirst($r['medico_ref']);

}
$prop='';

$row = $db->selectAll('animale', array('id_scheda'=>$id_scheda));

$a=new Animale();
if(count($row)>0)
foreach($row as $r){

	$idrazza = $r['razza'];
 		$razza=$r['razza'];
 		$idspecie = $r['specie'];
 		$specie=($a->getAnimal($idspecie, 'specie'));
 		$idorgano = $r['organo'];
 		$organo=$r['organo'];
	$sesso = trim($r['sesso']);
	$integrita = trim($r['integrita']);
	if($sesso=='Femmina') {
		$sesso='F';
		if($integrita=='intero') $integrita='I';
		if($integrita=='castrato') $integrita='S';
	}else if($sesso=='Maschio'){
		$sesso='M';
		if($integrita=='intero') $integrita='I';
		if($integrita=='castrato') $integrita='C';

	}

	$anamnesi = ucfirst(strip_tags($r['anamnesi']));
	//$anamnesi= str_replace(array("\n","\r"), "", $anamnesi);
	$eta=$r['eta'];
	$nome_animale=$r['nome'];

}
  	$row = $db->selectAll('referti_data', array('id_tref'=>$id));

 	foreach($row as $r){


		$file=$r['foto'];
		//$annotazioni=$r['annotazioni'];
		$descr_macro=Utility::pulisciRef($r['descr_macro']);
		$descr_macro=Utility::pulisciRef($r['descr_macro']);
		$descr_micro=Utility::pulisciRef( $r['descr_micro']);
		$diagn_morf=Utility::pulisciRef($r['diagn_morf']);
		$commento=Utility::pulisciRef($r['commento']);
		$commento2=Utility::pulisciRef($r['commento2']);
		$id_firma=$r['id_firma'];
		$id_firma2=$r['id_firma2'];
		$nome_firma=$db->getCampo('firme', 'value', array('id'=>$id_firma));
		$nome_firma2=$db->getCampo('firme', 'value', array('id'=>$id_firma2));
		if($referto_assegnato and $id_cat !=5) {
			$nome_firma=$id_firma;
			$nome_firma2=$id_firma2;
		}	
		else if ($id_cat==5 and $referto_assegnato){
			$nome_firma=$id_firma;
			if(!is_numeric($id_firma2)) $nome_firma2=$id_firma2;
		}
		$esito_esame=Utility::pulisciRef($r['esito_esame']);
		$esito_esame2=Utility::pulisciRef($r['esito_esame2']);
		//$esito_esame2=$r['esito_esame2'];
		$nome_esame1=$r['nome_esame1'];
		$nome_esame2=$r['nome_esame2'];
		if($nome_esame1!='') $nomeEsame=$nome_esame1;
		if($nome_esame2!='') $nomeEsame2=$nome_esame2;
	}





$pdf->setCellHeightRatio(1.1);



//$pdf->getAliasNumPage()
//$pdf->MultiCell(125, 0, 'n pag '.$pdf->getAliasNumPage(),0, 'L', 0, 0, '', '', true, 0, true);
//
if($livello =='referti') {


	$nome='xxxxxx';
	$medico_ref='xxxxxxx';
}


$pdf->MultiCell(133, 0, '',0, 'L', 0, 1, '', '', true, 0, true);
$text='<b>Data di arrivo</b>:    '.$dataArrivo;
$pdf->MultiCell(130, 0, $text,0, 'L', 0, 0, '', '', true, 0, true);

$text='<b>Data di refertazione</b>: '.$dataRefertazione;
$pdf->MultiCell(60, 0, $text, 0, 'L', 0, 1, '', '', true, 0, true);

$text='<b>Protocollo</b>:    '.$num_pro;
$pdf->MultiCell(145, 0, $text,0, 'L', 0, 1, '', '', true, 0, true);
$text='<b>Veterinario:</b>   '.$nome;
$pdf->MultiCell(180, 0, $text, 'B', 'L', 0, 1, '', '', true, 0, true);
if($medico_ref!=''){

  $text='<b>Medico Referente:</b>   '.$medico_ref;
  $pdf->MultiCell(180, 0, $text, 0, 'L', 0, 1, '', '', true, 0, true);

}

if($tipo!=39 and $tipo!=40 and $tipo!=41){
$text='<b>Proprietario:</b>  '.$cognome_proprietario.' '.$nome_proprietario;
$pdf->MultiCell(180, 0, $text, 0, 'L', 0, 1, '', '', true, 0, true);
$text='<b>Animale:</b>    '.$specie;
$pdf->MultiCell(80, 0, $text, 0, 'L', 0, 0, '', '', true, 0, true);
$text='  '.$razza;
$pdf->MultiCell(100, 0, $text, 0, 'L', 0, 1, 105, '', true, 0, true);
$text='<b>Nome:</b>    '.$nome_animale;
$pdf->MultiCell(120, 0, $text, 0, 'L', 0, 0, '', '', true, 0, true);
$text=' <b>Età:</b> '.$eta;
$pdf->MultiCell(50, 0, $text, 0, 'L', 0, 0, 105, '', true, 0, true);
$text='<b>Sesso:</b>  '.$sesso. '&nbsp;'.$integrita.'';
$pdf->MultiCell(35, 0, $text, 0, 'L', 0, 1, '', '', true, 0, true);
$text='<b>Campione:</b>    '.$organo;
$pdf->MultiCell(180, 0, $text, 'B', 'L', 0, 1, '', '', true, 0, true);

}

$pdf->MultiCell(180, 1, '<br>', 0, 'L',0, 1, '', '', false, 0, true, false);

if($nomeEsame!=''){
$pdf->SetFillColor(182, 167, 167);
$pdf->SetFont($fontname2,'B',11);
$text=$nomeEsame;

$pdf->MultiCell(180, 5, $text, 0, 'L', 1, 1, '', '', true, 0, true, false, 0, 'M');
$pdf->SetFont($fontname,'',9);
}

if($id_cat==1 or $id_cat ==2 or $id_cat==5 or $id_cat==4){

	if($descr_macro!=''){
$pdf->SetFont($fontname2,'B',10);
$text='Descrizione Macroscopica';

$pdf->MultiCell(180, 1, $text, 0, 'J', 0, 1, '', '', true, 0, true);
$pdf->SetFont($fontname,'',9);
	$text=$descr_macro;

$pdf->MultiCell(180, 1, $text, 0, 'J', 0, 1, '', '', true, 0, true, false);
	}
		if($descr_micro!=''){

			//$pdf->MultiCell(180, 1,'', 0, 'J', 0, 1, '', '', true, 0, true);

			$pdf->SetFont($fontname2,'B',10);
			$text=$spazio.'Descrizione Microscopica';
$pdf->MultiCell(180, 1, $text, 0, 'J', 0, 1, '', '', true, 0, true);
$pdf->SetFont($fontname,'',9);
		$text=$descr_micro;
$pdf->MultiCell(180, 1, $text, 0, 'J', 0, 1, '', '', true, 0, true, false);
		}
			if($diagn_morf!=''){

					//$pdf->MultiCell(180, 1,'', 0, 'J', 0, 1, '', '', true, 0, true);
	$pdf->SetFont($fontname2,'B',10);
$text='Diagnosi Morfologica';
$pdf->MultiCell(180, 1, $text, 0, 'J', 0, 1, '', '', true, 0, true);
		$pdf->SetFont($fontname,'',9);
	$text=$diagn_morf;
$pdf->MultiCell(180, 1, $text, 0, 'J', 0, 1, '', '', true, 0, true, false);
			}


}

if( $id_cat==1 or $id_cat ==2 or $id_cat==5  or $id_cat==7  or $id_cat==6){
if($esito_esame!=''){
//$pdf->MultiCell(180, 0,'', 0, 'J', 0, 1, '', '', true, 0, true);
$text=$esito_esame;
$pdf->MultiCell(180, 0, $text, 0, 'J', 0, 1, '', '', true, 0, true, false);
}
}
if($id_cat==1 or $id_cat ==2 or $id_cat==5  or $id_cat==7  or $id_cat==6){

//commento foto e firma
if($commento !=''){

	//$pdf->MultiCell(180, 1,'', 0, 'J', 0, 1, '', '', true, 0, true);
			$pdf->SetFont($fontname2,'B',10);
$text='Commento';
$pdf->MultiCell(180, 1, $text, 0, 'J', 0, 1, '', '', true, 0, true);
		$pdf->SetFont($fontname, '',9);
	$text=$commento;
$pdf->MultiCell(180, 1, $text, 0, 'J', 0, 1, '', '', true, 0, true, false);

}
}
if($id_cat==6  or $id_cat==1 or $id_cat==2   or $id_cat==5 or $id_cat==3){

	//foto
	if($file!=''){

		//gestione eccedenza
		$end_y = $pdf->GetY();
        $height = $end_y - $start_y;

		if($height>170) {
			$text='<br pagebreak="true" />';
	$pdf->MultiCell(180, 1, $text, 0, 'L', 0, 1, '', '', true, 0, true);
		}
		else{
			$pdf->MultiCell(250, 0, '', 0, 'L', 0, 1, 70, '', true, 0, true);
		}
		$height='';
		//

	$foto ='
'.$height.'<img src="'.DIR_UPLOAD.$file.'" height="auto" width="250px" />

';

	$pdf->MultiCell(250, 0, $foto, 0, 'L', 0, 1, 70, '', true, 0, true);
	}

}
if( $id_cat==5 ){
	//solo se sezioni compilate
	if($commento!='' or $esito_esame!='' or $descr_macro !=''
	or  $descr_micro!='' or  $diagn_morf!=''){


	$nome_firma=explode('-', $nome_firma);
$pdf->MultiCell(80, 1, '', 0, 'L', 0, 1, '', '', true, 0, true);
	$text='<span style="text-align:center">'.trim($nome_firma[0]).'<br>'.trim($nome_firma[1]).'<br>'.trim($nome_firma[2]).'</span>';
$pdf->MultiCell(60, 1, $text, 0, 'L', 0, 1, 0, '', true, 0, true);
$text='';
$pdf->MultiCell(80, 1, $text, 0, 'L', 0, 1, '', '', true, 0, true);
	}
}




//parte tabelle
	if($id_cat==3 or $id_cat==4 or $id_cat==5 )	{


	if($nomeEsame2!='')	{

$pdf->SetFillColor(182, 167, 167);
$pdf->SetFont($fontname2,'B',11);
$text=$nomeEsame2;

$pdf->MultiCell(180, 5, $text, 0, 'L', 1, 1, '', '', true, 0, true, false, 0, 'M');
//$text='<div style="margin-top: 0px">'.$esito_esame.'</div>';
$pdf->SetFont($fontname, '',9);
	}
	//secondo esito e commento
	if($id_cat!=5 and $esito_esame!=''){
//	$pdf->MultiCell(180, 1,'', 0, 'J', 0, 1, '', '', true, 0, true);
		$text=$esito_esame;
$pdf->MultiCell(180, 1, $text, 0, 'J', 0, 1, '', '', true, 0, true);

	}
	else
	if($esito_esame2!=''){
		//$pdf->MultiCell(180, 1,'', 0, 'J', 0, 1, '', '', true, 0, true);
	$text=$esito_esame2;
$pdf->MultiCell(180, 1, $text, 0, 'J', 0, 1, '', '', true, 0, true);
	}

//$pdf->MultiCell(185, 1, $text, 0, 'L', 0, 1, '', '', true, 0, true);

$rowt=$db->selectAll('tabelle', array('id_ref'=>$id), ' tipo asc ');

 foreach($rowt as $rt){


	 $id_tab=$rt['id'];
    //$firma_t=$rt['firma'];
	//$nome_firma_t=$db->getCampo('firme', 'value', array('id'=>$firma_t));
	$tipo_t=$rt['tipo'];
	$nome_t=$rt['nome'];
	//tabella
	include('tab_print.php');
	$pdf->MultiCell(180, 1, $text, 0, 'L', 0, 1, '', '', true, 0, true);
	//parte legenda in base al tipo di tabella
			$pdf->SetFont($fontname,'',8);
			switch($tipo_t){
				case 1:
      $text=$db->getCampo('tabella_legende', 'testo',  array('tipo' => 'ANTIBIOGRAMMA' ));

			/*	$text='
				LEGENDA: <br>
		S = Sensibile, dosaggio standard. Il successo terapeutico è altamente probabile usando il principio attivo a dosaggio standard.
		<br>I = Sensibile, dosaggio maggiore. Il successo terapeutico è altamente probabile usando il principio attivo a dosaggio maggiore, aggiustando dosaggio e/o concentrazione finale nel sito di infezione.</b>
		<br>R = Resistente. L’insuccesso terapeutico è altamente probabile, anche usando il principio attivo a dosaggio maggiore.

				<p>
				Il test di sensibilità è stato condotto per diffusione secondo il metodo Kirby-Bauer.
				I risultati sono stati letti secondo i criteri interpretativi dell\'EUCAST
				(European Committee on Antimicrobial Susceptibility Testing) e le
				linee guida del CLSI (Clinical and Laboratory Standards Institute)
				per batteri isolati da animali. La scelta della terapia antibiotica
				spetta al Veterinario curante e va valutata considerando il quadro clinico
				completo e le limitazioni di impiego del principio attivo.
				</p>';*/
				break;
				case 2:
          $text=$db->getCampo('tabella_legende', 'testo',  array('tipo' => 'ANTIMICOGRAMMA' ));
			/*	$text='		LEGENDA: <br>
				S = Sensibile, dosaggio standard. Il successo terapeutico è altamente probabile usando il principio attivo a dosaggio standard.
				<br>I = Sensibile, dosaggio maggiore. Il successo terapeutico è altamente probabile usando il principio attivo a dosaggio maggiore, aggiustando dosaggio e/o concentrazione finale nel sito di infezione.</b>
				<br>R = Resistente. L’insuccesso terapeutico è altamente probabile, anche usando il principio attivo a dosaggio maggiore.

				<p>
				Il test di sensibilità è stato condotto per
				diffusione secondo le linee guida del CLSI (Clinical and Laboratory
				Standards Institute). I risultati sono stati letti in accordo con i criteri
				interpretativi del CLSI. La scelta della terapia spetta al Veterinario curante
				e va valutata considerando il quadro clinico completo e le limitazioni di impiego
				del principio attivo.

					</p>';*/
				break;
				case 3:
        $text=$db->getCampo('tabella_legende', 'testo',  array('tipo' => 'MIC' ));
		/*		$text='		LEGENDA: <br>
				S = Sensibile, dosaggio standard. Il successo terapeutico è altamente probabile usando il principio attivo a dosaggio standard.
				<br>I = Sensibile, dosaggio maggiore. Il successo terapeutico è altamente probabile usando il principio attivo a dosaggio maggiore, aggiustando dosaggio e/o concentrazione finale nel sito di infezione.</b>
				<br>R = Resistente. L’insuccesso terapeutico è altamente probabile, anche usando il principio attivo a dosaggio maggiore.

					<p>
				Il test di sensibilità è stato condotto per microdiluizione in liquido.
				I risultati sono stati letti secondo i criteri interpretativi degli
				standard CLSI (Clinical and Laboratory Standards Institute) per batteri
				isolati da animali. La scelta della terapia antibiotica spetta al Veterinario
				curante e va valutata considerando il quadro clinico completo e le limitazioni
				di impiego del principio attivo.
					</p>';*/
				break;


			}





	$pdf->MultiCell(180, 1, $text, 0, 'J', 0, 1, '', '', true, 0, true);
	$pdf->SetFont($fontname,'',9);
 }




}

$pdf->SetFont($fontname,'',9);
if($id_cat==5 or $id_cat==3 or $id_cat==4){
	if($id_cat!=5 and $commento!=''){
	//$pdf->MultiCell(180, 1,'', 0, 'J', 0, 1, '', '', true, 0, true);
		$text='<b>Commento</b>';
			$pdf->MultiCell(180, 1, $text, 0, 'L', 0, 1, '', '', true, 0, true);
		$text=$commento;
$pdf->MultiCell(180, 1, $text, 0, 'J', 0, 1, '', '', true, 0, true, false);

	}
	else if($commento2 !=''){
		//$pdf->MultiCell(180, 1,'', 0, 'J', 0, 1, '', '', true, 0, true);
	//$pdf->SetFont($fontname2,'',10);
	$text='<b>Commento</b>';
	$pdf->MultiCell(180, 1, $text, 0, 'L', 0, 1, '', '', true, 0, true);
		$pdf->SetFont($fontname,'',9);
	$text=$commento2;

$pdf->MultiCell(180, 1, $text, 0, 'J', 0, 1, '', '', true, 0, true, false);
}
//foto


}

$end_y = $pdf->GetY();
$height = $end_y - $start_y;
//$check_pagebreak = $this->pdf->checkPageBreak($height+$padding,$yy,false);

//<br pagebreak="true" />
if($height>220) {
$text='<br pagebreak="true" />';
}else{
$text='';
}
	$height='';
	$pdf->MultiCell(180, 1, $text, 0, 'L', 0, 1, '', '', true, 0, true);

// se referto assegnato devo mettere nome del refertatore altrimenti default
//check se assegnato 



//firma patologo
		if(($id_cat==6 or $id_cat==7 or $id_cat==1 or $id_cat==2 ) and $nome_firma!=''){
$nome_firma=explode('-', $nome_firma);

	$text=trim($height.$nome_firma[0]).'<br>'.trim($nome_firma[1]).'<br>'.trim($nome_firma[2]);

$pdf->MultiCell(60, 1, $text, 0, 'C', 0, 0, 0, '', true, 0, true);

		}
else{

	$nome_firma=explode('-', $nome_firma2);
	$text=trim($height.$nome_firma[0]).'<br>'.trim($nome_firma[1]).'<br>'.trim($nome_firma[2]);

$pdf->MultiCell(65, 1, $text, 0, 'C', 0, 0, 0, '', true, 0, true);


}

	$text='Il Direttore Sanitario<br>
	<img src="./img/firma.jpg" height="auto" width="110" />
	';


$pdf->MultiCell(85, 0, $text, 0, 'C', 0, 1, 140, '', true, 0, true);

}
else{
	//logo ablab
$logo ='
<p>
Il referto  non è disponibile
</p>
';

$pdf->MultiCell(180,0, $logo, 0, 'L', 0, 1, '', '', true, 0, true);


}


ob_end_clean();

$pdf->Output("referto.pdf", "I" , "I");
} 
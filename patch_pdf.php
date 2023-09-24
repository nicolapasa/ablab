<?php 
include("./autoloader.php");

$db= new DB();
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


class MYPDF1 extends TCPDF {

    
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


  $sql=" select * from fatturate_v   "; 
  
 echo  count($db->sqlquery($sql));
  foreach($db->sqlquery($sql) as $r){
	  
	  
	  $id=$r['id'];
	  $dest=$r['dest'];
	  
	  include('download_fat_p.php');
	  if($dest=='c') include('download_alle_p.php');
	  
	  
	  
  }

<?php
header("Content-type: text/html; charset=UTF-8");
header("Cache-Control: no-cache"); 

include("autoloader.php");
//error_reporting(E_ALL);
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




$dir =  './PDF/';
$data_ref=$_GET['dataRef'];



$db=new DB();

ob_start(); // This is only to show that ob_start can be called, however the buffer must be empty when sending.



  
$sql=" select * from referti_v where FROM_UNIXTIME(time,'%d/%m/%Y') = '$data_ref' and stato=3 and tipo<92 order by id asc "; 
if(count($db->sqlquery($sql))>0){
	
	$zip = new ZipArchive;

  $nome_zip=Utility::getData($data_ref).'pdf.zip';
  $zip->open($nome_zip, ZipArchive::CREATE);
	
foreach($db->sqlquery($sql) as $r){

$id=$r['id'];
$numRef=$r['id_referto'];
$anno=$r['anno'];
// Recupero il nome del file dalla querystring
// e lo accodo al percorso della cartella del download
 $fn = $numRef.'_'.$anno.'.pdf';

 
 
 //genero il file 
 
 include('pdf_referto_multi.php');
 



 $file_n = $dir . $fn;  
$zip->addFile($file_n);

}


 $zip->close();
header('Content-Type: application/zip');
header('Content-disposition: attachment; filename='.$nome_zip);
header('Content-Length: ' . filesize($nome_zip));
readfile($nome_zip);
unlink($nome_zip);
}
else{
		header("Location: index.php?req=pdf&dataRef=$data_ref");
}
?>

<?php
require_once './exwriter/Classes/PHPExcel.php';
include("autoloader.php");
$db= new DB();


/** Include PHPExcel */
$u=new Utility();


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("ablab")
->setTitle("dati proprietari Ablab");

$p= new geo();


$objPHPExcel->setActiveSheetIndex(0)
->setCellValueByColumnAndRow(0, 1, 'Falsa')
->setCellValueByColumnAndRow(1, 1, 'Id')
->setCellValueByColumnAndRow(2, 1, 'Cognome')
->setCellValueByColumnAndRow(3, 1, 'Nome')
->setCellValueByColumnAndRow(4, 1, 'Provincia')
->setCellValueByColumnAndRow(5, 1, 'Comune')
->setCellValueByColumnAndRow(6, 1, 'Indirizzo')
->setCellValueByColumnAndRow(7, 1, 'Cap')
->setCellValueByColumnAndRow(8, 1, 'Email')
->setCellValueByColumnAndRow(9, 1, 'CodFis')
->setCellValueByColumnAndRow(10, 1, 'Pec');



	$i=2;
	//dati

//dati
	$row = $db->selectAll('proprietari', null,  ' cognome_proprietario desc ');
	//$row = $db->selectAll('proprietari', null, ' cognome_proprietario desc ');
	if (count($row)>0){
	foreach($row as $r){
	$id=$r['id'];
	$nome = $r['nome_proprietario'];
	$cognome = $r['cognome_proprietario'];
	$indirizzo = $r['indirizzo_pro'];
	$email = $r['email_pro'];
	$cf = '"'.$r['cod_pro'].'"';
	$pec=$r['pec_pro'];
if($r['cod_pro']!='') {
 		if(is_numeric($r['provincia_pro']) and $r['provincia_pro']>0 )
 		$provincia = $p->getProv($r['provincia_pro']);
 		if(is_numeric($r['comune_pro']) and $r['comune_pro']>0 )
 		$comune =  $p->getCom($r['comune_pro']);
 		$cap = $r['cap_pro'];
 		


$objPHPExcel->setActiveSheetIndex(0)
			->setCellValueByColumnAndRow(0, $i, 'x')
			->setCellValueByColumnAndRow(1, $i, $id)
			->setCellValueByColumnAndRow(2, $i, $cognome)
			->setCellValueByColumnAndRow(3, $i, $nome)
			->setCellValueByColumnAndRow(4, $i, $comune)
			->setCellValueByColumnAndRow(5, $i, $provincia)
			->setCellValueByColumnAndRow(6, $i, $indirizzo)
			->setCellValueByColumnAndRow(7, $i, $cap)
			->setCellValueByColumnAndRow(8, $i, $email)
			->setCellValueByColumnAndRow(9, $i, $cf)
				->setCellValueByColumnAndRow(10, $i, $pec);
			
$i++;	
}
 	}}
 	
 	

 	// Redirect output to a client’s web browser (Excel5)
 	header('Content-Type: application/vnd.ms-excel');
 	header('Content-Disposition: attachment;filename="dati_proprietari_ablab.xls"');
 	header('Cache-Control: max-age=0');
 	// If you're serving to IE 9, then the following may be needed
 	header('Cache-Control: max-age=1');
 	
	 	    ob_end_clean();
ob_start();
 	
 	
 	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
 	$objWriter->save('php://output');
 	exit;
 	
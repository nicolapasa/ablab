<?php
require_once './exwriter/Classes/PHPExcel.php';
include("autoloader.php");
$db= new DB();


/** Include PHPExcel */
$u=new Utility();
$anno=$_GET['anno'];

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("ablab")
->setTitle("dati cliniche Ablab");

$p= new geo();


$objPHPExcel->setActiveSheetIndex(0)
->setCellValueByColumnAndRow(0, 1, 'Num')
->setCellValueByColumnAndRow(1, 1, 'Anno')
->setCellValueByColumnAndRow(2, 1, 'NomeCliente')
->setCellValueByColumnAndRow(3, 1, 'Pagata')
->setCellValueByColumnAndRow(4, 1, 'Totale')
->setCellValueByColumnAndRow(5, 1, 'Imponibile')
->setCellValueByColumnAndRow(6, 1, 'Sconto')
->setCellValueByColumnAndRow(7, 1, 'Corriere')
->setCellValueByColumnAndRow(8, 1, 'Destinatario')
->setCellValueByColumnAndRow(9, 1, 'Data')
->setCellValueByColumnAndRow(10, 1, 'Iva')
->setCellValueByColumnAndRow(11, 1, 'Clinica');



	$i=2;
	//dati
	
	$row = $db->selectAll('fatture', array('anno'=>$anno), ' num asc, anno asc ');

	if (count($row)>0){
		foreach($row as $r){

			
	
			$id = $r['id'];
		
	$num=$r['num'];
$id_cliente= $r['id_cliente'];
$totale = $r['importo'];
$dest=$r['dest'];
$data = Utility::getTime($r['data']);
$anno=$r['anno'];
$pagata=$r['pagata'];
$sconto=$r['sconto'];
$imponibile=$r['imponibile'];
$iva=$r['iva'];
$corriere=$r['spe_tra'];
$clinica='';
if($dest !='p'){
	$dest='c';
	$row2 = $db->selectAll('admin', array('id'=>$id_cliente));

foreach($row2 as $r2){
	
	$nomeCliente = Utility::iniziali($r2['nome']);
    
}	
}
elseif($dest=='p'){
	//dati propr
	$row2 = $db->selectAll('proprietari', array('id'=>$id_cliente));

foreach($row2 as $r2){

	$nome_proprietario = Utility::iniziali($r2['nome_proprietario']);
	$cognome_proprietario = Utility::iniziali($r2['cognome_proprietario']);
$nomeCliente =$cognome_proprietario.' '.$nome_proprietario;
    $id_struttura=$r2['id_struttura'];
$clinica=$db->getCampo('admin', 'nome', array('id'=>$id_struttura));

}
}


			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValueByColumnAndRow(0, $i, $num)
			->setCellValueByColumnAndRow(1, $i, $anno)
			->setCellValueByColumnAndRow(2, $i, $nomeCliente)
			->setCellValueByColumnAndRow(3, $i, $pagata)
			->setCellValueByColumnAndRow(4, $i, $totale)
			->setCellValueByColumnAndRow(5, $i, $imponibile)
			->setCellValueByColumnAndRow(6, $i, $sconto)
			->setCellValueByColumnAndRow(7, $i, $corriere)
			->setCellValueByColumnAndRow(8, $i, $dest)
			->setCellValueByColumnAndRow(9, $i, $data)
			->setCellValueByColumnAndRow(10, $i, $iva)
			->setCellValueByColumnAndRow(11, $i, $clinica);
			$i++;
            

  //$db->update('fatture', array('exp'=>'s'), $id);
		
		}
	}




	// Redirect output to a client’s web browser (Excel5)
	//header('Content-Encoding: ISO-8859-1');
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="dati_fatture.xls"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');


 	header('Cache-Control: max-age=1');
 	
 	
 	    ob_end_clean();
ob_start();

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
exit;


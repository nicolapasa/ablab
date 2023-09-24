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
->setTitle("esami Ablab");




$objPHPExcel->setActiveSheetIndex(0)
->setCellValueByColumnAndRow(0, 1, 'Id')
->setCellValueByColumnAndRow(1, 1, 'IdCat')
->setCellValueByColumnAndRow(2, 1, 'Categoria')
->setCellValueByColumnAndRow(3, 1, 'NomeEsame')
->setCellValueByColumnAndRow(4, 1, 'Abbr')
->setCellValueByColumnAndRow(5, 1, 'PrezzoCli')
->setCellValueByColumnAndRow(6, 1, 'PrezzoPro');



	$i=2;
	//dati
	
	$row = $db->selectAll('esami_cat', null, ' id asc ');

	if (count($row)>0){
		foreach($row as $r){

			$id_cat=$r['id_cat'];
		$id=$r['id'];
	         $nome_cat=$db->getCampo('categorie', 'nome', array('id'=>$id_cat));
				$prezzo=$r['prezzo'];
				
				$prezzo_pro=$r['prezzo_pro'];
				$nome=$r['nome'];
				$abbr=$r['abbr'];
			
		


			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValueByColumnAndRow(0, $i, $id)
			->setCellValueByColumnAndRow(1, $i, $id_cat)
			->setCellValueByColumnAndRow(2, $i, $nome_cat)
			->setCellValueByColumnAndRow(3, $i, $nome)
			->setCellValueByColumnAndRow(4, $i, $abbr)
			->setCellValueByColumnAndRow(5, $i, $prezzo)
			->setCellValueByColumnAndRow(6, $i, $prezzo_pro);
			$i++;
            


		
		}
	}




	// Redirect output to a client’s web browser (Excel5)
	//header('Content-Encoding: ISO-8859-1');
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="dati_cliniche_ablab.xls"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');


 	header('Cache-Control: max-age=1');
 	
 	
 	    ob_end_clean();
ob_start();

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
exit;


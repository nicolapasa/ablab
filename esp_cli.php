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
->setTitle("dati cliniche Ablab");

$p= new geo();


$objPHPExcel->setActiveSheetIndex(0)
->setCellValueByColumnAndRow(0, 1, 'Falsa')
->setCellValueByColumnAndRow(1, 1, 'Id')
->setCellValueByColumnAndRow(2, 1, 'NomeStruttura')
->setCellValueByColumnAndRow(3, 1, 'Referente')
->setCellValueByColumnAndRow(4, 1, 'Indirizzo')
->setCellValueByColumnAndRow(5, 1, 'Cap')
->setCellValueByColumnAndRow(6, 1, 'Comune')
->setCellValueByColumnAndRow(7, 1, 'Provincia')
->setCellValueByColumnAndRow(8, 1, 'Telefono')
->setCellValueByColumnAndRow(9, 1, 'Cellulare')
->setCellValueByColumnAndRow(10, 1, 'Fax')
->setCellValueByColumnAndRow(11, 1, 'Email')
->setCellValueByColumnAndRow(12, 1, 'Piva')
->setCellValueByColumnAndRow(13, 1, 'CodFis')
->setCellValueByColumnAndRow(14, 1, 'Tipo')
->setCellValueByColumnAndRow(15, 1, 'EmailFattura')
->setCellValueByColumnAndRow(16, 1, 'Pec')
->setCellValueByColumnAndRow(17, 1, 'CodUni')
->setCellValueByColumnAndRow(18, 1, 'IndSpe');



	$i=2;
	//dati
	
	$row = $db->selectAll('admin');

	if (count($row)>0){
		foreach($row as $r){

			
			//azzero i campi
			$indirizzo='';
			$indirizzo_spe='';
			$comune='';
		    $provincia='';
		    $piva = '';
		    $cf = '';
		    $cap = '';
		    $telefono = '';
		    $cell ='';
		    $fax = '';
			$tipo= '';
			$id = $r['id'];
			$nome =   stripslashes($r['nome']);
			if($r['indirizzo']!='')
			$indirizzo = stripslashes($r['indirizzo']);
			$indirizzo_spe=stripslashes($r['ind_spe']);
			//$indirizzo = str_replace("\", '', $indirizzo);
			$livello =$r['livello'];
			
			
			//gestione email
			//
			$emailFatt='';
			$emailPrimaria='';
		
			
			
			$emailPrimaria=$r['email'];
		

	
				$emailFatt =$r['email_fatt'];
		
		   $pec=$r['pec'];
		$cod=$r['cod'];
				//
			$piva = '"'.$r['piva'].'"';
			$cf = '"'.$r['cf'].'"';
			$cap = ' '.$r['cap'];
			$telefono = ' '.$r['telefono'];
			$cell = ' '.$r['cell'];
			$fax = ' '.$r['fax'];
			
			if(is_numeric($r['comune']) and $r['comune']!='')
				$comune =  $p->getCom($r['comune']);
			if(is_numeric($r['provincia']) and $r['provincia']!='')
				$provincia = $p->getProv($r['provincia']);
			$referente=  stripslashes($r['referente']);

			//update campo exp
			//$db->update('admin', array('exp'=>'s'), $id);
            if($livello != 'administrator'){


			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValueByColumnAndRow(0, $i, 'x')
			->setCellValueByColumnAndRow(1, $i, $id)
			->setCellValueByColumnAndRow(2, $i, $nome)
			->setCellValueByColumnAndRow(3, $i, $referente)
			->setCellValueByColumnAndRow(4, $i, $indirizzo)
			->setCellValueByColumnAndRow(5, $i, $cap)
			->setCellValueByColumnAndRow(6, $i, $comune)
			->setCellValueByColumnAndRow(7, $i, $provincia)
			->setCellValueByColumnAndRow(8, $i, $telefono)
			->setCellValueByColumnAndRow(9, $i, $cell)
			->setCellValueByColumnAndRow(10, $i, $fax)
			->setCellValueByColumnAndRow(11, $i, $emailPrimaria)
			->setCellValueByColumnAndRow(12, $i, $piva)
			->setCellValueByColumnAndRow(13, $i, $cf)
			->setCellValueByColumnAndRow(14, $i, $livello)
			->setCellValueByColumnAndRow(15, $i, $emailFatt)
			->setCellValueByColumnAndRow(16, $i, $pec)
			->setCellValueByColumnAndRow(17, $i, $cod)
			->setCellValueByColumnAndRow(18, $i, $indirizzo_spe);
			$i++;
            }


		
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


<?php
require_once './exwriter/Classes/PHPExcel.php';
include("autoloader.php");

ini_set('memory_limit', '1024M');
ini_set('max_execution_time', 0);
$db= new DB();


/** Include PHPExcel */
$u=new Utility();


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("ablab")
->setTitle("esami Ablab");




$objPHPExcel->setActiveSheetIndex(0)
->setCellValueByColumnAndRow(0, 1, 'Categoria')
->setCellValueByColumnAndRow(1, 1, 'NomeEsame')
->setCellValueByColumnAndRow(2, 1, 'Tot');

   $anno=$_GET['anno'];
   $mese=$_GET['mese'];

	$i=2;
    //dati

    $sql=" select id, id_cat, nome from esami_cat  order by  id asc ";
    //lista esami fatti
    $row_list = $db->sqlquery($sql);

    	foreach($row_list as $r){

                $id=$r['id'];
                $id_cat=$r['id_cat'];
          $nome=$r['nome'];
       $tipologia=$db->getCampo('categorie', 'nome', array('id'=>$id_cat));

         $tot=$db->getCampo('esami3_v', 'num', array('anno'=>$anno, 'mese'=>$mese, 'tipo'=>$id));
      if ($tot=='' )    $tot=0;





			$objPHPExcel->setActiveSheetIndex(0)
			->setCellValueByColumnAndRow(0, $i, $tipologia)
			->setCellValueByColumnAndRow(1, $i, $nome)
			->setCellValueByColumnAndRow(2, $i, $tot);
			$i++;





	}
	$meseNome= $u->getMese(abs($mese)-1);
$filename='stat_ablab_'.$meseNome.'_'.$anno.'.xls';


	// Redirect output to a client’s web browser (Excel5)
	//header('Content-Encoding: ISO-8859-1');
	header('Content-Type: application/vnd.ms-excel');
	header('Content-Disposition: attachment;filename="'.$filename.'"');
	header('Cache-Control: max-age=0');
	// If you're serving to IE 9, then the following may be needed
	header('Cache-Control: max-age=1');


 	header('Cache-Control: max-age=1');


 	    ob_end_clean();
ob_start();

	$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
	$objWriter->save('php://output');
exit;

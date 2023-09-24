<?php
include("./autoloader.php");
$db= new DB();

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

 
 
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
$reader->setReadDataOnly(true);
$spreadsheet = $reader->load("esami_cat.xls");

$worksheet = $spreadsheet->getActiveSheet();



$highestRow = $worksheet->getHighestRow(); // e.g. 10
$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn); // e.g. 5
for ($row = 2; $row <= $highestRow; ++$row) {
  
      echo   $id = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
      echo   $nome = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
      $pc = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
      $pp = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
      $db->update('esami_cat', array( 'prezzo'=>$pc,
       'prezzo_pro'=>$pp), $id);
 
}
/*
 for ($row=2;$row<=$xls->rowcount();$row++) { 
 echo $id=$xls->val($row,1);

 $pc=$xls->val($row, 4);

 $pp=$xls->val($row, 5);



 //$db->update('esami_cat', array( 'prezzo'=>$xls->val($row,4), 'prezzo_pro'=>$xls->val($row,5)), $id);
 
 
 } */

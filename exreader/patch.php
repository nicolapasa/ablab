<?php
include("autoloader.php");
$db= new DB();

require './exreader/excel_reader2.php';
$xls = new Spreadsheet_Excel_Reader("./exreader/valori.xls");
 for ($row=2;$row<=$xls->rowcount();$row++) { 
 $xls->val($row,1);

 $xls->val($row, 2);
 $db->add('tabelle_campi', array('id'=>$xls->val($row,1), 'value'=>$xls->val($row,2)));
 } 

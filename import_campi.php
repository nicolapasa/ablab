<?php

include("autoloader.php");
error_reporting(2);
$db= new DB();
/*
personalizzare nome del file 
nome tabella
*/

$file_ex='db'; //nome file
require './exreader/excel_reader2.php';
$xls = new Spreadsheet_Excel_Reader("./".$file_ex.".xls");
//echo $xls->rowcount();

 for ($row=2;$row<=$xls->rowcount();$row++) { 
 
 
$t=$xls->val($row,1);
$name= $xls->val($row, 2);
$label= $xls->val($row, 3);
$tipo= $xls->val($row, 4);
$classe= $xls->val($row, 5);
$t_link= $xls->val($row, 6);
$opzioni= $xls->val($row, 7);
$campo_link= $xls->val($row, 8);
$opt_link= $xls->val($row, 9);
$v= $xls->val($row, 10);




 $db->add('campi', array('tabella'=>$t, 'value'=>$name, 'label'=>$label,'tipo'=>$tipo, 'classe'=>$classe, 'tab_link'=>$t_link, 'campo_link'=>$campo_link, 'opzioni'=>$opzioni, 'opt_link'=>$opt_link, 'visualizza'=>$v ));


 //popolo mentre ciclo
 
 } 

//echo $db->cre_db($sql);

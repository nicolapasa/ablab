<?php

include("autoloader.php");
error_reporting(2);
$db= new Install();
/*
personalizzare nome del file 
nome tabella
*/
$tab='prova'; //nome tabella da creare
$file_ex='db'; //nome file
require './exreader/excel_reader2.php';
$xls = new Spreadsheet_Excel_Reader("./".$file_ex.".xls");
//echo $xls->rowcount();
$sql="CREATE TABLE $tab ("; 
 for ($row=2;$row<=$xls->rowcount();$row++) { 
 
 
$t=$xls->val($row,1);
$name= $xls->val($row, 2);
$type= $xls->val($row, 3);
if($type=='int') $type=' INT(32) ';
$extra= $xls->val($row, 4);
if($extra=='primary') $extra =' UNSIGNED AUTO_INCREMENT PRIMARY KEY ';
$label= $xls->val($row, 5);
$tipo= $xls->val($row, 6);
$classe= $xls->val($row, 7);
$t_link= $xls->val($row, 8);
$opzioni= $xls->val($row, 9);
$campo_link= $xls->val($row, 10);
$opt_link= $xls->val($row, 11);
$v= $xls->val($row, 12);

$sql.=" $name $type $extra "; 

if($xls->rowcount()>$row) $sql.=",";
if($tipo!='no') {
 $db->add('campi', array('tabella'=>$t, 'value'=>$name, 'label'=>$label,'tipo'=>$tipo, 'classe'=>$classe, 'tab_link'=>$t_link, 'campo_link'=>$campo_link, 'opzioni'=>$opzioni, 'opt_link'=>$opt_link, 'visualizza'=>$v ));
}

 //popolo mentre ciclo
 
 } 

 //eseguo il file sql solo alla fine
 $sql .=")"; 
 echo $sql;
//echo $db->cre_db($sql);

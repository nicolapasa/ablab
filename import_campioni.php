<?php
include("autoloader.php");
$db= new DB();
require_once __DIR__.'./exreader/src/SimpleXLSX.php';

set_time_limit(0);



$xlsx = SimpleXLSX::parse('./exreader/campioni2022.xlsx');

$c=0;
//convertire date in formato timestamp
foreach ( $xlsx->rows() as $rows ) {


    if($c>0){
$dati_grezzi=array(        
'nome'=>$rows[0]);

$db->add('organo', $dati_grezzi);
    }
$c++;

//if($c==5) exit;



}
echo 'record aggiornati: '.$c;

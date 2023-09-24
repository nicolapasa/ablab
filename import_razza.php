<?php
include("autoloader.php");
$db= new DB();
require_once __DIR__.'./exreader/src/SimpleXLSX.php';

set_time_limit(0);



$xlsx = SimpleXLSX::parse('./exreader/specierazze2022.xlsx');

$c=0;
//convertire date in formato timestamp
foreach ( $xlsx->rows() as $rows ) {


    if($c>0){
$dati_grezzi=array(    
'id_specie'=>$rows[0],    
'nome'=>$rows[1]);

$db->add('razza', $dati_grezzi);
    }
$c++;

//if($c==5) exit;



}
echo 'record aggiornati: '.$c;

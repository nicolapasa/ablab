<?php
include("autoloader.php");
$db= new DB();
require_once __DIR__.'./exreader/src/SimpleXLSX.php';

set_time_limit(0);



$xlsx = SimpleXLSX::parse('./exreader/listino_ablab.xlsx');

$c=0;
//convertire date in formato timestamp
foreach ( $xlsx->rows() as $rows ) {


    if($c>0){
$todo=$rows[7];
$id=$rows[0];
$id_cat=$rows[1];
$nome=$rows[2];
$nome_new=$rows[3];
$abbr=$rows[4];
//print_r($rows);
$dati_grezzi=array(  'nome'=>$nome_new,  
'prezzo'=>$rows[5],'prezzo_pro'=>$rows[6]
);
if($todo==''){
    $db->update('esami_cat', $dati_grezzi, $id);
}
else if($todo=='d'){
    $db->update('esami_cat', array('eliminato'=>'s'), $id);
}
else if($todo=='new'){
    $db->add('esami_cat', array('id_cat'=>$id_cat, 'nome'=>$nome, 'abbr'=>$abbr, 'prezzo'=>$rows[4], 'prezzo_pro'=>$rows[5]));
}

    }
$c++;

//if($c==5) exit;



}
echo 'record aggiornati: '.$c;

<?php
include("autoloader.php");
$db= new DB();


/** Include PHPExcel */
$u=new Utility();



   $anno=2020;
   $mese=12;



//print_r($row);
//lista esami
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
  
  }





?>

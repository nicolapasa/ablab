<?php

include('autoloader.php');

$db=new DB();
$ut=new Utility();
//retrieve content post 
$array_id=$_POST['array_ref'];

//var_dump($array_id);
$form_assegna_referti='';


//elenco refertatori 
foreach($db->selectAll('admin', array('livello'=>'referti')) as $row){


    $id_refertatore=$row['id'];
    $nome_refertatore=$row['nome_ref'];

    $form_assegna_referti .='<div class=" row" ><div class="col-md-4 bold">'.$nome_refertatore.' </div><div class="col-md-4 "> <a class="assegna_questo btn green-meadow"  href="script_assegna_referto.php?id_refertatore='.$id_refertatore.'&id='.urlencode(serialize($array_id)).'" > assegna</a>  </div></div><br>';

  


}


?>
 

 <!--begin section blog -->
 <?php
 $response='
 <h4 class="uppercase font-purple-studio bold">'.$title.'</h4>
 <h5 class="date bold">Data Arrivo 
 '.$dataArrivo.'
 </h5>
 <p>
 '.$form_assegna_referti.' 
 </p>  ';

echo $response;
?>

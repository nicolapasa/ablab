<?php

include("./autoloader.php");
//classe autenticazione
$db= new DB();

$opzione = addslashes( $_GET['opzione']);

if(isset($_GET['tipo']) and $_GET['tipo']=='pro') {
  $id=$opzione;

}
else{
    $id=$db->getCampo('province', 'id', array('nomeprovincia'=>$opzione));
}


			$row= $db->selectAll('comuni', array('idprovincia'=>$id), '  nomecomune asc ');

            foreach($row as $r){
            	//$r=$cl->pulisci($r);
                $nomecomune = utf8_encode($r['nomecomune']);
                $idcomune= $r['id'];
                if($_GET['tipo']=='pro') {
                    ?><option value="<? echo $idcomune; ?>"><?php echo $nomecomune; ?></option><?php 
                }
                else{
                    ?><option value="<? echo $nomecomune; ?>"><?php echo $nomecomune; ?></option><?php
                }
      
            }


            ?>
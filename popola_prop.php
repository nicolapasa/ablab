<?php

include("./autoloader.php");
//classe autenticazione
$db= new DB();

$opzione = $_GET['opzione'];
$cl=new Clear();
?>

                  

              <?php
			$row= $db->selectAll('proprietari', array('id_struttura'=>$opzione), '  cognome_proprietario asc');
         if(count($row)>0)    {
             ?> <option value="" selected></option>   <?php
            foreach($row as $r){
            	//$r=$cl->pulisci($r);
                $cognome = utf8_encode($r['cognome_proprietario']);
                $nome = utf8_encode($r['nome_proprietario']);
                $id= $r['id'];
  
            ?><option value="<? echo $id; ?>"><?php echo $cognome.' '.$nome; ?></option><?
           

         }
         }

            ?>
           
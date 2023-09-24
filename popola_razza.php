<?php

include("./autoloader.php");
//classe autenticazione
$db= new DB();

$opzione = $_GET['opzione'];
$cl=new Clear();
?>

                  

              <?php
			$row= $db->selectAll('razza', array('id_specie'=>$opzione), '  nome asc');
         if(count($row)>0){
            foreach($row as $r){
            	//$r=$cl->pulisci($r);
                $nome = utf8_encode($r['nome']);
                $id= $r['id'];
           
            ?><option value="<? echo $nome; ?>"><?php echo $nome; ?></option><?
            }

         }   else{
         	
         	?><option value=""></option><?
         	
         }
?> 
<option value="0">altro</option><?php 

            ?>
           
<!-- heading -->
<h4 class="innerAll margin-none bg-white">Cliniche che non hanno mai inviato</h4>






<?php
//last esame inserito in base alla data
//default da oggi

 Utility::getEscape($_GET);

/*	$sql="select * from admin where username!='' and livello!='administrator'
  group by id
   ";*/

   $sql="select * from admin where username != '' ";



   $sql.=" order by id desc ";
$param=Utility::getSearch($_GET);
$row=$db->sqlquery($sql);

?>



	   <div class=" flip-scroll">
 <table class="table table-bordered table-striped table-condensed flip-content" >
        <thead class="flip-content">
    <thead>
    <tr>
    	 <th >
    Id
    </th>
	 <th >
    Nome
    </th>
    <th >
     E-mail
     </th>


    </tr>
   </thead>
   <tbody>
<?php




$num=0;
foreach($row as $r){

$id_admin = $r['id'];
$email=$r['email'];
$nome = stripslashes($r['nome']);




$lastEsame=$db->getCampo("fatture_n", "time", array('id_struttura'=>$id_admin, 'completa'=>'s'), ' id desc', ' limit 1');
//seleziono ultimo esame
//get last esame
  //$q2=" select * from fatture_n where id_struttura='$id_admin' and completa='s' and time > '$data' order by id desc limit 1";


//  $last=$db->sqlquery(" select * from fatture_n where id_struttura='$id_admin' and completa='s' order by id desc limit 1");
//$row2=$db->sqlquery($q2);
if($lastEsame==0){
$num++;


?>
<tr class="gradeA">
  <td>
  <? echo $id_admin; ?>
    </td>
   <td>
  <? echo $nome; ?>
    </td>
    <td>
   <? echo $email; ?>
     </td>
  

<?php

 }
}

 ?>
<h4>totale <?php echo $periodo.': '. $num;?></h4>


</tbody>
</table>

</div>

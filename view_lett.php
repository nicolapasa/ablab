<!-- heading -->
<h4 class="innerAll margin-none bg-white">Forum letture dei post</h4>


    <div class=" flip-scroll">
 <table class="table table-bordered table-striped table-condensed flip-content" >
        <thead class="flip-content">
    <tr>
    	 <th >
    Id
    </th>
        <th >
   Titolo post
    </th>
	 <th >
    nome
    </th>

   
    </tr>
   </thead>
   <tbody>
<?php




$row= $db->selectAll('for_letture', array('tipo'=>'topic'), ' id_post  desc   ');


   
foreach($row as $r){
	$nomi=array();
$id_lett = $r['id'];
$id_post = $r['id_post'];
$utenti=explode(',',$r['utenti']);



$tipo=$r['tipo'];
if($tipo=='topic'){
$titolo=$db->getCampo('for_topic', 'titolo', array('id'=>$id_post));
}


//devo trovare corrispondenza 

if($titolo!=''){
?>
<tr class="gradeA">
  <td>
  <? echo $id_post; ?>
    </td>
       <td colspan="2">
  <? echo $titolo; ?>
    </td>

   </tr>
   
   
    <?php

 foreach($utenti as $ut){
    	
    $nome=$db->getCampo('admin', 'nome', array('id'=>$ut));
    	
    array_push($nomi, $nome);
    
 }

 sort($nomi, SORT_NATURAL | SORT_FLAG_CASE);
 foreach($nomi as $n){
    	?>
    	<tr>
    <td colspan="2">
    
    </td>
    	       <td>
    	  <? echo $n; ?>
    	    </td>
    	
    	   </tr>
    	   
    	   
    	    <?php
    	
 }
}
}

?>
</tbody>
</table>
</div>
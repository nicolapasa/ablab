<h4 class="innerAll margin-none bg-white">Amministrazione - Allegati</h4>

      <div class=" flip-scroll">
 <table class="table table-bordered table-striped table-condensed flip-content" >
        <thead class="flip-content">
    <tr>
    <th>
    Id allegato
    </th>
	 <th>
 Num Scheda
    </th>
   <th>
   Anno
    </th>
    <th >
   Azioni
    </th>
    </tr>
   </thead>
   <tbody>
<?php

$id_scheda=$_GET['id_scheda'];
$anno=$_GET['anno'];
$num=$db->getCampo('schede', 'num', array('id'=>$id_scheda));

$row= $db->selectAll('allegati', array('id_scheda'=>$id_scheda));

   
foreach($row as $r){
	
$id = $r['id'];
$file = './upload/'.$r['file'];

?>
 <tr>
  <td>
  <? echo $id; ?>
    </td>
   <td>
  <? echo $num; ?>
    </td>
    <td>
  <? echo $anno; ?>
    </td>
    <td>

<a target="_blank" class="btn btn-primary" href="<?php echo $file;?>">
<span>vedi</span></a>
    </td>
   </tr>
    <?php

}

?>
</tbody>
</table>
</div>
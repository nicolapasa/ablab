
<!-- heading -->
<h4 class="innerAll margin-none bg-white">Elenco documenti</h4>
<div class="col-separator-h"></div>



<?php 

if($livello=='service'){
	
	$sql="select * from doc where tipo='service'  order by id asc ";
}
else{
	
	$sql="select * from doc where tipo='struttura' order by id asc ";

}


$row = $db->paginaSql($sql,'10');




echo $db->printPagina(0,'doc');
?>	

	 <table class=" table">
    <thead>
    <tr>
	 <th>
Nome documento
    </th>
  




    </tr>
   </thead>
   <tbody>
<?php

$cl=new Clear();

   
foreach($row as $r){
	$r=$cl->pulisci($r);


	$id_doc= $r['id'];

		//echo $not->getLetta($id_loggata, $id_doc, 'doc');	
	
				$file=$r['file'];
	
				$nomedoc=$r['nome'];
				
				$tipo=$r['livello'];

?>
<tr class="gradeA">

    <td>

 
<a target="_blank" class="btn btn-primary" href="view.php?id=<?php echo $id_doc;?>">
			  <?php 
  
  	if(	$not->getNonLetta($id_loggata, $id_doc, 'doc')) {
	?>  <span class="badge badge-info badge-roundless">NEW!</span><?php } echo $nomedoc;?> </a>

</td>
		
   </tr>
    <?php

}

?>
</tbody>
</table>
<?php 

echo $db->printPagina(0, 'doc');

?>
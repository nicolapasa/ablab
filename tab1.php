
<!--tabella antibiogramma-->
<span class="caption-subject  bold uppercase">

<input type="text" name="nome_<?php echo  $id_tab;?>" value="<?php echo $nome_t;?>" />
</span><br><br>
	<a  id="<?php echo $id_tab;?>" class="del_tab btn btn-default" ><i class="fa fa-trash">Cancella Tabella</i></a>
<br><br>

	<input type="hidden" value="<?php echo  $id_tab;?>">
<a class="add_record btn btn-primary"><i class="fa fa-plus"></i>add Record</a> 
<div class="table-scrollable">
 <table class="table table-hover " >
<thead>
<tr>
<th>
Nome Campo
</th>
<th>
Sigla
</th>
<th>
Cancella
</th>
</tr>
</thead>
<tbody id="t<?php echo  $id_tab;?>">
<?php 




foreach($db->selectAll('tabelle_data', array('id_tab'=>$id_tab)) as $t){
	$idrec=$t['id'];
	$valore=$db->getCampo('tabelle_campi', 'value', array('id'=>$t['id_campo']));
	?>
	<tr>
	<td>
	<select name="campo_t_<?php echo  $id_tab;?>[]" >
	<option value="<?php echo $t['id_campo'];?>" selected><?php echo $valore;?></option>
	<?php 
	foreach($db->selectAll('tabelle_campi') as $r){
	
	echo '<option value="'.$r['id'].'" >'.$r['value'].'</option>';
}
	?>
	</select>
	</td>
		<td>
	<select name="sigla_t_<?php echo  $id_tab;?>[]" >
	<option value="<?php echo $t['sigla'];?>" selected><?php echo $t['sigla'];?></option>
	<option value="R" >R</option>
	<option value="S" >S</option>
	<option value="I" >I</option>
	
	</select>
	</td>
	<td>
	<input type="hidden" value="<?php echo $idrec;?>" >
	<a  class="del_rec btn btn-default" ><i class="fa fa-trash"></i></a></td>
	
	</tr>
	<?php 



}	



?>
</tbody>

</table>

</div>		
<!--fine tab-->	
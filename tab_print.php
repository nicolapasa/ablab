<?php 
if($nome_t=='') {

  $nome_t=$db->getCampo('tipo_tabella', 'value', array('id'=>$db->getCampo('tabelle', 'tipo', array('id'=>$id_tab))));
	
	
}
$text='
<br><div style="background-color:#B6A7A7;font-size:15px;"><b>'.$nome_t.'</b></div> 
 <table>
';
?>


<?php 
$text.=' <tr>
	<td width="200">
	</td>
		<td width="200" align="center">
	</td>
	
	</tr>';
$cR=-1;
foreach($db->selectAll('tabelle_data', array('id_tab'=>$id_tab)) as $t){
	$valore=$db->getCampo('tabelle_campi', 'value', array('id'=>$t['id_campo']));
	$tr='';
$cR++;
	if($cR==0) $tr='style="background-color:#eae0e0"';	
		
	
	if($cR==1) $cR=-1;
$text.='  
<tr '.$tr.'>
	<td width="200">'.$valore.'
	</td>
		<td width="200" align="center">'.$t['sigla'].'
	</td>
	
	</tr>
';	
	
}	


if($nome_firma_t !=''){
$nome_firma_t=explode('-', $nome_firma_t);
$text.='  
<tr>

<td colspan="3">'.$nome_firma_t[1].'
</td>
</tr>';
}
$text.=' 
</table>';
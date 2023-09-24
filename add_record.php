<?
include("autoloader.php");


$db= new db();


$tab=trim($_POST['tab']);


$td1='<td><select name="campo_t_'.$tab.'[]" >';

foreach($db->selectAll('tabelle_campi') as $r){
	
	$td1.='<option value="'.$r['id'].'" >'.$r['value'].'</option>';
}
$td1.='</select></td>';
$td2='<td><select name="sigla_t_'.$tab.'[]" >';
	$td2.='<option value="R" >R</option>';
	$td2.='<option value="S" >S</option>';
	$td2.='<option value="I" >I</option>';

$td2.='</select></td>';
$td3='<td><a class="delete_row btn btn-default" ><i class="fa fa-trash"></i></a>  </td>';  

echo '<tr>'.$td1.$td2.$td3.'</tr>
<script>
$(".delete_row").click(function(){
	 

var r=$(this).parent().parent().remove();

});	
</script>
';



?>
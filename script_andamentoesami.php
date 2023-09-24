
<!-- heading -->
<h4 class="bold">Andamento esami per mese</h4>
<?php 
//gestire poi cambio anno

//$anno=Utility::getCurr(null, 'Y');


?>	
<h4 class="bold">Anno <?php echo $anno;?></h4>




	 <table class=" table">
    <thead>
    <tr>
	 <th>
Esame
    </th>
  <th>
Totali Esami
    </th>
<th>
Gen
</th>
<th>
Feb
</th>
<th>
Mar
</th>
<th>
Apr
</th>
<th>
Mag
</th>
<th>
Giu
</th>
<th>
Lug
</th>
<th>
Ago
</th>
<th>
Set
</th>
<th>
Ott
</th>
<th>
Nov
</th>
<th>
Dic
</th>
    </tr>
   </thead>
   <tbody>
<?php
   $tot_mesi=array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 
   9=>0, 10=>0, 11=>0, 12=>0); 
$tot_gen=0;
    foreach($db->selectAll('categorie', null, ' id asc ') as $r){
 // print_r($row1);
   $id_cat=$r['id'];
   $nome=$r['nome'];
// array_push($arr_cat, array('cat'=>$id_cat));  
//anche l'anno
if($id_cat!=9){
$tot=count($db->sqlquery("select * from esami_v where id_cat='$id_cat' and anno='$anno' "));
$tot_gen=$tot_gen+$tot;
 ?>
<tr class="gradeA">
 
 <td>
 <?php echo $nome;?>
 </td>
 <td>
  <?php echo $tot;?>
 </td>
 <?php 
$c=1;	

while($c<13){

//t  numero giorni 

if($c<10) {
$mese='0'.$c;
}
else{
$mese=$c;	
}

$time_ini=Utility::getDataPre('01/'.$mese.'/'.$anno, 0, 0);
$day=date('t', $time_ini);
$time_fine=Utility::getDataPre($day.'/'.$mese.'/'.$anno, 23, 59);



$sql=" select count(id ) as tot from esami_v where  
 id_cat='$id_cat' 
and timeArr >= '$time_ini' and timeArr<='$time_fine'
"; 

$row=$db->sqlquery($sql);

//print_r($row);
foreach($row as $r1){
	  
	 
	  $tot_esame=$r1['tot'];
	 

$tot_mesi[$c]=$tot_mesi[$c]+ $tot_esame;
	

		

?>


    <td>

 
<?php echo $tot_esame;?>
			  
</td>
		

    <?php
 
$c++;
}
}
?>
  </tr>
  <?php 
  }
}
?>
<tr>

<td>
<strong>Totali </strong>
</td>
<td>
<strong><?php echo $tot_gen;?></strong>
</td>

<?php 
$c=1;
while($c<13){
?>
<td>
<strong><?php echo $tot_mesi[$c];?></strong>
</td>

<?php 



$c++;
}
?>

</tr>

</tbody>
</table>

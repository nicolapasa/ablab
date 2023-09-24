
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
<?php
   $tot_mesi=array(1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 
   9=>0, 10=>0, 11=>0, 12=>0); 
$tot_gen=0;
$c=1;	

while($c<13){

//t  numero giorni 


?>


<th>
<?php echo UTILITY::getMese($c-1) ;?>
</th>
<?php
$c++;
}?>
<th>
Totali Esami
</th>

</tr>
</thead>
<tbody>
<?php
$q="select id, nome from categorie where id!=9 order by id asc";
foreach($db->sqlquery($q) as $r){
//foreach($db->selectAll('categorie', null, ' id asc ') as $r){
    $id_cat=$r['id'];
    $nome=$r['nome'];
    ?>
    <tr class="gradeA">
     
     <td>
     <?php echo $nome;?>
     </td>
    
     <?php 
$c=1;
$tot=0;
while($c<13){

    if($c<10) {
        $mese='0'.$c;
        }
        else{
        $mese=$c;	
        }
    $time_ini=Utility::getDataPre('01/'.$mese.'/'.$anno, 0, 0);
    $day=date('t', $time_ini);
    $time_fine=Utility::getDataPre($day.'/'.$mese.'/'.$anno, 23, 59);
     
    
    
    $sql=" select count(id ) as tot from refertimancanti_v  
    where 
    id_cat='$id_cat' and timeArr >= '$time_ini' and timeArr<='$time_fine'
 
    "; 
    
    $row=$db->sqlquery($sql);
    foreach($row as $r1){  
 // print_r($row1);
 
// array_push($arr_cat, array('cat'=>$id_cat));  
//anche l'anno


//$tot=count($db->sqlquery("select * from esami_v where id_cat='$id_cat' and anno='$anno' "));
//$tot_gen=$tot_gen+$tot;





//print_r($row);

	  
	 
	  $tot_esame=$r1['tot'];
	 

$tot_mesi[$c]=$tot_mesi[$c]+ $tot_esame;
	

		

?>


    <td>

 
<?php echo $tot_esame;?>
			  
</td>
		

    <?php
 
$c++;

}
?>

  <?php 
  $tot=$tot+$tot_esame;
  }
  ?>
  <td>
  <?php echo $tot;?>
 </td>
 </tr>
 <?php
 $tot_gen+=$tot;
}
?>
<tr>
<td>
<strong>Totali </strong>
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

<td>
<strong><?php echo $tot_gen;?></strong>
</td>



</tr>

</tbody>
</table>

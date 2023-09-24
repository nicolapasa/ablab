
<!-- heading -->
<h4 class="innerAll margin-none bg-white">Elenco Num referti senza esame</h4>
<div class="col-separator-h"></div>



<?php



	$sql="select id_referto from refertimancanti_v where anno='$anno' order by id_referto desc ";

//valorizzo un array in cui metto tutti i numeri
$sql1="select max(id_referto) as alto from refertimancanti_v where anno='$anno'  ";
$row1 = $db->sqlquery($sql1);

$num_alto=$row1[0]['alto'];

$c=$num_alto;
$numTot=array();
while($c>0){

	array_push($numTot, $c);
	$c--;
}
//print_r($numTot);

$row = $db->sqlquery($sql);
$numRef=array();
foreach($row as $r){

	array_push($numRef, $r['id_referto']);


}





?>


<p>

<strong>Ultimo numero referto: </strong><?php echo $num_alto;?><br>
<strong>Numeri mancanti: </strong><br>
<?php



  foreach($numTot as $r){


if(!in_array($r,$numRef)){





?>



<?php echo $r.'<br>';?>

    <?php

}
  }

?>
</p>

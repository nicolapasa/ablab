<!-- heading -->
<h4 class="innerAll margin-none bg-white">Report per firma</h4>

<?php
$ut=new Utility();
 $ut->getEscape($_GET);


	if($_GET['anno']!=''){
		$anno_core=$_GET['anno'];
		$ut->array_push_associative($search, array('anno'=>$anno_core));
	}
	else
	{
		$anno_core=ANNO_CORE;
	}
    $sql="select count( id_firma) as num, id_firma from report_annuale_v where anno=$anno_core and stato=3 and ISNUMERIC(id_firma)=0 and id_firma !='' group by id_firma "; 



$sql.=" order by id desc ";

?>
<div class="portlet-body form">
 
 <form class="horizontal-form" action="index.php" method="get" enctype="multipart/form-data">
 <div class="form-body">
 <div class="row">
      <div class="col-md-4">
              <div class="form-group row">
              <label class="col-md-4 col-form-label bold">Anno:</label>
              <div class="col-md-8">  <select  name="anno"  class="form-control">
                    <option value="<?php echo $anno_core;?>" selected><strong><?php echo $anno_core;?></strong></option>
                    <?php
                       /*determino gli anni presenti in base alle annualità presenti nella tabella
                          schede */

                    $rw=   $db->sqlquery('select distinct(anno) from referti_v  ');
                    foreach($rw as $r){


                        ?>
                        <option value="<?php echo $r['anno'];?>" ><?php echo $r['anno'];?></option>

                        <?php
                      }



                    ?>


                </select></div>
              </div>
      </div>



</div><!--end row-->


    

<input type="hidden" name="req" value="report_firma" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
                             <a href="index.php?req=report_firma"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>
<?php


$param=$ut->getSearch($_GET);
$param2=$ut->getSearch2($_GET);

$row = $db->sqlquery($sql);





?>





	   <div class=" flip-scroll">
 <table class="table table-bordered table-striped table-condensed flip-content" >
        <thead class="flip-content">
    <thead>
    <tr>

	 <th >
    Firma
    </th>
    <th>
    Esami
    </th>
   
  
    </tr>
   </thead>
   <tbody>
<?php



foreach($row as $r){



$firma = $r['id_firma'];
$num=$r['num'];


?>
<tr class="gradeA">

   <td>
  <?php echo $firma; ?>
    </td>

    <td>
  <?php echo $num; ?>
    </td>
 


   </tr>
    <?php

}






?>

</tbody>


</table>

</div>

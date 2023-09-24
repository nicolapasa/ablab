<!-- heading -->
<h4 class="innerAll margin-none bg-white">Cliniche inattive</h4>



<div class="portlet-body form">
 <form class="horizontal-form" action="index.php" method="get" enctype="multipart/form-data">
 <div class="form-body">

     <div class="row">

<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Data ultimo inserimento: </label>
<div class="col-md-8"><input type="text" class="form-control date-picker" data-date-format="dd/mm/yyyy"    name="data"  />
</div>
</div>
</div>
<div class="col-md-6">
<div class="form-group row">
<label class="col-md-4 col-form-label bold">Periodo:</label>
<div class="col-md-8">
  <select  name="periodo">
  <option value="" selected=selected> </option>
  <option value="ultimi 3 mesi" > ultimi 3 mesi</option>
  <option value="ultimi 6 mesi" > ultimi 6 mesi</option>
  <option value="1 anno" >1 anno</option>
    <option value="2 anni" >2 anni</option>
      <option value="3 anni" >3 anni</option>
  </select>

</div>
</div>
</div>
</div><!--end row-->
<input type="hidden" name="req" value="admin" />
<input type="hidden" name="subreq" value="check_inattivi" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>CERCA
								</button>
								  <a href="index.php?req=admin&subreq=check_inattivi"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->
	</div>
</form>
</div>


<?php
//last esame inserito in base alla data
//default da oggi

 Utility::getEscape($_GET);

/*	$sql="select * from admin where username!='' and livello!='administrator'
  group by id
   ";*/

   $sql="select * from cliniche_inattive_v  where id>0  ";

if($_GET['data']!=''){

   $newdate=$_GET['data'];

	// Utility::array_push_associative($search, array('data'=>$_GET['data']));

     $periodo='al '.$_GET['data'];



}
else {
$periodo=$_GET['periodo'];
  switch($periodo) {
    case "ultimi 3 mesi":



          $newdate = date("d/m/yy", strtotime("-3 months"));





      break;
      case "ultimi 6 mesi":
      $newdate = date("d/m/yy", strtotime("-6 months"));



        break;
        case "1 anno":
        $newdate = date("d/m/yy", strtotime("-12 months"));



          break;
          case "2 anni":
          $newdate = date("d/m/yy", strtotime("-24 months"));



            break;
            case "3 anni":
            $newdate = date("d/m/yy", strtotime("-36 months"));



              break;
      default:
       $newdate = date("d/m/yy", strtotime("-3 months"));


  }


	 Utility::array_push_associative($search, array('periodo'=>$_GET['periodo']));
}
    $newdate;
        $data=Utility::getData($newdate);

     $sql.=" and time <= $data ";

$sql.=" order by time desc, nome_clinica asc ";
$param=Utility::getSearch($_GET);
$row=$db->sqlquery($sql);

?>



	   <div class=" flip-scroll">
 <table class="table table-bordered table-striped table-condensed flip-content" >
        <thead class="flip-content">
    <thead>
    <tr>
    	 <th >
    Id
    </th>
	 <th >
    Nome
    </th>
    <th >
     E-mail
     </th>
     <th >
      Ultimo invio
      </th>
      <th >
       da quanto
       </th>
    </tr>
   </thead>
   <tbody>
<?php




$num=0;
foreach($row as $r){

$id_admin = $r['id'];
$email=$db->getCampo('admin', 'email', array('id'=>$id_admin));
$nome = stripslashes($r['nome_clinica']);

$last=Utility::getTime($r['time']);


$da_quanto=(int)Utility::datediff('M',  $last, Utility::getTime());
//seleziono ultimo esame
//get last esame
  //$q2=" select * from fatture_n where id_struttura='$id_admin' and completa='s' and time > '$data' order by id desc limit 1";


//  $last=$db->sqlquery(" select * from fatture_n where id_struttura='$id_admin' and completa='s' order by id desc limit 1");
//$row2=$db->sqlquery($q2);
if ($da_quanto >1){
$num++;


?>
<tr class="gradeA">
  <td>
  <? echo $id_admin; ?>
    </td>
   <td>
  <? echo $nome; ?>
    </td>
    <td>
   <? echo $email; ?>
     </td>
     <td>
    <? echo $last; ?>
      </td>
      <td>
     <? echo $da_quanto.' mesi'; ?>
       </td>
<?php
}
 }


 ?>
<h4>Cliniche inattive  <?php echo $periodo.': '. $num;?></h4>


</tbody>
</table>

</div>

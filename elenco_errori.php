<h4 class="innerAll margin-none bg-white">Elenco errori</h4>
<div class="portlet-body">
<?php
$utility=new Utility();
$sql="select * from error where tipo='errore' and contesto NOT LIKE 'invio mail' order by id desc";


$param=Utility::getSearch($_GET);
$param2=Utility::getSearch2($_GET);
$itemsPerPage = 30;
$rows = $db->paginaSql($sql, $itemsPerPage);




$totalItems = $db->tot_records;

$currentPage = $db->current_page;


$urlPattern = './index.php?req=errori_db&page=(:num)'.$param.'';
$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);
?>
<div class="row">
<div class="col-md-6">
<?php
$first=($currentPage*$itemsPerPage)-($itemsPerPage-1);
$last=$first+$itemsPerPage-1;
echo 'visualizza da '.$first.'  a '.$last.'  di '.$totalItems.'  risultati ';
?>
</div>
<div class="col-md-6">
<?php

    echo $paginator;
?></div>
</div>


									<div class=" flip-scroll">

						 <table class="table table-bordered table-striped table-condensed flip-content" >
										<thead class="flip-content">
	 														<thead>
	 															<tr>

																	<th>
                                    Contesto
																	</th>
																	<th>
																		Errore
																	</th>
																	<th>
																		Info
																	</th>
																	<th>
																	Data
																	</th>

																	<th>
                                  Ora
																	</th>
																	<th>

																			Delete
																	</th>
	 															</tr>
	 														</thead>
	 														<tbody>
																<?php



																foreach($rows as $r){

																	$contesto=$r['contesto'];
																	$info=$r['info'];
																	$valore=$r['valore'];
																	$data=$utility->getTime($r['time']);
																	$ora=$utility->getTime2($r['time']);

                                                                    $id=$r['id'];
												

																?>
	 															<tr>
	 																<td><?php echo $contesto;?></td>
	 																<td><?php echo $valore;?></td>
	 																<td><?php echo $info;?></td>
	 														<td><?php echo $data;?></td>
	 														<td><?php echo $ora;?></td>
																<td>
																			<a class="btn btn-primary delete_error" id="<?php echo $id;?>">
																						<i class='fa fa-trash'></i></a>
																			<span></span>

																	</a>
																</td>
	 															</tr>

																<?php

															}
														
															?>
	 														</tbody>
	 													</table>
														<?php

														  echo $paginator;
														?>
												</div>

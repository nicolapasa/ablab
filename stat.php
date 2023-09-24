<?php
$anno=Utility::getCurr(null, 'Y');
if($_GET['anno'] !='')
{
$anno=$_GET['anno'] ;

}


?>

<div class="panel panel-default">
                                   
                                        <div class="panel-body home"> 
										<div class="note note-success ">
<h1 class="block text-center"><i class="fa fa-medkit"></i>Statistiche   - Anno <?php echo $anno;?></h1>



<a href="index.php?req=stat&subreq=andamento_esami&anno=<?php echo $anno;?>" class=" btn btn-primary  ">Andamento esami  </a> 

<a href="index.php?req=stat&subreq=andamento_tipi&anno=<?php echo $anno;?>" class=" btn btn-primary  ">Andamento esami specifici  </a> 
<a href="index.php?req=stat&subreq=conta_esami&anno=<?php echo $anno;?>" class=" btn btn-primary  ">Contatore esami  </a> 
<a href="index.php?req=stat&subreq=andamento_utenze&anno=<?php echo $anno;?>" class=" btn btn-primary   ">Andamento Esami per Utenza  </a> 

<a href="index.php?req=stat&subreq=andamento_utenzef&anno=<?php echo $anno;?>" class=" btn btn-primary  ">Andamento Fatturato per Utenza  </a> 
<a href="index.php?req=stat&subreq=ref_noesami&anno=<?php echo $anno;?>" class=" btn btn-primary  ">Esami mancanti  </a> 


<br>
<form class="form " method="GET" action="index.php">


                <select  name="anno"  class="form-control">
                    <option value="<?php echo $anno;?>" selected><strong><?php echo $anno;?></strong></option>
                    <?php
                       /*determino gli anni presenti in base alle annualità presenti nella tabella 
                          schede */

                    $rw=   $db->sqlquery('select distinct(anno) from schede where completa="s" '); 
                    foreach($rw as $r){
						if($r['anno']<ANNO_CORE){

							?>
                      <option value="<?php echo $r['anno'];?>" ><?php echo $r['anno'];?></option>
                 
                      <?php 
						}
                    }
              
            ?>
  <option value="<?php echo ANNO_CORE;?>"><?php echo ANNO_CORE;?></option>
                  
                </select>

		


<input type="hidden" name="req" value="stat" />
<!-- Form actions -->
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>SELEZIONA ANNO
								</button>
								  <a href="index.php?req=stat"  class="btn default">RESET</a>
							</div>
							<!-- // Form actions END -->


</form>
</div>
</div>
</div>

<?php


switch($subreq){
	
	
	
	case 'ref_noesami':
	
	
	include('script_refnoesami.php');
	
	break;
	
	case 'andamento_esami':
	
	
	include('script_andamentoesami_up.php');
	
	break;
	case 'andamento_tipi':
	
	
	include('script_andamentoesamitipo.php');
	
	break;
	case 'conta_esami':
	
	
	include('script_contaesami.php');
	
	break;
	case 'andamento_utenze':
	
	
	include('script_utenzeesami.php');
	
	break;
	case 'andamento_utenzef':
	
	
	include('script_utenzefatt.php');
	
	break;
	
}





?>
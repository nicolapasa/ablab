<?php
if($livello !='administrator' ) header("Location: index.php?req=accesso_negato");
switch ($subreq){
	case 'mod_news':
	

		$id= (int)$_GET['id'];

	
		$row= $db->selectAll('news', array('id'=>$id));
	
	
		if(count($row)>0){
	
			foreach($row as $r){
	
	
				$id_news= $r['id'];
			
				$titolo=$r['titolo'];
		
	
				$data=$r['data'];
				$testo=$r['testo'];
				$file=$r['file'];
	
	
			}
		}
	

		?>
	<form class="form-horizontal" id="form-nm"
					enctype='multipart/form-data' action="save.php" method="post"
					autocomplete="off">
			<div class="portlet light bordered lilla">
                                <div class="portlet-title">
                                    <div class="caption font-dark">
                                        <i class="icon-settings font-red-sunglo"></i>
                                        <span class="caption-subject bold uppercase">Crea Notizia</span>
                                    </div>
                                   
                                </div><!--title-->
                                <div class="portlet-body form">
		
	
	 

	<div class="form-group">
	<label class="col-md-4 control-label">Titolo</label>
		<div class="col-md-8">
		<textarea class="form-control"  name="titolo"><?php echo $titolo;?></textarea> 
		</div>
		</div>
		<div class="form-group">
	<label class="col-md-4 control-label"  for="author">Foto copertina</label>
	<div class="col-md-8">
	<div class="fileupload fileupload-new margin-none" data-provides="fileupload">
	  	<span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span>
	  	<span class="fileupload-exists">Change</span>
	  	<input name="file" type="file" class="margin-none" /></span>
	<?php if($file!=''){ ?>  	<span class="fileupload-preview"><a class="btn btn-primary" target="_blank" href="<?php echo DIR_UPLOAD.$file;?>"  >
	  <?php 	if(preg_match('/(JPG|jpg|gif|png|gif|bmp)$/',Utility::getExt(DIR_UPLOAD.$file))){?>
	<img src="<?php echo DIR_UPLOAD.$file;?>"  width="100"/><?php }else{echo "scarica";}?></a></span><?php }?>
	  	<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>
	</div>
	</div>
	</div> 
		<div class="form-group">
	<label class="col-md-4 control-label">Testo notizia </label>
		<div class="col-md-8">
		<textarea  class="editor2"  name="testo"><?php echo $testo;?></textarea> 
		</div>
		</div>	
	
	
	
	

			
	<input type="hidden" value="<? echo $id;  ?>"  name="id" />

	<input type="hidden" value="mod_news"  name="action" />
	<!-- Form actions -->
								<div class="form-actions">
									<button type="submit" class="btn btn-primary">
										<i class="fa fa-check-circle"></i> Salva
									</button>
									<button type="button" class="btn btn-default">
										<i class="fa fa-times"></i> Cancel
									</button>
								</div>
								<!-- // Form actions END -->
				
							</div>
						</div>
						<!-- // Widget END -->
					</div>
				</form>
				<!-- // Form END -->
	
	<?php
	break;

default:
?>	
 <div class="portlet light bordered">
                                        <div class="panel-heading">
                                            <h3 class="panel-title"><i class="fa fa-sticky-note"></i>Elenco News</h3>
                                        </div>
                                      
<!-- heading -->


<a class="btn btn-primary" href="index.php?req=news&subreq=mod_news"><i class="fa fa-plus"></i>Nuovo </a>
<?php 


	
	$sql="select * from news order by id desc ";

    




$param=Utility::getSearch($_GET);	
$param2=Utility::getSearch2($_GET);
$itemsPerPage = 20;
$row = $db->paginaSql($sql, $itemsPerPage);



$totalItems = $db->tot_records;

$currentPage = $db->current_page;


$urlPattern = './index.php?req=news&page=(:num)'.$param.'';
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

    <tr>
	 <th>
Titolo
    </th>
    	 <th>
Data
    </th>
     <th>
  Modifica
  </th>
    <th>
Elimina
  </th>

    </tr>
   </thead>
   <tbody>
<?php

$cl=new Clear();

   
foreach($row as $r){
	$r=$cl->pulisci($r);


	$id_news= $r['id'];
			
				$titolo=$r['titolo'];
		
	
				$data=$r['data'];
	
?>
<tr class="gradeA">

    <td>
  <?php echo $titolo;?>  
  </td>
    <td >
  <? echo $data; ?>
    </td>
   
         <td>

   
<a class="btn btn-primary" href="index.php?req=news&subreq=mod_news&id=<?php echo $id_news;?>" >
			<span><i class="fa fa-edit"></i></span></a>

			  <td>
<input type="hidden" value="news" >
<a class="btn btn-primary delete" id="<?php echo $id_news;?>">
			<span><i class="fa fa-trash"></i> </span></a>


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
</div>

<?php


}
?>
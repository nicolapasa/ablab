  <h3 class="page-title">News 
                    
                    </h3>
 <div class="blog-page blog-content-1">
 <?php


	$sql="select * from news order by id desc ";


$param=Utility::getSearch($_GET);	
$param2=Utility::getSearch2($_GET);
$itemsPerPage = 10;
$row = $db->paginaSql($sql, $itemsPerPage);



$totalItems = $db->tot_records;

$currentPage = $db->current_page;


$urlPattern = './index.php?req=blog&page=(:num)'.$param.'';
$paginator = new Paginator($totalItems, $itemsPerPage, $currentPage, $urlPattern);	
	
	
	
			foreach($row as $r){
	
	
				$id_news= $r['id'];
			
				$titolo=$r['titolo'];
		
	
				$data=$r['data'];
				$testo=Utility::troncaTesto(strip_tags($r['testo']), 200);
				$file=$r['file'];
				$url=DIR_UPLOAD.$file;

?> 
				 
				 
				 
				 
                                <div class="blog-post-lg bordered blog-container">
								<?php if($file!='') {?>
                                  <!--  <div class="blog-img-thumb">
                                        <a href="javascript:;">
                                            <img src="<?php echo $url;?>" />
                                        </a>
                                    </div>-->
								<?php } ?>	
                                    <div class="blog-post-content">
                                        <h2 class="blog-title blog-post-title">
                                            <a href="index.php?req=blog-post&id=<?php echo $id_news;?>"><?php echo $titolo;?></a>
                                        </h2>
                                        <p class="blog-post-desc"> 
										<?php echo $testo;?>
										</p>
                                        <div class="blog-post-foot">
                                              <a class="btn btn-info" href="index.php?req=blog-post&id=<?php echo $id_news;?>">
											  <i class="fa fa-book"></i>
											  Leggi</a>
                                       
                                            <div class="blog-post-meta">
                                                <i class="icon-calendar font-blue"></i>
                                                <a href="javascript:;"><?php echo $data;?></a>
                                            </div>
                                         
                                        </div>
                                    </div>
                                </div>
			<?php } ?>	

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
</div>								
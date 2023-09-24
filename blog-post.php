  <h3 class="page-title">News

                    </h3>
 <div class="blog-page blog-content-2">
 <?php

 $id=$_GET['id'];
$row= $db->selectAll('news', array('id'=>$id));




			foreach($row as $r){



			    $file=$r['file'];
				if($file!='') $src=DIR_UPLOAD.$file;
				$titolo=$r['titolo'];

    if($livello=='administrator'){
      $row_a = $db->selectAll('admin', array('livello'=>'administrator'));
      foreach($row_a as $r_a){

       $not->getLetta($r_a['id'], $id, 'news');
      }

    }
    else{
      	$not->getLetta($_SESSION['loggato'], $id, 'news');
    }


				$data=$r['data'];
				$testo=$r['testo'];

?>






								 <div class="blog-single-content bordered blog-container">
                                    <div class="blog-single-head">
                                        <h1 class="blog-single-head-title"><?php echo $titolo;?></h1>
                                        <div class="blog-single-head-date">
                                            <i class="icon-calendar font-blue"></i>
                                            <a href="javascript:;"><?php echo $data;?></a>
                                        </div>
                                    </div>
									<?php if($file!=''){?>
                                    <div class="blog-single-img">
                                        <img src="<?php echo $src;?>" >
									</div>
									<?php } ?>
                                    <div class="blog-single-desc">
                                          <?php echo $testo;?>

								   </div>
                                   </div>


			<?php } ?>
</div>

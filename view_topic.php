<?php
	

	//$cl=new Clear();
		$id_topic=$_GET['id']; 
		
		//bisogna incrementare le letture
		$letto=(int)$db->getCampo('for_topic', 'letto', array('id'=>$id_topic));
		//segno letto solo se id loggata diverso da autore
	//	$id_autore =$db->getCampo('for_topic', 'id_admin', array('id'=>$id_topic));
		
		//gestione lettura notifica
		$not=new Notifiche();
		
	if($not->getLetta($id_loggata, $id_topic, 'forum') ){
		
	
			$letto++;
		$db->update('for_topic', array('letto'=>$letto), $id_topic);
    
		$utenti=$db->getCampo('for_letture', 'utenti', array('id_post'=>$id_topic, 'tipo'=>'topic')).','.$id_loggata;
		$db->updateP('for_letture', array('utenti'=>$utenti), array('id_post'=>$id_topic, 'tipo'=>'topic'));
	}
?>

	<!-- heading -->
	<h4 class="innerAll margin-none bg-white">Forum discussione: <?php echo $db->getCampo('for_topic', 'titolo', array('id'=>$id_topic));?></h4>
	<div class="col-separator-h"></div>

	

	<?php 
	//se sono nella prima pagina visualizzo la discussione originale
	$first='';
	if($_GET['page']==1 or !isset($_GET['page'])) {
	
		
		//visualizzo la discussione
		$row= $db->selectAll('for_topic', array('id'=>$id_topic));
		
		
		if(count($row)>0){
		
			foreach($row as $r){
		
				$id_topic = $r['id'];
				$id_autore=$r['id_admin'];
				$data = Utility::getTime($r['data']);
				$ora = Utility::getTime2($r['data']);
				$titolo=$r['titolo'];
				$autore=$db->getCampo('admin', 'nome', array('id'=>$id_autore));
				$foto_=$db->getCampo('admin', 'foto', array('id'=>$id_autore));

				$foto='<img src="./img/noimage.png" class="img-for-min"  />';
				if($foto_ != '' and file_exists(DIR_UPLOAD.$foto_)) $foto='<img src="'.DIR_UPLOAD.$foto_.'" class="img-thumbnail"  />';
				$testo=$r['testo'];
				$gal='';
				$modifica='';
				$elimina='';
				if($livello =='administrator' or $id_autore == $id_loggata) {
					$modifica="	<a class='btn btn-primary' href='index.php?req=forum&subreq=mod_topic&id=$id_topic'>modifica </a>";
					$elimina="	<a class='btn btn-primary delete_topic' id=$id_topic>elimina </a>";
				}
			
		       $first=" 
	<tr class='head first'>
		    <td width='20%'>
	<strong>   $autore</strong>
	    </td>
	    <td width='60%'>
	<strong>    inviato il  $data alle ore $ora </strong>$modifica
	  </td>
	     <td width='20%'>
	$elimina
	  </td>
      </tr>
      	<tr class='gradeB'>
	    <td width='5%'>
	   $foto
	    </td>
		  <td class='white' width='95%'>
	    $testo
	  
	    </td>
	   </tr>
	   	<tr>
	    <td colspan='2' class='header'>
	   	<a class='btn btn-primary' href='index.php?req=forum&subreq=mod_post&id=$id_topic'>rispondi </a>
	    </td>
	 </tr>";
		
			}
		}
	
	}
		
		$sql="select * from for_post where id_topic='$id_topic' order by id asc  ";
	
	   
	
	$row = $db->paginaSql($sql,'10');

	
	
	echo $db->printPagina(0,'forum&subreq=view_topic', array('id'=>$id_topic));
	?>	
	
		 <table class="table">

	   <tbody>
	
	<?php
	
echo $first; //visualizza discussione in testa
	
	   if(count($row)>0){
	foreach($row as $r){
	//	$r=$cl->pulisci($r);
	$id_topic= $r['id_topic'];
	$id_post=$r['id'];
	$id_autore_post= $r['id_admin'];
	$modifica='';
	$elimina='';
	$not->getLetta($id_loggata, $id_post, 'forum');
	if($livello =='administrator' or $id_autore_post == $id_loggata){
		$modifica="	<a class='btn btn-primary' href='index.php?req=forum&subreq=mod_post&id=$id_topic&id_post=$id_post'>modifica </a>";
		$elimina="<a class='btn btn-primary delete_post' id=$id_post>
			<span>elimina</span></a>";
	}
	$data = Utility::getTime($r['data']);
	$ora = Utility::getTime2($r['data']);
    $testo=$r['testo'];
	$autore=$db->getCampo('admin', 'nome', array('id'=>$id_autore_post));
	$foto_=$db->getCampo('admin', 'foto', array('id'=>$id_autore_post));
	$foto='<img src="./img/noimage.png" class="img-for-min"  />';
	if($foto_ !=''  and file_exists(DIR_UPLOAD.$foto_)) $foto='<img src="'.DIR_UPLOAD.$foto_.'"  class="img-thumbnail" />';
	
	?>

	<tr class='head' id="<?php echo $id_post;?>">
		    <td width='20%'>
	 <strong><? echo $autore; ?></strong> 
	    </td>
	    <td width='60%'>
	   <strong> <?php echo ' inviato il '.$data.' alle ore '.$ora;?>  <?php echo $modifica;?></strong>
	  </td>
	    <td width='20%'>
	<?php echo $elimina; ?>
	  </td>
      </tr>
      	<tr>
	    <td width='5%'>
	    <? echo $foto; ?>
	    </td>
		  <td class='white' width='95%'>
	    <? echo $testo; ?>
	 
	    </td>
	   </tr>
	  <tr>
	    <td colspan="2" class="header">
	   	<a class="btn btn-primary" href="index.php?req=forum&subreq=mod_post&id=<?php echo $id_topic;?>">rispondi </a>
	    </td>
	 </tr>
	    <?php
	
	}
	   }
	?>
	</tbody>
	</table>
	<?php 
	
	echo $db->printPagina(0, 'forum&subreq=view_topic',array('id'=>$id_topic));	


?>

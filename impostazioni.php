
<?php
switch ($subreq){

case "modifica":

$f= new Form();
$cl= new Clear();

//gestione id validazione
$idform=$req;
if($id_mod !='' and $id_mod >0){
	
	$idform=$req.'_';
}


?>
 <div class="row">
                        <div class="col-md-12">
		   <form role="form" class="form-bordered" id="<? echo $idform;?>"  enctype='multipart/form-data'   action="save.php" method="post" autocomplete="off">
                   <div class="form-body">		
    

   <?php  
   //form generato dalla classe
  echo  $f->gen($req, array('id'=>$id_mod));
   
   
   ?>
   
		<!-- Form actions -->
<input type="hidden" value="<? echo $id_mod; ?>"  name="id" id="id" />
<input type="hidden" value="<?php echo $req;?>"  name="action" />

			
			 <div class="form-actions">
                 <button type="submit" class="btn blue">Salva</button>
                   
             </div>
	</div>
</form>
</div>
</div>
<!-- // Form END -->
<?php
break;

default:
	$db= new Form();

	
//tutte le colonne sono dinamiche
	//modulo di ricerca 
	/*@todo renderlo universale personalizzato con parametri, 
	 * trovare un modo
	 */
	
?>    <? echo "<a class='btn btn-lg blue' href='index.php?req=$req&subreq=modifica'>";echo "<i class='fa fa-plus'></i>Nuova Impostazione";?></a>                            
   
   <div class="portlet red-mint box">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-cogs"></i>Elenco <?php echo $req;?> </div>
                                 
                                </div>
                  
  <div class="portlet-body flip-scroll">

 <table class="table table-striped table-bordered table-hover table-header-fixed" id="sample_1">

	<!-- Table heading -->
	   <thead class="flip-content">
    <tr>
    <?php 
  
    $col=$db->getCol($req);
     foreach($col as $c){
     	
     	//deve vedere se il campo va visualizzato
     	$view=$db->getCampo('campi', 'visualizza', array('tabella'=>$req, 'value'=>$c['Field']));
     	if($view!='n'){
    ?>
    <th >
<?php 

echo $c['Field'];?>
    </th>
<?php }

     	}?>

  <th >
Modifica
    </th>
    <th >
    Elimina
    </th>
    </tr>
    </thead>
<tbody>
<?php

//paginazione
$r=$db->selectAll($req, null, ' id asc ');



//$r=$db->paginaNolike($req, '20', $search, ' id asc ');

if(count($r)>0)
foreach($r as $row){


	$id=$row['id'];

?>
	<tr class="gradeA">
	<?php 
 $col=$db->getCol($req);
 //print_r($col);
     foreach($col as $c){
     
     	$val=$row[$c['Field']];
     //gestire campi speciali come id collegati a tabelle e immagini
     	$tipo=$db->getCampo('campi', 'tipo', array('tabella'=>$req, 'value'=>$c['Field']));
     	$view=$db->getCampo('campi', 'visualizza', array('tabella'=>$req, 'value'=>$c['Field']));
     	if($tipo=='select'){
     	
     	//allora vedo la tabella collegata 
     		$tab_link=$db->getCampo('campi', 'tab_link', array('tabella'=>$req, 'value'=>$c['Field']));
     		$opt_link=$db->getCampo('campi', 'opt_link', array('tabella'=>$req, 'value'=>$c['Field']));
     		$val=$db->getCampo($tab_link, $opt_link, array('id'=>$row[$c['Field']]));
     	}
    
     	if($tipo=='upload' and $val!=''){
     		
     		
     		//devo vedere il tipo di documento
     		
     			if(preg_match('/(JPG|jpg|gif|png|gif|bmp)$/',Utility::getExt(DIR_UPLOAD.$val))){
		
     			$val='<img  src="./'.DIR_UPLOAD.$val.'"   width="50" height="50" />';
     	   		}
     	  	 else{
     	   	
     	   		$val= '<a target="_blank" class="btn btn-circle btn-primary" href="'.DIR_UPLOAD.$val.'">scarica doc</a>';
     	   
     			}
     	}
     	if($tipo=='data' and $val!=0){
     		 
     		 
     		//$val=Utility::getTime($val);
     	}
     	
     	if($view!='n'){
    ?>
    <td >
<?php echo $val;?>
    </td>
<?php
     } }?>
<?php 

if($req=='adesioni'){
	
	
 echo "<td><a target='_blank' class='btn btn-circle btn-primary' href='print.php?req=$req&id=$id'>";echo "stampa";?></a></td>	
	<?php 
}

?>

  <td >
<? echo "<a class='btn btn-circle btn-primary' href='index.php?req=$req&subreq=modifica&id=$id'>";echo "modifica";?></a>
    </td>
    <td>

<a class="btn btn-circle btn-danger delete" id="<?php echo $req;?>" rel="<?php echo $id;?>">
				Elimina</a>
    </td>
    </tr>
<?php


}
?>
</tbody>
</table><?php
}

?>
</div>
</div>
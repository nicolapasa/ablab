<?php
if($livello !='administrator' ) header("Location: index.php?req=accesso_negato");
switch ($subreq){
	case 'mod_doc':
	

		$id= (int)$_GET['id'];

	
		$row= $db->selectAll('doc', array('id'=>$id));
	
	
		if(count($row)>0){
	
			foreach($row as $r){
	
	
				$id= $r['id'];
			
				$tipo=$r['tipo'];
	
				$file=$r['file'];
	
				$nome=$r['nome'];
	
	
			}
		}
	

		?>
	<form class="form-horizontal" id="form-nm"
					enctype='multipart/form-data' action="save.php" method="post"
					autocomplete="off">
					<!-- Widget -->
					<div class="widget">
				
						<!-- Widget heading -->
						<div class="widget-head">
							<h4 class="heading">Modifica di un documento caricato</h4>
						</div>
						<!-- // Widget heading END -->
				
						<div class="widget-body innerAll inner-2x colorLilla">
				
							<!-- Row -->
							<div class="row innerLR">
		
	
	 

	<div class="form-group"><label class="col-md-4 control-label">Nome del documento (appare in menu, no maiuscolo)</label>
		<div class="col-md-8">
		<textarea  name="nome"><?php echo $nome;?></textarea> 
		</div></div>
		<div class="form-group"><label class="col-md-4 control-label">Tipo di utenza riservata:</label>  
<div class="col-md-8">
<select name="tipo" >
<option value="<?php echo $tipo;?>" selected="selected"><?php echo $tipo;?></option>
<option value="struttura">struttura</option>
<option value="service" >service</option>
<option value="" >tutti</option>
</select>

</div>
</div>
	
		<!-- Alert -->
			<div class="separator"></div>
	<div class="alert alert-custom">
		
		<strong>Nota bene:</strong>	Non caricare file più grandi di 8M
	</div>
	<!-- // Alert END -->	
					<div class="form-group">
	<label class="col-md-4 control-label"  for="author">Carica documento</label>
	<div class="col-md-8">
	<div class="fileupload fileupload-new margin-none" data-provides="fileupload">
	  	<span class="btn btn-default btn-file"><span class="fileupload-new">Select file</span>
	  	<span class="fileupload-exists">Change</span>
	  	<input name="file" type="file" class="margin-none" /></span>
		<?php if($file!=''){?>
	  	<span class="fileupload-preview"><a class="btn btn-primary" target="_blank" href="<?php echo DIR_UPLOAD.$file;?>"  >
	  <?php 	if(preg_match('/(JPG|jpg|gif|png|gif|bmp)$/',Utility::getExt(DIR_UPLOAD.$file))){?>
	  <img src="<?php echo DIR_UPLOAD.$file;?>"  width="100"/><?php }else{echo $nome;}?></a></span>
		<?php }?>
	  	<a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none">&times;</a>
	</div>
	</div>
	</div> 
		<div class="separator"></div>
	
	

						<div class="separator"></div>
	<input type="hidden" value="<? echo $id;  ?>"  name="id" />

	<input type="hidden" value="mod_doc"  name="action" />
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
<div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Elenco documenti</h3>
                                        </div>
                                        <div class="panel-body"> 
<!-- heading -->


<a class="btn btn-primary" href="index.php?req=doc&subreq=mod_doc"><i class="fa fa-plus"></i>Nuovo Documento </a>
<?php 


	
	$sql="select * from doc order by id desc ";

    


$row = $db->paginaSql($sql,'10');

$p= new geo();


echo $db->printPagina(0,'doc');
?>	

	 <table class=" table">
    <thead>
    <tr>
	 <th>
Nome documento
    </th>
    	 <th>
 Utenza riservata
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


	$id_doc= $r['id'];
			
				$tipo=$r['tipo'];
				if($tipo=='') $tipo='tutti';
	
				$file=$r['file'];
	
				$nomedoc=$r['nome'];

?>
<tr class="gradeA">

    <td>
  <?php echo $nomedoc;?>  
  </td>
    <td >
  <? echo $tipo; ?>
    </td>
   
         <td>

   
<a class="btn btn-primary" href="index.php?req=doc&subreq=mod_doc&id=<?php echo $id_doc;?>" >
			<span>modifica</span></a>

			  <td>

<a class="btn btn-primary delete_doc" id="<?php echo $id_doc;?>">
			<span>elimina </span></a>


        </td>
   </tr>
    <?php

}

?>
</tbody>
</table>
<?php 

echo $db->printPagina(0, 'doc');

?>
</div>
</div>
<?php


}
?>
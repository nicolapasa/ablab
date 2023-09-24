<?php

if($livello !='service')  {
switch ($subreq){
	

	case 'view_letture':
		if($livello== 'administrator')  {

		include('view_lett.php');
			}	
		break;

	case 'mod_post':
	
		$id_topic= (int)$_GET['id'];
		$id= (int)$_GET['id_post'];
		//solo l'autore può modificare il suo post - fare sempre un controllo e mettere il link alla modifica solo per l'autore
		// o l'amministratore
	    $titolo=$db->getCampo('for_topic', 'titolo', array('id'=>$id_topic));
		$row= $db->selectAll('for_post', array('id'=>$id));
	
	
		if(count($row)>0){
	
			foreach($row as $r){
	
				$id_topic = $r['id_topic'];
				$id= $r['id'];
				$id_autore=$r['id_admin'];
				if($livello !='administrator' and $id_autore != $id_loggata) header("Location: index.php?req=accesso_negato");
	

	
				$testo=$r['testo'];
	
	
			}
		}
	
		if($id==0) $id_autore=$id_loggata;
		?>
	<form class="form-horizontal" id="form-nm"
					enctype='multipart/form-data' action="save.php" method="post"
					autocomplete="off">
					<!-- Widget -->
					<div class="widget">
				
						<!-- Widget heading -->
						<div class="widget-head">
							<h4 class="heading">Forum Rispondi argomento</h4>
						</div>
						<!-- // Widget heading END -->
				
						<div class="widget-body innerAll inner-2x colorLilla">
				
							<!-- Row -->
							<div class="row innerLR">
							<div class="alert alert-info ">
					Rispondi alla discussione:	<? echo $titolo;?>
	 </div>
	
	 

	
	<div class="form-group">
	<label class="col-md-4 control-label">Contenuto discussione:</label>
		<div class="col-md-8">
		<textarea class="editor2" name="testo"><?php echo $testo;?></textarea> 
		</div></div>
		
		 
	
	
			
	<input type="hidden" value="<? echo $id;  ?>"  name="id" />
	<input type="hidden" value="<? echo $id_topic;  ?>"  name="id_topic" />
	<input type="hidden" value="<? echo $id_autore;  ?>"  name="id_admin" />
	<input type="hidden" value="mod_post"  name="action" />
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

case 'mod_topic':

$id_topic= (int)$_GET['id'];

//solo l'autore può modificare il suo post - fare sempre un controllo e mettere il link alla modifica solo per l'autore 
// o l'amministratore 

$row= $db->selectAll('for_topic', array('id'=>$id_topic));


if(count($row)>0){

foreach($row as $r){
	
$id_topic = $r['id'];
$id_autore=$r['id_admin'];
if($livello !='administrator' and $id_autore != $id_loggata) header("Location: index.php?req=accesso_negato");

$titolo=$r['titolo'];

$testo=$r['testo'];


   }
}

if($id_topic==0) $id_autore=$id_loggata;
?>
<form class="form-horizontal" id="form-nm"
				enctype='multipart/form-data' action="save.php" method="post"
				autocomplete="off">
				<!-- Widget -->
				<div class="widget">
			
					<!-- Widget heading -->
					<div class="widget-head">
						<h4 class="heading">Forum Modifica/Nuovo argomento</h4>
					</div>
					<!-- // Widget heading END -->
			
					<div class="widget-body innerAll inner-2x colorLilla">
			
						<!-- Row -->
						<div class="row innerLR">
<div class="form-group">
<label class="col-md-4 control-label">Titolo discussione:</label>	<div class="col-md-8">   
<input class="form-control" type="text"  name="titolo" value="<? echo $titolo;?>"  /></div></div> <div class="separator"></div>
 
 
<!--  <div class="form-group"><label class="col-md-4 control-label">Data discussione:</label>	<div class="col-md-8">   
<input type="text" class="data" name="data" value="<? echo $data;?>"  /></div></div> <div class="separator"></div>--> 


<div class="form-group"><label class="col-md-4 control-label">Contenuto discussione:</label>
	<div class="col-md-8">
	<textarea class="editor2" name="testo"><?php echo $testo;?></textarea> 
	</div></div>
	
	

	
				
<input type="hidden" value="<? echo $id_topic;  ?>"  name="id" />
<input type="hidden" value="<? echo $id_autore;  ?>"  name="id_admin" />
<input type="hidden" value="mod_topic"  name="action" />
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
case 'view_topic':

	include('view_topic.php');	
	
break;	

default:
?>	

<!-- heading -->
<h4 class="innerAll margin-none bg-white">Forum Ricerca argomenti</h4>
<div class="col-separator-h"></div>
 <form class="form" action="index.php" method="get" enctype="multipart/form-data">
 	<div class="widget">
			
					<!-- Widget heading -->
					<div class="widget-head">
						<h4 class="heading">Cerca per argomento</h4>
					</div>
					<!-- // Widget heading END -->
			
					<div class="widget-body innerAll inner-2x colorLilla">
			
						<!-- Row -->
						<div class="row innerLR">

<div class="form-group"><label class="col-md-4 control-label">Titolo argomento:</label>    
<div class="col-md-8"><input class="form-control"  type="text"  name="ricerca_topic" placeholder="cerca..."  />
</div></div>
<input type="hidden" name="req" value="forum" />
<!-- Form actions -->
<div class="separator"></div>
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="fa fa-check-circle"></i>Avvia
								</button>
							</div>
							<!-- // Form actions END -->
</div>
</div>
</div>
</form>

<a class="btn btn-primary" href="index.php?req=forum&subreq=mod_topic">nuovo argomento </a>
<?php 
if($_GET['ricerca_topic']!=''){
	
	$search=$_GET['ricerca_topic'];
	
	
}

	
	$sql="select * from for_topic  ";

    


if($search!='') $sql.=" where titolo like '%$search%' ";

$sql.=" order by id desc ";

$row = $db->paginaSql($sql,'10');

$p= new geo();


echo $db->printPagina(0,'forum', $search);
?>	

    <div class=" flip-scroll">
 <table class="table table-bordered table-striped table-condensed flip-content" >
        <thead class="flip-content">
    <tr>
	 <th>
  Titolo discussione
    </th>
    	 <th>
   Data discussione
    </th>
   <th>
  Autore discussione
    </th>
    <th>
  Risposte
    </th>
       <?php if($livello == 'administrator'){ ?>
    <th>
   Visite
    </th>
       <?php } ?>
	<th>
 Ultimo msg
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
$id_topic= $r['id'];

$id_autore= $r['id_admin'];

$data = Utility::getTime($r['data']);
$titolo=ucfirst(strtolower(Utility::troncaTesto($r['titolo'], 200)));
$letto=$r['letto'];

$risposte=count($db->selectAll('for_post', array('id_topic'=>$id_topic)));
$autore=$db->getCampo('admin', 'nome', array('id'=>$id_autore));
//funzione che restituisce l'ultimo messaggio
$last=$db->getLast($id_topic);

?>
<tr class="gradeA">
   <td><? echo $titolo; ?>
   <a class="btn btn-primary" title="<? echo $r['titolo']; ?>" href="index.php?req=forum&subreq=view_topic&id=<?php echo $id_topic;?>">
			<span>leggi </span></a>
 
    </td>
    <td class="min">
  <?php echo $data;?>  
  </td>
    <td class="min">
  <? echo $autore; ?>
    </td>
    <td class="min">
    <? echo $risposte; ?>
    </td>
     <?php if($livello == 'administrator'){ ?>
	  <td >
    <? echo $letto; ?>
    </td>
    <?php }?>
	  <td class="min">
    <? echo $last; ?>
    </td>
         <td class="min">
            <?php if($livello == 'administrator' or $id_loggata==$id_autore) {?>
   
<a class="btn btn-primary" href="index.php?req=forum&subreq=mod_topic&id=<?php echo $id_topic;?>" >
		<i class='fa fa-edit'></i></a>
			  <?php }?>
			  <td class="min">
			       <?php if($livello == 'administrator' or $id_loggata==$id_autore) {?>
<a class="btn btn-primary delete_topic" id="<?php echo $id_topic;?>">
			<i class='fa fa-trash'></i></a>

    <?php }?>
        </td>
   </tr>
    <?php

}

?>
</tbody>
</table>
</div>
<?php 

echo $db->printPagina(0, 'forum', $search);

}


}?>
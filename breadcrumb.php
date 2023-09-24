<?php
	$linkbread='';
	switch($req){
		
		case "fat": //inserimento richiesta

		break;
		case "print_esame":
	
		break;
					case "admin": //gestione utenze
$linkbread='<li><a href="index.php?req=admin">Strutture Registrate</a>   <i class="fa fa-circle"></i></li>';					

break;
case "mod_tabelle": //gestione utenze
if($_GET['tab']!='') $tab='&tab='.$_GET['tab'];
 $linkbread='<li><a href="index.php?req=mod_tabelle'.$tab.'">Gestione Tabelle</a>  
 <i class="fa fa-circle"></i></li>';
  
break;
case "listino": //gestione utenze
    
break;
case "ric": //vista richieste

   // include('elenco_fatture.php');
break;
case "ref": //gestione referti
    //include('elenco_referti.php');
break;
case "refertazione": //gestione refertazione elenco richieste per refertazione
   // include('elenco_richieste_ref.php');
break;
case "archivio": //gestione archivio
	//include('archivio.php');
break;
case "forum": //gestione forum
	//include('forum.php');
break;
case "mod_esami": //gestione esami custom prezzi e nomi
	//include('mod_esami.php');
	break;
case "doc": //gestione documenti
//  include('doc.php');
break;
case "ele_doc": //gestione documenti
  //include('ele_doc.php');
break;
case "news":
$linkbread='<li><a href="index.php?req=news">Gestione News</a>   <i class="fa fa-circle"></i></li>';
$bread="Crea/Edita News";
    //include('news.php');	
break;	
case "blog":
$bread="NEWS";

break;	
case "blog-post":
$linkbread='<li><a href="index.php?req=blog">NEWS</a>   <i class="fa fa-circle"></i></li>';
$bread="POST";
 	
break;	
case "file":
$bread="Allegati";
    
break;	
default:

$bread=$req;
	}
	?>

 <ul class="page-breadcrumb">
                            <li>
                                <a href="index.php">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
							<?php echo $linkbread;?>
                            <li>
                                <span><?php echo $bread;?></span>
                            </li>
 </ul>

 <h5 class="text-right">
 <span>    <i class="fa fa-calendar"></i><?php echo Utility::getDataIta();?> - <?php echo Utility::getTime2();?></span>
 </h5>
 

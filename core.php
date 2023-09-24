	<?php
	if($off=='s'){

	?>
	<div class="alert alert-danger">

	<strong>Attenzione!</strong>il software è attualmente OFFLINE.
</div>
	<?php
}
	switch($req){
   case "errori_db":
     include('elenco_errori.php');
	 break;
		case "form_superadmin":
  include('form_login_superadmin.php');
		break;
			case "pre_fat": //anteprima fattura
    include('pre_fat.php');
break;
					case "mod_fat": //modifica fattura
    include('mod_fat.php');
break;
					case "mod_pro": //modifica proprietari
    include('mod_pro.php');
break;
				case "add_tab": //aggiungo tabella
    include('add_tab.php');
break;
		case "referta": //gestione maschere referti
       
			include('form_referti.php');
break;
case "stat": //statistiche
	include('stat.php');
break;
case "report_refertatori": 
	include('report_refertatori.php');
break;
case "report_firma": 
	include('report_firma.php');
break;
case "elenco_refertatori": 
	include('elenco_refertatori.php');
break;
	case "pdf": //pdf referti
		include('pdf_ref.php');
		break;
		case "pdf_fat": //pdf fatture
		include('pdf_fat.php');
		break;
	case "xml": //xml
		include('xml_fatt.php');
		break;
		case "fat": //nuova richiesta
		include('richieste.php');
		break;
		case "print_esame":
		include('print_esame.php');
		break;
		case "mod_scheda":
		include('mod_scheda.php');
		break;
					case "admin": //gestione utenze
    include('admin.php');
break;
case "listino": //listino
    include('listino.php');
break;
case "ric": //vista richieste

    include('elenco_richieste.php');
break;
case "ref": //elenco referti
    include('elenco_referti.php');
break;
case "refertazione": //gestione refertazione elenco richieste per refertazione
    include('elenco_richieste_ref.php');
break;
case "archivio": //gestione archivio
	include('archivio.php');
break;
case "forum": //gestione forum
	include('forum.php');
break;
case "mod_esami": //gestione esami custom prezzi e nomi
	include('mod_esami.php');
	break;
case "mod_tabelle": //gestione esami custom prezzi e nomi
	include('mod_tabelle.php');
	break;
case "doc": //gestione documenti
  include('doc.php');
break;
case "ele_doc": //gestione documenti
  include('ele_doc.php');
break;
case "news":
    include('news.php');
break;
case "blog":
    include('blog.php');
break;
case "blog-post":
    include('blog-post.php');
break;
case "fatturazione": //fatturazione
    include('fatturazione.php');
break;
case "fatture"://fatture vere
    include('fatture.php');
break;
case "fatture_cli"://fatture vere
    include('fatture_cli.php');
break;
case "file":
    include('files.php');
break;
case "error":
?>
<div class="alert alert-custom">
<strong>Attenzione.</strong>	<?php  echo "si e' verificato un errore, si prega di riprovare a inserire l'esame cliccando su 'nuovo esame' ";
?></div>
<?php


	break;

		case "404": //accesso negato
		?>
		 <div class="row">
                        <div class="col-md-12">
                      <div class="alert alert-danger">
                     <strong>Accesso negato</strong> Hai tentato di accedere ad un'area per cui non sei autorizzato </div>
                        </div>
         </div>
		<?php
		break;

		default:

				include('home.php');



			}
	?>

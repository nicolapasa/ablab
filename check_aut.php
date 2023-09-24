<?php



//gestione accesso
switch ($req){

case "admin": //gestione utenze
	if(!isset($subreq) or $subreq!='modifica') {

		$aut->autoriz();
	}
	if($livello!= 'administrator' and ($_SESSION['struttura'] !=$_GET['id_admin']) and $subreq=='modifica' )
		header("Location: index.php?req=404");
break;
case "report_refertatori":
	if($livello!= 'administrator' )
	header("Location: index.php?req=404");
break;	
case "fatturazione": //gestione utenze

	if($livello!= 'administrator' or $superadmin =='n')
			header("Location: index.php?req=404");
break;
case "xml":
	if($livello!= 'administrator' or $superadmin =='n')
			header("Location: index.php?req=404");
break;
case "pdf_fat":
	if($livello!= 'administrator' or $superadmin =='n')
			header("Location: index.php?req=404");
break;
case "fatture": //gestione utenze

	if($livello!= 'administrator' or $superadmin =='n')
		header("Location: index.php?req=404");
break;
case "referta": //gestione utenze

	if($livello== 'struttura' or $livello=='service')
		header("Location: index.php?req=404");
break;
case "errori_db": //gestione utenze

	if($livello!= 'administrator' )
		header("Location: index.php?req=404");
break;


}
?>

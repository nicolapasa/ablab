<?php
session_start();

session_destroy();

switch($_GET['req']){
	case 'ref':
	header("Location: index.php?req=ref");
	break;
	case 'fatturazione':
		header("Location: index.php?req=fatturazione");
	break;
	case 'fatture':
		header("Location: index.php?req=fatture");
	break;
	case 'ric':
   header("Location: index.php?req=ric");
	break;
	default:

	header("Location: index.php?req=fat");

}


?>

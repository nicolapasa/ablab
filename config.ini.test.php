<?php
//settaggi dell'applicazione
header('Content-Type: text/html; charset=UTF-8'); #istruz. per html
mb_internal_encoding('UTF-8');
//db test
error_reporting(E_ERROR | E_PARSE);
//ini_set("memory_limit","512M");
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
define('DB_NAME', 'ablab_software');
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DIR_UPLOAD', 'upload/');

define('DIR_BACKUP', 'backup/');


//email admin
define('MAIL_ADMIN', 'nicolapasa@hotmail.it');
define('MAIL_AMMINISTRAZIONE', 'nicolapasa@hotmail.it');
$root=$_SERVER['DOCUMENT_ROOT'].'/ablab';
define('__ROOT__', $root);



$url_general="http://".$_SERVER['SERVER_NAME'].'/ablab/';
define('URL_GEN', $url_general);

//impostazioni mail
define('MAIL_HOST', 'smtp-mail.outlook.com');
define('MAIL_USER', 'nicolapasa@hotmail.it');
define('MAIL_PASS', 'vuPf65t_u');
define('MAIL_FROM', 'nicolapasa@hotmail.it');
define('MAIL_REPLY', 'nicolapasa@hotmail.it');
define('MAIL_NOME', 'email testing');

//testo anno
//define('ANNO_CORE', 2020); //test da togliere poi
define('ANNO_CORE', date('Y')); //in produzione
define('CURRENT_DATE', time());  //in produzione
//define('CURRENT_DATE', time()+ (80 * 24 * 60 * 60));  //questo dovrebbe portare al mese di gennaio

?>

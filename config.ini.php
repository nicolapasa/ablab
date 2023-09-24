<?php
header('Content-Type: text/html; charset=UTF-8'); 
mb_internal_encoding('UTF-8');



 define('DB_NAME', 'softwareablab');
 define('DB_USER', 'BJ8XGaDpEV');
 define('DB_PASS', 'tytX6PPhfBKu3CWkNkS]PKQU');
 define('DB_HOST', 'localhost');


define('DIR_UPLOAD', 'upload/');

define('DIR_BACKUP', 'backup/');



$root=$_SERVER['DOCUMENT_ROOT'].'/software';

define('__ROOT__', $root);


$url_general="http://".$_SERVER['SERVER_NAME']."/software/";

define('URL_GEN', $url_general);




define('MAIL_ADMIN', 'info@ablab.eu');
define('MAIL_AMMINISTRAZIONE', 'amministrazione@ablab.eu');


//impostazioni mail
define('MAIL_HOST', 'smtp.ergonet.it');
define('MAIL_USER', 'info@ablab.eu');
define('MAIL_PASS', 'QUcdw!BChU69');
define('MAIL_FROM', 'info@ablab.eu');
define('MAIL_REPLY', 'info@ablab.eu');
define('MAIL_NOME', 'AbLab Laboratorio di analisi veterinarie');
define('MAIL_NOME_AM', 'Amministrazione - AbLab Laboratorio di analisi veterinarie');



define('ANNO_CORE', date('Y')); //in produzione
define('CURRENT_DATE', time());  //in produzione
?>
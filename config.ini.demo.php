<?php
//settaggi dell'applicazione
header('Content-Type: text/html; charset=UTF-8'); #istruz. per html
mb_internal_encoding('UTF-8');
//db test

error_reporting(E_ERROR);


//test online su nicolapasa.com/ablab

 define(DB_NAME, '');
 define(DB_USER, '');
 define(DB_PASS, '');
 define(DB_HOST, '');

define('DIR_UPLOAD', 'upload/');

define('DIR_BACKUP', 'backup/');


$root=$_SERVER['DOCUMENT_ROOT'].'/ablab';
//$root=$_SERVER['DOCUMENT_ROOT'].'/software';

define('__ROOT__', $root);


$url_general='http://'.$_SERVER['SERVER_NAME'].'/ablab/';

define('URL_GEN', $url_general);


define('MAIL_ADMIN', '');
define('MAIL_AMMINISTRAZIONE', '');


define('MAIL_HOST', '');
define('MAIL_USER', '');
define('MAIL_PASS', '');
define('MAIL_FROM', '');
define('MAIL_REPLY', '');
define('MAIL_NOME', '');

define('ANNO_CORE', date('Y')); //in produzione
define('CURRENT_DATE', time());  //in produzione

?>

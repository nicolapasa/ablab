<?php
//settaggi dell'applicazione
header('Content-Type: text/html; charset=UTF-8'); #istruz. per html
mb_internal_encoding('UTF-8');
//db test

error_reporting(E_ERROR);


//test online su nicolapasa.com/ablab

 define(DB_NAME, 'ablab');
 define(DB_USER, 'ablab');
 define(DB_PASS, 'X9MAJ8UpuP');
 define(DB_HOST, 'localhost');

define('DIR_UPLOAD', 'upload/');

define('DIR_BACKUP', 'backup/');


$root=$_SERVER['DOCUMENT_ROOT'].'/ablab';
//$root=$_SERVER['DOCUMENT_ROOT'].'/software';

define('__ROOT__', $root);


$url_general='http://'.$_SERVER['SERVER_NAME'].'/ablab/';

define('URL_GEN', $url_general);


define('MAIL_ADMIN', 'nicola.pasa@gmail.com');
define('MAIL_AMMINISTRAZIONE', 'nicola.pasa@gmail.com');


//impostazioni mail

// define('MAIL_HOST', 'smtp-mail.outlook.com');
// define('MAIL_USER', 'nicolapasa@hotmail.it');
// define('MAIL_PASS', 'vepfor65');
// define('MAIL_FROM', 'nicolapasa@hotmail.it');
// define('MAIL_REPLY', 'nicolapasa@hotmail.it');
// define('MAIL_NOME', 'email testing');

define('MAIL_HOST', 'smtp.ergonet.it');
define('MAIL_USER', 'info@nicolapasa.com');
define('MAIL_PASS', 'e(9QmKwXjT3Q');
define('MAIL_FROM', 'info@nicolapasa.com');
define('MAIL_REPLY', 'info@nicolapasa.com');
define('MAIL_NOME', 'email testing');



/*
define('MAIL_HOST', 'smtps.aruba.it');
define('MAIL_USER', 'postmaster@ablab.eu');
define('MAIL_PASS', 'SIAMOsoloNOI2015');
define('MAIL_FROM', 'info@ablab.eu');
define('MAIL_REPLY', 'info@ablab.eu');
define('MAIL_NOME', 'AbLab Laboratorio di analisi veterinarie');
define('MAIL_NOME_AM', 'Amministrazione - AbLab Laboratorio di analisi veterinarie');
*/
define('ANNO_CORE', date('Y')); //in produzione
define('CURRENT_DATE', time());  //in produzione

?>

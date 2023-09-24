<?
session_start();

session_destroy();

setcookie('log','','0','/');
setcookie('user','','0','/');
setcookie('pass','','0','/');
setcookie('superadmin','','0','/');
header('location: ./entra.php');
?>

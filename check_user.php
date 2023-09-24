<?
include("autoloader.php");
$u= new Auth();



echo $u->checkUser($_GET['username']);


$u->close();
?>
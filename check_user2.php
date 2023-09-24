<?
include("autoloader.php");
$u= new Auth();



echo $u->checkUserAd($_POST['username'], $_POST['id_admin']);


$u->close();
?>
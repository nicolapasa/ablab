<?php
include("autoloader.php");

$db= new Auth();

$p= new geo();
$f= new Filter();


if($f->filter_empty($_POST) and $db->checkUser($_POST['username'])=='true'){

$up=new Upload('foto');
$_POST['nome']= mb_strtolower($_POST['nome'], 'UTF-8');
$_POST['mod_pag']='bonifico';

print_r($_POST);
$id=$db->add('admin', $_POST);


$nome=$_POST['nome'];

 $email=explode(';',$_POST['email']);
$telefono= $_POST['telefono'];
$referente=$_POST['referente'];
$username=$_POST['username'];
$password=$_POST['password'];
$comune =  $p->getCom($_POST['comune']);

$provincia = $p->getProv($_POST['provincia']);







}
else{

//errore
}

?>

<?php
session_start();
session_regenerate_id(true);
include('./autoloader.php');//autoloader


//* ricevo i dati dal form *//
//* dati login *//
$user   = ($_POST['user']);
$pass = ($_POST['pass']);

$aut =new Auth();



if ($aut->aut($user, $pass))

{
//log
$id=$aut->getCampo('admin', 'id', array('username'=>$user, 'password'=>$pass));
$val=(int)$aut->getCampo('log', 'value', array('id_struttura'=>$id));
$val++;
$letto=$val-1;
//prima verifico se esiste
if(!$aut->checkRec('log', array('id_struttura'=>$id))){
$aut->add('log', array('id_struttura'=>$id, 'value'=>$val, 'letto'=>$letto, 'contesto'=>'login'));	
}
else{
	
	$aut->updateP('log', array('value'=>$val, 'letto'=>$letto), array('id_struttura'=>$id, 'contesto'=>'login'));	
	
}
setcookie("user",$user,time()+(60*60*24*30), '/');
Header("Location:  ./index.php");
}
else
{
Header("Location:  ./entra.php?err=si");
}


<?php
session_start();
include('./autoloader.php');//autoloader


//* ricevo i dati dal form *//
//* dati login *//

$pass = ($_POST['password']);

$aut =new Auth();

$row=$aut->selectAll('superadmin', array('password'=>$pass));
if(count($row)>0){

setcookie("superadmin",'superadmin',time()+(60*60*24*30), '/');
Header("Location:  ./index.php");
}
else
{
Header("Location:  ./index.php?err=si");
}

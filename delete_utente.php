<?php
include("autoloader.php");


$admin= new DB();
echo $id = $_POST['id'];


$admin->delete('admin', $id);//cancello clinica

//verifico se ci sono notifiche e le cancello


$admin->deleteP('notifiche', array('id_post'=>$id, 'tipo'=>'registrazione'));
//cancello esami e altri dati



?>
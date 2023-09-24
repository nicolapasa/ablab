<?php
include("./autoloader.php");
error_reporting(E_ALL);



$e='nicola.pasa@gmail.com';
$oggetto='test';


$body='test';




Utility::inviaMail($e, $oggetto, $body);
